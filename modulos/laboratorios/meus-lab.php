<?php 
	include '../../includes/topo.php';
?>
<title>AdminDcomp - Minhas Reservas de Laboratórios</title>
</head>
<?php
	if(!$_SESSION['logado']){
        header('Location: /inicio');
    }
	include '../../includes/barra.php';
	include '../../includes/menu.php';
	$_SESSION['irPara'] = '/inicio';
  	$link = '/laboratorios/meus';
    $busca = (!empty($_GET['busca'])) ? $_GET['busca'] : NULL;
  	$auxbusca = '%'.$busca.'%';
    //verifica a página atual caso seja informada na URL, senão atribui como 1ª página
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
    $filtro = (isset($_GET['filtro']))? $_GET['filtro'] : NULL;
	$db = Atalhos::getBanco();
	if(isset($busca)){
		if(isset($filtro) && $filtro != 'Todos'){
			$query = $db->prepare("SELECT a.idReLab FROM tbreservalab a WHERE a.idUser = ? AND ((a.tituloReLab LIKE ?)
				OR (a.motivoReLab LIKE ?)) AND EXISTS (SELECT y.idReLab FROM tbcontroledatalab y 
				WHERE (a.idReLab = y.idReLab) AND (y.statusData = ?))");
			$query->bind_param('isss', $_SESSION['id'], $auxbusca, $auxbusca, $filtro);
		}else{
			$query = $db->prepare("SELECT a.idReLab FROM tbreservalab a WHERE a.idUser = ? AND ((a.tituloReLab LIKE ?)
				OR (a.motivoReLab LIKE ?))");
			$query->bind_param('iss', $_SESSION['id'], $auxbusca, $auxbusca);
		}
	}elseif(isset($filtro) && $filtro != 'Todos'){
		$query = $db->prepare("SELECT a.idReLab FROM tbreservalab a WHERE a.idUser = ? AND EXISTS (SELECT y.idReLab 
			FROM tbcontroledatalab y WHERE (a.idReLab = y.idReLab) AND (y.statusData = ?))");
		$query->bind_param('is', $_SESSION['id'], $filtro);
	}else{
		$query = $db->prepare("SELECT a.idReLab FROM tbreservalab a WHERE a.idUser = ?");
		$query->bind_param('i', $_SESSION['id']);
	}		
	$query->execute();
	$query->store_result();
	$total = $query->num_rows;
	if($total > 0){
		$numPaginas = ceil($total/NumReg);
		if($pagina > $numPaginas){
			$pagina = $numPaginas;
		}
		$inicio = (NumReg*$pagina)-NumReg;
		$query->free_result();
		$query->close();
		if(isset($busca)){
			if(isset($filto) && $filtro != 'Todos'){
				$query = $db->prepare("SELECT a.idReLab, a.motivoReLab, a.tipoReLab, a.numPc, a.tituloReLab FROM tbreservalab a 
					WHERE a.idUser = ? AND ((a.tituloReLab LIKE ?) OR (a.motivoReLab LIKE ?)) AND EXISTS (SELECT y.idReLab 
					FROM tbcontroledatalab y WHERE (a.idReLab = y.idReLab) AND (y.statusData = ?)) 
					ORDER BY idReLab DESC LIMIT ?,".NumReg);
				$query->bind_param('isssi', $_SESSION['id'], $auxbusca, $auxbusca, $filtro, $inicio);
			}else{
				$query = $db->prepare("SELECT a.idReLab, a.motivoReLab, a.tipoReLab, a.numPc, a.tituloReLab FROM tbreservalab a 
					WHERE a.idUser = ? AND ((a.tituloReLab LIKE ?)OR (a.motivoReLab LIKE ?)) 
					ORDER BY idReLab DESC LIMIT ?,".NumReg);
				$query->bind_param('issi', $_SESSION['id'], $auxbusca, $auxbusca, $inicio);
			}
		}elseif(isset($filto) && $filtro != 'Todos'){
			$query = $db->prepare("SELECT a.idReLab, a.motivoReLab, a.tipoReLab, a.numPc, a.tituloReLab FROM tbreservalab a 
				WHERE a.idUser = ? AND EXISTS (SELECT y.idReLab FROM tbcontroledatalab y WHERE (a.idReLab = y.idReLab) 
				AND (y.statusData = ?)) ORDER BY idReLab DESC LIMIT ?,".NumReg);
			$query->bind_param('isi', $_SESSION['id'], $filtro, $inicio);
		}else{
			$query = $db->prepare("SELECT a.idReLab, a.motivoReLab, a.tipoReLab, a.numPc, a.tituloReLab FROM tbreservalab a 
				WHERE a.idUser = ? ORDER BY idReLab DESC LIMIT ?,".NumReg);
			$query->bind_param('ii', $_SESSION['id'], $inicio);
		}
		$query->execute();
		$query->bind_result($idReLab, $motivoReLab, $tipoReLab, $numPc, $tituloReLab);
	}
?>
      <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        	<?php include '../funcoes/filtroRe.php' ?>
	        <h1>
	            Minhas Reservas
	            <small>Laboratórios</small>
	        </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          	<div class="row">
            	<div class="col-xs-12">
              		<div class="box">
				  		<div class="box-header">
                  			<h3 class="box-title"></h3>
                  			<div class="box-tools">
                    			<form action="" method="get">
			                      	<div class="input-group" style="width: 250px;">
			                        	<input type="text" name="busca" class="form-control input-sm pull-right" 
			                        		placeholder="Titulo ou motivo da reserva" <?php echo 'value="'.$busca.'"'?>/>
			                        	<?php if(isset($filtro)): ?>
					                    	<input type="hidden" name="filtro" <?php echo 'value="'.$filtro.'"' ?> />
					                    <?php endif; ?>
			                        	<div class="input-group-btn">
			                          		<button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
			                        	</div>
			                      	</div>
			                    </form>
                  			</div><!-- /.box-header -->
							<?php if($total > 0): ?>
		                		<div class="box-body table-responsive no-padding">
				                  	<table class="table table-hover">
					                    <tr>
										  <th><center>Titulo</center></th>
					                      <th><center>Motivo</center></th>
					                      <th><center>Horário a ser reservado</center></th>
					                      <th><center>Laboratório</center></th>
					                      <th><center>Tipo</center></th>
					                      <th><center>Status</center></th>
					                      <th><center>Ação</center></th>
					                    </tr>
					                    <?php
					                    //exibe os reservas selecionados
					                    $auxDb = Atalhos::getBanco();
			                      		while($query->fetch()){
					                        if(isset($filto) && $filtro != 'Todos'){
				                      			if($aux = $auxDb->prepare("SELECT f.inicio, f.fim, y.statusData, y.justificativa, y.idLab, y.idData 
				                      				FROM tbcontroledatalab y inner join tbdata f on y.idData = f.idData WHERE y.idReLab = ? AND y.statusData = ? ORDER BY y.statusData ASC")){
				                      				$aux->bind_param('is', $idReLab, $filto);
				                      			}
				                      		}else{
				                      			if($aux = $auxDb->prepare("SELECT f.inicio, f.fim, y.statusData, y.justificativa, y.idLab, y.idData 
				                      				FROM tbcontroledatalab y inner join tbdata f on y.idData = f.idData WHERE y.idReLab = ? ORDER BY y.statusData ASC")){
				                      				$aux->bind_param('i', $idReLab);
				                      			}
				                      		}
											
				                      		$aux->execute();
				                      		$aux->bind_result($inicio, $fim, $statusData, $justificativa, $idLab, $idData);
				                      		$aux->store_result();
					                        if($aux->num_rows > 1){
												$statusR = $labR = -1;
												$pendente = $cancelar = false;
												$es = '';
												$numRes = 1;
												while ($aux->fetch()){  
													$auxDb2  = Atalhos::getBanco();
													if($aux2 = $auxDb2->prepare("SELECT nomeLab, cor FROM tblaboratorio a INNER JOIN tbcor b ON a.idCor = b.idCor WHERE idLab = ?")){
														$aux2->bind_param('i', $idLab);
														$aux2->execute();
														$aux2->bind_result($nomeLab, $cor);
														$aux2->fetch();
														$aux2->close();
													}
													$auxDb2->close();      
													$acao = 'Nenhuma ação possivel';
													switch($statusData){
														case 'Aprovado':
															$status = '<span class="label label-success">APROVADO</span>';
															$acao = '<button class="btn btn-block btn-danger 
															btn-xs" data-toggle="modal" data-target="#negativo" data-solict-id="'.$idData.'" 
															data-solict-tipo="Cancelado" data-solict-frase="Cancelar" data-solict-idre="'.$idReLab.'"
															data-solict-todos="false" data-solict-titulo="'.$tituloReLab.'">Cancelar</button>';
															break;
														case 'Pendente':
															$status = '<span class="label label-warning">PENDENTE</span>';
															$acao = '<button class="btn btn-block btn-danger 
															btn-xs" data-toggle="modal" data-target="#negativo" data-solict-id="'.$idData.'" 
															data-solict-tipo="Cancelado" data-solict-frase="Cancelar" data-solict-idre="'.$idReLab.'"
															data-solict-todos="false" data-solict-titulo="'.$tituloReLab.'">Cancelar</button>';                         
															break;
														case 'Entregue':
															$status = '<span class="label label-primary">ENTREGUE</span>';
															break;
														case 'Recebido':
															$status = '<span class="label label-primary">RECEBIDO</span>';
															break;
														case 'Negado':
															$status = '<span class="label label-danger">NEGADO</span>';
															break;
														case 'Cancelado':
															$status = '<span class="label label-danger">CANCELADO</span>';
															break;
														case 'Expirado':
															$status = '<span class="label label-danger">EXPIRADO</span>';
															break;
													}
													//separa os tipos 
													switch($tipoReLab){
														case 'Privado':
															$tipo = 'Privado';
															break;
														case 'Compartilhado':
															$tipo = 'Compartilhado ('.$numPc.' PCs)';
													}
													if($statusR == -1){
														$statusR = $status;
														$labR = $nomeLab;
													}else{
														if($status != $statusR){
															$statusR = ' - ';
														}
														if($labR != $nomeLab){
															$labR = ' - ';
														}
													}
													if($statusData == 'Aprovado' || $statusData == 'Pendente'){
														$cancelar = true;
													}
													$es .= '<tr align="center"><td></td>
													<td></td>
													<td>'.Atalhos::getData(strtotime($inicio), strtotime($fim)).'</td>
													<td><label>'.$nomeLab.'</label></td>';           
													$es .= '<td></td>
														<td>'.$status.'</td>';
													if ($statusData == 'Aprovado' || $statusData == 'Entregue'){
														$es .= '<td>'.$acao.'</td>';
													}else{
														$es .= '<td>Nenhuma ação possivel</td>';
													}
													$es .='<td><button class="close" data-target="#simples" data-solict-id="'.$idData.'"
							                          data-solict-tipo="Excluir" data-toggle="modal" data-solict-frase="Excluir" data-solict-idre="'.$idReLab.'" 
							                          data-solict-titulo="'.$tituloReLab.'" ><span aria-hidden="true">&times;</span>
							                          </button></td></tr>';
												}
												if($cancelar == true){
													$acao = '<button class="btn btn-block btn-danger 
													btn-xs" data-toggle="modal" data-target="#negativo" data-solict-id="0" 
													data-solict-tipo="Cancelado" data-solict-frase="Cancelar Todos" data-solict-idre="'.$idReLab.'"
													data-solict-titulo="'.$tituloReLab.'">Cancelar Todos</button>';
												}else{
													$acao = 'Nenhuma ação possivel';
												}
												echo'<tr align="center">
													<td>'.wordwrap($tituloReLab, 20, "</br>", false).'</td>
													<td><a class="btn btn-block" data-target="#motivo" data-toggle="tooltip" 
													title="'.$motivoReLab.'""><i class=" fa fa-comment "></a></td>
													<td>-</td>';
												echo '<td><label>'.$labR.'<label></td>';
												echo '<td>'.$tipo.'</td>
													<td>'.$statusR.'</td>
													<td>'.$acao.'</td>';
												echo '<td><button class="close" data-target="#simples" data-solict-id="'.$idData.'"
						                          data-solict-tipo="Excluir" data-toggle="modal" data-solict-frase="Excluir" data-solict-idre="'.$idReLab.'" 
						                          data-solict-titulo="'.$tituloReLab.'" ><span aria-hidden="true">&times;</span>
						                          </button></td>';
												echo '<td><a data-toggle="collapse" data-parent="#accordion" href="#'.$idReLab.'" 
													onclick="TrocarClass('.$idReLab.')"><i class="fa fa-fw fa-plus-circle" 
													id="Rec'.$idReLab.'"></a></td></tr><tbody id="'.$idReLab.'" 
													class="table-collapse collapse">'.$es;
												echo '</tr>';
											}else{                   
												$aux->fetch();       
												$acao = 'Nenhuma ação possivel';
												switch($statusData){
													case 'Aprovado':
														$status = '<span class="label label-success">APROVADO</span>';
														$acao = '<button class="btn btn-block btn-danger 
															btn-xs" data-toggle="modal" data-target="#negativo" data-solict-id="'.$idData.'" 
															data-solict-tipo="Cancelado" data-solict-frase="Cancelar" data-solict-idre="'.$idReLab.'"
															data-solict-todos="false" data-solict-titulo="'.$tituloReLab.'">Cancelar</button>';
														break;
													case 'Pendente':
														$status = '<span class="label label-warning">PENDENTE</span>';
														$acao = '<button class="btn btn-block btn-danger 
															btn-xs" data-toggle="modal" data-target="#negativo" data-solict-id="'.$idData.'" 
															data-solict-tipo="Cancelado" data-solict-frase="Cancelar" data-solict-idre="'.$idReLab.'"
															data-solict-todos="false" data-solict-titulo="'.$tituloReLab.'">Cancelar</button>';                         
														break;
													case 'Entregue':
														$status = '<span class="label label-primary">ENTREGUE</span>';
														break;
													case 'Recebido':
														$status = '<span class="label label-primary">RECEBIDO</span>';
														break;
													case 'Negado':
														$status = '<span class="label label-danger">NEGADO</span>';
														break;
													case 'Cancelado':
														$status = '<span class="label label-danger">CANCELADO</span>';
														break;
													case 'Expirado':
														$status = '<span class="label label-danger">EXPIRADO</span>';
														break;
												}
												//separa os tipos 
												switch($tipoReLab){
													case 'Privado':
														$tipo = 'Privado';
														break;
													case 'Compartilhado':
														$tipo = 'Compartilhado ('.$numPc.' PCs)';
												}
												echo '
													<tr align="center">
													<td>'.wordwrap($tituloReLab, 20, "</br>", false).'</td>
													<td><a class="btn btn-block" data-target="#motivo" data-toggle="tooltip" 
														title="'.$motivoReLab.'""><i class=" fa fa-comment "></a></td>	
													<td>'.Atalhos::getData(strtotime($inicio), strtotime($fim)).'</td>
													<td><label>'.$nomeLab.'</label></td>';
													echo '<td>'.$tipo.'</td>
														<td>'.$status.'</td>
														<td>'.$acao.'</td>';
													echo '<td><button class="close" data-target="#simples" data-solict-id="0" data-solict-tipo="Excluir"
							                          data-toggle="modal" data-solict-frase="Excluir" data-solict-idre="'.$idReLab.'" 
							                          data-solict-titulo="'.$tituloReLab.'"><span aria-hidden="true">&times;</span></button></td>
							                          <td></td></tr>';
												}
												echo '
													<div>
													</tbody>
													</div>';
											}                                   
					                    ?>
                  					</table>
				                 	<?php
				                  		$aux->close();
				                  		$auxDb->close();
										include '../funcoes/paginacao.php'
								  	?>                         
		                		</div><!-- /.box-body -->
		                	<?php else: ?>
					            <div class="box-body">
					             	<div class="callout callout-warning">
					                	<h4>Lista Vazia!</h4>
					                	<?php if(isset($filtro) || isset($busca)): ?>
						                    <p>Não foi achado nada dentro dos parâmetros inseridos.</p>
						                <?php else: ?>
						                    <p>Nenhuma reserva realizada nos últimos 6 meses.</p>
						                <?php endif; ?>
					              	</div>
					            </div>
					        <?php
					        	endif; 
					        	$query->free_result();
					        	$query->close();
					        	$db->close();
					        ?>
              			</div><!-- /.box -->
            		</div>
          		</div>
          	</div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    
    <!-- NEGAR -->
    <div class="modal fade" id="negativo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          	<div class="modal-content">
            	<div class="modal-header">
              		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              		<h4 class="modal-title" id="exampleModalLabel"></h4>
            	</div>
            	<form role="form" action="post/" method="post" name="formulario" id="formulario">
            		<div class="modal-body">
            			<input type="hidden" name="numPost" value="29"/>
		                <input type="hidden" name="id2" id="id2"/>
		                <input type="hidden" name="acao2" id="acao2"/>
		                <input type="hidden" name="idre2" id="idre2"/>
		              	<div class="form-group">
		                	<label for="message-text" class="control-label">Justificativa:(optativo)</label>
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
    <div class="modal fade" id="simples" tabindex="-1" role="dialog" aria-labelledby="exampleModalEqel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <h4 class="modal-title" id="exampleModalEqel"></h4>
				</div>
				<form role="form" action="post/" method="post" name="formulario" id="formulario">
					<div class="modal-body">
						<input type="hidden" id="numPost" name="numPost" value="29"><!-- Número correspodente ao post -->
					    <input type="hidden" name="id" id="id"/>
					    <input type="hidden" name="acao" id="acao"/>
					    <input type="hidden" name="idre" id="idreeq"/>
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					  <button type="submit" class="btn btn-success">Confirmar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
    <!-- FIM NEGAR -->
	<?php include '../../includes/rodape.php' ?>
</div><!-- ./wrapper -->
    <?php include '../../includes/script.php' ?>

<script>
    $('#negativo').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var tipo = button.data('solict-tipo')
		var frase = button.data('solict-frase')
		var id = button.data('solict-id') // Extract info from data-* attributes
		var idRe = button.data('solict-idre')
		var modal = $(this) 
		var titulo = button.data('solict-titulo')
		modal.find('.modal-title').text(frase + ' - ' + titulo)
		$('#id2').val(id)
		$('#acao2').val(tipo)
		$('#idre2').val(idRe)
    })

    $('#simples').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var tipo = button.data('solict-tipo')
		var frase = button.data('solict-frase')
		var idRe = button.data('solict-idre')
		var id = button.data('solict-id')
		var modal = $(this)
		var titulo = button.data('solict-titulo')
		modal.find('.modal-title').text(frase + ' - ' + titulo)
		$('#id').val(id)
		$('#acao').val(tipo)
		$('#idreeq').val(idRe)
    })

    function TrocarClass(id){
		if(document.getElementById("Rec"+id).className == "fa fa-fw fa-plus-circle"){
			document.getElementById("Rec"+id).className = "fa fa-fw fa-minus-circle";
		}else{
			document.getElementById("Rec"+id).className = "fa fa-fw fa-plus-circle";
		}
	}
</script>
</body>
</html>
