<?php
  include 'topo.php';
?>
<title>AdminDcomp - Requerimento de Atividades Complementares</title> 
</head>     
<?php
  include 'barra.php';
  include 'menu.php';
  if($_SESSION['logado']){
    $acao = (isset($_GET['acao']))? $_GET['acao'] : 'inserir';          
    $id = (isset($_GET['id']))? $_GET['id'] : NULL;

    $db = Atalhos::getBanco();
    
    if ($query = $db->prepare("SELECT b.nomeUser, AES_DECRYPT(b.email, ?), c.afiliacao, e.matricula
      FROM tbUsuario b
      inner join tbAfiliacao c on b.idAfiliacao = c.idAfiliacao
      inner join tbMatricula e on b.idUser = e.idUser
      WHERE b.idUser = ?")){
      $query->bind_param('si', $_SESSION['chave'], $_SESSION['id']);             
      $query->execute();
      $query->bind_result($nomeUser, $email, $afiliacao, $matricula);
      $query->fetch();
      $query->close();
    }

    if ($query = $db->prepare("SELECT AES_DECRYPT(numTelefone, ?) FROM tbTelefone WHERE idUser = ?")){
      $query->bind_param('si', $_SESSION['chave'], $_SESSION['id']);
      $query->execute();
      $query->bind_result($numTelefone);
      $query->fetch();
      $query->close();
    }
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Atividades Complementares (Aproveitamento de Créditos)     
  </h1> 
</section>
<!-- Main content -->
<section class="content">
<?php
  $prazo = Atalhos::verificarReq(1);
  // INICIO VERIFICA O PRAZO
  if($prazo[0]){
  // FORMULÁRIO PARA INSERÇÃO
  if($acao == 'inserir'){
?>

<?php
  if(isset($_SESSION['avisoReqs'])):
?>
    <div class="callout callout-success">
      <h4>Requerimento enviado com sucesso!</h4>
      <p>Acesse a <a href="/requerimentos/meus">página de requerimentos</a> para visualizar, editar e acompanhar a sua solicitação.</p>
    </div>
<?php
  unset($_SESSION['avisoReqs']);
  endif;
?>
  <!-- Default box -->
  <div class="box" id="forminsere">
    <div class="box-header with-border">
          <h3 class="box-title">Dados básicos</h3>
    </div>
        <form role="form" action="post.php" method="post" class="formulario">
          <input type="hidden" id="numPost" name="numPost" value="20"><!-- Número correspodente ao post -->
          <input type="hidden" id="tipoReq" name="tipoReq" value="1"><!-- Número correspodente ao tipo -->
          <div class="box-body">
            <div class="form-group">
              <label>Nome</label>
              <input type="text" class="form-control" name="nome" value="<?php echo $nomeUser; ?>" disabled>
            </div>
            <div class="form-group">
              <label>Matrícula</label>
              <input type="text" class="form-control" name="matricula" value="<?php echo $matricula; ?>" disabled>
            </div>
            <div class="form-group">
              <label>Curso</label>
              <input type="text" class="form-control" name="curso" value="<?php echo $afiliacao; ?>" disabled>
            </div>
            <div class="form-group">
              <label>Telefone</label>
              <input type="text" class="form-control" name="telefone" value="<?php echo $numTelefone; ?>" disabled>
            </div>
            <div class="form-group">
              <label>E-mail</label>
              <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" disabled>
            </div>
          </div><!-- /.box-body -->
    <div class="box-header with-border">
        <h3 class="box-title">Dados complementares</h3>
    </div>
      <div class="box-body">
          <div class="form-group">
              <label>Programa de estudo ou projeto ao qual está vinculada a atividade:</label>
              <input type="text" class="form-control" name="programa" id="programa">
          </div>
          <div class="form-group">
              <label>Início</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="datainicio" id="datainicio" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
              </div>
          </div>
          <div class="form-group">
              <label>Fim</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input name="datafim" id="datafim" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
              </div>
          </div>     
      </div>
          <div class="box-footer">
            <button id="botaoEnviar" type="submit" class="btn btn-primary">Enviar requerimento</button>
          </div>
          </form>
      <?php
        }
        //FORMULÁRIO PARA EDIÇÃO
        elseif($acao == 'edit' && (!is_null($id))){
            
            if ($query = $db->prepare("SELECT a.conteudoReq, a.idUser, b.nomeUser, AES_DECRYPT(b.email, ?), c.afiliacao, a.tipoReq, b.idUser, a.statusReq, e.matricula
                        FROM tbRequerimentos a
                        inner join tbUsuario b on a.idUser = b.idUser 
                        inner join tbAfiliacao c on b.idAfiliacao = c.idAfiliacao
                        inner join tbMatricula e on b.idUser = e.idUser
                        WHERE a.idReq = ?")){
              $query->bind_param('si', $_SESSION['chave'], $id);
              $query->execute(); 
              $query->bind_result($conteudoReq, $idUser, $nomeUser, $email, $afiliacao, $tipoReq, $idUser, $statusReq, $matricula);
              $query->fetch();
              $query->close();
            }
            if ($query = $db->prepare("SELECT AES_DECRYPT(numTelefone, ?) FROM tbTelefone WHERE idUser = ?")){
              $query->bind_param('si', $_SESSION['chave'], $idUser);
              $query->execute();
              $query->bind_result($numTelefone);
              $query->fetch();
              $query->close();
            }
            $conteudo = explode("/+", $conteudoReq);
            if(($_SESSION['nivel'] == '1' || $_SESSION['id'] == $idUser) && ($statusReq != 'A1provado') && ($tipoReq == 1)){
      ?>
      <?php
        if(isset($_SESSION['avisoReqs'])):
      ?>
          <div class="callout callout-success">
            <h4>Requerimento editado com sucesso!</h4>
            <p>Acesse a <a href="requerimentos/meus">página de requerimentos</a> para visualizar, editar e acompanhar a sua solicitação.</p>
          </div>
      <?php
        unset($_SESSION['avisoReqs']);
        endif;
      ?>
        <!-- Default box -->
        <div class="box" id="formedita">
          <div class="box-header with-border">
                <h3 class="box-title">Dados básicos</h3>
          </div>
              <form role="form" action="post.php" method="post" class="formulario">
                <input type="hidden" id="numPost" name="numPost" value="21"><!-- Número correspodente ao post -->
                <input type="hidden" id="tipoReq" name="tipoReq" value="1"><!-- Número correspodente ao tipo -->
                <input type="hidden" id="idReq" name="idReq" value="<?php echo $id; ?>"><!-- Número correspodente ao ID-->
                <div class="box-body">
                  <div class="form-group">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="nome" value="<?php echo $nomeUser; ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label>Matrícula</label>
                    <input type="text" class="form-control" name="matricula" value="<?php echo $matricula; ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label>Curso</label>
                    <input type="text" class="form-control" name="curso" value="<?php echo $afiliacao; ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label>Telefone</label>
                    <input type="text" class="form-control" name="telefone" value="<?php echo $numTelefone; ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" disabled>
                  </div>
                </div><!-- /.box-body -->
          <div class="box-header with-border">
              <h3 class="box-title">Dados complementares</h3>
          </div>
            <div class="box-body">
                <div class="form-group">
                    <label>Programa de estudo ou projeto ao qual está vinculada a atividade:</label>
                    <input type="text" class="form-control" name="programa" id="programa" value="<?php echo $conteudo[0]; ?>">
                </div>
                <div class="form-group">
                    <label>Início</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input name="datainicio" id="datainicio" value="<?php echo $conteudo[1]; ?>" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                    </div>
                </div>
                <div class="form-group">
                    <label>Fim</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input name="datafim" id="datafim" type="text" value="<?php echo $conteudo[2]; ?>" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                    </div>
                </div>
            </div>
                <div class="box-footer">
                  <button id="botaoEditar" type="submit" class="btn btn-primary">Editar requerimento</button>
                </div>
                </form>
        </div><!-- /.box -->

      
      <?php
        } else echo Atalhos::aviso(1); //FIM DAS PERMISSÕES 
        } //FIM DO FORMULÁRIO PARA EDIÇÃO DE USUÁRIO LOGADO
        } else // FIM DENTRO DO PRAZO
          echo '<div class="callout callout-warning">
                <h4>Período inválido!</h4>
                <p>Atualmente esse formulário está indisponível por estar fora do período de solicitações.</p>
                <p>Próximo período: '.$prazo[1].' até '.$prazo[2].'</p>
              </div>';
      } // FIM DO ELSE DO USUÁRIO LOGADO
    ?>
  </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <?php include 'rodape.php' ?>
  <?php include 'script.php' ?>
  <script>
  $('#forminsere').find('.formulario').submit(function() {
      $("#botaoEnviar").attr("disabled","disabled");
      var programa = $.trim($(this).find('#programa').val());
      var datainicio = $.trim($(this).find('#datainicio').val());
      var datafim = $.trim($(this).find('#datafim').val());

      if(!(programa.length != 0 && datainicio.length != 0 && datafim.length != 0)) {
          alert("Por favor, preencha todos os campos!");
          $("#botaoEnviar").attr("disabled",false);
          return false;
      }
  });
  $('#formedita').find('.formulario').submit(function() {
      $("#botaoEditar").attr("disabled","disabled");
      var programa = $.trim($(this).find('#programa').val());
      var datainicio = $.trim($(this).find('#datainicio').val());
      var datafim = $.trim($(this).find('#datafim').val());

      if(!(programa.length != 0 && datainicio.length != 0 && datafim.length != 0)) {
          alert("Por favor, preencha todos os campos!");
          $("#botaoEditar").attr("disabled",false);
          return false;
      }
  });
  </script>
  </body>
</html>
