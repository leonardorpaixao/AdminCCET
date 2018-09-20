<?php
  include '../../includes/topo.php';
?>
<title>AdminDcomp - Estágio Supervisionado</title>
</head>
<?php
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $_SESSION['irPara'] = '/requerimentos/inserir/4/';
  $link = '/requerimentos/inserir/4/';
  $acao = (isset($_GET['acao']))? $_GET['acao'] : 'inserir';  
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Estágio Supervisionado
            <small>Requerimentos</small>      
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
        <?php
        $prazo = Atalhos::verificarReq(4);
        // INICIO VERIFICA O PRAZO
        if($prazo[0] || $_SESSION['nivel'] == '1' || $_SESSION['nivel'] == '3'){

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
          <!-- Default box -->
          <div class="box" id="forminsere">
            <div class="box-header with-border">
                  <h3 class="box-title">Dados básicos</h3>
            </div>
                <form role="form" action="post/" method="post" class="formulario">
                  <input type="hidden" id="numPost" name="numPost" value="20"><!-- Número correspodente ao post -->
                  <input type="hidden" id="tipoReq" name="tipoReq" value="4"><!-- Número correspodente ao tipo -->
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
                      <label>Código</label>
                      <select class="form-control" name="codigo" id="codigo">
                        <option selected disabled>Selecione o código referente ao seu curso</option>
                        <option value="COMP0340">COMP0340 (EC)</option>
                        <option value="COMP0344">COMP0344 (SI)</option>
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
                      <label>Observação (opcional):</label>
                      <input type="text" class="form-control" name="obs" id="obs">
                    </div>
              </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="botaoEnviar">Enviar requerimento</button>
                  </div>
                  </form>
          </div><!-- /.box -->
        <?php
          }
          //FORMULÁRIO PARA EDIÇÃO
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
                $query->bind_param('si', $_SESSION['chave'], $idUser);
                $query->execute();
                $query->bind_result($numTelefone);
                $query->fetch();
                $query->close();
              }   
              $conteudo = explode("/+", $conteudoReq);
              if(($_SESSION['nivel'] == '1' || $_SESSION['id'] == $idUser) && ($statusReq == 'PendenteProf' || $statusReq == 'Pendente' || $statusReq == 'NegadoProf') && ($tipoReq == 4)){
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
                <form role="form" action="post/" method="post" class="formulario">
                  <input type="hidden" id="numPost" name="numPost" value="21"><!-- Número correspodente ao post -->
                  <input type="hidden" id="tipoReq" name="tipoReq" value="4"><!-- Número correspodente ao tipo -->
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
                      <label>Código</label>
                      <select class="form-control" name="codigo" id="codigo">
                        <option disabled>Selecione o código referente ao seu curso</option>
                        <option value="COMP0340" <?php if($conteudo[0] == 'COMP0340') echo 'selected';?>>COMP0340 (EC)</option>
                        <option value="COMP0344" <?php if($conteudo[0] == 'COMP0344') echo 'selected';?>>COMP0344 (SI)</option>
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
                        ?>
                          <option value="<?php echo $ano;?>/1" <?php if($conteudo[1] == ($ano.'/1')) echo 'selected'; ?>><?php echo $ano;?>/1</option>
                          <option value="<?php echo $ano;?>/2" <?php if($conteudo[1] == ($ano.'/2')) echo 'selected'; ?>><?php echo $ano;?>/2</option>
                        <?php
                          }
                        ?>
                      </select>
                    </div>
                    <?php
                      if($_SESSION['nivel'] == '1'){
                    ?>
                    <div class="form-group">
                      <label>Professor</label>
                      <select class="form-control select2" name="professor" id="professor">
                      <option selected disabled>Selecione um professor</option>
                      <option value="0" <?php if($conteudo[2] == 0) echo 'selected'; ?>>Outro professor (Não aparece na lista)</option>
                      <?php
                        $db = Atalhos::getBanco();
                        if($query = $db->prepare("SELECT a.idUser, a.nomeUser FROM tbUsuario a inner join tbAfiliacao b on a.idAfiliacao = b.idAfiliacao WHERE b.nivel = 3 AND a.statusUser = 'Ativo'")){
                              $query->execute();
                              $query->bind_result($idUser, $nomeUser);
                        }
                        while($query->fetch()){
                      ?>
                        <option value="<?php echo $idUser;?>" <?php if($conteudo[2] == $idUser) echo 'selected'; ?>><?php echo $nomeUser;?></option>
                      <?php
                            }        
                        $query->close();
                      ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Se o nome do professor não aparecer na lista acima, selecine a opção "Outro professor" e escreva abaixo o nome do professor:</label>
                      <input type="text" class="form-control" name="professor2" id="professor2" value="<?php echo $conteudo[4]; ?>">
                    </div>
                    <?php
                      }
                    ?>
                    <div class="form-group">
                      <label>Observação (opcional):</label>
                      <input type="text" class="form-control" name="obs" id="obs" value="<?php echo $conteudo[3]; ?>">
                    </div>
              </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="botaoEditar">Enviar requerimento</button>
                  </div>
                  </form>
          </div><!-- /.box -->

      <?php
        } else echo Atalhos::aviso(1); //FIM DA PERMISSÃO
        } //FIM DA EDIÇÃO
        } //Termina IF de permissão logado
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
        var codigo = $.trim($(this).find('#codigo').val());
        var periodo = $.trim($(this).find('#periodo').val());
        if(!(codigo != "" && periodo != "")) {
            $("#botaoEnviar").attr("disabled",false);
            alert("Por favor, preencha todos os campos!");
            return false;
        }
    });

    $('#formedita').find('.formulario').submit(function() {
        $("#botaoEditar").attr("disabled","disabled");
        var codigo = $.trim($(this).find('#codigo').val());
        var periodo = $.trim($(this).find('#periodo').val());
        if(!(codigo != "" && periodo != "")) {
            $("#botaoEditar").attr("disabled",false);
            alert("Por favor, preencha todos os campos!");
            return false;
        }
    });
</script>
  </body>
</html>
