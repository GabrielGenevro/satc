<?php

function fnConectaBancoDados () {
	include "Acesso.php";
	$link = mysqli_connect($server,$user,$senha,$bancodados);   
	return $link;
}

function fnCriaBancoDados() {
	include "Acesso.php";
	
	$serv = mysqli_connect($server,$user,$senha);
	if (!$serv) {
		die('Não conseguiu conectar ao servidor: ' . mysql_error());
//		echo nl2br('Não conseguiu conectar ao servidor: ' . mysql_error() . "\n");
	}	
	// cria o banco de dados
	mysqli_query($serv,"CREATE DATABASE IF NOT EXISTS $bancodados");
}

function fnDesconectaBD($link) {
	mysqli_close($link);
}


?>