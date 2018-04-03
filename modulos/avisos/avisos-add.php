<?php include '../../includes/topo.php'; ?>
<title>AdminDcomp - Adicionar Aviso</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 1){
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
            Adicionar Aviso
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
        <?php
          if(isset($_SESSION['avisoPainel'])):
        ?>
            <div class="callout callout-success">
              <h4>Aviso adicionado com sucesso!</h4>
              <p>Acesse a <a href="/avisos">página moderar avisos</a> para editar ou controlar seu aviso.</p>
            </div>
        <?php
          unset($_SESSION['avisoPainel']);
          endif;
        ?>
          <!-- Default box -->
          <div class="box" id="forminsere">
                <form role="form" action="post/" method="post" class="formulario">
                  <input type="hidden" id="numPost" name="numPost" value="32"><!-- Número correspodente ao post -->
              <div class="box-body">
                  <div class="form-group">
                      <label>Título:</label>
                      <input type="text" class="form-control" name="titulo" id="titulo">
                  </div>
                  <div class="form-group">
                    <label>Conteúdo:</label>
                    <textarea class=" textarea" name="texto" id="texto" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>     
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.form.submit();">Adicionar</button>
                    <a href="/avisos"<span class="btn btn-default">Cancelar</span></a>
                  </div>
                  </form>
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include '../../includes/rodape.php' ?> 
    </div><!-- ./wrapper -->
    <?php include '../../includes/script.php' ?>
    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <script>

    $('#forminsere').find('.formulario').submit(function() {
        var titulo = $.trim($(this).find('#titulo').val());
        var texto = $.trim($(this).find('#texto').val());

        if(!(titulo.length != 0 && texto.length != 0)) {
            alert("Por favor, preencha todos os campos!");
            return false;
        }
    });
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });
  </script>
</body>
</html>
