<?php
  include 'topo.php';
  if(isset($_GET['id'])){
    $idUser = $_GET['id'];
  }else{
    header('Location: /inicio');
  }
?>
<title>AdminDcomp - Perfil do Usuário Temporário</title>
</head>
<?php 
  include 'barra.php';
  include 'menu.php';
  $_SESSION['irPara'] = '/inicio';
  $db = Atalhos::getBanco();
  if ($query = $db->prepare('SELECT idConta, nomeConta, login, statusConta, numAcesso, dataInicio, dataFim FROM tbcontatemp WHERE idConta = ? ORDER BY nomeConta')){
    $query->bind_param('i', $_GET['id']);
    $query->execute();
    $query->bind_result($idConta, $nomeConta, $login, $statusConta, $numAcesso, $dataInicio, $dataFim);
    $query->fetch();
    $query->close();
  }
  $db->close();
  $dataini = date('d/m/Y', strtotime($dataInicio));
  $datafim = date('d/m/Y', strtotime($dataFim));
  $sudo = true;
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Perfil do Usuário Temporário
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['alterDados'])):
      ?>
          <div class="callout callout-success">
            <h4>Alteração realizada com successo!</h4>
          </div>
      <?php
          unset($_SESSION['alterDados']);
          endif;
          if(isset($_SESSION['avisoBlock'])):
      ?>
          <div class="callout callout-warning">
            <h4>Usuário bloqueado com sucesso!</h4>
          </div>
      <?php
          unset($_SESSION['avisoBlock']);  
          endif;
          if(isset($_SESSION['erroAdmin'])):
      ?>
          <div class="callout callout-warning">
            <h4>Nível não alterado!</h4>
            Número de Administradores insuficientes.
          </div>
      <?php
          unset($_SESSION['erroAdmin']);
          endif;
          if(isset($_SESSION['avisoDesblock'])):
      ?>
          <div class="callout callout-success">
            <h4>Usuário desbloqueado com sucesso!</h4>
          </div>
      <?php
          unset($_SESSION['avisoDesblock']);
        endif;
      ?>
      <div class="row">
        <?php if($nivel == 3 || ($_SESSION['logado'] && ($_SESSION['nivel'] < 2 || $_SESSION['id'] == $_GET['id']))): ?>
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
              <div class="box-body box-profile">
                <center>
                  <div class="img-circle center-block" style="background-image: url('getImagem.php?idUser=<?php echo $idUser ?>'); background-size: 100% 100%;height: 160px;width: 160px;"></div>
                </center>
                <?php 
                  if($_SESSION['logado']){
                    if($_SESSION['nivel'] == 0){
                      echo '<h3 class="profile-username text-center">'.$nomeUser.'</h3><p class="text-muted text-center">'.$login.'</p>';
                      if($statusUser == 'Ativo'){
                        echo '<a class="btn btn-default btn-block" data-toggle="modal" data-target="#simples" data-solict-id="'.$idConta.'" data-solict-tipo="1" data-solict-frase="Inativar Conta '.$login.'"><i class="fa fa-user-times">
                                  <i class="fa fa-user-times">
                                      </i> Inativar Usuário
                                </a>';
                        echo '<a class="btn btn-default btn-block" data-toggle="modal" data-target="#num" data-solict-id="'.$idConta.'">
                            <i class="fa fa-desktop">
                                </i> Alterar quantidade de acessos
                          </a>';
                      }else{
                        echo '<a class="btn btn-default btn-block" data-toggle="modal" data-target="#data" data-solict-id="'.$idConta.'" data-solict-frase="Ativar Conta '.$login.'">
                        <i class="fa  fa-user-plus">
                          </i> Ativar Usuário
                          </a>';
                      } 
                      if($sudo){
                        echo '<a class="btn btn-default btn-block" data-toggle="modal" data-target="#simples" data-solict-id="'.$idUser.'"
                        data-solict-tipo="3" data-solict-frase="Retirar sudo do Usuário">
                        <i class="fa fa-linux"></i> Desativar Sudo
                            </a>';
                      }else{
                        echo '<a class="btn btn-default btn-block" data-toggle="modal" data-target="#simples" data-solict-id="'.$idUser.'" 
                        data-solict-tipo="4" data-solict-frase="Dar sudo ao Usuário">
                        <i class="fa fa-linux"></i> Ativar Sudo
                            </a>';
                      }
                      echo '<a class="btn btn-default btn-block" data-toggle="modal" data-target="#senha" data-solict-id="'.$idConta.'"><i class="fa fa-retweet"></i> Redefinir Senha</a>
                            <a class="btn btn-default btn-block" data-toggle="modal" data-target="#data" data-solict-id="'.$idConta.'" data-solict-frase="Alterar data de encerramento"><i class="fa fa-calendar"></i> Alterar Data de Fim</a>';
                    }
                  }else{
                    echo '<h3 class="profile-username text-center">'.$nomeUser.'</h3><p class="text-muted text-center">'.$login.'</p>';
                  } 
                ?> 
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
          <div class="col-md-9">
            <!-- /.box-header -->
            <div class="nav-tabs-custom">
            <div class="box-header with-border">
                <h3 class="box-title">Sobre mim</h3><a href="javascript:history.go(-1)"><span class="btn-sm btn-primary pull-right">Voltar</span></a>
            </div>
              <div class="tab-content">
                <strong><i class="fa fa-user margin-r-5"></i>Nome</strong><p class="text-muted"><?php echo $nomeConta ?></p><hr>
                <strong><i class="fa fa-user margin-r-5"></i>Login</strong><p class="text-muted"><?php echo $login ?></p><hr>
                <strong><i class="fa fa-user margin-r-5"></i>Número de Acessos</strong><p class="text-muted"><?php echo $numAcesso ?></p><hr>
                <strong><i class="fa fa-user margin-r-5"></i>Tempo Ativo</strong><p class="text-muted"><?php echo $dataini.' - '.$datafim  ?></p><hr>
                <?php
                  if($sudo){
                    echo '<strong><i class="fa fa-user margin-r-5"></i>Sudo</strong><p class="text-muted">Ativado</p><hr>';
                  }else{
                    echo '<strong><i class="fa fa-user margin-r-5"></i>Sudo</strong><p class="text-muted">Desativado</p><hr>';
                  }
                ?>
              </div><!-- /.tab-content -->
            </div><!-- /.nav-tabs-custom -->
          </div><!-- /.col -->
        <?php else: ?>
          <div class="box">
            <div class="box-header">
              <a href="javascript:history.go(-1)"><span class="btn-sm btn-primary pull-right">Voltar</span></a>
            </div>
            <div class="box-body">
              <div class="callout callout-warning">
                <h4>Você não tem permissão para acesar esse perfil!</h4>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div><!-- /.row -->

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
        <form role="form" action="post.php" method="post" name="formulario1" id="formulario1">
        <div class="modal-body">
          <input type="hidden" id="numPost" name="numPost" value="14"><!-- Número correspodente ao post -->
          <input type="hidden" name="idconta" id="idconta"/>
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
  <div class="modal fade" id="senha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel"></h4>
        </div>
        <form role="form" action="post.php" method="post" name="formulario1" id="formulario1">
        <div class="modal-body">
          <input type="hidden" id="numPost" name="numPost" value="14"><!-- Número correspodente ao post -->
          <input type="hidden" name="idconta2" id="idconta2"/>
          <div class="form-group">
            <label for="senha">Senha:</label>
            <a data-toggle="tooltip">
              <input type="password" class="form-control" name="senha" id="senha" maxlength="16" onKeyUp="testaSenha(this.value);">
            </a>
          </div>
          <div id='seguranca' class="col-xs-12"></div>
          <div class="form-group">
            <label for="senha">Confirma Senha:</label>
            <input type="password" class="form-control" name="senha2" id="senha2" maxlength="16" onKeyUp="testaSenha2(this.value);">
          </div>
          <div id="confirmar" class="col-xs-12"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Confirmar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel"></h4>
        </div>
        <form role="form" action="post.php" method="post" name="formulario1" id="formulario1">
          <div class="modal-body">
            <input type="hidden" id="numPost" name="numPost" value="14"><!-- Número correspodente ao post -->
            <input type="hidden" name="idconta3" id="idconta3"/>
            <div class="form-group">
              <label>Insira novo fim:</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control" name="data" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
              </div><!-- /.input group -->
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
  <div class="modal fade" id="num" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel"></h4>
        </div>
        <form role="form" action="post.php" method="post" name="formulario1" id="formulario1">
        <div class="modal-body">
          <input type="hidden" id="numPost" name="numPost" value="14"><!-- Número correspodente ao post -->
          <input type="hidden" name="idconta4" id="idconta4"/>
          <div class="form-group">
            <label for="login">Número de acessos simultánios:</label>
            <input type="number" class="form-control" name="numAcesso" <?php echo 'value="'.$numAcesso.'"'?>>
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
<?php 
  include 'rodape.php';
  include 'script.php'; 
?>
  <script>
    $('#simples').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var tipo = button.data('solict-tipo')
      var frase = button.data('solict-frase')
      var id = button.data('solict-id')
      var modal = $(this)
      modal.find('.modal-title').text(frase)
      $('#idconta').val(id)
      $('#acao').val(tipo)
    });

    $('#senha').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('solict-id')
      var modal = $(this)
      modal.find('.modal-title').text('Alterar senha')
      $('#idconta2').val(id)
    });

    $('#data').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var frase = button.data('solict-frase')
      var id = button.data('solict-id')
      var modal = $(this)
      modal.find('.modal-title').text(frase)
      $('#idconta3').val(id)
    });

    $('#num').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('solict-id')
      var modal = $(this)
      modal.find('.modal-title').text('Alterar número de acessos')
      $('#idconta4').val(id)
    });

    $('#box').find('.formulario').submit(function(){
      var titulo = $.trim($(this).find('#titulo').val());
      if(senha.length < 8) {
        alert("Senha tem menos de 8 digitos");
        return false;
      }else if(verCaracterDaSenha(senha) == 1){
        alert("Senha com baixa segurança");
        return false;
      }else if(senha != senha2){
        alert("Senhas não conhecidem");
        return false;
      }else if(titulo.length != 0 && texto.length != 0){

      }
    });

    function verCaracterDaSenha(valor) {
    var erespeciais = /[@!#$%&*+=?|-]/;
    var ermaiuscula = /[A-Z]/;
    var erminuscula = /[a-z]/;
    var ernumeros   = /[0-9]/;
    var cont = 0;
   
    if (erespeciais.test(valor)) cont++;
    if (ermaiuscula.test(valor)) cont++;
    if (erminuscula.test(valor)) cont++;
    if (ernumeros.test(valor))   cont++;
    return cont;
  }
   
  function segurancaBaixa(d) {
    d.innerHTML = '<b><i class="fa fa-fw fa-unlock-alt"></i>Nível de segurança: <font color=\'red\'> BAIXO</font></b>';
  }
  function segurancaMedia(d) {
    d.innerHTML = '<b><i class="fa fa-fw fa-unlock-alt"></i>Nível de segurança: <font color=\'orange\'> MÉDIO</font></b>';
  }
  function segurancaAlta(d) {
    d.innerHTML = '<b><i class="fa fa-fw fa-unlock-alt"></i>Nível de segurança: <font color=\'green\'>  ALTO</font></b>';
  }
   
  function testaSenha(valor) {
    var d = document.getElementById('seguranca');
    var c = verCaracterDaSenha(valor);
    var t = valor.length;
   
    if(t == ''){
      d.innerHTML = '<b><i class="fa fa-fw fa-unlock-alt"></i>Nível de segurança: !</b>'
    } else {
      if(t > 7 && c >= 3) segurancaAlta(d);
      else { 
        if(t > 7 && c >= 2 || t > 4 && c >= 3) segurancaMedia(d);
        else segurancaBaixa(d);
      }
    }  
  }

  function testaSenha2(senha2){
    var d = document.getElementById('confirmar');
    var senha = document.getElementById("senha").value;
    if(senha2 != senha){
      d.innerHTML = '<b><font color=\'red\'><i class="fa fa-fw fa-remove"></i> Senhas não coincidem</font></b>';
    }else{
      d.innerHTML = '';
    }
  }
  </script>
</body>
</html>