<?php
  include '../../includes/topo.php';
?>
<title>AdminDcomp - Moderar Grupos</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 0){
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
        Moderar Grupos
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
				      <a href="/recursos/grupos/add"><button class="btn btn-success">Adicionar</button></a>
            </div>
            <div class="box-body table-responsive">
              <!-- Tabela de Contas -->
              <table id="example1" class="table table-striped">
                <thead>
                  <tr>
                    <th><center>ID</center></th>
                    <th><center>Grupo</center></th>
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
                          $result = ldap_search($ds, 'ou=grupos,dc=computacao,dc=ufs,dc=br', "cn=*");
                          if ($result){
                            $data = ldap_get_entries($ds, $result);
                            for ($i=0; $i < $data['count']; $i++) {
                              echo '<tr align="center">
                                    <td>'.$i.'</td>
                                    <td>'.$data[$i]['cn'][0].'</td>
                                    <td><button class="btn btn-block btn-success btn-xs" data-toggle="modal" data-target="#add" data-solict-name="'.$data[$i]['cn'][0].'">Adicionar Usuário</button>
                                        <a href="/recursos/grupos/usuarios/'.$data[$i]['cn'][0].'/"><button class="btn btn-block btn-warning btn-xs">Detalhes</button></a></td>
                                    </tr>';
                            }
                          } else {
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

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="exampleModalLabel"></h4>
          </div>
          <form role="form" action="post/" method="post" name="formulario1" id="formulario1">
            <div class="modal-body">
              <input type="hidden" id="numPost" name="numPost" value="54"><!-- Número correspodente ao post -->
              <input type="hidden" name="name" id="name"/>
              <label> Nome do usuário: </label>
              <input type="text" name="usuario" id="usuario"/>
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

    $('#add').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var name = button.data('solict-name')
      var modal = $(this)
      modal.find('.modal-title').text("Adicionar Usuário")
      $('#name').val(name);
    });

  </script>
</body>
</html>
