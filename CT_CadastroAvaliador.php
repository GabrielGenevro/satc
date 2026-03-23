<?php
	//inicia a sessão
	session_start();
	//se não estiver logado leva a tela de login
	if (isset($_SESSION["logado"])) 
		{
			//passando a pagina atual para o login
			header("Location: index.php");
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
  			<h2 class="text-center" align="center">Cadastro do avaliador</h2>
		</div>
		<hr>
    </div>	

	<div class="container">
		<form action="CT_CadAvaliadorCompl.php" method="post">
		<div class="row text-center">
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Nome completo</h5>
						<input required="required" type="text" id="nome" name="nome"><br>
					</div>
				</div>
			</div>
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Matrícula SIAPE</h5>
						<input required="required" type="text" id="siape" name="siape"><br>
					</div>
				</div>
			</div>
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">E-mail institucional</h5>
						<input required="required" type="email" id="email" name="email"><br>
					</div>
				</div>
			</div>
		</div>
		<div class="row text-center"> 
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">IFes</h5>
						<select class="s_ifes" required="required" type="text" id="ifes" name="ifes">
							<option value="">Selecione o IF</option>
<?php
							$query = "SELECT * FROM tabifes ORDER BY id";
							$result = mysqli_query($link, $query);
							$numrows = mysqli_num_rows($result);
							
							for ($nCampus = 1; $nCampus <= $numrows; $nCampus++) {
								$row = mysqli_fetch_assoc($result);
								$ifes_id = $row['id'];
								$v_ifes = $row['instituto'];
//								echo nl2br("Campus: " . $campus . "\n");
?>
							<option value="<?php echo $ifes_id?>"><?php echo $v_ifes;?></option>
<?php
							}
?>
						</select><BR>
					</div>
				</div>
			</div>		
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Campus</h5>
						<select class="s_campus" required="required" type="text" id="campus" name="campus">
							<option value=""> Selecione o Campus </option>
								<script>
								$(function() {
									$('.s_ifes').change(function() {
										var select = $('.s_campus').empty().append('<option value="">Selecione o Campus</option>');
										
										$.getJSON('script_campus.php', { ifes: $(this).val() }, function(result) {

											$.each(result, function(i, item) {
												$('<option>', {
													value: item.value,
													text: item.name
												}).appendTo(select);
											});
										});
									});
								});
								</script>
						</select><BR>
					</div>
				</div>
			</div>		
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Nível atual da carreira docente</h5>
						<input required="required" type="text" id="nivel" name="nivel"><br>
					</div>
				</div>
			</div>
		</div>
		<div class="row text-center"> 
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Área de conhecimento</h5>
						<select required="required" class="s_area" type="text" id="area" name="area">
							<option value="">Selecione a área</option>
<?php
							$query = "SELECT * FROM TabAreaConhecimento ORDER BY Area";
							$result = mysqli_query($link, $query);
							$numrows = mysqli_num_rows($result);
							
							for ($nArea = 1; $nArea <= $numrows; $nArea++) {
								$row = mysqli_fetch_assoc($result);
								$AreaConhec_id = $row['id'];
								$AreaConhec = $row['area'];
//								echo nl2br("Área: " . $AreaConhec . "\n");
?>
							<option value="<?php echo $AreaConhec_id?>"><?php echo $AreaConhec;?></option>
<?php							
							}
?>
						</select><BR>
					</div>
				</div>
			</div>
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Subárea de conhecimento</h5>
						<select required="required" class="s_subarea" type="text" id="subarea" name="subarea">
							<option value="">Selecione a subárea</option>
								<script>
								$(function() {
									$('.s_area').change(function() {
										var select = $('.s_subarea').empty().append('<option value="">Selecione a subárea</option>');
										$.getJSON('/CT_BancaAval/script_subarea.php', { areas: $(this).val() }, function(result) {

											$.each(result, function(i, item) {
												
												$('<option>', {
													value: item.value,
													text: item.name
												}).appendTo(select);
											});
										});
									});
								});
								</script>
						</select><BR>
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
		</div>
		<div class="row text-center">
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Telefone</h5>
						<input type="tel" maxlength="15" placeholder="(99) 99999-9999" autocomplete="off" id="telefone" name="telefone"><br>
					</div>
				</div>
			</div>
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Salvar o cadastro</h5>
						<input type="submit" class="btn btn-primary" value="Cadastrar"><br>
					</div>
				</div>
			</div>
		</div>
		</div>
		</form>
    </div>
	  
<?php

	include "rodape.php";
	fnDesconectaBD($link)
?>
<script src="js/telefone.js"></script>
</body>
</html>