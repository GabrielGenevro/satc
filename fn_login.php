<?php
	//inicia a sessão
	session_start();
	//se não estiver logado leva a tela de login
	if (isset($_SESSION["logado"])) 
		{
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
		}
	$siape = $_SESSION["siape"];
	include "cabecalho.php";
	include "menu.php";
	if(isset($_GET["siape"])) {
		$siape = $_GET["siape"];
		if (strcmp($siape,"-1") == 0) {
?>
	  		<div class="container">
				<div class="row text-center">
					<h4 style="color:#FF0000;">O seu login falhou, tente novamente.</h4>
				</div>
	  		</div>
<?php
		}
	}
?>
	<div class="container">
		<div class="row text-center">
  			<h2 class="text-center" align="center">Faça o login como avaliador</h2>
		</div>
		<hr>
    </div>

	<div class="container">
		<form action="fn_login_rx.php" method="post">
		<div class="row text-center">
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">E-mail</h5>
						<input required="required" type="text" id="email" name="email"><br>
					</div>
				</div>
			</div>
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Senha</h5>
						<input required="required" type="password" id="senha" name="senha"><br>
					</div>
				</div>
			</div>
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Acessar o aplicativo Avaliadores</h5>
						<input type="submit" class="btn btn-primary" value="Acessar"><br>
					</div>
				</div>
			</div>		
		</div>
		</form>
    </div>
	  
<?php
	include "rodape.php";
?>
</body>
</html>