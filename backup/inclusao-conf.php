    <?php 
    include 'topo.php';
    if(!$_SESSION['logado'] || $_SESSION['nivel'] != 1){
      header('Location: /inicio');
    }
    include 'barra.php';
    include 'menu.php';
    $_SESSION['irPara'] = '/inicio';
    $db = Atalhos::getBanco();
    $link = '/inclusao/configurar';
    if($query = $db->prepare("SELECT inicio, fim FROM tbprazo LIMIT 1")){
          $query->execute();
          $query->bind_result($inicio, $fim);
    }
    ?>
      <title>AdminDcomp - Configurar requerimento de inclusão</title> 
      </head>     
    <style type="text/css">
      /* FROM HTTP://WWW.GETBOOTSTRAP.COM
        * Glyphicons
        *
        * Special styles for displaying the icons and their classes in the docs.
        */

      .bs-glyphicons {
        padding-left: 0;
        padding-bottom: 1px;
        margin-bottom: 20px;
        list-style: none;
        overflow: hidden;
      }
      .bs-glyphicons li {
        float: left;
        width: 25%;
        height: 115px;
        padding: 10px;
        margin: 0 -1px -1px 0;
        font-size: 12px;
        line-height: 1.4;
        text-align: center;
        border: 1px solid #ddd;
      }
      .bs-glyphicons .glyphicon {
        margin-top: 5px;
        margin-bottom: 10px;
        font-size: 24px;
      }
      .bs-glyphicons .glyphicon-class {
        display: block;
        text-align: center;
        word-wrap: break-word; /* Help out IE10+ with class names */
      }
      .bs-glyphicons li:hover {
        background-color: rgba(86,61,124,.1);
      }

      @media (min-width: 768px) {
        .bs-glyphicons li {
          width: 12.5%;
        }
      }
    </style>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Configurar requerimento de inclusão
          </h1>
        </section>
       
        <section class="content">
      <div class="box-body table-responsive no-padding">
        <!-- Main content -->
          <!-- Default box -->
          <div class="box">
            <div class="box-body">
              <?php
                while($query->fetch()){
                  echo '<div class="form-group"><label>Prazo atual: '.date('d/m/Y', strtotime($inicio)).' até '.date('d/m/Y', strtotime($fim)).'</label></div>';
                }
              ?>

            <form role="form" action="post.php" method="post" name="formulario" id="formulario" class="formulario">
                  <input type="hidden" id="numPost" name="numPost" value="49"><!-- Número correspodente ao post -->
              <div class="form-group">
                <label>Selecione o novo prazo (será considerada das 00h do primeiro dia até 23h59min do último dia):</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="reservation" name="data">
                </div>
                <!-- /.input group -->
                <div class="input-group">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-primary btn-flat" onclick="this.disabled=true; this.form.submit();">Alterar prazo</button>
                  </div><!-- /btn-group -->
                </div><!-- /input-group -->
              </div>
              </form>
            </div>
          </div>
          </div><!-- /.box -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
        <?php include 'rodape.php' ?>
     </div><!-- ./wrapper -->    
    <?php include 'script.php' ?>
    <script>
            //Date range picker
    $('#reservation').daterangepicker();



    </script>
  </body>
</html>
