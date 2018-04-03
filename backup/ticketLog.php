<?php 
  include 'topo.php';
  $dono = (isset($_GET['user']))? $_GET['user'] : NULL;
  $idTicket = (isset($_GET['id']))? $_GET['id'] : NULL;
?>
<title>AdminDcomp - Histórico</title>
</head>
<?php

  $db1 = Atalhos::getBanco();
  
  if($query = $db1->prepare("SELECT idUser FROM tbTicket WHERE idTicket = ?")){
  	$query->bind_param("i", $idTicket);
  	$query->execute();
  	$query->bind_result($idUser1);
  	$query->fetch();
  	$query->close();
  }

  if(!$_SESSION['logado'] || ($_SESSION['nivel'] > 1 && $_SESSION['id'] != $idUser1)){
    header('Location: /inicio');
  } 

  include 'barra.php';
  include 'menu.php' ;
  $_SESSION['irPara'] = '/inicio';
  $db = Atalhos::getBanco();

  if($query = $db->prepare("SELECT a.idUser, a.mensagem, a.dataLog, b.nomeUser FROM tbLog a inner join tbUsuario b ON a.idUser = b.idUser WHERE a.idTicket = ? ORDER BY a.idLog ASC")){
    $query->bind_param("i", $idTicket);
    $query->execute();
    $query->bind_result($idUser, $mensagem, $dataLog, $nome);
    $query->store_result();
    $total = $query->num_rows;
  }
  $dataAnt = null;
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Tickets
          <small>Histórico</small>
        </h1>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="box-body">
          <section class="content-header">
          <!-- row -->
          <?php 
            if($total > 0):
              $auxDb = Atalhos::getBanco();
              if($aux = $auxDb->prepare("SELECT idAssunto, tituloTicket, statusTicket, avalicao FROM tbTicket WHERE idTicket = ?")){
                $aux->bind_param('i', $idTicket);
                $aux->execute();
                $aux->bind_result($idAssunto, $tituloTicket, $statusTicket, $avalicao);
                $aux->fetch();
                $aux->close();
              }
              $auxDb->close();
              switch($statusTicket){
                case 'Concluido':
                  $status = '<span class="label label-success">CONCLUÍDO</span>';
                  break;
                case 'Em Analise':
                  $status = '<span class="label label-warning">EM ANÁLISE</span>';
                  break;
                case 'Respondido':
                  $status = '<span class="label label-primary">RESPONDIDO</span>';
                  break;
              }
              switch($idAssunto){
                case 0:
                  $assunto = 'Laboratórios';
                  break;
                case 1:
                  $assunto = 'Equipamentos';
                  break;
                case 2:
                  $assunto = 'Reclamações';
                  break;
                case 3:
                  $assunto = 'Sugestões';
                  break;
                case 4:
                  $assunto = 'Outros';
                  break;
                case 5:
                  $assunto = 'E-mail Dcomp';
                  break;
                case 6:
                  $assunto = 'Criar E-mail';
                  break;
              }
              echo '<div class="box" style="margin-bottom: 0px;">

                      <div class="box-body">
                        <b>Titulo:</b> '.$tituloTicket.'</br>
                        <b>Assunto:</b> '.$assunto.'</br>
                        <b>Status:</b> '.$status;
              if($statusTicket == 'Concluido'){
                echo '</br><b>Nota:</b> '.$avalicao;
              }
              echo '</div>
                      <div class="box-footer">
                        <a href="javascript:history.go(-1)"><span class="btn-sm btn-primary">Voltar</span></a>
                      </div>                    </div>
                  </section>';
              echo ' <section class="content">
                      <div class="row">
                      <div class="col-md-12">
                        <!-- The time line -->
                        <ul class="timeline">
                          <!-- timeline time label -->';
              while($query->fetch()){
                $dataLog = strtotime($dataLog);
                $data = date("d/m/Y", $dataLog);
                if($data != $dataAnt){
                  $dataAnt = $data;
                  echo '<li class="time-label"><span class="bg-red">'.$data.'</span></li>';
                }
                echo '<li>
                    <i class="fa fa-user bg-aqua"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> '.date("H:i:s", $dataLog).'</span>';
                if($_SESSION['nivel'] < 2){
                  echo '<h3 class="timeline-header"><a href="/perfil/'.$idUser.'/">'.$nome.'</a>';
                }else{
                  echo '<h3 class="timeline-header"><a>'.$nome.'</a>';
                }
                if($idUser == $dono){
                  echo "<small> Criador</small>";
                }else{
                  echo "<small> Suporte</small>";
                }
                echo '</h3>
                      <div class="timeline-body">
                        '.$mensagem.'
                      </div> 
                    </div>
                  </li>';
              }
              echo "</div><!-- /.col -->
                    </div><!-- /.row -->
                    </section>";
              $botao = 'Sem ação possivel.';
              if($dono == $_SESSION['id']){
                if($statusTicket == 'Respondido'){
                  if($idAssunto == 6){
                    $botao = '<button class="btn btn-success" data-toggle="modal" data-target="#simples" data-solict-idticket="'.$idTicket.'" data-solict-tipo="4" data-solict-frase="Concluir">Concluir</button>';
                  }else{
                    $botao = '<button class="btn btn-success" data-toggle="modal" data-target="#simples" data-solict-idticket="'.$idTicket.'" data-solict-tipo="3" data-solict-frase="Concluir">Concluir</button>';
                  }
                  $botao .= '<button class="btn btn-danger" onclick="setVisibility(\'respostaticket\', \'block\');">Reabrir</button>';
                }
              }else{
                if($statusTicket == 'Em Analise'){
                  $botao = '<button class="btn btn-primary" onclick="setVisibility(\'respostaticket\', \'block\');">Responder</button>';
                  if($idAssunto == 6){
                    $botao .= ' <button class="btn btn-success" data-toggle="modal" data-target="#resposta" data-solict-idticket="'.$idTicket.'" data-solict-tipo="1" >Resposta Automática</button>';
                  }
                }
              }
              $query->close();
              $db->close();
          ?>
          <section class="content-footer">
            <div class="box" style="margin-bottom: 0px;">
              <div class="box-header">
                <h3 class="box-title">Ações</h3>
              </div>
              <div class="box-body pad">
                <?php echo $botao; ?>
              </div>
            </div>
          </section>
          <?php else: ?>
            <div class="box" style="margin-bottom: 0px;">
              <div class="box-body">
                <div class="callout callout-warning">
                  <h4>Lista Vazia!</h4>
                  <p>Ticket não existe.</p>
                </div>
              </div>
            </div>
          <?php 
            endif; 
            if(isset($statusTicket) && $statusTicket == 'Em Analise'){
              $acao = 1;
            }else{
              $acao = 2;
            }
          ?>
        </div>
      </section><!-- /.content -->
      <section class="content" id="respostaticket" style="display: none;">
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Mensagem</h3>
            </div><!-- /.box-header -->
            <div class="box-body pad">
              <form role="form" action="post.php" method="post">
                <input type="hidden" name="numPost" value="44"><!-- Número correspodente ao post -->
                <input type="hidden" name="idticket" <?php echo "value='".$idTicket."'"; ?>/>
                <input type="hidden" name="idUserTicket" <?php echo "value='".$dono."'"; ?>/>
                <input type="hidden" name="acao" <?php echo "value='".$acao."'"; ?>/>
                <textarea class="textarea" name="mensagem" placeholder="Digite a resposta aqui" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                <button class="btn btn-success" onclick="formObject.submit()">Enviar</button>
              </form>
            </div>
          </div>
      </section>
    <div class="modal fade" id="simples" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="exampleModalLabel"></h4>
          </div>
          <form role="form" action="post.php" method="post" name="formulario1" id="formulario1">
          <div class="modal-body">
            <input type="hidden" id="numPost" name="numPost" value="44"><!-- Número correspodente ao post -->
            <input type="hidden" name="idticket" id="idticket"/>
            <input type="hidden" name="acao" id="acao"/>
            <div class="form-group">
              <label>Classifique seu atendimento:</label>
              <div class="col-md-9">
                <select name="rating" class="form-control">
                  <option value="">Escolha</option>
                  <option value="1">1 - Muito Insatisfeito</option>
                  <option value="2">2 - Insatisfeito</option>
                  <option value="3">3 - Neutro</option>
                  <option value="4">4 - Satisfeito</option>
                  <option value="5">5 - Muito Satisfeito</option>
                </select>
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
    <div class="modal fade" id="resposta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="exampleModalLabel"></h4>
          </div>
          <form role="form" action="post.php" method="post" name="formulario1" id="formulario1">
          <div class="modal-body">
            <input type="hidden" id="numPost" name="numPost" value="44"><!-- Número correspodente ao post -->
            <input type="hidden" name="idticket2" id="idticket2"/>
            <input type="hidden" name="acao2" id="acao2"/>
            <input type="hidden" name="idUserTicket" <?php echo "value='".$dono."'"; ?>/>
            <div class="form-group">
              <input type="hidden" name="mensagem" id="mensagem" <?php echo 'value="'.mesagemAuto.'"';?>/>
              <?php echo mesagemAuto;?>
            </div>
            <div class="form-group">
              <label>Cole aqui a senha temporária:</label>
              <input type="text" name="senhatemp" id="asenhatemp"/>
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
  </div>
  <?php include 'rodape.php' ?>
</div><!-- ./wrapper -->

  <?php include 'script.php' ?>
<script>
  function setVisibility(id, visibility) {
    document.getElementById(id).style.display = visibility;
  }

  $('#simples').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var tipo = button.data('solict-tipo')
    var frase = button.data('solict-frase')
    var id = button.data('solict-idticket')
    var modal = $(this)
    modal.find('.modal-title').text(frase + " ticket")
    $('#idticket').val(id)
    $('#acao').val(tipo)
  })
  $('#resposta').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var tipo = button.data('solict-tipo')
    var id = button.data('solict-idticket')
    var modal = $(this)
    modal.find('.modal-title').text("Deseja enviar esta resposta abaixo?")
    $('#idticket2').val(id)
    $('#acao2').val(tipo)
  })
</script>
</body>
</html>
