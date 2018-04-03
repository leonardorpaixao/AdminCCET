<?php
  include 'topo.php';
?>
<title>AdminDcomp - Contas Temporárias</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] > 1){
    header('Location: /inicio');
  }
  include 'barra.php';
  include 'menu.php';
  $_SESSION['irPara'] = '/inicio';
  $db = Atalhos::getBanco();
  $link = '/recursos/contas';
  if($query = $db->prepare("SELECT idConta, nomeConta, login, statusConta, numAcesso, dataInicio, dataFim FROM tbContaTemp ORDER BY nomeConta")){
    $query->execute();
    $query->bind_result($idConta, $nomeConta, $login, $statusConta, $numAcesso, $dataInicio, $dataFim);
  }
  $sudo = false;
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Contas Temporárias
        <small>Recursos</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['avisoConta'])):
      ?>
          <div class="callout callout-warnning">
            <h4>Valor incorreto!</h4>
            <p>Data de fim não pode ser anterior ao dia de hoje</p>
          </div>
      <?php
        unset($_SESSION['avisoConta']);
        endif;
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box" id="box">
            <div class="box-header">
              <?php
                if($_SESSION['logado'] && $_SESSION['nivel'] == 0)
                  echo '<a href="/recursos/contas-temporarias/adicionar"><button class="btn btn-success">Adicionar</button></a>';
              ?>
            </div>
            <div class="box-body table-responsive">
              <!-- Tabela de Contas -->
              <table id="example1" class="table table-striped">
                <thead>
                  <tr>
                    <th><center>Nome</center></th>
                    <th><center>Login</center></th>
                    <th><center>Status</center></th>
                    <th><center>Número de Acesso</center></th>
                    <th><center>Sudo</center></th>
                    <th><center>Data de Inicio</center></th>
                    <th><center>Data de Fim</center></th>
                    <th><center>Ações</center></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    //exibe os contas selecionados
                    while ($query->fetch()) {
                        switch($statusConta){
                          case 'Inativo':
                            $status = '<span class="label label-warning">INATIVO</span>';
                            break;
                          case 'Ativo':
                            $status = '<span class="label label-success">ATIVO</span>';
                            break;
                        }
                        if($sudo){
                          $sudo2 = '<span class="label label-success">ATIVO</span>';
                        }else{
                          $sudo2 = '<span class="label label-warning">INATIVO</span>';
                        }
                        echo '<tr align="center">
                              <td>'.wordwrap($nomeConta, 40, "</br>", false).'</td>
                              <td>'.$login.'</td>
                              <td>'.$status.'</td>
                              <td>'.$numAcesso.'</td>
                              <td>'.$sudo2.'</td>
                              <td>'.date("d/m/Y", strtotime($dataInicio)).'</td>
                              <td>'.date("d/m/Y", strtotime($dataFim)).'</td><td>';
                        if($statusConta == 'Ativo'){
                          echo '<button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#simples" data-solict-id="'.$idConta.'" data-solict-tipo="1" data-solict-frase="Desativar Conta '.$login.'">Desativar</button>';
                        }else{
                          echo '<button class="btn btn-block btn-success btn-xs" data-toggle="modal" data-target="#data" data-solict-id="'.$idConta.'" data-solict-frase="Ativar Conta '.$login.'">Ativar</button>';
                        }
                        echo '<button class="btn btn-block btn-primary btn-xs" onclick="location.href=\'/recursos/contas-temporarias/editar/'.$idConta.'/\'">Editar</button></td>
                          <td><button class="close" data-target="#simples" data-solict-id="'.$idConta.'"
                            data-solict-tipo="0" data-toggle="modal" data-solict-frase="Excluir '.$nomeConta.'">
                            <span aria-hidden="true">&times;</span></button></td>';
                        echo '</tr>';
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
    <div class="modal fade" id="simples" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="exampleModalLabel"></h4>
          </div>
          <form role="form" action="post.php" method="post" name="formulario1" id="formulario1">
            <div class="modal-body">
              <input type="hidden" id="numPost" name="numPost" value="14"><!-- Número correspodente ao post -->
              <input type="hidden" name="idconta" id="idconta"/>
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
    <div class="modal fade" id="data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel"></h4>
        </div>
        <form role="form" action="post.php" method="post" name="formulario1" id="formulario1">
          <div class="modal-body">
            <input type="hidden" id="numPost" name="numPost" value="14"><!-- Número correspodente ao post -->
            <input type="hidden" name="idconta3" id="idconta3"/>
            <div class="form-group">
              <label>Insira novo fim:</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control" name="data" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
              </div><!-- /.input group -->
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
  </div><!-- /.content-wrapper -->
  <?php include 'rodape.php' ?>
  <?php include 'script.php' ?>

  <script>

    //DataTable
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

    $('#simples').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var tipo = button.data('solict-tipo')
      var frase = button.data('solict-frase')
      var id = button.data('solict-id')
      var modal = $(this)
      modal.find('.modal-title').text(frase)
      $('#idconta').val(id)
      $('#acao').val(tipo)
    });

    $('#data').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var frase = button.data('solict-frase')
      var id = button.data('solict-id')
      var modal = $(this)
      modal.find('.modal-title').text(frase)
      $('#idconta3').val(id)
    });
  </script>
</body>
</html>