<?php
	include '../../includes/topo.php';
?>
<title>AdminDcomp - Acompanhar Processo</title>
</head>
<?php
	//if(!$_SESSION['logado']){
	//	header('Location: /inicio');
	//} 
	include '../../includes/barra.php';
	include '../../includes/menu.php';
	$_SESSION['irPara'] = '/inicio';
	$db = Atalhos::getBanco();
	if($query = $db->prepare("SELECT a.id, a.status, a.dateStart, b.idUser, b.funcao, b.status, b.tipoEtapa, b.descricao, b.dateStart, c.nomeUser FROM tbAtividadesComp a INNER JOIN tbEtapaAtividadeComp b INNER JOIN tbUsuario c WHERE a.id = ? AND b.idAtividade = a.id AND c.idUser = b.idUser ORDER BY b.dateStart ASC")){
		$query->bind_param('i', $_GET['id']);
		$query->execute();
		$query->bind_result($id, $statusProcesso, $dataInicio, $idUser, $funcao, $statusEtapa, $tipoEtapa, $descricao, $dataEtapa, $nomeUser);
		//$query->fetch();
		//$query->close();
	}
?>
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Atividades Complementares
        <small>Processo Eletrônico Nº <b><?php echo $_GET['id'];?></b></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/atividadescomplementares">AC</a></li>
        <li class="active">Processo Eletrônico Nº <b><?php echo $_GET['id'];?></b></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- row -->
      <div class="row">
      	<div class="col-md-4">
      		<div class="box box-default">
	            <div class="box-header with-border">
	              <i class="fa fa-list-ul"></i>

	              <h3 class="box-title">Sumário do Processo</h3>
	            </div>
            	<div class="box-body">
        		<?php
		            while ($query->fetch()) {
		            	switch ($tipoEtapa) {
		            		case 'Despacho':
		            			$icone = 'fa-font';
		            			break;
		            		case 'Encaminhamento':
		            			$icone = 'fa-location-arrow';
		            			break;
		            		case 'Documentos':
		            			$icone = 'fa-file-o';
		            			break;
		            		case 'Análise':
		            			$icone = 'fa-search';
		            			break;
		            		case 'Arquivamento':
		            			$icone = 'fa-archive';
		            			break;
		            	}
		            	echo '
		            	<a href="#'.$id.'" class="btn btn-block btn-default"><i class="fa '.$icone.'"></i> '.$tipoEtapa.' <small>('.date('d/m/Y H:i',strtotime($dataEtapa)).')</small></a>';
	              	}
	          	?>
            	</div>
            </div>
      		
      	</div>
        <div class="col-md-8">
          <!-- The time line -->
          <ul class="timeline">
          	<?php
          		$query->execute();
          		$dataAux = 0;
	            while ($query->fetch()) {
	            	switch ($tipoEtapa) {
	            		case 'Despacho':
	            			$frase = '<b>'.$nomeUser.'</b> despachou';
	            			$icone = 'fa-font';
	            			break;
	            		case 'Encaminhamento':
	            			$frase = 'Processo encaminhado para <b>'.$nomeUser.'</b>';
	            			$icone = 'fa-location-arrow';
	            			break;
	            		case 'Documentos':
	            			$frase = '<b>'.$nomeUser.'</b> anexou documentos ao processo';
	            			$icone = 'fa-file-o';
	            			break;
	            		case 'Análise':
	            			$frase = 'Processo analisado por <b>'.$nomeUser.'</b>';
	            			$icone = 'fa-search';
	            			break;
	            		case 'Arquivamento':
	            			$frase = 'Processo arquivado por <b>'.$nomeUser.'</b>';
	            			$icone = 'fa-archive';
	            			break;
	            	}
	            	switch ($funcao) {
	            		case 'Aluno':
	            			$cor = 'bg-blue';
	            			break;
	            		case 'Relator': case 'Coordenador':
	            			$cor = 'bg-default';
	            			break;
	            		case 'Secretaria':
	            			$cor = 'bg-green';
	            			break;
	            	}
	            	$dataFormatada = date('d M. Y',strtotime($dataEtapa));
	            	$horaFormatada = date('H:i',strtotime($dataEtapa));
	          		if($dataAux == 0 || $dataAux != $dataFormatada){
	          			echo '
	          			<li class="time-label">
			                  <span class="bg-red">
			                    '.$dataFormatada.'
			                  </span>
			            </li>'; 
			            $dataAux = $dataFormatada;
			        }
	            	echo '
	            	<li id="'.$id.'">
		              <i class="fa '.$icone.' '.$cor.'"></i>

		              <div class="timeline-item">
		                <span class="time"><i class="fa fa-clock-o"></i> '.$horaFormatada.'</span>

		                <h3 class="timeline-header">'.$frase.'</h3>

		                <div class="timeline-body">
		                  	'.$descricao;
		            if($tipoEtapa == 'Documentos' || $tipoEtapa == 'Análise')
		            	echo '                 	
		                  	<div class="embed-responsive embed-responsive-16by9">
		              			<embed src="https://www.unila.edu.br/sites/default/files/files/aproveitamento_diploma_modelo.pdf#page=2" type="application/pdf" width="100%" height="100%">
		      				</div>';
		      		echo '
		                </div>
		              </div>
		            </li>';
              	}
	            $query->close();
	            $db->close();
          	?>
            
            <li>
              <i class="fa fa-mouse-pointer bg-yellow"></i>

              <div class="timeline-item">

                <div class="timeline-body">
                  <a class="btn btn-default" data-toggle="modal" data-target="#encaminhar" data-solict-id="<?php echo $id ?>"><i class="fa fa-location-arrow"></i> Encaminhar Processo</a>
                  <a class="btn btn-default" data-toggle="modal" data-target="#modal_gen" data-solict-title="Despachar Notificação do" data-solict-acao="3" data-solict-id="<?php echo $id ?>"><i class="fa fa-font"></i> Despachar notificação</a>
                  <a class="btn btn-default" data-toggle="modal" data-target="#submeter" data-solict-id="<?php echo $id ?>"><i class="fa fa-search"></i> Submeter análise</a>
                  <a class="btn btn-default" data-toggle="modal" data-target="#anexar" data-solict-id="<?php echo $id ?>"><i class="fa fa-file-o"></i> Anexar Documentos</a>
                  <a class="btn btn-default" data-toggle="modal" data-target="#modal_gen" data-solict-title="Arquivar" data-solict-acao="6" data-solict-id="<?php echo $id ?>"><i class="fa fa-archive"></i> Arquivar Processo</a>
                </div>
              </div>
            </li>
            
            <!-- END timeline item -->
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	</div><!-- /.content-wrapper -->
	<!-- modal_gen --> 
<div class="modal fade" id="modal_gen" tabindex="-1" role="dialog" aria-labelledby="exampleModalEqel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalEqel"></h4>
			</div>
			<form role="form" action="post/" method="post" name="formulario" id="formulario">
				<div class="modal-body">
					<input type="hidden" id="numPost" name="numPost" value="58"><!-- Número correspodente ao post -->
					<input type="hidden" id="acao" name="acao"><!-- Número correspodente ao post -->
					<input type="hidden" name="id_gen" id="id_gen"/>
					<div class="form-group">
						<label for="message-text" class="control-label">Justificativa: </label>
						<textarea class="form-control" name="justificativa" id="justificativa"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Confirmar</button>
				</div>
			</form>
		</div>
	</div>
</div>
 <!-- FIM modal_gen -->  
 <!-- ENCAMINHAR --> 
 <div class="modal fade" id="encaminhar" tabindex="-1" role="dialog" aria-labelledby="exampleModalEqel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalEqel"></h4>
			</div>
			<form role="form" action="post/" method="post" name="formulario" id="formulario">
				<div class="modal-body">
					<input type="hidden" id="numPost" name="numPost" value="58"><!-- Número correspodente ao post -->
					<input type="hidden" id="acao" name="acao" value="2"><!-- Número correspodente ao post -->
					<input type="hidden" name="id" id="id"/>
					<div class="form-group">
						<label>Professor: </label>
						<select class="select2" name="professor" id="professor">
							<option selected disabled>Selecione um professor</option>
								<?php
									$db = Atalhos::getBanco();
									if($query = $db->prepare("SELECT a.idUser, a.nomeUser FROM tbUsuario a inner join tbAfiliacao b on a.idAfiliacao = b.idAfiliacao WHERE b.nivel = 3 AND a.statusUser = 'Ativo'")){
										$query->execute();
										$query->bind_result($idUser, $nomeUser);
									}
									while($query->fetch()){
								?>
								<option value="<?php echo $idUser;?>"><?php echo $nomeUser;?></option>
								<?php
								}$query->close();
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="message-text" class="control-label">Justificativa:</label>
						<textarea class="form-control" name="justificativa" id="justificativa"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Confirmar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- FIM ENCAMINHAR -->  
 <!-- SUBMETER --> 
 <div class="modal fade" id="submeter" tabindex="-1" role="dialog" aria-labelledby="exampleModalEqel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalEqel"></h4>
			</div>
			<form role="form" action="post/" method="post" name="formulario" id="formulario" enctype="multipart/form-data">
				<div class="modal-body">
					<input type="hidden" id="numPost" name="numPost" value="58"><!-- Número correspodente ao post -->
					<input type="hidden" id="acao" name="acao" value="4"><!-- Número correspodente ao post -->
					<input type="hidden" name="id_submeter" id="id_submeter"/>
					<input type="file" name="pdf" id="pdf" required>
					<div class="form-group">
						<label for="message-text" class="control-label">Justificativa:</label>
						<textarea class="form-control" name="justificativa" id="justificativa"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Confirmar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- FIM SUBMETER -->  
 <!-- ANEXAR --> 
 <div class="modal fade" id="anexar" tabindex="-1" role="dialog" aria-labelledby="exampleModalEqel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalEqel"></h4>
			</div>
			<form role="form" action="post/" method="post" name="formulario" id="formulario" enctype="multipart/form-data">
				<div class="modal-body">
					<input type="hidden" id="numPost" name="numPost" value="58"><!-- Número correspodente ao post -->
					<input type="hidden" id="acao" name="acao" value="5"><!-- Número correspodente ao post -->
					<input type="hidden" name="id_anexar" id="id_anexar"/>
					<input type="file" name="pdf_anexar" id="pdf_anexar" required>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Confirmar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- FIM ANEXAR -->  
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

		$('#modal_gen').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('solict-id') // Extract info from data-* attributes
			var title = button.data('solict-title') // Extract info from data-* attributes
			var acao = button.data('solict-acao') // Extract info from data-* attributes
			var modal = $(this) 
			modal.find('.modal-title').text(title+' Processo Nº - ' + id)
			$('#id_gen').val(id)
			$('#acao').val(acao)
		});

		$('#encaminhar').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('solict-id') // Extract info from data-* attributes
			var modal = $(this) 
			modal.find('.modal-title').text('Encaminhar Processo Nº - ' + id)
			$('#id').val(id)
		});

		$('#submeter').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('solict-id') // Extract info from data-* attributes
			var modal = $(this) 
			modal.find('.modal-title').text('Submeter Processo Nº - ' + id)
			$('#id_submeter').val(id)
		});

		$('#anexar').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('solict-id') // Extract info from data-* attributes
			var modal = $(this) 
			modal.find('.modal-title').text('Anexar Documento ao Processo Nº - ' + id)
			$('#id_anexar').val(id)
		});
	</script>
</body>
</html>
