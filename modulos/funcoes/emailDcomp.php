<?php 
  include '../../includes/topo.php';
?>
<title>AdminDcomp - E-mail Dcomp</title>
</head>
<?php
  if($_SESSION['logado']){
    $db = Atalhos::getBanco();
    if($query = $db->prepare("SELECT idUser FROM tbEmail WHERE idUser = ?")){
      $query->bind_param('i', $_SESSION['id']);
      $query->execute();
      if($query->fetch()){
        header('Location: /inicio');
      }
      $query->close();
    }
    $db->close();
  }else{
    header('Location: /inicio');
  }

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          E-mail Dcomp             
        </h1>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="box box-solid">
          <form action="post/" method="POST" id="formulario">
            <input type="hidden" id="numPost" name="numPost" value="43"/><!-- Número correspodente ao post -->
            <input type="hidden" id="idAssunto" name="idAssunto" value="6"/>
            <div class="box-body">
              <div class="form-group col-xs-7">
                <div> 
                  <b>Saudações</b> caro aventureiro !<br><br>
                  Essa sessão é destinada a solicitação do vosso email institucional, nele irá receber todas as noticias e notificações do Admin DCOMP.<br><br>
                  Logo abaixo, você irá escolher o prefixo do email com o sufixo @dcomp.ufs.br, este prefixo não poderá ser alterado de forma alguma, escolha com sabedoria!<br><br>
                  Após escolher e clicar em Concluir, será criado um ticket que poderá ser visualizado na pagina correspondente. A sua solicitação será avaliada pelo administrador do sistema e  o processo só será concluído após o <b>encerramento</b> deste ticket.<br><br>
                  </div>
                <?php
                  $aux = Atalhos::gerarEmail($_SESSION['nome']);
                  if(isset($aux)){
                    $aux = explode(" ", $aux);
                    $num = count($aux);
                    echo '<label>Selecionar um e-mail:</label>';
                    for($i = 1; $i <= $num; $i++){
                      echo '<div class="radio">
                          <label>
                            <input type="radio" name="email" value="'.$aux[$i-1].'">
                        <strong>'.$aux[$i-1].'</strong>'.Dominio.'
                        </label></div>';
                    }
                  }else{
                    echo '<div>Em seu nome deve está pelo menos nome e sobrenome</div>';
                  }
                ?>
              </div>
              <div class="form-group col-xs-6">

                <label>E-mail Alternativo:</label>
                <?php
                  $db = Atalhos::getBanco();
                  if($query = $db->prepare("SELECT AES_DECRYPT(email, ?) FROM tbUsuario WHERE idUser = ?")){
                    $query->bind_param('si', $_SESSION['chave'], $_SESSION['id']);
                    $query->execute();
                    $query->bind_result($email);
                    $query->fetch();
                    echo '<input type="text" class="form-control" disabled="true" value="'.$email.'"/><input type="hidden" name="emailalt" id="emailalt" value="'.$email.'"/>';
                    $query->close();
                  }
                  $db->close();
                ?>
              </div>
            </div>
            <div class="box-footer">
              <?php
                if(isset($aux)){
                  echo '<button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.form.submit();">Concluir</button> <a href="/perfil/'.$_SESSION['id'].'/"<span class="btn btn-default">Cancelar</span></a>';
                }else{
                  echo '<a href="/perfil/'.$_SESSION['id'].'/"<span class="btn btn-default">Cancelar</span></a>';
                }
              ?>
            </div>
          </form> 
        </div>
      </section><!-- /.content -->
    </div><!-- /.container -->
  </div><!-- /.content-wrapper -->
  <?php include '../../includes/rodape.php' ?>
</div><!-- ./wrapper -->
  <?php include '../../includes/script.php' ?>
</body>
</html>
