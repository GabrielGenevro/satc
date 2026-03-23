<!DOCTYPE html>
<?php
include "funcoes/AcessoBancoDados.php";
if(isset($_GET["siape"])) {
	$siape = $_GET["siape"];
}
else {
	$siape = "0";
}
if(isset($_GET["siapeCPPD"])) {
	$siapeCPPD = $_GET["siapeCPPD"];
}
else {
	$siapeCPPD = "0";
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
	<a class="navbar-brand" href="index.php?siape=<?php echo $siape;?>"><img class="w-50" src="images/CPPD.png"></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	  <ul class="navbar-nav mr-auto">
		<!--
		<li class="nav-item active">
		  <a class="nav-link" href="index.php?siape=<?php //echo $siape;?>">Home <span class="sr-only">(current)</span></a>
		</li>
		-->
<?php
		if (strcmp($siape,"0") == 0) {
?>
			<li class="nav-item active">
		  		<a class="nav-link" href="funcoes/login.php">Avaliador</a>
<?php
		}
		else {
			$link = fnConectaBancoDados();
			$query = "SELECT nome FROM TabAvaliador WHERE siape=$siape";
			$result = mysqli_query($link, $query);
			$numlinhas = mysqli_num_rows($result);
			if ($numlinhas > 0) {
				$row = mysqli_fetch_assoc($result);
				$nome = $row["nome"];
?>
				<li class="nav-item active dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $nome;?></a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="CT_CadAvaliador_Alteracao.php">Atualize o cadastro</a>
					</div>
<?php
			}
			else {
?>
				<li class="nav-item active">
					<a class="nav-link" href="funcoes/login.php">Avaliador</a>
<?php
			}
			fnDesconectaBD($link);
		}
?>
		</li>
		<li class="nav-item dropdown">
		  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cadastro</a>
		  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<a class="dropdown-item" href="CT_CadastroAvaliador.php">Novo cadastro</a>
		  	<a class="dropdown-item" href="CT_CadAvaliador_Alteracao.php">Atualize o cadastro</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#">Ver avaliadores</a>
		  </div>
		</li>
		<li class="nav-item dropdown">
		  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CPPD</a>
		  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
<?php
			if (strcmp($siapeCPPD,"0") == 0) {
?>				
				<a class="dropdown-item" href="CPPD/CPPD_login.php">Login CPPD</a>
<?php			
			}
			else {
?>				
				<a class="dropdown-item" href="#">Sorteio</a>
				<a class="dropdown-item" href="#">Alteração Comissão Especial</a>
			    <a class="dropdown-item" href="#">Comissões concluídas</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#">Alteração de cadastro</a>
<?php
			}
?>
		  </div>
		</li>
		<li class="nav-item dropdown">
		  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Informações</a>
		  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<a class="dropdown-item" href="#">Política de Privacidade</a>
			<a class="dropdown-item" href="#">Tutorial</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#">Contato</a>
		  </div>
		</li>			  
	  </ul>
<!--			
	  <form class="form-inline my-2 my-lg-0">
		<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	  </form>
-->
	</div>
  </div>
</nav>
