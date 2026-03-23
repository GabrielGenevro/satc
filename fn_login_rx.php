<?php
	include "menu.php";
//	include "fn_AcessoBancoDados.php";

	$siape = -1;

	if (!empty($_POST)) {
		$email = htmlspecialchars($_POST["email"]);
		$senha = htmlspecialchars($_POST["senha"]);
	}
	else {
		header("Location: fn_login.php?siape=$siape");
		return;
	}
	$link = fnConectaBancoDados();
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
			//cria sessão
			session_start();
			$_SESSION["siape"] = $siape;
			$_SESSION["logado"] = true;
			// verifica se existe página salva e redireciona para ela
			if (isset($_SESSION["redirect_after_login"])) 
				{
					$redirect = $_SESSION["redirect_after_login"];
					unset($_SESSION["redirect_after_login"]);
					header("Location: $redirect");
				} 
			else 
				{
					header("Location: index.php");
				}
			fnDesconectaBD($link);
			header("Location: index.php");
			exit;
		}
		fnDesconectaBD($link);
		header("Location: fn_login.php?siape=$siape");
		return;
	}
	//echo nl2br("Linhas encontradas na tabela: " . $numlinhas . "\n");
	fnDesconectaBD($link);
	header("Location: fn_login.php?siape=$siape");
	return;
?>
</body>
</html>