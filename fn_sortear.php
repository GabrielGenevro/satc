<html>
<body>
<?php

	include "cabecalho.php";
	include "menu.php";
	
	$link = fnConectaBancoDados();
	

	if (!empty($_POST)) {
		//$campus = htmlspecialchars($_POST["campus"]);
		$ifes_interno = htmlspecialchars($_POST["ifes_interno"]);
		$area = htmlspecialchars($_POST["area"]);
		$subarea = htmlspecialchars($_POST["subarea"]);
		//numero de avaliadores internos a serem sorteados
		$num_av_int = 1;
		//numero de avaliadores externos a serem sorteados
		$num_av_ext = 3;
	}
	
				//Seleção Avaliador interno
				
			//seleciona os valores do banco de dados, 
			// ORDER BY RAND () ordena eles de maneira aleatoria
			// LIMIT X está limitando a quantidade de valores selecionados a x valores
			$query = "SELECT id FROM tabavaliador WHERE ife = '$ifes_interno' AND area = '$area' AND subarea = '$subarea'
								AND (situacao NOT IN ('Sorteado','Presidente','Em Banca') OR situacao IS NULL) ORDER BY RAND() LIMIT $num_av_int";	
			$result = mysqli_query($link, $query) or die("Bad Query: $query");
			//cria a array usada posteriormente para armazenar os valores dos sorteados no select anterior utilizada em outras interações com o BD
			$avaliador_int = [];
			//verifica se há avaliadores internos
			if(mysqli_num_rows($result) == $num_av_int)
				{
					//joga os valores do select para uma array que pode ser usada para o select
					while ($row = mysqli_fetch_assoc($result))
						{
							$avaliador_int[] = $row['id'];
						}
			
							//Seleção Avaliador Externo		
							
						//seleciona os valores do banco de dados, 
						// ORDER BY RAND () ordena eles de maneira aleatoria
						// LIMIT X está limitando a quantidade de valores selecionados a x valores
						$query = "SELECT id FROM tabavaliador WHERE area = '$area' AND subarea = '$subarea' AND ife != '$ifes_interno' 
											AND (situacao NOT IN ('Sorteado','Presidente','Em Banca') OR situacao IS NULL) ORDER BY RAND() LIMIT $num_av_ext";
						$result = mysqli_query($link, $query) or die("Bad Query: $query");
						//cria a array usada posteriormente para armazenar os valores dos sorteados no select anterior utilizada em outras interações com o BD
						$avaliador_ext = [];
						//verifica se há avaliadores externos disponiveis suficientes para o sorteio
						if(mysqli_num_rows($result) == $num_av_ext)
							{	
								//joga os valores do select para uma array que pode ser usada para o select
								while($row = mysqli_fetch_assoc($result))
									{
										$avaliador_ext[] = $row['id'];
									}
									//gera os dados da banca no banco de dados
									$sql_insert = "INSERT INTO tabbanca (avaliador_interno, avaliador1, avaliador2, avaliador3, estado, resultado) VALUES 
									('$avaliador_int[0]', '{$avaliador_ext[0]}', '{$avaliador_ext[1]}', '{$avaliador_ext[2]}', 'Pendente', 'apresentar')";
									//se a banca for gerada atualiza os status dos avaliadores para remove-los de sorteios futuros
									if(mysqli_query($link, $sql_insert))
										{
											//junta os arrays em um array
											$ids = array_merge($avaliador_int, $avaliador_ext);
											//transforma o array em uma variavel
											$ids = implode(",", $ids);
											//atualiza o status dos avaliadores sorteados para remove-los de sorteios até a resposta deles ao sorteio feito
											$sql_update = "UPDATE tabavaliador SET situacao = 'Sorteado' WHERE id IN ($ids)";
											mysqli_query($link, $sql_update);
										} 
									else 
										{
											echo "Erro ao inserir: " . mysqli_error($link);
										}

							}
						//se não houver avaliadores externos suficientes disponiveis
						else
							{
								echo "Não há avaliadores externos suficientes";
							}
				}
			//se não houver avaliadores internos suficientes disponiveis
			else
				{
					echo "Não há avaliadores internos suficientes";
				}




				
			//-----Seleção do avaliador interno
/*			
		//seleciona os valores do banco de dados que são compativeis com a pesquisa
		$sql = "SELECT id FROM tabavaliador WHERE ife = '$ifes_interno' AND area = '$area' AND subarea = '$subarea'";
		$result = $link->query($sql);

		$ids = [];
		while ($row = $result->fetch_assoc()) {
			$ids[] = $row['id'];
		}
		//quantidade de valores que vão ser sorteados randomicamente
		$quantidade = 1; 
		//seleciona randomicamente os avaliadores
		$randomKeys = array_rand($ids, $quantidade);
		//mostrando os valores $k é um indexador
		foreach ($randomKeys as $k) 
			{
				echo $ids[$k] . "<br>";
			}	
	
			//------Seleção do avaliador externo
		
		//seleciona os valores do banco de dados que são compativeis com a pesquisa
		$sql = "SELECT id FROM tabavaliador WHERE ife = $ifes_externo AND area = '$area' AND subarea = '$subarea'";
		$result = $link->query($sql);

		$ids = [];
		while ($row = $result->fetch_assoc()) {
			$ids[] = $row['id'];
		}
		//quantidade de valores que vão ser sorteados randomicamente
		$quantidade = 2; 
		//seleciona randomicamente os avaliadores
		$randomKeys = array_rand($ids, $quantidade);
		//mostrando os valores $k é um indexador
		foreach ($randomKeys as $k) 
			{
				echo $ids[$k] . "<br>";
			}		
*/
?>
</body>
</html>