<?php
  include '../../includes/topo.php';
?>
<title>AdminDcomp - Adicinar Sala</title>
</head>
<?php
  if(!$_SESSION['logado'] || ($_SESSION['afiliacao'] != 5 && $_SESSION['afiliacao'] != 7)){
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
        Adicionar Sala
        <small>Recursos</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box" id="box">
        <form role="form" action="post/" method="post" name="formulario" id="formulario">
          <input type="hidden" id="numPost" name="numPost" value="34"><!-- Número correspodente ao post -->
          <div class="box-body">
            <div class="form-group col-xs-6">
              <label>Nome:</label>
              <input type="text" class="form-control" name="nome" id="nome">
            </div>
            <div class="form-group col-xs-6">
              <label for="patrimonio">Capacidade:</label>
              <input type="number" class="form-control" min="1" name="cap" id="cap">
            </div>
            <div class="form-group col-xs-6">
            <label>Escolha o status:</label>
            <select name="status" class="form-control" >
              <option value="Ativo">Ativo</option>
              <option value="Inativo">Inativo</option>
            </select>
          </div>
          <div class="box-footer col-xs-12">
            <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.form.submit();">Adicionar</button>
            <a href="/recursos/salas"<span class="btn btn-default">Cancelar</span></a>
          </div>
        </form>
      </div><!-- /.box -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <?php include '../../includes/rodape.php' ?>
</div><!-- ./wrapper -->
  <?php include '../../includes/script.php' ?>
  <script>
    $('#box').find('.formulario').submit(function() {
        var nome = $.trim($(this).find('#nome').val());
        var capacidade = $.trim($(this).find('#cap').val());
        
        
        if(!(nome.length != 0 && capacidade.length != 0)) {
            alert("Por favor, preencha todos os campos!");
            return false;
        }
    });

</script> 
</body>
</html>
