<html>
<body>
<?php

	include "cabecalho.php";
	include "menu.php";
	
	$link = fnConectaBancoDados();
	

	if (!empty($_POST)) 
		{
			$avaliador = htmlspecialchars($_POST["avaliador"]);
			$posicao = htmlspecialchars($_POST["posicao"]);
		}
				// **** alterar if por medidas de segurança
	//verifica se o avaliador aceitou ser membro ou presidente
	if($posicao != 'Recusar')
		{
			//atualiza o status do avaliador para o que ele selecionou ser
			$query = "UPDATE tabavaliador SET situacao='$posicao' WHERE id = $avaliador";
			$result = mysqli_query($link, $query) or die("Bad Query: $query");
			//se conseguir atualizar a situação do avaliador
			if ($result) 
				{
							//falta adicionar medidas de segurança para impedir 2 presidentes
					//pega os dados da banca que o avaliador aceitou participar 
					$query = "SELECT * from tabbanca
							WHERE $avaliador IN (avaliador_interno, avaliador1, avaliador2, avaliador3) LIMIT 1";
					$result = mysqli_query($link, $query) or die("Bad Query: $query");
					//se encontrou a banca
					if(mysqli_num_rows($result) != 0)
						{
							//pega os valores do select e coloca em $banca
							$banca = mysqli_fetch_assoc($result);
							//pega os valores do $banca e coloca em um vetor
							$avaliadores = 
								[
									$banca['avaliador_interno'],
									$banca['avaliador1'],
									$banca['avaliador2'],
									$banca['avaliador3']
								];
							//cria implode o vetor em uma variavel para utilizar na pesquisa
							$ids = implode(',', array_map('intval', $avaliadores));
							//conta quantos avaliadores sorteados ainda não confirmaram
							$query = "SELECT COUNT(*) AS total_sorteados FROM tabavaliador WHERE id IN ($ids) AND situacao = 'Sorteado' ";
							$result = mysqli_query($link, $query);
							$row = mysqli_fetch_assoc($result);
							//move do array para uma variavel aceitavel no query
							$banca_id = $banca['id'];
							//se todos confirmaram
							if ($row['total_sorteados'] == 0) 
								{
									$query = "UPDATE tabbanca SET estado = 'Confirmada' where id = $banca_id";
									$result = mysqli_query($link, $query);
								}
						}
				}
			else 
				{
					echo "Erro ao atualizar: " . mysqli_error($link);			
				}
		}
	else if($posicao == 'Recusar')
		{
					// **** verificar as medidas de segurança
			//encontra a coluna do avaliador que recusou e id da banca
			$query = "SELECT id AS banca_id, 
					CASE
						WHEN avaliador_interno = $avaliador THEN 'avaliador_interno'
						WHEN avaliador1 = $avaliador THEN 'avaliador1'
						WHEN avaliador2 = $avaliador THEN 'avaliador2'
						WHEN avaliador3 = $avaliador THEN 'avaliador3'
					END AS coluna_encontrada FROM tabbanca	
					WHERE $avaliador IN (avaliador_interno, avaliador1, avaliador2, avaliador3) LIMIT 1";
			$result = mysqli_query($link, $query);
			if($result && mysqli_num_rows($result) > 0)
				{
					$row = mysqli_fetch_assoc($result);
					//joga para variaveis usaveis pelo query
					$banca_id = $row['banca_id'];
					$coluna_encontrada = $row['coluna_encontrada'];
					//encontra a area, subarea e ifes do avaliador
					$query = "SELECT u.area, u.subarea, u.ife FROM tabbanca b JOIN tabavaliador u ON u.id = b.avaliador_interno WHERE b.id = $banca_id LIMIT 1";
					$result = mysqli_query($link, $query) or die ("Bad Query: $query");
					$avaliadores = mysqli_fetch_assoc($result);
					//joga para variaveis usaveis pelo query
					$area = $avaliadores['area'];
					$subarea = $avaliadores['subarea'];
					$ifes = $avaliadores['ife'];
					//verifica se foram encontrados os dados do avaliador
					if($area)
						{
										// ****Impedir de resortear o mesmo avaliador ou avaliadores que já recusaram a banca
							//se for o avaliador interno obriga a ser o ifes dele no sorteio
							if($coluna_encontrada == 'avaliador_interno')
								{
									$query = "SELECT id FROM tabavaliador WHERE area = '$area' AND subarea = '$subarea' AND ife = '$ifes' 
											AND (situacao NOT IN ('Sorteado','Presidente','Em Banca') OR situacao IS NULL) ORDER BY RAND() LIMIT 1";
								}
							//se não for o avaliador interno exclui o ifes dele
							else if ($coluna_encontrada != 'avaliador_interno')
								{
									$query = "SELECT id FROM tabavaliador WHERE area = '$area' AND subarea = '$subarea' AND ife != '$ifes' 
											AND (situacao NOT IN ('Sorteado','Presidente','Em Banca') OR situacao IS NULL) ORDER BY RAND() LIMIT 1";													
								}
							$result = mysqli_query($link, $query);
							$row = mysqli_fetch_assoc($result);
							$sorteado = $row['id'];
							if($result)
								{
										//remove avaliador que recusou da banca
										$query = "UPDATE tabavaliador SET situacao = NULL where id =$avaliador";
										$result = mysqli_query($link, $query) or die("Bad Query: $query");
										//coloca o novo sorteado na banca no lugar do que recusou
									    $query = "UPDATE tabbanca SET $coluna_encontrada = $sorteado WHERE id = $banca_id";
										$result = mysqli_query($link, $query) or die("Bad Query: $query");									
										if($result)
											{
												$query = "UPDATE tabavaliador SET situacao = 'Sorteado' WHERE id = $sorteado";
												$result = mysqli_query($link, $query) or die("Bad Query: $query");
											}
								}
							//se não for encontrado avaliadores com os requisitos para substituir o que recusou
							else 
								{
											// ****adicionar alguma segurança para banca sortear após outra banca concluir
									die("Nenhum avaliador disponível para sorteio.");
								}
						}
				}
		}
	else
		{
			echo "Posição invalida";
		}
?>
</body>
</html>