<?php
include "cabecalho.php";
include "menu.php";

if(isset($_GET["siapeCPPD"])) {
	$siapeCPPD = $_GET["siapeCPPD"];
	if (strcmp($siapeCPPD,"-1") == 0) {
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
  			<h2 class="text-center" align="center">Faça o login como membro da CPPD ou DGP</h2>
		</div>
		<hr>
    </div>

	<div class="container">
		<form action="CPPD_login_rx.php" method="post">
		<div class="row text-center">
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Siape</h5>
						<input required="required" type="text" id="siapeCPPD" name="siapeCPPD"><br>
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
	  
    <div class="container">
      <div class="row text-center">
        <div class="col-md-4 pb-1 pb-md-0">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ainda não possui cadastro!</h5>
              <p class="card-text">Solicite o cadastro de sua instituição para a CPPD do IFSC, que é a administradora do aplicativo.</p>
              <a href="CPPD_SolicitaAcesso.php" class="btn btn-primary">Solicite acesso</a>
            </div>
          </div>
        </div>
    </div>
	  
	  
<?php
	include "rodape.php";
?>
</body>
</html>