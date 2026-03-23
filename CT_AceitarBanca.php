<?php
	//inicia a sessão
	session_start();
	//se não estiver logado leva a tela de login
	if (!isset($_SESSION["logado"])) 
		{
			//passando a pagina atual para o login
			$_SESSION["redirect_after_login"] = $_SERVER["REQUEST_URI"];
			header("Location: fn_login.php");
			exit;
		}
	$siape = $_SESSION["siape"];
	include "cabecalho.php";
	include "menu.php";
	$link = fnConectaBancoDados();
?>
	<div class="container">
		<div class="row text-center">
  			<br>
  			<h2 class="text-center" align="center">Confirmação da banca</h2>
		</div>
		<hr>
    </div>

	<div class="container">
		<form action="CT_AceitarBancaCompl.php" method="post">
		<div class="row text-center"> 
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Avaliador (Somente para teste)</h5>
						<select class="s_avaliador" required="required" id="avaliador" name="avaliador" onchange="carregarBanca(this.value)">
							<option value="">Selecione o Avaliador</option>
<?php
							$query = "SELECT * FROM tabavaliador where situacao = 'Sorteado' ORDER BY nome ";
							$result = mysqli_query($link, $query);
							$numrows = mysqli_num_rows($result);
							
							for ($nAvaliador = 1; $nAvaliador <= $numrows; $nAvaliador++) {
								$row = mysqli_fetch_assoc($result);
								$avaliador_id = $row['id'];
								$v_avaliador = $row['nome'];
?>
							<option value="<?php echo $avaliador_id?>"><?php echo $v_avaliador;?></option>
<?php
							}
?>
						</select><BR>
					</div>
				</div>
			</div>
		<div class="row text-center"> 
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Membros da Banca</h5>
							<!-- Script no final da pagina -->
							<div id="resultado_banca">
								<!-- Avaliadores da banca aparecem aqui -->
							</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Posição na banca</h5>
						<select required="required" class="s_posicao" type="text" id="posicao" name="posicao">
							<option value="Presidente">Presidente</option>
							<option value="Membro">Membro</option>
							<option value="Recusar">Recusar</option>
						</select><BR>
					</div>
				</div>
			</div>	
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Confirmar</h5>
						<input type="submit" class="btn btn-primary" value="Confirmar"><br>
					</div>
				</div>
			</div>
		</div>
		</div>
		</form>
    </div>
		<script>
			//Mostra os membros que estão na banca que o avaliador foi sorteado
			function carregarBanca(avaliadorId) {
				//caso não tenha um avaliador selecionado
				if (avaliadorId === "") 
					{
						document.getElementById("resultado_banca").innerHTML = "";
						return;
					}
				//procura no script pelo avaliador selecionado no select
				fetch("script_aceitar_banca.php?avaliador_id=" + avaliadorId).then(response => response.text()).then(data => 
					{
						document.getElementById("resultado_banca").innerHTML = data;
					})
				//caso der erro
				.catch(error => 
					{
						console.error("Erro:", error);
					});
			}
		</script>     
<?php
	include "rodape.php";
	fnDesconectaBD($link)
?>
</body>
</html>