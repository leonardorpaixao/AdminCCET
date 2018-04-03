<?php
  include '../../includes/topo.php';
?>
<title>AdminDcomp - Alunos Externos</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] > 2){
    header('Location: /inicio');
  }
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $_SESSION['irPara'] = '/inicio';
  $db = Atalhos::getBanco();
  $link = '/recursos/alunos';
  if($query = $db->prepare("SELECT idExterno, nome, login, AES_DECRYPT(email, ?), status, curso FROM tbUsuariosExternos ORDER BY nome")){
    $query->bind_param('s', $_SESSION['chave']);
    $query->execute();
    $query->bind_result($idUser, $nomeUser, $login, $email, $statusUser, $afiliacao);
  }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alunos Externos
        <small>Recursos</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Avisos -->
      <?php
        if(isset($_SESSION['errorAluno'])):
          if($_SESSION['errorAluno'] == 1):
      ?>
            <div class="callout callout-danger">
              <h4>Matricula já cadastrada!</h4>
            </div>
      <?php
          elseif($_SESSION['errorAluno'] == 2):
      ?>
            <div class="callout callout-danger">
              <h4>CPF invalido!</h4>
            </div>
      <?php
          else:
      ?>
            <div class="callout callout-danger">
              <h4>Não foi colocado:</h4>
              <p><?php echo $_SESSION['errorAluno'] ?></p>
            </div>
      <?php
          endif;
          unset($_SESSION['errorAluno']);
        elseif(isset($_SESSION['avisoAluno'])):
      ?>
          <div class="callout callout-success">
            <h4>Aluno criado com sucesso!</h4>
          </div>
      <?php
          unset($_SESSION['avisoAluno']);
        endif;
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body table-responsive">
              <!-- Tabela de Alunos -->
              <table id="example1" class="table table-striped">
                <thead>
                  <tr>
                    <th><center>Nome</center></th>
                    <th><center>Login</center></th>
                    <th><center>Afiliação</center></th>
                    <th><center>Status</center></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    //exibe os alunos selecionados
                    while ($query->fetch()) {
                        switch($statusUser){
                          case 'Inativo':
                            $status = '<span class="label label-warning">INATIVO</span>';
                            break;
                          case 'Ativo':
                            $status = '<span class="label label-success">ATIVO</span>';
                            break;
                        }
                        echo '<tr align="center">
                              <td>'.wordwrap($nomeUser, 40, "</br>", false).'</td>
                              <td>'.$login.'</td>
                              <td>'.$afiliacao.'</td>
                              <td>'.$status.'</td>';
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
  </div><!-- /.content-wrapper -->
  <?php include '../../includes/rodape.php' ?>
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
      var modal = $(this)
      var nome = button.data('solict-nome')
      modal.find('.modal-title').text(frase + ' - Aluno: ' + nome)
      $('#idUser').val(id)
      $('#acao').val(tipo)
    })
  </script>
</body>
</html>
