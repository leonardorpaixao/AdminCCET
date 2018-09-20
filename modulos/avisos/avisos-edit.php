<?php include '../../includes/topo.php'; ?>
<title>AdminDcomp - Editar Aviso</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 1){
    header('Location: /inicio');
  }
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $_SESSION['irPara'] = '/inicio';   
  $id = (isset($_GET['id']))? $_GET['id'] : NULL;
  $db = Atalhos::getBanco();
  if ($query = $db->prepare("SELECT idAviso, tituloAviso, textoAviso FROM tbAvisos WHERE idAviso = ?")){
    $query->bind_param('i', $id);    
    $query->execute();
    $query->bind_result($id1, $tituloAviso, $textoAviso);    
    $query->fetch();
  }
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Editar Aviso 
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
        <?php
          if(isset($_SESSION['avisoPainel'])):
        ?>
            <div class="callout callout-success">
              <h4>Aviso editado com sucesso!</h4>
              <p>Acesse a <a href="/avisos">página moderar avisos</a> para visualizar e editar todos os avisos.</p>
            </div>
        <?php
          unset($_SESSION['avisoPainel']);
          endif;
        ?>
          <!-- Default box -->
          <div class="box" id="formedita">
                <form role="form" action="post/" method="post" class="formulario">
                  <input type="hidden" id="idReq" name="idAviso" value="<?php echo $id1; ?>"><!-- Número correspodente ao ID-->
                  <input type="hidden" id="numPost" name="numPost" value="33"><!-- Número correspodente ao post -->
              <div class="box-body">
                  <div class="form-group">
                      <label>Título:</label>
                      <input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo $tituloAviso;?>">
                  </div>
                  <div class="form-group">
                      <label>Conteúdo:</label>
                        <textarea class=" textarea" name="texto" id="texto" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $textoAviso;?></textarea>
                  </div>     
              </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                    <a href="/avisos"<span class="btn btn-default">Cancelar</span></a>
                  </div>
                  </form>
                </div>  
          </div><!-- /.box -->

        </section><!-- /.content -->
      <?php include '../../includes/rodape.php';
        $query->close();
        $db->close();
       ?> 
    </div><!-- ./wrapper -->
    <?php include '../../includes/script.php' ?>
    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <script>
    $('#formedita').find('.formulario').submit(function() {
        var titulo = $.trim($(this).find('#titulo').val());
        var texto = $.trim($(this).find('#texto').val());

        if(!(titulo.length != 0 && texto.length != 0)) {
            alert("Por favor, preencha todos os campos!");
            return false;
        }
    });
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });    
  </script>
</body>
</html>
