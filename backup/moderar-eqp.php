<?php 
	include 'topo.php';
?>
<title>AdminDcomp - Moderar Reservas de Equipamentos</title>
</head>
<?php
	if(!$_SESSION['logado'] || $_SESSION['nivel'] != 1){
		header('Location: /inicio');
	}
	include 'barra.php';
	include 'menu.php';
	$_SESSION['irPara'] = '/inicio';
    $link = '/equipamentos/moderar';
    //verifica se é uma busca
    $busca = (!empty($_GET['busca'])) ? $_GET['busca'] : NULL;
  	$auxbusca = '%'.$busca.'%';
  	$filtro = (isset($filto))? $_GET['filtro'] : NULL;
    //verifica a página atual caso seja informada na URL, senão atribui como 1ª página
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
	$db = Atalhos::getBanco();
	//seleciona todos os itens da tabela
	if(isset($busca)){
		if(isset($filtro) && $filtro != 'Todos'){
			$query = $db->prepare("SELECT a.idReEq FROM tbReservaEq a inner join tbUsuario e on a.idUser = e.idUser
				WHERE (a.tituloReEq LIKE ? OR e.nomeUser LIKE ? OR e.cpf LIKE ?)
				AND EXISTS (SELECT y.idReEq FROM tbControleDataEq y WHERE (a.idReLab = y.idReLab) AND (y.statusData = ?))");
			$query->bind_param('ssss', $auxbusca, $auxbusca, $auxbusca, $filto);
		}else{
			$query = $db->prepare("SELECT a.idReEq FROM tbReservaEq a inner join tbUsuario e on a.idUser = e.idUser
				WHERE a.tituloReEq LIKE ? OR e.nomeUser LIKE ? OR e.cpf LIKE ?");
			$query->bind_param('sss', $auxbusca, $auxbusca, $auxbusca);
		}
	}elseif(isset($filtro) && $filtro != 'Todos'){
		$query = $db->prepare("SELECT a.idReEq FROM tbReservaEq a WHERE EXISTS (SELECT y.idReEq FROM tbControleDataEq y 
			WHERE (a.idReLab = y.idReLab) AND (y.statusData = ?))");
		$query->bind_param('s', $filto);
	}else{
		$query = $db->prepare("SELECT idReEq FROM tbReservaEq");
	}
	$query->execute();
	$query->store_result();
	$total = $query->num_rows;
	if($total > 0){
		$numPaginas = ceil($total/NumReg);
		if($pagina > $numPaginas){
			$pagina = $numPaginas;
		}
		//variavel para calcular o início da visualização com base na página atual
		$inicio = (NumReg*$pagina)-NumReg;
		//seleciona os itens por página
		$query->free_result();
		$query->close();
		//seleciona os itens por página
		if(isset($busca)){
			if(isset($filtro) && $filtro != 'Todos'){
				$query = $db->prepare("SELECT a.motivoReEq, a.idReEq, e.nomeUser, e.idUser, a.tituloReEq FROM tbReservaEq a 
					inner join tbUsuario e on a.idUser = e.idUser WHERE (a.tituloReEq LIKE ? OR e.nomeUser LIKE ? OR e.cpf LIKE ?)
					AND EXISTS (SELECT y.idReEq FROM tbControleDataEq y WHERE (a.idReLab = y.idReLab) AND (y.statusData = ?))
					ORDER BY idReEq DESC LIMIT ?,".NumReg);
				$query->bind_param('ssssi', $auxbusca, $auxbusca, $auxbusca, $filto, $inicio);
			}else{
				$query = $db->prepare("SELECT a.motivoReEq, a.idReEq, e.nomeUser, e.idUser, a.tituloReEq FROM tbReservaEq a 
					inner join tbUsuario e on a.idUser = e.idUser WHERE a.tituloReEq LIKE ? OR e.nomeUser LIKE ? OR e.cpf LIKE ? 
					ORDER BY idReEq DESC LIMIT ?,".NumReg);
				$query->bind_param('sssi', $auxbusca, $auxbusca, $auxbusca, $inicio);
			}
		}elseif(isset($filtro) && $filtro != 'Todos'){
			$query = $db->prepare("SELECT a.motivoReEq, a.idReEq, e.nomeUser, e.idUser, a.tituloReEq FROM tbReservaEq a
				inner join tbUsuario e on a.idUser = e.idUser WHERE EXISTS (SELECT y.idReEq FROM tbControleDataEq y 
				WHERE (a.idReLab = y.idReLab) AND (y.statusData = ?)) ORDER BY idReEq DESC LIMIT ?,".NumReg);
			$query->bind_param('si', $filto, $inicio);
		}else{
			$query = $db->prepare("SELECT a.motivoReEq, a.idReEq, e.nomeUser, e.idUser, a.tituloReEq FROM tbReservaEq a 
				inner join tbUsuario e on a.idUser = e.idUser ORDER BY idReEq DESC LIMIT ?,".NumReg);
			$query->bind_param('i', $inicio);
		}
		$query->execute();
		$query->bind_result($motivoReEq, $idReEq, $nomeUser, $idUser, $tituloReEq);
	}
	$auxDb = Atalhos::getBanco();
	if($aux = $auxDb->prepare("SELECT a.idReEq, a.idData FROM tbControleDataEq a WHERE statusData='Expirado' AND EXISTS 
		(SELECT b.idReEq FROM tbChoqueEq b WHERE (a.idReEq = b.idReEq AND a.idData = a.idData) OR 
		(a.idReEq = b.idChoqueReEq AND a.idData = b.idChoqueData))")){
		$aux->execute();
		$aux->bind_result($idRe, $idData);
		while($aux->fetch()){
			$conjunto = Atalhos::getConjunto($idRe, $idData, 1);
            Atalhos::deletarConjunto($idRe, $idData, 1);
            Atalhos::verificarConjunto($conjunto, 1);
		}
		$aux->close();
	}
	$ch = Atalhos::getBanco();
	if($choque = $ch->prepare("SELECT idReEq, idData, idChoqueReEq, idChoqueData FROM tbChoqueEq")){
		$choque->execute();
		$choque->bind_result($idReEq, $idData, $idChoqueReEq, $idChoqueData);
		$choque->store_result();
	}
	$contChoque = 0;
?>
      <!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<?php include 'filtroRe.php' ?>
		  	<h1>
		    	Moderar Reservas
		    	<small>Equipamentos</small>
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
		    	elseif(isset($_SESSION['errorModerarEqp'])):
		    		if($_SESSION['errorModerarEqp'] == 1):
		    ?>
						<div class="callout callout-danger">
							<h4>Justificativa é obrigatoria!</h4>
							<p>Para negar ou cancelar é necessario justificar.</p>
						</div>
		    <?php
		      		else:
		    ?>
						<div class="callout callout-danger">
							<h4>Erro em Entregar Equipamento!</h4>
							<p>Um ou mais equipamentos não foram selecionados para serem entregues.</p>
						</div>
			<?php
					endif;
		      		unset($_SESSION['errorModerarEqp']);
		      	endif;
		    ?>
          	<div class="row">
            	<div class="col-xs-12">
            		<div class="col-md-12">
            			<div class="nav-tabs-custom">
			                <ul class="nav nav-tabs">
								<li class="active"><a href="#tab_1" data-toggle="tab">Todas Reservas</a></li>
								<li>
									<a href="#tab_2" data-toggle="tab">Reservas com Choque 
										<?php 
											if($choque->num_rows > 0){
												echo '<i class="fa fa-exclamation "></i>';
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
									                      placeholder="Nome, CPF ou titulo da reserva" <?php echo 'value="'.$busca.'"'?> />
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
								        	<div class="box-body table-responsive no-padding">
												<table class="table table-hover">
													<tr>
													  <th><center>Titulo</center></th>
													  <th><center>Usuário</center></th>
													  <th><center>Horário a ser reservado</center></th>
													  <th><center>Equipamento</center></th>
													  <th><center>Status</center></th>
													  <th><center>Motivo</center></th>
													  <th><center>Ação</center></th>
													  <th></th>
													  <th></th>
													</tr>
								                    <?php
							                      	while($query->fetch()){
							                      		if(isset($filto) && $filtro != 'Todos'){
							                      			if($aux = $auxDb->prepare("SELECT f.inicio, f.fim, y.statusData, y.justificativa, y.idData 
							                      				FROM tbControleDataEq y inner join tbData f on y.idData = f.idData WHERE y.idReEq = ? 
							                      				AND (y.statusData = ?) ORDER BY f.inicio ASC")){
							                      				$aux->bind_param('is', $idReEq, $filto);
							                      			}
							                      		}else{
							                      			if($aux = $auxDb->prepare("SELECT f.inicio, f.fim, y.statusData, y.justificativa, y.idData 
							                      				FROM tbControleDataEq y inner join tbData f on y.idData = f.idData WHERE y.idReEq = ? 
																ORDER BY f.inicio ASC")){
							                      				$aux->bind_param('i', $idReEq);
							                      			}
							                      		}
							                      		$aux->execute();
							                      		$aux->bind_result($inicio, $fim, $statusData, $justificativa, $idData);
							                      		$aux->store_result();
								                        //separa os status
								                        if($aux->num_rows > 1){
												    		$pendente = $cancelar = false;
															$es = '';
															$statusR = -1;
															while ($aux->fetch()){
																//separa os status
																$acao = 'Nenhuma ação possivel';
																switch($statusData){
																	case 'Aprovado':
																		$status = '<span class="label label-success">APROVADO</span>';
																		$acao = '<form action="/entregar-equipamento" method="get">
																		<input type="hidden" name="idReEq" value="'.$idReEq.'">
																		<input type="hidden" name="idData" value="'.$idData.'">
																		<input type="submit" class="btn btn-block btn-primary btn-xs" value="Entregar Equipamento"></form> 
																		<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
																		data-solict-id="'.$idData.'" data-solict-tipo="Cancelado" data-solict-frase="Cancelar" 
																		data-solict-idre="'.$idReEq.'" data-solict-titulo="'.$tituloReEq.'"
																		data-solict-iduser="'.$idUser.'">Cancelar</button>';
																		break;
																	case 'Pendente':
																		$status = '<span class="label label-warning">PENDENTE</span>';
																		$acao = '<button class="btn btn-block btn-success btn-xs" data-toggle="modal" data-target="#simples"
																		data-solict-id="'.$idData.'" data-solict-tipo="Aprovado" data-solict-frase="Aprovar" 
																		data-solict-idre="'.$idReEq.'" data-solict-iduser="'.$idUser.'"
																		data-solict-titulo="'.$tituloReEq.'" >Aprovar</button>
																		<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
																		data-solict-id="'.$idData.'" data-solict-tipo="Negado" data-solict-frase="Negar"
																		data-solict-idre="'.$idReEq.'"  data-solict-iduser="'.$idUser.'"
																		data-solict-titulo="'.$tituloReEq.'" >Negar</button>';                         
																		break;
																	case 'Entregue':
																		$status = '<span class="label label-primary">ENTREGUE</span>';
																		$acao = '<button class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#simples" 
																		data-solict-id="'.$idData.'" data-solict-tipo="Recebido" 
																		data-solict-frase="Receber chave" data-solict-idre="'.$idReEq.'"
																		data-solict-titulo="'.$tituloReEq.'">Receber Equipamento</button>';
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
																	if($status !== $statusR){
																	$statusR = ' - ';
																	}
																}
																if($statusData == 'Pendente'){
																	$pendente = true;
																}else if($statusData == 'Aprovado'){
																	$cancelar = true;
																}
																$inicioData = strtotime($inicio);
																$fimData = strtotime($fim);
																$es.= '<tr align="center">
																	<td>'.wordwrap($tituloReEq, 20, "</br>", false).'</td>
																	<td></td>
																	<td>'.Atalhos::getData(strtotime($inicio), strtotime($fim)).'</td>
																	<td></td>
																	<td>'.$status.'</td>
																	<td></td>';
																if ($statusData == 'Aprovado' || $statusData == 'Entregue'){
																	$es .= '<td>'.$acao.'</td>';
																}else{
																	$es .= '<td>Nenhuma ação possivel</td>';
																}
																$es .='<td><button class="close" data-target="#simples" data-solict-id="'.$idData.'"
										                          data-solict-tipo="Excluir" data-toggle="modal" data-solict-frase="Excluir" data-solict-idre="'.$idReEq.'" 
										                          data-solict-titulo="'.$tituloReEq.'" data-solict-iduser="'.$idUser.'"><span aria-hidden="true">&times;</span>
										                          </button></td></tr>';
															}
															if($pendente == true){
																$acao = '<button class="btn btn-block btn-success btn-xs" data-toggle="modal" data-target="#simples"
																		data-solict-id="0" data-solict-tipo="Aprovado" data-solict-frase="Aprovar Todos" 
																		data-solict-idre="'.$idReEq.'" data-solict-iduser="'.$idUser.'" 
																		data-solict-titulo="'.$tituloReEq.'">Aprovar Todoss</button>
																		<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
																		data-solict-id="'.$idData.'" data-solict-tipo="Negado" data-solict-frase="Negar Todos"
																		data-solict-idre="'.$idReEq.'" data-solict-todos="sim"
																		data-solict-titulo="'.$tituloReEq.'" >Negar Todos</button>'; 
															}else if($cancelar == true){
																$acao = '<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
																		data-solict-id="0"	data-solict-tipo="Cancelado" data-solict-frase="Cancelar Todos" 
																		data-solict-idre="'.$idReEq.'" data-solict-iduser="'.$idUser.'"
																		data-solict-titulo="'.$tituloReEq.'">Cancelar Todos</button>';
															}else{
																$acao = 'Nenhuma ação possivel';
															}
															echo '<tr align = "center">
																<td>'.wordwrap($tituloReEq, 20, "</br>", false).'</td>
																<td>'.wordwrap($nomeUser, 20, "</br>", false).'</td>
																<td>-</td>
																<td>';
															$bd = Atalhos::getBanco();
															if($temp = $bd->prepare("SELECT b.tipoEq, a.numReEq FROM tbReservaTipoEq a inner join tbTipoEq b 
																on a.idTipoEq = b.idTipoEq WHERE a.idReEq = ?")){
																$temp->bind_param('i', $idReEq);
																$temp->execute();
																$temp->bind_result($tipoEq, $numReEq);
																while($temp->fetch()){
																	echo '<label>'.$numReEq.' - '.$tipoEq.'</label><br>';
																}
															}
															$temp->close();
															$bd->close();
															echo '</td>
																<td>'.$statusR.'</td>
																<td><a class="btn btn-block" data-toggle="tooltip" 
																title="'.$motivoReEq.'""><i class=" fa fa-comment "></a></td>
																<td>'.$acao.'</td>';
															echo '<td><button class="close" data-target="#simples" data-solict-id="0"
									                          data-solict-tipo="Excluir" data-toggle="modal" data-solict-frase="Excluir" data-solict-idre="'.$idReEq.'" 
									                          data-solict-titulo="'.$tituloReEq.'" data-solict-iduser="'.$idUser.'"><span aria-hidden="true">&times;</span>
									                          </button></td>';
															echo '<td><a data-toggle="collapse" data-parent="#accordion" href="#'.$idReEq.'" 
																onclick="TrocarClass('.$idReEq.')"><i class="fa fa-fw fa-plus-circle" 
																id="Rec'.$idReEq.'"></a></td></tr><tbody id="'.$idReEq.'" 
																class="table-collapse collapse">'.$es;
															echo '</tr>';
														}else{
															$aux->fetch();
															$acao = 'Nenhuma ação possivel';
															switch($statusData){
																case 'Aprovado':
																	$status = '<span class="label label-success">APROVADO</span>';
																	$acao = '<form action="/entregar-equipamento" method="get">
																	<input type="hidden" name="idReEq" value="'.$idReEq.'">
																	<input type="hidden" name="idData" value="'.$idData.'">
																	<input type="submit" class="btn btn-block btn-primary btn-xs" value="Entregar Equipamento"></form>
																	<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
																	data-solict-id="'.$idData.'" data-solict-tipo="Cancelado" data-solict-frase="Cancelar" 
																	data-solict-idre="'.$idReEq.'" data-solict-titulo="'.$tituloReEq.'"
																	data-solict-iduser="'.$idUser.'">Cancelar</button>';
																	break;
																case 'Pendente':
																	$status = '<span class="label label-warning">PENDENTE</span>';
																	$acao = '<button class="btn btn-block btn-success btn-xs" data-toggle="modal" data-target="#simples"
																	data-solict-id="'.$idData.'" data-solict-tipo="Aprovado" data-solict-frase="Aprovar" 
																	data-solict-idre="'.$idReEq.'" data-solict-titulo="'.$tituloReEq.'"
																	data-solict-iduser="'.$idUser.'">Aprovar</button>
																	<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
																	data-solict-id="'.$idData.'" data-solict-tipo="Negado" data-solict-frase="Negar"
																	data-solict-idre="'.$idReEq.'" data-solict-titulo="'.$tituloReEq.'"
																	data-solict-iduser="'.$idUser.'">Negar</button>';                     
																	break;
																case 'Entregue':
																	$status = '<span class="label label-primary">ENTREGUE</span>';
																	$acao = '<button class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#simples" 
																	data-solict-id="'.$idData.'" data-solict-tipo="Recebido" 
																	data-solict-frase="Receber chave" data-solict-idre="'.$idReEq.'"
																	data-solict-titulo="'.$tituloReEq.'" >Receber Equipamento</button>';
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
															echo '<tr align = "center">
																<td>'.wordwrap($tituloReEq, 20, "</br>", false).'</td>
																<td>'.wordwrap($nomeUser, 20, "</br>", false).'</td>
																<td>'.Atalhos::getData(strtotime($inicio), strtotime($fim)).'</td>
																<td>';
															$bd = Atalhos::getBanco();
															if($temp = $bd->prepare("SELECT b.tipoEq, a.numReEq FROM tbReservaTipoEq a inner join tbTipoEq b 
																on a.idTipoEq = b.idTipoEq WHERE a.idReEq = ?")){
																$temp->bind_param('i', $idReEq);
																$temp->execute();
																$temp->bind_result($tipoEq, $numReEq);
																while($temp->fetch()){
																	echo '<label>'.$numReEq.' - '.$tipoEq.'</label><br>';
																}
															}
															$temp->close();
															$bd->close();
															echo '</td>
																<td>'.$status.'</td>
																<td><a class="btn btn-block" data-toggle="tooltip" 
																title="'.$motivoReEq.'""><i class=" fa fa-comment "></a></td>
																<td>'.$acao.'</td>';
															echo '<td><button class="close" data-target="#simples" data-solict-id="0" data-solict-tipo="Excluir"
									                          data-toggle="modal" data-solict-frase="Excluir" data-solict-idre="'.$idReEq.'" 
									                          data-solict-iduser="'.$idUser.'" data-solict-titulo="'.$tituloReEq.'">
									                          <span aria-hidden="true">&times;</span></button></td>
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
				                      				include 'paginacao.php';
				                      			?>                      
											</div><!-- /.box -->
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
													<tr>
													  <th><center>Titulo</center></th>
													  <th><center>Usuário</center></th>
													  <th><center>Horário a ser reservado</center></th>
													  <th><center>Equipamento</center></th>
													  <th><center>Status</center></th>
													  <th><center>Motivo</center></th>
													  <th><center>Ação</center></th>
													  <th></th>
													</tr>
													<?php
														$anterior[0] = 0;
							                    		$anterior[1] = 0;
							                    		while($choque->fetch()){
							                    			if($anterior[0] != $idReEq || $anterior[1] != $idData){
							                    				if($aux = $auxDb->prepare("SELECT a.motivoReEq, e.nomeUser, e.idUser, a.tituloReEq, 
							                    					b.statusData, c.inicio, c.fim FROM tbReservaEq a inner join tbUsuario e 
							                    					on a.idUser = e.idUser inner join tbControleDataEq b on b.idReEq = a.idReEq
									                    			inner join tbData c on c.idData = b.idData WHERE a.idReEq = ? AND b.idData = ?")){
								                      				$aux->bind_param('ii', $idReEq, $idData);
								                      				$aux->execute();
			                      									$aux->bind_result($motivoReEq, $nomeUser, $idUser, $tituloReEq, $statusData, $inicio, $fim);
			                      									$aux->fetch();
			                      									$aux->close();
								                      			}
							                    				if($anterior[0] != 0){
							                    					echo '</tbody></tr>';
							                    				}
							                    				echo '<tr align = "center">
																		<td>'.wordwrap($tituloReEq, 20, "</br>", false).'</td>
																		<td>'.wordwrap($nomeUser, 20, "</br>", false).'</td>
																		<td>'.Atalhos::getData(strtotime($inicio), strtotime($fim)).'</td>
																		<td>';
																$bd = Atalhos::getBanco();
																if($temp = $bd->prepare("SELECT b.tipoEq, a.numReEq FROM tbReservaTipoEq a inner join tbTipoEq b 
																	on a.idTipoEq = b.idTipoEq WHERE a.idReEq = ?")){
																	$temp->bind_param('i', $idReEq);
																	$temp->execute();
																	$temp->bind_result($tipoEq, $numReEq);
																	while($temp->fetch()){
																		echo '<label>'.$numReEq.' - '.$tipoEq.'</label><br>';
																	}
																}
																$temp->close();
																$bd->close();
																if($statusData == 'Aprovado'){
																	$status = '<span class="label label-success">APROVADO</span>';
																	$acao = '<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
																		data-solict-id="'.$idData.'" data-solict-tipo="Cancelado" data-solict-frase="Cancelar" 
																		data-solict-idre="'.$idReEq.'"  data-solict-iduser="'.$idUser.'"
																		data-solict-titulo="'.$tituloReEq.'">Cancelar</button>';
																}elseif($statusData == 'Pendente'){
																	$status = '<span class="label label-warning">PENDENTE</span>';
																	$acao = '<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
																		data-solict-id="'.$idData.'" data-solict-tipo="Negado" data-solict-frase="Negar"
																		data-solict-idre="'.$idReEq.'" data-solict-iduser="'.$idUser.'"
																		data-solict-titulo="'.$tituloReEq.'">Negar</button>';                         
																}else{
																	$status = '<span class="label label-primary">ENTREGUE</span>';
																	$acao = 'Nenhuma ação possivel';   
																}
							                    				echo '</td>
																	<td>'.$status.'</td>
																	<td><a class="btn btn-block" data-toggle="tooltip" 
																	title="'.$motivoReEq.'"><i class=" fa fa-comment "></a></td>
																	<td>'.$acao.'</td>
																	<td><a data-toggle="collapse" data-parent="#accordion" href="#'.$contChoque.'" 
																	onclick="TrocarClass('.$idData.')"><i class="fa fa-fw fa-plus-circle" 
																	id="Rec'.$idData.'"></a></td></tr><tbody id="'.$contChoque++.'" 
																	class="table-collapse collapse">';
																echo '</tr>';
																$anterior[0] = $idReEq;
																$anterior[1] = $idData;
							                    			}
							                    			if($aux = $auxDb->prepare("SELECT a.motivoReEq, e.nomeUser, e.idUser, a.tituloReEq, 
						                    					b.statusData, c.inicio, c.fim FROM tbReservaEq a inner join tbUsuario e 
						                    					on a.idUser = e.idUser inner join tbControleDataEq b on b.idReEq = a.idReEq
								                    			inner join tbData c on c.idData = b.idData WHERE a.idReEq = ? AND b.idData = ?")){
							                      				$aux->bind_param('ii', $idChoqueReEq, $idChoqueData);
							                      				$aux->execute();
		                      									$aux->bind_result($motivoReEq, $nomeUser, $idUser, $tituloReEq, $statusData, $inicio, $fim);
		                      									$aux->fetch();
		                      									$aux->close();
							                      			}
							                    			echo '<tr align = "center">
																		<td>'.wordwrap($tituloReEq, 20, "</br>", false).'</td>
																		<td>'.wordwrap($nomeUser, 20, "</br>", false).'</td>
																		<td>'.Atalhos::getData(strtotime($inicio), strtotime($fim)).'</td>
																		<td>';
															$bd = Atalhos::getBanco();
															if($temp = $bd->prepare("SELECT b.tipoEq, a.numReEq FROM tbReservaTipoEq a inner join tbTipoEq b 
																on a.idTipoEq = b.idTipoEq WHERE a.idReEq = ?")){
																$temp->bind_param('i', $idReEq);
																$temp->execute();
																$temp->bind_result($tipoEq, $numReEq);
																while($temp->fetch()){
																	echo '<label>'.$numReEq.' - '.$tipoEq.'</label><br>';
																}
															}
															$temp->close();
															$bd->close();
															if($statusData == 'Aprovado'){
																$status = '<span class="label label-success">APROVADO</span>';
																$acao = '<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
																	data-solict-id="'.$idChoqueData.'" data-solict-tipo="Cancelado" data-solict-frase="Cancelar" 
																	data-solict-idre="'.$idChoqueReEq.'" data-solict-iduser="'.$idUser.'"
																	data-solict-titulo="'.$tituloReEq.'">Cancelar</button>';
															}elseif($statusData == 'Pendente'){
																$status = '<span class="label label-warning">PENDENTE</span>';
																$acao = '<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
																	data-solict-id="'.$idChoqueData.'" data-solict-tipo="Negado" data-solict-frase="Negar"
																	data-solict-idre="'.$idChoqueReEq.'" data-solict-iduser="'.$idUser.'"
																	data-solict-titulo="'.$tituloReEq.'">Negar</button>';                         
															}else{
																$status = '<span class="label label-primary">ENTREGUE</span>';
																$acao = 'Nenhuma ação possivel';    
															}
						                    				echo '</td>
																<td>'.$status.'</td>
																<td><a class="btn btn-block" data-target="#motivo" data-toggle="tooltip" 
																title="'.$motivoReEq.'""><i class=" fa fa-comment "></a></td>
																<td>'.$acao.'</td>
																</tr>';
							                    		}
							                    		$choque->close();
							                    		$ch->close();
							                    		$auxDb->close();
													?>
												</table>
					                	<?php } ?>
					                </div><!-- /.tab-pane -->
							    </div>
					        </div>
          				</div>
          			</div>
			    </div>
			</div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
	<!-- APROVAR -->
	<div class="modal fade" id="simples" tabindex="-1" role="dialog" aria-labelledby="exampleModalEqel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <h4 class="modal-title" id="exampleModalEqel"></h4>
				</div>
				<form role="form" action="post.php" method="post" name="formulario" id="formulario">
					<div class="modal-body">
						<input type="hidden" id="numPost" name="numPost" value="3"><!-- Número correspodente ao post -->
					    <input type="hidden" name="id" id="id"/>
					    <input type="hidden" name="acao" id="acao"/>
					    <input type="hidden" name="idreeq" id="idreeq"/>
					    <input type="hidden" name="idUser" id="idUser" />
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					  <button type="submit" class="btn btn-success">Confirmar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
    <!-- FIM APROVAR -->
    <!-- NEGAR --> 
	<div class="modal fade" id="negativo" tabindex="-1" role="dialog" aria-labelledby="exampleModalEqel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="exampleModalEqel"></h4>
				</div>
				<form role="form" action="post.php" method="post" name="formulario" id="formulario">
					<div class="modal-body">
					<input type="hidden" id="numPost" name="numPost" value="3"><!-- Número correspodente ao post -->
						<input type="hidden" name="id2" id="id2"/>
						<input type="hidden" name="acao2" id="acao2"/>
						<input type="hidden" name="idreeq2" id="idreeq2"/>
						<input type="hidden" name="idUser2" id="idUser2" />
						<div class="form-group">
							<label for="message-text" class="control-label">Justificativa:(obrigatorio)</label>
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
	<?php include 'rodape.php' ?>
</div><!-- ./wrapper -->
    <?php include 'script.php' ?>
<script>
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
		$('#acao').val(tipo)
		$('#idreeq').val(idRe)
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
		$('#acao2').val(tipo)
		$('#idreeq2').val(idRe)
		$('#idUser2').val(idUser)
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