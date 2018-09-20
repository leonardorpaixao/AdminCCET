<?php
	include 'topo.php';
?>
<title>AdminDcomp - Editar Laboratório</title>
</head>
<?php
	if(!$_SESSION['logado'] || $_SESSION['nivel'] > 1){
		header('Location: /inicio');
	} 
	include 'barra.php';
	include 'menu.php';
	$_SESSION['irPara'] = '/inicio';
	$db = Atalhos::getBanco();
	if($query = $db->prepare("SELECT a.nomeLab, a.capAluno, a.numComp, b.cor, a.idCor FROM tblaboratorio a 
		inner join tbcor b on b.idCor = a.idCor WHERE a.idLab = ?")){
		$query->bind_param('i', $_GET['id']);
		$query->execute();
		$query->bind_result($nome, $capAluno, $numComp, $cor, $idCor);
		$query->fetch();
		$query->close();
	}
?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Editar Laboratório <small>Recursos</small>
			</h1>
		</section>

		<!-- Main content -->
		<section class="content">
	          <!-- Default box -->
			<div class="box" id="box" >
				<form role="form" action="post.php" method="post" name-"formulario" id="formulario" class="formulario">
					<input type="hidden" name="numPost" value="16"><!-- Número correspodente ao post -->
					<input type="hidden" name="idLab" <?php echo "value= ".$_GET['id']?> />
					<input type="hidden" name="idCor" <?php echo "value= ".$idCor?> />
					<div class="box-body">
						<div class="form-group col-xs-6">
							<label for="nome">Nome</label> 
							<input type="text" class="form-control" min="1" name="nome" id="nome"
								<?php echo "value= '".$nome."'"?> />
						</div>
						<div class="form-group col-xs-6">
							<label for="pcs">Quantidade de computadores</label> 
							<input type="text" class="form-control" name="pcs" id="pcs"
								<?php echo "value= ".$numComp?> />
						</div>
						<div class="form-group col-xs-6">
							<label for="capacidade">Capacidade máxima (pessoas)</label> 
							<input type="text" class="form-control" name="capacidade" id="capacidade" 
								<?php echo "value= ".$capAluno?> />
						</div>
						<?php
							$db->close();
						?>
					</div><!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Modificar</button>
						<a href="/recursos/laboratorios"<span class="btn btn-default">Cancelar</span></a>
					</div>
				</form>
			</div><!-- /.box -->
		</section>	<!-- /.content -->
	</div><!-- /.content-wrapper -->
	<?php include 'rodape.php' ?>
</div><!-- ./wrapper -->
	<?php include 'script.php' ?>
    <script>
	    $('#box').find('.formulario').submit(function() {
	        var nome = $.trim($(this).find('#nome').val());
	        var pcs = $.trim($(this).find('#pcs').val());
	        var capacidade = $.trim($(this).find('#capacidade').val());
	        
	        if(!(nome.length != 0 && pcs.length != 0 && capacidade.length != 0)) {
	            alert("Por favor, preencha todos os campos!");
	            return false;
	        }
	    });

    </script>		
</body>
</html>
