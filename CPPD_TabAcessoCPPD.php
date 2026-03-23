<?php
// Cadatra as áreas e subárea de conhecimento no banco de dados

include "fn_AcessoBancoDados.php";
include "fn_tabelas.php";

$link = fnConectaBancoDados();
fnCadastroTabAcessoCPPDs($link);

$query = "SELECT * FROM TabAcessoCPPDs";
$result = mysqli_query($link, $query);
$numlinhas = mysqli_num_rows($result);
if ($numlinhas == 0) {
	$docente = "Marcio Doniak";
	$siapeCPPD = "16671719";
	$emailCPPD = "cppd.secretaria@ifsc.edu.br";
	$ife = "IFSC";
	$senha = "1";
	$password = password_hash($senha, PASSWORD_DEFAULT);
	$telefone = "(48) 98843 6221";

	$query = "INSERT INTO TabAcessoCPPDs (id,docente,siapeCPPD,emailCPPD,ife,senha,telefone) VALUES (NULL,'$docente','$siapeCPPD','$emailCPPD','$ife','$password','$telefone')";
	$result = mysqli_query($link, $query) or die("Bad Query: $query");
}
fnDesconectaBD($link);
header("Location: index.php");
?>