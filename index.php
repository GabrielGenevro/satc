<?php
	  include "cabecalho.php";
	  include "menu.php";
?>
<!--	  
    <div class="container mt-3">
      <div class="row">
		  <div class="col-12" align="center">
			<img class="d-block w-25" src="images/CPPD.png">
		  </div>
      </div>
      <hr>
    </div>
-->	  
    <div class="container">
      <div class="row">
		  <br>
		  <h2 align="center">Cadastro de avaliadores para compor a Comissão Especial de avaliação, por meio de Memorial Descritivo, em pedidos de ascensão à Classe Titular</h2>
      </div>
    </div>
    
    <div class="container">
	<hr>
      <div class="row text-center">
        <div class="col-md-4 pb-1 pb-md-0">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Área de Conhecimento</h5>
              <p class="card-text">Cadastra as áreas e subáreas de conhecimento no banco de dados. Só precisa fazer isto uma vez!</p>
              <a href="fn_CadastraAreaConhecimento.php" class="btn btn-primary">Cadastra Áreas de Conhecimento</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 pb-1 pb-md-0">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tabela Avaliadores</h5>
              <p class="card-text">Cria a tabela com o cadastro de avaliadores no banco de dados</p><br>
              <a href="fn_TabAvaliadores.php" class="btn btn-primary">Tabela Avaliadores</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 pb-1 pb-md-0">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Cria a Tabela de Acesso das CPPD</h5>
              <p class="card-text">Cria a tabela que vai ter o cadastro de acesso de todas as CPPDs ao aplicativo.</p><br>
              <a href="CPPD_TabAcessoCPPD.php" class="btn btn-primary">Tabela de CPPDs</a>
            </div>
          </div>
        </div>
      </div>
	  
<?php
	include "rodape.php";
?>
  </body>
</html>