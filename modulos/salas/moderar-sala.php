<?php
	include '../../includes/topo.php';
?>
<title>AdminDcomp - Moderar Reservas de Salas</title>
</head>
<?php
	if(!$_SESSION['logado'] || $_SESSION['nivel'] != 1){
		header('Location: /inicio');
	} 
	include '../../includes/barra.php';
	include '../../includes/menu.php';
	$_SESSION['irPara'] = '/inicio';
   	$busca = (!empty($_GET['busca'])) ? $_GET['busca'] : NULL;
  	$auxbusca = '%'.$busca.'%';
    //verifica a página atual caso seja informada na URL, senão atribui como 1ª página
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
    $filtro = (isset($_GET['filtro']))? $_GET['filtro'] : NULL;
	$db = Atalhos::getBanco();
	if(isset($busca)){
		if(isset($filtro) && $filtro != 'Todos'){
			$query = $db->prepare("SELECT a.idReSala FROM tbReservaSala a inner join tbUsuario e on a.idUser = e.idUser 
				WHERE ((a.tituloReSala LIKE ?) OR (e.nomeUser LIKE ?) OR (e.cpf LIKE ?)) AND EXISTS (SELECT y.idReSala 
				FROM tbControleDataSala y WHERE a.idReSala = y.idReSala AND y.statusData = ?)");
			$query->bind_param('ssss', $auxbusca, $auxbusca, $filtro);
		}else{
			$query = $db->prepare("SELECT a.idReSala FROM tbReservaSala a inner join tbUsuario e on a.idUser = e.idUser 
				WHERE ((a.tituloReSala LIKE ?) OR (e.nomeUser LIKE ?) OR (e.cpf LIKE ?))");
			$query->bind_param('sss', $auxbusca, $auxbusca, $auxbusca);
		}
	}elseif(isset($filtro) && $filtro != 'Todos'){
		$query = $db->prepare("SELECT a.idReSala FROM tbReservaSala a WHERE EXISTS (SELECT y.idReSala 
			FROM tbControleDataSala y WHERE a.idReSala = y.idReSala AND y.statusData = ?)");
		$query->bind_param('s', $filtro);
	}else{
		$query = $db->prepare("SELECT idReSala FROM tbReservaSala");
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
    	//seleciona os itens por página
    	if(isset($busca)){
			if(isset($filtro) && $filtro != 'Todos'){
				$query = $db->prepare("SELECT a.motivoReSala, a.idReSala, e.nomeUser, e.idUser, a.tituloReSala, b.nomeSala 
					FROM tbReservaSala a inner join tbUsuario e on a.idUser = e.idUser inner join tbSala b on b.idSala = a.idSala
					WHERE ((a.tituloReSala LIKE ?) OR (e.nomeUser LIKE ?) OR (e.cpf LIKE ?)) AND EXISTS (SELECT y.idReSala 
					FROM tbControleDataSala y WHERE a.idReSala = y.idReSala AND y.statusData = ?) ORDER BY a.expirarReSala DESC
					LIMIT ?,".NumReg);
				$query->bind_param('ssssi', $auxbusca, $auxbusca, $auxbusca, $filtro, $inicio);
			}else{
				$query = $db->prepare("SELECT a.motivoReSala, a.idReSala, e.nomeUser, e.idUser, a.tituloReSala, b.nomeSala 
					FROM tbReservaSala a inner join tbUsuario e on a.idUser = e.idUser inner join tbSala b on b.idSala = a.idSala
					WHERE ((a.tituloReSala LIKE ?) OR (e.nomeUser LIKE ?) OR (e.cpf LIKE ?)) ORDER BY a.expirarReSala DESC
					LIMIT ?,".NumReg);
				$query->bind_param('sssi', $auxbusca, $auxbusca, $auxbusca, $inicio);
			}
		}elseif(isset($filtro) && $filtro != 'Todos'){
			$query = $db->prepare("SELECT a.motivoReSala, a.idReSala, e.nomeUser, e.idUser, a.tituloReSala, b.nomeSala 
				FROM tbReservaSala a inner join tbUsuario e on a.idUser = e.idUser inner join tbSala b on b.idSala = a.idSala
				WHERE EXISTS (SELECT y.idReSala FROM tbControleDataSala y WHERE a.idReSala = y.idReSala AND y.statusData = ?)
				ORDER BY a.expirarReSala DESC LIMIT ?,".NumReg);
			$query->bind_param('si', $filtro, $inicio);
		}else{
			$query = $db->prepare("SELECT a.motivoReSala, a.idReSala, e.nomeUser, e.idUser, a.tituloReSala, b.nomeSala 
				FROM tbReservaSala a inner join tbUsuario e on a.idUser = e.idUser inner join tbSala b on b.idSala = a.idSala
				ORDER BY a.expirarReSala DESC LIMIT ?,".NumReg);
			$query->bind_param('i', $inicio);
		}
		$query->execute();
		$query->bind_result($motivoReSala, $idReSala, $nomeUser, $idUser, $tituloReSala, $nomeSala);
	}
	$auxDb = Atalhos::getBanco();
	if($aux = $auxDb->prepare("SELECT a.idReSala, a.idData FROM tbControleDataSala a WHERE statusData='Expirado' AND EXISTS 
		(SELECT b.idReSala FROM tbChoqueSala b WHERE (a.idReSala = b.idReSala AND a.idData = a.idData) OR 
		(a.idReSala = b.idChoqueReSala AND a.idData = b.idChoqueData))")){
		$aux->execute();
		$aux->bind_result($idRe, $idData);
		while($aux->fetch()){
			$conjunto = Atalhos::getConjunto($idRe, $idData, 2);
            Atalhos::deletarConjunto($idRe, $idData, 2);
            Atalhos::verificarConjunto($conjunto, 2);
		}
		$aux->close();
	}
	$ch = Atalhos::getBanco();
	if($choque = $ch->prepare("SELECT idReSala, idData, idChoqueReSala, idChoqueData FROM tbChoqueSala")){
		$choque->execute();
		$choque->bind_result($idReSala, $idData, $idChoqueReSala, $idChoqueData);
		$choque->store_result();
	}
	$contChoque = 0;
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        	<?php include '../funcoes/filtroRe.php' ?>
	        <h1>
	        	Moderar Reservas
	        	<small>Salas</small>
	        </h1>
		 </section>
        <!-- Main content -->
        <section class="content">
        	<?php
        		if(isset($_SESSION['errorAprovar'])):
        			if($_SESSION['errorAprovar'] == 1):
		    ?>
						<div class="callout callout-danger">
							<h4>Reserva não pode ser aprovada!</h4>
							<p>Esta reserva está em choque com outra, antes de aprovar favor verificar a aba "Reservas com Choque".</p>
						</div>
			<?php
					else:
			?>
						<div class="callout callout-danger">
							<h4>Reservas não podem ser aprovadas!</h4>
							<p>Uma ou mais reservas estão em choque com outra, antes de aprovar favor verificar a aba "Reservas com Choque"</p>
						</div>
		    <?php
		    		endif;
		      		unset($_SESSION['errorAprovar']);
		    	elseif(isset($_SESSION['errorModerarSala'])):
		    		if($_SESSION['errorModerarSala'] == 1):
		    ?>
						<div class="callout callout-danger">
							<h4>Justificativa é obrigatoria!</h4>
							<p>Para negar ou cancelar é necessario justificar.</p>
						</div>
		    <?php
		      		else:
		    ?>
						<div class="callout callout-danger">
							<h4>Erro em Entregar Salauipamento!</h4>
							<p>Um ou mais equipamentos não foram selecionados para serem entregues.</p>
						</div>
			<?php
					endif;
		      		unset($_SESSION['errorModerarSala']);
		      	endif;
		    ?>
          	<div class="row">
            	<div class="col-md-12">
            		<div class="nav-tabs-custom">
		                <ul class="nav nav-tabs">
							<li class="active"><a href="#tab_1" data-toggle="tab">Todas Reservas</a></li>
							<li>
								<a href="#tab_2" data-toggle="tab">Reservas com Choque 
									<?php 
										if($choque->num_rows > 0){
											echo '<i class="fa fa-fw fa-exclamation "></i>';
										}else{
											$avisoChoque = "
											<div class='box-body'>
												<div class='callout callout-warning'>
													<h4>Lista Vazia!</h4>
													<p>Não há Choque de reservas.</p>
												</div>
											</div>";
										}
									?>
								</a>
							</li>
		                </ul>
			            <div class="box">
		            		<div class="tab-content">
	                  			<div class="tab-pane active" id="tab_1">
		                  			<div class="box-header">
			                  			<h3 class="box-title"></h3>
			                  			<div class="box-tools">
			                    			<form action="" method="get">
			                      				<div class="input-group" style="width: 250px;">
			                        				<input type="text" name="busca" class="form-control input-sm pull-right" 
			                        					placeholder="Nome, CPF ou titulo da reserva" <?php echo 'value="'.$busca.'"'?>/>
			                        				<?php if(isset($filtro)): ?>
								                      <input type="hidden" name="filtro" <?php echo 'value="'.$filtro.'"' ?> />
								                    <?php endif; ?>
			                        				<div class="input-group-btn">
			                          					<button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
			                        				</div>
			                      				</div>
			                    			</form>
			                  			</div>
			                  		</div><!-- /.box-header -->
								    <?php if($total > 0): ?>
			                			<div class="box-body table-responsive no-padding" id="txtHint">
					                  		<table class="table table-hover">
							                    <tr align="center">
							                      <th><center>Titulo</center></th>
							                      <th><center>Usuário</center></th>
							                      <th><center>Horário a ser reservado</center></th>
							                      <th><center>Sala</center></th>
							                      <th><center>Status</center></th>
							                      <th><center>Motivo</center></th>
							                      <th><center>Ação</center></th>
							                      <th></th>
							                      <th></th>
							                    </tr>
	                    						<?php 
													//exibe os reservas selecionados
								                    $estado = $var = $data = -1;
													$auxDb = Atalhos::getBanco();
						                      		while($query->fetch()){
								                        if(isset($filto) && $filtro != 'Todos'){
							                      			if($aux = $auxDb->prepare("SELECT f.inicio, f.fim, y.statusData, y.justificativa, y.idData 
							                      				FROM tbControleDataSala y inner join tbData f on y.idData = f.idData WHERE y.idReSala = ? 
							                      				AND y.statusData = ? ORDER BY y.statusData ASC")){
							                      				$aux->bind_param('is', $idReSala, $filto);
							                      			}
							                      		}else{
							                      			if($aux = $auxDb->prepare("SELECT f.inicio, f.fim, y.statusData, y.justificativa, y.idData 
							                      				FROM tbControleDataSala y inner join tbData f on y.idData = f.idData WHERE y.idReSala = ? 
							                      				ORDER BY y.statusData ASC")){
							                      				$aux->bind_param('i', $idReSala);
							                      			}
							                      		}
							                      		$aux->execute();
							                      		$aux->bind_result($inicio, $fim, $statusData, $justificativa, $idData);
							                      		$aux->store_result();
								                        if($aux->num_rows > 1){
															$statusR = -1;
															$pendente = $cancelar = false;
															$es = '';
															$numRes = 1;
															while ($aux->fetch()){        
																$acao = 'Nenhuma ação possivel';
																switch($statusData){
																	case 'Aprovado':
																		$status = '<span class="label label-success">APROVADO</span>';
																		$acao = '<button class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#simples" 
																		data-solict-id="'.$idData.'" data-solict-tipo="Entregue" 
																		data-solict-frase="Entregar chave" data-solict-idre="'.$idReSala.'"
																		data-solict-titulo="'.$tituloReSala.'">Entregar chave</button>
																		<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
																		data-solict-id="'.$idData.'" data-solict-iduser="'.$idUser.'"
																		data-solict-tipo="Cancelado" data-solict-frase="Cancelar" data-solict-idre="'.$idReSala.'"
																		data-solict-titulo="'.$tituloReSala.'">Cancelar</button>';
																		break;
																	case 'Pendente':
																		$status = '<span class="label label-warning">PENDENTE</span>';
																		$acao = '<button class="btn btn-block btn-success btn-xs" data-toggle="modal" data-target="#simples"
																		data-solict-id="'.$idData.'" data-solict-tipo="Aprovado" data-solict-frase="Aprovar" 
																		data-solict-idre="'.$idReSala.'" data-solict-titulo="'.$tituloReSala.'"
																		data-solict-iduser="'.$idUser.'">Aprovar</button>
																		<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
																		data-solict-id="'.$idData.'" data-solict-tipo="Negado" data-solict-frase="Negar"
																		data-solict-idre="'.$idReSala.'" data-solict-iduser="'.$idUser.'"
																		data-solict-titulo="'.$tituloReSala.'">Negar</button>';                         
																		break;
																	case 'Entregue':
																		$status = '<span class="label label-primary">ENTREGUE</span>';
																		$acao = '<button class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#simples" 
																		data-solict-id="'.$idData.'" data-solict-tipo="Recebido" 
																		data-solict-frase="Receber chave" data-solict-idre="'.$idReSala.'"
																		 ata-solict-titulo="'.$tituloReSala.'">Receber chave</button>';
																		break;
																	case 'Recebido':
																		$status = '<span class="label label-primary">RECEBIDO</span>';
																		break;
																	case 'Negado':
																		$status = '<span class="label label-danger"data-toggle="tooltip" 
																		title="'.$justificativa.'">NEGADO</span>';
																		break;
																	case 'Cancelado':
																		$status = '<span class="label label-danger" data-toggle="tooltip" 
																		title="'.$justificativa.'">CANCELADO</span>';
																		break;
																	case 'Expirado':
																		$status = '<span class="label label-danger">EXPIRADO</span>';
																		break;
																}
																if($statusR == -1){
																	$statusR = $status;
																}else{
																	if($status != $statusR){
																		$statusR = ' - ';
																	}
																}
																if($statusData == 'Pendente'){
																	$pendente = true;
																}else if($statusData == 'Aprovado'){
																	$cancelar = true;
																}
																$es .= '<tr align="center">
																<td>'.wordwrap($tituloReSala, 20, "</br>", false).'</td>
																<td></td>
																<td>'.Atalhos::getData(strtotime($inicio), strtotime($fim)).'</td>';           
																$es .= '<td></td>
																	<td>'.$status.'</td><td></td>';
																if ($statusData == 'Aprovado' || $statusData == 'Entregue'){
																	$es .= '<td>'.$acao.'</td>';
																}else{
																	$es .= '<td>Nenhuma ação possivel</td>';
																}
																$es .='<td><button class="close" data-target="#simples" data-solict-id="'.$idData.'"
										                          data-solict-tipo="Excluir" data-toggle="modal" data-solict-frase="Excluir" data-solict-idre="'.$idReSala.'" 
										                          data-solict-titulo="'.$tituloReSala.'" data-solict-iduser="'.$idUser.'"><span aria-hidden="true">&times;</span>
										                          </button></td></tr>';	
															}
															if($pendente == true){
																$acao = '<button class="btn btn-block btn-success btn-xs" data-toggle="modal" data-target="#simples"
																data-solict-id="0" data-solict-tipo="Aprovado" data-solict-frase="Aprovar Todos" 
																data-solict-idre="'.$idReSala.'" data-solict-iduser="'.$idUser.'"
																data-solict-titulo="'.$tituloReSala.'">Aprovar Todos</button>
																<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
																data-solict-id="0" data-solict-tipo="Negado" data-solict-frase="Negar Todos"
																data-solict-idre="'.$idReSala.'" data-solict-iduser="'.$idUser.'"
																data-solict-titulo="'.$tituloReSala.'" >Negar Todos</button>'; 
															}else if($cancelar == true){
																$acao = '<button class="btn btn-block btn-danger 
																btn-xs" data-toggle="modal" data-target="#negativo" data-solict-id="0" 
																data-solict-tipo="Cancelado" data-solict-frase="Cancelar Todos" data-solict-idre="'.$idReSala.'"
																data-solict-titulo="'.$tituloReSala.'" >Cancelar Todos</button>';
															}else{
																$acao = 'Nenhuma ação possivel';
															}
															echo'<tr align="center">
																<td>'.wordwrap($tituloReSala, 20, "</br>", false).'</td>
																<td>'.wordwrap($nomeUser, 20, "</br>", false).'</td>
																<td>-</td>';
															echo '<td><label>'.$nomeSala.'</label></td>';
															echo '<td>'.$statusR.'</td>
																<td><a class="btn btn-block" data-toggle="tooltip" 
																title="'.$motivoReSala.'""><i class=" fa fa-comment "></a></td>
																<td>'.$acao.'</td>';
															echo '<td><button class="close" data-target="#simples" data-solict-id="0"
									                          data-solict-tipo="Excluir" data-toggle="modal" data-solict-frase="Excluir" data-solict-idre="'.$idReSala.'" 
									                          data-solict-titulo="'.$tituloReSala.'" data-solict-iduser="'.$idUser.'"><span aria-hidden="true">&times;</span>
									                          </button></td>';
															echo '<td><a data-toggle="collapse" data-parent="#accordion" href="#'.$idReSala.'" 
																onclick="TrocarClass('.$idReSala.')"><i class="fa fa-fw fa-plus-circle" 
																id="Rec'.$idReSala.'"></a></td></tr><tbody id="'.$idReSala.'" 
																class="table-collapse collapse">'.$es;
															echo '</tr>';
														}else{                   
															$aux->fetch();        
															$acao = 'Nenhuma ação possivel';
															switch($statusData){
																case 'Aprovado':
																	$status = '<span class="label label-success">APROVADO</span>';
																	$acao = '<button class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#simples" 
																	data-solict-id="'.$idData.'" data-solict-tipo="Entregue" 
																	data-solict-frase="Entregar chave" data-solict-idre="'.$idReSala.'"
																	data-solict-titulo="'.$tituloReSala.'">Entregar chave</button>
																	<button class="btn btn-block btn-danger	btn-xs" data-toggle="modal" data-target="#negativo" 
																	data-solict-id="'.$idData.'" data-solict-tipo="Cancelado" data-solict-iduser="'.$idUser.'"
																	data-solict-frase="Cancelar" data-solict-idre="'.$idReSala.'" data-solict-titulo="'.$tituloReSala.'"
																	>Cancelar</button>';
																	break;
																case 'Pendente':
																	$status = '<span class="label label-warning">PENDENTE</span>';
																	$acao = '<button class="btn btn-block btn-success btn-xs" data-toggle="modal" data-target="#simples"
																	data-solict-id="'.$idData.'" data-solict-tipo="Aprovado" data-solict-frase="Aprovar" 
																	data-solict-idre="'.$idReSala.'" data-solict-iduser="'.$idUser.'"
																	data-solict-titulo="'.$tituloReSala.'">Aprovar</button>
																	<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
																	data-solict-id="'.$idData.'" data-solict-tipo="Negado" data-solict-frase="Negar"
																	data-solict-idre="'.$idReSala.'" data-solict-iduser="'.$idUser.'"
																	data-solict-titulo="'.$tituloReSala.'">Negar</button>';                         
																	break;
																case 'Entregue':
																	$status = '<span class="label label-primary">ENTREGUE</span>';
																	$acao = '<button class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#simples" 
																	data-solict-id="'.$idData.'" data-solict-tipo="Recebido" 
																	data-solict-frase="Receber chave" data-solict-idre="'.$idReSala.'"
																	 data-solict-titulo="'.$tituloReSala.'">Receber chave</button>';
																	break;
																case 'Recebido':
																	$status = '<span class="label label-primary">RECEBIDO</span>';
																	break;
																case 'Negado':
																	$status = '<span class="label label-danger"data-toggle="tooltip" 
																	title="'.$justificativa.'">NEGADO</span>';
																	break;
																case 'Cancelado':
																	$status = '<span class="label label-danger" data-target="#justificativa" data-toggle="tooltip" 
																	title="'.$justificativa.'">CANCELADO</span>';
																	break;
																case 'Expirado':
																	$status = '<span class="label label-danger">EXPIRADO</span>';
																	break;
															}
															echo '
																<tr align="center">
																<td>'.wordwrap($tituloReSala, 20, "</br>", false).'</td>
																<td>'.wordwrap($nomeUser, 20, "</br>", false).'</td>
																<td>'.Atalhos::getData(strtotime($inicio), strtotime($fim)).'</td>';
															echo '<td><label>'.$nomeSala.'</label></td>';
															echo '</select></td>
																<td>'.$status.'</td>
																<td><a class="btn btn-block" data-toggle="tooltip" 
																title="'.$motivoReSala.'""><i class=" fa fa-comment "></a></td>
																<td>'.$acao.'</td>';
															echo '<td><button class="close" data-target="#simples" data-solict-id="0" data-solict-tipo="Excluir"
									                          data-toggle="modal" data-solict-frase="Excluir" data-solict-idre="'.$idReSala.'" data-solict-iduser="'.$idUser.'"
									                          data-solict-titulo="'.$tituloReSala.'"><span aria-hidden="true">&times;</span></button></td>
									                          <td></td></tr>';
														}
														echo '
															<div>
															</tbody>
															</div>';
														$aux->close();
													}
													$query->close();
													$db->close();
												?>
	                    					</table>
											<?php
												include '../funcoes/paginacao.php';
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
								    <?php endif; ?>
								</div>
            	  				<div class="tab-pane" id="tab_2">
				                    <?php
				                    	if(isset($avisoChoque)){
				                    		echo $avisoChoque;
				                    	}else{
				                    ?>
				                    <table class="table table-hover">
					                    <tr align="center">
					                      <th><center>Titulo</center></th>
					                      <th><center>Usuário</center></th>
					                      <th><center>Horário a ser reservado</center></th>
					                      <th><center>Sala</center></th>
					                      <th><center>Status</center></th>
					                      <th><center>Motivo</center></th>
					                      <th><center>Ação</center></th>
					                      <th></th>
					                    </tr>
	        							<?php 
				                    		$anterior[0] = 0;
				                    		$anterior[1] = 0;
				                    		while($choque->fetch()){
				                    			if($anterior[0] != $idReSala || $anterior[1] != $idData){
				                    				if($aux = $auxDb->prepare("SELECT a.motivoReSala, e.nomeUser, e.idUser, d.idSala, d.nomeSala, a.tituloReSala, 
				                    					c.inicio, c.fim, b.statusData FROM tbReservaSala a inner join tbUsuario e on a.idUser = e.idUser 
				                    					inner join tbControleDataSala b on b.idReSala = a.idReSala inner join tbData c on c.idData = b.idData
				                    					inner join tbSala d on d.idSala = a.idSala WHERE a.idReSala = ? AND b.idData = ?")){
					                      				$aux->bind_param('ii', $idReSala, $idData);
					                      				$aux->execute();
                      									$aux->bind_result($motivoReSala, $nomeUser, $idUser, $idSala, $nomeSala, $tituloReSala, $inicio, $fim
                      										, $statusData);
                      									$aux->fetch();
                      									$aux->close();
					                      			}
				                    				if($anterior[0] != 0){
				                    					echo '</tbody></tr>';
				                    				}
			                    					echo '<tr align="center">
		                    							<td>'.wordwrap($tituloReSala, 20, "</br>", false).'</td>
														<td>'.wordwrap($nomeUser, 20, "</br>", false).'</td>
														<td>'.Atalhos::getData(strtotime($inicio), strtotime($fim)).'</td>
														<td>'.$nomeSala.'</td>';
													if($statusData == 'Aprovado'){
														$status = '<span class="label label-success">APROVADO</span>';
														$acao = '<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
															data-solict-id="'.$idData.'" data-solict-tipo="Cancelado" data-solict-frase="Cancelar" 
															data-solict-idre="'.$idReSala.'" data-solict-iduser="'.$idUser.'" 
															data-solict-titulo="'.$tituloReSala.'">Cancelar</button>';
													}elseif($statusData == 'Pendente'){
														$status = '<span class="label label-warning">PENDENTE</span>';
														$acao = '<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
															data-solict-id="'.$idData.'" data-solict-tipo="Negado" data-solict-frase="Negar"
															data-solict-idre="'.$idReSala.'" data-solict-iduser="'.$idUser.'"
															data-solict-titulo="'.$tituloReSala.'">Negar</button>';                         
													}else{
														$status = '<span class="label label-primary">ENTREGUE</span>';
														$acao = 'Nenhuma ação possivel';   
													}
													echo '<td>'.$status.'</td>
														<td><a class="btn btn-block" data-toggle="tooltip" 
														title="'.$motivoReSala.'""><i class=" fa fa-comment "></a></td>
														<td>'.$acao.'</td>';
			                    					echo '<td><a data-toggle="collapse" data-parent="#accordion" href="#'.$contChoque.'" 
														onclick="TrocarClass('.$idData.')"><i class="fa fa-fw fa-plus-circle" 
														id="Rec'.$idData.'"></a></td></tr><tbody id="'.$contChoque++.'" 
														class="table-collapse collapse"></tr>';
													$anterior[0] = $idReSala;
													$anterior[1] = $idData;
				                    			}
				                    			if($aux = $auxDb->prepare("SELECT a.motivoReSala, e.nomeUser, e.idUser, d.idSala, d.nomeSala, a.tituloReSala, 
			                    					c.inicio, c.fim, b.statusData FROM tbReservaSala a inner join tbUsuario e on a.idUser = e.idUser 
			                    					inner join tbControleDataSala b on b.idReSala = a.idReSala inner join tbData c on c.idData = b.idData
			                    					inner join tbSala d on d.idSala = a.idSala WHERE a.idReSala = ? AND b.idData = ?")){
				                      				$aux->bind_param('ii', $idChoqueReSala, $idChoqueData);
				                      				$aux->execute();
                  									$aux->bind_result($motivoReSala, $nomeUser, $idUser, $idSala, $nomeSala, $tituloReSala, $inicio, $fim
                  										, $statusData);
                  									$aux->fetch();
                  									$aux->close();
				                      			}
	                    						echo '<tr align="center">
	                    							<td>'.wordwrap($tituloReSala, 20, "</br>", false).'</td>
													<td>'.wordwrap($nomeUser, 20, "</br>", false).'</td>
													<td>'.Atalhos::getData(strtotime($inicio), strtotime($fim)).'</td>
													<td>'.$nomeSala.'</td>';
												if($statusData == 'Aprovado'){
													$status = '<span class="label label-success">APROVADO</span>';
													$acao = '<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
														data-solict-id="'.$idChoqueData.'" data-solict-tipo="Cancelado" data-solict-frase="Cancelar" 
														data-solict-idre="'.$idChoqueReSala.'" data-solict-iduser="'.$idUser.'"
														data-solict-titulo="'.$tituloReSala.'">Cancelar</button>';
												}elseif($statusData == 'Pendente'){
													$status = '<span class="label label-warning">PENDENTE</span>';
													$acao = '<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
													data-solict-id="'.$idChoqueData.'" data-solict-tipo="Negado" data-solict-frase="Negar"
													data-solict-idre="'.$idChoqueReSala.'" data-solict-titulo="'.$tituloReSala.'"
													data-solict-iduser="'.$idUser.'" >Negar</button>';                         
												}else{
													$status = '<span class="label label-primary">ENTREGUE</span>';
													$acao = 'Nenhuma ação possivel';   
												}
												echo '<td>'.$status.'</td>
													<td><a class="btn btn-block" data-toggle="tooltip" 
													title="'.$motivoReSala.'""><i class=" fa fa-comment "></a></td>
													<td>'.$acao.'</td></tr>';
					                    		}
					                    	}
					                    	$choque->close();
				                    		$ch->close();
				                    		$auxDb->close();
					                    ?>
					                </table>
			                	</div><!-- /.tab-pane -->
          					</div>
          				</div><!-- /.box -->
          			</div>
          		</div>
          	</div>	
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- NEGAR -->
    <div class="modal fade" id="negativo" tabindex="-1" role="dialog" aria-labelledby="exampleModalSalael" aria-hidden="true">
        <div class="modal-dialog">
          	<div class="modal-content">
            	<div class="modal-header">
              		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              		<h4 class="modal-title" id="exampleModalSalael"></h4>
            	</div>
            	<form role="form" action="post/" method="post" name="formulario" id="formulario">
            		<div class="modal-body">
            			<input type="hidden" id="numPost" name="numPost" value="38"><!-- Número correspodente ao post -->
		                <input type="hidden" name="id2" id="id2" />
		                <input type="hidden" name="idre2" id="idre2" />
		                <input type="hidden" name="acao2" id="acao2" />
		                <input type="hidden" name="idUser2" id="idUser2" /> 
		              	<div class="form-group">
			                <label for="message-text" class="control-label">Justificativa: (obrigatorio)</label>
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
    <!-- FIM NEGAR -->
    <!-- APROVAR -->
    <div class="modal fade" id="simples" tabindex="-1" role="dialog" aria-labelledby="exampleModalSalael" aria-hidden="true">
        <div class="modal-dialog">
          	<div class="modal-content">
            	<div class="modal-header">
              		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              		<h4 class="modal-title" id="exampleModalSalael"></h4>
            	</div>
            	<form role="form" action="post/" method="post" name="formulario1" id="formulario1">
            		<div class="modal-body">
            			<input type="hidden" id="numPost" name="numPost" value="38"><!-- Número correspodente ao post -->
		                <input type="hidden" name="id" id="id"/>
		                <input type="hidden" name="idre" id="idre" />
		                <input type="hidden" name="acao" id="acao" />
		                <input type="hidden" name="idUser" id="idUser" /> 
		            </div>
		            <div class="modal-footer">
		              <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
		              <button type="submit" class="btn btn-success">Confirmar</button>
		            </div>
            	</form>
          	</div>
        </div>
     </div>
    <!-- FIM APROVAR -->      
	<?php include '../../includes/rodape.php' ?>
</div><!-- ./wrapper -->
    <?php include '../../includes/script.php' ?>
<script>

	function addSala(id){
		var newlab = document.createElement('div');
		newlab.innerHTML = '<input type="hidden" name="'+ id +'" id="'+ id +'"/>';
		document.getElementById('newSala').appendChild(newlab);
	}

	$('#simples').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var tipo = button.data('solict-tipo')
		var frase = button.data('solict-frase')
		var idRe = button.data('solict-idre')
		var id = button.data('solict-id')
		var idUser = button.data('solict-iduser')
		var modal = $(this)
		var titulo = button.data('solict-titulo')
		modal.find('.modal-title').text(frase + ' - ' + titulo)
        $('#id').val(id)
        $('#idre').val(idRe)
        $('#acao').val(tipo)
        $('#idUser').val(idUser)
    })

    $('#negativo').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var tipo = button.data('solict-tipo')
		var frase = button.data('solict-frase')
		var id = button.data('solict-id') // Extract info from data-* attributes
		var idRe = button.data('solict-idre')
		var idUser = button.data('solict-iduser')
		var modal = $(this)
      	var titulo = button.data('solict-titulo')
		modal.find('.modal-title').text(frase + ' - ' + titulo)
	    $('#id2').val(id)
	    $('#idre2').val(idRe)
	    $('#acao2').val(tipo)
        $('#idUser').val(idUser)
    })

    function Filtro(str) {
		if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }else{
				result.innerHTML = "Erro: " + xmlreq.statusText;
			}
        };
        xmlhttp.open("GET","lab.php?filtro="+str,true);
        xmlhttp.send();
    }

    function Pag(str) {
		if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint2").innerHTML = xmlhttp.responseText;
            }else{
				result.innerHTML = "Erro: " + xmlreq.statusText;
			}
        };
        xmlhttp.open("GET","paginacao/"+str+"/",true);
        xmlhttp.send();
    }

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