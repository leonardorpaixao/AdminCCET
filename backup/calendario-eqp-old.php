<?php 
  include 'topo.php';
?>
<title>AdminDcomp - Calendário de Equipamentos</title>
</head>
<?php
  include 'barra.php';
  include 'menu.php';
  $_SESSION['irPara'] = '/equipamentos/calendario';
  $filtro = (isset($_GET['filtro']))? $_GET['filtro'] : NULL;
  $db = Atalhos::getBanco();
  if(isset($filtro) && $filtro != "Todos"){
    $query = $db->prepare("SELECT g.inicio, g.fim, d.nomeUser, f.cor, a.motivoReEq, h.tipoEq, a.tituloReEq FROM tbreservaeq a
      inner join tbcontroledataeq b on b.idReEq = a.idReEq inner join tbusuario d on a.idUser = d.idUser
      inner join tbreservatipoeq c on c.idReEq = a.idReEq inner join tbtipoeq h on h.idTipoEq = c.idTipoEq
      inner join tbcor f on h.idCor = f.idCor inner join tbdata g on b.idData = g.idData WHERE (b.statusData = 'Aprovado' OR 
      b.statusData = 'Entregue') AND h.idTipoEq = ? ORDER BY h.idTipoEq ASC");
    $query->bind_param('i', $filtro);
  }else{
    $query = $db->prepare("SELECT g.inicio, g.fim, d.nomeUser, f.cor, a.motivoReEq, h.tipoEq, a.tituloReEq FROM tbreservaeq a
      inner join tbcontroledataeq b on b.idReEq = a.idReEq inner join tbusuario d on a.idUser = d.idUser
      inner join tbreservatipoeq c on c.idReEq = a.idReEq inner join tbtipoeq h on h.idTipoEq = c.idTipoEq
      inner join tbcor f on h.idCor = f.idCor inner join tbdata g on b.idData = g.idData WHERE b.statusData = 'Aprovado'
      OR b.statusData = 'Entregue' ORDER BY h.idTipoEq ASC");
  }
  $query->execute();
  $query->bind_result($inicio, $fim, $nomeUser, $cor, $motivoReEq, $tipoEq, $tituloReEq);
  $query->store_result();
?>
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Calendario
        <small>Equipamentos</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
          if(isset($_SESSION['errorCalendario'])):
        ?>
          <div class="callout callout-danger">
            <h4>Não foi colocado:</h4>
            <p><?php echo $_SESSION['errorCalendario'] ?></p>
          </div>
        <?php
            unset($_SESSION['errorCalendario']);
          elseif(isset($_SESSION['choqueReserva'])):
        ?>
            <div class="callout callout-warning">
              <h4>Choque de Reserva!</h4>
              <p>Sua Reserva foi classificada como PENDENTE.</p>
            </div>
        <?php
            unset($_SESSION['choqueReserva']);
            unset($_SESSION['avisoCalendario']);
          elseif(isset($_SESSION['avisoCalendario'])):
        ?>
            <div class="callout callout-success">
              <h4>Solicitação enviada com sucesso!</h4>
              <p>Agora basta aguardar até que ela seja avaliada.</p>
            </div>
        <?php
            unset($_SESSION['avisoCalendario']);
          endif;
        ?>
    <!-- CALENDARIO -->
    <div class="row">
      <!-- /.col -->
      <div class="col-md-9">
        <div class="box box-primary">
          <div class="box-body no-padding">
            <!-- FILTRO -->
    				<section class="content-header">
    					<div class="form-group">
    						<form action="" method="GET">
    							<select name="filtro" class="form-control pull-right" onchange="this.form.submit()" 
    									style="width: 150px;" >
                        <?php
                        if($eqp = $db->prepare("SELECT a.idTipoEq, a.tipoEq, a.numEq FROM tbtipoeq a
    										    WHERE numEq > 0 ORDER BY idTipoEq ASC")){
                          $eqp->execute();
                          $eqp->bind_result($idTipoEq, $tipoEq, $numEq);
                        }
    					          echo '<option value="Todos">Todos</option>';
                        while ($eqp->fetch()) {
            							if($filtro == $idTipoEq){
            								echo '<option value="'.$idTipoEq.'" selected="true">'.$tipoEq.'</option>';
            							}
                          else{
            								echo '<option value="'.$idTipoEq.'">'.$tipoEq.'</option>';
            							}
                        }
                        $eqp->close();
                        ?>
    							</select>
    						</form>
    						<label class="pull-right" style="width: 100px">Filtrar por:</label>
    					</div>
    				</section>
            <!-- FIM FILTRO -->
				    <section class="content">
            <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </section> 
          </div><!-- /.box-body -->
        </div><!-- /. box -->
      </div><!-- /.col -->
      <!-- FIM CALENDARIO -->

      <div class="col-md-3">
        <?php if($_SESSION['logado'] && $_SESSION['ativo']): ?>
          <!-- RESERVA -->
          <div class="box box-solid" id="box">
            <div class="box-header with-border">
              <h3 class="box-title">Reservar</h3>
            </div>
            <div class="box-body">
              <form role="form" action="post.php" method="post" name="formulario" id="formulario" class="formulario">
                <input type="hidden" id="numPost" name="numPost" value="1"><!-- Número correspodente ao post -->
                <div class="form-group">
                  <label>Titulo da Reserva:</label>
                  <input type="text" name="titulo" id="titulo" class="form-control" rows="1" maxlength="40" placeholder="Seja breve e objetivo."></input>
                </div>
                <div class="form-group">
                  <label>Escreva o motivo da reserva:</label>
                  <textarea name="motivo" id="motivo" class="form-control" rows="3" placeholder="Descreva o porque da reserva."></textarea>
                </div>
                <div id="dynamicInput">
                  <div class="form-group">
                    <label>Escolha um equipamento:</label>
                    <select name="eqp1" id="eqp1" class="form-control" onchange="numEq('numEq1', this.value)">
      		         	  <option value="">Selecione um Equipamento:</option>
                      <?php

                        if ($eqp = $db->prepare("SELECT idTipoEq, tipoEq, numEq FROM tbtipoeq 
      									   WHERE numEq > 0 ORDER BY idTipoEq ASC")){
                            $eqp->execute();
                            $eqp->bind_result($idTipoEq,$tipoEq, $numEq);
                        }
                        while ($eqp->fetch()) {
                          echo '<option value="'.$idTipoEq.'">'.$tipoEq.'</option>';
                        }
                        $eqp->close();
                      ?>
                    </select>
                  </div>
                  <div name="numEq1" id="numEq1"></div>
                </div>
                <div class="input-group" style="margin-bottom: 5px;">
                  <div class="input-group-btn">
                    <input class="btn btn-success btn-flat" type="button" value="+ Adicionar mais um equipamento" 
  						        onClick="addInput('dynamicInput');">
                  </div><!-- /btn-group -->
                </div>
                <div class="form-group">
                  <label>Frequecia da Reserva: <a data-toggle="tooltip" <?php echo 'title="'.textoReserva.'"' ?> >
                    <i class=" fa fa-question-circle"></i></a></label>
                  <select name="tempo" id="sel-temporeserva" class="form-control" onchange="admin('freq1', this)">
                    <option value="UmaVez">Única</option>
                    <option value="Recorrente">Recorrente</option>
                  </select>
                </div>
                <div id="freq1">
                  <div id="Recorrente" class="form-group">
        
                   <label>Selecione os dias:</label>
                    <br/><input type="checkbox" name="dias[]" value="7"> Domingo<br/>
                    <input type="checkbox" name="dias[]" value="1"> Segunda<br/>
                    <input type="checkbox" name="dias[]" value="2" > Terça<br/>
                    <input type="checkbox" name="dias[]" value="3"> Quarta<br/>
                    <input type="checkbox" name="dias[]" value="4"> Quinta<br/>
                    <input type="checkbox" name="dias[]" value="5"> Sexta<br/>
                    <input type="checkbox" name="dias[]" value="6"> Sabado<br/>
                    <br/><label>Selecione o intervalo de tempo:</label>
                  </div>
                  <div id="UmaVez">
                    <label>Selecione o horário:</label>
                  </div>
                </div>
                <div class="input-group" style="margin-bottom: 15px;">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <input name="data" type="text" class="form-control pull-right" id="reservationtime"/>
                </div>
                <div class="input-group">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-primary btn-flat" id="botaoEnviar" style="width: 100%;">Solicitar reserva</button>
                  </div><!-- /btn-group -->
                </div><!-- /input-group -->
              </form>
            </div>
          </div>
          <!-- FIM RESERVA -->
      <?php endif; ?>
        <!-- LEGENDA -->
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Legenda</h3>
          </div>
          <div class="box-body">
            <?php               
              if ($eqp = $db->prepare("SELECT a.tipoEq, b.cor FROM tbtipoeq a
								          inner join tbcor b on a.idCor = b.idCor
								          WHERE numEq > 0 ORDER BY idTipoEq ASC")){
                $eqp->execute();
                $eqp->bind_result($tipoEq, $cor);
              }
              while ($eqp->fetch()) {
                echo '<span class="label" style="background-color: '.$cor.';">'
                .$tipoEq.'</span><br>';
              }
              $eqp->close();
            ?>
          </div>
        </div>
        <!-- LEGENDA -->
      </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <?php include 'rodape.php' ?>
</div><!-- ./wrapper -->
  <?php include 'script.php' ?>
  <script type="text/javascript">

    dataTime = new Date();
    dia = dataTime.getDate();
    mes = dataTime.getMonth()+1;
    ano = dataTime.getFullYear();
    
    $('#box').find('.formulario').submit(function() {
          $("#botaoEnviar").attr("disabled","disabled");

          var titulo = $.trim($(this).find('#titulo').val());
          var motivo = $.trim($(this).find('#motivo').val());
          var eqp1 = $.trim($(this).find('#eqp1').val());         
          var data = $.trim($(this).find('#reservationtime').val());
          
          if(!(titulo.length != 0 && motivo.length != 0 && data.length != 0 && eqp1 != ""
                && data != ano+'/'+mes+'/'+dia+" 00:00"+" - "+ano+'/'+mes+'/'+dia+" 00:00")) {
            $("#botaoEnviar").attr("disabled",false);
            alert("Por favor, preencha todos os campos!");
            return false; 
          }
          var hora = data.split(" ");
          if (hora[1] == "0:00" || hora[4] == "23:59"){
            $("#botaoEnviar").attr("disabled",false);
            alert("Por favor, preencha o campo do horário!");
            return false;  
          }
      });

    $(function () {

      /* initialize the external events
       -----------------------------------------------------------------*/
      function ini_events(ele) {
        ele.each(function () {

          // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
          // it doesn't need to have a start or end
          var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
          };

          // store the Event Object in the DOM element so we can get to it later
          $(this).data('eventObject', eventObject);

          // make the event draggable using jQuery UI
          $(this).draggable({
            zIndex: 1070,
            revert: true, // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
          });

        });
      }
      ini_events($('#external-events div.external-event'));

      /* initialize the calendar
       -----------------------------------------------------------------*/
      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
              m = date.getMonth(),
              y = date.getFullYear();
      $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        buttonText: {
          today: 'hoje',
          month: 'mês',
          week: 'semana',
          day: 'dia'
        },
        events: [
          <?php  
            $i=0;
            while ($query->fetch()) {
              $i++;
              $comeco = strtotime($inicio);
              $final = strtotime($fim);
              $mesini = date('m', $comeco) - 1;
              $mesfim = date('m', $final) - 1;
              echo "{
                      title: '- ".Atalhos::Hora($fim)."h ".$tituloReEq."',
                      start: new Date(".date('Y, '.$mesini.', d, H, i', $comeco)."),
                      end: new Date(".date('Y, '.$mesfim.', d, H, i', $final)."),
                      backgroundColor: '".$cor."',
                      url: '".$tituloReEq." - ".$tipoEq." reservado das ".date('H:i', $comeco)." às "
                      .date('H:i', $final)." para ".$nomeUser."',
                      borderColor: '".$cor."'
                    }";
              if($i < $query->num_rows){
                echo ',';
              }
            }
            $query->close();
          ?>
        ],
        editable: false,
        droppable: false, // this allows things to be dropped onto the calendar !!!
        drop: function (date, allDay) { // this function is called when something is dropped

          // retrieve the dropped element's stored Event Object
          var originalEventObject = $(this).data('eventObject');

          // we need to copy it, so that multiple events don't have a reference to the same object
          var copiedEventObject = $.extend({}, originalEventObject);

          // assign it the date that was reported
          copiedEventObject.start = date;
          copiedEventObject.allDay = allDay;
          copiedEventObject.backgroundColor = $(this).css("background-color");
          copiedEventObject.borderColor = $(this).css("border-color");

         
          // is the "remove after drop" checkbox checked?
          if ($('#drop-remove').is(':checked')) {
            // if so, remove the element from the "Draggable Events" list
            $(this).remove();
          }

        }
      });
    });
    
    
    var counter = 1;
    var limit = <?php
                if ($query = $db->prepare("SELECT idTipoEq FROM tbtipoeq 
    								WHERE numEq > 0")){
                  $query->execute();
                  $query->store_result();
                  echo $query->num_rows();
                }
                $query->free_result();
                $query->close();
               ?>;
    function addInput(divName){
      if (counter >= limit)  {
        alert("Você atingiu o limite de " + counter + " Equipamentos diferentes!");
      }else{
        counter++;
        var newdiv = document.createElement('div');
        newdiv.innerHTML = '<div class="form-group">'
  				+'<label>Escolha um equipamento '+counter+':</label>'
  				+'<select name="eqp'+counter+'" class="form-control" onchange="numEq(\'numEq'+counter+'\', this.value)">'
  				+'<option value="">Selecione um Equipamento:</option>'
  				+'<?php
  					echo '<option value="">Nenhum</option>';
  					$query = $db->prepare("SELECT idTipoEq, tipoEq, numEq FROM tbtipoeq 
  								WHERE numEq > 0 ORDER BY idTipoEq ASC");
            $query->execute();
            $query->bind_result($idTipoEq, $tipoEq, $numEq);
  					while ($query->fetch()) {
  					  echo '<option value="'.$idTipoEq.'">'.$tipoEq.'</option>';
  					}
            $query->close();
            $db->close();
  				?>'
  				+'</select></div><div id="numEq'+counter+'"></div>';
        document.getElementById(divName).appendChild(newdiv);
      }
    }
         
    function numEq(id, str) {
      if(str == ""){
    	  document.getElementById(id).innerHTML = "";
      }else{
      	if (window.XMLHttpRequest) {
      		// code for IE7+, Firefox, Chrome, Opera, Safari
      		xmlhttp = new XMLHttpRequest();
      	}else{
      			// code for IE6, IE5
      			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      	}
        xmlhttp.onreadystatechange = function() {
      		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      			document.getElementById(id).innerHTML = xmlhttp.responseText;
      		}else{
      			result.innerHTML = "Erro: " + xmlreq.statusText;
      		}
    	};
    	xmlhttp.open("GET","numEq.php?idTipoEq="+str+"&name="+id,true);
    	xmlhttp.send();
      }
    }

    function id(el) {
      return document.getElementById(el);
    }
    function mostra(element){
      if (element.value){
        id(element.value).style.display = 'block';
      }
    }
    function esconde_todos($element, tagName) {
      var $elements = $element.getElementsByTagName(tagName),
      i = $elements.length;
      while(i--) {
        $elements[i].style.display = 'none';
      }
    }
    window.addEventListener('load', function() {
      var $temporeserva  = id('sel-temporeserva');
      esconde_todos(id('freq1'), 'div');
      mostra($temporeserva);
    });
    function admin(idDiv, v){
      esconde_todos(id(idDiv), 'div');
      mostra(v);
    }

  </script>
</body>
</html>
