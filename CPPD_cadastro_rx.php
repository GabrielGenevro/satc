<?php
	include "cabecalho.php";
	include "menu.php";
	
	$link = fnConectaBancoDados();
	
	if (!empty($_POST)) 
		{
			$siape = htmlspecialchars($_POST["siape"]);
			$nome = htmlspecialchars($_POST["nome"]);
			$campus = htmlspecialchars($_POST["campus"]);
			$ifes = htmlspecialchars($_POST["ifes"]);
			$email = htmlspecialchars($_POST["email"]);
			$senha = htmlspecialchars($_POST["senha"]);
			$password = password_hash($senha, PASSWORD_DEFAULT);
			$telefone = htmlspecialchars($_POST["telefone"]);	

			//inserção no tabcppd
			$query = "INSERT INTO TabCppd (id, nome, siape, email, ife, campus, senha) VALUES (NULL, '$nome', '$siape', '$email', '$ifes' ,  '$campus', '$password', '$telefone')";
			$result = mysqli_query($link, $query) or die("Bad Query: $query");
		}
?>