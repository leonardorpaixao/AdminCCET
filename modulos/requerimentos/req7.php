        <?php
          include '../../includes/topo.php';
        ?>
        <title>AdminDcomp - Requerimento Geral</title> 
        </head>     
        <?php
          include '../../includes/barra.php';
          include '../../includes/menu.php';
          $_SESSION['irPara'] = '/requerimentos/inserir/7/';
          $link = '/requerimentos/inserir/7/';
          $acao = (isset($_GET['acao']))? $_GET['acao'] : 'inserir';     
        ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Requerimento Geral
            <small>Requerimentos</small>      
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
        <?php
          $prazo = Atalhos::verificarReq(7);
          // INICIO VERIFICA O PRAZO
          if($prazo[0]){

          // VERIFICA SE USUÁRIO ESTÁ LOGADO.
          if($_SESSION['logado']){       
            $id = (isset($_GET['id']))? $_GET['id'] : NULL;
            $db = Atalhos::getBanco();
            if ($query = $db->prepare("SELECT b.nomeUser, AES_DECRYPT(b.email,?), c.afiliacao, e.matricula
              FROM tbusuario b
              inner join tbafiliacao c on b.idAfiliacao = c.idAfiliacao
              inner join tbmatricula e on b.idUser = e.idUser
              WHERE b.idUser = ?")){
              $query->bind_param('si', $_SESSION['chave'], $_SESSION['id']);                 
              $query->execute();
              $query->bind_result($nomeUser, $email, $afiliacao, $matricula);
              $query->fetch();
              $query->close();
            }

            if ($query = $db->prepare("SELECT AES_DECRYPT(numTelefone,?) FROM tbtelefone WHERE idUser = ?")){
              $query->bind_param('si', $_SESSION['chave'], $_SESSION['id']);  
              $query->execute();
              $query->bind_result($numTelefone);
              $query->fetch();
              $query->close();
            }


          // INICIO DO FORMULÁRIO PARA INSERÇÃO DE USUÁRIO LOGADO
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
                <form role="form" action="post/" method="post" class="formulario">
                  <input type="hidden" id="numPost" name="numPost" value="20"><!-- Número correspodente ao post -->
                  <input type="hidden" id="tipoReq" name="tipoReq" value="7"><!-- Número correspodente ao tipo -->
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
                      <label>Venho requerer...</label>
                      <textarea name="requerimento" id="requerimento" class="form-control"></textarea>
                    </div>
              </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="botaoEnviar">Enviar requerimento</button>
                  </div>
                  </form>
          </div><!-- /.box -->
        <?php
          }// FINAL DO FORMULÁRIO PARA INSERÇÃO DE USUÁRIO LOGADO
          
          // INICIO DO FORMULÁRIO PARA EDIÇÃO DE USUÁRIO LOGADO
          elseif($acao == 'edit' && (!is_null($id))){
              if ($query = $db->prepare("SELECT a.conteudoReq, b.nomeUser,  AES_DECRYPT(b.email, ?), c.afiliacao, a.tipoReq, b.idUser, a.statusReq, e.matricula
                          FROM tbrequerimentos a
                          inner join tbusuario b on a.idUser = b.idUser 
                          inner join tbafiliacao c on b.idAfiliacao = c.idAfiliacao
                          inner join tbmatricula e on b.idUser = e.idUser
                          WHERE a.idReq = ?")){
                $query->bind_param('si', $_SESSION['chave'], $id);
                $query->execute(); 
                $query->bind_result($conteudoReq, $nomeUser, $email, $afiliacao, $tipoReq, $idUser, $statusReq, $matricula);
                $query->fetch();
                $query->close();
              }
              if ($query = $db->prepare("SELECT AES_DECRYPT(numTelefone,?) FROM tbtelefone WHERE idUser = ?")){
                $query->bind_param('si', $_SESSION['chave'], $idUser);
                $query->execute();
                $query->bind_result($numTelefone);
                $query->fetch();
                $query->close();
              }
              $conteudo = explode("/+", $conteudoReq);
              if(($_SESSION['nivel'] == '1' || $_SESSION['id'] == $idUser) && ($statusReq != 'Aprovado') && ($tipoReq == 7)){
        ?>
        <?php
          if(isset($_SESSION['avisoReqs'])):
        ?>
            <div class="callout callout-success">
              <h4>Requerimento enviado com sucesso!</h4>
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
                <form role="form" action="post/" method="post" class="formulario">
                  <input type="hidden" id="numPost" name="numPost" value="21"><!-- Número correspodente ao post -->
                  <input type="hidden" id="tipoReq" name="tipoReq" value="7"><!-- Número correspodente ao tipo -->
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
                      <label>Venho requerer...</label>
                      <textarea name="requerimento" id="requerimento" class="form-control"><?php echo $conteudoReq;?></textarea>
                    </div>
              </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="botaoEditar">Editar requerimento</button>
                  </div>
                  </form>
          </div><!-- /.box -->
        <?php
          } else echo Atalhos::aviso(1); //FIM DAS PERMISSÕES 
          } //FIM DO FORMULÁRIO PARA EDIÇÃO DE USUÁRIO LOGADO
          } else{ //Termina IF de permissão logado
            // INICIO DO FORMULÁRIO PARA INSERÇÃO SEM LOGAR
            if($acao == 'inserir'){
        ?>
        <?php
          if(isset($_SESSION['avisoReqs'])):
        ?>
            <div class="callout callout-success">
              <h4>Requerimento enviado com sucesso!</h4>
              <p>Acesse a <a href="/requerimentos/acompanhar">página de requerimentos</a> para acompanhar a sua solicitação.</p>
            </div>
        <?php
          unset($_SESSION['avisoReqs']);
          endif;
        ?>
          <!-- Default box -->
          <div class="box" id="forminsere2">
            <div class="box-header with-border">
                  <h3 class="box-title">Dados básicos</h3>
            </div>
                <form role="form" action="post2/" method="post" class="formulario" autocomplete="off">
                  <input type="hidden" id="numPost" name="numPost" value="4"><!-- Número correspodente ao post -->
                  <input type="hidden" id="tipoReq" name="tipoReq" value="7"><!-- Número correspodente ao tipo -->                
                  <div class="box-body">
                   <div class="form-group">
                      <label>Matrícula</label>
                      <input type="number" class="form-control" name="matricula" id="matricula">
                    </div>
                    <div class="form-group">
                      <button type="button" class="btn btn-default" onclick="testeMatricula();">Verificar matrícula</button>
                    </div>
                    <div id="matResp" name="matResp"></div>
                  </div><!-- /.box-body -->
            <div class="box-header with-border">
                <h3 class="box-title">Dados complementares</h3>
            </div>
              <div class="box-body">
                  <div class="form-group">
                      <label>Venho requerer...</label>
                      <textarea name="requerimento" id="requerimento" class="form-control"></textarea>
                    </div>
                </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Enviar requerimento</button>
                  </div>
                  </form>
          </div><!-- /.box -->
    <?php
      } // FIM DO FORMULÁRIO PARA INSERÇÃO SEM LOGAR
      } // FIM DO ELSE DO USUÁRIO LOGADO
      } else // FIM DENTRO DO PRAZO
        echo '<div class="callout callout-warning">
              <h4>Período inválido!</h4>
              <p>Atualmente esse formulário está indisponível por estar fora do período de solicitações.</p>
              <p>Próximo período: '.$prazo[1].' até '.$prazo[2].'</p>
            </div>';
    ?>
    </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <?php include '../../includes/rodape.php' ?>
    <?php include '../../includes/script.php' ?>
    <script>
    $('#forminsere').find('.formulario').submit(function() {
        $("#botaoEnviar").attr("disabled","disabled");
        var req = $.trim($(this).find('#requerimento').val());

        if(!(req.length != 0)) {
            $("#botaoEnviar").attr("disabled",false);
            alert("Por favor, preencha todos os campos!");
            return false;
        }
    });
    $('#formedita').find('.formulario').submit(function() {
        $("#botaoEditar").attr("disabled","disabled");
        var req = $.trim($(this).find('#requerimento').val());

        if(!(req.length != 0)) {
            $("#botaoEditar").attr("disabled",false);
            alert("Por favor, preencha todos os campos!");
            return false;
        }
    });

    $('#forminsere2').find('.formulario').submit(function() {
        testeMatricula();
        $("#botaoEnviar").attr("disabled","disabled");
        var req = $.trim($(this).find('#requerimento').val());

        if(!(req.length != 0)) {
            $("#botaoEnviar").attr("disabled",false);
            alert("Por favor, preencha todos os campos!");
            return false;
        }
    });

    function testeMatricula() {
      var matricula = document.getElementById("matricula").value;
      if(matricula == '' || matricula.length != 12){
        document.getElementById("matResp").innerHTML = "<div class='callout callout-danger'><p>Digite uma matrícula válida (12 dígitos).</p></div>";
      }else{
        if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function(){
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById("matResp").innerHTML = xmlhttp.responseText;
          }else{
            result.innerHTML = "Erro: " + xmlhttp.statusText;
          }
        };
        xmlhttp.open("GET","verifica_matricula/inserir/"+matricula+"/",true);
        xmlhttp.send();
      }
    }
    </script>
  </body>
</html>
