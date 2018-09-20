<style type="text/css">
  .product .img-responsive {
    margin: 0 auto;
  }
</style>
<body class="skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="/inicio" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>DCP</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>DCOMP</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <?php if($_SESSION['logado']): ?>
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <?php
                    $db = Atalhos::getBanco();
                    if ($query = $db->prepare("SELECT b.notificacao, b.statusNoti FROM tbnoticonexao a
                      inner join tbnotificacao b on a.idNoti = b.idNoti 
                      WHERE a.idUser = ? AND b.statusNoti = 0")){
                      $query->bind_param('i', $_SESSION['id']);
                      $query->execute();
                      $query->store_result();
                      $total = $query->num_rows;
                      if ($total > 0) {
                        echo '<span class="label label-warning">'.$total.'</span>';
                      }
                      $query->close();
                    }
                  ?>
                </a>
                <ul class="dropdown-menu">
                  <?php
                    if ($query = $db->prepare("SELECT b.notificacao, b.statusNoti FROM tbnoticonexao a
                      inner join tbnotificacao b on a.idNoti = b.idNoti 
                      WHERE a.idUser = ? ORDER BY a.idNoti DESC")){
                      $query->bind_param('i', $_SESSION['id']);
                      $query->execute();
                      $query->bind_result($notificacao, $statusNoti);
                      $query->store_result();
                      $total = $query->num_rows;

                      if($total > 0){
                        echo '<li><ul class="menu">';
                        while($query->fetch()){ 
                          if($statusNoti == 1){
                            $aux = str_replace('style="background-color: #EFEEEE"', '', $notificacao);
                          }else{
                            $aux = $notificacao;
                          }
                          echo html_entity_decode($aux);
                        }
                        echo '</ul></li>';
                      }else{
                        echo '<li class="footer"><a>Você não tem notificações</a></li>';
                      }
                      $query->close();
                    }
                  ?>
                </ul>
              </li>
              <?php if(!$_SESSION['ativo']): ?>
                <li class="dropdown notifications-menu" >
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-warning text-yellow"></i>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <?php
                        if ($query = $db->prepare('SELECT dataInicio, dataFim, motivoBlock
                            FROM tbblock WHERE idUserBlock = ? 
                            ORDER BY idBlock DESC LIMIT 1')){
                          $query->bind_param('i', $_SESSION['id']);
                          $query->execute();
                          $query->bind_result($dataInicio, $dataFim, $motivoBlock);
                          $query->fetch();

                          echo '<b>Sua conta está inativa!</b><br>';
                          echo "<b>Data de Inicio:</b> ".date("d/m/y", strtotime($dataInicio))."<br>";
                          echo "<b>Data de Fim:</b> ".date("d/m/y", strtotime($dataFim))."<br>";
                          echo "<b>Motivo:</b> ".$motivoBlock."<br>";
                          echo '<b>Para Ativar sua conta é necessario que após o dia do fim você requisite na secretaria.</b>';
                        $query->close();
                        $db->close();
                        }
                      ?>
                    </li>
                  </ul>
                </li>
              <?php endif; ?>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <?php
                    echo "<img height='20' width='20' class='img-circle' src='getImagem.php?idUser=".$_SESSION['id']."' >"; 
                  ?>
               
                  <span class="hidden-xs"><?php echo Atalhos::nome($_SESSION['nome']) ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-body">
                    <?php
                      echo "
                      <div class='img-circle center-block' style='background-image: url(getImagem.php?idUser=".$_SESSION['id']."); background-size: 100% 100%;height: 160px;width: 160px;'></div>";
                    ?>
                    <div style="text-align: center;">
                      <strong>
                        <?php echo '<span style="font-size: 12pt;">'.Atalhos::nome($_SESSION['nome']).'</span>'?>
                      </strong>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="/perfil/<?php echo $_SESSION['id'] ?>/" class="btn btn-default">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <form action = "post2.php" method = "post">
                        <input type="hidden" name="numPost" value="2"><!-- Número correspodente ao post -->
                        <button type="submit" class="btn btn-default">Sair</button>
                      </form>
                    </div>
                  </li>
                </ul>
              </li>
            <?php else: ?>
              <!-- Fazer login -->
              <?php if(isset($_SESSION['errorLogin'])):?>
                <li class="dropdown user user-menu open">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <?php
                $error = '<div class="form-group">
                            <weak>
                              <span class="label center-block" style="background-color: #FF0000; font-size: 9pt;">'
                              .$_SESSION['errorLogin'].'</span>
                            </weak>
                          </div>';
                unset($_SESSION['errorLogin']);
                else:
                  $error = null;
              ?>
                  <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <?php endif; ?>
                      <img height='20' width='20' src="img/door5.png" class="user-image" alt="User Image"/>
                      <span class="hidden-xs">Login</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="user-body">
                        <form action = "post2.php" method = "post">
                          <input type="hidden" name="numPost" value="1"><!-- Número correspodente ao post -->
                          <div class="form-group has-feedback">
                            <input type="text" name="usuario" class="form-control" placeholder="Usuário do SIGAA"/>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                          </div>
                          <div class="form-group has-feedback ">
                            <input type="password" name="senha" class="form-control" placeholder="Senha do SIGAA"/>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                          </div>
                          <?php 
                            echo $error;
                            if(isset($_SESSION['numTent']) && $_SESSION['numTent'] >= 3):
                          ?>
                            <div class="g-recaptcha" data-sitekey="6Lf3CxETAAAAAHuwxkM5zD0MjgQWCIv3t6wigs_5" 
                              data-size="compact"></div>
                          <?php endif; ?>
                      </li>
                      <li class="user-footer">
                        <div class="row">
                          <div class="col-xs-4 pull-right">
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                          </div><!-- /.col -->
                          <div class="col-xs-6 pull-left">
                            <?php
                              if(isset($authUrl)){
                                echo '<a class="btn btn-social btn-default" href="'. $authUrl .'"data-toggle="tooltip" 
                          title="Somente contas @dcomp.ufs.br"><i class="fa fa-google"></i>Entrar com Google</a></a>';
                              }
                            ?>
                          </div>
                        </div>
                      </li>
                        </form>
                    </ul>
                  </li>
            <!-- Control Sidebar Toggle Button -->
            <?php endif; ?>
          </ul>
        </div>
      </nav>
    </header>