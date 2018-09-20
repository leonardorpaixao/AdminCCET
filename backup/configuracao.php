<?php 
  include 'topo.php';
?>
<title>AdminDcomp - Configurações de Conta</title>
</head>
<?php
  if(!$_SESSION['logado']){
    header('Location: /inicio');
  }
  $db = Atalhos::getBanco();
  $_SESSION['irPara'] = '/inicio';
  if ($query = $db->prepare("SELECT nomeUser, AES_DECRYPT(email, ?) FROM tbusuario WHERE idUser = ?")){
    $query->bind_param('si', $_SESSION['chave'], $_SESSION['id']);
    $query->execute();
    $query->bind_result($nomeUser, $email);
    $query->fetch();
    $query->close();
  }
  include 'menu.php';
  include 'barra.php'; 
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Configurações de Conta
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php
      if(isset($_SESSION['errorConfig'])):
    ?>
        <div class="callout callout-danger">
          <h4><?php echo $_SESSION['errorConfig'] ?></h4>
        </div>
    <?php
        unset($_SESSION['errorConfig']);
      elseif(isset($_SESSION['avisoConfig'])):
    ?>
        <div class="callout callout-success">
          <h4>Alterado com sucesso:</h4>
          <p><?php echo $_SESSION['avisoConfig'] ?></p>
        </div>
    <?php
        unset($_SESSION['avisoConfig']);
      endif;
    ?>
      <!-- Default box -->
      <div class="box" id="form">
        <form action="post.php" id="formulario" method="post" enctype="multipart/form-data" autocomplete="off">
          <input type="password" style="display:none">
          <input type="hidden" id="numPost" name="numPost" value="8"><!-- Número correspodente ao post -->
          <div class="box-body">
            <div class="form-group col-xs-6">
              <label>Nome:</label>
              <input type="text" class="form-control" name="nome" disabled="true" <?php echo 'value="'.$nomeUser.'"'?>>
            </div>
            <div class="form-group col-xs-6">
              <label>E-mail:</label>
              <input type="text" class="form-control" name="email" disabled="true" <?php echo 'value="'.$email.'"'?>>
            </div>
            <?php
              if($_SESSION['nivel'] > 2){
                $db_aux = atalhos::getBanco();
                if($aux = $db_aux->prepare("SELECT criado FROM tbemail WHERE idUser = ?")){
                  $aux->bind_param('i', $_SESSION['id']);
                  $aux->execute();
                  $aux->bind_result($criado);
                  if($aux->fetch()){
                    if($criado == 0){
                      echo '<div class="form-group col-xs-8">
                      <a href="/configuracao/emailDcomp" <span class="btn btn-success disabled">Requisitar E-mail Dcomp</span></a>
                    </div>';
                    }
                  }else{
                    echo '<div class="form-group col-xs-8">
                    <a href="/configuracao/emailDcomp" <span class="btn btn-success">Requisitar E-mail Dcomp</span></a>
                  </div>';
                  }
                }
                $db_aux->close();
              }
              if($_SESSION['nivel'] == 0){
                echo '<div class="form-group col-xs-8">
                    <a href="/configuracao/termo-de-uso/editar" <span class="btn btn-success">Editar termo de uso</span></a>
                  </div>';
              }
            ?>
            <div class="form-group col-xs-8">
              <label>Imagem:</label>
              <input type="file" name="imagem">
            </div>
            <?php
              if($query = $db->prepare("SELECT * FROM tbimagem WHERE idUser= ? ")){
                $query->bind_param('i', $_SESSION['id']);
                $query->execute();
                $query->store_result();
                $total = $query->num_rows;
                $query->close();
              }
              if ($total > 0):
            ?>
              <div class="checkbox col-xs-8">
                <label>
                  <input type="checkbox" name="exImagem"> Excluir minha foto
                </label>
              </div>
            <?php
              endif;
            ?>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Atualizar</button>
          </div>
        </form>
      </div><!-- /.box -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <?php include 'rodape.php' ?>
</div><!-- ./wrapper -->
  <?php include 'script.php' ?>
</body>
</html>
