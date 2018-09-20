<?php
	include '../../includes/topo.php';
?>
<title>AdminDcomp - LOGs - Forçados</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 0){
    header('Location: /inicio');
  }
	include '../../includes/barra.php';
	include '../../includes/menu.php';
  $_SESSION['irPara'] = '/inicio';
  $db = Atalhos::getBanco();
  if($query = $db->prepare("SELECT idLogs, ip, data, login FROM tblogsforcado")){
    $query->execute();
    $query->bind_result($idLogs, $ip, $data, $login);
  }
?>
  <!-- Content Wrapper. Contains page0content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
		    <h1>
		      LOGs - Forçados
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
                    <th><center>Login</center></th>
                    <th><center>Data</center></th>
                  </tr>
								</thead>
                <?php
                    //exibe os equipamentos selecionados
                    while ($query->fetch()) {
                          echo '<tr align="center">
                                <td>'.$idLogs.'</td>
                                <td>'.$ip.'</td>
                                <td>'.$login.'</td>
                                <td>'.date('d/m/y H:i:s', $data).'</td>';
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
  <?php include '../../includes/rodape.php' ?>
</div><!-- ./wrapper -->
  <?php include '../../includes/script.php' ?>

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
