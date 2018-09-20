<?php
	include '../../includes/topo.php';
?>
<title>AdminDcomp - Editar Equipamento</title>
</head>
<?php
	if(!$_SESSION['logado'] || ($_SESSION['afiliacao'] != 4 && $_SESSION['afiliacao'] != 2)){
		header('Location: /inicio');
	} 
	include '../../includes/barra.php';
	include '../../includes/menu.php';
	$_SESSION['irPara'] = '/inicio';
	$db = Atalhos::getBanco();
	if($query = $db->prepare("SELECT modelo FROM tbequipamento WHERE patrimonio = ?")){
		$query->bind_param('i', $_GET['id']);
		$query->execute();
		$query->bind_result($modelo);
		$query->fetch();
		$query->close();
	}
?>
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Editar Equipamento <small>Recursos</small>
			</h1>
		</section>

		<!-- Main content -->
		<section class="content">
	          <!-- Default box -->
			<div class="box" id="box" >
				<form role="form" action="post/" method="post" name="formulario" id="formulario" class="formulario">
					<input type="hidden" id="numPost" name="numPost" value="15"><!-- Número correspodente ao post -->
					<input type="hidden" name="patrimonio" <?php echo "value= '".$_GET['id']."'"?> >
					<div class="box-body">
						<div class="form-group col-xs-6">
							<label for="nome">Modelo</label> 
							<input type="text"	class="form-control" name="modelo" id="modelo"
								<?php echo "value= '".$modelo."'"?> />
						</div>
						<div class="form-group col-xs-6">
							<label for="lab">Laboratório</label> 
							<select name="lab" id="lab" class="form-control">
								<?php
									if($query = $db->prepare("SELECT idLab FROM tbalocalab WHERE patrimonio = ?")){
										$query->bind_param('i', $_GET['id']);
										$query->execute();
										$query->bind_result($idLab);
										$query->fetch();
										$query->close();
										if($query = $db->prepare("SELECT idLab, nomeLab FROM tblaboratorio")){
											$query->execute();
											$query->bind_result($id, $nome);
											echo '<option value="NULL">Nenhum</option>';
											while($query->fetch()){
												if($idLab == $id){
													echo '<option value="'.$id.'" selected="true">'.$nome.'</option>';
												}else{
													echo '<option value="'.$id.'">'.$nome.'</option>';
												}
											}
											$query->close();
											$db->close();
										}
									}
								?>
	                   		</select>
						</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Modificar</button>
						<a href="/recursos/equipamentos"<span class="btn btn-default">Cancelar</span></a>
					</div>
				</form>
			</div>
			<!-- /.box -->

		</section>
		<!-- /.content -->
	</div><!-- /.content-wrapper -->
	<?php include '../../includes/rodape.php' ?>
</div><!-- ./wrapper -->
	<?php include '../../includes/script.php' ?>
	<script>
		$('#box').find('.formulario').submit(function() {
	    var modelo = $.trim($(this).find('#modelo').val());
	    
	    if(!(modelo.length != 0)) {
	        alert("Por favor, preencha todos os campos!");
	        return false;
	    }
	  });
	</script>
</body>
</html>
