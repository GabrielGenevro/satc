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
			
/*
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
*/
/*
//procura por membros com area e subarea. Verificando no php
$query = "SELECT id FROM tabavaliador 
          WHERE area = '$area' 
          AND subarea = '$subarea'
          AND ife != '$ifes_interno'
          AND (situacao NOT IN ('Sorteado','Presidente','Membro','Em Banca') OR situacao IS NULL)";
$result = mysqli_query($link, $query) or die("Erro: $query");
//vetor membros externos com area e subarea
$ext_area_sub = [];
while ($row = mysqli_fetch_assoc($result)) 
	{
    	$ext_area_sub[] = $row['id'];
	}
//verifica se encontrou 1 membro externo ou + com area e sub area
if (count($ext_area_sub) >= 1) 
	{
		//procura por membros somente pela area
		$query = "SELECT id FROM tabavaliador 
				WHERE area = '$area'
				AND (subarea != '$subarea' OR subarea IS NULL)
				AND ife != '$ifes_interno'
				AND (situacao NOT IN ('Sorteado','Presidente','Membro','Em Banca') OR situacao IS NULL)";
		$result = mysqli_query($link, $query) or die("Erro: $query");
		//vetor membros externos somente com area.
		$ext_area = [];
		while ($row = mysqli_fetch_assoc($result)) 
			{
				$ext_area[] = $row['id'];
			}
		//verifica se encontrou 2 membros externos ou +
		if (count($ext_area) >= 2) 
			{
				$query = "SELECT id FROM tabavaliador 
						WHERE ife = '$ifes_interno'
						AND area = '$area'
						AND (situacao NOT IN ('Sorteado','Presidente','Membro','Em Banca') OR situacao IS NULL)";
				$result = mysqli_query($link, $query) or die("Erro: $query");
				//vetor membros internos
				$int_area = [];
				//verifica se encontrou 1 membro interno
				while ($row = mysqli_fetch_assoc($result)) 
					{
						$int_area[] = $row['id'];
					}			
				if (count($int_area) >= 1) 
					{
						//sorteia presidente
						$presidente_key = array_rand($ext_area_sub);
						$presidente = $ext_area_sub[$presidente_key];
						//cria vetor do sorteio de membros externos
						$pool_externos = array_unique(array_merge($ext_area_sub, $ext_area));
						// remove presidente do sorteio
						$pool_externos = array_diff($pool_externos, [$presidente]);
						//sorteia membros externo 1 e 2
						$keys = array_rand($pool_externos, 2);
						$externo1 = array_values($pool_externos)[$keys[0]];
						$externo2 = array_values($pool_externos)[$keys[1]];
						//sorteia membro interno
						$int_key = array_rand($int_area);
						$interno = $int_area[$int_key];

						//insere no banco de dados
						$sql_insert = "INSERT INTO tabbanca 
						(avaliador_interno, avaliador1, avaliador2, avaliador3, estado, resultado) 
						VALUES 
						('$interno', '$presidente', '$externo1', '$externo2', 'Pendente', 'apresentar')";
						//se sucesso atualiza os dados dos membros para 'Sorteado'
						if (mysqli_query($link, $sql_insert)) 
							{
								$ids = [$interno, $presidente, $externo1, $externo2];
								$ids = implode(",", $ids);
								$sql_update = "UPDATE tabavaliador 
											SET situacao = 'Sorteado' 
											WHERE id IN ($ids)";
								mysqli_query($link, $sql_update);
							} 
						else {
							echo "Erro ao inserir: " . mysqli_error($link);
						}						
					}
				else
					{
						die("Não há interno disponível");
					}
			}
		else
			{
				die("Não há externos suficientes só com área");
			}
	}
else
	{
		die("Não há externos com área + subárea");
	}*/

	//PEGA OS AVALIADORES DO BANCO DE DADOS
// externos área + subárea
$ext_area_sub = [];
$query = "SELECT id FROM tabavaliador 
          WHERE area = '$area' 
          AND subarea = '$subarea'
          AND ife != '$ifes_interno'
		  AND (situacao NOT IN ('Sorteado','Presidente','Membro','Em Banca') OR situacao IS NULL)";
$result = mysqli_query($link, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $ext_area_sub[] = $row['id'];
}
// externos só área
$ext_area = [];
$query = "SELECT id FROM tabavaliador 
          WHERE area = '$area'
          AND (subarea != '$subarea' OR subarea IS NULL)
          AND ife != '$ifes_interno'
		  AND (situacao NOT IN ('Sorteado','Presidente','Membro','Em Banca') OR situacao IS NULL)";
$result = mysqli_query($link, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $ext_area[] = $row['id'];
}
// internos
$int_area = [];
$query = "SELECT id FROM tabavaliador 
          WHERE ife = '$ifes_interno'
          AND area = '$area'
		  AND (situacao NOT IN ('Sorteado','Presidente','Membro','Em Banca') OR situacao IS NULL)";
$result = mysqli_query($link, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $int_area[] = $row['id'];
}
?>
<h2>Sorteio de Banca</h2>
<button onclick="recusar()">Recusar</button>
<form method="POST" action="salvar_banca.php">
    <input type="hidden" name="dados" id="dados">
	<input type="hidden" name="ifes_interno" value="<?php echo $ifes_interno; ?>">
    <button type="submit" onclick="preparar()">Aceitar</button>
</form>
<hr>
<div id="resultado">
    Clique em "Sortear"
</div>

<script>
/*
		//Sorteia os membros com exclusão de recusados
// passa os dados do php pro javascript
let ext_area_sub = <?php //echo json_encode($ext_area_sub); ?>;
let ext_area = <?php //echo json_encode($ext_area); ?>;
let int_area = <?php //echo json_encode($int_area); ?>;

// verifica os membros que já foram recusados
let usados = [];
let bancaAtual = null;


// sorteia a banca
function sortear() {

	//remove os membros que já foram recusados do sorteio
    let ext_sub_disp = ext_area_sub.filter(x => !usados.includes(x));
    let ext_disp = ext_area.filter(x => !usados.includes(x));
    let int_disp = int_area.filter(x => !usados.includes(x));
	//verifica se possui membros o suficiente para sortear
    if (ext_sub_disp.length < 1 || ext_disp.length < 2 || int_disp.length < 1) {
        document.getElementById("resultado").innerHTML = "Sem combinações possíveis";
        return;
    }
    let presidente = ext_sub_disp[Math.floor(Math.random() * ext_sub_disp.length)];
	
    let pool = [...new Set([...ext_sub_disp, ...ext_disp])];
    pool = pool.filter(x => x !== presidente);

    let ext1 = pool[Math.floor(Math.random() * pool.length)];
    let ext2;

    do {
        ext2 = pool[Math.floor(Math.random() * pool.length)];
    } while (ext2 === ext1);

    let interno = int_disp[Math.floor(Math.random() * int_disp.length)];

    bancaAtual = {interno, presidente, ext1, ext2};

    document.getElementById("resultado").innerHTML =
        `Interno: ${interno}<br>
         Presidente: ${presidente}<br>
         Externo 1: ${ext1}<br>
         Externo 2: ${ext2}`;
}


// re-sorteio
function recusar() {
    if (!bancaAtual) return;

    usados.push(
        bancaAtual.interno,
        bancaAtual.presidente,
        bancaAtual.ext1,
        bancaAtual.ext2
    );

    sortear(); // 🔥 já sorteia automaticamente
}


// aceitou banca
function preparar() {
    document.getElementById("dados").value = JSON.stringify(bancaAtual);
}

//sorteia automatico ao abrir a pagina
window.onload = function() {
    sortear();
};*/
</script>


<script>
		//Sem exclusão de membros sorteados
// dados do PHP
let ext_area_sub = <?php echo json_encode($ext_area_sub); ?>;
let ext_area = <?php echo json_encode($ext_area); ?>;
let int_area = <?php echo json_encode($int_area); ?>;
let ife = <?php echo json_encode($ifes_interno); ?>; 

let bancaAtual = null;


// Sorteio
function sortear() {
	//verifica se há membros possiveis para sortear
    if (((ext_area_sub.length + ext_area.length) < 3) || int_area.length < 1) {
        document.getElementById("resultado").innerHTML = "Sem candidatos suficientes";
        return;
    }

    // presidente
    let presidente = ext_area_sub[Math.floor(Math.random() * ext_area_sub.length)];

    // pool externos
    let pool = [...new Set([...ext_area_sub, ...ext_area])];
    pool = pool.filter(x => x !== presidente);

    if (pool.length < 2) {
        document.getElementById("resultado").innerHTML = "Sem externos suficientes";
        return;
    }

    // externo 1 e 2 (sem repetir entre eles)
    let ext1 = pool[Math.floor(Math.random() * pool.length)];
    let ext2;

    do {
        ext2 = pool[Math.floor(Math.random() * pool.length)];
    } while (ext2 === ext1);

    // interno
    let interno = int_area[Math.floor(Math.random() * int_area.length)];

    bancaAtual = {interno, presidente, ext1, ext2};

    document.getElementById("resultado").innerHTML =
        `Interno: ${interno}<br>
         Presidente: ${presidente}<br>
         Externo 1: ${ext1}<br>
         Externo 2: ${ext2}`;
}

// recusar = resortear
function recusar() {
    sortear(); // 🔥 apenas sorteia novamente
}

// aceitar banca
function preparar() {
    document.getElementById("dados").value = JSON.stringify(bancaAtual);
}

//sorteio automatico da primeira banca ao abrir a pagina
window.onload = function() {
    sortear();
};
</script>

</body>
</html>