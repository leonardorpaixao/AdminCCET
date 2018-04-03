<?php

  include 'includes/topo.php';
?>

<script language="javascript" type="text/javascript">
  (function(a,b){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))window.location=b})(navigator.userAgent||navigator.vendor||window.opera,'/inicio/mobile');
</script>

<title>AdminCCET - Página Inicial</title>
</head>

<?php
  include 'includes/barra.php';
  include 'includes/menu.php' ;

  $_SESSION['irPara'] = '/inicio';
  $db = Atalhos::getBanco();
  if($query = $db->prepare("SELECT idAviso, tituloAviso, textoAviso FROM tbAvisos WHERE statusAviso = 'Ativo'")){
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
        min-width: 50%;
        width: 50%;
        font-size: 30px;
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
              <!--<h4 class="box-title pull-right" ><a class="btn btn-block" data-toggle="tooltip"
                          title="Expandir"  href="painel_avisos/" target="_blank"><i class="fa fa-expand"></i></a></h4> -->
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
                                <div class='imagem'>
                                    <img src='painel_avisos/prediodcomp2.jpg' class='imagemArtigo'/>
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
                              <div class='imagem'>
                                  <img src='painel_avisos/prediodcomp2.jpg' class='imagemArtigo'/>
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
