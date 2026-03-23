<!DOCTYPE html>
<html lang="pt-br">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Avaliadores Classe Titular</title>
    <!-- Bootstrap -->
    <link href="../css/bootstrap-4.4.1.css" rel="stylesheet">
  </head>
  <body>
<?php
	include "menuFuncoes.php";
	include "AcessoBancoDados.php";

	$link = fnConectaBancoDados();
	$siape = -1;

	if (!empty($_POST)) {
		$email = htmlspecialchars($_POST["email"]);
		$senha = htmlspecialchars($_POST["senha"]);
	}
	else {
		fnDesconectaBD($link);
		header("Location: login.php?siape=$siape");
		return;
	}

	$query = "SELECT senha,siape FROM TabAvaliador WHERE email='$email'";
	$result = mysqli_query($link, $query);
	$numlinhas = mysqli_num_rows($result);
	if ($numlinhas > 0) {
		$row = mysqli_fetch_assoc($result);
		$password = $row["senha"];
		// Verify the hash code against the unencrypted password entered 
		$verify = password_verify($senha, $password); 
		// Print the result depending if they match 
		if ($verify) {
			echo nl2br("Verificação de senha OK \n");
			$siape = $row["siape"];
			fnDesconectaBD($link);
			header("Location: ../index.php?siape=$siape");
			return;		
		}
		$siape = $row["siape"];
		fnDesconectaBD($link);
		//header("Location: login.php?siape=$siape");
		//return;
	}
	else {
		//echo nl2br("Linhas encontradas na tabela: " . $numlinhas . "\n");
		fnDesconectaBD($link);
		header("Location: login.php?siape=$siape");
		return;
	}	  

	include "rodape.php";
	fnDesconectaBD($link);
?>
</body>
</html>