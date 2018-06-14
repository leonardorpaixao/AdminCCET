<?php
	include '../../includes/topo.php';
?>
<title>AdminDcomp - Editar Sala</title>
</head>
<?php
	if(!$_SESSION['logado'] || ($_SESSION['afiliacao'] != 4 && $_SESSION['afiliacao'] != 2)){
		header('Location: /inicio');
	} 
	include '../../includes/barra.php';
	include '../../includes/menu.php';
	$_SESSION['irPara'] = '/inicio';	
	$db = Atalhos::getBanco();
	if ($query = $db->prepare("SELECT nomeSala, numPessoa FROM tbSala WHERE idSala = ?")){
		$query->bind_param('i', $_GET['id']);
		$query->execute();
		$query->bind_result($nomeSala, $numPessoa);
		$query->fetch();
		$query->close();
		$db->close();
	}
?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Editar Sala <small>Recursos</small>
			</h1>
		</section>

		<!-- Main content -->
		<section class="content">
	          <!-- Default box -->
			<div class="box" id="box" >
				<form role="form" action="post/" method="post" name-"formulario" id="formulario">
					<input type="hidden" name="numPost" value="35"><!-- Número correspodente ao post -->
					<input type="hidden" name="idSala" <?php echo "value= ".$_GET['id']?> />
					<div class="box-body">
						<div class="form-group col-xs-6">
							<label for="nome">Nome:</label> 
							<input type="text" class="form-control" min="1" name="nome" id="nome"
								<?php echo "value= '".$nomeSala."'"?> />
						</div>
						<div class="form-group col-xs-6">
							<label >Capacidade de Pessoa:</label> 
							<input type="num" class="form-control" name="cap" id="cap"
								<?php echo "value= ".$numPessoa?> />
						</div>
					</div><!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Modificar</button>
						<a href="/recursos/salas"<span class="btn btn-default">Cancelar</span></a>
					</div>
				</form>
			</div><!-- /.box -->
		</section>	<!-- /.content -->
	</div><!-- /.content-wrapper -->
	<?php include '../../includes/rodape.php' ?>
</div><!-- ./wrapper -->
	<?php include '../../includes/script.php' ?>
	<script>
    $('#box').find('.formulario').submit(function() {
        var nome = $.trim($(this).find('#nome').val());
        var capacidade = $.trim($(this).find('#cap').val());
        
        
        if(!(nome.length != 0 && capacidade.length != 0)) {
            alert("Por favor, preencha todos os campos!");
            return false;
        }
    });

	</script>	
</body>
</html>
