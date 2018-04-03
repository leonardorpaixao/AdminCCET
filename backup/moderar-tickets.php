<?php
	include 'topo.php';
?>
<title>AdminDcomp - Tickets</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['afiliacao'] > 7 || $_SESSION['afiliacao'] < 5){
    header('Location: /inicio');
  }
	include 'barra.php';
	include 'menu.php';
  $_SESSION['irPara'] = '/inicio';
  $db = atalhos::getBanco();
  $link = '/tickets/moderar';
	if($query = $db->prepare("SELECT a.idTicket, a.idAssunto, a.tituloTicket, a.data, a.statusTicket, b.nomeUser, a.idUser, a.avalicao FROM tbTicket a inner join tbUsuario b on a.idUser = b.idUser ORDER BY a.statusTicket ASC")){
    $query->execute();
    $query->bind_result($idTicket, $idAssunto, $titulo, $data, $status, $nome, $idUser, $avalicao);
  }
  //Media de tempo
  $mediaAtend = atalhos::mediaAtendimento();
  //Numero de Tickets Pendentes
  $db_aux = atalhos::getBanco();
  if ($aux = $db_aux->prepare("SELECT idTicket FROM tbTicket WHERE statusTicket = 'Em Analise'")){
    $aux->execute();
    $aux->store_result();
    $ticketsPendentes = $aux->num_rows;
    $aux->close();
  }
  //Numero de Tickets Respondidos
  if ($aux = $db_aux->prepare("SELECT idTicket FROM tbTicket WHERE statusTicket = 'Respondido'")){
    $aux->execute();
    $aux->store_result();
    $ticketsRespondidos = $aux->num_rows;
    $aux->close();
  }
  //Numero de Tickets Concluídos
  if ($aux = $db_aux->prepare("SELECT idTicket FROM tbTicket WHERE statusTicket = 'Concluido'")){
    $aux->execute();
    $aux->store_result();
    $ticketsConcluidos = $aux->num_rows;
    $aux->close();
  }
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
  		    <h1>
  		      Tickets
  		      <small>Suporte</small>
  		    </h1>
      </section>
      <!--
        Estatisticas
          1. Média da Nota
          2. Tempo Médio de Resposta
          3. Tickets Pendentes*
          4. ? ? ?
      -->
        <!-- Main content -->


    <!-- Main content -->
    <section class="content">

      <section class="content">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-time"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Tempo Médio</span>
                <span class="info-box-number">
                <?php 
                  if($mediaAtend[0] > 0){ 
                    echo $mediaAtend[0].'.'.$mediaAtend[1].' dias';
                  }else{ 
                    echo $mediaAtend[1]; 
                  }
                ?></span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fa fa-exclamation"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Tickets Pendentes</span>
                <span class="info-box-number"><?php echo $ticketsPendentes ?></span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix visible-sm-block"></div>

          <div class="col-md-3 col-sm-6 col-xs-12"> 
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-comments"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Tickets Atendidos</span>
                <span class="info-box-number"><?php echo $ticketsRespondidos ?></span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Tickets Finalizados</span>
                <span class="info-box-number"><?php echo $ticketsConcluidos ?></span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->
        </div><!-- /.row -->

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body table-responsive">
							<table id="example1" class="table table-bordered table-striped">
							  <thead>
                  <tr>
                    <th><center>ID</center></th>                 
                    <th><center>Nome</center></th>
                    <th><center>Titulo</center></th>
                    <th><center>Assunto</center></th>
                    <th><center>Data</center></th>
                    <th><center>Status</center></th>
                    <th><center>Ação</center></th>
                  </tr>
							</thead>
                <?php
                  while ($query->fetch()) {
                    switch($status){
                      case 'Concluido':
                        if(isset($avalicao)){
                          $statusTicket = '<span class="label label-success" data-toggle="tooltip" title="Nota: '.$avalicao.'">FINALIZADO</span></a>';
                        }else{
                          $statusTicket = '<span class="label label-success" data-toggle="tooltip" title="Sem Nota">FINALIZADO</span></a>';
                        }
                        $acao = ' <button class="btn btn-block btn-primary btn-xs" onclick="location.href=\'/tickets/historico/'.$idUser.'/'.$idTicket.'/\'">Ver Histórico</button>';
                        break;
                      case 'Em Analise':
                        $statusTicket = '<span class="label label-warning">AGUARDANDO</span>';
                        $acao = '<button class="btn btn-block btn-primary btn-xs" onclick="location.href=\'/tickets/historico/'.$idUser.'/'.$idTicket.'/\'">Ver Histórico</button>';
                        break;
                      case 'Respondido':
                        $statusTicket = '<span class="label label-primary">ATENDIDO</span>';
                        $acao = ' <button class="btn btn-block btn-primary btn-xs" onclick="location.href=\'/tickets/historico/'.$idUser.'/'.$idTicket.'/\'">Ver Histórico</button>';
                        break;
                    }
                    switch($idAssunto){
                      case 0:
                        $assunto = 'Laboratórios';
                        break;
                      case 1:
                        $assunto = 'Equipamentos';
                        break;
                      case 2:
                        $assunto = 'Reclamações';
                        break;
                      case 3:
                        $assunto = 'Sugestões';
                        break;
                      case 4:
                        $assunto = 'Outros';
                        break;
                      case 5:
                        $assunto = 'E-mail Dcomp';
                        break;
                      case 6:
                        $assunto = 'Criar E-mail';
                        break;
                    }
                    echo '<tr align="center">
                            <td>'.$idTicket.'</td>
                            <td><a href="/tickets/historico/'.$idUser.'/'.$idTicket.'/">'.$nome.'</a></td>
                            <td>'.$titulo.'</td>
                            <td>'.$assunto.'</td>
                            <td>'.date("d/m/Y", strtotime($data)).'</td>
                            <td>'.$statusTicket.'</td>
                            <td>'.$acao.'</td>';
                    echo '</tr>';
                  }
                  $query->close();
                  $db->close();
                ?>

              </table><ul class="pagination pagination-sm no-margin pull-right">
                  <?php
                  include 'paginacao.php';
                  ?>
                </ul>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
          </div>
        </div>
      </div>
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <?php include 'rodape.php' ?>
</div><!-- ./wrapper -->
  <?php include 'script.php' ?>

	<script>
	  $(function () {
      $.fn.dataTable.moment('DD/MM/YYYY');
	    $('#example1').DataTable({
	      "paging": true,
	      "lengthChange": true,
	      "searching": true,
	      "ordering": true,
        "orderFixed": [[5, "asc"], [0 , "asc"]],
	      "info": false,
	      "autoWidth": false,
	      "language": {
	        "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
	      }
	    });
	  });
	</script>
</body>
</html>
