<?php
  include '../../includes/topo.php';
?>
<title>AdminDcomp - Alunos Externos</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 1){
    header('Location: /inicio');
  }
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $_SESSION['irPara'] = '/inicio';
  $db = Atalhos::getBanco();
  $link = '/recursos/alunos_externos';
  if($query = $db->prepare("SELECT a.idTemp, a.nome, a.matricula, AES_DECRYPT(a.email, ?), a.curso FROM tbTemporarios a ORDER BY a.nome")){
    $query->bind_param('s', $_SESSION['chave']);
    $query->execute();
    $query->bind_result($idUser, $nomeUser, $matricula, $email, $curso);
  }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alunos Externos
        <small>Requerimentos</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Avisos -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body table-responsive">
              <!-- Tabela de Alunos -->
              <table id="example1" class="table table-striped">
                <thead>
                  <tr>
                    <th><center>ID</center></th>
                    <th><center>Nome</center></th>
                    <th><center>Matrícula</center></th>
                    <th><center>E-mail</center></th>
                    <th><center>Curso</center></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    //exibe os alunos selecionados
                    while ($query->fetch()) {
                        echo '<tr align="center">
                              <td>'.$idUser.'</td>
                              <td>'.$nomeUser.'</td>
                              <td>'.$matricula.'</td>
                              <td>'.$email.'</td>
                              <td>'.$curso.'</td>';
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
  </script>
</body>
</html>
