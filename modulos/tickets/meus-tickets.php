<?php
	include '../../includes/topo.php';
  include '../../includes/statistics.php';

?>
<title>AdminDcomp - Tickets</title>
</head>
<?php
  if(!$_SESSION['logado']){
    header('Location: /inicio');
  }
	include '../../includes/barra.php';
	include '../../includes/menu.php';
  $_SESSION['irPara'] = '/inicio';
  $db = atalhos::getBanco();
  $link = '/tickets/meus';
	if($query = $db->prepare("SELECT idTicket, idAssunto, tituloTicket, data, statusTicket, avalicao FROM tbticket WHERE idUser = ? ORDER BY statusTicket ASC")){
    $query->bind_param('i', $_SESSION['id']);
    $query->execute();
    $query->bind_result($idTicket, $idAssunto, $titulo, $data, $status, $avalicao);
  }
  $db_aux = atalhos::getBanco();
  
  $statistic = new Statistics();

  // Média de Conclusão
  //$statistic->getTimeClose();

  //Media de Tempo
  $mediaAtend = $statistic->getTimeResponse();;
  $mediaNota = $statistic->getRating();;

  //Numero de Tickets Respondidos
  if ($aux = $db_aux->prepare("SELECT idTicket FROM tbticket WHERE statusTicket = 'Respondido' AND idUser = ?")){
    $aux->bind_param('i', $_SESSION['id']);
    $aux->execute();
    $aux->store_result();
    $ticketsRespondidos = $aux->num_rows;
    $aux->close();
  }
  
  //Numero de Tickets Concluídos
  if ($aux = $db_aux->prepare("SELECT idTicket FROM tbticket WHERE statusTicket = 'Concluido' AND idUser = ?")){
    $aux->bind_param('i', $_SESSION['id']);
    $aux->execute();
    $aux->store_result();
    $ticketsConcluidos = $aux->num_rows;
    $aux->close();
  }?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
  		    <h1>
  		      Tickets
  		      <small>Suporte</small>
  		    </h1>
      </section>

    <!-- Main content -->
    <section class="content">

      <section class="content">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-time"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Tempo Médio de Resposta</span>
                <span class="info-box-number">
                <?php 
                  if($mediaAtend > 1){
                    echo $mediaAtend.' horas';
                  }else{
                    echo '< 1 hora';
                  }
                ?></span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fa fa-bar-chart"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Nota Média</span>
                <span class="info-box-number"><?php echo $mediaNota ?></span>
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
							<table id="example1" class="table table-striped">
							  <thead>
                  <tr>
                    <th><center>ID</center></th>
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
                        $acao = '<button class="btn btn-block btn-primary btn-xs" onclick="location.href=\'/tickets/historico/'.$_SESSION['id'].'/'.$idTicket.'/\'">Ver Histórico</button>';
                        break;
                      case 'Em Analise':
                        $statusTicket = '<span class="label label-warning">AGUARDANDO</span>';
                        $acao = '<button class="btn btn-block btn-primary btn-xs" onclick="location.href=\'/tickets/historico/'.$_SESSION['id'].'/'.$idTicket.'/\'">Ver Histórico</button><button class="btn btn-block btn-success btn-xs" data-toggle="modal" data-target="#simples" data-solict-idticket="'.$idTicket.'" data-solict-tipo="3" data-solict-frase="Finalizar">Finalizar</button>';
                        break;
                      case 'Em Atendimento':
                        $statusTicket = '<span class="label label-warning">AGUARDANDO</span>';
                        $acao = '<button class="btn btn-block btn-primary btn-xs" onclick="location.href=\'/tickets/historico/'.$_SESSION['id'].'/'.$idTicket.'/\'">Ver Histórico</button><button class="btn btn-block btn-success btn-xs" data-toggle="modal" data-target="#simples" data-solict-idticket="'.$idTicket.'" data-solict-tipo="3" data-solict-frase="Finalizar">Finalizar</button>';
                        break;
                      case 'Respondido':
                        $statusTicket = '<span class="label label-primary">ATENDIDO</span>';
                        $acao = '<button class="btn btn-block btn-primary btn-xs" onclick="location.href=\'/tickets/historico/'.$_SESSION['id'].'/'.$idTicket.'/\'">Ver Histórico</button><button class="btn btn-block btn-success btn-xs" data-toggle="modal" data-target="#simples" data-solict-idticket="'.$idTicket.'" data-solict-tipo="3" data-solict-frase="Finalizar">Finalizar</button><button class="btn btn-block btn-danger btn-xs" onclick="location.href=\'/tickets/historico/'.$_SESSION['id'].'/'.$idTicket.'/\'">Reabrir</button>';
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
                            <td><a href="/tickets/historico/'.$_SESSION['id'].'/'.$idTicket.'/">'.$titulo.'</a></td>
                            <td>'.$assunto.'</td>
                            <td>'.date("d/m/Y", strtotime($data)).'</td>
                            <td>'.$statusTicket.'</td>
                            <td>'.$acao.'</td>';
                    echo '</tr>';
                  }
                  $query->close();
                  $db->close();
                ?>
              </table>
            </div><!-- /.box-body -->
          </div>
        </div>
      </div>
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <div class="modal fade" id="simples" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel"></h4>
        </div>
        <form role="form" action="post/" method="post" name="formulario1" id="formulario1">
        <div class="modal-body">
          <input type="hidden" id="numPost" name="numPost" value="44"><!-- Número correspodente ao post -->
          <input type="hidden" name="idticket" id="idticket"/>
          <input type="hidden" name="acao" id="acao"/>
          <div class="form-group">
            <label>Classifique seu atentimento:</label>
            <div class="col-md-9">
              <select name="rating" class="form-control">
                <option value="">Escolha</option>
                <option value="1">1 - Muito Insatisfeito</option>
                <option value="2">2 - Insatisfeito</option>
                <option value="3">3 - Neutro</option>
                <option value="4">4 - Satisfeito</option>
                <option value="5">5 - Muito Satisfeito</option>
              </select>
            </div>
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
  <?php include '../../includes/rodape.php' ?>
</div><!-- ./wrapper -->
  <?php include '../../includes/script.php' ?>

	<script>
  $(function () {
    $.fn.dataTable.moment('DD/MM/YYYY');
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
      }
    });
  });
</script>
<script>
  $('#simples').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var tipo = button.data('solict-tipo')
    var frase = button.data('solict-frase')
    var id = button.data('solict-idticket')
    var modal = $(this)
    modal.find('.modal-title').text(frase + ' ticket')
    $('#idticket').val(id)
    $('#acao').val(tipo)
  })

</script>
</body>
</html>
