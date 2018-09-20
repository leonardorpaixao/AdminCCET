<?php
  include '../../includes/topo.php';
?>
<title>AdminDcomp - Professores</title>
</head>
<?php
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $_SESSION['irPara'] = '/recursos/professores';
  $db = Atalhos::getBanco();
  $link = '/recursos/professores';
  $query = $db->prepare("SELECT a.idUser, a.nomeUser, AES_DECRYPT(a.email, ?), a.statusUser, b.afiliacao FROM tbUsuario a
        inner join tbAfiliacao b on a.idAfiliacao = b.idAfiliacao WHERE b.nivel = 3 ORDER BY a.nomeUser ASC");
  $query->bind_param('s', $_SESSION['chave']);
  $query->execute();
  $query->bind_result($idUser, $nomeUser, $email, $statusUser, $afiliacao);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Professores
          <small>Recursos</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
              <div class="box-body table-responsive">
                <!-- Tabela de Professores -->
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th><center>Nome</center></th>
                      <th><center>Status</center></th>
                      <th><center>Afiliação</center></th>
                      <th><center>E-mail</center></th>
                    </tr>
                  </thead>
                  <?php
                    //exibe os professores selecionados
                    while ($query->fetch()){
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
                                '.wordwrap($nomeUser, 40, "</br>", false).' </a></td>
                              <td>'.$status.'</td>
                              <!--<td><button class="btn btn-primary btn-xs disabled">ACESSAR PERFIL</button></a></td>-->
                              <td>'.$afiliacao.'</td>
                              <td>'.$email.'</td>';
                              echo '</tr>';
                    }
                    $query->close();
                    $db->close();
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
        "rowReorder": {
            "selector": "td:nth-child(2)"
        },
        "responsive": true,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
        }
      });
    });
  </script>
</body>
</html>
