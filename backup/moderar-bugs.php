  <?php
    include 'topo.php';
  ?>
  <title>AdminDcomp - Moderar Bugs</title> 
    </head>    
  <?php
    if(!$_SESSION['logado'] || $_SESSION['nivel'] != 0){
      header('Location: /inicio');
    }
    include 'barra.php';
    include 'menu.php';
    $_SESSION['irPara'] = '/bugs/moderar';
    $db = Atalhos::getBanco();
    if($query = $db->prepare("SELECT idBug, nome, pagina, bug, data, status, AES_DECRYPT(email, ?) FROM tbbugs ORDER BY idBug ASC")){
      $query->bind_param('s', $_SESSION['chave']);
      $query->execute();
      $query->bind_result($idBug, $nome, $pagina, $bug, $data, $status, $email);
    }
      
    ?>
       
    <style type="text/css">
      /* FROM HTTP://WWW.GETBOOTSTRAP.COM
        * Glyphicons
        *
        * Special styles for displaying the icons and their classes in the docs.
        */

      .bs-glyphicons {
        padding-left: 0;
        padding-bottom: 1px;
        margin-bottom: 20px;
        list-style: none;
        overflow: hidden;
      }
      .bs-glyphicons li {
        float: left;
        width: 25%;
        height: 115px;
        padding: 10px;
        margin: 0 -1px -1px 0;
        font-size: 12px;
        line-height: 1.4;
        text-align: center;
        border: 1px solid #ddd;
      }
      .bs-glyphicons .glyphicon {
        margin-top: 5px;
        margin-bottom: 10px;
        font-size: 24px;
      }
      .bs-glyphicons .glyphicon-class {
        display: block;
        text-align: center;
        word-wrap: break-word; /* Help out IE10+ with class names */
      }
      .bs-glyphicons li:hover {
        background-color: rgba(86,61,124,.1);
      }

      @media (min-width: 768px) {
        .bs-glyphicons li {
          width: 12.5%;
        }
      }
    </style>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Moderar
            <small>Bugs</small>
          </h1>
        </section>
       
        <section class="content">
      <div class="box-body">

        <!-- Main content -->
          <!-- Default box -->
          <div class="box">
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped display nowrap" cellspacing="0" >
                  <thead>
                    <tr>
                      <th><center>ID</center></th>
                      <th><center>Nome</center></th>
                      <th><center>Email</center></th>
                      <th><center>Descrição</center></th>
                      <th><center>Data</center></th>
                      <th><center>Status</center></th>
                      <th><center>Ação</center></th>
                    </tr>
                  </thead>
                    <?php
                      while($query->fetch()){
                        switch($status){
                            case 'Resolvido':
                              $status = '<span class="label label-success" data-toggle="tooltip" title="Esse bug já foi resolvido pela equipe de desenvolvimento do PRODAP.">RESOLVIDO</span>';
                              $acao = '';
                              break;
                            case 'Em análise':
                              $status = '<span class="label label-warning" data-toggle="tooltip" title="Esse bug 
                                está sob análise.">EM ANÁLISE</span>';
                              $acao = '<button class="btn btn-block btn-success btn-xs" data-toggle="modal" 
                                data-target="#simples" data-solict-id="'.$idBug.'" data-solict-tipo="1" 
                                data-solict-frase="Resolver">RESOLVER</button><button class="btn btn-block btn-danger btn-xs" 
                                data-toggle="modal" data-target="#simples" data-solict-id="'.$idBug.'" data-solict-tipo="2" 
                                data-solict-frase="Descartar">DESCARTAR</button>';                    
                              break;
                            case 'Descartado':
                              $status = '<span class="label label-danger" data-toggle="tooltip" title="Bug descartado!">DESCARTADO</span>';
                              $acao = '';
                              break;
                          }
                             echo '<tr align="center">
                                <td>'.$idBug.'</td>
                                <td>'.$nome.'</td>
                                <td>'.$email.'</td>
                                <td><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#negativo" data-solict-pagina="'.$pagina.'" data-solict-bug="'.$bug.'"data-solict-frase="Resolver">Detalhes</button>                             
                                <td>'.date('d/m/Y', strtotime($data)).'</td>
                                <td>'.$status.'</td>
                                <td>'.$acao.'</td>
                              </tr>';
                      }
                    ?>
              </table>
            </div>
          </div><!-- /.box -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
        <?php include 'rodape.php' ?>
     </div><!-- ./wrapper -->

    <!-- NEGAR -->
    <div class="modal fade" id="negativo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="exampleModalLabel"></h4>
              </div>

                <div class="modal-body">
                  <b>Página: </b>
                  <div class="pagina"></div>
                  <b>Descrição</b>
                  <div class="bug"></div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM NEGAR -->
    <!-- APROVAR -->
    <div class="modal fade" id="simples" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="exampleModalLabel"></h4>
              </div>

              <form role="form" action="post.php" method="post" name="formulario1" id="formulario1">
                <input type="hidden" id="numPost" name="numPost" value="52"><!-- Número correspodente ao post -->
                <div class="modal-body">
                    <input type="hidden" name="id" id="id"/>
                    <input type="hidden" name="acao" id="acao" />
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
                  <button type="submit" class="btn btn-success">Confirmar</button>
                </div>
              </form>
            </div>
        </div>
     </div>
    <!-- FIM APROVAR -->    
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
        "order": [ [5, "asc"],[0,"desc"]],
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
    modal.find('.modal-title').text(frase + ' - Bug ' + id)
        $('#id').val(id)
        $('#acao').val(tipo)
    })

    $('#negativo').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var bug = button.data('solict-bug')
    var pagina = button.data('solict-pagina') // Extract info from data-* attributes
    var modal = $(this)
    modal.find('.modal-title').text('Descrição do Bug ')
    modal.find('.pagina').text(pagina)
    modal.find('.bug').text(bug)

    })
    </script>
  </body>
</html>
