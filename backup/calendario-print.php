<?php 
  include 'topo.php';
  $_SESSION['irPara'] = '/inicio';
  $filtro = (isset($_GET['filtro']))? $_GET['filtro'] : NULL;
  $f = "";
  if(isset($filtro) AND $filtro != "Todos"){
    $f = "AND (h.idLab = ".$filtro.")";
  }
  $db = Atalhos::getBanco();
?>  
<div class="box box-primary"style="border: solid 1px #3C8DBC; padding: 1px;">
  <div id="calendar"></div>
</div>
<div class="box box-primary"style="border: solid 1px #3C8DBC;">
  <div class="box-header with-border">
    <h3 class="box-title">Legenda</h3>
  </div>
  <div class="box-body">
    <img src="painel_avisos/dcomp.jpg" style="float: right;width: 150px;height: 150px;">
    <?php
      if ($query = $db->prepare("SELECT a.nomeLab, b.cor, a.idLab FROM tbLaboratorio a 
        inner join tbCor b on a.idCor = b.idCor WHERE a.statusLab='Ativo'")){
        $query->execute();
        $query->bind_result($nomeLab,$cor,$idLab);
        while ($query->fetch()) {
          echo '<span class="label" style="background-color: '.$cor.';border-color: '.$cor.';">'
          .$nomeLab.' #'.$idLab.'</span><br>';
        }
        $query->close();
      }
    ?>
  </div>
</div>
           
    <?php include 'script.php' ?>
  <script type="text/javascript">
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
        //Random default events
        events: [
          <?php 
            if($query = $db->prepare("SELECT g.inicio, g.fim, d.nomeUser, f.cor, a.motivoReLab, a.tipoReLab, h.nomeLab, a.tituloReLab, b.idLab 
                  FROM tbReservaLab a
  								inner join tbControleDataLab b on b.idReLab = a.idReLab
  								inner join tbUsuario d on a.idUser = d.idUser
  								inner join tbLaboratorio h on h.idLab = b.idLab
  								inner join tbCor f on h.idCor = f.idCor
  								inner join tbData g on b.idData = g.idData
  								WHERE ((b.statusData = 'Aprovado') OR (b.statusData = 'Entregue')) {$f}")){
              $query->execute();
              $query->bind_result($inicio,$fim,$nomeUser,$cor,$motivoReLab,$tipoReLab,$nomeLab,$tituloReLab,$idLab);
              $query->store_result();
              $total = $query->num_rows;
              $i=0;
              while ($query->fetch()) {
                $i++;
                $comeco = strtotime($inicio);
                $final = strtotime($fim);
                $mesini = date('m', $comeco) - 1;
                $mesfim = date('m', $final) - 1;
                echo "{
                        title: '- ".Atalhos::Hora($fim)."h ".$idLab." - ".$tituloReLab."',
                        start: new Date(".date('Y, '.$mesini.', d, H, i', $comeco)."),
                        end: new Date(".date('Y, '.$mesfim.', d, H, i', $final)."),
                        backgroundColor: '".$cor."',
                        url: '".$nomeLab." reservado das ".date('H:i', $comeco)." às ".date('H:i', $final)
                          ." para ".$nomeUser."',
                        borderColor: '".$cor."'
                      }";
                if($i != $total)
                  echo ',';
              }
              $query->close();
              $db->close();
            }
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
    
</script>
</body>
</html>