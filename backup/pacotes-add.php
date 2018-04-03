<?php 
  include 'topo.php';
?>
<title>AdminDcomp - Submissão de Pacotes</title>
</head>
<?php
  if(!$_SESSION['logado'] || ($_SESSION['nivel'] > 0)){
    header('Location: /inicio');
  }
  $_SESSION['irPara'] = '/inicio';
  include 'menu.php';
  include 'barra.php'; 
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Submissão de Pacotes
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
      <div class="box" id="form">
        <form action="post.php" id="formulario" method="post" enctype="multipart/form-data" autocomplete="off">
          <input type="password" style="display:none">
          <input type="hidden" id="numPost" name="numPost" value="40"><!-- Número correspodente ao post -->
          <div class="box-body">
            
            <div class="form-group col-xs-8">
              <label>Pacote:</label>
              <input type="file" name="pacote">
            </div>          

          </div><!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.form.submit();">Enviar</button>
          </div>
        </form>
      </div><!-- /.box -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <?php include 'rodape.php' ?>
</div><!-- ./wrapper -->
  <?php include 'script.php' ?>
</body>
</html>
