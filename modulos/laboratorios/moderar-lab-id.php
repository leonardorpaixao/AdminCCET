<?php
  include '../../includes/topo.php';
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 1){
    header('Location: /inicio');
  }
  if(isset($_GET['id'])){
    $idReserva = $_GET['id'];
  }else{
    header('Location: /inicio');
  }

  $auxDb = Atalhos::getBanco();
  if($aux = $auxDb->prepare("SELECT a.idUser, a.tituloReLab, a.motivoReLab, b.nomeUser, c.idLab FROM tbreservalab a INNER JOIN tbusuario b ON a.idUser = b.idUser NATURAL JOIN tbcontroledatalab c WHERE idReLab = ?")){
    $aux->bind_param('i', $idReserva);
    $aux->execute();
    $aux->bind_result($idUser, $tituloReLab, $motivoReLab, $nomeUser, $idLab);
    $aux->fetch();
    $aux->close();
  }
  $auxDb->close();

  if($idLab != 0 || is_null($tituloReLab)){ // Caso já tenha sido definido os laboratórios para reserva ou o ID não exista, ele impede de entrar na página.
    header('Location: /laboratorios/moderar');
  }

?>
<title>AdminDcomp - Moderar Reservas</title>
</head>
<?php
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $_SESSION['irPara'] = '/laboratorios/controlar/'.$idReserva.'/';

  $link = '/laboratorios/moderar';

  $db = Atalhos::getBanco();
  if($query = $db->prepare("SELECT b.inicio, b.fim, a.idReLab, a.idData FROM tbcontroledatalab a NATURAL JOIN tbdata b WHERE a.idReLab = ? ORDER BY statusData ASC, inicio ASC")){
    $query->bind_param('i', $idReserva);
    $query->execute();
    $query->bind_result($inicio, $fim, $idReLab, $idData);
    $query->store_result();
    $totalRows = $query->num_rows;
  }
  $todaReserva = array();
  if($totalRows < 2)
    while ($query->fetch()) {
      $disponiveis = Atalhos::verificarLab($inicio,$fim,$idReLab);
      $todaReserva[] = $disponiveis;
      $todaReserva[] = $disponiveis;
    }
  else{
    while ($query->fetch()) {
      $disponiveis = Atalhos::verificarLab($inicio,$fim,$idReLab);
      $todaReserva[] = $disponiveis;
    }
  }
  $insercaoLabs = call_user_func_array('array_intersect',$todaReserva);
  $query->close();
  $db->close();

  $db = Atalhos::getBanco();
  if($query = $db->prepare("SELECT b.inicio, b.fim, a.idLab, a.idReLab, a.idData FROM tbcontroledatalab a NATURAL JOIN tbdata b WHERE a.idReLab = ? ORDER BY statusData ASC, inicio ASC")){
    $query->bind_param('i', $idReserva);
    $query->execute();
    $query->bind_result($inicio, $fim, $idLab, $idReLab, $idData);
    $query->store_result();
    $totalRows = $query->num_rows;
  }
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Reserva #<?php echo $idReserva;?>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <?php
      if(isset($_SESSION['avisoLab'])):
    ?>
        <div class="callout callout-success">
          <h4><?php echo $_SESSION['avisoLab'] ?></h4>
        </div>
    <?php
        unset($_SESSION['avisoLab']);
      elseif(isset($_SESSION['errorLab'])):
    ?>
        <div class="callout callout-danger">
          <h4>Não foi determinado:</h4>
          <p><?php echo $_SESSION['errorLab'] ?></p>
        </div>
    <?php
        unset($_SESSION['errorLab']);
      endif;
    ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Detalhes da reserva</h3>
          </div>
          <div class="box-body table-responsive">
            <h5>Título da reserva: <b><?php echo $tituloReLab;?></b></h5>
            <h5>Motivo: <b><?php echo $motivoReLab;?></b></h5>
            <h5>Usuário: <b><?php echo $nomeUser;?></b></h5>
            <h5>Total de datas: <b><?php echo $totalRows;?></b></h5>
          </div>
          <div class="box-footer">
            <button class="btn btn-default" style="float:left;margin-right: 2px;" data-toggle="modal" data-target="#mudaData"><i class="fa fa-clock-o"></i> Alterar datas</button>
            <form role="form" action="post/" method="post" id="formulario" autocomplete="off" class="formulario">
              <input type="hidden" id="numPost" name="numPost" value="4"><!-- Número correspodente ao post -->
              <input type="hidden" id="negarAll" name="negarAll" value="1"><!-- Número correspodente ao post -->
              <input type="hidden" id="idReLab" name="idReLab" value="<?php echo $idReLab; ?>"><!-- Número correspodente ao post -->
                <button class="btn btn-danger" onclick="return confirm('Deseja negar todas as datas?');">Negar todas as datas</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Laboratório em comum (quando possível)</h3>
          </div>
          <form role="form" action="post/" method="post" id="formulario" autocomplete="off" class="formulario">
          <input type="hidden" id="numPost" name="numPost" value="4"><!-- Número correspodente ao post -->
          <input type="hidden" id="definirAll" name="definirAll" value="1"><!-- Número correspodente ao post -->
          <input type="hidden" id="idReLab" name="idReLab" value="<?php echo $idReLab; ?>"><!-- Número correspodente ao post -->

          <div class="box-body table-responsive">
            <select class="form-control select2" name="idLab" id="idLab" style="width: 100%" required>
              <option></option>
              <?php
                foreach($insercaoLabs as $result) {
                  if ($aux = $db->prepare("SELECT nomeLab, capAluno, numComp FROM tblaboratorio WHERE idLab = ?")){
                    $aux->bind_param("i", $result);
                    $aux->execute();
                    $aux->bind_result($nomeLab, $capAluno, $numComp);
                    $aux->fetch();
                    $aux->close();
                  }
                  echo '<option value="'.$result.'"> '.$nomeLab.' ('.$numComp.' Maquinas | '.$capAluno.' Alunos)</option>';
                }
              ?>
            </select>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Deseja definir este laboratório para todas as datas?');">Definir laboratório para todas as datas</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Todas as datas</h3>
          </div>
          <form role="form" action="post/" method="post" id="formulario" autocomplete="off" class="formulario">
          <input type="hidden" id="numPost" name="numPost" value="4"><!-- Número correspodente ao post -->
          <input type="hidden" id="definirLab" name="definirLab" value="1"><!-- Número correspodente ao post -->
          <input type="hidden" id="idReLab" name="idReLab" value="<?php echo $idReLab; ?>"><!-- Número correspodente ao post -->

          <div class="box-body table-responsive">
            <!-- Tabela de Laboratórios -->
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th><center>Horário a ser reservado</center></th>
                  <th><center>Selecione uma opção</center></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  //exibe os laboratorios selecionados
                  while ($query->fetch()) {
                    $disponiveis = Atalhos::verificarLab($inicio,$fim,$idReLab);
                    $diaInicio = date("l", strtotime($inicio));
                    $diaFim = date("l", strtotime($fim));
                    
                    switch ($diaInicio) {
                      case 'Sunday':
                        $diaInicioPT = 'Domingo';
                        break;
                      case 'Monday':
                        $diaInicioPT = 'Segunda-feira';
                        break;
                      case 'Tuesday':
                        $diaInicioPT = 'Terça-feira';
                        break;
                      case 'Wednesday':
                        $diaInicioPT = 'Quarta-feira';
                        break;
                      case 'Thursday':
                        $diaInicioPT = 'Quinta-feira';
                        break;
                      case 'Friday':
                        $diaInicioPT = 'Sexta-feira';
                        break;
                      case 'Saturday':
                        $diaInicioPT = 'Sábado';
                        break;
                    }
                    switch ($diaFim) {
                      case 'Sunday':
                        $diaFimPT = 'Domingo';
                        break;
                      case 'Monday':
                        $diaFimPT = 'Segunda-feira';
                        break;
                      case 'Tuesday':
                        $diaFimPT = 'Terça-feira';
                        break;
                      case 'Wednesday':
                        $diaFimPT = 'Quarta-feira';
                        break;
                      case 'Thursday':
                        $diaFimPT = 'Quinta-feira';
                        break;
                      case 'Friday':
                        $diaFimPT = 'Sexta-feira';
                        break;
                      case 'Saturday':
                        $diaFimPT = 'Sábado';
                        break;
                    }
                    echo
                      '<tr align="center">
                        <td><b>Início:</b> '.date("d/m/Y - H:i", strtotime($inicio)).' ('.$diaInicioPT.')<br><b>Fim:</b> '.date("d/m/Y - H:i", strtotime($fim)).' ('.$diaFimPT.')</td>
                        <td>
                          <select class="form-control select2" name="'.$idData.'" id="'.$idData.'" style="width: 100%" required>
                            <option></option>';
                          foreach($disponiveis as $result) {
                          if ($aux = $db->prepare("SELECT nomeLab, capAluno, numComp FROM tblaboratorio WHERE idLab = ?")){
                              $aux->bind_param("i", $result);
                              $aux->execute();
                              $aux->bind_result($nomeLab, $capAluno, $numComp);
                              $aux->fetch();
                              $aux->close();
                            }
                            echo '<option value="'.$result.'"> '.$nomeLab.' ('.$numComp.' Maquinas | '.$capAluno.' Alunos)</option>';
                          }
                          echo '<option value="-1">Excluir data selecionada</option>  
                          </select>
                      </tr>';
                  }
                  $query->close();
                  $db->close();
                ?>
              </tbody>
            </table>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Deseja definir estas opções para cada data?');">Enviar opções selecionadas</button>
          </div>
          </form>
        </div><!-- /.box -->
      </div>
    </div>

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div class="modal fade" id="simples" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
      <form role="form" action="post/" method="post" name="formulario1" id="formulario1">
      <div class="modal-body">
        <input type="hidden" id="numPost" name="numPost" value="10"><!-- Número correspodente ao post -->
        <input type="hidden" name="idLab" id="idLab"/>
        <input type="hidden" name="acao" id="acao"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="mudaData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="exampleModalLabel">Alterar Datas</h4>
      </div>
      <form role="form" action="post/" method="post" name="formulario1" id="formulario1">
      <div class="modal-body">
        <input type="hidden" id="numPost" name="numPost" value="56"><!-- Número correspodente ao post -->
        <input type="hidden" id="alterarData" name="alterarData" value="1"><!-- Número correspodente ao post -->
        <input type="hidden" name="idReLab" id="idReLab" value="<?php echo $idReLab; ?>"/>
        <div id="dynamicInput2">
          <div class="input-group" style="margin-bottom: 15px;">
              <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
              </div>
            <input name="data" type="text" class="form-control pull-right" id="reservationtime" />
          </div>
          <div class="form-group" id="tempo">
            <label>Frequecia da Reserva: <a data-toggle="tooltip" <?php echo 'title="'.textoReserva.'"' ?> >
              <i class=" fa fa-question-circle"></i></a></label>
            <select name="tempo" id="sel-temporeserva" class="form-control">
              <option value="UmaVez">Única</option>
              <option value="Recorrente">Recorrente</option>
            </select>
          </div>
          <div id="palco2">
            <div id="Recorrente" class="form-group">
              <label>Selecione os dias:</label>
              <br/><input type="checkbox" name="dias[]" value="7"> Domingo<br/>
              <input type="checkbox" name="dias[]" value="1"> Segunda<br/>
              <input type="checkbox" name="dias[]" value="2" > Terça<br/>
              <input type="checkbox" name="dias[]" value="3"> Quarta<br/>
              <input type="checkbox" name="dias[]" value="4"> Quinta<br/>
              <input type="checkbox" name="dias[]" value="5"> Sexta<br/>
              <input type="checkbox" name="dias[]" value="6"> Sabado<br/>
            </div>
            <div id="UmaVez">
            </div>
          </div>
          
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
<?php include '../../includes/rodape.php' ?>
    </div><!-- ./wrapper -->
    <?php include '../../includes/script.php' ?>
    <script>
    //DataTable
    $(function () {
      $('#example1').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
        }
      });
    });
    $('#simples').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var tipo = button.data('solict-tipo')
      var frase = button.data('solict-frase')
      var id = button.data('solict-id')
      var nome = button.data('solict-nome')
      var modal = $(this)
      modal.find('.modal-title').text(frase + ' - ' + nome)
      $('#idLab').val(id)
      $('#acao').val(tipo)
    })
    $('#mudaData').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var modal = $(this)
    })
    function id(el){
      return document.getElementById(el);
    }
    function mostra(element){
      if(element.value){
        id(element.value).style.display = 'block';
      }
    }
    function esconde_todos($element, tagName){
      var $elements = $element.getElementsByTagName(tagName),
          i = $elements.length;
      while(i--){
        $elements[i].style.display = 'none';
      }
    }
    window.addEventListener('load', function(){
      var $UmaVez = id('UmaVez'),
          $Recorrente = id('Recorrente'),
          $temporeserva  = id('sel-temporeserva');
      esconde_todos(id('palco2'), 'div');
      mostra($temporeserva);
      $temporeserva.addEventListener('change', function(){
        esconde_todos(id('palco2'), 'div');
        mostra(this);
      });
    });
    </script>
  </body>
</html>
