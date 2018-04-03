<?php
  include '../../includes/topo.php';
  ?>
<title>AdminDcomp - Funcinários</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] > 1){
    header('Location: /inicio');
  }
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $_SESSION['irPara'] = '/inicio';
  $db = Atalhos::getBanco();
  $link = '/recursos/funcionarios';
  if($query = $db->prepare("SELECT a.idUser, a.nomeUser, AES_DECRYPT(a.email, ?), a.statusUser, b.afiliacao FROM tbUsuario a inner join tbAfiliacao b on a.idAfiliacao = b.idAfiliacao WHERE b.nivel < 3 ORDER BY a.nomeUser ASC")){
    $query->bind_param('s', $_SESSION['chave']);
    $query->execute();
    $query->bind_result($idUser, $nomeUser, $email, $statusUser, $afiliacao);
  }
 ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Funcionários
      <small>Recursos</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Avisos -->
    <?php
      if(isset($_SESSION['errorAddUser'])):
        if($_SESSION['errorAddUser'] == 1):
    ?>
          <div class="callout callout-danger">
            <h4>Senhas não conhecidem!</h4>
          </div>
    <?php
        elseif($_SESSION['errorAddUser'] == 2):
    ?>
          <div class="callout callout-danger">
            <h4>CPF já cadastrado!</h4>
          </div>
    <?php
        else:
    ?>
          <div class="callout callout-danger">
            <h4>Não foi colocado:</h4>
            <p><?php echo $_SESSION['errorAddUser'] ?></p>
          </div>
    <?php
        endif;
        unset($_SESSION['errorAddUser']);
      elseif(isset($_SESSION['avisoAddUser'])):
    ?>
        <div class="callout callout-success">
          <h4>Funcionário criado com sucesso!</h4>
        </div>
    <?php
        unset($_SESSION['avisoAddUser']);
      endif;
    ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body table-responsive">
            <!-- Tabela de Funcionários -->
            <table id="example1" class="table table-striped">
              <thead>
                <tr>
                  <th><center>Nome</center></th>
                  <th><center>Status</center></th>
                  <th><center>Afiliação</center></th>
                  <th><center>E-mail</center></th>
                </tr>
              </thead>
              <?php
                //exibe os funcionarios selecionados
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
                        <td><a href="/perfil/'.$idUser.'/"  data-toggle="tooltip" title="abrir perfil">
                        '.wordwrap($nomeUser, 40, "</br>", false).'</a></td>
                        <td>'.$status.'</td>
                        <td>'.$afiliacao.'</td>
                        <td>'.$email.'</td>';
                  echo '</tr>';
                }
                $query->close();
              ?>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
    </div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
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
      var nome = button.data('solict-nome')
      var modal = $(this)
      modal.find('.modal-title').text(frase + ' - Funcionáiro: ' + nome)
      $('#idUser').val(id)
      $('#acao').val(tipo)
    })
    </script>


  </body>
</html>
