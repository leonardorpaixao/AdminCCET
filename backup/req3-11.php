<?php
  include 'topo.php';
?>
<title>AdminDcomp - Requerimento de Abono de Faltas </title> 
  </head>     
<?php
  include 'barra.php';
  include 'menu.php';
  $_SESSION['irPara'] = '/requerimentos/inserir/3/';
  $link = '/requerimentos/inserir/3/';
  $acao = (isset($_GET['acao']))? $_GET['acao'] : 'inserir';     
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Abono de Faltas
            <small>Requerimentos</small>      
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
        <?php
        $prazo = Atalhos::verificarReq(3);
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
        <?php
          if(isset($_SESSION['erroPdf'])):
        ?>
            <div class="callout callout-danger">
              <p><?php echo $_SESSION['erroPdf']; ?></p>
            </div>
        <?php
          unset($_SESSION['erroPdf']);
          endif;
        ?>
        <div class="callout callout-warning">
              <h4>NOVO PROCEDIMENTO PARA REQUERIMENTOS DE <b>ABONO DE FALTAS</b></h4>
              <p>A partir de 10/11/2016, novos requerimentos para Abono de Faltas seguirá um novo procedimento:</p>
              <p>
                1 - O aluno preencherá o formulário abaixo.<br>
                2 - O professor selecionado no formulário receberá DIRETAMENTE no AdminDCOMP a sua solicitação.<br>
                3 - O docente será responsável por visualizar e aprovar/negar a mesma.<br>
                4 - Caso o seu requerimento demore para ser respondido, procure o docente selecionado e solicite que ele verifique o requerimento pelo AdminDComp.</p>
              <p>OBS: A secretaria terá acesso SOMENTE aos requerimentos destinados aos professores que NÃO estiverem cadastrados no AdminDCOMP (Docentes voluntários ou recém admitidos).</p>
          </div>
          <!-- Default box -->
          <div class="box" id="forminsere">
            <div class="box-header with-border">
                  <h3 class="box-title">Dados básicos</h3>
            </div>
                <form role="form" action="post.php" method="post" class="formulario" autocomplete="off" enctype="multipart/form-data">
                  <input type="hidden" id="numPost" name="numPost" value="20"><!-- Número correspodente ao post -->
                  <input type="hidden" id="tipoReq" name="tipoReq" value="3"><!-- Número correspodente ao tipo -->                
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
                  <label>Período de falta:</label>
                  <div class="form-group">
                      <label>De</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input name="datacomeco" id="datacomeco" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                      </div>
                  </div>
                  <div class="form-group">
                      <label>Até</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input name="datafim" id="datafim" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                      </div>
                  </div>
                    <div class="form-group">
                    <label>Disciplina</label>
                    <select class="form-control select2" name="disciplina" id="disciplina">
                      <option selected disabled>Selecione uma disciplina</option>
                      <?php
                        $db = Atalhos::getBanco();
                        if($query = $db->prepare("SELECT idDisc, nome, codigo, carga FROM tbdisciplinas WHERE status = 'Ativo'")){
                              $query->execute();
                              $query->bind_result($idDisc, $nome, $codigo, $carga);
                        }
                        while($query->fetch()){
                          echo '<option value="'.$idDisc.'">'.$codigo.' - '.$nome.' ('.$carga.')</option>';
                            }        
                        $query->close();
                      ?>
                    </select>
                  </div>
                    <div class="form-group">
                      <label>Turma</label>
                      <select class="form-control" name="turma" id="turma">
                      <option selected disabled>Selecione a turma desejada</option>
                      <?php
                        for($i=1; $i <= 15; $i++)
                          echo '<option value="'.$i.'">Turma '.$i.'</option>';
                      ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Professor</label>
                      <select class="form-control select2" name="professor" id="professor">
                      <option selected disabled>Selecione um professor</option>
                      <option value="0">Outro professor (Não aparece na lista)</option>
                      <?php
                        $db = Atalhos::getBanco();
                        if($query = $db->prepare("SELECT idUser, nomeUser FROM tbusuario WHERE statusUser = 'Ativo' AND nivel = 3")){
                              $query->execute();
                              $query->bind_result($idUser, $nomeUser);
                        }
                        while($query->fetch()){
                          echo '<option value="'.$idUser.'">'.$nomeUser.'</option>';
                            }        
                        $query->close();
                      ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Se o nome do professor não aparecer na lista acima, selecine a opção "Outro professor" e escreva abaixo o nome do professor:</label>
                      <input type="text" class="form-control" name="professor2" id="professor2">
                    </div>
                    <div class="form-group">
                      <label>Anexe o atestado (formato do arquivo: PDF)</label>
                      <input type="file" name="pdf" id="pdf">
                    </div>
              </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Enviar requerimento</button>
                  </div>
                  </form>
          </div><!-- /.box -->
        <?php
          }// FINAL DO FORMULÁRIO PARA INSERÇÃO DE USUÁRIO LOGADO
          
          // INICIO DO FORMULÁRIO PARA EDIÇÃO DE USUÁRIO LOGADO
          elseif($acao == 'edit' && (!is_null($id))){
              if ($query = $db->prepare("SELECT a.conteudoReq, b.nomeUser, b.email, c.afiliacao, a.tipoReq, b.idUser, a.statusReq, e.matricula
                          FROM tbrequerimentos a
                          inner join tbusuario b on a.idUser = b.idUser 
                          inner join tbafiliacao c on b.idAfiliacao = c.idAfiliacao
                          inner join tbmatricula e on b.idUser = e.idUser
                          WHERE a.idReq = ?")){
                $query->bind_param('i', $id);
                $query->execute(); 
                $query->bind_result($conteudoReq, $nomeUser, $email, $afiliacao, $tipoReq, $idUser, $statusReq, $matricula);
                $query->fetch();
                $query->close();
              }
              if ($query = $db->prepare("SELECT numTelefone FROM tbtelefone WHERE idUser = ?")){
                $query->bind_param('i', $_SESSION['id']);
                $query->execute();
                $query->bind_result($numTelefone);
                $query->fetch();
                $query->close();
              }

              $conteudo = explode("/+", $conteudoReq);
              if(($_SESSION['nivel'] == '1' || $_SESSION['id'] == $idUser) && ($statusReq != 'Aprovado') && ($tipoReq == 3)){
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
                <form role="form" action="post.php" method="post" class="formulario" autocomplete="off" enctype="multipart/form-data">
                  <input type="hidden" id="numPost" name="numPost" value="21"><!-- Número correspodente ao post -->
                  <input type="hidden" id="tipoReq" name="tipoReq" value="3"><!-- Número correspodente ao tipo -->
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
                  <label>Período de falta:</label>
                  <div class="form-group">
                      <label>De</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input name="datacomeco" id="datacomeco" value="<?php echo $conteudo[0]; ?>" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                      </div>
                  </div>
                  <div class="form-group">
                      <label>Até</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input name="datafim" id="datafim" value="<?php echo $conteudo[1]; ?>" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                      </div>
                  </div>

                    <div class="form-group">
                    <label>Disciplina</label>
                    <select class="form-control select2" name="disciplina" id="disciplina">
                      <option selected disabled>Selecione uma disciplina</option>
                      <?php
                        $db = Atalhos::getBanco();
                        if($query = $db->prepare("SELECT idDisc, nome, codigo, carga FROM tbdisciplinas WHERE status = 'Ativo'")){
                              $query->execute();
                              $query->bind_result($idDisc, $nome, $codigo, $carga);
                        }
                        while($query->fetch()){
                      ?>
                        <option value="<?php echo $idDisc;?>" <?php if($conteudo[2] == $idDisc) echo 'selected'; ?>><?php echo $codigo.' - '.$nome.' ('.$carga.')';?></option>
                      <?php
                            }        
                        $query->close();
                      ?>
                    </select>
                  </div>
                    <div class="form-group">
                      <label>Turma</label>
                      <select class="form-control" name="turma" id="turma">
                      <option selected disabled>Selecione a turma desejada</option>
                      <?php
                        for($i=1; $i <= 15; $i++){
                      ?>
                          <option value="<?php echo $i;?>" <?php if($conteudo[3] == $i) echo 'selected'; ?>><?php echo 'Turma '.$i;?></option>
                      <?php  
                        }
                      ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Professor</label>
                      <select class="form-control select2" name="professor" id="professor">
                      <option selected disabled>Selecione um professor</option>
                      <option value="0" <?php if($conteudo[4] == 0) echo 'selected'; ?>>Outro professor (Não aparece na lista)</option>
                      <?php
                        $db = Atalhos::getBanco();
                        if($query = $db->prepare("SELECT idUser, nomeUser FROM tbusuario WHERE statusUser = 'Ativo' AND nivel = 3")){
                              $query->execute();
                              $query->bind_result($idUser, $nomeUser);
                        }
                        while($query->fetch()){
                      ?>
                        <option value="<?php echo $idUser;?>" <?php if($conteudo[4] == $idUser) echo 'selected'; ?>><?php echo $nomeUser;?></option>
                      <?php
                            }        
                        $query->close();
                      ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Se o nome do professor não aparecer na lista acima, selecine a opção "Outro professor" e escreva abaixo o nome do professor:</label>
                      <input type="text" class="form-control" name="professor2" id="professor2" value="<?php echo $conteudo[5]; ?>">
                    </div>
                    <div class="form-group">
                      <label>Anexe o atestado (formato do arquivo: PDF)</label>
                      <p><a href="getPdf.php?id=<?php echo $id;?>">Visualizar</a></p>
                    </div>
              </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Editar requerimento</button>
                  </div>
                  </form>
          </div><!-- /.box -->
        <?php
          } else echo Atalhos::aviso(1); //FIM DAS PERMISSÕES 
          } //FIM DO FORMULÁRIO PARA EDIÇÃO DE USUÁRIO LOGADO
          } else{ //Termina IF de permissão logado
      ?>
        <?php
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
                <form role="form" action="post2.php" method="post" class="formulario" autocomplete="off" enctype="multipart/form-data">
                  <input type="hidden" id="numPost" name="numPost" value="4"><!-- Número correspodente ao post -->
                  <input type="hidden" id="tipoReq" name="tipoReq" value="3"><!-- Número correspodente ao tipo -->                
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
                  <label>Período de falta:</label>
                  <div class="form-group">
                      <label>De</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input name="datacomeco" id="datacomeco" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                      </div>
                  </div>
                  <div class="form-group">
                      <label>Até</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input name="datafim" id="datafim" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                      </div>
                  </div>
                  <div class="form-group">
                    <label>Disciplina</label>
                    <select class="form-control select2" name="disciplina" id="disciplina">
                      <option selected disabled>Selecione uma disciplina</option>
                      <?php
                        $db = Atalhos::getBanco();
                        if($query = $db->prepare("SELECT idDisc, nome, codigo, carga FROM tbdisciplinas WHERE status = 'Ativo'")){
                              $query->execute();
                              $query->bind_result($idDisc, $nome, $codigo, $carga);
                        }
                        while($query->fetch()){
                          echo '<option value="'.$idDisc.'">'.$codigo.' - '.$nome.' ('.$carga.')</option>';
                            }        
                        $query->close();
                      ?>
                    </select>
                  </div>
                    <div class="form-group">
                      <label>Turma</label>
                      <select class="form-control" name="turma" id="turma">
                      <option selected disabled>Selecione a turma desejada</option>
                      <?php
                        for($i=1; $i <= 15; $i++)
                          echo '<option value="'.$i.'">Turma '.$i.'</option>';
                      ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Professor</label>
                      <select class="form-control select2" name="professor" id="professor">
                      <option selected disabled>Selecione um professor</option>
                      <option value="0">Outro professor (Não aparece na lista)</option>
                      <?php
                        $db = Atalhos::getBanco();
                        if($query = $db->prepare("SELECT idUser, nomeUser FROM tbusuario WHERE statusUser = 'Ativo' AND nivel = 3")){
                              $query->execute();
                              $query->bind_result($idUser, $nomeUser);
                        }
                        while($query->fetch()){
                          echo '<option value="'.$idUser.'">'.$nomeUser.'</option>';
                            }        
                        $query->close();
                      ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Se o nome do professor não aparecer na lista acima, selecine a opção "Outro professor" e escreva abaixo o nome do professor:</label>
                      <input type="text" class="form-control" name="professor2" id="professor2">
                    </div>
                    <div class="form-group">
                      <label>Anexe o atestado (formato do arquivo: PDF)</label>
                      <input type="file" name="pdf" id="pdf" required>
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
    <?php include 'rodape.php' ?>
    <?php include 'script.php' ?>
    <script>
      $('#forminsere').find('.formulario').submit(function() {
        var datacomeco = $.trim($(this).find('#datacomeco').val());
        var datafim = $.trim($(this).find('#datafim').val());
        var disciplina = $.trim($(this).find('#disciplina').val());
        var turma = $.trim($(this).find('#turma').val());
        var professor = $.trim($(this).find('#professor').val());

        if(!(datacomeco.length != 0 && datafim.length != 0 && disciplina != "" 
          && professor.length != 0 && turma != "")) {
            alert("Por favor, preencha todos os campos!");
            return false;
        }
      });
      $('#formedita').find('.formulario').submit(function() {
        var datacomeco = $.trim($(this).find('#datacomeco').val());
        var datafim = $.trim($(this).find('#datafim').val());
        var disciplina = $.trim($(this).find('#disciplina').val());
        var turma = $.trim($(this).find('#turma').val());
        var professor = $.trim($(this).find('#professor').val());

        if(!(datacomeco.length != 0 && datafim.length != 0 && ddisciplina != "" 
          && professor.length != 0 && turma != "")) {
            alert("Por favor, preencha todos os campos!");
            return false;
        }
      });

      $('#forminsere2').find('.formulario').submit(function() {
        testeMatricula();
        $("#botaoEnviar").attr("disabled","disabled");
        var matricula = $.trim($(this).find('#matricula').val());
        var nome = $.trim($(this).find('#nome').val());
        var curso = $.trim($(this).find('#curso').val());
        var telefone = $.trim($(this).find('#telefone').val());
        var email = $.trim($(this).find('#email').val());
        var email2 = $.trim($(this).find('#email2').val());
        var veriMat = $.trim($(this).find('#veriMat').val());
        var professor = $.trim($(this).find('#professor').val());
        var turma = $.trim($(this).find('#turma').val());
        var disciplina = $.trim($(this).find('#disciplina').val());
        var datacomeco = $.trim($(this).find('#datacomeco').val());
        var datafim = $.trim($(this).find('#datafim').val());

        if(!(professor.length != 0 && turma != "" && disciplina != "" && datacomeco.length != 0 && datafim.length != 0 && (veriMat == 1 || (veriMat == 2 && nome.length != 0 && curso.length != 0 && telefone.length != 0 && email.length != 0 && email2.length != 0 && email == email2)))) {
            $("#botaoEnviar").attr("disabled",false);
            alert("Por favor, preencha corratamente todos os campos!");
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
        xmlhttp.open("GET","verifica_matricula.php?tipo=inserir&matricula="+matricula,true);
        xmlhttp.send();
      }
    }
      </script>
  </body>
</html>
