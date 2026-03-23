<?php
	include "fn_AcessoBancoDados.php";

	$link = fnConectaBancoDados();
	$siapeCPPD = "-1";

	if (!empty($_POST)) {
		$siapeCPPD = htmlspecialchars($_POST["siapeCPPD"]);
		$senha = htmlspecialchars($_POST["senha"]);
	}
	else {
		fnDesconectaBD($link);
		header("Location: CPPD_login.php?siapeCPPD=$siapeCPPD");
		return;
	}

	$query = "SELECT senha,siapeCPPD FROM TabAcessoCPPDs WHERE siapeCPPD='$siapeCPPD'";
	$result = mysqli_query($link, $query);
	$numlinhas = mysqli_num_rows($result);
	if ($numlinhas > 0) {
		$row = mysqli_fetch_assoc($result);
		$password = $row["senha"];
		// Verify the hash code against the unencrypted password entered 
		$verify = password_verify($senha, $password);
		if ($verify) {
			//echo nl2br("Verificação de senha OK \n");
			$siapeCPPD = $row["siapeCPPD"];
			fnDesconectaBD($link);
			header("Location: index.php?siapeCPPD=$siapeCPPD");
			return;		
		}
		else {
			// Senha incompatível
			fnDesconectaBD($link);
			$siapeCPPD = "-1";
			header("Location: CPPD_login.php?siapeCPPD=$siapeCPPD");
			return;
		}	  
	}
	else {
		//echo nl2br("Linhas encontradas na tabela: " . $numlinhas . "\n");
		fnDesconectaBD($link);
		$siapeCPPD = "-1";
		header("Location: CPPD_login.php?siapeCPPD=$siapeCPPD");
		return;
	}	  

	fnDesconectaBD($link);
//	header("Location: index.php");
?>
</body>
</html>