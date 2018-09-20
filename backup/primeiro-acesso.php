<?php 
  	include 'topo.php';
  	if(!$_SESSION['logado'] || mysql_num_rows(mysql_query("SELECT idUser FROM tbPrimeiroAcesso WHERE idUser='".$_SESSION['id']."'")) == 0){
		header('Location: index.php');
	}
?>
<title>AdminDcomp - Primeiro Acesso</title>
</head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue layout-top-nav">
    <div class="wrapper">

      	<header class="main-header">
	        <nav class="navbar navbar-static-top">
	          	<div class="container">
		            <div class="navbar-header">
		              <a href="" class="navbar-brand"><b>Admin</b>DCOMP</a>
		              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
		                <i class="fa fa-bars"></i>
		              </button>
		            </div>
	            	<!-- Navbar Right Menu -->
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
				              <!-- User Account: style can be found in dropdown.less -->
				            <li class="dropdown user user-menu">
				                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				                  <img src="img/sem-imagem-avatar.jpg" class="user-image" alt="User Image"/>
				                  <span class="hidden-xs"><?php echo $_SESSION['nome'] ?></span>
				                </a>
				                <ul class="dropdown-menu">
				                  <!-- User image -->
				                	<li class="user-header">
					                    <img src="img/sem-imagem-avatar.jpg" class="img-circle" alt="User Image" />
					                    <p>
					                      <?php echo $_SESSION['nome'] ?>
					                    </p>
				                  	</li>
					                  <!-- Menu Footer-->
					                <li class="user-footer">
					                    <div class="pull-left">
					                      	<a href="configuracao.php" class="btn btn-default btn-flat disabled">Configurações</a>
					                    </div>
					                    <div class="pull-right">
					                	    <a href="sair.php" class="btn btn-default btn-flat">Sair</a>
					                    </div>
					                </li>
				                </ul>
				            </li>
				        </ul>
					</div><!-- /.navbar-custom-menu -->
	          	</div><!-- /.container-fluid -->
	        </nav>
    	</header>
      	<!-- Full Width Column -->
      	<div class="content-wrapper">
	        <div class="container">
	          <!-- Content Header (Page header) -->
	          	<section class="content-header">
		            <h1>
		            	Primeiro Acesso		            
		            </h1>
	          	</section>
				<!-- Main content -->
				<section class="content">
					<?php
				        if(isset($_SESSION['errorPriAcesso'])):
				        	if($_SESSION['errorPriAcesso'] == 1):
				    ?>
					            <div class="callout callout-danger">
					              <h4>Não foi escolhido novo login!</h4>
					              <p>Novo login é obrigatório!</p>
					            </div>
				    <?php
				          	else:
				    ?>
					            <div class="callout callout-danger">
					              <h4>Senhas não conhecidem!</h4>
					            </div>
				    <?php
				          	endif;
				        unset($_SESSION['errorPriAcesso']);
				        endif;
				    ?>
		        	<div class="box box-solid">
            			<div class="box-header with-border">
              				<h3 class="box-title">Bem Vindo</h3>
            			</div><!-- /.box-header --> 
            			<div class="box-body" id="form">
            				<form action="post.php" method="POST" id="formulario">
            					<input type="hidden" id="numPost" name="numPost" value="23"><!-- Número correspodente ao post --> 
	            				<div class="form-group">
	            					<label>Selecionar novo Login:</label>
		            				<?php
		              					$aux = Atalhos::gerarLogin();
		              					$aux = explode(" ", $aux);
		              					$num = count($aux);

		              					for($i = 1; $i <= $num; $i++){
		              						echo '<div class="radio">
						                    	<label>
						                    		<input type="radio" name="login" value="'.$aux[$i-1].'">
		              							'.$aux[$i-1].'<weak>'.Dominio.'</weak>
		              							</label></div>';
		              					}
		              				?>
		              			</div>
		              			<div class="form-group">
		              				<label>Digite nova Senha:</label>
		              				<a data-toggle="tooltip" <?php echo 'title="'.Senha.'"' ?>>
		              					<input type="password" class="col-xs-7 form-control" name="senha1" id="senha" maxlength="16"
		              					 onKeyUp="testaSenha(this.value);">
		              				</a>
		              			</div>
		              			<div id='seguranca'></div>
		              			<div class="form-group">
		              				<label>Confirma nova Senha:</label>
		              				<input type="password" class="form-control col-xs-6" name="senha2" id="senha2" maxlength="16"
		              				 onKeyUp="testaSenha2(this.value);">
		              			</div>
		              			<div id="confirmar"></div>
	            			</div>
	            			<div class="box-footer">
					        	<button type="submit" class="btn btn-primary">Concluir</button>
					        </div>
				        </form>
            		</div>   
	          	</section><!-- /.content -->
	        </div><!-- /.container -->
      	</div><!-- /.content-wrapper -->
	    <?php include 'rodape.php' ?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
   	<?php include 'script.php' ?>
   	<script type="text/javascript">
   		function verCaracterDaSenha(valor) {
		    var erespeciais = /[@!#$%&*+=?|-]/;
		    var ermaiuscula = /[A-Z]/;
		    var erminuscula = /[a-z]/;
		    var ernumeros   = /[0-9]/;
		    var cont = 0;
		   
		    if (erespeciais.test(valor)) cont++;
		    if (ermaiuscula.test(valor)) cont++;
		    if (erminuscula.test(valor)) cont++;
		    if (ernumeros.test(valor))   cont++;
		    return cont;
		  }
		   
		  function segurancaBaixa(d) {
		    d.innerHTML = '<h4>Seguranca da senha: <font color=\'red\'>  BAIXA</font></h4>';
		  }
		  function segurancaMedia(d) {
		    d.innerHTML = '<h4>Seguranca da senha: <font color=\'orange\'>  MEDIA</font></h4>';
		  }
		  function segurancaAlta(d) {
		    d.innerHTML = '<h4>Seguranca da senha: <font color=\'green\'>  ALTA</font></h4>';
		  }
		   
		  function testaSenha(valor) {
		    var d = document.getElementById('seguranca');
		    var c = verCaracterDaSenha(valor);
		    var t = valor.length;
		   
		    if(t == ''){
		      d.innerHTML = "<h4>Seguranca da senha: !</h4>";
		    } else {
		      if(t > 7 && c >= 3) segurancaAlta(d);
		      else { 
		        if(t > 7 && c >= 2 || t > 4 && c >= 3) segurancaMedia(d);
		        else segurancaBaixa(d);
		      }
		    }  
		  }

		  function testaSenha2(senha2){
		    var d = document.getElementById('confirmar');
		    var senha = document.getElementById("senha").value;
		    if(senha2 == senha){
		    	d.innerHTML = '<h4><font color=\'green\'>Correta</font></h4>';
		    }else{
		    	d.innerHTML = '<h4><font color=\'red\'> Incorrenta</font></h4>';
		    }
		  }

		  $('#form').find('#formulario').submit(function() {
		    var senha = $.trim($(this).find('#senha').val());
		    var senha2 = $.trim($(this).find('#senha2').val());
		    if(senha.length < 8) {
		      alert("Senha tem menos de 8 digitos");
		      return false;
		    }else if(verCaracterDaSenha(senha) == 1){
		      alert("Senha com baixa segurança");
		      return false;
		    }else if(senha != senha2){
		      alert("Senhas não conhecidem");
		      return false;
		    }
		  });
   	</script>
  </body>
</html>
