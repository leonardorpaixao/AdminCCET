<?php
  include '../../includes/topo.php';
?>
<title>AdminDcomp - Adicionar Grupo</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 0){
    header('Location: /inicio');
  }
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $_SESSION['irPara'] = '/inicio';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Adicionar Grupo
        <small>Recursos</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="nav-tabs-custom">
        <div class="box" id="forminsere">
          <div class="tab-content">
            <form action="post/" method="post" class="formulario">
              <input type="hidden" id="numPost" name="numPost" value="53"><!-- Número correspodente ao post -->
              <div class="box-body">
                <div class="form-group col-xs-7">
                  <label for="nome">Nome:</label>
                  <input type="text" class="form-control" name="nome" id="nome">
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer">
                <button id="botaoEnviar" type="submit" class="btn btn-primary">Adicionar</button>
                <a href="/recursos/contas-temporarias"><span class="btn btn-default">Cancelar</span></a>
              </div>
            </form>
          </div>
        </div><!-- /.box -->
      </div>
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
<?php include '../../includes/rodape.php' ?>
</div><!-- ./wrapper -->
<?php include '../../includes/script.php' ?>
</body>
</html>
