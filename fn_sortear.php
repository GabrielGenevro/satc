<html>
<body>
<?php

	include "cabecalho.php";
	include "menu.php";
	include_once constantes.php;

	
	$link = fnConectaBancoDados();
	

	if (!empty($_POST)) {
		//$campus = htmlspecialchars($_POST["campus"]);
		$ifes_interno = htmlspecialchars($_POST["ifes_interno"]);
		$area = htmlspecialchars($_POST["area"]);
		$subarea = htmlspecialchars($_POST["subarea"]);
	}
	
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
    if (((ext_area_sub.length + ext_area.length) < 3) || int_area.length < 1) 
		{
        	document.getElementById("resultado").innerHTML = "Sem candidatos suficientes";
        	return;
    	}
	else
		{
			// presidente
			let presidente = ext_area_sub[Math.floor(Math.random() * ext_area_sub.length)];
			// pool externos, junta os membros externos somente com area e os com subarea e retira o predisente do sorteio
			let pool = [...new Set([...ext_area_sub, ...ext_area])];
			pool = pool.filter(x => x !== presidente);
			// sorteia externo 1 e 2 (sem repetir entre eles)
			let ext1 = pool[Math.floor(Math.random() * pool.length)];
			let ext2;
			do 
				{
					ext2 = pool[Math.floor(Math.random() * pool.length)];
				} while (ext2 === ext1);
			// interno
			let interno = int_area[Math.floor(Math.random() * int_area.length)];
			bancaAtual = {interno, presidente, ext1, ext2};
			//mostra os ids
			document.getElementById("resultado").innerHTML =
				`Interno: ${interno}<br>
				Presidente: ${presidente}<br>
				Externo 1: ${ext1}<br>
				Externo 2: ${ext2}`;
		}

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