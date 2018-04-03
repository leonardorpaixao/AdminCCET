<?php 
  include '../../includes/topo.php';
?>
<title>AdminDcomp - Moderar Avisos</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 1){
    header('Location: /inicio');
  }
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $_SESSION['irPara'] = '/inicio';
  
  $db = atalhos::getBanco();
  if($query = $db->prepare("SELECT idAviso, tituloAviso, dataAviso, statusAviso FROM tbAvisos ORDER BY statusAviso ASC")){
    $query->execute();
    $query->store_result();
    $total = $query->num_rows;
    $query->close();
  }

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Moderar Avisos
      </h1>
  </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a href="/avisos/adicinar"><button class="btn btn-success">Adicionar novo aviso</button></a>
              <h3 class="box-title"></h3>
            </div><!-- /.box-header -->

            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped display nowrap" cellspacing="0" >
                  <thead>
                    <tr>
                      <th><center>ID</center></th>
                      <th><center>Título</center></th>
                      <th><center>Data de criação</center></th>
                      <th><center>Status</center></th>
                      <th><center>Ação</center></th>
                    </tr>
                  </thead>
                  <?php
                    if($query = $db->prepare("SELECT idAviso, tituloAviso, dataAviso, statusAviso FROM tbAvisos ORDER BY statusAviso ASC")){
                      $query->execute();
                      $query->bind_result($idAviso, $tituloAviso, $dataAviso, $statusAviso);
                    while ($query->fetch()) {
                        switch($statusAviso){
                          case 'Inativo':
                            $status = '<span class="label label-warning">INATIVO</span>';
                            $acao = '<a href="/avisos/editar/'.$idAviso.'/">
                            <button class="btn btn-default btn-xs">Editar</button></a>
                            <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#simples" 
                            data-solict-id="'.$idAviso.'"
                            data-solict-tipo="2" data-solict-frase="Ativar">Ativar</button>
                            <button class="btn btn-danger btn-xs" data-target="#simples" data-solict-id="'.$idAviso.'"
                                  data-solict-tipo="3" data-toggle="modal" data-solict-frase="Excluir"> Excluir</button>';
                            break;
                          case 'Ativo':
                            $status = '<span class="label label-success">ATIVO</span>';
                            $acao = '<a href="/avisos/editar/'.$idAviso.'/">
                            <button class="btn btn-default btn-xs">Editar</button></a>
                            <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#simples" 
                            data-solict-id="'.$idAviso.'"
                            data-solict-tipo="1" data-solict-frase="Inativar">Inativar</button>
                            <button class="btn btn-danger btn-xs" data-target="#simples" data-solict-id="'.$idAviso.'"
                                  data-solict-tipo="3" data-toggle="modal" data-solict-frase="Excluir"> Excluir</button>';
                            break;
                        }
                        echo '<tr align="center">
                              <td>'.$idAviso.'</td>
                              <td>'.$tituloAviso.'</td>
                              <td>'.date("d/m/Y", strtotime($dataAviso)).'</td>
                              <td>'.$status.'</td>';
                              if ($idAviso == 1){
                                echo '<td><a href="/avisos/editar/'.$idAviso.'/">
                                      <button class="btn btn-default btn-xs">Editar</button></a>
                                      </td></tr>';
                              }
                              else{
                                echo '<td>'.$acao.'</td>
                              </tr>';
                            }
                        }
                      $query->close();
                    }       
                    $db->close();              
                  ?>           
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
            <input type="hidden" id="numPost" name="numPost" value="31"><!-- Número correspodente ao post -->
          <input type="hidden" name="idAviso" id="idAviso"/>
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
<?php include '../../includes/rodape.php' ?>
    </div><!-- ./wrapper -->
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

    $('#simples').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var tipo = button.data('solict-tipo')
      var frase = button.data('solict-frase')
      var id = button.data('solict-id')
      var modal = $(this)
      modal.find('.modal-title').text(frase + ' - Aviso ' + id)
      $('#idAviso').val(id)
      $('#acao').val(tipo)
    })
  </script>
</body>
</html>
