<?php
  include '../../includes/topo.php';
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 1){
    header('Location: /inicio');
  }
  if(isset($_GET['id'])){
    $idReserva = $_GET['id'];
  }else{
    header('Location: /inicio');
  }
?>
<title>AdminDcomp -  Controlar Reservas</title>
</head>
<?php
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $_SESSION['irPara'] = '/laboratorios/controlar/'.$idReserva.'/';

  $link = '/laboratorios/controlar/'.$idReserva.'/';
  $auxDb = Atalhos::getBanco();
  if($aux = $auxDb->prepare("SELECT a.idUser, a.tituloReLab, a.motivoReLab, b.nomeUser FROM tbReservaLab a INNER JOIN tbUsuario b ON a.idUser = b.idUser WHERE idReLab = ?")){
    $aux->bind_param('i', $idReserva);
    $aux->execute();
    $aux->bind_result($idUser, $tituloReLab, $motivoReLab, $nomeUser);
    $aux->fetch();
    $aux->close();
  }
  $auxDb->close();

  $db = Atalhos::getBanco();
  if($query = $db->prepare("SELECT b.inicio, b.fim, a.idLab, a.idReLab, a.idData FROM tbControleDataLab a NATURAL JOIN tbData b WHERE a.idReLab = ?")){
    $query->bind_param('i', $idReserva);
    $query->execute();
    $query->bind_result($inicio, $fim, $idLab, $idReLab, $idData);
    $query->store_result();
    $totalRows = $query->num_rows;
  }
  $todaReserva = array();
  if($totalRows < 2)
    while ($query->fetch()) {
      $disponiveis = Atalhos::verificarLab($inicio,$fim,$idReLab);
      $todaReserva[] = $disponiveis;
      $todaReserva[] = $disponiveis;
    }
  else{
    while ($query->fetch()) {
      $disponiveis = Atalhos::verificarLab($inicio,$fim,$idReLab);
      $todaReserva[] = $disponiveis;
    }
  }
  $insercaoLabs = call_user_func_array('array_intersect',$todaReserva);
  $query->close();
  $db->close();

  $db = Atalhos::getBanco();
  if($query = $db->prepare("SELECT idReLab, tituloReLab, nomeUser, idLab, inicio, fim, statusData, idData, idUser, justificativa FROM tbControleDataLab NATURAL JOIN tbReservaLab NATURAL JOIN tbUsuario JOIN tbData USING(idData) WHERE statusData != 'Pendente' AND idReLab = ? ORDER BY statusData ASC, inicio ASC")){
    $query->bind_param('i', $idReserva);
    $query->execute();
    $query->bind_result($idReLab, $tituloReLab, $nomeUser, $idLab, $inicio, $fim, $statusData, $idData, $idUser, $justificativa);
    $query->store_result();
    $totalRows = $query->num_rows;
  }
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Controlar Reserva #<?php echo $idReserva;?>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <?php
      if(isset($_SESSION['avisoLab'])):
    ?>
        <div class="callout callout-success">
          <h4><?php echo $_SESSION['avisoLab'] ?></h4>
        </div>
    <?php
        unset($_SESSION['avisoLab']);
      elseif(isset($_SESSION['errorLab'])):
    ?>
        <div class="callout callout-danger">
          <h4>Não foi determinado:</h4>
          <p><?php echo $_SESSION['errorLab'] ?></p>
        </div>
    <?php
        unset($_SESSION['errorLab']);
      endif;
    ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Detalhes da reserva</h3>
          </div>
          <div class="box-body table-responsive">
            <h5>Título da reserva: <b><?php echo $tituloReLab;?></b></h5>
            <h5>Motivo: <b><?php echo $motivoReLab;?></b></h5>
            <h5>Usuário: <b><?php echo $nomeUser;?></b></h5>
            <h5>Total de datas: <b><?php echo $totalRows;?></b></h5>
          </div>
          <form role="form" action="post/" method="post" id="formulario" autocomplete="off" class="formulario">
            <input type="hidden" id="numPost" name="numPost" value="4"><!-- Número correspodente ao post -->
            <input type="hidden" id="cancelarAll" name="cancelarAll" value="1"><!-- Número correspodente ao post -->
            <input type="hidden" id="idReLab" name="idReLab" value="<?php echo $idReLab; ?>"><!-- Número correspodente ao post -->
            <div class="box-footer">
              <button class="btn btn-danger">Cancelar todas as datas</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Todas as datas</h3>
          </div>
          <div class="box-body table-responsive">
            <!-- Tabela de Laboratórios -->
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th><center>Horário reservado</center></th>
                  <th><center>Laboratório</center></th>
                  <th><center>Status</center></th>
                  <th><center>Ações</center></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  //exibe os laboratorios selecionados
                  while ($query->fetch()) {
                    switch($statusData){
                      case 'Aprovado':
                        $status = '<span class="label label-success">APROVADO</span>';
                        $acao = '<button class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#simples"
                        data-solict-id="'.$idData.'" data-solict-tipo="Entregue"
                        data-solict-frase="Entregar chave" data-solict-idre="'.$idReLab.'"
                        data-solict-titulo="'.$tituloReLab.'">Entregar chave</button>
                        <button class="btn btn-block btn-danger
                        btn-xs" data-toggle="modal" data-target="#negativo" data-solict-id="'.$idData.'"
                        data-solict-tipo="Cancelado" data-solict-frase="Cancelar" data-solict-idre="'.$idReLab.'"
                        data-solict-titulo="'.$tituloReLab.'" data-solict-iduser="'.$idUser.'">Cancelar</button>';
                        break;
                      case 'Entregue':
                        $status = '<span class="label label-primary">ENTREGUE</span>';
                        $acao = '<button class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#simples"
                        data-solict-id="'.$idData.'" data-solict-tipo="Recebido"
                        data-solict-frase="Receber chave" data-solict-idre="'.$idReLab.'"
                         data-solict-titulo="'.$tituloReLab.'">Receber chave</button>';
                        break;
                      case 'Recebido':
                        $status = '<span class="label label-primary">RECEBIDO</span>';
                        $acao = 'Nenhuma.';
                        break;
                      case 'Negado':
                        $status = '<span class="label label-danger"data-toggle="tooltip"
                        title="'.$justificativa.'">NEGADO</span>';
                        $acao = 'Nenhuma.';
                        break;
                      case 'Cancelado':
                        $status = '<span class="label label-danger" data-toggle="tooltip"
                        title="'.$justificativa.'">CANCELADO</span>';
                        $acao = 'Nenhuma.';
                        break;
                      case 'Expirado':
                        $status = '<span class="label label-danger">EXPIRADO</span>';
                        $acao = 'Nenhuma.';
                        break;
                    }
                    $nomeLab = Atalhos::nomeLab($idLab);
                    $diaInicio = date("l", strtotime($inicio));
                    $diaFim = date("l", strtotime($fim));
                    
                    switch ($diaInicio) {
                      case 'Sunday':
                        $diaInicioPT = 'Domingo';
                        break;
                      case 'Monday':
                        $diaInicioPT = 'Segunda-feira';
                        break;
                      case 'Tuesday':
                        $diaInicioPT = 'Terça-feira';
                        break;
                      case 'Wednesday':
                        $diaInicioPT = 'Quarta-feira';
                        break;
                      case 'Thursday':
                        $diaInicioPT = 'Quinta-feira';
                        break;
                      case 'Friday':
                        $diaInicioPT = 'Sexta-feira';
                        break;
                      case 'Saturday':
                        $diaInicioPT = 'Sábado';
                        break;
                    }
                    switch ($diaFim) {
                      case 'Sunday':
                        $diaFimPT = 'Domingo';
                        break;
                      case 'Monday':
                        $diaFimPT = 'Segunda-feira';
                        break;
                      case 'Tuesday':
                        $diaFimPT = 'Terça-feira';
                        break;
                      case 'Wednesday':
                        $diaFimPT = 'Quarta-feira';
                        break;
                      case 'Thursday':
                        $diaFimPT = 'Quinta-feira';
                        break;
                      case 'Friday':
                        $diaFimPT = 'Sexta-feira';
                        break;
                      case 'Saturday':
                        $diaFimPT = 'Sábado';
                        break;
                    }
                    echo
                      '<tr align="center">
                        <td><b>Início:</b> '.date("d/m/Y - H:i", strtotime($inicio)).' ('.$diaInicioPT.')<br><b>Fim:</b> '.date("d/m/Y - H:i", strtotime($fim)).' ('.$diaFimPT.')</td>
                        <td>'.$nomeLab.'</td>
                        <td>'.$status.'</td>
                        <td>'.$acao.'</td>
                      </tr>';
                  }
                  $query->close();
                  $db->close();
                ?>
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
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
        <input type="hidden" id="numPost" name="numPost" value="4"><!-- Número correspodente ao post -->
        <input type="hidden" name="idData" id="idData"/>
        <input type="hidden" name="idReLab" id="idReLab"/>
        <input type="hidden" name="acao" id="acao"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>
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
              <input type="hidden" id="numPost" name="numPost" value="4"><!-- Número correspodente ao post -->
                <input type="hidden" name="idData2" id="idData2" />
                <input type="hidden" name="idReLab2" id="idReLab2" />
                <input type="hidden" name="acao2" id="acao2" />
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
<?php include '../../includes/rodape.php' ?>
    </div><!-- ./wrapper -->
    <?php include '../../includes/script.php' ?>
    <script>
    //DataTable
    $(function () {
      $('#example1').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
        }
      });

    });
    $('#simples').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var tipo = button.data('solict-tipo')
      var frase = button.data('solict-frase')
      var id = button.data('solict-id')
      var nome = button.data('solict-titulo')
      var idre = button.data('solict-idre');
      var modal = $(this)
      modal.find('.modal-title').text(frase + ' - ' + nome)
      $('#idData').val(id)
      $('#acao').val(tipo)
      $('#idReLab').val(idre)
    })

    $('#negativo').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var tipo = button.data('solict-tipo')
    var frase = button.data('solict-frase')
    var id = button.data('solict-id') // Extract info from data-* attributes
    var idRe = button.data('solict-idre')
    var modal = $(this)
    var titulo = button.data('solict-titulo')
    modal.find('.modal-title').text(frase + ' - ' + titulo)
      $('#idData2').val(id)
      $('#idReLab2').val(idRe)
      $('#acao2').val(tipo)
    })
    </script>
  </body>
</html>
