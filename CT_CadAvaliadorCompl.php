<?php
	include "cabecalho.php";
	include "menu.php";
	
	$link = fnConectaBancoDados();
	
	if (!empty($_POST)) {
		$siape = htmlspecialchars($_POST["siape"]);
		$nome = htmlspecialchars($_POST["nome"]);
		$campus = htmlspecialchars($_POST["campus"]);
		$ifes = htmlspecialchars($_POST["ifes"]);
		$email = htmlspecialchars($_POST["email"]);
		$senha = htmlspecialchars($_POST["senha"]);
		$password = password_hash($senha, PASSWORD_DEFAULT);
		$telefone = htmlspecialchars($_POST["telefone"]);
		$area = htmlspecialchars($_POST["area"]);
		$subarea = htmlspecialchars($_POST["subarea"]);
		$nivel = htmlspecialchars($_POST["nivel"]);
		
		if ($numlinhas == 0) { 
			$query = "INSERT INTO TabAvaliador (id, nome, siape, email, ife, campus, senha, area, subarea, nivel, telefone, bancas_ano) VALUES (NULL, '$nome', '$siape', '$email', '$ifes' ,  '$campus', '$password','$area', '$subarea','$nivel', '$telefone', 0)";
			
			$result = mysqli_query($link, $query) or die("Bad Query: $query");
		}
	}
?>
	<div class="container">
		<div class="row text-center">
  			<br>
  			<h2 class="text-center">Cadastro complementar do avaliador</h2>
		</div>
		<hr>
    </div>

	<div class="container">
		<form action="CT_CadAvaliadorCompl_RX.php" method="post">
		<div class="row text-center">
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Telefone</h5>
						<input type="text" id="telefone" name="telefone"><br>
					</div>
				</div>
			</div>			
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">SubÁrea de conhecimento</h5>
						<select type="text" id="subarea" name="subarea">
							<option value="">Selecione a SubÁrea</option>
<?php							
							$query = "SELECT * FROM TabSubAreaConhec WHERE area='$area' ORDER BY subarea";
							$result = mysqli_query($link, $query);
							$numrows = mysqli_num_rows($result);
							
							for ($nArea = 1; $nArea <= $numrows; $nArea++) {
								$row = mysqli_fetch_assoc($result);
								$SubArea = $row['subarea'];
?>
								<option value="<?php echo $SubArea?>"><?php echo $SubArea;?></option>
<?php
							}
?>							
						</select><br>
					</div>
				</div>
			</div>
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Titulação</h5>
						<select type="text" id="titulacao" name="titulacao">
							<option value="">Selecione a titulação</option>
							<option value="Graudação">Graduação</option>
							<option value="Especialização">Especialização</option>
							<option value="Mestrado">Mestrado</option>
							<option value="Doutorado">Doutorado</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="row text-center">
			<div class="col-md-4 pb-1 pb-md-0">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Atualizar o cadastro</h5>
						<input type="hidden" id="siape" name="siape"value=<?php echo $siape;?>><br>
						<input type="submit" class="btn btn-primary" value="Atualizar"><br>
					</div>
				</div>
			</div>
		</div>
		</form>
    </div>
	  
<?php
	include "funcoes/rodape.php";
	fnDesconectaBD($link)
?>
</body>
</html>