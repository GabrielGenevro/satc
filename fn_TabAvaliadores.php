<?php
// Cadatra as áreas e subárea de conhecimento no banco de dados

include "fn_AcessoBancoDados.php";
include "fn_tabelas.php";

$link = fnConectaBancoDados();
fnTabCadastroAvaliador($link);

header("Location: index.php");
?>