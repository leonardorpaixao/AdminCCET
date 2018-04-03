<?php
  include '../../includes/topo.php';
  if(isset($_GET['id'])){
    $name = $_GET['id'];
  }else{
    header('Location: /inicio');
  }
?>
<title>AdminDcomp - Moderar Usuários</title>
</head>
<?php
  if(!$_SESSION['logado'] ||$_SESSION['nivel'] != 0){
    header('Location: /inicio');
  }
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $_SESSION['irPara'] = '/inicio';
  $db = Atalhos::getBanco();
  $info = Atalhos::getAdmin();

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Moderar Usuários
        <small>Grupos</small>
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
            <div class="box-body table-responsive">
              <!-- Tabela de Contas -->
              <table id="example1" class="table table-striped">
                <thead>
                  <tr>
                    <th><center>ID</center></th>
                    <th><center>Usuários</center></th>
                    <th><center>Ação</center></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if($ping = Atalhos::serviceping($_SESSION['ldaphost'])){ // is server up?
                      $ds = ldap_connect("ldaps://{$_SESSION['ldaphost']}") or die("Conexão recusada");
                      $ldaprdn  = "uid={$info[0]},ou={$info[2]},dc=computacao,dc=ufs,dc=br"; //login of CURRENT USER
                      if($ds){
                        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
                        $ldapbind = ldap_bind($ds, $ldaprdn, $info[1]);
                        if($ldapbind){
                          // Passar o nome do grupo para uma variável aqui no php
                          //Tipo $result = ldap_search($ds, 'cn={{nome}},ou=grupos,dc=computacao,dc=ufs,dc=br', "cn={{nome}}");
                          $result = ldap_search($ds, 'cn='.$name.',ou=grupos,dc=computacao,dc=ufs,dc=br', "cn=".$name."");
                          if ($result){
                            $data = ldap_get_entries($ds, $result);
                            for ($i=0; $i < $data['count']; $i++) {
                              for ($j=0; $j < $data[$i]['member']['count'];$j++) {
                                echo '<tr align="center">
                                      <td>'.$j.'</td>
                                      <td>'.$data[$i]['member'][$j].'</td>
                                      <td><button class="btn btn-block btn-warning btn-xs" data-toggle="modal" data-target="#remove" data-solict-id="'.$data[$i]['member'][$j].'">Remover</button></td>
                                      </tr>';
                              }
                            }
                          }else {
                            echo 'Error';
                          }
                        }
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div>
      </div>
    </section><!-- /.content -->
      <div class="modal fade" id="remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="exampleModalLabel"></h4>
          </div>
          <form role="form" action="post/" method="post" name="formulario1" id="formulario1">
            <div class="modal-body">
              <input type="hidden" id="numPost" name="numPost" value="55"><!-- Número correspodente ao post -->
              <input type="hidden" name="name" id="name"/>
              Confirme o UID do usuário:<br><br>
              <input type="text" name="name_check" id="name_check"/>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-success">Confirmar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->
  <?php include '../../includes/rodape.php' ?>
  <?php include '../../includes/script.php' ?>

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

    $('#remove').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var name = button.data('solict-name')
      var modal = $(this)
      modal.find('.modal-title').text("Deletar Usuário")
      $('#name').val(name);
    });

  </script>
</body>
</html>
