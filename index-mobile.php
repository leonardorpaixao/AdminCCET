<?php 
include 'includes/topo.php';
?>
<title>AdminDcomp - Página Inicial</title>
</head>

<?php

  include 'includes/barra.php';
  include 'includes/menu.php' ;
  $_SESSION['irPara'] = '/inicio';
  $db = Atalhos::getBanco();
  if($query = $db->prepare("SELECT idAviso, tituloAviso, textoAviso FROM tbavisos WHERE statusAviso = 'Ativo'")){
    $query->execute();
    $query->bind_result($id, $titulo, $texto);
    $query->store_result();
  }
?>
    <style>
    .imagemArtigo{
        width: 100%;
        height: 100%;
    }
    .artigo{
        min-width: 100%;
        width: 50%;
        font-size: 20px;    
        text-align: justify;
        font-weight: 200;    
        float: left;
        padding-left: 3%;
        padding-right: 3%;
        position: relative;
        line-height: 1.0;
        color: #CBD9E8;
    }
    label{
        font-size: 55px;
        color: #fff;
    }
    .imagem{
        position: absolute;
        width: 50%;
        height: 100%;
        float:right;
        right: 0;
    }
    .carousel,
    .item,
    .active {
        height: 100%;
        margin: 0px;
        padding: 0px;
    }

    .carousel-inner {
        height: 100%;
        width: 100%;
        margin: 0px;
        padding: 0px;
    }
    .carousel-caption {
      width: 100%;
      height: 100%;
      left: 0;
      top: 0;
      margin: 0px;
      padding: 0px;
    }
    /* Background images are set within the HTML using inline CSS, not here */

    .fill {
        width: 100%;
        height: 100%;
        background-position: center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
        -o-background-size: cover;
    }
    </style>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Main content -->
      <section class="content">
        <?php
          if(isset($_SESSION['avisoIndex'])):
        ?>
            <div class="callout callout-warnning">
              <h4>Sua sessão foi expirada!</h4>
              <p>Faça o login novamente para continuar acessando.</p>
            </div>
        <?php
            unset($_SESSION['avisoIndex']);
          endif;
          if(isset($_SESSION['avisoPriAcesso'])):
        ?>
            <div class="callout callout-success">
              <h4>Alterado com sucesso:</h4>
              <p><?php echo $_SESSION['avisoPriAcesso'] ?></p>
            </div>
        <?php
            unset($_SESSION['avisoPriAcesso']);
          endif;
        ?>
        <div style="width: 97%;">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h2 class="box-title">Painel de Avisos</h2>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <?php 
                  if($query->num_rows > 0){
                    echo '<ol class="carousel-indicators">';
                    echo '<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>';
                    for($i=1; $i < $query->num_rows; $i++){
                      echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'"></li>';
                    }
                    echo '</ol>';
                  } 
                ?>
                <div class="carousel-inner">                 
                  <!-- COMEÇO AVISOS DCOMP -->
                  <?php 
                    while($query->fetch()){
                      if($id == 1){
                        echo "
                          <div class='item active' style='height: 500px;'>
                            <div class='fill' style='background-color:#3C8DBC;'></div>
                            <div class='carousel-caption'>
                              <div class='artigo' style='text-align: center;'><h1><b>".$titulo."</b></h1>
                                  ".html_entity_decode($texto)."
                              </div>
                            </div>
                          </div>";
                      }else{
                        echo "
                        <div class='item' style='height: 500px;'>
                          <div class='fill' style='background-color:#3C8DBC;'></div>
                          <div class='carousel-caption'>
                            <div class='artigo' style='text-align: center;'><h1><b>".$titulo."</b></h1>
                                ".html_entity_decode($texto)."
                            </div>
                          </div>
                        </div>";                          
                      }
                    }
                    $query->free_result();
                    $query->close();
                    $db->close();
                  ?>
                  <!-- FIM AVISOS DCOMP -->
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
      <!-- END ACCORDION & CAROUSEL-->
      </section><!-- /.content -->
    </div><!-- /.container -->
  <?php include 'includes/rodape.php' ?>
  </div><!-- /.content-wrapper -->
</div><!-- ./wrapper -->
  <?php include 'includes/script.php' ?>
  <script>
    $('.carousel').carousel({
        interval: 20000 //changes the speed
    })
  </script>
</body>
</html>
