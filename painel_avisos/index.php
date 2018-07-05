<?php
  	include '../sessao.php';
    $db = Atalhos::getBanco();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="refresh" content="1800">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="DCOMP">

    <title>Painel de Avisos</title>
    <style>
    body{
        overflow: hidden;
    }
    .simply-scroll-container { /* Container DIV - automatically generated */
  position: relative;
}

  .simply-scroll-clip { /* Clip DIV - automatically generated */
    position: relative;
    overflow: hidden;
  }

  .simply-scroll-list { /* UL/OL/DIV - the element that simplyScroll is inited on */
    overflow: hidden;
    margin: 0;
    padding: 0;
    list-style: none;
  }
  
    .simply-scroll-list li {
      padding: 0;
      margin: 0;
      list-style: none;
      float: left;
      font-size: 25px;
      color: #fff;
      margin-right: 5px;
    }
  
    .simply-scroll-list li div {
      border: none;
      display: block;
  }
  </style>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/full-slider.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endifstyle="overflow: hidden;"]-->
    <style>
    .imagemArtigo{
        min-width: 100%;
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
        color: #212121;
    }
    label{
        font-size: 55px;
        color: #fff;
    }
    .imagem{
        position: absolute;
        min-width: 50%;
        width: 50%;
        height: 100%;
        float:right;
        right: 0;
    }
    h4{
    	color: #000;
    }
    </style>
</head>
<body>
    <header style="width:100%; height: 15%;background-color: #367FA9; padding: 10px;">
        <img src="dcomp.jpg" style="border-radius: 10px;width: auto; height: 100%;float: left;">
        <div style="float:right; margin-left: 10px; width: auto; height: 100%;">
            <label>
                <?php
                    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                    date_default_timezone_set('America/Recife');
                    echo strftime('%A, %d de %B de %Y', strtotime('today'));
                ?> - 
            </label>
            <label id="clock"></label>
        </div>      
    </header>
    <header id="myCarousel" class="carousel slide" style="height: 77.3%;" >
        <div class="carousel-inner">            
            <!-- COMEÇO AVISOS DCOMP -->
            
            <?php 
                if ($query = $db->prepare("SELECT idAviso, tituloAviso, textoAviso FROM tbAvisos WHERE statusAviso = 'Ativo'")){ 
                        $query->execute();
                        $query->bind_result($id, $titulo, $texto);
                        $query->store_result();
                    $cont = 0;
                    while ($query->fetch()){
                        if($cont == 0)
                            echo "<div class='item active'>";
                        else
                            echo "<div class='item'>";    
                            echo "
                                <div class='fill' style='background-color:#fff;'></div>
                                <div class='carousel-caption' style='float: left;min-width: 100%;width: 100%;'>
                                    <div class='artigo' style='text-align: center;'><h6 style='color: #000;'>".$titulo."</h6>".html_entity_decode($texto)."</div>
                                    <div class='imagem'>
                                        <img src='avisos.png' class='imagemArtigo'/>
                                    </div>
                                </div>
                            </div>";
                        $cont++;
                    }
                    $query->close();
                }
            ?>
            <!-- FIM AVISOS DCOMP -->

            <!-- COMEÇO FEED OLHARDIGITAL.COM.BR -->
            <?php
                //IF VERIFICA SE NÃO TEM ERRO DE CONEXÃO
                if(@simplexml_load_file("http://olhardigital.uol.com.br/rss/ultimas_noticias.php"))
                {
                    $num = 0;
                    $max = 8;
                    $xml = simplexml_load_file("http://olhardigital.uol.com.br/rss/ultimas_noticias.php");
                    foreach($xml->channel->item as $item){
                        if($num == $max ) {
                            break;
                        }
                        echo "<div class='item'>
                            <div class='fill' style='background-color:#fff;'></div>
                            <div class='carousel-caption' style='float: left;'>";
                        //preg_match_all('/<div class="imagem"><img src="(.+.)" width="660" height="420" \/><\/div>/', file_get_contents($item->link), $br);
                        if(preg_match_all('/<img src="http:\/\/img1.olhardigital.uol.com.br\/uploads\/acervo_imagens\/(.+.).jpg"/', file_get_contents($item->link), $br))
                            $imagem2 = $br[1][11];
                        else
                            $imagem2 = 'logo_inovacao.png';
                        echo "
                                <div class='artigo'><h6 style='color: #000;'>" . $item->title  . "</h6>". utf8_decode($item->description)."</div>
                                <div class='imagem'>
                                <img src='http://img1.olhardigital.uol.com.br/uploads/acervo_imagens/".$imagem2.".jpg' class='imagemArtigo'/>
                                <div style='position:absolute; bottom:0px; right:0px;'>
                                    <img src='http://chart.apis.google.com/chart?cht=qr&chl=". utf8_decode($item->link)."&chs=200x200' width='200' height='200'>
                                </div>
                                </div></div></div>";
                        $num++;
                    }
                }
            ?>
            <!-- FIM FEED OLHARDIGITAL.COM.BR -->

            <!-- COMEÇO FEED INOVACAOTECNOLOGICA.COM.BR -->
            <?php
                //IF VERIFICA SE NÃO TEM ERRO DE CONEXÃO
                if(@simplexml_load_file("http://www.inovacaotecnologica.com.br/boletim/rss.xml"))
                {
                    $num = 0;
                    $max = 5;
                    $xml = simplexml_load_file("http://www.inovacaotecnologica.com.br/boletim/rss.xml");
                    foreach($xml->channel->item as $item){
                        if($num == $max ) {
                            break;
                        }
                        $num++;    
                        echo "<div class='item'>
                            <div class='fill' style='background-color:#fff;'></div>
                            <div class='carousel-caption' style='float: left;'>";
                        if(preg_match_all('/<meta property="og:image" content="(.+.)"><meta property="og:image:width"/', file_get_contents($item->link), $img))
                            $imagem = $img[1][0];
                        else
                            $imagem = 'logo_inovacao.png';
                        preg_match_all('/<meta name="description" content="(.+)">/', file_get_contents($item->link), $desc);
                        echo "
                                <div class='artigo'><h6 style='color: #000;'>" . $item->title  . "</h6>".utf8_encode($desc[1][0])."</div>
                                <div class='imagem'>
                                <img src='".$imagem."' class='imagemArtigo'/>
                                <div style='position:absolute; bottom:0px; right:0px;'>
                                    <img src='http://chart.apis.google.com/chart?cht=qr&chl=".$item->link."&chs=200x200' width='200' height='200'>
                                </div>
                                </div></div></div>";
                    }
                }
            ?>
            <!-- FIM FEED INOVACAOTECNOLOGICA.COM.BR -->  
        </div>
        <div class="top carousel-control3"></div>
        <div class="bottom carousel-control3"></div>
    </header>
    <header style="width:100%; height: 10%;background-color: #367FA9; padding: 10px;position: relative;">
    <!-- Script para barra de horários -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.simplyscroll.js"></script>
    <script>
        (function($) {
            $(function() {
                $("#scroller").simplyScroll();
            });
        })(jQuery);
    </script>
        <ul id="scroller">
          <li><b>♦♦♦ Reservas para hoje ♦♦♦</b></li>
            <?php 
                $dateNow = date("Y-m-d H:i:s", strtotime("now"));
                $date24h = date("Y-m-d H:i:s", strtotime("+24 hour", strtotime($dateNow)));
				$dbaux =  Atalhos::getBanco();
                if ($aux = $dbaux->prepare("SELECT g.inicio, g.fim, d.nomeUser, f.cor, a.motivoReLab, a.tipoReLab, h.nomeLab, a.tituloReLab FROM tbReservaLab a inner join tbControleDataLab b on b.idReLab = a.idReLab inner join tbUsuario d on a.idUser = d.idUser inner join tbLaboratorio h on h.idLab = b.idLab inner join tbCor f on h.idCor = f.idCor inner join tbData g on b.idData = g.idData WHERE ((b.statusData = 'Aprovado') OR (b.statusData = 'Entregue')) AND (g.inicio >= ? AND g.inicio <= ?)")){ //COLOCAR WHERE PARA PEGAR SÓ O DIA DE HOJE
                    $aux->bind_param('ss', $dateNow, $date24h);
                    $aux->execute();
                    $aux->bind_result($inicio, $fim, $nomeUser, $cor, $motivoReLab, $tipoReLab, $nomeLab, $tituloReLab);
                    $cont = 0;
                    while ($aux->fetch()){
                        $comeco = strtotime($inicio);
                        $final = strtotime($fim);
                        echo "<li>".date('H:i', $comeco)." às ".date('H:i', $final)." [".$tituloReLab." no ".$nomeLab."] ♦♦</li>";
                        $cont++;
                    }
                    if($cont == 0)
                        echo "<li>Nenhuma! ♦♦</li>";
                }
            ?>
          <li style="float: right;margin-top: -35px;">Para realizar uma reserva entre no AdminDCOMP com a sua conta!</li>
        </ul> 
    </header>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 19999, //changes the speed
        pause: 'none'   
    })
    var digital = new Date();
    digital.setHours(<?php echo date("H,i,s"); ?>);
    function clock() {
    var hours = digital.getHours();
    var minutes = digital.getMinutes();
    var seconds = digital.getSeconds();
    digital.setSeconds( seconds+1 )
    if (minutes <= 9) minutes = "0" + minutes;
    if (seconds <= 9) seconds = "0" + seconds;
    dispTime = hours + ":" + minutes + ":" + seconds;
    document.getElementById("clock").innerHTML = dispTime;
    setTimeout("clock()", 1000);
    }
    window.onload = clock;
</script>
</body>
</html>
