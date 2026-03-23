<?php
// Cadatra as áreas e subárea de conhecimento no banco de dados

include "AcessoBancoDados.php";
include "tabelas.php";
include "FuncoesBancoDados.php";


fnCriaBancoDados();
$link = fnConectaBancoDados ();

// Cria as tabelas:
fnAreaConhecimento($link);
fnSubAreaConhec($link);

// Preenche as tabelas:
fnCadastraAreaConhecimento($link);
fnCadastraSubAreaConhec($link);

header("Location: ../index.php");
?>