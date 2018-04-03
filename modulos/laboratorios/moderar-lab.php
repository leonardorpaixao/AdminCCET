<?php
  include '../../includes/topo.php';
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 1){
    header('Location: /inicio');
  } 
?>
<title>AdminDcomp - Moderar Reservas</title>
</head>
<?php
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $_SESSION['irPara'] = '/laboratorios/moderar';
  $db = Atalhos::getBanco();
  $link = '/laboratorios/moderar';
  if($query = $db->prepare("SELECT DISTINCT idReLab, tituloReLab, nomeUser, idLab, statusData FROM tbControleDataLab NATURAL JOIN tbReservaLab NATURAL JOIN tbUsuario WHERE statusData = 'Pendente' OR statusData = 'Aprovado'")){
    $query->execute();
    $query->bind_result($idReLab, $tituloReLab, $nomeUser, $idLab, $statusData);
  }
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Moderar Reservas
      <small>Laboratórios</small>
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
          <div class="box-body table-responsive">
            <!-- Tabela de Laboratórios -->
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th><center>ID</center></th>
                  <th><center>Título</center></th>
                  <th><center>Usuário</center></th>
                  <th><center>Status</center></th>
                  <th><center>Ações</center></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  //exibe os laboratorios selecionados
                  while ($query->fetch()) {
                    if($idLab == 0 && $statusData == 'Pendente'){
                      $acao = '<a href="laboratorios/moderar/'.$idReLab.'/"><button class="btn btn-success btn-xs">Definir laboratório(s)</button></a>';
											$status = '<span class="label label-warning">AGUARDANDO</span>';
                    }
                    else{
                      $acao = '<a href="laboratorios/controlar/'.$idReLab.'/"><button class="btn btn-primary btn-xs">Controlar datas</button></a>';
                      $status = '<span class="label label-success">APROVADO</span>';
                    }
                    echo '
                      <tr align="center">
                        <td>'.$idReLab.'</td>
                        <td>'.$tituloReLab.'</td>
                        <td>'.$nomeUser.'</td>
                        <td>'.$status.'</td>
                        <td>'.$acao.'</td>
                      </tr>
                    ';
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
        <input type="hidden" id="numPost" name="numPost" value="10"><!-- Número correspodente ao post -->
        <input type="hidden" name="idLab" id="idLab"/>
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
<?php include '../../includes/rodape.php' ?>
    </div><!-- ./wrapper -->
    <?php include '../../includes/script.php' ?>
    <script>
    //DataTable
    $(function () {
      $('#example1').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "orderFixed": [[ 4, "desc" ],[ 0, "asc" ]],
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
      var nome = button.data('solict-nome')
      var modal = $(this)
      modal.find('.modal-title').text(frase + ' - ' + nome)
      $('#idLab').val(id)
      $('#acao').val(tipo)
    })
    </script>
  </body>
</html>
