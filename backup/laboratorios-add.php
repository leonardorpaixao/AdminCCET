<?php
	include 'topo.php';
?>
<title>AdminDcomp - Adicinar Laboratório</title>
</head>
<?php
	if(!$_SESSION['logado'] || $_SESSION['nivel'] > 1){
		header('Location: /inicio');
	} 
	include 'barra.php';
	include 'menu.php';
	$_SESSION['irPara'] = '/inicio';
?>
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Adicionar Laboratório <small>Recursos</small>
			</h1>
		</section>

		<!-- Main content -->
		<section class="content">
	    	<!-- Default box -->
			<div class="box" id="box" >
				<form role="form" action="post.php" method="post" name-"formulario" id="formulario" class="formulario">
					<input type="hidden" id="numPost" name="numPost" value="12"><!-- Número correspodente ao post -->
					<div class="box-body">
						<div class="form-group col-xs-6">
							<label for="nome">Nome</label> 
							<input type="text" class="form-control" min="1" name="nome" id="nome">
						</div>
						<div class="form-group col-xs-6">
							<label for="pcs">Quantidade de computadores</label> 
							<input type="number" class="form-control" name="pcs" id="pcs">
						</div>
						<div class="form-group col-xs-6">
							<label for="capacidade">Capacidade máxima (pessoas)</label> 
							<input type="number" class="form-control" name="capacidade" id="capacidade">
						</div>
						<div class="form-group col-xs-6">
							<label for="status">Status</label> 
							<select name="status" class="form-control">
								<option value="Ativo">Ativo</option>
								<option value="Inativo">Inativo</option>
							</select>
						</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.form.submit();">Adicionar</button>
						<a href="/recursos/laboratorios"<span class="btn btn-default">Cancelar</span></a>
					</div>
				</form>
			</div><!-- /.box -->
		</section><!-- /.content -->
	</div>
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
