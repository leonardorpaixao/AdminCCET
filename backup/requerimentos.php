<?php
  include 'topo.php';
?>
<title>AdminDcomp - Solicitar Requerimentos</title> 
</head>    
<?php
  include 'barra.php';
  include 'menu.php';
?>
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
            Solicitar
            <small>Requerimentos</small>
          </h1>

        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
            <?php
              $db = Atalhos::getBanco();
              if($query = $db->prepare("SELECT idPrazo, nome, inicio, fim, logado FROM tbPrazo ORDER BY logado DESC, fim ASC")){
                    $query->execute();
                    $query->bind_result($idPrazo, $nome, $inicio, $fim, $logado);
              }
              $transformaHoje = date("Y-m-d", time());
              $hoje = strtotime($transformaHoje);
              while($query->fetch()){
                $inicio2 = strtotime($inicio);
                $fim2 = strtotime($fim);
                if(($_SESSION['logado'] && $logado == 'Sim' && is_null($inicio)) || ($logado == 'Não' && is_null($inicio)) || ($_SESSION['logado'] && $logado == 'Sim' && ($hoje >= $inicio2 && $hoje <= $fim2)) || ($logado == 'Não' && ($hoje >= $inicio2 && $hoje <= $fim2))){
                  
                  $situacao = 'Aberto';
                } elseif((!$_SESSION['logado'] && $logado == 'Sim')){
                  $situacao = 'Deslogado';  
                } else{
                  $situacao = 'Indisponivel';
                }

                switch ($situacao) {
                  case 'Aberto':
                    $cor = 'green';
                    $icone = 'fa-pencil-square';
                    $texto = 'Clique para enviar uma solicitação.';
                    if(!is_null($inicio))
                    	$texto .= '<br>Prazo de solicitações: <b>'.date("d/m/Y", $inicio2).'</b> até <b>'.date("d/m/Y", $fim2).'</b>';
                    break;
                  case 'Deslogado':
                    $cor = 'red';
                    $icone = 'fa-user-secret';
                    $texto = 'Logue-se no AdminDCOMP para solicitar esse requerimento.';
                    break;
                  case 'Indisponivel':
                    $cor = 'yellow';
                    $icone = 'fa-warning';
                    $texto = 'Requerimento <b>indisponível</b>.<br>Próximo prazo de solicitações: <b>'.date("d/m/Y", $inicio2).'</b> até <b>'.date("d/m/Y", $fim2).'</b>';
                    break;
                }
                if($situacao == 'Aberto')
                  echo '<a href="/requerimentos/inserir/'.$idPrazo.'/">';
            ?>
            <div class="col-md-6 col-sm-6 col-xs-12" style="color: #000;">
              <div class="info-box">
                <span class="info-box-icon bg-<?php echo $cor;?>"><i class="fa <?php echo $icone;?>"></i></span>

                <div class="info-box-content">
                  <span class="info-box-number"><?php echo $nome;?></span>
                  <span><?php echo $texto;?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            </a>
            <?php
              if($situacao == 'Aberto')
                    echo '</a>';
              } // FINAL DO WHILE FETCH   
              $query->close();
            ?>

        </div>

          </section>

    </div><!-- ./wrapper -->
    <?php include 'rodape.php' ?>
    <?php include 'script.php' ?>
  </body>
</html>
