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
?>
  <title>AdminDcomp - Configurar requerimentos</title>
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
   <section class="content-header">
      <h1>
        Configurar
        <small>Requerimentos</small>
      </h1>
    </section>
    <section class="content">
      <?php
          if(isset($_SESSION['prazoAlterado'])):
        ?>
          <div class="callout callout-success">
            <h4>Prazo alterado com sucesso!</h4>
          </div>
        <?php
          endif;
        ?>

    <div class="row">
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Atividades Complementares</a></li>
            <li><a href="#tab_2" data-toggle="tab">Cadastro de Estágio</a></li>
            <li><a href="#tab_3" data-toggle="tab">Abono de Faltas</a></li>
            <li><a href="#tab_4" data-toggle="tab">Estágio Supervisionado</a></li>
            <li><a href="#tab_5" data-toggle="tab">Inclusão em Disciplina</a></li>
            <li><a href="#tab_6" data-toggle="tab">TCC</a></li>
            <li><a href="#tab_7" data-toggle="tab">Requerimento Geral</a></li>
          </ul>
          <!-- Main content -->
          <div class="box">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
              <!-- Default box -->
                <div class="box-header with-border">
                  <i class="fa fa-info"></i>
                  <h3 class="box-title">Visão Geral</h3>
                </div>
                <div class="box-body">
                  <dl>
                    <dt>Prazo de solicitações</dt>
                    <dd>
                      <?php
                        $prazo = Atalhos::verificarReq(1);
                        if($prazo[1] != '31/12/1969'){
                          echo $prazo[1].' até '.$prazo[2];
                        }
                        else{
                          echo 'Prazo indefinido!';
                        }
                      ?>
                    </dd>
                  </dl>
                </div><!-- /.box-body-->
                <div class="box-header with-border">
                  <i class="fa fa-wrench"></i>
                  <h3 class="box-title">Ações</h3>
                </div>
                <div class="box-body">
                  <button class="btn btn-app" style="height: auto;"
                                data-toggle="modal" data-target="#negativo" data-solict-id="1" data-solict-tipo="Atividades Complementares"
                                data-solict-frase="Alterar prazo"><i class="fa fa-calendar"></i> Alterar prazo</button>
                </div>
              </div><!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <!-- Default box -->
                <div class="box-header with-border">
                  <i class="fa fa-info"></i>
                  <h3 class="box-title">Visão Geral</h3>
                </div>
                <div class="box-body">
                  <dl>
                    <dt>Prazo de solicitações</dt>
                    <dd>
                      <?php
                        $prazo = Atalhos::verificarReq(2);
                        if($prazo[1] != "31/12/1969"){
                          echo $prazo[1].' até '.$prazo[2];
                        }
                        else{
                          echo 'Prazo indefinido!';
                        }
                      ?>
                    </dd>
                  </dl>
                </div><!-- /.box-body-->
                <div class="box-header with-border">
                  <i class="fa fa-wrench"></i>
                  <h3 class="box-title">Ações</h3>
                </div>
                <div class="box-body">
                  <button class="btn btn-app" style="height: auto;"
                                data-toggle="modal" data-target="#negativo" data-solict-id="2" data-solict-tipo="Cadastro de Estágio"
                                data-solict-frase="Alterar prazo"><i class="fa fa-calendar"></i> Alterar prazo</button>
                </div>
              </div><!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <!-- Default box -->
                <div class="box-header with-border">
                  <i class="fa fa-info"></i>
                  <h3 class="box-title">Visão Geral</h3>
                </div>
                <div class="box-body">
                  <dl>
                    <dt>Prazo de solicitações</dt>
                    <dd>
                      <?php
                        $prazo = Atalhos::verificarReq(3);
                        if($prazo[1] != "31/12/1969"){
                          echo $prazo[1].' até '.$prazo[2];
                        }
                        else{
                          echo 'Prazo indefinido!';
                        }
                      ?>
                    </dd>
                  </dl>
                </div><!-- /.box-body-->
                <div class="box-header with-border">
                  <i class="fa fa-wrench"></i>
                  <h3 class="box-title">Ações</h3>
                </div>
                <div class="box-body">
                  <button class="btn btn-app" style="height: auto;"
                                data-toggle="modal" data-target="#negativo" data-solict-id="3" data-solict-tipo="Abono de Faltas"
                                data-solict-frase="Alterar prazo"><i class="fa fa-calendar"></i> Alterar prazo</button>
                </div>
              </div><!-- /.tab-pane -->
              <div class="tab-pane" id="tab_4">
                <!-- Default box -->
                <div class="box-header with-border">
                  <i class="fa fa-info"></i>
                  <h3 class="box-title">Visão Geral</h3>
                </div>
                <div class="box-body">
                  <dl>
                    <dt>Prazo de solicitações</dt>
                    <dd>
                      <?php
                        $prazo = Atalhos::verificarReq(4);
                        if($prazo[1] != "31/12/1969"){
                          echo $prazo[1].' até '.$prazo[2];
                        }
                        else{
                          echo 'Prazo indefinido!';
                        }
                      ?>
                    </dd>
                  </dl>
                </div><!-- /.box-body-->
                <div class="box-header with-border">
                  <i class="fa fa-wrench"></i>
                  <h3 class="box-title">Ações</h3>
                </div>
                <div class="box-body">
                  <button class="btn btn-app" style="height: auto;"
                                data-toggle="modal" data-target="#negativo" data-solict-id="4" data-solict-tipo="Estágio Supervisionado"
                                data-solict-frase="Alterar prazo"><i class="fa fa-calendar"></i> Alterar prazo</button>
                </div>
              </div><!-- /.tab-pane -->
              <div class="tab-pane" id="tab_5">
                <!-- Default box -->
                <div class="box-header with-border">
                  <i class="fa fa-info"></i>
                  <h3 class="box-title">Visão Geral</h3>
                </div>
                <div class="box-body">
                  <dl>
                    <dt>Prazo de solicitações</dt>
                    <dd>
                      <?php
                        $prazo = Atalhos::verificarReq(5);
                        if($prazo[1] != "31/12/1969"){
                          echo $prazo[1].' até '.$prazo[2];
                        }
                        else{
                          echo 'Prazo indefinido!';
                        }
                      ?>
                    </dd>
                  </dl>
                </div><!-- /.box-body-->
                <div class="box-header with-border">
                  <i class="fa fa-wrench"></i>
                  <h3 class="box-title">Ações</h3>
                </div>
                <div class="box-body">
                  <button class="btn btn-app" style="height: auto;"
                                data-toggle="modal" data-target="#negativo" data-solict-id="5" data-solict-tipo="Inclusão em Disciplina"
                                data-solict-frase="Alterar prazo"><i class="fa fa-calendar"></i> Alterar prazo</button>
                </div>
              </div><!-- /.tab-pane -->
              <div class="tab-pane" id="tab_6">
                <!-- Default box -->
                <div class="box-header with-border">
                  <i class="fa fa-info"></i>
                  <h3 class="box-title">Visão Geral</h3>
                </div>
                <div class="box-body">
                  <dl>
                    <dt>Prazo de solicitações</dt>
                    <dd>
                      <?php
                        $prazo = Atalhos::verificarReq(6);
                        if($prazo[1] != "31/12/1969"){
                          echo $prazo[1].' até '.$prazo[2];
                        }
                        else{
                          echo 'Prazo indefinido!';
                        }
                      ?>
                    </dd>
                  </dl>
                </div><!-- /.box-body-->
                <div class="box-header with-border">
                  <i class="fa fa-wrench"></i>
                  <h3 class="box-title">Ações</h3>
                </div>
                <div class="box-body">
                  <button class="btn btn-app" style="height: auto;"
                                data-toggle="modal" data-target="#negativo" data-solict-id="6" data-solict-tipo="TCC"
                                data-solict-frase="Alterar prazo"><i class="fa fa-calendar"></i> Alterar prazo</button>
                </div>
              </div><!-- /.tab-pane -->
              <div class="tab-pane" id="tab_7">
                <!-- Default box -->
                <div class="box-header with-border">
                  <i class="fa fa-info"></i>
                  <h3 class="box-title">Visão Geral</h3>
                </div>
                <div class="box-body">
                  <dl>
                    <dt>Prazo de solicitações</dt>
                    <dd>
                      <?php
                        $prazo = Atalhos::verificarReq(7);
                        if($prazo[1] != "31/12/1969"){
                          echo $prazo[1].' até '.$prazo[2];
                        }
                        else{
                          echo 'Prazo indefinido!';
                        }
                      ?>
                    </dd>
                  </dl>
                </div><!-- /.box-body-->
                <div class="box-header with-border">
                  <i class="fa fa-wrench"></i>
                  <h3 class="box-title">Ações</h3>
                </div>
                <div class="box-body">
                  <button class="btn btn-app" style="height: auto;"
                                data-toggle="modal" data-target="#negativo" data-solict-id="7" data-solict-tipo="Requerimento Geral"
                                data-solict-frase="Alterar prazo"><i class="fa fa-calendar"></i> Alterar prazo</button>
                </div>
              </div><!-- /.tab-pane -->

            </div><!-- /.tab-content -->
          </div><!-- /.box -->
        </div>
      </div>
    </div>
  </section><!-- /.content -->
  </div>

<?php include 'rodape.php' ?>
</div><!-- ./wrapper -->

<!-- ALTERAR PRAZO -->
<div class="modal fade" id="negativo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel"></h4>
          </div>
          <form role="form" action="post.php" method="post" name="formulario" id="formulario">
            <div class="modal-body">
              <input type="hidden" id="numPost" name="numPost" value="49"><!-- Número correspodente ao post -->
              <input type="hidden" id="idPrazo" name="id"><!-- Número correspodente ao requerimento -->
              <div class="form-group">
                <label>Selecione o novo prazo (será considerada das 00h do primeiro dia até 23h59min do último dia):</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="reservation" name="data">
                </div>
              </div>
              <div class="form-group">
                <label>
                  <input type="checkbox" id="null" name="null" class="minimal">
                  Prazo Indefinido
                </label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-success">Confirmar</button>
            </div>
          </form>
        </div>
    </div>
</div>
<!-- FIM ALTERAR PRAZO -->
<?php include 'script.php' ?>
<!-- ChartJS 1.0.1 -->
<script src="../frontend-v2.0/plugins/chartjs/Chart.min.js"></script>
<script>
  $('#negativo').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var frase = button.data('solict-frase')
    var tipo = button.data('solict-tipo')
    var id = button.data('solict-id') // Extract info from data-* attributes
    var modal = $(this)
    modal.find('.modal-title').text(frase + ' - ' + tipo)
      $('#idPrazo').val(id)
    })

  $(function () {
//-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
      {
        value: 700,
        color: "#f56954",
        highlight: "#f56954",
        label: "Chrome"
      },
      {
        value: 500,
        color: "#00a65a",
        highlight: "#00a65a",
        label: "IE"
      },
      {
        value: 400,
        color: "#f39c12",
        highlight: "#f39c12",
        label: "FireFox"
      }
    ];
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);
  });
</script>
</body>
</html>
