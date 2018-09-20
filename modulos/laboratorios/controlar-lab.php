<?php
  include '../../includes/topo.php';
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 1){
    header('Location: /inicio');
  }
?>
<title>AdminDcomp - Controlar Reservas</title>
</head>
<?php
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $_SESSION['irPara'] = '/laboratorios/controlar';
  $db = Atalhos::getBanco();
  $link = '/laboratorios/controlar';
  if($query = $db->prepare("SELECT idReLab, tituloReLab, nomeUser, idLab, inicio, fim, statusData, idData, idUser, justificativa FROM tbcontroledatalab NATURAL JOIN tbreservalab NATURAL JOIN tbusuario JOIN tbdata USING(idData) WHERE statusData != 'Pendente' ORDER BY statusData ASC, inicio ASC")){
    $query->execute();
    $query->bind_result($idReLab, $tituloReLab, $nomeUser, $idLab, $inicio, $fim, $statusData, $idData, $idUser, $justificativa);
  }
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Controlar Reservas
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
                  <th><center>Título</center></th>
                  <th><center>Usuário</center></th>
                  <th><center>Horário</center></th>
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
                        <!--<a class="btn btn-block btn-default btn-xs">Alterar laboratório</a>-->
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
                         ata-solict-titulo="'.$tituloReLab.'">Receber chave</button>';
                        break;
                      case 'Recebido':
                        $status = '<span class="label label-primary">RECEBIDO</span>';
                        $acao = '';
                        break;
                      case 'Negado':
                        $status = '<span class="label label-danger"data-toggle="tooltip"
                        title="'.$justificativa.'">NEGADO</span>';
                        $acao = '';
                        break;
                      case 'Cancelado':
                        $status = '<span class="label label-danger" data-toggle="tooltip"
                        title="'.$justificativa.'">CANCELADO</span>';
                        $acao = '';
                        break;
                      case 'Expirado':
                        $status = '<span class="label label-danger">EXPIRADO</span>';
                        $acao = '';
                        break;
                    }
                    $nomeLab = Atalhos::nomeLab($idLab);
                    echo '
                      <tr align="center">
                        <td>'.$tituloReLab.'</td>
                        <td>'.$nomeUser.'</td>
                        <td><b>Início:</b> '.date("d/m/Y (l) - H:i",strtotime($inicio)).'<br><b>Término:</b> '.date("d/m/Y (l) - H:i",strtotime($fim)).'</td>
                        <td>'.$nomeLab.'</td>
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
