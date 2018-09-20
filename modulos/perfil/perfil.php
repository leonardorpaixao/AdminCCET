<?php
  include '../../includes/topo.php';
  if(isset($_GET['id'])){
    $idUser = $_GET['id'];
  }else{
    header('Location: /inicio');
  }
?>
  <title>AdminDcomp - Perfil do Usuário</title>
</head>
<?php
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $_SESSION['irPara'] = '/inicio';
  $db = Atalhos::getBanco();
  if ($query = $db->prepare('SELECT a.login, c.afiliacao, AES_DECRYPT(a.email, ?), a.nomeUser, a.statusUser, c.nivel, a.nivel, a.idAfiliacao, a.statusLogin , c.nivel, a.sudo FROM tbusuario a inner join tbafiliacao c on a.idAfiliacao = c.idAfiliacao WHERE a.idUser = ?')){
    $query->bind_param('si', $_SESSION['chave'], $idUser);
    $query->execute();
    $query->bind_result($login, $afiliacao, $email, $nomeUser, $statusUser, $nivel, $nivelReal, $idAfiliacao, $statusLogin, $nivelAfiliacao, $sudo);
    $query->fetch();
    $query->close();
  }
  $db->close();
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Perfil do Usuário
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Notificações da página -->
      <?php if(isset($_SESSION['alterDados'])): ?>
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
        <!-- Verificar este IF depois, esse nível == 3 tá estranho... -->
        <?php if($nivel == 3 || ($_SESSION['logado'] && ($_SESSION['nivel'] < 2 || $_SESSION['id'] == $_GET['id']))): ?>
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
              <div class="box-body box-profile">
                <center>
                  <div class="img-circle center-block" style="background-image: url('getimagem/<?php echo $idUser ?>/'); background-size: 100% 100%;height: 160px;width: 160px;"></div>
                </center>
                <?php
                  if($_SESSION['logado']){
                    $db = Atalhos::getBanco();
                    //Verifica se o usuário possui uma foto
                    if($query = $db->prepare('SELECT idUser FROM tbimagem WHERE idUser = ?')){
                      $query->bind_param('i', $idUser);
                      $query->execute();
                      $query->bind_result($imagem);
                      if($query->fetch()){//exiba o botão para excluir a foto do usuário
                        echo '<a data-toggle="modal" data-target="#simples" data-solict-id="'.$idUser.'" data-solict-tipo="6" data-solict-frase="Excluir a foto deste usuário"><p align="center"><b>Excluir Foto</b></p></a>';
                      }
                      $query->close();
                    }
                    $db->close();
                    echo '<h3 class="profile-username text-center">'.$nomeUser.'</h3><p class="text-muted text-center">'.$login.'</p>';
                    //Verifica se é um administrador
                    if($_SESSION['nivel'] == 0){
                      if($statusUser == 'Ativo'){//exiba as opções para ativar ou inativar um usuário
                        echo '<a class="btn btn-default btn-block" data-toggle="modal" data-target="#block" data-solict-id="'.$idUser.'"data-solict-tipo="2" data-solict-frase="Inativar Usuário">
                              <i class="fa fa-user-times"></i> Inativar Usuário </a>';
                      }else{
                        echo '<a class="btn btn-default btn-block" data-toggle="modal" data-target="#block" data-solict-id="'.$idUser.'" data-solict-tipo="1" data-solict-frase="Ativar Usuário">
                              <i class="fa  fa-user-plus"> </i> Ativar Usuário</a>';
                      }
                      if($statusLogin >= 0){//Se o usuário NÃO estiver banido, exiba a opção para alterar a quantidade de acessos
                        echo '<a class="btn btn-default btn-block" data-toggle="modal" data-target="#multiacesso" data-solict-id="'.$idUser.'"data-solict-tipo="2" data-solict-frase="Alterar quantidade de acessos">
                              <i class="fa fa-desktop"></i> Alterar quantidade de acessos </a>';
                      }
                      if($nivel != 4){//Se NÃO for um aluno, exiba as opções para ativar e desativar sudo
                        if($sudo == 'Ativo'){
                          echo '<a class="btn btn-default btn-block" data-toggle="modal" data-target="#simples" data-solict-id="'.$idUser.'" data-solict-tipo="3" data-solict-frase="Retirar sudo do Usuário">
                                <i class="fa fa-linux"></i> Desativar Sudo</a>';
                        }else{
                          echo '<a class="btn btn-default btn-block" data-toggle="modal" data-target="#simples" data-solict-id="'.$idUser.'" data-solict-tipo="4" data-solict-frase="Dar sudo ao Usuário">
                                <i class="fa fa-linux"></i> Ativar Sudo</a>';
                        }
                      }else{//Se for um aluno, exiba o histório de bloqueio
                          echo '<a class="btn btn-default btn-block" data-toggle="modal" data-target="#historico">
                                <i class="fa fa-file-text"></i> Historico de Bloqueio</a>';
                      }
                      if($_GET['id'] == $_SESSION['id']){//Se o administrador estiver no seu perfil, exiba a opção para editar temos de uso
                        echo '<a href="/perfil/termo-de-uso/editar" class="btn btn-default btn-block"/>Editar Termo de Uso</a>';
                      }
                      //Opção para alterar as informações de qualquer usuário
                      echo '<a class="btn btn-default btn-block" data-toggle="modal" data-target="#info" data-solict-id="'.$idUser.'" data-solict-tipo="1" data-solict-frase="Alterar Informações">
                            <i class="fa fa-wrench"></i> Alterar Informações</a>';
                    }else{//Se eu NÃO for um administrador
                      if ($_SESSION['id'] == $_GET['id']){//Se está acessando o seu próprio perfil
                        if($_SESSION['nivel'] > 2){//Se for um aluno ou nível inferior
	                        $db_aux = atalhos::getBanco();
	                        if($aux = $db_aux->prepare("SELECT criado FROM tbemail WHERE idUser = ?")){
	                          $aux->bind_param('i', $_SESSION['id']);
	                          $aux->execute();
	                          $aux->bind_result($criado);
	                          if($aux->fetch()){//Exiba a opção para requisitar um email institucional
	                            if($criado == 0){
	                              echo '<a href="/perfil/alterar_senha/" class="btn btn-success btn-block disabled"/>Alterar Senha</a>';
	                            }
	                          }else{
	                            echo '<a href="/perfil/alterar_senha/" class="btn btn-success btn-block"/>Alterar Senha </a>';
	                          }
	                        }
	                        $db_aux->close();
	                      }
	                      if(isset($imagem)){//Se possuir imagem, exiba a opção para alterar foto
	                        echo '<a class="btn btn-default btn-block" data-toggle="modal" data-target="#foto" data-solict-id="'.$idUser.'" data-solict-tipo="2" data-solict-frase="Alterar Foto"><i class="fa fa-user"></i> Alterar Foto</a>';
	                      }else{//Se NÃO possuir, exiba a opção para adicionar foto
	                        echo '<a class="btn btn-default btn-block" data-toggle="modal" data-target="#foto" data-solict-id="'.$idUser.'" data-solict-tipo="1" data-solict-frase="Adicionar Foto"><i class="fa fa-user"></i> Adicionar Foto</a>';
	                      }
	                    }
                      //Opção para o usuário alterar as informações da conta
                      //echo '<a class="btn btn-default btn-block" data-toggle="modal" data-target="#info" data-solict-id="'.$idUser.'" data-solict-tipo="1" data-solict-frase="Alterar Informações">
                            //<i class="fa fa-wrench"></i> Alterar Informações</a>';
                    }
                  }else{//Se está deslogado ou não está em seu perfil, exiba somente o nome do usuário
                    echo '<h3 class="profile-username text-center">'.$nomeUser.'</h3><p class="text-muted text-center">'.$login.'</p>';
                  }
                ?>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
          <!-- Informaçãos sobre o usuário -->
          <div class="col-md-9">
            <!-- /.box-header -->
            <div class="nav-tabs-custom">
            <div class="box-header with-border">
                <h3 class="box-title">Sobre mim</h3><a href="javascript:history.go(-1)"><span class="btn-sm btn-primary pull-right">Voltar</span></a>
            </div>
              <div class="tab-content">
                <?php

                  $i = 1;
                  $aux_db = atalhos::getBanco();
                  if($_SESSION['logado'] && $_SESSION['nivel'] < 3){//Se estiver logado e for da secretaria ou administrador, exiba o telefone
                    if($query = $aux_db->prepare('SELECT AES_DECRYPT(numTelefone, ?) FROM  tbtelefone WHERE idUser = ?')){
                      $query->bind_param('si', $_SESSION['chave'], $idUser);
                      $query->execute();
                      $query->bind_result($numTelefone);
                      $query->store_result();
                      $total = $query->num_rows;

                      while($query->fetch()){
                        if($total > 1){
                          echo '<strong><i class="fa fa-phone margin-r-5"></i>  Telefone '.$i++.'</strong><p class="text-muted">'.$numTelefone.'</p><hr>';
                        }else{
                          echo '<strong><i class="fa fa-phone margin-r-5"></i>  Telefone</strong><p class="text-muted">'.$numTelefone.'</p><hr>';
                        }
                      }
                    }
                  }
                  if($nivel == 4){//Se o usuário for um aluno, exiba a matricula
                    echo '<strong><i class="fa fa-book margin-r-5"></i>  Curso</strong><p class="text-muted">'.$afiliacao.'</p><hr>';
                    if ($aux = $aux_db->prepare('SELECT matricula FROM tbmatricula WHERE idUser = ?')){
                      $aux->bind_param('i', $idUser);
                      $aux->execute();
                      $aux->bind_result($matricula);
                      $aux->fetch();
                      echo '<strong><i class="fa fa-graduation-cap margin-r-5"></i>  Matrícula</strong><p class="text-muted">'.$matricula.'</p><hr>';
                      $aux->close();
                    }
                  }else{//Se NÃO for um aluno, exiba as informações do cargo
                    echo '<strong><i class="fa fa-briefcase margin-r-5"></i>  Cargo</strong><p class="text-muted">'.$afiliacao.'</p><hr>';
                    if($_SESSION['logado'] && $_SESSION['nivel'] < 2){//Se é um administrador, exiba as informações do SUDO
                      if($sudo == 'Ativo'){
                        echo '<strong><i class="fa fa-file-text margin-r-5"></i>  Sudo</strong><p class="text-muted">Ativado</p><hr>';
                      }else{
                        echo '<strong><i class="fa fa-file-text margin-r-5"></i>  Sudo</strong><p class="text-muted">Desativado</p><hr>';
                      }
                    }
                  }
                  $aux_db->close();
                ?>
                <!-- Informações do email -->
				        <strong><i class="fa fa-envelope margin-r-5"></i>  E-mail Principal</strong>
                <p class="text-muted"><?php echo $email; ?></p>
                <?php
                  $aux_db = atalhos::getBanco();
                  //Procura se o usuário possuí um email institucional
                  if ($aux = $aux_db->prepare('SELECT AES_DECRYPT(email, ?) FROM tbemail WHERE idUser = ? AND criado = 1')){
                    $aux->bind_param('si', $_SESSION['chave'], $idUser);
                    $aux->execute();
                    $aux->bind_result($email2);
                    if($aux->fetch()){
                      if($email != $email2)//Se o email institucional for DIFERENTE do email SIGAA, exiba o email institucional
                        echo '<hr><strong><i class="fa fa-envelope margin-r-5"></i>  E-mail Dcomp</strong><p class="text-muted">'.$email2.'@dcomp.ufs.br</p>';
                    }elseif($_SESSION['nivel'] > 3){//Se o usuário não possuir um email institucional e é um aluno, exiba:
                      echo '<hr><strong><i class="fa fa-envelope margin-r-5"></i>  E-mail Dcomp</strong><p class="text-muted">Não possui</p>';
                    }
                    $aux->close();
                  }
                  $aux_db->close();
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

  <!-- Modal genérico para diversas ações, sendo modificada a sua função pelo $_POST['acao'] -->
  <div class="modal fade" id="simples" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel"></h4>
        </div>
        <form role="form" action="post/" method="post" name="formulario1" id="formulario1">
        <div class="modal-body">
          <input type="hidden" id="numPost" name="numPost" value="5"><!-- Número correspodente ao post -->
          <input type="hidden" name="idUser" id="idUser"/>
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

  <!-- Modal para realizar o bloqueio do usuário -->
  <div class="modal fade" id="block" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel"></h4>
        </div>
        <form role="form" action="post/" method="post" name="formulario1" id="formulario1">
        <div class="modal-body">
          <input type="hidden" id="numPost" name="numPost" value="5"><!-- Número correspodente ao post -->
          <input type="hidden" name="idUserBlock" id="idUserBlock" />
          <input type="hidden" name="acao2" id="acao2"/>
          <?php if($statusUser == 'Ativo'): ?>
            <input type="hidden" name="idUser2" id="idUser2" value="<?php echo $_SESSION['id'] ?>"/>
            <div class="form-group">
              <label>Selecionar Duração:</label>
              <select name="duracao" class="form-control">
                <option value="2">2 Dias</option>
                <option value="5">5 Dias</option>
                <option value="10">10 Dias</option>
                <option value="15">15 Dias</option>
                <option value="30">30 Dias</option>
              </select>
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label">Motivo: (obrigatorio)</label>
              <textarea class="form-control" name="motivo"></textarea>
            </div>
          <?php else:
       	    $aux_db = Atalhos::getBanco();
            if ($query = $aux_db->prepare('SELECT dataFim, dataInicio, idBlock, motivoBlock FROM tbblock WHERE idUserBlock = ? ORDER BY idBlock DESC LIMIT 1')){
              $query->bind_param('i', $idUser);
              $query->execute();
              $query->bind_result($dataFim, $idBlock, $dataInicio, $motivoBlock);
              $query->fetch();
              echo '<input type="hidden" name="dataFim" value="'.$dataFim.'"/>
                    <input type="hidden" name="idBlock" value="'.$idBlock.'"/>';
              echo "<label>Data de Inicio: ".date("d/m/y", strtotime($dataInicio))."</label><br>";
              echo "<label>Data de Fim: ".date("d/m/y", strtotime($dataFim))."</label>";
              echo "<div><label>Motivo: </label>".$motivoBlock."</div>";
            }
            $query->close();
            $aux_db->close();
            endif;
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Confirmar</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal para definir o numero de acessos simultâneos -->
  <div class="modal fade" id="multiacesso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel"></h4>
        </div>
        <form role="form" action="post/" method="post" name="formulario1" id="formulario1">
        <div class="modal-body">
          <input type="hidden" id="numPost" name="numPost" value="5"><!-- Número correspodente ao post -->
          <input type="hidden" name="idUserAcesso" id="idUserAcesso" />
          <input type="hidden" name="acao4" id="acao4"/>

          <?php
       	    $aux_db = Atalhos::getBanco();
            if ($query = $aux_db->prepare('SELECT statusLogin FROM tbusuario WHERE idUser = ? ORDER BY idUser DESC LIMIT 1')){
              $query->bind_param('i', $idUser);
              $query->execute();
              $query->bind_result($stslogin);
              $query->fetch();
              echo '<div><label>Digite a quantidade:</label> <input type="number" name="qtdeAcessos" min="0" max="100" value="'.$stslogin.'"></div>
                    <div><label>Regras:</label><p>0: Bloqueado</p><p>1: Acesso único (padrão)</p>> 1: Quantidade de PCs que deseja permitir acesso múltiplo</p></div>';
            }
       		  $query->close();
            $aux_db->close();
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Confirmar</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal para editar as informações gerais do usuário -->
  <div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel"></h4>
        </div>
        <form role="form" action="post/" method="post" name="formulario1" id="formulario1">
        <div class="modal-body">
          <input type="hidden" id="numPost" name="numPost" value="5"><!-- Número correspodente ao post -->
          <input type="hidden" name="idUser3" id="idUser3"/>
          <input type="hidden" name="acao3" id="acao3"/>
          <?php
          echo '<input type="hidden" name="user" value="'.$login.'" />
                <input type="hidden" name="nivel" value="'.$nivel.'" />';
          ?>
          <div class="form-group col-xs-6">
            <label>Nome:</label>
            <input type="text" class="form-control" name="nome" disabled="true" <?php echo 'value="'.$nomeUser.'"'?>>
          </div>
          <div class="form-group col-xs-6">
            <label>Login:</label>
            <input type="text" class="form-control" name="login" disabled="true"<?php echo 'value="'.$login.'"'?>>
          </div>
          <div class="form-group col-xs-6">
            <label>Email:</label>
            <input type="text" class="form-control" name="email" disabled="true" <?php echo 'value="'.$email.'"'?>>
          </div>
          <?php
            $aux_db = atalhos::getBanco();
            //Procura se o usuário possuí um email institucional
            if ($aux = $aux_db->prepare('SELECT AES_DECRYPT(email, ?) FROM tbemail WHERE idUser = ? AND criado = 1')){
              $aux->bind_param('si', $_SESSION['chave'], $idUser);
              $aux->execute();
              $aux->bind_result($emaildcomp);
              $aux->fetch();
              $aux->close();
            }$aux_db->close();
          ?>
          <?php if($nivelReal == 4): //Se for um aluno, exbia as informações da matricula ?>
            <div class="form-group col-xs-6">
              <label>Email DCOMP:</label>
              <input type="text" class="form-control" name="email-dcomp-disabled" disabled="true" <?php echo 'value="'.$emaildcomp.'@dcomp.ufs.br"'?>>
            </div>
            <div class="form-group col-xs-6">
              <label>Matricula:</label>
              <input type="number" class="form-control" name="matricula" disabled="true"<?php echo 'value="'.$matricula.'"'?>>
            </div>
          <?php elseif($nivelReal < 4): //Se NÃO for um aluno ?>
            <div class="form-group col-xs-3">
              <label>Email DCOMP:</label>
              <input type="text" class="form-control" name="email-dcomp" <?php echo 'value="'.$emaildcomp.'"'?>>
            </div>
            <div class="form-group col-xs-3">
              <label>.</label>
              <input type="text" class="form-control" name="sufixo" disabled="true" <?php echo 'value="@dcomp.ufs.br"'?>>
            </div>
          <?php endif; ?>
          <?php if($_SESSION['nivel'] == 0): //Se um administrador estiver acessando, exiba: ?>
            <div class="form-group col-xs-6">
              <label for="email">Afiliação:</label> <!-- Opção para alterar a afiliação do usuário -->
              <select name="idAfiliacao" id="idAfiliacao" class="form-control" onchange="NovoTipo(this.value);">
                <?php
                  echo '<option value="-1">Adicionar Nova Afiliação</option>';
  				        $aux_db = Atalhos::getBanco();
                  if ($query =  $aux_db->prepare("SELECT idAfiliacao, afiliacao FROM tbafiliacao WHERE afiliacao != ?")){
                    $query->bind_param('s', $afiliacao);
                    $query->execute();
                    $query->bind_result($aux_idAfiliacao, $aux_afiliacao);
                    echo '<option value="'.$idAfiliacao.'" selected="true">'.$afiliacao.'</option>';
                    while($query->fetch()){
                      echo '<option value="'.$aux_idAfiliacao.'">'.$aux_afiliacao.'</option>';
                    }
                    $query->close();
                  }
                  $aux_db->close();
                ?>
              </select>
            </div>
            <div class="form-group" id="txtHint"></div>
            <div class="form-group col-xs-6">
              <label for="email">Nível:</label><!-- Opção para alterar o nível do usuário -->
              <select name="idNivel" id="idNivel" class="form-control"">
               <?php
               		for($i = 0; $i < 5; $i++){
                    switch ($i) {
                      case '0':
                        $nomeNivel = "Administrador";
                        break;
                      case '1':
                        $nomeNivel = "Secretaria";
                        break;
                      case '2':
                        $nomeNivel = "Técnico";
                        break;
                        case '3':
                        $nomeNivel = "Professor";
                        break;
                      case '4':
                        $nomeNivel = "Aluno";
                        break;
                    }
               			if($i == $nivelReal){
                      echo '<option value="'.$i.'" selected="true">'.$nomeNivel.'</option>';
                    }else{
                    	echo '<option value="'.$i.'">'.$nomeNivel.'</option>';
                  	}
               		}
                ?>
              </select>
            </div>
          <?php endif; ?>
        </div>
        <div class="modal-footer">
          <div class="form-group col-xs-12">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Confirmar</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal para exibir o histórico de bloqueio do usuário -->
  <div class="modal fade" id="historico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel"> Historico de Bloqueio</h4>
        </div>
        <div class="modal-body">
          <?php
            $aux_db = Atalhos::getBanco();
            if($query = $db->prepare('SELECT dataFim, idBlock, dataInicio, motivoBlock FROM tbblock WHERE idUserBlock = ? ORDER BY idBlock DESC')){
              $query->bind_param('i', $idUser);
              $query->execute();
              $query->bind_result($dataFim, $idBlock, $dataInicio, $motivoBlock);
              $query->store_result();
              $total = $query->num_rows;
              if($total > 0){
                echo '<table class="table table-hover">
                      <th><center>Inicio</center></th>
                      <th><center>Fim</center></th>
                      <th><center>Motivo</center></th>';
                while($query->fetch()){
                  echo '<tr align="center"><td>'.date("d/m/y", strtotime($dataInicio)).'</td>
                        <td>'.date("d/m/y", strtotime($dataFim)).'</td>
                        <td>'.wordwrap($motivoBlock, 60, "<br>", false).'</td></tr>';
                }
                echo '</table>';
              }else{
                echo 'Não há registro de bloqueio a este usuário';
              }
              $query->close();
            }
            $aux_db->close();
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para adicionar foto -->
  <div class="modal fade" id="foto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel"></h4>
        </div>
        <form role="form" action="post/" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" id="numPost" name="numPost" value="8"><!-- Número correspodente ao post -->
          <input type="hidden" name="id" id="id"/>
          <input type="hidden" name="tipo" id="tipo"/>
          <label>Imagem:</label>
          <input type="file" name="imagem">
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
  include '../../includes/rodape.php';
  include '../../includes/script.php';
?>

  <script>
    $('#simples').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var tipo = button.data('solict-tipo')
      var frase = button.data('solict-frase')
      var id = button.data('solict-id')
      var modal = $(this)
      modal.find('.modal-title').text(frase)
      $('#idUser').val(id)
      $('#acao').val(tipo)
    });
    $('#block').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var tipo = button.data('solict-tipo')
      var frase = button.data('solict-frase')
      var id = button.data('solict-id')
      var modal = $(this)
      modal.find('.modal-title').text(frase)
      $('#idUserBlock').val(id)
      $('#acao2').val(tipo)
    });
    $('#multiacesso').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var tipo = button.data('solict-tipo')
      var frase = button.data('solict-frase')
      var id = button.data('solict-id')
      var modal = $(this)
      modal.find('.modal-title').text(frase)
      $('#idUserAcesso').val(id)
      $('#acao4').val(tipo)
    });
    $('#blockpcs').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var tipo = button.data('solict-tipo')
      var frase = button.data('solict-frase')
      var id = button.data('solict-id')
      var modal = $(this)
      modal.find('.modal-title').text(frase)
      $('#idUserBlockpcs').val(id)
      $('#acao5').val(tipo)
    });
     $('#info').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var tipo = button.data('solict-tipo')
      var frase = button.data('solict-frase')
      var id = button.data('solict-id')
      var modal = $(this)
      modal.find('.modal-title').text(frase)
      $('#idUser3').val(id)
      $('#acao3').val(tipo)
    });
    $('#foto').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var tipo = button.data('solict-tipo')
      var frase = button.data('solict-frase')
      var id = button.data('solict-id')
      var modal = $(this)
      modal.find('.modal-title').text(frase)
      $('#id').val(id)
      $('#tipo').val(tipo)
    });
    function NovoTipo(str) {
      if(str != -1 || str == ''){
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
        xmlhttp.open("GET","novotipo/Nova Afiliação/novaAfiliacao/",true);
        xmlhttp.send();
      }
    }
  </script>
</body>
</html>
