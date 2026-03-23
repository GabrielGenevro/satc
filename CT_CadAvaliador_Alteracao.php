<?php
	//inicia a sessão
	session_start();
	//se não estiver logado leva a tela de login
	if (isset($_SESSION["logado"])) 
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

	$query = "SELECT * FROM TabAvaliador WHERE siape=$siape";
	$result = mysqli_query($link, $query);
	$numlinhas = mysqli_num_rows($result);
	if ($numlinhas > 0) {
		$row = mysqli_fetch_assoc($result);
		$nome = $row["nome"];
		$ife = $row["ife"];
		$email = $row["email"];
		$password = $row["senha"];
		$senha = password_hash($password, PASSWORD_DEFAULT);
		$area = $row["area"];
		$subarea = $row["subarea"];
		$titulacao = $row["titulacao"];
		$telefone = $row["telefone"];
		$nivel = $row["nivel"];
?>
	<div class="container">
		<div class="row text-center">
  			<br>
  			<h2 class="text-center"><?php echo $nome; ?> altere o seu cadastro de avaliador</h2>
		</div>
		<hr>
    </div>

	<div class="container">
		<div class="row text-center">
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<form action="CT_CadAvaliador_AlteraNome_RX.php" method="post">
						<h5 class="card-title">Nome completo</h5>
						<input required type="text" id="nome" name="nome" value="<?php echo $nome;?>"><BR><BR>
						<input type="submit" class="btn btn-primary" value="Atualiza o nome"><br>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Matrícula SIAPE</h5>
						<form action="CT_CadAvaliador_AlteraSiape_RX.php" method="post">
						<input required type="text" id="siape" name="siape" value="<?php echo $siape;?>"><br><br>
						<input type="submit" class="btn btn-primary" value="Atualiza o SIAPE">
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Instituto Federal</h5>
						<form action="CT_CadAvaliador_AlteraIFE_RX.php" method="post">
						<input required type="text" id="ife" name="ife" value="<?php echo $ife;?>"><br><br>
						<input type="submit" class="btn btn-primary" value="Atualiza o Instituto Federal">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row text-center">
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">E-mail instituicional</h5>
						<form action="CT_CadAvaliador_AlteraEmail_RX.php" method="post">
						<input required type="email" id="email" name="email" value="<?php echo $email;?>"><br><br>
						<input type="submit" class="btn btn-primary" value="Atualiza o e-mail">
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Telefone</h5>
						<form action="CT_CadAvaliador_AlteraTelefone_RX.php" method="post">
						<input required type="text" id="telefone" name="telefone"><br><br>
						<input type="submit" class="btn btn-primary" value="Atualiza o telefone">
						</form>
					</div>
				</div>
			</div>			
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Altere o seu nível de carreira</h5>
						<form action="CT_CadAvaliador_AlteraNivel_RX.php" method="post">
						<input required type="text" id="nivel" name="nivel"><br><br>
						<input type="submit" class="btn btn-primary" value="Atualiza o nível">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row text-center">
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Área de conhecimento</h5>
						<form action="CT_CadAvaliador_AlteraArea_RX.php" method="post">
						<select type="text" id="atuacao" name="atuacao">
							<option value="">Selecione a área</option>
<?php
							$query = "SELECT * FROM TabAreaConhecimento ORDER BY area";
							$result = mysqli_query($link, $query);
							$numrows = mysqli_num_rows($result);
							
							for ($nArea = 1; $nArea <= $numrows; $nArea++) {
								$row = mysqli_fetch_assoc($result);
								$AreaConhec = $row['area'];
//								echo nl2br("Área: " . $AreaConhec . "\n");
								if (strcmp($area,$AreaConhec) == 0) {
?>
									<option value="<?php echo $AreaConhec?>" selected><?php echo $AreaConhec;?></option>
<?php							
								}
								else {
?>
									<option value="<?php echo $AreaConhec?>"><?php echo $AreaConhec;?></option>
<?php									
								}
							}
?>
						</select><BR><br>
						<input type="submit" class="btn btn-primary" value="Atualiza a Área de Conhecimento">
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Sub-Área de conhecimento</h5>
						<form action="CT_CadAvaliador_AlteraSubArea_RX.php" method="post">
						<select type="text" id="subarea" name="subarea">
							<option value="">Selecione a sub-área</option>
<?php							
							$query = "SELECT SubArea FROM TabSubAreaConhec WHERE area='$area' ORDER BY subarea";
							$result = mysqli_query($link, $query);
							$numrows = mysqli_num_rows($result);
							
							for ($nArea = 1; $nArea <= $numrows; $nArea++) {
								$row = mysqli_fetch_assoc($result);
								$SubAreaBD = $row['subarea'];
								if (strcmp($SubAreaBD,$subarea)==0) {
?>
								<option value="<?php echo $SubAreaBD?>" selected><?php echo $SubAreaBD;?></option>
<?php
								}
								else {
?>
									<option value="<?php echo $SubAreaBD?>"><?php echo $SubAreaBD;?></option>
<?php
								}
							}
?>							
						</select><br><br>
						<input type="submit" class="btn btn-primary" value="Atualiza a sua Sub-Área">
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Titulação</h5>
						<form action="CT_CadAvaliador_AlteraTitulacao_RX.php" method="post">
						<select type="text" id="titulacao" name="titulacao">
							<option value="">Selecione a titulação</option>
<?php
							if (strcmp($titulacao,"Graduação") == 0) {
?>
								<option value="<?php echo $titulacao?>" selected><?php echo $titulacao;?></option>
<?php							
							} else {
?>
								<option value="Graduação">Graduação</option>
<?php
							}
							if (strcmp($titulacao,"Especialização") == 0) {
?>
								<option value="<?php echo $titulacao?>" selected><?php echo $titulacao;?></option>
<?php
							} else {
?>
								<option value="Especialização">Especialização</option>
<?php								
							}
							if (strcmp($titulacao,"Mestrado") == 0) {
?>
								<option value="<?php echo $titulacao?>" selected><?php echo $titulacao;?></option>
<?php
							} else {
?>
								<option value="Mestrado">Mestrado</option>
<?php								
							}
							if (strcmp($titulacao,"Doutorado") == 0) {
?>
								<option value="<?php echo $titulacao?>" selected><?php echo $titulacao;?></option>
<?php
							} else {
?>
								<option value="Doutorado">Doutorado</option>
<?php								
							}
?>							
						</select><br><br>
						<input type="submit" class="btn btn-primary" value="Atualiza a sua titulação">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row text-center">
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Altere a sua senha</h5>
						<form action="CT_CadAvaliador_AlteraSenha_RX.php" method="post">
						<input required type="password" id="senha" name="senha"><br><br>
						<input type="submit" class="btn btn-primary" value="Atualiza a senha">
						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
<?php 
	}
	else {
		fnDesconectaBD($link);
		header("Location: index.php?siape=0");
	}		
?>	  
<?php
	include "rodape.php";
	fnDesconectaBD($link);
?>
</body>
</html>