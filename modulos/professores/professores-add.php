<?php
  include '../../includes/topo.php';
?>
<title>AdminDcomp - Adicionar Professor</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != -1){
    header('Location: /inicio');
  }
  include ' ../../includes/barra.php';
  include '../../includes/menu.php';
  $db = Atalhos::getBanco();
  $_SESSION['irPara'] = '/inicio';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Adicionar Professor
        <small>Recursos</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box" id="box">
        <form role="form" action="post.php" method="post" id="formulario" autocomplete="off" class="formulario">
          <input type="password" style="display:none">
          <input type="hidden" id="numPost" name="numPost" value="14"><!-- Número correspodente ao post -->
          <input type="hidden" name="nivelAcesso" value="3">
          <div class="box-body">
            <div class="form-group col-xs-6">
              <label for="nome">Nome:</label>
              <input type="text" class="form-control" style='text-transform:uppercase;' name="nome" id="nome">
            </div>
            <div class="form-group col-xs-6">
              <label for="matricula">CPF:</label>
              <input type="number" class="form-control" name="cpf" id="cpf">
            </div>
            <div class="form-group col-xs-6">
              <label for="login">Login:</label>
              <input type="text" class="form-control" name="login" id="login">
            </div>
            <div class="form-group col-xs-6">
              <label for="email">E-mail:</label>
              <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="form-group col-xs-12">
              <div id='loginResp'></div>
              <button type="button" class="btn btn-default" onclick="testeLogin();">Verificar</button>
            </div>
            <div class=" col-xs-6">
              <label for="senha">Senha:</label>
              <a data-toggle="tooltip" <?php echo 'title="'.Senha.'"' ?>>
                <input type="password" class="form-control" name="senha" id="senha" maxlength="16" onKeyUp="testaSenha(this.value);">
              </a>
            </div>
            <div class="form-group col-xs-6">
              <label for="senha">Confirma Senha:</label>
              <input type="password" class="form-control" name="senha2" id="senha2" maxlength="16" onKeyUp="testaSenha2(this.value);">
            </div>
            <div id='seguranca' class="col-xs-12"></div>
            <div id="confirmar" class="col-xs-12"></div>
            <div class="form-group col-xs-6">
              <label for="email">Afiliação:</label>
              <select name="idAfiliacao" id="idAfiliacao" class="form-control" onchange="NovoTipo(this.value);">
                <?php
                  echo '<option value="">Selecionar Afiliação</option>';
                  echo '<option value="0">Adicinar Nova Afiliação</option>';
                  if ($query = $db->prepare("SELECT idAfiliacao, afiliacao FROM tbafiliacao WHERE nivel = 3")){
                    $query->execute();
                    $query->bind_result($idAfiliacao, $afiliacao);
                    while($query->fetch()){
                      echo '<option value="'.$idAfiliacao.'">'.$afiliacao.'</option>';
                    }
                    $query->close();
                    $db->close();
                  }
                ?>
              </select>
            </div>
          <div class="form-group" id="txtHint"></div>
          <div class="checkbox col-xs-8">
            <label>
              <input type="checkbox" name="sudo"> Ativar Sudo
            </label>
          </div>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.form.submit();">Adicionar</button>
            <a href="/recursos/professores"<span class="btn btn-default">Cancelar</span></a>
          </div>
        </form>
      </div><!-- /.box -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <?php include '../../includes/rodape.php' ?>
</div><!-- ./wrapper -->
  <?php include '../../includes/script.php' ?>
  <script type="text/javascript">
    $('#box').find('.formulario').submit(function() {
        var nome = $.trim($(this).find('#nome').val());
        var cpf = $.trim($(this).find('#cpf').val());
        var email = $.trim($(this).find('#email').val());
        var login = $.trim($(this).find('#login').val());
        var idAfiliacao = $.trim($(this).find('#idAfiliacao').val());
        var senha = $.trim($(this).find('#senha').val());
        var senha2 = $.trim($(this).find('#senha2').val());

        if(!(nome.length != 0 && cpf.length != 0 && email.length != 0
              && login.length != 0 && idAfiliacao != "")) {
            alert("Por favor, preencha todos os campos!");
            return false;
        }

        if(senha.length < 8) {
          alert("Senha tem menos de 8 digitos");
          return false;
        }else if(verCaracterDaSenha(senha) == 1){
          alert("Senha com baixa segurança");
          return false;
        }else if(senha != senha2){
          alert("Senhas não conhecidem");
          return false;
        }
    });
    function NovoTipo(str) {
      if(str != 0 || str == ''){
        document.getElementById("txtHint").innerHTML = "";
      }else{
        if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
          }else{
            result.innerHTML = "Erro: " + xmlreq.statusText;
          }
        };
        xmlhttp.open("GET","novoTipo.php?nome=Nova Afiliação&name=novaAfiliacao",true);
        xmlhttp.send();
      }
    }

    function testeLogin() {
      var login = document.getElementById("login").value;
      if(login == ''){
        document.getElementById("loginResp").innerHTML = "<b>Digite um login!</b>";
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
            document.getElementById("loginResp").innerHTML = xmlhttp.responseText;
          }else{
            result.innerHTML = "Erro: " + xmlhttp.statusText;
          }
        };
        xmlhttp.open("GET","login.php?login="+login,true);
        xmlhttp.send();
      }
    }

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
      d.innerHTML = '<b><i class="fa fa-fw  fa-unlock-alt"></i>Nível de segurança: !</b>'
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

  $('#form').find('#formulario').submit(function() {

  });
  </script>
</body>
</html>
