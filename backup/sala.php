<?php
	include 'topo.php';
?>
<title>AdminDcomp - Salas</title>
</head>
<?php
	include 'barra.php';
	include 'menu.php';
  $_SESSION['irPara'] = '/inicio';
  $db = Atalhos::getBanco();
  $link = '/recursos/salas';
	if($query = $db->prepare("SELECT idSala, nomeSala, statusSala, numPessoa FROM tbSala")){
    $query->execute();
    $query->bind_result($idSala, $nomeSala, $statusSala, $numPessoa);
  }
?>
  <!-- Content Wrapper. Contains page0content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
		    <h1>
		      Salas
		      <small>Recursos</small>
		    </h1>
      </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['avisoSala'])):
      ?>
          <div class="callout callout-success">
            <h4><?php echo $_SESSION['avisoSala'] ?></h4>
          </div>
      <?php
          unset($_SESSION['avisoSala']);
        endif;
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <?php
                if($_SESSION['logado'] && $_SESSION['nivel'] <= 1)
                  echo '<a href="/recursos/salas/adicionar"><button class="btn btn-success">Adicionar</button></a>';
              ?>
              </div><!-- /.box-header -->
				<div class="box-body table-responsive">
	              <!-- Tabela de Salas -->
	              <table id="example1" class="table table-bordered table-striped">
	                <thead>
                    <tr>
                      <th><center>Nome</center></th>
                      <th><center>Capacidade</center></th>
                      <th><center>Status</center></th>
                      <?php
                        if($_SESSION['logado'] && $_SESSION['nivel'] <= 1)
                          echo '<th><center>Ação</th>
                            <th></th>';
                      ?>
                    </tr>
									</thead>
                  <?php
                      //exibe os equipamentos selecionados
                      while ($query->fetch()) {
                          switch($statusSala){
                            case 'Ativo':
                              $status = '<span class="label label-success">ATIVO</span>';
                              $acao = '<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#simples"
                              data-solict-id="'.$idSala.'" data-solict-tipo="1" data-solict-nome="'.$nomeSala.'"
                              data-solict-frase="Inativar">Inativar</button>';
                              break;
                            case 'Inativo':
                              $status = '<span class="label label-warning">INATIVO</span>';
                              $acao = '<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#simples"
                              data-solict-id="'.$idSala.'"data-solict-tipo="2" data-solict-nome="'.$nomeSala.'"
                              data-solict-frase="Ativar">Ativar</button>';
                              break;
                          }
                          echo '<tr align="center">
                                  <td>'.$nomeSala.'</td>
                                  <td>'.$numPessoa.'</td>
                                  <td>'.$status.'</td>';
                            if($_SESSION['logado'] && $_SESSION['nivel'] <= 1){
                              echo '<td><a href="/recursos/salas/editar/'.$idSala.'/">
      				                  <button class="btn btn-default btn-xs">Editar</button></a> '.$acao.'</td>';
                              echo '<td><button class="close" data-target="#simples" data-solict-id="'.$idSala.'"
                                data-solict-tipo="3" data-solict-nome="'.$nomeSala.'" data-toggle="modal"
                                data-solict-frase="Excluir"> <span aria-hidden="true">&times;</span></button></td>';
                            }
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
          <input type="hidden" id="numPost" name="numPost" value="36"><!-- Número corrsalasodente ao post -->
          <input type="hidden" name="idSala" id="idSala"/>
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

  <?php include 'rodape.php' ?>
</div><!-- ./wrapper -->
  <?php include 'script.php' ?>
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
    var nome = button.data('solict-nome')
    var id = button.data('solict-id')
    var modal = $(this)
    modal.find('.modal-title').text(frase + ' - Sala: ' + nome)
    $('#idSala').val(id)
    $('#acao').val(tipo)
  })
</script>
</body>
</html>
