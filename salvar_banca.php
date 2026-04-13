<?php
	include "cabecalho.php";
	include "menu.php";
$link = fnConectaBancoDados();

$dados = json_decode($_POST['dados'], true);

$interno = $dados['interno'];
$presidente = $dados['presidente'];
$ext1 = $dados['ext1'];
$ext2 = $dados['ext2'];
$ifes_interno = $_POST['ifes_interno'];

$sql = "INSERT INTO tabbanca 
(avaliador_interno, avaliador1, avaliador2, avaliador3, estado, resultado, instituto)
VALUES 
('$interno', '$presidente', '$ext1', '$ext2', 'Confirmada', 'apresentar', '$ifes_interno')";

mysqli_query($link, $sql);

$ids = implode(",", [$interno, $presidente, $ext1, $ext2]);

mysqli_query($link, "UPDATE tabavaliador SET situacao='Sorteado' WHERE id IN ($ids)");

echo "Banca salva com sucesso!";
?>