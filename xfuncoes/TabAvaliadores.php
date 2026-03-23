<?php
// Cadatra as áreas e subárea de conhecimento no banco de dados

include "AcessoBancoDados.php";
include "tabelas.php";

$link = fnConectaBancoDados();
fnTabCadastroAvaliador($link);

header("Location: ../index.php");
?>