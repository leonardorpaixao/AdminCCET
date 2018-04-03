<?php 
  include '../../includes/topo.php';
?>
<title>AdminDcomp - Mapa do DCOMP</title>
</head>
<?php
  if($_SESSION['mobile'])
    header('Location: /inicio');
  include '../../includes/barra.php';
  include '../../includes/menu.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Mapa do DCOMP
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
      
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script type="text/javascript">$(function() {
            $('.map').maphilight();
        });</script> 
        <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#novasedet" data-toggle="tab">Nova Sede - Térreo</a></li>
                  <li><a href="#novasede1" data-toggle="tab">Nova Sede - 1º piso</a></li>
                  <li><a href="#antigasede" data-toggle="tab">Antiga Sede</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="novasedet">
                    <script type="text/javascript">$(function() {
                        $('#nt1').mouseover(function(e) {
                            TrocarClass(1,"t");
                        }).mouseout(function(e) {
                            TrocarClass(1,"t");
                        });
                        $('#nt2').mouseover(function(e) {
                            TrocarClass(2,"t");
                        }).mouseout(function(e) {
                            TrocarClass(2,"t");
                        });
                        $('#nt3').mouseover(function(e) {
                            TrocarClass(3,"t");
                        }).mouseout(function(e) {
                            TrocarClass(3,"t");
                        });
                        $('#nt4').mouseover(function(e) {
                            TrocarClass(4,"t");
                        }).mouseout(function(e) {
                            TrocarClass(4,"t");
                        });
                        $('#nt5').mouseover(function(e) {
                            TrocarClass(5,"t");
                        }).mouseout(function(e) {
                            TrocarClass(5,"t");
                        });
                        $('#nt6').mouseover(function(e) {
                            TrocarClass(6,"t");
                        }).mouseout(function(e) {
                            TrocarClass(6,"t");
                        });
                        $('#nt7').mouseover(function(e) {
                            TrocarClass(7,"t");
                        }).mouseout(function(e) {
                            TrocarClass(7,"t");
                        });
                        $('#nt8').mouseover(function(e) {
                            TrocarClass(8,"t");
                        }).mouseout(function(e) {
                            TrocarClass(8,"t");
                        });
                        $('#nt9').mouseover(function(e) {
                            TrocarClass(9,"t");
                        }).mouseout(function(e) {
                            TrocarClass(9,"t");
                        });
                        $('#nt10').mouseover(function(e) {
                            TrocarClass(10,"t");
                        }).mouseout(function(e) {
                            TrocarClass(10,"t");
                        });
                        $('#nt11').mouseover(function(e) {
                            TrocarClass(11,"t");
                        }).mouseout(function(e) {
                            TrocarClass(11,"t");
                        });
                        $('#nt12').mouseover(function(e) {
                            TrocarClass(12,"t");
                        }).mouseout(function(e) {
                            TrocarClass(12,"t");
                        });
                        $('#nt13').mouseover(function(e) {
                            TrocarClass(13,"t");
                        }).mouseout(function(e) {
                            TrocarClass(13,"t");
                        });
                        $('#nt14').mouseover(function(e) {
                            TrocarClass(14,"t");
                        }).mouseout(function(e) {
                            TrocarClass(14,"t");
                        });
                        $('#nt15').mouseover(function(e) {
                            TrocarClass(15,"t");
                        }).mouseout(function(e) {
                            TrocarClass(15,"t");
                        });
                        $('#nt16').mouseover(function(e) {
                            TrocarClass(16,"t");
                        }).mouseout(function(e) {
                            TrocarClass(16,"t");
                        });
                        $('#nt17').mouseover(function(e) {
                            TrocarClass(17,"t");
                        }).mouseout(function(e) {
                            TrocarClass(17,"t");
                        });
                        $('#nt18').mouseover(function(e) {
                            TrocarClass(18,"t");
                        }).mouseout(function(e) {
                            TrocarClass(18,"t");
                        });
                        $('#nt19').mouseover(function(e) {
                            TrocarClass(19,"t");
                        }).mouseout(function(e) {
                            TrocarClass(19,"t");
                        });
                        $('#lnt1').mouseover(function(e) {
                            $('#nt1').mouseover();
                        }).mouseout(function(e) {
                            $('#nt1').mouseout();
                        });
                        $('#lnt2').mouseover(function(e) {
                            $('#nt2').mouseover();
                        }).mouseout(function(e) {
                            $('#nt2').mouseout();
                        });
                        $('#lnt3').mouseover(function(e) {
                            $('#nt3').mouseover();
                        }).mouseout(function(e) {
                            $('#nt3').mouseout();
                        });
                        $('#lnt4').mouseover(function(e) {
                            $('#nt4').mouseover();
                        }).mouseout(function(e) {
                            $('#nt4').mouseout();
                        });
                        $('#lnt5').mouseover(function(e) {
                            $('#nt5').mouseover();
                        }).mouseout(function(e) {
                            $('#nt5').mouseout();
                        });
                        $('#lnt6').mouseover(function(e) {
                            $('#nt6').mouseover();
                        }).mouseout(function(e) {
                            $('#nt6').mouseout();
                        });
                        $('#lnt7').mouseover(function(e) {
                            $('#nt7').mouseover();
                        }).mouseout(function(e) {
                            $('#nt7').mouseout();
                        });
                        $('#lnt8').mouseover(function(e) {
                            $('#nt8').mouseover();
                        }).mouseout(function(e) {
                            $('#nt8').mouseout();
                        });
                        $('#lnt9').mouseover(function(e) {
                            $('#nt9').mouseover();
                        }).mouseout(function(e) {
                            $('#nt9').mouseout();
                        });
                        $('#lnt10').mouseover(function(e) {
                            $('#nt10').mouseover();
                        }).mouseout(function(e) {
                            $('#nt10').mouseout();
                        });
                        $('#lnt11').mouseover(function(e) {
                            $('#nt11').mouseover();
                        }).mouseout(function(e) {
                            $('#nt11').mouseout();
                        });
                        $('#lnt12').mouseover(function(e) {
                            $('#nt12').mouseover();
                        }).mouseout(function(e) {
                            $('#nt12').mouseout();
                        });
                        $('#lnt13').mouseover(function(e) {
                            $('#nt13').mouseover();
                        }).mouseout(function(e) {
                            $('#nt13').mouseout();
                        });
                        $('#lnt14').mouseover(function(e) {
                            $('#nt14').mouseover();
                        }).mouseout(function(e) {
                            $('#nt14').mouseout();
                        });
                        $('#lnt15').mouseover(function(e) {
                            $('#nt15').mouseover();
                        }).mouseout(function(e) {
                            $('#nt15').mouseout();
                        });
                        $('#lnt16').mouseover(function(e) {
                            $('#nt16').mouseover();
                        }).mouseout(function(e) {
                            $('#nt16').mouseout();
                        });
                        $('#lnt17').mouseover(function(e) {
                            $('#nt17').mouseover();
                        }).mouseout(function(e) {
                            $('#nt17').mouseout();
                        });
                        $('#lnt18').mouseover(function(e) {
                            $('#nt18').mouseover();
                        }).mouseout(function(e) {
                            $('#nt18').mouseout();
                        });
                        $('#lnt19').mouseover(function(e) {
                            $('#nt19').mouseover();
                        }).mouseout(function(e) {
                            $('#nt19').mouseout();
                        });
                    });</script> 
                    <p>
                      <table class="table table-striped">
                        <tr>
                          <td><span id="lnt1" class="badge bg-light-blue">1 - Sala de Servidores</span></td>
                          <td><span id="lnt2" class="badge bg-light-blue">2 - Sala de Técnicos</span></td>
                          <td><span id="lnt3" class="badge bg-light-blue">3 - Lab. de Engenharia da Computação I</span></td>
                          <td><span id="lnt4" class="badge bg-light-blue">4 - Lab. de Engenharia da Computação II </span></td>
                          <td><span id="lnt5" class="badge bg-light-blue">5 - Lab. Geral de Estudos</span></td>
                        </tr>
                        <tr>
                          <td><span id="lnt6" class="badge bg-light-blue">6 - Sala de Estudos</span></td>
                          <td><span id="lnt7" class="badge bg-light-blue">7 - Banheiros</span></td>
                          <td><span id="lnt8" class="badge bg-light-blue">8 - Elevador de Acessibilidade</span></td>
                          <td><span id="lnt9" class="badge bg-light-blue">9 - Sala de Vivência (Sala do sofá)</span></td>
                          <td><span id="lnt10" class="badge bg-light-blue">10 - Copa</span></td>
                        </tr>
                        <tr>
                          <td><span id="lnt11" class="badge bg-light-blue">11 - Lab. de Pesquisas I</span></td>
                          <td><span id="lnt12" class="badge bg-light-blue">12 - Lab. de Pesquisas II</span></td>
                          <td><span id="lnt13" class="badge bg-light-blue">13 - Sala de Projetos de Extensão(INES)</span></td>
                          <td><span id="lnt14" class="badge bg-light-blue">14 - Lab. de Graduação</span></td>
                          <td><span id="lnt15" class="badge bg-light-blue">15 - Lab. de Hardware II</span></td>
                        </tr>
                        <tr>
                          <td><span id="lnt16" class="badge bg-light-blue">16 - Almoxarifado</span></td>
                          <td><span id="lnt17" class="badge bg-light-blue">17 - Lab. de Hardware I</span></td>
                          <td><span id="lnt18" class="badge bg-light-blue">18 - SOFTEAM</span></td>
                          <td><span id="lnt19" class="badge bg-light-blue">19 - Secretaria</span></td>
                        </tr>
                      </table>
                    </p>                  
                    <img src="img-novasedet.png" width="900" height="450" class="map" usemap="#novodcompt">
                    <map name="novodcompt">
                    <area id="nt1" shape="rect" coords="3,3,62,158" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    <area id="nt2" shape="rect" coords="65,3,128,158" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    <area id="nt3" shape="rect" coords="131,3,210,158" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    <area id="nt4" shape="rect" coords="213,3,292,158" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    <area id="nt5" shape="rect" coords="295,3,414,158" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    <area id="nt6" shape="rect" coords="417,3,521,158" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    <area id="nt7" shape="rect" coords="524,3,608,158" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    <area id="nt8" shape="rect" coords="655,88,679,113" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    <area id="nt9" shape="rect" coords="732,3,765,100" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    <area id="nt10" shape="rect" coords="768,3,812,158" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    <area id="nt11" shape="rect" coords="3,209,79,287" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    <area id="nt12" shape="rect" coords="3,290,107,364" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    <area id="nt13" shape="rect" coords="110,209,170,364" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    <area id="nt14" shape="rect" coords="173,209,249,364" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    <area id="nt15" shape="rect" coords="252,209,348,364" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    <area id="nt16" shape="rect" coords="351,209,414,364" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    <area id="nt17" shape="rect" coords="417,209,521,364" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    <area id="nt18" shape="rect" coords="524,209,566,364" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    <area id="nt19" shape="rect" coords="569,209,679,364" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    </map>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="novasede1">
                    <script type="text/javascript">$(function() {
                        $('#n11').mouseover(function(e) {
                            TrocarClass(1,1);
                        }).mouseout(function(e) {
                            TrocarClass(1,1);
                        });
                        $('#n12').mouseover(function(e) {
                            TrocarClass(2,1);
                        }).mouseout(function(e) {
                            TrocarClass(2,1);
                        });
                        $('#n13').mouseover(function(e) {
                            TrocarClass(3,1);
                        }).mouseout(function(e) {
                            TrocarClass(3,1);
                        });
                        $('#n14').mouseover(function(e) {
                            TrocarClass(4,1);
                        }).mouseout(function(e) {
                            TrocarClass(4,1);
                        });
                        $('#n15').mouseover(function(e) {
                            TrocarClass(5,1);
                        }).mouseout(function(e) {
                            TrocarClass(5,1);
                        });
                        $('#n16').mouseover(function(e) {
                            TrocarClass(6,1);
                        }).mouseout(function(e) {
                            TrocarClass(6,1);
                        });
                        $('#n17').mouseover(function(e) {
                            TrocarClass(7,1);
                        }).mouseout(function(e) {
                            TrocarClass(7,1);
                        });
                        $('#n18').mouseover(function(e) {
                            TrocarClass(8,1);
                        }).mouseout(function(e) {
                            TrocarClass(8,1);
                        });
                        $('#n19').mouseover(function(e) {
                            TrocarClass(9,1);
                        }).mouseout(function(e) {
                            TrocarClass(9,1);
                        });
                        $('#n110').mouseover(function(e) {
                            TrocarClass(10,1);
                        }).mouseout(function(e) {
                            TrocarClass(10,1);
                        });
                        $('#ln11').mouseover(function(e) {
                            $('#n11').mouseover();
                        }).mouseout(function(e) {
                            $('#n11').mouseout();
                        });
                        $('#ln12').mouseover(function(e) {
                            $('#n12').mouseover();
                        }).mouseout(function(e) {
                            $('#n12').mouseout();
                        });
                        $('#ln13').mouseover(function(e) {
                            $('#n13').mouseover();
                        }).mouseout(function(e) {
                            $('#n13').mouseout();
                        });
                        $('#ln14').mouseover(function(e) {
                            $('#n14').mouseover();
                        }).mouseout(function(e) {
                            $('#n14').mouseout();
                        });
                        $('#ln15').mouseover(function(e) {
                            $('#n15').mouseover();
                        }).mouseout(function(e) {
                            $('#n15').mouseout();
                        });
                        $('#ln16').mouseover(function(e) {
                            $('#n16').mouseover();
                        }).mouseout(function(e) {
                            $('#n16').mouseout();
                        });
                        $('#n16').mouseover(function(e) {
                            $('#ln16').className='teste';
                        }).mouseout(function(e) {
                            $('#ln16').className='teste1';
                        });
                        $('#ln17').mouseover(function(e) {
                            $('#n17').mouseover();
                        }).mouseout(function(e) {
                            $('#n17').mouseout();
                        });
                        $('#ln18').mouseover(function(e) {
                            $('#n18').mouseover();
                        }).mouseout(function(e) {
                            $('#n18').mouseout();
                        });
                        $('#ln19').mouseover(function(e) {
                            $('#n19').mouseover();
                        }).mouseout(function(e) {
                            $('#n19').mouseout();
                        });
                        $('#ln110').mouseover(function(e) {
                            $('#n110').mouseover();
                        }).mouseout(function(e) {
                            $('#n110').mouseout();
                        });
                    });</script> 
                    <p>
                      <table class="table table-striped">
                        <tr>
                          <td><span id="ln11"  class="badge bg-light-blue">1 - Salas dos Docentes</span></td>
                          <td><span id="ln12"  class="badge bg-light-blue">2 - Lab. de Mestrado</span></td>
                          <td><span id="ln13"  class="badge bg-light-blue">3 - Sala de Apresentação de Seminários</span></td>
                          <td><span id="ln14"  class="badge bg-light-blue">4 - Banheiros</span></td>
                          <td><span id="ln15"  class="badge bg-light-blue">5 - Elevador de Acessibilidade</span></td>
                        </tr>
                        <tr>
                          <td><span id="ln16"  class="badge bg-light-blue">6 - Varanda</span></td>
                          <td><span id="ln17"  class="badge bg-light-blue">7 - Coordenação da Pós</span></td>
                          <td><span id="ln18"  class="badge bg-light-blue">8 - Sala de Reuniões</span></td>
                          <td><span id="ln19"  class="badge bg-light-blue">9 - Auditório</span></td>
                          <td><span id="ln110"  class="badge bg-light-blue">10 - Sala de Alunos de Doutorado/Mestrado</span></td>
                        </tr>
                      </table>
                    </p>    
                    <img src="img-novasede1.png" width="900" height="450" class="map" usemap="#novodcomp1">
                    <map name="novodcomp1">
                        <area id="n11" shape="poly" coords="3,3,388,3,388,50,360,50,360,158,246,158,246,50,205,50,205,158,90,158,90,50,59,50,59,317,90,317,90,209,205,209,205,317,246,317,246,209,360,209,360,317,388,317,388,364,3,364" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n12" shape="rect" coords="391,3,454,158" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n13" shape="rect" coords="457,3,521,158" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n14" shape="rect" coords="524,3,608,158" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n15" shape="rect" coords="655,88,679,113" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n16" shape="rect" coords="682,3,729,40" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n17" shape="rect" coords="732,3,812,158" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n18" shape="rect" coords="732,161,812,206" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n19" shape="rect" coords="457,209,679,364" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n110" shape="rect" coords="391,209,454,364" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    </map>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="antigasede">
                    <script type="text/javascript">$(function() {
                        $('#n21').mouseover(function(e) {
                            TrocarClass(1,2);
                        }).mouseout(function(e) {
                            TrocarClass(1,2);
                        });
                        $('#n22').mouseover(function(e) {
                            TrocarClass(2,2);
                        }).mouseout(function(e) {
                            TrocarClass(2,2);
                        });
                        $('#n23').mouseover(function(e) {
                            TrocarClass(3,2);
                        }).mouseout(function(e) {
                            TrocarClass(3,2);
                        });
                        $('#n24').mouseover(function(e) {
                            TrocarClass(4,2);
                        }).mouseout(function(e) {
                            TrocarClass(4,2);
                        });
                        $('#n25').mouseover(function(e) {
                            TrocarClass(5,2);
                        }).mouseout(function(e) {
                            TrocarClass(5,2);
                        });
                        $('#n26').mouseover(function(e) {
                            TrocarClass(6,2);
                        }).mouseout(function(e) {
                            TrocarClass(6,2);
                        });
                        $('#n27').mouseover(function(e) {
                            TrocarClass(7,2);
                        }).mouseout(function(e) {
                            TrocarClass(7,2);
                        });
                        $('#n28').mouseover(function(e) {
                            TrocarClass(8,2);
                        }).mouseout(function(e) {
                            TrocarClass(8,2);
                        });
                        $('#n29').mouseover(function(e) {
                            TrocarClass(9,2);
                        }).mouseout(function(e) {
                            TrocarClass(9,2);
                        });
                        $('#n210').mouseover(function(e) {
                            TrocarClass(10,2);
                        }).mouseout(function(e) {
                            TrocarClass(10,2);
                        });
                        $('#n211').mouseover(function(e) {
                            TrocarClass(11,2);
                        }).mouseout(function(e) {
                            TrocarClass(11,2);
                        });
                        $('#ln21').mouseover(function(e) {
                            $('#n21').mouseover();
                        }).mouseout(function(e) {
                            $('#n21').mouseout();
                        });
                        $('#ln22').mouseover(function(e) {
                            $('#n22').mouseover();
                        }).mouseout(function(e) {
                            $('#n22').mouseout();
                        });
                        $('#ln23').mouseover(function(e) {
                            $('#n23').mouseover();
                        }).mouseout(function(e) {
                            $('#n23').mouseout();
                        });
                        $('#ln24').mouseover(function(e) {
                            $('#n24').mouseover();
                        }).mouseout(function(e) {
                            $('#n24').mouseout();
                        });
                        $('#ln25').mouseover(function(e) {
                            $('#n25').mouseover();
                        }).mouseout(function(e) {
                            $('#n25').mouseout();
                        });
                        $('#ln26').mouseover(function(e) {
                            $('#n26').mouseover();
                        }).mouseout(function(e) {
                            $('#n26').mouseout();
                        });
                        $('#n26').mouseover(function(e) {
                            $('#ln26').className='teste';
                        }).mouseout(function(e) {
                            $('#ln26').className='teste1';
                        });
                        $('#ln27').mouseover(function(e) {
                            $('#n27').mouseover();
                        }).mouseout(function(e) {
                            $('#n27').mouseout();
                        });
                        $('#ln28').mouseover(function(e) {
                            $('#n28').mouseover();
                        }).mouseout(function(e) {
                            $('#n28').mouseout();
                        });
                        $('#ln29').mouseover(function(e) {
                            $('#n29').mouseover();
                        }).mouseout(function(e) {
                            $('#n29').mouseout();
                        });
                        $('#ln210').mouseover(function(e) {
                            $('#n210').mouseover();
                        }).mouseout(function(e) {
                            $('#n210').mouseout();
                        });
                        $('#ln211').mouseover(function(e) {
                            $('#n211').mouseover();
                        }).mouseout(function(e) {
                            $('#n211').mouseout();
                        });
                    });</script> 
                    <p>
                      <table class="table table-striped">
                        <tr>
                          <td><span id="ln21"  class="badge bg-light-blue">1 - Salas dos Técnicos e de Servidores</span></td>
                          <td><span id="ln22"  class="badge bg-light-blue">2 - Lab. de Graduação 01</span></td>
                          <td><span id="ln23"  class="badge bg-light-blue">3 - Lab. de Graduação 02</span></td>
                          <td><span id="ln24"  class="badge bg-light-blue">4 - Lab. de Graduação 03</span></td>
                          <td><span id="ln25"  class="badge bg-light-blue">5 - Banheiros Comuns</span></td>
                        </tr>
                        <tr>
                          <td><span id="ln26"  class="badge bg-light-blue">6 - Lab. de Graduação 04</span></td>
                          <td><span id="ln27"  class="badge bg-light-blue">7 - Lab. de Graduação 05</span></td>
                          <td><span id="ln28"  class="badge bg-light-blue">8 - Lab. de Graduação 06</span></td>
                          <td><span id="ln29"  class="badge bg-light-blue">9 - Banheiros de Acessibilidade</span></td>
                          <td><span id="ln210"  class="badge bg-light-blue">10 - Secretaria</span></td>
                        </tr>
                        <tr>
                            <td><span id="ln211"  class="badge bg-light-blue">11 - Salas Extras</span></td>
                        </tr>
                      </table>
                    </p>  
                    <img src="img-antigasede.png" width="856" height="520" class="map" usemap="#antigodcomp">
                    <map name="antigodcomp">
                        <area id="n21" shape="poly" coords="3,3,73,3,73,170,129,170,129,215,3,215,3,3" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n22" shape="rect" coords="76,3,282,167" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n23" shape="rect" coords="285,3,421,167" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n24" shape="rect" coords="424,3,490,167" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n25" shape="rect" coords="493,33,634,167" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n26" shape="rect" coords="685,53,853,234" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n27" shape="rect" coords="685,237,853,353" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n28" shape="rect" coords="685,356,853,414" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n29" shape="rect" coords="493,218,586,327" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n210" shape="poly" coords="379,218,490,218,490,288,425,288,425,267,379,267,379,218" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                        <area id="n211" shape="poly" coords="425,291,490,291,490,379,3,379,3,218,353,218,353,285,59,285,59,311,425,311,425,291" data-maphilight='{"stroke":false,"fillColor":"3C8DBC","fillOpacity":1}'>
                    </map>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->

      
    </div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include '../../includes/rodape.php' ?>
    </div><!-- ./wrapper -->
    <script>
    function TrocarClass(id,tipo){
        if(document.getElementById("ln"+tipo+id).className == "badge bg-light-blue"){ 
            document.getElementById("ln"+tipo+id).className = "badge bg-red";
        }else{
            document.getElementById("ln"+tipo+id).className = "badge bg-light-blue";
        }
    }    
    </script>
   
    <?php include '../../includes/script.php' ?>
</body>
</html>
