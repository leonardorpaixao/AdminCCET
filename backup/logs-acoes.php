<?php
	include 'topo.php';
?>
<title>AdminDcomp - Logs de Ações</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 0){
    header('Location: /inicio');
  }
	include 'barra.php';
	include 'menu.php';
  $_SESSION['irPara'] = '/inicio';
  $db = Atalhos::getBanco();
  if($query = $db->prepare("SELECT idLogs, ip, data, b.login, idRow, nomeTabela, acao FROM tblogsacoes a NATURAL JOIN tbusuario b")){
    $query->execute();
    $query->bind_result($idLogs, $ip, $data, $idUser, $idRow, $nomeTab, $acao);
  }
?>
  <!-- Content Wrapper. Contains page0content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
		    <h1>
		      LOGs de Ações
		      <small>Controle de Acesso</small>
		    </h1>
      </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
						<div class="box-body table-responsive">
              <!-- Tabela de Logs -->
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><center>idLog</center></th>
                    <th><center>IP</center></th>
                    <th><center>Usuário</center></th>
                    <th><center>Ação</center></th>
                    <th><center>idRow</center></th>
                    <th><center>Tabela</center></th>
                    <th><center>Data</center></th>
                  </tr>
								</thead>
                <?php
                    //exibe os equipamentos selecionados
                    while ($query->fetch()) {
                          echo '<tr align="center">
                                <td>'.$idLogs.'</td>
                                <td>'.$ip.'</td>
                                <td>'.$idUser.'</td>
                                <td>'.$acao.'</td>
                                <td>'.$idRow.'</td>
                                <td>'.$nomeTab.'</td>
                                <td>'.date('d/m/y H:i:s', strtotime($data)).'</td>';
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

  <?php include 'rodape.php' ?>
 </div><!-- ./wrapper -->   
  <?php include 'script.php' ?>

	<script>
		//DataTable
		$(function () {
      $.fn.dataTable.moment('DD/MM/YY HH:mm:ss');
			$('#example1').DataTable({
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": true,
        "order": [[ 0, "desc" ]],
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
