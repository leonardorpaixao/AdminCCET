<?php
	include '../../includes/topo.php';
?>
<title>AdminDcomp - Disciplinas</title>
</head>
<?php
	include '../../includes/barra.php';
	include '../../includes/menu.php';
  $_SESSION['irPara'] = '/recursos/disciplinas';
  $db = atalhos::getBanco();
  $link = '/recursos/disciplinas';
	if($query = $db->prepare("SELECT idDisc, codigo, nome, carga, status FROM tbdisciplinas")){
    $query->execute();
    $query->bind_result($idDisc, $codigo, $nome, $carga, $statusDisc);
  }
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
		    <h1>
		      Disciplinas
		      <small>Recursos</small>
		    </h1>
      </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['avisoDsc'])):
      ?>
          <div class="callout callout-success">
            <h4><?php echo $_SESSION['avisoDsc'] ?></h4>
          </div>
      <?php
          unset($_SESSION['avisoDsc']);
        elseif(isset($_SESSION['disciplinasAtt'])):
          if($_SESSION['disciplinasAtt'] == 1):
      ?>
            <div class="callout callout-success">
              <h4>Disciplinas atualizadas!</h4>
            </div>
      <?php
          endif;
          unset($_SESSION['disciplinasAtt']);
        endif;
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <?php
                if($_SESSION['logado'] && ($_SESSION['nivel'] <= 1))
                  echo  '<form role="form" action="post/" method="post" name="formulario1" id="formulario1">
									          <input type="hidden" id="numPost" name="numPost" value="51"><!-- Número correspodente ao post -->
									          <button type="submit" class="btn btn-success">Atualizar Disciplinas</button>
									        </form>'
		              ?>
            </div><!-- /.box-header -->
			<div class="box-body table-responsive">
              <!-- Tabela de Disciplinas -->
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><center>Código</center></th>
                    <th><center>Nome</center></th>
                    <th><center>Carga</center></th>
                    <th><center>Status</center></th>
                    <?php
                      if($_SESSION['logado'] && $_SESSION['nivel'] <= 1)
                        echo '<th><center>Ação</th>';
                    ?>
                  </tr>
								</thead>
                <?php
                  //exibe as disciplinas selecionados
                  while ($query->fetch()) {
                      switch($statusDisc){
                        case 'Ativo':
                          $status = '<span class="label label-success">ATIVO</span>';
                          $acao = '<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#simples"
                          data-solict-id="'.$idDisc.'" data-solict-tipo="1"
                          data-solict-frase="Inativar" data-solict-codigo="'.$codigo.'">Inativar</button>';
                          break;
                        case 'Inativo':
                          $status = '<span class="label label-warning">INATIVO</span>';
                          $acao = '<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#simples"
                          data-solict-id="'.$idDisc.'"data-solict-tipo="2"
                          data-solict-frase="Ativar" data-solict-codigo="'.$codigo.'">Ativar</button>';
                          break;
                      }
                      echo '<tr align="center">
                              <td>'.$codigo.'</td>
                              <td>'.$nome.'</td>
                              <td>'.$carga.'</td>
                              <td>'.$status.'</td>';
                              if($_SESSION['logado'] && $_SESSION['nivel'] <= 1)
                                echo '<td>'.$acao.'</td>';
                      echo '</tr>';
                  }
                  $query->close();
                  $db->close();
                ?>

              </table>
            </div><!-- /.box-body -->
          </div>
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
          <input type="hidden" id="numPost" name="numPost" value="50"><!-- Número correspodente ao post -->
          <input type="hidden" name="idDisc" id="idDisc"/>
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
    var codigo = button.data('solict-codigo')
    var id = button.data('solict-id')
    var modal = $(this)
    modal.find('.modal-title').text(frase + ' - Disciplina código' + codigo)
    $('#idDisc').val(id)
    $('#acao').val(tipo)
  })
</script>
</body>
</html>
