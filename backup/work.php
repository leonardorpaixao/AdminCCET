<?php
  include 'topo.php';
?>
<title>PRODAP - Em Manutenção</title>
</head>
<?php
  include 'barra.php';
  include 'menu.php';

?>
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
	<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
			  Erro
			</h1>
		</section>
        <!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-body">
							<div class="error-page">
								<div class="tab-content">
								<h2 class=" text-red"> Em Manutenção ...</h2>
									<h3><i class="fa  fa-code text-red"></i> Oops! Pagina passando por reparos.</h3>
									<p>
									Estamos trabalhando na correção da pagina que você estava procurando. Enquanto isso, você pode
									<a href="/inicio">retorna a pagina principal</a>.
									</p>
								</div>
							</div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->
	<?php include 'rodape.php' ?>
</div><!-- ./wrapper -->
<?php include 'script.php' ?>
</body>
</html>
