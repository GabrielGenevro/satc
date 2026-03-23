<?php
	include "fn_AcessoBancoDados.php";

	$link = fnConectaBancoDados();

	if (!empty($_POST)) {
		$siape = htmlspecialchars($_POST["siape"]);
		$subarea = htmlspecialchars($_POST["subarea"]);
		$titulacao = htmlspecialchars($_POST["titulacao"]);
		$telefone = htmlspecialchars($_POST["telefone"]);
		
		$query = "SELECT * FROM TabAvaliador WHERE siape=$siape";
		$result = mysqli_query($link, $query);
		$numlinhas = mysqli_num_rows($result);
		if ($numlinhas > 0) { 
			$query = "UPDATE TabAvaliador SET subarea='$subarea',titulacao='$titulacao',telefone='$telefone' WHERE siape=$siape";
			$result = mysqli_query($link, $query) or die("Bad Query: $query");
		}
		else {
			fnDesconectaBD($link);
			header("Location: index.php");
			return;
		}
	}
	fnDesconectaBD($link);
	header("Location: index.php?siape=$siape");
?>
</body>
</html>