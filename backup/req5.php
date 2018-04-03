<?php
  include 'topo.php';
?>
<title>AdminDcomp - Requerimento de Inclusão em Disciplina </title> 
</head>     
<?php
  include 'barra.php';
  include 'menu.php';
  $_SESSION['irPara'] = '/requerimentos/inserir/5/';
  $link = '/requerimentos/inserir/5/';
  $acao = (isset($_GET['acao']))? $_GET['acao'] : 'inserir';     
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Inclusão em Disciplina
            <small>Requerimentos</small>   
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
        <?php
        $prazo = Atalhos::verificarReq(5);
        // INICIO VERIFICA O PRAZO
        if($prazo[0]){

        // VERIFICA SE USUÁRIO ESTÁ LOGADO.
        if($_SESSION['logado']){
            $id = (isset($_GET['id']))? $_GET['id'] : NULL;
            $db = Atalhos::getBanco();
            if ($query = $db->prepare("SELECT b.nomeUser, AES_DECRYPT(b.email,?), c.afiliacao, e.matricula
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

            if ($query = $db->prepare("SELECT AES_DECRYPT(numTelefone,?) FROM tbTelefone WHERE idUser = ?")){
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
          <!-- Default box -->
        <div class="callout callout-info">
              <h4>Atenção requerentes!</h4>
              <p>A solicitação NÃO garante a inclusão na disciplina. Para verificar a situação do seu requerimento de inclusão acesse a página <a href="http://admin.dcomp.ufs.br/requerimentos/acompanhar">http://admin.dcomp.ufs.br/requerimentos/acompanhar</a>.</p>
              <p>Qualquer dúvida entre em contato conosco através do e-mail <b>secretaria@dcomp.ufs.br</b></p>
              <p>Antes de enviar um requerimento verifique se a turma desejada possui vagas. Entre no <b>SIGAA</b> e acesse o menu <b>Ensino > Consultar Turma</b>. <a href="tuto_inclusao.gif" target="_blank">Clique aqui e veja um tutorial!</a></p>
            </div>
          <div class="box" id="forminsere">
            <div class="box-header with-border">
                  <h3 class="box-title">Dados básicos</h3>
            </div>
                <form role="form" action="post.php" method="post" class="formulario" autocomplete="off" enctype="multipart/form-data">
                  <input type="hidden" id="numPost" name="numPost" value="20"><!-- Número correspodente ao post -->
                  <input type="hidden" id="tipoReq" name="tipoReq" value="5"><!-- Número correspodente ao tipo -->   
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
                <h3 class="box-title">Dados complementares (<a href="tuto_inclusao.gif" target="_blank">veja o tutorial sobre como pegar essas informações</a>)</h3>
            </div>
              <div class="box-body">
                  <div class="form-group">
                    <label>Disciplina</label>
                    <select class="form-control select2" name="disciplina" id="disciplina">
                      <option selected disabled>Selecione uma disciplina</option>
                      <?php
                        $db = Atalhos::getBanco();
                        if($query = $db->prepare("SELECT idDisc, nome, codigo, carga FROM tbDisciplinas WHERE status = 'Ativo'")){
                              $query->execute();
                              $query->bind_result($idDisc, $nome, $codigo, $carga);
                        }
                        while($query->fetch()){
                          echo '<option value="'.$codigo.'">'.$codigo.' - '.$nome.' ('.$carga.')</option>';
                            }        
                        $query->close();
                      ?>
                    </select>
                  </div>
                    <div class="form-group">
                      <label>Turma (verifique se há vaga pelo SIGAA)</label>
                      <select class="form-control" name="turma" id="turma">
                      <option selected disabled>Selecione a turma desejada</option>
                      <?php
                        for($i=1; $i <= 15; $i++)
                          echo '<option value="'.$i.'">Turma '.$i.'</option>';
                      ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Período letivo</label>
                      <select class="form-control" name="periodo" id="periodo">
                      <option selected disabled>Selecione um período</option>
                      <?php
                        $ano_atual = (int) date("Y", time());
                          $ano_passado = $ano_atual - 1;
                          for($i=0;$i<3;$i++){
                            $ano = $ano_passado + $i;
                            echo '<option value="'.$ano.'/1">'.$ano.'/1</option>';
                            echo '<option value="'.$ano.'/2">'.$ano.'/2</option>';
                          }
                      ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Situação</label>
                      <select class="form-control" name="situacao" id="situacao">
                        <option selected disabled>Selecione uma situação</option>
                        <option value="1">Estou nivelado e essa disciplina é obrigatória nesse período</option>
                        <option value="2">Sou um formando</option>
                        <option value="3">Estou atrasado e/ou essa disciplina é optativa para mim</option>
                        <option value="4">Quero adiantar essa disciplina</option>
                        <option value="5">Essa disciplina é eletiva</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Já reprovou por falta ou trancou essa disciplina?</label>
                      <select class="form-control" name="reprovou" id="reprovou">
                        <option selected disabled>Selecione uma resposta</option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Digite o seu IEA (Índice de Eficiência Acadêmica)</label>
                      <input type="text" class="form-control" placeholder="Ex: 9.876" onpaste="return false;" data-inputmask="'mask': ['9.999']" data-mask name="iea" id="iea">
                    </div>
                    <div class="form-group">
                      <label>Anexar histórico (acesse seu SIGAA, baixe o seu histórico e anexe o PDF aqui):</label>
                      <input type="file" name="pdf" id="pdf" required>
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
              if ($query = $db->prepare("SELECT a.conteudoReq, b.nomeUser, AES_DECRYPT(b.email,?), c.afiliacao, a.tipoReq, b.idUser, a.statusReq, e.matricula
                          FROM tbRequerimentos a
                          inner join tbUsuario b on a.idUser = b.idUser 
                          inner join tbAfiliacao c on b.idAfiliacao = c.idAfiliacao
                          inner join tbMatricula e on b.idUser = e.idUser
                          WHERE a.idReq = ?")){
                $query->bind_param('si', $_SESSION['chave'], $id);
                $query->execute(); 
                $query->bind_result($conteudoReq, $nomeUser, $email, $afiliacao, $tipoReq, $idUser, $statusReq, $matricula);
                $query->fetch();
                $query->close();
              }
              if ($query = $db->prepare("SELECT AES_DECRYPT(numTelefone,?) FROM tbTelefone WHERE idUser = ?")){
                $query->bind_param('si', $_SESSION['chave'], $_SESSION['id']);
                $query->execute();
                $query->bind_result($numTelefone);
                $query->fetch();
                $query->close();
              }
              $conteudo = explode("/+", $conteudoReq);
              if(($_SESSION['nivel'] == '1' || $_SESSION['id'] == $idUser) && ($statusReq != 'Aprovado') && ($tipoReq == 5)){
        ?>
        <?php
          if(isset($_SESSION['avisoReqs'])):
        ?>
            <div class="callout callout-success">
              <h4>Requerimento editado com sucesso!</h4>
              <p>Acesse a <a href="/requerimentos/meus">página de requerimentos</a> para visualizar, editar e acompanhar a sua solicitação.</p>
            </div>
        <?php
          unset($_SESSION['avisoReqs']);
          endif;
        ?>
          <!-- Default box -->
        <div class="callout callout-info">
              <h4>Atenção requerentes!</h4>
              <p>A solicitação NÃO garante a inclusão na disciplina. Para verificar a situação do seu requerimento de inclusão acesse a página <a href="http://admin.dcomp.ufs.br/requerimentos/acompanhar">http://admin.dcomp.ufs.br/requerimentos/acompanhar</a> e digite a sua matrícula e o seu e-mail (SOMENTE PARA ALUNOS QUE NÃO SÃO DO DCOMP).</p>
              <p>Qualquer dúvida entre em contato conosco através do e-mail <b>secretaria@dcomp.ufs.br</b></p>
              <p>Antes de enviar um requerimento verifique se a turma desejada possui vagas. Entre no <b>SIGAA</b> e acesse o menu <b>Ensino > Consultar Turma</b>. <a href="tuto_inclusao.gif" target="_blank">Clique aqui e veja um tutorial!</a></p>
            </div>
          <div class="box" id="forminsere">
            <div class="box-header with-border">
                  <h3 class="box-title">Dados básicos</h3>
            </div>
                <form role="form" action="post.php" method="post" class="formulario" autocomplete="off">
                  <input type="hidden" id="numPost" name="numPost" value="21"><!-- Número correspodente ao post -->
                  <input type="hidden" id="tipoReq" name="tipoReq" value="5"><!-- Número correspodente ao tipo -->   
                  <input type="hidden" id="idReq" name="idReq" value="<?php echo $id; ?>"><!-- Número correspodente ao tipo -->   
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
                <h3 class="box-title">Dados complementares (<a href="tuto_inclusao.gif" target="_blank">veja o tutorial sobre como pegar essas informações</a>)</h3>
            </div>
              <div class="box-body">
                  <div class="form-group">
                    <label>Disciplina</label>
                    <select class="form-control select2" name="disciplina" id="disciplina">
                      <option disabled>Selecione uma disciplina</option>
                      <?php
                        $db = Atalhos::getBanco();
                        if($query = $db->prepare("SELECT idDisc, nome, codigo, carga FROM tbDisciplinas WHERE status = 'Ativo'")){
                              $query->execute();
                              $query->bind_result($idDisc, $nome, $codigo, $carga);
                        }
                        while($query->fetch()){
                      ?>
                        <option value="<?php echo $codigo;?>" <?php if($codigo == $conteudo[4]) echo 'selected'; ?>><?php echo $codigo.' - '.$nome.' ('.$carga.')';?></option>
                      <?php
                            }        
                        $query->close();
                      ?>
                    </select>
                  </div>
                    <div class="form-group">
                      <label>Turma</label>
                      <select class="form-control" name="turma" id="turma">
                      <option disabled>Selecione a turma desejada</option>
                      <?php
                        for($i=1; $i <= 15; $i++){
                      ?>
                          <option value="<?php echo $i;?>" <?php if($conteudo[5] == $i) echo 'selected'; ?>><?php echo 'Turma '.$i;?></option>
                      <?php  
                        }
                      ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Período letivo</label>
                      <select class="form-control" name="periodo" id="periodo">
                      <option disabled>Selecione um período</option>
                      <?php
                        $ano_atual = (int) date("Y", time());
                          $ano_passado = $ano_atual - 1;
                          for($i=0;$i<3;$i++){
                            $ano = $ano_passado + $i;
                      ?>
                          <option value="<?php echo $ano.'/1';?>" <?php if($conteudo[0] == $ano.'/1') echo 'selected'; ?>><?php echo $ano.'/1';?></option>
                          <option value="<?php echo $ano.'/2';?>" <?php if($conteudo[0] == $ano.'/2') echo 'selected'; ?>><?php echo $ano.'/2';?></option>
                      <?php  
                        }
                      ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Situação</label>
                      <select class="form-control" name="situacao" id="situacao">
                        <option disabled>Selecione uma situação</option>
                        <option value="1" <?php if($conteudo[1] == '1') echo 'selected'; ?>>Estou nivelado e essa disciplina é obrigatória nesse período</option>
                        <option value="2" <?php if($conteudo[1] == '2') echo 'selected'; ?>>Sou um formando</option>
                        <option value="3" <?php if($conteudo[1] == '3') echo 'selected'; ?>>Estou atrasado e/ou essa disciplina é optativa para mim</option>
                        <option value="4" <?php if($conteudo[1] == '4') echo 'selected'; ?>>Quero adiantar essa disciplina</option>
                        <option value="5 <?php if($conteudo[1] == '5') echo 'selected'; ?>">Essa disciplina é eletiva</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Já reprovou por falta ou trancou essa disciplina?</label>
                      <select class="form-control" name="reprovou" id="reprovou">
                        <option selected disabled>Selecione uma resposta</option>
                        <option value="Sim" <?php if($conteudo[2] == 'Sim') echo 'selected'; ?>>Sim</option>
                        <option value="Não" <?php if($conteudo[2] == 'Não') echo 'selected'; ?>>Não</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Digite o seu IEA (Índice de Eficiência Acadêmica)</label>
                      <input type="text" class="form-control" placeholder="Ex: 9.876" onpaste="return false;" data-inputmask="'mask': ['9.999']" data-mask name="iea" id="iea" value="<?php echo $conteudo[3];?>">
                    </div>
                    <div class="form-group">
                      <label>Anexar histórico (acesse seu SIGAA, baixe o seu histórico e anexe o PDF aqui):</label>
                      <p><a href="getPdf.php?id=<?php echo $id;?>">Visualizar</a></p>
                    </div> 
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="botaoEditar">Enviar requerimento</button>
                  </div>
                  </form>
          </div><!-- /.box -->

        <?php
          } else echo Atalhos::aviso(1); //FIM DAS PERMISSÕES 
          } //FIM DO FORMULÁRIO PARA EDIÇÃO DE USUÁRIO LOGADO
          } else{ //Termina IF de permissão logado
        ?>
        <?php
          // FORMULÁRIO PARA INSERÇÃO
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
          <!-- Default box -->
        <div class="callout callout-info">
              <h4>Atenção requerentes!</h4>
              <p>A solicitação NÃO garante a inclusão na disciplina. Para verificar a situação do seu requerimento de inclusão acesse a página <a href="http://admin.dcomp.ufs.br/requerimentos/acompanhar">http://admin.dcomp.ufs.br/requerimentos/acompanhar</a> e digite a sua matrícula e o seu e-mail (SOMENTE PARA ALUNOS QUE NÃO SÃO DO DCOMP).</p>
              <p>Antes de enviar um requerimento verifique se a turma desejada possui vagas. Entre no <b>SIGAA</b> e acesse o menu <b>Ensino > Consultar Turma</b>. <a href="tuto_inclusao.gif" target="_blank">Clique aqui e veja um tutorial!</a></p>
            </div>
          <div class="box" id="forminsere2">
            <div class="box-header with-border">
                  <h3 class="box-title">Dados básicos</h3>
            </div>
                <form role="form" action="post2.php" method="post" class="formulario" autocomplete="off" enctype="multipart/form-data">
                  <input type="hidden" id="numPost" name="numPost" value="4"><!-- Número correspodente ao post -->
                  <input type="hidden" id="tipoReq" name="tipoReq" value="5"><!-- Número correspodente ao tipo -->   
                  <div class="box-body">
                    <div class="form-group">
                      <label>Matrícula</label>
                      <input type="number" class="form-control" name="matricula" id="matricula">
                    </div>
                    <div class="form-group">
                      <button type="button" class="btn btn-default" onclick="testeMatricula();">Verificar matrícula</button>
                    </div>
                    <div id="matResp" name="matResp"><input type="hidden" name="veriMat" id="veriMat" value="0"/></div>
                  </div><!-- /.box-body -->
            <div class="box-header with-border">
                <h3 class="box-title">Dados complementares (<a href="tuto_inclusao.gif" target="_blank">veja o tutorial sobre como pegar essas informações</a>)</h3>
            </div>
              <div class="box-body">
                  <div class="form-group">
                    <label>Disciplina</label>
                    <select class="form-control select2" name="disciplina" id="disciplina">
                      <option selected disabled>Selecione uma disciplina</option>
                      <?php
                        $db = Atalhos::getBanco();
                        if($query = $db->prepare("SELECT idDisc, nome, codigo, carga FROM tbDisciplinas WHERE status = 'Ativo'")){
                              $query->execute();
                              $query->bind_result($idDisc, $nome, $codigo, $carga);
                        }
                        while($query->fetch()){
                          echo '<option value="'.$codigo.'">'.$codigo.' - '.$nome.' ('.$carga.')</option>';
                            }        
                        $query->close();
                      ?>
                    </select>
                  </div>
                    <div class="form-group">
                      <label>Turma (verifique se há vaga pelo SIGAA)</label>
                      <select class="form-control" name="turma" id="turma">
                      <option selected disabled>Selecione a turma desejada</option>
                      <?php
                        for($i=1; $i <= 15; $i++)
                          echo '<option value="'.$i.'">Turma '.$i.'</option>';
                      ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Período letivo</label>
                      <select class="form-control" name="periodo" id="periodo">
                      <option selected disabled>Selecione um período</option>
                      <?php
                        $ano_atual = (int) date("Y", time());
                          $ano_passado = $ano_atual - 1;
                          for($i=0;$i<3;$i++){
                            $ano = $ano_passado + $i;
                            echo '<option value="'.$ano.'/1">'.$ano.'/1</option>';
                            echo '<option value="'.$ano.'/2">'.$ano.'/2</option>';
                          }
                      ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Situação</label>
                      <select class="form-control" name="situacao" id="situacao">
                        <option selected disabled>Selecione uma situação</option>
                        <option value="1">Estou nivelado e essa disciplina é obrigatória nesse período</option>
                        <option value="2">Sou um formando</option>
                        <option value="3">Estou atrasado e/ou essa disciplina é optativa para mim</option>
                        <option value="4">Quero adiantar essa disciplina</option>
                        <option value="5">Essa disciplina é eletiva</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Já reprovou por falta ou trancou essa disciplina?</label>
                      <select class="form-control" name="reprovou" id="reprovou">
                        <option selected disabled>Selecione uma resposta</option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Digite o seu IEA (Índice de Eficiência Acadêmica)</label>
                      <input type="text" class="form-control" placeholder="Ex: 9.876" onpaste="return false;" data-inputmask="'mask': ['9.999']" data-mask name="iea" id="iea">
                    </div>
                    <div class="form-group">
                      <label>Anexar histórico (acesse seu SIGAA, baixe o seu histórico e anexe o PDF aqui):</label>
                      <input type="file" name="pdf" id="pdf" required>
                    </div>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="botaoEnviar">Enviar requerimento</button>
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
        $("#botaoEnviar").attr("disabled","disabled");
        var discipĺina = $.trim($(this).find('#disciplina').val());
        var turma = $.trim($(this).find('#turma').val());
        var periodo = $.trim($(this).find('#periodo').val());
        var situacao = $.trim($(this).find('#situacao').val());
        var reprovou = $.trim($(this).find('#reprovou').val());
        var iea = $.trim($(this).find('#iea').val());
        if(!(disciplina != "" && turma != "" && periodo != "" && situacao != "" && reprovou != "" && iea.length != 0)) {
            $("#botaoEnviar").attr("disabled",false);
            alert("Por favor, preencha todos os campos!");
            return false;
        }
    });

    $('#forminsere2').find('.formulario').submit(function() {
        testeMatricula();
        $("#botaoEnviar").attr("disabled","disabled");
        var disciplina = $.trim($(this).find('#disciplina').val());
        var turma = $.trim($(this).find('#turma').val());
        var periodo = $.trim($(this).find('#periodo').val());
        var situacao = $.trim($(this).find('#situacao').val());
        var reprovou = $.trim($(this).find('#reprovou').val());
        var veriMat = $.trim($(this).find('#veriMat').val());
        var iea = $.trim($(this).find('#iea').val());
        if(!(disciplina != "" && turma != "" && periodo != "" && situacao != "" && reprovou != "" && iea.length != 0 && (veriMat != 1 || (veriMat != 2 && nome.length != 0 && curso.length != 0 && telefone.length != 0 && email.length != 0 && email2.length != 0 && email == email2)))) {
            $("#botaoEnviar").attr("disabled",false);
            alert("Por favor, preencha todos os campos!");
            return false;
        }
        if(veriMat != 1 && veriMat != 2){
          $("#botaoEnviar").attr("disabled",false);
          alert("Problema na matrícula, verifique novamente!");
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