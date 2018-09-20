<?php
  include '../../includes/topo.php';
?>
<title>AdminDcomp - Processo Eletrônico [Atividades Complementares]</title>
</head>
<?php
  if(!$_SESSION['logado']){
    header('Location: /inicio');
  }
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $_SESSION['irPara'] = '/inicio';
  $db = Atalhos::getBanco();
  $link = '/atividadescomplementares';
  if ($_SESSION['nivel'] == 4){
    if($query = $db->prepare("SELECT a.id, a.idUser, a.status, a.dateStart, b.nomeUser FROM tbAtividadesComp a INNER JOIN tbUsuario b on a.idUser = b.idUser WHERE b.idUser = ? ORDER BY a.id ")){
      $query->bind_param('i', $_SESSION['id']);
      $query->execute();
      $query->bind_result($id, $idUser, $status, $dateStart, $nomeUser); 
    }
  }elseif ($_SESSION['nivel'] == 1){
    if($query = $db->prepare("SELECT a.id, a.idUser, a.status, a.dateStart, b.nomeUser FROM tbAtividadesComp a INNER JOIN tbUsuario b on a.idUser = b.idUser ORDER BY a.id")){
      $query->execute();
      $query->bind_result($id, $idUser, $status, $dateStart, $nomeUser);
    }
  }else{
    if($query = $db->prepare("SELECT a.id, a.idUser, a.status, a.dateStart, b.nomeUser FROM tbAtividadesComp a INNER JOIN tbUsuario b on a.idUser = b.idUser INNER JOIN tbetapaatividadecomp c on a.id = c.idAtividade WHERE c.status = 'Pendente' AND c.idUser = ? ORDER BY a.id")){
      $query->bind_param('i', $_SESSION['id']);      
      $query->execute();
      $query->bind_result($id, $idUser, $status, $dateStart, $nomeUser);
    }
  }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Atividades Complementares
        <small>Processo Eletrônico</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
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
                    <th><center>Data</center></th>
                    <th><center>Status</center></th>
                    <th><center>Ações</center></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    //exibe os alunos selecionados
                    while ($query->fetch()) {
                        switch($status){
                          case 'Pendente':
                            $status = '<span class="label label-warning">Pendente</span>';
                            break;
                          case 'Aprovado':
                            $status = '<span class="label label-success">Aprovado</span>';
                            break;
                          case 'Negado':
                            $status = '<span class="label label-danger">Neegado</span>';
                            break;
                        }
                        echo '<tr align="center">
                              <td>'.$id.'</a></td>
                              <td>'.$nomeUser.'</td>
                              <td>'.date("d/m/Y H:m", strtotime($dateStart)).'</td>
                              <td>'.$status.'</td>                              
                              <td><a href="/atividadescomplementares/acompanhar/'.$id.'/"><button class="btn btn-primary btn-xs">Vizualizar Processo</button></a></td>';
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
