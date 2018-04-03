        <?php
          include 'topo.php';
        ?>
        <title>AdminDcomp - Trabalho de Conclusão de Curso</title>
        </head>
        <?php
          include 'barra.php';
          include 'menu.php';
          if($_SESSION['logado']){
            $acao = (isset($_GET['acao']))? $_GET['acao'] : 'inserir';          
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
    ?> 
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Trabalho de Conclusão de Curso
            <small>Requerimentos</small>      
          </h1>
        </section>

        <?php
          // FORMULÁRIO PARA INSERÇÃO
          if($acao == 'inserir'){
        ?>
        <!-- Main content -->
        <section class="content">
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
                  <input type="hidden" id="tipoReq" name="tipoReq" value="6"><!-- Número correspodente ao tipo -->
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
                      <label>Tipo</label>
                      <select class="form-control" name="tipo" id="tipo">
                        <option selected disabled>Selecione um tipo</option>
                        <option value="1">Trabalho de Conclusão de Curso 1</option>
                        <option value="2">Trabalho de Conclusão de Curso 2</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Código</label>
                      <select class="form-control" name="codigo" id="codigo">
                        <option selected disabled>Selecione um código</option>
                        <option value="COMP0341">COMP0341 (EC para TCC 1)</option>
                        <option value="COMP0342">COMP0342 (EC para TCC 2)</option>
                        <option value="COMP0345">COMP0345 (SI para TCC 1)</option>
                        <option value="COMP0346">COMP0346 (SI para TCC 2)</option>
                        <option value="COMP0338">COMP0338 (CC para TCC 1)</option>
                        <option value="COMP0339">COMP0339 (CC para TCC 2)</option>
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
                      <label>Professor</label>
                      <input type="text" class="form-control" name="professor" id="professor">
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

        </section><!-- /.content -->
        <?php
          }
          //FORMULÁRIO PARA EDIÇÃO
          elseif($acao == 'edit' && (!is_null($id))){
              if ($query = $db->prepare("SELECT a.conteudoReq, b.nomeUser, b.email, c.afiliacao, a.tipoReq, b.idUser, a.statusReq, e.matricula
                          FROM tbRequerimentos a
                          inner join tbUsuario b on a.idUser = b.idUser 
                          inner join tbAfiliacao c on b.idAfiliacao = c.idAfiliacao
                          inner join tbMatricula e on b.idUser = e.idUser
                          WHERE a.idReq = ?")){
                $query->bind_param('i', $id);
                $query->execute(); 
                $query->bind_result($conteudoReq, $nomeUser, $email, $afiliacao, $tipoReq, $idUser, $statusReq, $matricula);
                $query->fetch();
                $query->close();
              }
              if ($query = $db->prepare("SELECT numTelefone FROM tbTelefone WHERE idUser = ?")){
                $query->bind_param('i', $_SESSION['id']);
                $query->execute();
                $query->bind_result($numTelefone);
                $query->fetch();
                $query->close();
              }
              $conteudo = explode("/+", $conteudoReq);
              if(($_SESSION['nivel'] == '1' || $_SESSION['id'] == $idUser) && ($statusReq != 'Aprovado') && ($tipoReq == 6)){
        ?>
        <!-- Main content -->
        <section class="content">
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
                <form role="form" action="post.php" method="post" class="formulario2">
                  <input type="hidden" id="numPost" name="numPost" value="21"><!-- Número correspodente ao post -->
                  <input type="hidden" id="tipoReq" name="tipoReq" value="6"><!-- Número correspodente ao tipo -->
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
                      <label>Tipo</label>
                      <select class="form-control" name="tipo" id="tipo">
                        <option disabled>Selecione um tipo</option>
                        <option value="1" <?php if($conteudo[0] == '1') echo 'selected'; ?>>Trabalho de Conclusão de Curso 1</option>
                        <option value="2" <?php if($conteudo[0] == '2') echo 'selected'; ?>>Trabalho de Conclusão de Curso 2</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Código</label>
                      <select class="form-control" name="codigo" id="codigo">
                        <option disabled>Selecione um código</option>
                        <option value="COMP0341" <?php if($conteudo[1] == 'COMP0341') echo 'selected'; ?>>COMP0341 (EC para TCC 1)</option>
                        <option value="COMP0342" <?php if($conteudo[1] == 'COMP0342') echo 'selected'; ?>>COMP0342 (EC para TCC 2)</option>
                        <option value="COMP0345" <?php if($conteudo[1] == 'COMP0345') echo 'selected'; ?>>COMP0345 (SI para TCC 1)</option>
                        <option value="COMP0346" <?php if($conteudo[1] == 'COMP0346') echo 'selected'; ?>>COMP0346 (SI para TCC 2)</option>
                        <option value="COMP0338" <?php if($conteudo[1] == 'COMP0338') echo 'selected'; ?>>COMP0338 (CC para TCC 1)</option>
                        <option value="COMP0339" <?php if($conteudo[1] == 'COMP0339') echo 'selected'; ?>>COMP0339 (CC para TCC 2)</option>
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
                          <option value="<?php echo $ano;?>/1" <?php if($conteudo[2] == ($ano.'/1')) echo 'selected'; ?>><?php echo $ano;?>/1</option>
                          <option value="<?php echo $ano;?>/2" <?php if($conteudo[2] == ($ano.'/2')) echo 'selected'; ?>><?php echo $ano;?>/2</option>
                        <?php
                          }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Professor</label>
                      <input type="text" class="form-control" name="professor" id="professor" value="<?php echo $conteudo[3]; ?>">
                    </div>
                    <div class="form-group">
                      <label>Observação (opcional):</label>
                      <input type="text" class="form-control" name="obs" id="obs" value="<?php echo $conteudo[4]; ?>">
                    </div>
                  </div>
              </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Editar requerimento</button>
                  </div>
                  </form>
          </div><!-- /.box -->

        </section><!-- /.content -->
        <?php
          } else echo Atalhos::aviso(1); //FIM DA PERMISSÃO
          } //FIM DA EDIÇÃO
        ?>

      </div><!-- /.content-wrapper -->
      <?php 
        } //Termina IF de permissão logado
      ?>
    <?php include 'rodape.php' ?>

    </div><!-- ./wrapper -->
    <?php include 'script.php' ?>
    <script>

       $('#forminsere').find('.formulario').submit(function() {
        $("#botaoEnviar").attr("disabled","disabled");
        var professor = $.trim($(this).find('#professor').val());
        var tipo = $.trim($(this).find('#tipo').val());
        var codigo = $.trim($(this).find('#codigo').val());
        var periodo = $.trim($(this).find('#periodo').val());

        if(!(professor.length != 0 && tipo != "" && periodo != "" && codigo != "")) {
            alert("Por favor, preencha todos os campos!");
            $("#botaoEnviar").attr("disabled",false);
            return false;
        }
    });
    $('#formedita').find('.formulario2').submit(function() {
        var professor = $.trim($(this).find('#professor').val());
        var tipo = $.trim($(this).find('#tipo').val());
        var codigo = $.trim($(this).find('#codigo').val());
        var periodo = $.trim($(this).find('#periodo').val());

        if(!(professor.length != 0 && tipo != "" && periodo != "" && codigo != "")) {
            alert("Por favor, preencha todos os campos!");
            return false;
        }
    });
    </script>
  </body>
</html>