<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
  include '../../includes/sessao.php';

  if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['logado']){
    switch ($_POST['numPost']){
      case 1://Calendario Equipamento
        Post::calendarioEq();
        header('Location: /equipamentos/calendario');
        break;
      case 2://Calendario Laboratorio
        Post::calendarioLab();
        header('Location: /laboratorios/calendario');
        break;
      case 3://Moderar Equipamento
        Post::moderarEq();
        header('Location: /equipamentos/moderar');
        break;
      case 4://Moderar Laboratorio
        Post::moderarLab();
        header('Location: /laboratorios/moderar');
        break;
      case 5://Perfil
        Post::perfil();
        break;
      case 8://Configurações
        Post::foto();
        break;
      case 9://Equipamentos
        Post::equipamento();
        header('Location: /recursos/equipamentos');
        break;
      case 10://Laboratórios
        Post::laboratorio();
        header('Location: /recursos/laboratorios');
        break;
      case 11://Adcionando Equipamentos
        Post::eqpAdd();
        header('Location: /recursos/equipamentos');
        break;
      case 12://Adicionando Laboratórios
        Post::labAdd();
        break;
      case 14:
        Post::contaTempEdit();
        header('Location: /recursos/contas-temporarias');
        break;      case 15://Editando Equipamentos
        Post::eqpEdit();
        header('Location: /recursos/equipamentos');
        break;
      case 16://Editando Laboratórios
        Post::labEdit();
        header('Location: /recursos/laboratorios');
        break;
      case 17://Editando Laboratórios
        Post::eqpEntregar();
        header('Location: /equipamentos/moderar');
        break;
      case 18://Mudar Escolha de Laboratório
        Post::changeLab();
        header('Location: /laboratorios/moderar');
        break;
      case 19://Adicinar Cor
        Post::corAdd();
        break;
      case 20://Adicionar Requerimento
        Post::reqAdd();
        header('Location: /requerimentos/inserir/'.$_POST['tipoReq'].'/');
        break;
      case 21://Editar Requerimento 1
        Post::reqEdit();
        header('Location: /requerimentos/editar/'.$_POST['tipoReq'].'/'.$_POST['idReq'].'/');
        break;
      case 22:
        Post::contaTempAdd();
        //header('Location: /recursos/contas-temporarias');
        break;
      case 26:
        Post::moderarReq();
        header('Location: '.$_SESSION['irPara']);
        break;
      case 27:
        Post::meusReq();
        break;
      case 28:
        Post::meusEqp();
        header('Location: /equipamentos/meus');
        break;
      case 29:
        Post::meusLab();
        header('Location: /laboratorios/meus');
        break;
      case 31: //Inativa/Ativa/Exclue Avisos
        Post::avisosStatus();
        header('Location: /avisos');
        break;
      case 32://Adicionar Avisos
        Post::avisoAdd();
        header('Location: /avisos/adicinar');
        break;
      case 33://Editar Avisos
        Post::avisoEdit();
        header('Location: /avisos/editar/'.$_POST['idAviso'].'/');
        break;
      case 34://Adicionar Salas
        Post::salaAdd();
        break;
      case 35://Editar Salas
        Post::salaEdit();
        break;
      case 36://Status Salas
        Post::salaStatus();
        break;
      case 37://Calendario Salas
        Post::calendarioSala();
        header('Location: /salas/calendario');
        break;
      case 38://Moderar Salas
        Post::moderarSala();
        header('Location: /salas/moderar');
        break;
      case 39://Minhas Salas
        Post::minhaSala();
        header('Location: /salas/minhas');
        break;
      case 40:
        Post::addPacote();
        header('Location: /repositorio');
        break;
      case 41:
        Post::rmvRepo();
        header('Location: /repositorio');
        break;
      case 42:
        Post::atualizaRepo();
        header('Location: /repositorio');
        break;
      case 43:
        Post::addTickets();
        header('Location: /tickets/meus');
        break;
      case 44:
        Post::logTickets();
        break;
      case 46:
        Post::addTermo();
        header('Location: /configuracao');
        break;
      case 47:
        Post::attBase();
        header('Location: /atualizar');
        break;
      case 49:
        Post::alterarPrazo();
        header('Location: /requerimentos/configurar');
        break;
      case 50://Disciplinas
        Post::disciplina();
        header('Location: /recursos/disciplinas');
        break;
      case 51://Atualizar Disciplinas:
        Post::attDiscriplina();
        header('Location: /recursos/disciplinas');
        break;
      case 52:
        Post::moderarBugs();
        header('Location: /moderar/bugs');
        break;
    }
  }else{
    $_SESSION['avisoIndex'] = 1;
    header('Location: /inicio');
  }

  class Post{

    public static function contaTempAdd(){
      $db = Atalhos::getBanco();
      if($ping = Atalhos::serviceping($_SESSION['ldaphost'])){
        if($query = $db->prepare("INSERT INTO tbcontatemp (nomeConta, login, statusConta, numAcesso, dataInicio, dataFim) VALUES (?, ?, ?, ?, ?, ?)")){
          $subdata = explode(" - ", $_POST['data']);
          $dataInicio = str_replace('/', '-', $subdata[0]);
          $dataFim = str_replace('/', '-', $subdata[1]);
          if(date_create($dataInicio) > date_create(date("Y-m-d", strtotime('now')))){
            $status = 'Inativo';
          }else{
            $status = 'Ativo';
          }
          $query->bind_param('sssiss', $_POST['nome'], $_POST['login'], $status, $_POST['numAcesso'], $dataInicio, $dataFim);
          echo $_POST['nome']." ". $_POST['login']." ". $status." ". $_POST['numAcesso']." ".$dataInicio." ".$dataFim." ".$_POST['senha'];
          $query->execute();
          $query->close();
          $senha = $_SESSION['adminPass'];
          $ds = ldap_connect("ldaps://{$_SESSION['ldaphost']}") or die("Conexão recusada");
          $ldaprdn  = "uid={$login},ou=pessoas,dc=computacao,dc=ufs,dc=br";
          if($ds){
            ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
            $ldapbind = ldap_bind($ds, $ldaprdn, openssl_decrypt(hex2bin ($senha), 'aes-256-cbc', $_SESSION['k'], true, 
              $_SESSION['iv']));
            if($ldapbind){
        		echo "teste";
              $encpass = Atalhos::make_ssha_password($_POST['senha']);
              $aux1 = strtolower($_POST['nome']);
              $aux = explode(" ", $aux1);
              $num = count($aux);
              $cn = $aux[0];
              $sn = $aux[$num-1];
              $ldaprecord = array();
              $ldaprecord['objectclass'][5] = "top";
              $ldaprecord['objectclass'][2] = "person";
              $ldaprecord['objectclass'][1] = "organizationalPerson";
              $ldaprecord['objectclass'][0] = "inetOrgPerson";
              $ldaprecord['objectclass'][3] = "posixAccount";
              $ldaprecord['objectclass'][4] = "shadowAccount";
              $ldaprecord['uid'] = $_POST['login'];
              $ldaprecord['cn'] = $cn;
              $ldaprecord['userPassword'] = $encpass;
              $ldaprecord['uidNumber']= (Atalhos::get_uidNMax($ds));
              $ldaprecord['gidNumber'] = 100;

              if(!empty($sudo)){ //se sudo estiver marcado usuário é adicionado ao grupo 10 "whell"
                $ldaprecord['gidNumber'] = 10;
              }
              $ldaprecord['sn'] = $sn;
              $ldaprecord['homeDirectory'] = "/home/{$login}";
              $ldaprecord['loginShell'] = '/bin/bash';
              $ldaprdn2 = "uid={$login},ou=pessoas,dc=computacao,dc=ufs,dc=br";
              $r = ldap_add($ds,$ldaprdn2,$ldaprecord);
              if ($r){
                if($_POST['nivelAcesso'] == '0'){
                  $ldapentry = array();
                  $ldapentry['member'] = $ldaprdn2; //DN do usuário
                  ldap_mod_add($ds,'cn=adm,ou=grupos,dc=computacao,dc=ufs,dc=br',$ldapentry);
                }
                Atalhos::set_uidNMax($ds, $ldaprecord['uidNumber']+1);
                if($afiliacao == -1){
                  if($query = $db->prepare("INSERT INTO tbafiliacao (afiliacao, nivel) VALUES (?, ?)")){
                    $query->bind_param('si', $_POST['novaAfiliacao'], $_POST['nivelAcesso']);
                    $query->execute();
                    $afiliacao = $query->insert_id;
                    $query->close(); 
                  }
                }
              }
            }
          }
        }
      }
    }

    public static function contaTempEdit(){
      if($ping = Atalhos::serviceping($_SESSION['ldaphost'])){
        $db = Atalhos::getBanco();
        if($query = $db->prepare("SELECT a.login, b.senha FROM tbusuario a inner join tbonline b on a.idUser = b.idUser 
          WHERE a.idUser = ?")){
          $query->bind_param('i', $_SESSION['id']);
          $query->execute();
          $query->bind_result($login, $senha);
          $query->fetch();
          $query->close();
        }
        $ds = ldap_connect("ldaps://{$_SESSION['ldaphost']}") or die("Conexão recusada");
        $ldaprdn  = "uid={$login},ou=pessoas,dc=computacao,dc=ufs,dc=br";
        if($ds){
          ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
          $ldapbind = ldap_bind($ds, $ldaprdn, openssl_decrypt(hex2bin ($senha), 'aes-256-cbc', $_SESSION['k'], true, 
            $_SESSION['iv']));
          if($ldapbind){
            if(isset($_POST['idconta'])){
              if($_POST['acao'] == 0){
                if($query = $db->prepare("DELETE FROM tbcontatemp WHERE idConta = ?")){
                  $query->bind_param('i',$_POST['idconta']);
                  $query->execute();
                  $query->close();
                  //Ldap para excluir
                }
              }elseif($_POST['acao'] == 1){
                if($query = $db->prepare("UPDATE tbcontatemp SET statusConta = 'Inativo' WHERE idConta = ?")){
                  $query->bind_param('i', $_POST['idconta']);
                  $query->execute();
                  $query->close();
                }
              }elseif($_POST['acao'] == 2){
                Atalhos::set_LDAPAttribute($ds, 'gidNumber', $user, 100);
              }else{
                Atalhos::set_LDAPAttribute($ds, 'gidNumber', $user, 100);
              }
            }elseif(isset($_POST['idconta2'])){
              $senhaNova = $_POST['senha'];
              $encpass = Atalhos::make_ssha_password($senhaNova);
              $entry = array();
              $entry["userPassword"] = "$encpass";
              $ldaprdn = "uid={".$_POST['login']."},ou=pessoas,dc=computacao,dc=ufs,dc=br";
              $ldapreplace = ldap_mod_replace($ds, $ldaprdn, $entry);
            }elseif(isset($_POST['idconta3'])){
              $data = date("Y-m-d", strtotime(str_replace('/', '-', $_POST['data'])));
              if(date_create($data) >= date_create(date("Y-m-d", strtotime('now')))){
                if($query = $db->prepare("UPDATE tbcontatemp SET dataFim = ?, statusConta = 'Ativo' WHERE idConta = ?")){
                  $query->bind_param('si', $data, $_POST['idconta3']);
                  $query->execute();
                  $query->close();
                }
              }else{
                $_SESSION['avisoConta'] = 1;
              }
            }else{
              if($query = $db->prepare("UPDATE tbcontatemp SET numAcesso = ? WHERE idConta = ?")){
                  $query->bind_param('ii', $_POST['numAcesso'], $_POST['idconta4']);
                  $query->execute();
                  $query->close();
                }
            }
          }
        }
        $db->close();
      }
    }

    public static function moderarBugs(){
      $db = Atalhos::getBanco();
      if($_POST['acao'] == 1){//RESOLVER BUG
        $status = "Resolvido";
        if($query = $db->prepare("UPDATE tbbugs SET status = ? WHERE idBug = ?")){
          $query->bind_param('si', $status, $_POST['id']);
          $query->execute();
          $query->close();
          $_SESSION['bugResolvido'] = 1;
          Atalhos::addLogsAcoes('Modificou', 'tbbugs', $_POST['id']);
        }
      }elseif($_POST['acao'] == 2){//DESCARTAR BUG
        $status = "Descartado";  
        if($query = $db->prepare("UPDATE tbbugs SET status = ? WHERE idBug = ?")){
          $query->bind_param('si', $status, $_POST['id']);
          $query->execute();
          $query->close();
          $_SESSION['bugDescartado'] = 1;
          Atalhos::addLogsAcoes('Modificou', 'tbbugs', $_POST['id']);
        }
      }
      $db->close();
    }

    public static function attBase(){
      $db = Atalhos::getBanco();
      $dateNow = date("Y-m-d H:i:s", strtotime("now"));
      if ($query = $db->prepare("SELECT data FROM tbatualizacao ORDER BY idAtualizacao DESC LIMIT 1")){
        $query->execute();
        $query->bind_result($data);
        $query->fetch();
        $query->close();
      }
      $date12h = date("Y-m-d H:i:s", strtotime("+12 hour", strtotime($data)));
      if ($date12h <= $dateNow){
        if($query = $db->prepare("INSERT INTO tbatualizacao (idUser, data) VALUES (?, ?)")){
          $query->bind_param('is', $_SESSION['id'], $dateNow);
          $query->execute();
          $idLogsAcoes = $query->insert_id;
          $query->close();
        }
        Atalhos::updateBD();
        $_SESSION['successAtt'] = 1;
        Atalhos::addLogsAcoes('Atualizou a base', 'tbatualizacao', $idLogsAcoes);
        $db->close();
      }else{
        $_SESSION['errorAtt'] = 1;
      }
    }

    public static function addTermo(){
      $db = Atalhos::getBanco();
      if($_POST['idTermo'] > 0){
        if($query = $db->prepare("UPDATE tbtermo SET termo = ? WHERE idTermo = ?")){
          $query->bind_param('si', $_POST['termo'], $_POST['idTermo']);
          $query->execute();
          $query->close();
        }
      }else{
        if($query = $db->prepare("INSERT INTO tbtermo (termo) VALUES (?)")){
          $query->bind_param('s', $_POST['termo']);
          $query->execute();
          $query->close();
        }
      }
      $db->close();
    }

    public static function logTickets(){
      $db = Atalhos::getBanco();
      if(isset($_POST['acao2'])){
        if($query = $db->prepare("SELECT idLog FROM tblog WHERE idTicket = ? ORDER BY idLog DESC LIMIT 1")){
          $query->bind_param('i', $_POST['idticket2']);
          $query->bind_result($idLog);
          $query->execute();
          if($query->fetch()){
            $idLog++;
          }else{
            $idLog = 1;
          }
          $query->close();
          if($query = $db->prepare("INSERT INTO tblog (idTicket, idLog, idUser, mensagem)
            VALUES (?, ?, ?, ?)")){
            $msgcomsenha = $_POST['mensagem'] . '<div class="callout callout-success" style="margin-top: 10px;"><p>Senha gerada automaticamente: <input class="form-control" type="text" value="'.$_POST['senhatemp'] . '"></p></div>';
            $query->bind_param('iiis', $_POST['idticket2'], $idLog, $_SESSION['id'], $msgcomsenha);
            $query->execute();
            $query->close();
            if($query = $db->prepare("UPDATE tbticket SET statusTicket = 'Respondido' WHERE idTicket = ?")){
              $query->bind_param('i', $_POST['idticket2']);
              $query->execute();
              $query->close();

              if ($query = $db->prepare("SELECT AES_DECRYPT(email, ?)
                  FROM tbusuario
                  WHERE idUser = ?")){
                  $query->bind_param('si', $_SESSION['chave'], $_POST['idUserTicket']);             
                  $query->execute();
                  $query->bind_result($email);
                  $query->fetch();
                  $query->close();
                  Atalhos::enviarEmail($email,1);
                }

            }
            header('Location: /tickets/moderar');
          }
        }
      }elseif($_POST['acao'] == 1 || $_POST['acao'] == 2){
        if($query = $db->prepare("SELECT idLog FROM tblog WHERE idTicket = ? ORDER BY idLog DESC LIMIT 1")){
          $query->bind_param('i', $_POST['idticket']);
          $query->bind_result($idLog);
          $query->execute();
          if($query->fetch()){
            $idLog++;
          }else{
            $idLog = 1;
          }
          $query->close();
          if($query = $db->prepare("INSERT INTO tblog (idTicket, idLog, idUser, mensagem)
            VALUES (?, ?, ?, ?)")){
            $query->bind_param('iiis', $_POST['idticket'], $idLog, $_SESSION['id'], $_POST['mensagem']);
            $query->execute();
            $query->close();
            if($_POST['acao'] == 1){
              if($query = $db->prepare("UPDATE tbticket SET statusTicket = 'Respondido' WHERE idTicket = ?")){
                $query->bind_param('i', $_POST['idticket']);
                $query->execute();
                $query->close();

                if ($query = $db->prepare("SELECT AES_DECRYPT(email, ?)
                  FROM tbusuario
                  WHERE idUser = ?")){
                  $query->bind_param('si', $_SESSION['chave'], $_POST['idUserTicket']);             
                  $query->execute();
                  $query->bind_result($email);
                  $query->fetch();
                  $query->close();
                  Atalhos::enviarEmail($email,1);
                }

              }
              header('Location: /tickets/moderar');
            }else{
              if($query = $db->prepare("UPDATE tbticket SET statusTicket = 'Em Analise' WHERE idTicket = ?")){
                $query->bind_param('i', $_POST['idticket']);
                $query->execute();
                $query->close();
              }
              header('Location: /tickets/meus');
            }
          }
        }
      }else{
        if($query = $db->prepare("UPDATE tbticket SET statusTicket = 'Concluido', avalicao = ? WHERE idTicket = ?")){
          $query->bind_param('ii', $_POST['rating'], $_POST['idticket']);
          $query->execute();
          $query->close();
          if($_POST['acao'] == 4){
            if($query = $db->prepare("UPDATE tbemail SET criado = 1 WHERE idUser = ?")){
              $query->bind_param('i', $_SESSION['id']);
              $query->execute();
              $query->close();
            }
          }
        }
        header('Location: /tickets/meus');
      }
      $db->close();
    }

    public static function addTickets(){
      $bd = Atalhos::getBanco();
      if($_POST['idAssunto'] != 6){
        if($query = $bd->prepare("INSERT INTO tbticket (idUser, idAssunto, tituloTicket, statusTicket)
          VALUES (?, ?, ?, 'Em Analise')")){
          $query->bind_param('iis', $_SESSION['id'], $_POST['idAssunto'], $_POST['titulo']);
          $query->execute();
          $idTickets = $query->insert_id;
          $query->close();
          Atalhos::addLogsAcoes('Inseriu', 'tbticket', $idTickets);
          if($query = $bd->prepare("SELECT idLog FROM tblog WHERE idTicket = ? ORDER BY idLog DESC LIMIT 1")){
            $query->bind_param('i', $idTickets);
            $query->bind_result($idLog);
            $query->execute();
            if($query->fetch()){
              $idLog++;
            }else{
              $idLog = 1;
            }
            $query->close();
            if($query = $bd->prepare("INSERT INTO tblog (idTicket, idLog, idUser, mensagem)
              VALUES (?, ?, ?, ?)")){
              $query->bind_param('iiis', $idTickets, $idLog, $_SESSION['id'], $_POST['resumo']);
              $query->execute();
              $query->close();
            }
          }
        }
      }else{
        if($query = $bd->prepare("SELECT a.afiliacao FROM tbafiliacao a INNER JOIN tbusuario b ON a.idAfiliacao = b.idAfiliacao WHERE idUser = ?")){
          $query->bind_param('i', $_SESSION['id']);
          $query->execute();
          $query->bind_result($afiliacao);
          $query->fetch();
          $query->store_result();
          $query->close();
        }
        if($query = $bd->prepare("INSERT INTO tbticket (idUser, idAssunto, tituloTicket, statusTicket)
          VALUES (?, 6, 'Requisição de Email Dcomp', 'Em Analise')")){
          $query->bind_param('i', $_SESSION['id']);
          $query->execute();
          $idTickets = $query->insert_id;
          $query->close();
          Atalhos::addLogsAcoes('Inseriu', 'tbticket', $idTickets);
          if($query = $bd->prepare("SELECT idLog FROM tblog WHERE idTicket = ? ORDER BY idLog DESC LIMIT 1")){
            $query->bind_param('i', $idTickets);
            $query->bind_result($idLog);
            $query->execute();
            if($query->fetch()){
              $idLog++;
            }else{
              $idLog = 1;
            }
            $query->close();
            //echo 'Email: '.$_POST['emailalt'];
            $resumo = 'Solicito a criação do e-mail institucional do Departamento de Computação da UFS.<br><br>
                        Usuário escolhido: <b>'.$_POST['email'].'</b>@dcomp.ufs.br<br>
                        Email alternativo: '.$_POST['emailalt'].'<br>
                        Curso: '.$afiliacao.'<br><br>
                        Em concomitância, estou concordando com os termos de uso do Admin DCOMP e dos demais recursos disponibilizados por esse Departamento, incluindo a utilização dos laboratórios, sob pena de punição em caso de descumprimento.';
            if($query = $bd->prepare("INSERT INTO tblog (idTicket, idLog, idUser, mensagem)
              VALUES (?, ?, ?, ?)")){
              $query->bind_param('iiis', $idTickets, $idLog, $_SESSION['id'], $resumo);
              $query->execute();
              $query->close();
            }
            if($query = $bd->prepare("INSERT INTO tbemail (idUser, email) VALUES (?, AES_ENCRYPT(?, ?))")){
              $query->bind_param('iss', $_SESSION['id'], $_POST['email'], $_SESSION['chave']);
              $query->execute();
              $query->close();
            }
          }
        }
      }
      $bd->close();
    }

    public static function extensionCatcher($nomeArquivo){

      # separa strings em substrigs divididas pelo '.' e a retorna num array das substrings
      $idtArr = explode('.',$nomeArquivo);
      # retorna o ultimo indice do array e letras minusculas
      $extensao = strtolower(end($idtArr));

      # retorna extensão
      return $extensao;
    }

    public static function nomePacoteCatcher($nomeArquivo){

      # separa string em substrings separadas pelo '-' e retorna um array das substrings
      $idpkg = explode('-', $nomeArquivo);
      #
      $idarch = explode('.', $idpkg[(count($idpkg) - 1)]);
      $idpkg[(count($idpkg) - 1)] = $idarch[0];

      $nome = "";

      # loop que monta o nome do pacote, que esta dividido, em uma string apenas. Ou seja:
      #        [0] nome
      # (no array) [1] do      -----> nome-do-pacote (na string de saída)
      #      [2] pacote
      $i = (count($idpkg) - 3);
      $j = 0;
      while($j < $i){
       $nome = $nome . $idpkg[$j];
        $j++;
        if($j != $i){
          $nome = $nome . "-";
        }
      }

      # Retorna array com as informações: nome, versão, release e arquitetura
      $infoPacote = array($nome, $idpkg[$i], $idpkg[($i+1)], $idpkg[($i+2)]);

     return $infoPacote;
    }

    public static function atualizaRepo(){

      if($_POST['numPost'] == 41){
        Post::rmvRepo();
      }
      elseif($_POST['numPost'] == 42){

        $pacoteNovo = Post::nomePacoteCatcher($_FILES['pacote']['name']);
        $pacoteVelho = Post::nomePacoteCatcher($_POST['nomePacoteCompleto2']);

        if( $pacoteVelho[0] == $pacoteNovo[0] ){

          if($pacoteVelho[1] != $pacoteNovo[1] || $pacoteVelho[2] != $pacoteNovo[2]){
            $log1 = Post::rmvRepo();
            $log2 = Post::addRepo();
            # Se a remoção e adição de pacotes for bem sucedida ou não, mostra aviso na tela comunicando usuário.
            if($log1 && $log2){
              $_SESSION['avisoPacoteAtualizado'] = 1;
              return true;
            }
            elseif($log1){
              $_SESSION['erroPacote'] = "Erro ao remover o pacote.";
              return false;
            }
            elseif($log2){
              $_SESSION['erroPacote'] = "Erro ao adicionar o pacote.";
              return false;
            }
          }
          else{
            $_SESSION['erroPacote'] = 'O pacote novo possui mesma versão e release que o já disponível no repositório e, portanto, não será atualizado!<br/>
                                       Se você escreveu o pacote, observe se atualizou devidamente esses campos.<br/>';
            return false;
          }
        }
        else{
          $_SESSION['erroPacote'] = 'O Pacote é Inválido. Opção disponível apenas para atualização de pacotes.<br/>
                                     Para substituir o pacote, por favor, exclua o pacote anterior e adicione o novo.<br/>';
          return false;
        }
      }
    }

    public static function rmvRepo(){

      $idpkg = Post::nomePacoteCatcher($_POST['nomePacoteCompleto']);

      # O pacote será removido do repositório correspondente
      if( unlink('repo_dcomp/' . $idpkg[3] . '/' . $_POST['nomePacoteCompleto']) ){
        # Se a deleção do arquivo for bem sucedida, o índice de repositório será atualizado.
        # Se for do tipo any, o repositório tem nome diferenciado, e por isso precisa de tratamento especial.
        if($idpkg[3] == 'any'){
          shell_exec('cd repo_dcomp/' . $idpkg[3] . '/ && repo-remove ./dcomp-multilib.db.tar.gz ' . $idpkg[0]);
          # E será mostrado um aviso de sucesso.
          $_SESSION['avisoPacoteExcluido'] = 1;
          # Retorna true para o caso de atualizaRepo ter chamado rmvRepo.
          return true;
        }
        else{
          shell_exec('cd repo_dcomp/' . $idpkg[3] . '/ && repo-remove ./dcomp.db.tar.gz ' . $idpkg[0]);
          # E será mostrado um aviso de sucesso.
          $_SESSION['avisoPacoteExcluido'] = 1;
          # Retorna true para o caso de atualizaRepo ter chamado rmvRepo.
          return true;
        }
      }
      else{
        # Se a deleção não for bem sucedida, será mostrado um aviso falha.
        $_SESSION['avisoPacoteNaoExcluido'] = 1;
        # Retorna false para o case de atualizaRepo ter chamado rmvRepo.
        return false;
      }
    }

    public static function repoDecider($pkgname, $repo){

      # pega os dados do pacote com base no nome dele.
      $pkg = Post::nomePacoteCatcher($pkgname);

      if($pkg[3] == 'any' || $pkg[3] == 'x86_64' || $pkg[3] == 'armv7h' || $pkg[3] == 'i686'){
          $log = NULL;

          # Copia pacote no repositório apropriado.
          if( copy('repo_dcomp/' . $pkgname, 'repo_dcomp/'. $pkg[3] . '/' . $pkgname) ){
            # Atualiza o indice do repositório.
            # Para o caso do pacote any, o repositorio é dcomp-multilib, senão apenas dcomp.
            if($pkg[3] == 'any'){
              $log = shell_exec('cd repo_dcomp/ '. $pkg[3] . '/ && repo-add ./' . $pkg[3] . '/dcomp-multilib.db.tar.gz ./*.tar.xz --remove --new');
              # Aviso que o indice do repositório foi atualizado ou não com false no segundo caso (caso attRepo tenha chamado)
              if($log != NULL){
                $_SESSION['avisoPacoteEnviado'] = 1;
              }else{
                $SESSION['falhaPacote'] = 1;
                return false;
              }

            }else{
              $log = shell_exec('cd repo_dcomp/ '. $pkg[3] . '/ && repo-add ./' . $pkg[3] . '/dcomp.db.tar.gz ./*.tar.xz --remove --new');
              # Aviso se o indice de repositorio foi atualizado com sucesso
              if($log){
                $_SESSION['avisoPacoteEnviado'] = 1;
              }else{
                $_SESSION['falhaPacote'] = 1;
                return false;
              }
            }
          }
          else{
            $_SESSION['erroPacote'] = "Não foi possível copiar o pacote. Tente novamente!<br/>
                                       Se o problema persistir, comunique ao supervisor do repositório.";
            return false;
          }
        # Agora que o arquivo foi copiado com sucesso para o repositório, ele será deletado.
        # Se o pacote for excluido com sucesso, retorna true a quem chamou.
        return unlink('repo_dcomp/' . $pkgname);
      }
    }

    public static function addPacote(){

      # Pasta onde o pacote vai ser salvo, com base na arquitetura do pacote
      $_UP['tempRepo'] = "repo_dcomp/";

      // Array com as extensões permitidas
      $_UP['extensoes'] = array('xz');

      // Array com os tipos de erros de upload do PHP
      $_UP['erros'][0] = 'Nenhum erro foi detectado.';
      $_UP['erros'][1] = 'O pacote é maior que o limite de 1GB [erro no PHP].';
      $_UP['erros'][2] = 'O pacote é maior que o limite de 1GB [erro no HTML].';
      $_UP['erros'][3] = 'O upload do pacote foi interrompido.';
      $_UP['erros'][4] = 'O pacote não foi upado.';

      // Obtem a extensão do pacote upado
      $extensao = Post::extensionCatcher($_FILES['pacote']['name']);

      // Verifica se houve algum erro com o upload e exibe a mensagem do erro se necessário
      if ($_FILES['pacote']['error'] != 0) {
        $_SESSION['erroPacote'] = $_UP['erros'][$_FILES['pacote']['error']];
        return false;
      }
      // Caso a extensão do pacote for inválida, o script para.
      elseif (array_search($extensao,$_UP['extensoes']) === false) {
        $_SESSION['erroPacote'] = "Por favor, envie pacotes válidos.<br/>
                                 As extenções de pacotes são .xz .<br/>";
        return false;
      }
      # Se a extensão estiver ok, o arquivo será colocado numa pasta temporária.
      elseif (move_uploaded_file($_FILES['pacote']['tmp_name'], $_UP['tempRepo'] . $_FILES['pacote']['name'])) {
        # Chama função responsável por fazer o tratamento do repositório do pacote mandando como argumento
        # o nome do pacote e onde fica a pasta temporária
        if(Post::repoDecider($_FILES['pacote']['name'], $_UP['tempRepo'])){
          return true;
        }
        else{
          return false;
        }
      }
      else {
        // Não foi possível fazer o upload, provavelmente a pasta está incorreta
        $_SESSION['erroPacote'] = "Não foi possível enviar o pacote. Tente novamente!<br/>
                                  Se o problema persistir, comunique ao supervisor do repositório.";
        return false;
      }
    }

    public static function minhaSala(){
      $db = Atalhos::getBanco();
      if(isset($_POST['acao'])){
        if($_POST['id'] == 0){
          if($query = $db->prepare("DELETE FROM tbreservasala WHERE idReSala =?")){
            $query->bind_param('i', $_POST['idre']);
            $query->execute();
            Atalhos::addLogsAcoes('Deletou', 'tbreservasala', $_POST['idre']);
          }
        }else{
          if($query = $db->prepare("DELETE FROM tbcontroledatasala WHERE idReSala =? AND idData =?")){
            $query->bind_param('ii', $_POST['idre'], $_POST['id']);
            $query->execute();
            Atalhos::addLogsAcoes('Deletou', 'tbcontroledatasala', $_POST['idre']);
          }
        }
      }else{
        if($_POST['id2'] == 0){
          if($query = $db->prepare("UPDATE tbcontroledatasala SET statusData = ?, justificativa = ? WHERE idReSala =?")){
            $query->bind_param('ssi', $_POST['acao2'], $_POST['justificativa'], $_POST['idre2']);
            $query->execute();
            Atalhos::addLogsAcoes('Modificou', 'tbcontroledatasala', $_POST['idre2']);
          }
        }else{
          if($query = $db->prepare("UPDATE tbcontroledatasala SET statusData =?, justificativa =? WHERE idReSala =?
            AND idData =?")){
            $query->bind_param('ssii', $_POST['acao2'], $_POST['justificativa'], $_POST['idre2'], $_POST['id2']);
            $query->execute();
            Atalhos::addLogsAcoes('Modificou', 'tbcontroledatasala', $_POST['idre2']);
          }
        }
      }
      $query->close();
      $db->close();
    }

    public static function moderarSala(){
      $db = Atalhos::getBanco();
      if(isset($_POST['acao2'])){
        if(empty($_POST['justificativa'])){
          $_SESSION['errorModerarSala'] = 1;
        }else{
          if($query = $db->prepare("SELECT idNoti FROM tbnotificacao ORDER BY idNoti DESC LIMIT 1")){
              $query->bind_result($idNoti);
              $query->execute();
            if($query->fetch()){
              $idNoti++;
            }else{
              $idNoti = 0;
            }
            $query->close();
          }
          if($acao = 'Negado'){
            $status = 'Negada';
          }else{
            $status = 'Cancelada';
          }
          if($_SESSION['id'] != $_POST['idUser2']){
            $noti = '<li>
                      <a href="noti.php?id='.$idNoti.'&ir=/salas/minhas" style="background-color: #EFEEEE">
                        <i class="fa fa-pencil-square-o text-red"></i> Sua reserva foi '.$status.'
                      </a>
                    </li>';
            if($query = $db->prepare("INSERT INTO tbnotificacao (idNoti, notificacao, statusNoti)
              VALUES ('".$idNoti."', '".$noti."', 'false')")){
              $query->execute();
              $query->close();
            }
            if($query = $db->prepare("INSERT INTO tbnoticonexao VALUES ('".$_POST['idUser2']."', '".$idNoti."')")){
              $query->execute();
              $query->close();
            }
          }
          if($_POST['id2'] == 0){
            if($query = $db->prepare("UPDATE tbcontroledatasala SET statusData = ?, justificativa = ?
              WHERE idReSala = ?")){
              $query->bind_param('ssi', $_POST['acao2'], $_POST['justificativa'],$_POST['idre2']);
              $query->execute();
              Atalhos::addLogsAcoes('Modificou', 'tbcontroledatasala', $_POST['idre2']);
              $query->close();
            }
            $conjunto = Atalhos::getConjunto($_POST['idre2'], 0, 3);
            if($conjunto != false){
              Atalhos::deletarConjunto($_POST['idre2'], 0, 3);
              Atalhos::verificarConjunto($conjunto, 3);
            }
          }else{
            if($query = $db->prepare("UPDATE tbcontroledatasala SET statusData = ?, justificativa = ?
              WHERE idReSala = ? AND idData = ?")){
              $query->bind_param('ssii', $_POST['acao2'], $_POST['justificativa'],$_POST['idre2'], $_POST['id2']);
              $query->execute();
              Atalhos::addLogsAcoes('Modificou', 'tbcontroledatasala', $_POST['idre2']);
            }
            $conjunto = Atalhos::getConjunto($_POST['idre2'], $_POST['id2'], 3);
            if($conjunto != false){
              Atalhos::deletarConjunto($_POST['idre2'], $_POST['id2'], 3);
              Atalhos::verificarConjunto($conjunto, 3);
            }
          }
        }
      }elseif($_POST['acao'] == 'Excluir'){
        if($_POST['id'] == 0){
          if($query = $db->prepare("DELETE FROM tbreservasala WHERE idReSala =?")){
            $query->bind_param('i',$_POST['idre']);
            $query->execute();
            Atalhos::addLogsAcoes('Deletou', 'tbreservasala', $_POST['idre']);
          }
        }else{
          if($query = $db->prepare("DELETE FROM tbcontroledatasala WHERE idReSala =? AND idData =?")){
            $query->bind_param('ii',$_POST['idre'], $_POST['id']);
            $query->execute();
            Atalhos::addLogsAcoes('Deletou', 'tbcontroledatasala', $_POST['idre']);
          }
        }
      }else{
        if($_POST['acao'] == "Recebido" || $_POST['acao'] == "Entregue"){
          if($query = $db->prepare("UPDATE tbcontroledatasala SET statusData = ? WHERE idData = ? AND idReSala = ?")){
            $query->bind_param('sii',$_POST['acao'], $_POST['id'], $_POST['idre']);
            $query->execute();
            Atalhos::addLogsAcoes('Modificou', 'tbcontroledatasala', $_POST['idre']);
          }
        }else{
          if($_SESSION['id'] != $_POST['idUser']){
            $noti = '<li>
                      <a href="noti.php?id='.$idNoti.'&ir=/salas/minhas" style="background-color: #EFEEEE">
                        <i class="fa fa-pencil-square-o text-red"></i> Sua reserva foi '.$status.'
                      </a>
                    </li>';
            if($query = $db->prepare("INSERT INTO tbnotificacao (idNoti, notificacao, statusNoti) VALUES (?, ?, 'false')")){
              $query->bind_param('is',$idNoti, $noti);
              $query->execute();
              $query->close();
            }
            if($query = $db->prepare("INSERT INTO tbnoticonexao VALUES (?, ?)")){
              $query->bind_param('ii',$_POST['idUser'], $idNoti);
              $query->execute();
              $query->close();
            }
          }
          if($_POST['id'] == 0){
            if($query = $db->prepare("SELECT idData FROM tbcontroledatasala WHERE idReSala= ?")){
              $query->bind_param('i',$_POST['idre']);
              $query->execute();
              if($query->fetch()){
                if(Atalhos::getConjunto($_POST['idre'], 0, 3)){
                  $_SESSION['errorAprovar'] = 2;
                }else{
                  $query->close();
                  if($query = $db->prepare("UPDATE tbcontroledatasala SET statusData = ? WHERE idReSala = ?")){
                    $query->bind_param('si',$_POST['acao'], $_POST['idre']);
                    $query->execute();
                    Atalhos::addLogsAcoes('Modificou', 'tbcontroledatasala', $_POST['idre']);
                    $query->close();
                  }
                }
              }else{
                $query->close();
                if($query = $db->prepare("UPDATE tbcontroledatasala SET statusData = ? WHERE idReSala = ?")){
                  $query->bind_param('si',$_POST['acao'], $_POST['idre']);
                  $query->execute();
                  Atalhos::addLogsAcoes('Modificou', 'tbcontroledatasala', $_POST['idre']);
                  $query->close();
                }
              }
            }
          }else{
            if(Atalhos::getConjunto($_POST['idre'], $_POST['id'], 3) == false){
              if($query = $db->prepare("UPDATE tbcontroledatasala SET statusData = ? WHERE idReSala = ? AND idData = ?")){
                $query->bind_param('sii',$_POST['acao'], $_POST['idre'], $_POST['id']);
                $query->execute();
                Atalhos::addLogsAcoes('Modificou', 'tbcontroledatasala', $_POST['idre']);
                $query->close();
              }
            }else{
              $_SESSION['errorAprovar'] = 1;
            }
          }
        }
      }
      $db->close();
    }

    public static function calendarioSala(){
      $db = Atalhos::getBanco();
      if($_SESSION['nivel'] == 1){
        $status ='Aprovado';
      }else{
        $status = 'Pendente';
      }
      $subdata = explode(" - ", $_POST['data']);
      $dataini = date("Y-m-d H:i", strtotime(str_replace('/', '-', $subdata[0])));
      $datafim = date("Y-m-d H:i", strtotime(str_replace('/', '-', $subdata[1])));
      switch($_POST['reserva']){
        case 'aula_dcomp':
          $titulo = $_POST['disciplina'];
          $motivo = $_POST['motivo_aula'];
          break;
        case 'aula_outros':
          $titulo = $_POST['titulo_aula'];
          $motivo = $_POST['motivo_aula'];
          break;
        case 'tcc':
          $titulo = 'TCC - '.$_POST['titulo_tcc'];
          $motivo = $_POST['motivo_tcc'];
          break;
        default:
          $titulo = $_POST['titulo_outro'];
          $motivo = $_POST['motivo_outro'];
          break;
      }
      if($_POST['tempo'] == "UmaVez"){
        if($query = $db->prepare("INSERT INTO tbreservasala (idUser, idSala, tituloReSala, motivoReSala)
          VALUES (?, ?, ?, ?)")){
          $query->bind_param('iiss', $_SESSION['id'], $_POST['sala'], $titulo, $motivo);
          $query->execute();
          $idReSala = $query->insert_id;
          Atalhos::addLogsAcoes('Inseriu', 'tbreservasala', $idReSala);
          $query->close();
        }
        if($query = $db->prepare("SELECT idData FROM tbdata WHERE inicio = ? AND fim = ? LIMIT 1")){
          $query->bind_param('ss', $dataini, $datafim);
          $query->execute();
          $query->bind_result($idData);
          if($query->fetch() == NULL){
            $auxDb = Atalhos::getBanco();
            if($aux = $auxDb->prepare("INSERT INTO tbdata (inicio, fim) VALUES (?, ?)")){
              $aux->bind_param('ss', $dataini, $datafim);
              $aux->execute();
              $idData = $aux->insert_id;
              $aux->close();
              $auxDb->close();
            }
          }
          $query->close();
          if($query = $db->prepare("INSERT INTO tbcontroledatasala (idReSala, idData, statusData) VALUES (?, ?, ?)")){
            $result = Atalhos::choqueSala($dataini, $datafim, $_POST['sala']);
            $query->bind_param('iis', $idReSala, $idData, $status);
            if($result != false){
              if($status == 'Aprovado'){
                $status = 'Pendente';
                $_SESSION['choqueReserva'] = 1;
              }
              $query->execute();
              Atalhos::includeChoque($result, $idReSala, $idData, 3);

            }else{
              $query->execute();
            }
            $query->close();
          }
        }
        $_SESSION['avisoCalendario'] = 1;
      }else{
        $horaIni = explode(" ", $dataini);
        $inicio = $horaIni[0];
        $horaIni = $horaIni[1];
        $horaFim = explode(" ", $datafim);
        $fim = date_create($horaFim[0]);
        $horaFim = $horaFim[1];
        $verificaData = 0;
        if(isset($_POST["dias"])) {
          foreach($_POST["dias"] as $value){
            $auxData = date_create($inicio);
            while(date('N', date_timestamp_get($auxData)) != $value AND $auxData <= $fim){
              date_add($auxData, date_interval_create_from_date_string('1 day'));
            }
            for($ini = $auxData; $ini <= $fim; date_add($auxData, date_interval_create_from_date_string('7 day'))){
              $day = date_format($auxData, 'Y-m-d');
              $dataini = $day." ".$horaIni;
              $datafim = $day." ".$horaFim;
              if($verificaData == 0){
                if($query = $db->prepare("INSERT INTO tbreservasala (idUser, idSala, tituloReSala, motivoReSala)
                  VALUES (?, ?, ?, ?)")){
                  $query->bind_param('iiss', $_SESSION['id'], $_POST['sala'], $titulo, $motivo);
                  $query->execute();
                  $idReSala = $query->insert_id;
                  Atalhos::addLogsAcoes('Inseriu', 'tbreservasala', $idReSala);
                  $query->close();
                }
                $verificaData = 1;
              }
              if($query = $db->prepare("SELECT idData FROM tbdata WHERE inicio = ? AND fim = ? LIMIT 1")){
                $query->bind_param('ss', $dataini, $datafim);
                $query->execute();
                $query->bind_result($idData);
                if($query->fetch() == NULL){
                  $auxDb = Atalhos::getBanco();
                  if($aux = $auxDb->prepare("INSERT INTO tbdata (inicio, fim) VALUES (?, ?)")){
                    $aux->bind_param('ss', $dataini, $datafim);
                    $aux->execute();
                    $idData = $aux->insert_id;
                    $aux->close();
                    $auxDb->close();
                  }
                }
                $query->close();
                if($query = $db->prepare("INSERT INTO tbcontroledatasala (idReSala, idData, statusData) VALUES (?, ?, ?)")){
                  $result = Atalhos::choqueSala($dataini, $datafim, $_POST['sala']);
                  $query->bind_param('iis', $idReSala, $idData, $status);
                  if($result != false){
                    if($status == 'Aprovado'){
                      $status = 'Pendente';
                      $_SESSION['choqueReserva'] = 1;
                    }
                    $query->execute();
                    Atalhos::includeChoque($result, $idReSala, $idData, 3);
                  }else{
                    $query->execute();
                  }
                  $query->close();
                }
              }
            }
          }
        }
        if ($verificaData == 1){
          $_SESSION['avisoCalendario'] = 1;
        }else{
          $_SESSION['errorCalendario'] = "O dia da semana selecionado não pertence ao intervalo escolhido!";
        }
      }
    }
    
    public static function salaStatus(){
      $db = Atalhos::getBanco();
      if($_POST['acao'] == 1){
        if($query = $db->prepare("UPDATE tbsala SET statusSala = 'Inativo' WHERE idSala = ?")){
          $query->bind_param('i', $_POST['idSala']);
          $query->execute();
          Atalhos::addLogsAcoes('Modificou', 'tbsala', $_POST['idSala']);
        }
      }elseif($_POST['acao'] == 2){
        if($query = $db->prepare("UPDATE tbsala SET statusSala = 'Ativo' WHERE idSala = ?")){
          $query->bind_param('i', $_POST['idSala']);
          $query->execute();
          Atalhos::addLogsAcoes('Modificou', 'tbsala', $_POST['idSala']);
        }
      }else{
        if($query = $db->prepare("DELETE FROM tbsala WHERE idSala = ?")){
          $query->bind_param('i', $_POST['idSala']);
          $query->execute();
          Atalhos::addLogsAcoes('Excluiu', 'tbsala', $_POST['idSala']);
        }
      }
      $query->close();
      $db->close();
      header('Location: /recursos/salas');
    }

    public static function salaEdit(){
      $db = Atalhos::getBanco();
      if($query = $db->prepare("UPDATE tbsala SET nomeSala=?, numPessoa=? WHERE idSala = ?")){
        $query->bind_param('sii', $_POST['nome'], $_POST['cap'], $_POST['idSala']);
        $query->execute();
        Atalhos::addLogsAcoes('Modificou', 'tbsala', $_POST['idSala']);
        $_SESSION['avisoSala'] = 'Sala editado com sucesso!';
      }
      $query->close();
      $db->close();
      header('Location: /recursos/salas');
    }

    public static function salaAdd(){
      $db = Atalhos::getBanco();
      if($query = $db->prepare("SELECT idCor FROM tbsala ORDER BY idCor ASC")){
        $query->execute();
        $query->bind_result($idCor);
        $auxDb = Atalhos::getBanco();
        if($aux = $auxDb->prepare("SELECT idCor FROM tbcor ORDER BY idCor DESC LIMIT 1")){
          $aux->execute();
          $aux->bind_result($totalCor);
          $aux->fetch();
          $i = 1;
          while($query->fetch()){
            if($i != $idCor){
              break;
            }else{
              $i++;
            }
          }
          $query->close();
          $auxDb->close();
          $aux->close();
          if($i <= $totalCor){
            if($query = $db->prepare("INSERT INTO tbsala (nomeSala, numPessoa, statusSala, idCor) VALUES (?, ?, ?, ?)")){
              $query->bind_param('sisi', $_POST['nome'], $_POST['cap'], $_POST['status'], $i);
              $query->execute();
              $idSala = $query->insert_id;
              Atalhos::addLogsAcoes('Inseriu', 'tbsala', $idSala);
              $_SESSION['avisoSala'] = 'Sala adicionado com sucesso!';
            }
            $query->close();
            $db->close();
            header('Location: /recursos/salas');
          }else{
            include 'corAdd';
          }
        }
      }
    }

    public static function meusReq(){
      $db = Atalhos::getBanco();
      if($query = $db->prepare("DELETE FROM tbrequerimentos WHERE idReq  = ?")){
        $query->bind_param('i', $_POST['id']);
        $query->execute();
        Atalhos::addLogsAcoes('Excluiu', 'tbrequerimentos', $_POST['id']);
      }
      $query->close();
      $db->close();
      header('Location: /requerimentos/meus');
    }

    public static function meusEqp(){
      $db = Atalhos::getBanco();
      if(isset($_POST['acao'])){
        if($_POST['id'] == 0){
          if($query = $db->prepare("DELETE FROM tbreservaeq WHERE idReEq =?")){
            $query->bind_param('i', $_POST['idreeq']);
            $query->execute();
            Atalhos::addLogsAcoes('Excluiu', 'tbreservaeq', $_POST['idreeq']);
          }
        }else{
          if($query = $db->prepare("DELETE FROM tbcontroledataeq WHERE idReEq =? AND idData =?")){
            $query->bind_param('ii', $_POST['idreeq'], $_POST['id']);
            $query->execute();
            Atalhos::addLogsAcoes('Excluiu', 'tbcontroledataeq', $_POST['idreeq']);
          }
        }
      }else{
        if($_POST['id2'] == 0){
          if($query = $db->prepare("UPDATE tbcontroledataeq SET statusData = ?, justificativa = ? WHERE idReEq =?")){
            $query->bind_param('ssi', $_POST['acao2'], $_POST['justificativa'], $_POST['idreeq2']);
            $query->execute();
            Atalhos::addLogsAcoes('Modificou', 'tbcontroledataeq', $_POST['idreeq2']);
          }
        }else{
          if($query = $db->prepare("UPDATE tbcontroledataeq SET statusData =?, justificativa =? WHERE idReEq =?
            AND idData =?")){
            $query->bind_param('ssii', $_POST['acao2'], $_POST['justificativa'], $_POST['idreeq2'], $_POST['id2']);
            $query->execute();
            Atalhos::addLogsAcoes('Excluiu', 'tbcontroledataeq', $_POST['idreeq2']);
          }
        }
      }
      $query->close();
      $db->close();
    }

    public static function meusLab(){
      $db = Atalhos::getBanco();
      if(isset($_POST['acao'])){
        if($_POST['id'] == 0){
          if($query = $db->prepare("DELETE FROM tbreservalab WHERE idReLab =?")){
            $query->bind_param('i', $_POST['idre']);
            $query->execute();
            Atalhos::addLogsAcoes('Excluiu', 'tbreservalab', $_POST['idre']);
          }
        }else{
          if($query = $db->prepare("DELETE FROM tbcontroledatalab WHERE idReLab =? AND idData =?")){
            $query->bind_param('ii', $_POST['idre'], $_POST['id']);
            $query->execute();
            Atalhos::addLogsAcoes('Excluiu', 'tbcontroledatalab', $_POST['idre']);
          }
        }
      }else{
        if($_POST['id2'] == 0){
          if($query = $db->prepare("UPDATE tbcontroledatalab SET statusData = ?, justificativa = ? WHERE idReLab =?")){
            $query->bind_param('ssi', $_POST['acao2'], $_POST['justificativa'], $_POST['idre2']);
            $query->execute();
            Atalhos::addLogsAcoes('Modificou', 'tbcontroledatalab', $_POST['idre2']);
          }
        }else{
          if($query = $db->prepare("UPDATE tbcontroledatalab SET statusData =?, justificativa =? WHERE idReLab =?
            AND idData =?")){
            $query->bind_param('ssii', $_POST['acao2'], $_POST['justificativa'], $_POST['idre2'], $_POST['id2']);
            $query->execute();
            Atalhos::addLogsAcoes('Modificou', 'tbcontroledatalab', $_POST['idre2']);
          }
        }
      }
      $query->close();
      $db->close();
    }

    public static function moderarReq(){
      $db = Atalhos::getBanco();
      if(isset($_POST['acao'])){
        if($query = $db->prepare("UPDATE tbrequerimentos SET statusReq = ? WHERE idReq = ?")){
          $query->bind_param('si', $_POST['acao'], $_POST['id']);
          $query->execute();
          Atalhos::addLogsAcoes('Modificou', 'tbrequerimentos', $_POST['id']);
        }
        if ($query = $db->prepare("SELECT AES_DECRYPT(email, ?)
                                  FROM tbusuario NATURAL JOIN tbrequerimentos
                                  WHERE idReq = ?")){
          $query->bind_param('si', $_SESSION['chave'], $_POST['id']);             
          $query->execute();
          $query->bind_result($email);
          $query->fetch();
          $query->close();
          Atalhos::enviarEmail($email,2);
        }
      }else{
        if(empty($_POST['justificativa'])){
          $_SESSION['errorModerarLab'] = 1;
        }else{
          if($query = $db->prepare("UPDATE tbrequerimentos SET statusReq = ?, justificativaReq = ?  WHERE idReq = ?")){
            $query->bind_param('ssi', $_POST['acao2'], $_POST['justificativa'], $_POST['id2']);
            $query->execute();
            Atalhos::addLogsAcoes('Modificou', 'tbrequerimentos', $_POST['id2']);
          }
          if ($query = $db->prepare("SELECT AES_DECRYPT(email, ?)
                                  FROM tbusuario NATURAL JOIN tbrequerimentos
                                  WHERE idReq = ?")){
            $query->bind_param('si', $_SESSION['chave'], $_POST['id2']);             
            $query->execute();
            $query->bind_result($email);
            $query->fetch();
            $query->close();
            Atalhos::enviarEmail($email,2);
          }
        }
      }
      $query->close();
      $db->close();
    }

    public static function alterarPrazo(){
      $db = Atalhos::getBanco();
        if (!($_POST['null'])){
        $subdata = explode(" - ", $_POST['data']);
        $dataini = date('Y-m-d',strtotime($subdata[0]));
        $datafim = date('Y-m-d',strtotime($subdata[1]));
        if($query = $db->prepare("UPDATE tbprazo SET inicio = ?, fim = ? WHERE idPrazo = ?")){
          $query->bind_param('ssi', $dataini, $datafim, $_POST['id']);
          $query->execute();
          Atalhos::addLogsAcoes('Modificou', 'tbprazo', $_POST['id']);
          $_SESSION['prazoAlterado'] = 1;
        }
        $query->close();
      }
      else{
        $dataini = NULL;
        $datafim = NULL;
        if($query = $db->prepare("UPDATE tbprazo SET inicio = ?, fim = ? WHERE idPrazo = ?")){
          $query->bind_param('ssi', $dataini, $datafim, $_POST['id']);
          $query->execute();
          Atalhos::addLogsAcoes('Modificou', 'tbprazo', $_POST['id']);
          $_SESSION['prazoAlterado'] = 1;
        }
        $query->close();
       }
      $db->close();
    }

    public static function corAdd(){
      $db = Atalhos::getBanco();
      if($query = $db->prepare("INSERT INTO tbcor (cor) VALUES (?)")){
        $query->bind_param('s', $_POST['cor']);
        $query->execute();
        $idCor = $query->insert_id;
        $query->close();
        if(isset($_POST ['pcs'])){
          if($query = $db->prepare("INSERT INTO tblaboratorio (nomeLab, numComp, capAluno, statusLab, idCor)
              VALUES (?, ?, ?, ?, ?)")){
            $query->bind_param('siisi', $_POST['nome'], $_POST['pcs'], $_POST['capacidade'], $_POST['status'], $idCor);
            $query->execute();
            $idLab = $query->insert_id;
            Atalhos::addLogsAcoes('Inseriu', 'tblaboratorio', $idLab);
            $query->close();
            $db->close();
            $_SESSION['avisoLab'] = 'Laboratório adicionado com sucesso!';
            header('Location: /recursos/laboratorios');
          }
        }elseif(isset($_POST ['patrimonio'])){
          if($query = $db->prepare("INSERT INTO tbtipoeq (tipoEq, numEq, idCor) VALUES (?, 1, ?)")){
            $query->bind_param('si', $_POST['novoTipo'], $idCor);
            $query->execute();
            $idTipoEq = $query->insert_id;
            $query->close();
            if($query = $db->prepare("INSERT INTO tbequipamento (patrimonio, modelo, idTipoEq, statusEq) VALUES (?, ?, ?, ?)")){
              $query->bind_param('isis', $_POST['patrimonio'], $_POST['modelo'], $idTipoEq, $_POST['status']);
              $query->execute();
              $idEq = $query->insert_id;
              Atalhos::addLogsAcoes('Inseriu', 'tbequipamento', $idEq);
              $query->close();
              $db->close();
              $_SESSION['avisoEqp'] = 'Equipamento adicianado com sucesso!';
              header('Location: /recursos/equipamentos');
            }
          }
        }else{
          if($query = $db->prepare("INSERT INTO tbsala (nomeSala, numPessoa, statusSala, idCor) VALUES (?, ?, ?, ?)")){
            $query->bind_param('sisi', $_POST['nome'], $_POST['cap'], $_POST['status'], $idCor);
            $query->execute();
            $idSala = $query->insert_id;
            Atalhos::addLogsAcoes('Inseriu', 'tbsala', $idSala);
            $query->close();
            $db->close();
            $_SESSION['avisoSala'] = 'Sala adicionado com sucesso!';
            header('Location: /recursos/salas');
          }
        }
      }
    }

    public static function changeLab(){
      $db = Atalhos::getBanco();
      if($query = $db->prepare("SELECT h.inicio, h.fim, a.tipoReLab, a.numPc, g.statusData
            FROM tbreservalab a inner join tbcontroledatalab g on a.idReLab = g.idReLab
            inner join tbdata h on h.idData = g.idData
            inner join tblaboratorio b on g.idLab = b.idLab
          WHERE g.idReLab = ? AND g.idData = ?")){
        $query->bind_param('ii', $_POST['idReLab'], $_POST['idData']);
        $query->execute();
        $query->bind_result($inicio, $fim, $tipoReLab, $numPc, $statusData);
        $query->fetch();
        $temp = Atalhos::choqueLab($inicio, $fim, $_POST['idLab'], $tipoReLab, $numPc);
        $query->close();
        if($temp == false){
          if($query = $db->prepare("UPDATE tbcontroledatalab SET idLab = ? WHERE idReLab = ? AND idData = ?")){
            $query->bind_param('iii', $_POST['idLab'], $_POST['idReLab'], $_POST['idData']);
            $query->execute();
            Atalhos::addLogsAcoes('Modificou', 'tbcontroledatalab', $_POST['idReLab']);
            $conjunto = Atalhos::getConjunto($_POST['idReLab'], $_POST['idData'], 2);
            Atalhos::deletarConjunto($_POST['idReLab'], $_POST['idData'], 2);
            Atalhos::verificarConjunto($conjunto, 2);
            $_SESSION['sucessoChangeLab'] = 1;
            $query->close();
          }
        }else{
          if($aux['statusData'] == 'Aprovado'){
            $choque = explode(" ", $temp);
            $num = count($choque);
            for($i = 0; $i < $num; $i++){
              $choque[$i] = explode("-", $choque[$i]);
              if($query = $db->prepare("SELECT statusData FROM  tbcontroledatalab
                WHERE idReLab = ? AND idData = ?")){
                $query->bind_param('ii', $choque[$i][0], $choque[$i][1]);
                $query->execute();
                $query->bind_result($statusData);
                $query->fetch();
                $query->close();
                if($statusData == 'Aprovado'){
                  $_SESSION['errorChangeLab'] = 1;
                  break;
                }
              }
            }
          }
          if(!isset($_SESSION['errorChangeLab'])){
            if($query = $db->prepare("UPDATE tbcontroledatalab SET idLab = ? WHERE idReLab = ? AND idData = ?")){
              $query->bind_param('iii', $_POST['idLab'], $_POST['idReLab'], $_POST['idData']);
              $query->execute();
              Atalhos::addLogsAcoes('Modificou', 'tbcontroledatalab', $_POST['idReLab']);
              $conjunto = Atalhos::getConjunto($_POST['idReLab'], $_POST['idData'], 2);
              Atalhos::deletarConjunto($_POST['idReLab'], $_POST['idData'], 2);
              Atalhos::verificarConjunto($conjunto, 2);
              $_SESSION['sucessoChangeLab'] = 1;
              $query->close();
            }
          }
        }
      }
      $db->close();
    }

    public static function eqpEntregar(){
      $db = Atalhos::getBanco();
      $i = 1;
      while(isset($_POST['eqp'.$i])){
        if($query = $db->prepare("INSERT INTO tbalocareeq (idReEq, idData, patrimonio) VALUES (?, ?, ?)")){
          $query->bind_param('iii', $_POST['idReEq'], $_POST['idData'], $_POST['eqp'.$i]);
          $query->execute();
          $query->close();
          if($i == 1){
            if($query = $db->prepare("UPDATE tbcontroledataeq SET statusData='Entregue' WHERE idReEq = ? AND idData = ?")){
              $query->bind_param('ii', $_POST['idReEq'], $_POST['idData']);
              $query->execute();
              $query->close();
            }
          }
        }
        $i++;
      }
      $db->close();
    }

    public static function eqpEdit(){
      $db = Atalhos::getBanco();
      if($query = $db->prepare("UPDATE tbequipamento SET modelo = ? WHERE patrimonio = ?")){
        $query->bind_param('si', $_POST['modelo'], $_POST['patrimonio']);
        $query->execute();
        Atalhos::addLogsAcoes('Modificou', 'tbequipamento', $_POST['patrimonio']);
        $query->close();
        if(!empty($_POST['lab'])){
          if($query = $db->prepare("INSERT INTO tbalocalab VALUES (?, ?)")){
            $query->bind_param('ii', $_POST['lab'], $_POST['patrimonio']);
            $query->execute();
            $query->close();
          }
        }
        $_SESSION['avisoEqp'] = 'Equipamento editado com sucesso!';
      }
      $db->close();
    }

    public static function labEdit(){
      $db = Atalhos::getBanco();
      if($query = $db->prepare("UPDATE tblaboratorio SET nomeLab = ?, numComp = ?, capAluno = ? WHERE idLab = ?")){
        $query->bind_param('siii', $_POST['nome'], $_POST['pcs'], $_POST['capacidade'], $_POST['idLab']);
        $query->execute();
        Atalhos::addLogsAcoes('Modificou', 'tblaboratorio', $_POST['idLab']);
        $query->close();
        $_SESSION['avisoLab'] = 'Laboratório editado com sucesso!';
      }
      $db->close();
    }

    public static function labAdd(){
      $db = Atalhos::getBanco();
      if($query = $db->prepare("SELECT idCor FROM tblaboratorio ORDER BY idCor ASC")){
        $query->execute();
        $query->bind_result($idCor);
        $auxDb = Atalhos::getBanco();
        if($aux = $auxDb->prepare("SELECT idCor FROM tbcor ORDER BY idCor DESC LIMIT 1")){
          $aux->execute();
          $aux->bind_result($totalCor);
          $aux->fetch();
          $i = 1;
          while($query->fetch()){
            if($i != $idCor){
              break;
            }else{
              $i++;
            }
          }
          $query->close();
          $auxDb->close();
          $aux->close();
          if($i <= $totalCor){
            if($query = $db->prepare("INSERT INTO tblaboratorio (nomeLab, numComp, capAluno, statusLab, idCor)
              VALUES (?, ?, ?, ?, ?)")){
              $query->bind_param('siisi', $_POST['nome'], $_POST['pcs'], $_POST['capacidade'], $_POST['status'], $i);
              $query->execute();
              $idLab = $query->insert_id;
              Atalhos::addLogsAcoes('Inseriu', 'tblaboratorio', $idLab);
              $_SESSION['avisoLab'] = 'Laboratório adicionado com sucesso!';
            }
            $query->close();
            $db->close();
            header('Location: /recursos/laboratorios');
          }else{
            include 'corAdd';
          }
        }
      }
    }

    public static function eqpAdd(){
      $db = Atalhos::getBanco();
      $idTipoEq = $_POST['tipo'];
      if($query = $db->prepare("SELECT patrimonio FROM tbequipamento WHERE patrimonio = ?")){
        $query->bind_param('i', $_POST['patrimonio']);
        $query->execute();
        if($query->fetch() == null){
          if($_POST['tipo'] == 0){
            if($query = $db->prepare("SELECT idCor FROM tbtipoeq ORDER BY idCor ASC")){
              $query->execute();
              $query->bind_result($idCor);
              $auxDb = Atalhos::getBanco();
              if($aux = $auxDb->prepare("SELECT idCor FROM tbcor ORDER BY idCor DESC LIMIT 1")){
                $aux->execute();
                $aux->bind_result($totalCor);
                $aux->fetch();
                $i = 1;
                while($query->fetch()){
                  if($i != $idCor){
                    break;
                  }else{
                    $i++;
                  }
                }
                $query->close();
                $auxDb->close();
                $aux->close();
                if($i <= $totalCor){
                  if($query = $db->prepare("INSERT INTO tbtipoeq (tipoEq, numEq, idCor) VALUES (?, 0, ?)")){
                    $query->bind_param('si', $_POST['novoTipo'], $i);
                    $query->execute();
                    $idTipoEq = $query->insert_id;
                    $query->close();
                  }
                }else{
                  include '../funcoes/corAdd.php';
                }
              }
            }
          }
          if($query = $db->prepare("SELECT numEq FROM tbtipoeq WHERE idTipoEq = ? ")){
            $query->bind_param('i', $idTipoEq);
            $query->execute();
            $query->bind_result($numEq);
            $query->fetch();
            $query->close();
            $numEq++;
            if($aux1 = $db->prepare("UPDATE tbtipoeq SET numEq = ? WHERE idTipoEq = ?")){
              $aux1->bind_param('ii', $numEq, $idTipoEq);
              $aux1->execute();
              $aux1->close();
            }

            if($aux2 = $db->prepare("INSERT INTO tbequipamento (patrimonio, modelo, idTipoEq, statusEq) VALUES (?, ?, ?, ?)")){
              $aux2->bind_param('isis', $_POST['patrimonio'], $_POST['modelo'], $idTipoEq, $_POST['status']);
              $aux2->execute();
              $idEqp = $query->insert_id;
              Atalhos::addLogsAcoes('Inseriu', 'tbequipamento', $idEqp);
              $aux2->close();
              $db->close();
              $_SESSION['avisoEqp'] = 'Equipamento adicianado com sucesso!';
            }
          }
        }else{
          $_SESSION['errorEqp'] = 1;
        }
      }
    }

    public static function foto(){
      $idUser = $_POST['id'];
      $arquivo = $_FILES["imagem"]['tmp_name'];
      if(!empty($arquivo)){
        if($_FILES["imagem"]['size'] < 5242880){
          $imagem = file_get_contents($arquivo);
          $tamanhoImg = getimagesize($arquivo);
          if($tamanhoImg != false){
            $test = NULL;
            $db = Atalhos::getBanco();
            if($_POST['tipo'] == 1){
              if($query = $db->prepare('INSERT INTO tbimagem VALUES (?,?)')){
                $query->bind_param('ib', $idUser, $test);
                $query->send_long_data(1, $imagem);
                $query->execute();
                Atalhos::addLogsAcoes('Inseriu', 'tbimagem', $idUser);
                $query->close();
              }
            }else{
              if($query = $db->prepare("UPDATE tbimagem SET imagem = ? WHERE idUser = ?")){
                $query->bind_param('bi', $test, $idUser);
                $query->send_long_data(0, $imagem);
                $query->execute();
                Atalhos::addLogsAcoes('Modificou', 'tbimagem', $idUser);
                $query->close();
              }
            }
            $db->close();
          }
        }
      }
      header('Location: /perfil/'.$idUser.'/');
    }

    public static function laboratorio(){
      $db = Atalhos::getBanco();
      if($_POST['acao'] == 2){
        if($query = $db->prepare("UPDATE tblaboratorio SET statusLab = 'Ativo' WHERE idLab = ?")){
          $query->bind_param('i', $_POST['idLab']);
          $query->execute();
          Atalhos::addLogsAcoes('Modificou', 'tblaboratorio', $_POST['idLab']);
          $query->close();
        }
      }else if($_POST['acao'] == 1){
        if($query = $db->prepare("UPDATE tblaboratorio SET statusLab = 'Inativo' WHERE idLab = ?")){
          $query->bind_param('i', $_POST['idLab']);
          $query->execute();
          Atalhos::addLogsAcoes('Modificou', 'tblaboratorio', $_POST['idLab']);
          $query->close();
        }
      }else{
        if($query = $db->prepare("DELETE FROM tblaboratorio WHERE idLab = ?")){
          $query->bind_param('i', $_POST['idLab']);
          $query->execute();
          Atalhos::addLogsAcoes('Excluiu', 'tblaboratorio', $_POST['idLab']);
          $query->close();
        }
      }
      $db->close();
    }

    public static function equipamento(){
      $db = Atalhos::getBanco();
      if($_POST['acao'] == 2){
        if($query = $db->prepare("UPDATE tbequipamento SET statusEq = 'Ativo' WHERE patrimonio = ?")){
          $query->bind_param('i', $_POST['patrimonio']);
          $query->execute();
          Atalhos::addLogsAcoes('Modificou', 'tbequipamento', $_POST['patrimonio']);
          $query->close();
        }
      }else if($_POST['acao'] == 1){
        if($query = $db->prepare("UPDATE tbequipamento SET statusEq = 'Inativo' WHERE patrimonio = ?")){
          $query->bind_param('i', $_POST['patrimonio']);
          $query->execute();
          Atalhos::addLogsAcoes('Modificou', 'tbequipamento', $_POST['patrimonio']);
          $query->close();
        }
      }else{
        if($query = $db->prepare("SELECT a.idTipoEq, b.numEq FROM tbequipamento a
          inner join tbtipoeq b ON a.idTipoEq = b.idTipoEq WHERE patrimonio = ?")){
          $query->bind_param('i', $_POST['patrimonio']);
          $query->execute();
          $query->bind_result($idTipoEq, $numEq);
          $query->fetch();
          $query->close();
          if($query = $db->prepare("DELETE FROM tbequipamento WHERE patrimonio = ?")){
            $query->bind_param('i', $_POST['patrimonio']);
            $query->execute();
            Atalhos::addLogsAcoes('Excluiu', 'tbequipamento', $_POST['patrimonio']);
            $query->close();
          }
          if($numEq > 1){
            $numEq--;
            if($query = $db->prepare("UPDATE tbtipoeq SET numEq = ? WHERE idTipoEq = ?")){
              $query->bind_param('ii', $numEq, $idTipoEq);
              $query->execute();
              $query->close();
            }
          }else{
            if($query = $db->prepare("DELETE FROM tbtipoeq WHERE idTipoEq = ?")){
              $query->bind_param('i', $idTipoEq);
              $query->execute();
              $query->close();
            }
          }
        }
      }
      $db->close();
    }

    public static function disciplina(){
      $db = Atalhos::getBanco();
      if($_POST['acao'] == 2){
        if($query = $db->prepare("UPDATE tbdisciplinas SET status = 'Ativo' WHERE idDisc = ?")){
          $query->bind_param('i', $_POST['idDisc']);
          $query->execute();
          Atalhos::addLogsAcoes('Modificou', 'tbdisciplinas', $_POST['idDisc']);
          $query->close();
        }
      }else if($_POST['acao'] == 1){
        if($query = $db->prepare("UPDATE tbdisciplinas SET status = 'Inativo' WHERE idDisc = ?")){
          $query->bind_param('i', $_POST['idDisc']);
          $query->execute();
          Atalhos::addLogsAcoes('Modificou', 'tbdisciplinas', $_POST['idDisc']);
          $query->close();
        }
      }
      $db->close();
    }

    public static function attDiscriplina(){
      $db = Atalhos::getBanco();
      $num = preg_match_all('/<td class="cod">(.+)<\/td>/', file_get_contents('https://www.sigaa.ufs.br/sigaa/public/departamento/componentes.jsf?id=83'), $br);
      preg_match_all('/<td class="nome">(.+)<\/td>/', file_get_contents('https://www.sigaa.ufs.br/sigaa/public/departamento/componentes.jsf?id=83'), $br2);
      preg_match_all('/<td class="ch">(.+)<\/td>/', file_get_contents('https://www.sigaa.ufs.br/sigaa/public/departamento/componentes.jsf?id=83'), $br3);
      for($i = 0; $i<$num; $i++){
        if($query = $db->prepare("SELECT nome FROM tbdisciplinas WHERE codigo = ?")){
          $query->bind_param('s', $br[1][$i]);
          $query->execute();
          if(!($query->fetch())){
            if($aux = $db->prepare("INSERT INTO tbdisciplinas(nome, codigo, carga) VALUES (?, ?, ?)")){
              $aux->bind_param('sss', $br2[1][$i], $br[1][$i], $br3[1][$i]);
              $aux->execute();
              $aux->close();
            }
          }
          $query->close();
        }
      }
      Atalhos::addLogsAcoes('Atualizou disciplinas.', null, null);
      $_SESSION['disciplinasAtt'] = 1;
    }

    public static function perfil(){
      $db = Atalhos::getBanco();
      if(isset($_POST['acao2'])){
        $idUser = $_POST['idUserBlock'];
        if($_POST['acao2'] == 2){
          if($query = $db->prepare("UPDATE tbusuario SET statusUser = 'Inativo' WHERE idUser = ?")){
            $query->bind_param('i', $_POST['idUserBlock']);
            $query->execute();
            $query->close();
            if($query = $db->prepare("INSERT INTO tbblock (idUserBlock, idUser, motivoBlock, dataInicio, dataFim)
              VALUES (?, ?, ?, ?, ?)")){
              $query->bind_param('iisss', $_POST['idUserBlock'], $_POST['idUser2'], $_POST['motivo'], date("Y-m-d"),
                date("Y-m-d", strtotime("+".$_POST['duracao']." days")));
              $query->execute();
              $idBlock = $query->insert_id;
              Atalhos::addLogsAcoes('Inseriu', 'tbblock', $idBlock);
              $query->close();
            }
          }
          $_SESSION['avisoBlock'] = 1;
        }else{
          if($query = $db->prepare("UPDATE tbusuario SET statusUser = 'Ativo' WHERE idUser = ?")){
            $query->bind_param('i', $_POST['idUserBlock']);
            $query->execute();
            $query->close();
            $dataFim = date("Y-m-d");
            if($dataFim != $_POST['dataFim']){
              if($query = $db->prepare("UPDATE tbblock SET dataFim = ? WHERE idBlock =")){
                $query->bind_param('si', $dataFim, $_POST['idBlock']);
                $query->execute();
                Atalhos::addLogsAcoes('Modificou', 'tbblock', $_POST['idBlock']);
                $query->close();
              }
            }
          }
          $_SESSION['avisoDesblock'] = 1;
        }
      }elseif(isset($_POST['acao4'])){
        $idUser = $_POST['idUserAcesso'];
        $qtdeAcessos = $_POST['qtdeAcessos'];
        if($_POST['acao4']){
          if($query = $db->prepare("UPDATE tbusuario SET statusLogin = ? WHERE idUser = ?")){
            $query->bind_param('ii', $qtdeAcessos, $_POST['idUserAcesso']);
            $query->execute();
            Atalhos::addLogsAcoes('Modificou', 'tbusuario', $_POST['idUserAcesso']);
            $query->close();
          }
        }
      }elseif(isset($_POST['acao3'])){
        $idUser = $_POST['idUser3'];
        $idAfiliacao = $_POST['idAfiliacao'];
        if($idAfiliacao == -1){
          if($query = $db->prepare("INSERT INTO tbafiliacao (afiliacao, nivel) VALUES (?, ?)")){
            $query->bind_param('si', $_POST['novaAfiliacao'], $_POST['idNivel']);
            $query->execute();
            $idAfiliacao = $query->insert_id;
            Atalhos::addLogsAcoes('Inseriu', 'tbafiliacao', $idAfiliacao);
            $query->close();
          }
        }
        /*if($_POST['login'] != $_POST['user']){
          if($query = $db->prepare("UPDATE tbusuario SET nomeUser = ?, login = ?, email = AES_ENCRYPT(?, ?), idAfiliacao = ?, nivel = ? WHERE idUser = ?")){
            $query->bind_param('ssssiii', $_POST['nome'], $_POST['login'], $_POST['email'], $_SESSION['chave'], $_POST['idAfiliacao'],  $_POST['idNivel'], $_POST['idUser3']);
            $query->execute();
            $query->close();
          }
        }else{
          if($query = $db->prepare("UPDATE tbusuario SET nomeUser = ?, email = AES_ENCRYPT(?, ?), idAfiliacao = ?, nivel = ? WHERE idUser = ?")){
            $query->bind_param('sssiii', $_POST['nome'], $_POST['email'], $_SESSION['chave'], $idAfiliacao,  $_POST['idNivel'], $_POST['idUser3']);
            $query->execute();
            $query->close();
          }
        }
        if($query = $db->prepare("UPDATE tbmatricula SET matricula = ? WHERE idUser = ?")){
          $query->bind_param('si', $_POST['matricula'], $_POST['idUser3']);
          $query->execute();
          $query->close();
        }*/
        if(isset($_POST['idNivel'])){
          if($query = $db->prepare("UPDATE tbusuario SET idAfiliacao = ? WHERE idUser = ?")){
            $query->bind_param('ii', $idAfiliacao,  $_POST['idUser3']);
            $query->execute();
            $query->close();
          }
          if ($query = $db->prepare("SELECT nivel FROM tbusuario WHERE idUser = ?")){
            $query->bind_param('i', $_POST['idUser3']);
            $query->execute();
            $query->bind_result($nivelUser);
            $query->fetch();
            $query->close();
          }
          if($nivelUser == 0){
            if ($query = $db->prepare("SELECT * FROM tbusuario WHERE nivel = ?")){
              $query->bind_param('i', $nivelUser);
              $query->execute();
              $query->store_result();
              if ($query->num_rows > 3){
                if($aux = $db->prepare("UPDATE tbusuario SET nivel = ? WHERE idUser = ?")){
                  $aux->bind_param('ii', $_POST['idNivel'], $_POST['idUser3']);
                  $aux->execute();
                  Atalhos::addLogsAcoes('Modificou', 'tbusuario', $_POST['idUser3']);
                  $aux->close();
                }
              }else{
                $_SESSION['erroAdmin'] = 1 ;
              }
              $query->close();
            }
          }else{
            if($aux = $db->prepare("UPDATE tbusuario SET nivel = ? WHERE idUser = ?")){
                $aux->bind_param('ii', $_POST['idNivel'], $_POST['idUser3']);
                $aux->execute();
                Atalhos::addLogsAcoes('Modificou', 'tbusuario', $_POST['idUser3']);
                $aux->close();
              }
          }
        }else{
          if($query = $db->prepare("UPDATE tbusuario SET email = AES_ENCRYPT(?, ?) WHERE idUser = ?")){
            $query->bind_param('ssi', $_POST['email'], $_SESSION['chave'], $_POST['idUser3']);
            $query->execute();
            Atalhos::addLogsAcoes('Modificou', 'tbusuario', $_POST['idUser3']);
            $query->close();
          }
        }
        $_SESSION['alterDados'] = 1;
      }else{
        $idUser = $_POST['idUser'];
        switch($_POST['acao']){
          case 3://desativar sudo
            break;
          case 4://ativar sudo
            break;
          case 6://excluir foto
            if($query = $db->prepare("DELETE FROM tbimagem WHERE idUser = ?")){
              $query->bind_param('i', $_POST['idUser']);
              $query->execute();
              Atalhos::addLogsAcoes('Excluiu', 'tbimagem', $_POST['idUser']);
              $query->close();
            }
            break;
        }
      }
      $db->close();
      header('Location: /perfil/'.$idUser.'/');
    }

    public static function avisosStatus(){
      $db = Atalhos::getBanco();
      if($_POST['acao'] == 1){
        if($query = $db->prepare("UPDATE tbavisos SET statusAviso = 'Inativo' WHERE idAviso = ?")){
          $query->bind_param('i', $_POST['idAviso']);
          $query->execute();
          Atalhos::addLogsAcoes('Modificou', 'tbavisos', $_POST['idAviso']);
          $query->close();
        }
      }elseif($_POST['acao'] == 2){
        if($query = $db->prepare("UPDATE tbavisos SET statusAviso = 'Ativo' WHERE idAviso = ?")){
          $query->bind_param('i', $_POST['idAviso']);
          $query->execute();
          Atalhos::addLogsAcoes('Modificou', 'tbavisos', $_POST['idAviso']);
          $query->close();
        }
      }else{
        if($query = $db->prepare("DELETE FROM tbavisos WHERE idAviso = ?")){
          $query->bind_param('i', $_POST['idAviso']);
          $query->execute();
          Atalhos::addLogsAcoes('Excluiu', 'tbavisos', $_POST['idAviso']);
          $query->close();
        }
      }
      $db->close();
    }

    public static function avisoAdd(){
      $db = Atalhos::getBanco();
      if($query = $db->prepare("INSERT INTO tbavisos (tituloAviso, textoAviso, dataAviso) VALUES (?, ?, ?)")){
        $query->bind_param('sss', $_POST['titulo'], $_POST['texto'], date("Y-m-d", time()));
        $query->execute();
        $idAviso = $query->insert_id;
        Atalhos::addLogsAcoes('Inseriu', 'tbavisos', $idAviso);
        $query->close();
        $_SESSION['avisoPainel'] = 1;
      }
      $db->close();
    }

    public static function avisoEdit(){
      $db = Atalhos::getBanco();
      if($query = $db->prepare("UPDATE tbavisos SET tituloAviso = ?, textoAviso = ? WHERE idAviso = ?")){
        $query->bind_param('ssi', $_POST['titulo'], $_POST['texto'], $_POST['idAviso']);
        $query->execute();
        Atalhos::addLogsAcoes('Modificou', 'tbavisos', $_POST['idAviso']);
        $query->close();
        $_SESSION['avisoPainel'] = 1;
      }
      $db->close();
    }

    public static function moderarLab(){
      $db = Atalhos::getBanco();
      if(isset($_POST['acao2'])){
        if(empty($_POST['justificativa'])){
          $_SESSION['errorModerarLab'] = 1;
        }else{
          if($query = $db->prepare("SELECT idNoti FROM tbnotificacao ORDER BY idNoti DESC LIMIT 1")){
              $query->bind_result($idNoti);
              $query->execute();
            if($query->fetch()){
              $idNoti++;
            }else{
              $idNoti = 0;
            }
            $query->close();
          }
          if($acao = 'Negado'){
            $status = 'Negada';
          }else{
            $status = 'Cancelada';
          }
          if($_SESSION['id'] != $_POST['idUser2']){
            $noti = '<li>
                      <a href="noti.php?id='.$idNoti.'&ir=/salas/minhas" style="background-color: #EFEEEE">
                        <i class="fa fa-pencil-square-o text-red"></i> Sua reserva foi '.$status.'
                      </a>
                    </li>';
            if($query = $db->prepare("INSERT INTO tbnotificacao (idNoti, notificacao, statusNoti)
              VALUES ('".$idNoti."', '".$noti."', 'false')")){
              $query->execute();
              $query->close();
            }
            if($query = $db->prepare("INSERT INTO tbnoticonexao VALUES ('".$_POST['idUser2']."', '".$idNoti."')")){
              $query->execute();
              $query->close();
            }
          }
          if($_POST['id2'] == 0){
            if($query = $db->prepare("UPDATE tbcontroledatalab SET statusData = ?, justificativa = ?
              WHERE idReLab = ?")){
              $query->bind_param('ssi', $_POST['acao2'], $_POST['justificativa'],$_POST['idre2']);
              $query->execute();
              Atalhos::addLogsAcoes('Modificou', 'tbcontroledatalab', $_POST['idre2']);
              $query->close();
            }
            $conjunto = Atalhos::getConjunto($_POST['idre2'], 0, 2);
            if($conjunto != false){
              Atalhos::deletarConjunto($_POST['idre2'], 0, 2);
              Atalhos::verificarConjunto($conjunto, 2);
            }
          }else{
            if($query = $db->prepare("UPDATE tbcontroledatalab SET statusData = ?, justificativa = ?
              WHERE idReLab = ? AND idData = ?")){
              $query->bind_param('ssii', $_POST['acao2'], $_POST['justificativa'],$_POST['idre2'], $_POST['id2']);
              $query->execute();
              Atalhos::addLogsAcoes('Modificou', 'tbcontroledatalab', $_POST['idre2']);
            }
            $conjunto = Atalhos::getConjunto($_POST['idre2'], $_POST['id2'], 2);
            if($conjunto != false){
              Atalhos::deletarConjunto($_POST['idre2'], $_POST['id2'], 2);
              Atalhos::verificarConjunto($conjunto, 2);
            }
          }
        }
      }elseif($_POST['acao'] == 'Excluir'){
        if($_POST['id'] == 0){
          if($query = $db->prepare("DELETE FROM tbreservalab WHERE idReLab =?")){
            $query->bind_param('i',$_POST['idre']);
            $query->execute();
            Atalhos::addLogsAcoes('Excluiu', 'tbreservalab', $_POST['idre']);
          }
        }else{
          if($query = $db->prepare("DELETE FROM tbcontroledatalab WHERE idReLab =? AND idData =?")){
            $query->bind_param('ii',$_POST['idre'], $_POST['id']);
            $query->execute();
            Atalhos::addLogsAcoes('Excluiu', 'tbcontroledatalab', $_POST['idre']);
          }
        }
      }else{
        if($_POST['acao'] == "Recebido" || $_POST['acao'] == "Entregue"){
          if($query = $db->prepare("UPDATE tbcontroledatalab SET statusData = ? WHERE idData = ? AND idReLab = ?")){
            $query->bind_param('sii',$_POST['acao'], $_POST['id'], $_POST['idre']);
            $query->execute();
            Atalhos::addLogsAcoes('Modificou', 'tbcontroledatalab', $_POST['idre']);
          }
        }else{
          if($_SESSION['id'] != $_POST['idUser']){
            $noti = '<li>
                      <a href="noti.php?id='.$idNoti.'&ir=/salas/minhas" style="background-color: #EFEEEE">
                        <i class="fa fa-pencil-square-o text-red"></i> Sua reserva foi '.$status.'
                      </a>
                    </li>';
            if($query = $db->prepare("INSERT INTO tbnotificacao (idNoti, notificacao, statusNoti) VALUES (?, ?, 'false')")){
              $query->bind_param('is',$idNoti, $noti);
              $query->execute();
              $query->close();
            }
            if($query = $db->prepare("INSERT INTO tbnoticonexao VALUES (?, ?)")){
              $query->bind_param('ii',$_POST['idUser'], $idNoti);
              $query->execute();
              $query->close();
            }
          }
          if($_POST['id'] == 0){
            if($query = $db->prepare("SELECT idData FROM tbcontroledatalab WHERE idReLab= ?")){
              $query->bind_param('i',$_POST['idre']);
              $query->execute();
              if($query->fetch()){
                if(Atalhos::getConjunto($_POST['idre'], 0, 2)){
                  $_SESSION['errorAprovar'] = 2;
                }else{
                  $query->close();
                  if($query = $db->prepare("UPDATE tbcontroledatalab SET statusData = ? WHERE idReLab = ?")){
                    $query->bind_param('si',$_POST['acao'], $_POST['idre']);
                    $query->execute();
                    Atalhos::addLogsAcoes('Modificou', 'tbcontroledatalab', $_POST['idre']);
                    $query->close();
                  }
                }
              }else{
                $query->close();
                if($query = $db->prepare("UPDATE tbcontroledatalab SET statusData = ? WHERE idReLab = ?")){
                  $query->bind_param('si',$_POST['acao'], $_POST['idre']);
                  $query->execute();
                  Atalhos::addLogsAcoes('Modificou', 'tbcontroledatalab', $_POST['idre']);
                  $query->close();
                }
              }
            }
          }else{
            if(Atalhos::getConjunto($_POST['idre'], $_POST['id'], 2) == false){
              if($query = $db->prepare("UPDATE tbcontroledatalab SET statusData = ? WHERE idReLab = ? AND idData = ?")){
                $query->bind_param('sii',$_POST['acao'], $_POST['idre'], $_POST['id']);
                $query->execute();
                Atalhos::addLogsAcoes('Modificou', 'tbcontroledatalab', $_POST['idre']);
                $query->close();
              }
            }else{
              $_SESSION['errorAprovar'] = 1;
            }
          }
        }
      }
      $db->close();
    }

    public static function moderarEq(){
      $db = Atalhos::getBanco();
      if(isset($_POST['acao2'])){
        if(empty($_POST['justificativa'])){
          $_SESSION['errorModerarEqp'] = 1;
        }else{
          if($query = $db->prepare("SELECT idNoti FROM tbnotificacao ORDER BY idNoti DESC LIMIT 1")){
              $query->bind_result($idNoti);
              $query->execute();
            if($query->fetch()){
              $idNoti++;
            }else{
              $idNoti = 0;
            }
            $query->close();
          }
          if($acao = 'Negado'){
            $status = 'Negada';
          }else{
            $status = 'Cancelada';
          }
          if($_SESSION['id'] != $_POST['idUser2']){
            $noti = '<li>
                      <a href="noti.php?id='.$idNoti.'&ir=/salas/minhas" style="background-color: #EFEEEE">
                        <i class="fa fa-pencil-square-o text-red"></i> Sua reserva foi '.$status.'
                      </a>
                    </li>';
            if($query = $db->prepare("INSERT INTO tbnotificacao (idNoti, notificacao, statusNoti)
              VALUES ('".$idNoti."', '".$noti."', 'false')")){
              $query->execute();
              $query->close();
            }
            if($query = $db->prepare("INSERT INTO tbnoticonexao VALUES ('".$_POST['idUser2']."', '".$idNoti."')")){
              $query->execute();
              $query->close();
            }
          }
          if($_POST['id2'] == 0){
            if($query = $db->prepare("UPDATE tbcontroledataeq SET statusData = ?, justificativa = ?
              WHERE idReEq = ?")){
              $query->bind_param('ssi', $_POST['acao2'], $_POST['justificativa'],$_POST['idreeq2']);
              $query->execute();
              Atalhos::addLogsAcoes('Modificou', 'tbcontroledataeq', $_POST['idreeq2']);
              $query->close();
            }
            $conjunto = Atalhos::getConjunto($_POST['idreeq2'], 0, 1);
            if($conjunto != false){
              Atalhos::deletarConjunto($_POST['idreeq2'], 0, 1);
              Atalhos::verificarConjunto($conjunto, 1);
            }
          }else{
            if($query = $db->prepare("UPDATE tbcontroledataeq SET statusData = ?, justificativa = ?
              WHERE idReEq = ? AND idData = ?")){
              $query->bind_param('ssii', $_POST['acao2'], $_POST['justificativa'],$_POST['idreeq2'], $_POST['id2']);
              $query->execute();
              Atalhos::addLogsAcoes('Modificou', 'tbcontroledataeq', $_POST['idreeq2']);
            }
            $conjunto = Atalhos::getConjunto($_POST['idreeq2'], $_POST['id2'], 1);
            if($conjunto != false){
              Atalhos::deletarConjunto($_POST['idreeq2'], $_POST['id2'], 1);
              Atalhos::verificarConjunto($conjunto, 1);
            }
          }
        }
      }elseif($_POST['acao'] == 'Excluir'){
        if($_POST['id'] == 0){
          if($query = $db->prepare("DELETE FROM tbreservaeq WHERE idReEq =?")){
            $query->bind_param('i',$_POST['idreeq']);
            $query->execute();
            Atalhos::addLogsAcoes('Excluiu', 'tbreservaeq', $_POST['idreeq']);
          }
        }else{
          if($query = $db->prepare("DELETE FROM tbcontroledataeq WHERE idReEq =? AND idData =?")){
            $query->bind_param('ii',$_POST['idreeq'], $_POST['id']);
            $query->execute();
            Atalhos::addLogsAcoes('Excluiu', 'tbcontroledataeq', $_POST['idreeq']);
          }
        }
      }else{
        if($_POST['acao'] == "Recebido" || $_POST['acao'] == "Entregue"){
          if($query = $db->prepare("UPDATE tbcontroledataeq SET statusData = ? WHERE idData = ? AND idReEq = ?")){
            $query->bind_param('sii',$_POST['acao'], $_POST['id'], $_POST['idreeq']);
            $query->execute();
            Atalhos::addLogsAcoes('Modificou', 'tbcontroledataeq', $_POST['idreeq']);
          }
        }else{
          if($_SESSION['id'] != $_POST['idUser']){
            $noti = '<li>
                      <a href="noti.php?id='.$idNoti.'&ir=/salas/minhas" style="background-color: #EFEEEE">
                        <i class="fa fa-pencil-square-o text-red"></i> Sua reserva foi '.$status.'
                      </a>
                    </li>';
            if($query = $db->prepare("INSERT INTO tbnotificacao (idNoti, notificacao, statusNoti) VALUES (?, ?, 'false')")){
              $query->bind_param('is',$idNoti, $noti);
              $query->execute();
              $query->close();
            }
            if($query = $db->prepare("INSERT INTO tbnoticonexao VALUES (?, ?)")){
              $query->bind_param('ii',$_POST['idUser'], $idNoti);
              $query->execute();
              $query->close();
            }
          }
          if($_POST['id'] == 0){
            if($query = $db->prepare("SELECT idData FROM tbcontroledataeq WHERE idReEq= ?")){
              $query->bind_param('i',$_POST['idreeq']);
              $query->execute();
              if($query->fetch()){
                if(Atalhos::getConjunto($_POST['idreeq'], 0, 1)){
                  $_SESSION['errorAprovar'] = 2;
                }else{
                  $query->close();
                  if($query = $db->prepare("UPDATE tbcontroledataeq SET statusData = ? WHERE idReEq = ?")){
                    $query->bind_param('si',$_POST['acao'], $_POST['idreeq']);
                    $query->execute();
                    Atalhos::addLogsAcoes('Modificou', 'tbcontroledataeq', $_POST['idreeq']);
                    $query->close();
                  }
                }
              }else{
                $query->close();
                if($query = $db->prepare("UPDATE tbcontroledataeq SET statusData = ? WHERE idReEq = ?")){
                  $query->bind_param('si',$_POST['acao'], $_POST['idreeq']);
                  $query->execute();
                  Atalhos::addLogsAcoes('Modificou', 'tbcontroledataeq', $_POST['idreeq']);
                  $query->close();
                }
              }
            }
          }else{
            if(Atalhos::getConjunto($_POST['idreeq'], $_POST['id'], 1) == false){
              if($query = $db->prepare("UPDATE tbcontroledataeq SET statusData = ? WHERE idReEq = ? AND idData = ?")){
                $query->bind_param('sii',$_POST['acao'], $_POST['idreeq'], $_POST['id']);
                $query->execute();
                Atalhos::addLogsAcoes('Modificou', 'tbcontroledataeq', $_POST['idreeq']);
                $query->close();
              }
            }else{
              $_SESSION['errorAprovar'] = 1;
            }
          }
        }
      }
      $db->close();
    }

    public static function calendarioLab(){
      $db = Atalhos::getBanco();
      if($_SESSION['nivel'] == 1){
        $status ='Aprovado';
      }else{
        $status = 'Pendente';
      }
      $subdata = explode(" - ", $_POST['data']);
      $dataini = date("Y-m-d H:i", strtotime(str_replace('/', '-', $subdata[0])));
      $datafim = date("Y-m-d H:i", strtotime(str_replace('/', '-', $subdata[1])));
      if($_POST['tipo'] == 'Compartilhado'){
        $pcs = $_POST['pcs'];
      }else{
        $pcs = 0;
      }
      switch($_POST['reserva']){
        case 'aula_dcomp':
          $titulo = $_POST['disciplina'];
          $motivo = $_POST['motivo_aula'];
          break;
        case 'aula_outros':
          $titulo = $_POST['titulo_aula'];
          $motivo = $_POST['motivo_aula'];
          break;
        case 'tcc':
          $titulo = 'TCC - '.$_POST['titulo_tcc'];
          $motivo = $_POST['motivo_tcc'];
          break;
        default:
          $titulo = $_POST['titulo_outro'];
          $motivo = $_POST['motivo_outro'];
          break;
      }
      if($_POST['tempo'] == "UmaVez"){
        if($query = $db->prepare("INSERT INTO tbreservalab (idUser, tipoReLab, tituloReLab, motivoReLab, numPc)
          VALUES (?, ?, ?, ?, ?)")){
          $query->bind_param('isssi', $_SESSION['id'], $_POST['tipo'], $titulo, $motivo, $pcs);
          $query->execute();
          $idReLab = $query->insert_id;
          Atalhos::addLogsAcoes('Inseriu', 'tbreservalab', $idReLab);
          $query->close();
          $j = 1;
          while(isset($_POST['lab'.$j])){
            if($query = $db->prepare("INSERT INTO tbalocarelab (idLab, idReLab) VALUES (?, ?)")){
              $query->bind_param('ii', $_POST['lab'.$j], $idReLab);
              $query->execute();
              $query->close();
            }
            $j++;
          }
        }
        if($query = $db->prepare("SELECT idData FROM tbdata WHERE inicio = ? AND fim = ? LIMIT 1")){
          $query->bind_param('ss', $dataini, $datafim);
          $query->execute();
          $query->bind_result($idData);
          if($query->fetch() == NULL){
            $auxDb = Atalhos::getBanco();
            if($aux = $auxDb->prepare("INSERT INTO tbdata (inicio, fim) VALUES (?, ?)")){
              $aux->bind_param('ss', $dataini, $datafim);
              $aux->execute();
              $idData = $aux->insert_id;
              $aux->close();
              $auxDb->close();
            }
          }
          $query->close();
          if($query = $db->prepare("INSERT INTO tbcontroledatalab (idReLab, idData, idLab, statusData) VALUES (?, ?, ?, ?)")){
            $result = Atalhos::choqueLab($dataini, $datafim, $_POST['lab1'], $_POST['tipo'], $pcs);
            $query->bind_param('iiis', $idReLab, $idData, $_POST['lab1'], $status);
            if($result != false){
              if($status == 'Aprovado'){
                $status = 'Pendente';
                $_SESSION['choqueReserva'] = 1;
              }
              $query->execute();
              $idCon = $aux->insert_id;
              Atalhos::addLogsAcoes('Inseriu', 'tbcontroledatalab', $idCon);
              Atalhos::includeChoque($result, $idReLab, $idData, 2);
            }else{
              $query->execute();
              $idCon = $aux->insert_id;
              Atalhos::addLogsAcoes('Inseriu', 'tbcontroledatalab', $idCon);
            }
            $query->close();
          }
        }
        $_SESSION['avisoCalendario'] = 1;
      }else{
        $horaIni = explode(" ", $dataini);
        $inicio = $horaIni[0];
        $horaIni = $horaIni[1];
        $horaFim = explode(" ", $datafim);
        $fim = date_create($horaFim[0]);
        $horaFim = $horaFim[1];
        $verificaData = 0;
        if(isset($_POST["dias"])) {
          foreach($_POST["dias"] as $value){
            $auxData = date_create($inicio);
            while(date('N', date_timestamp_get($auxData)) != $value AND $auxData <= $fim){
              date_add($auxData, date_interval_create_from_date_string('1 day'));
            }
            for($ini = $auxData; $ini <= $fim; date_add($auxData, date_interval_create_from_date_string('7 day'))){
              $day = date_format($auxData, 'Y-m-d');
              $dataini = $day." ".$horaIni;
              $datafim = $day." ".$horaFim;
              if($verificaData == 0){
                if($query = $db->prepare("INSERT INTO tbreservalab (idUser, tipoReLab, tituloReLab, motivoReLab, numPc)
                  VALUES (?, ?, ?, ?, ?)")){
                  $query->bind_param('isssi', $_SESSION['id'], $_POST['tipo'], $titulo, $motivo, $pcs);
                  $query->execute();
                  $idReLab = $query->insert_id;
                  Atalhos::addLogsAcoes('Inseriu', 'tbreservalab', $idReLab);
                  $query->close();
                }
                $verificaData = 1;
              }
              if($query = $db->prepare("SELECT idData FROM tbdata WHERE inicio = ? AND fim = ? LIMIT 1")){
                $query->bind_param('ss', $dataini, $datafim);
                $query->execute();
                $query->bind_result($idData);
                if($query->fetch() == NULL){
                  $auxDb = Atalhos::getBanco();
                  if($aux = $auxDb->prepare("INSERT INTO tbdata (inicio, fim) VALUES (?, ?)")){
                    $aux->bind_param('ss', $dataini, $datafim);
                    $aux->execute();
                    $idData = $aux->insert_id;
                    $aux->close();
                    $auxDb->close();
                  }
                }
                $query->close();
                if($query = $db->prepare("INSERT INTO tbcontroledatalab (idReLab, idData, idLab, statusData) VALUES (?, ?, ?, ?)")){
                  $result = Atalhos::choqueLab($dataini, $datafim, $_POST['lab1'], $_POST['tipo'], $pcs);
                  $query->bind_param('iiis', $idReLab, $idData, $_POST['lab1'], $status);
                  if($result != false){
                    if($status == 'Aprovado'){
                      $status = 'Pendente';
                      $_SESSION['choqueReserva'] = 1;
                    }
                    $query->execute();
                    $idCon = $aux->insert_id;
                    Atalhos::addLogsAcoes('Inseriu', 'tbcontroledatalab', $idCon);
                    echo 'Result: '.$result.'</br>';
                    Atalhos::includeChoque($result, $idReLab, $idData, 2);
                  }else{
                    $query->execute();
                    $idCon = $aux->insert_id;
                    Atalhos::addLogsAcoes('Inseriu', 'tbcontroledatalab', $idCon);
                  }
                  $query->close();
                }
              }
            }
          }
        }
        if ($verificaData == 1){
          $_SESSION['avisoCalendario'] = 1;
        }else{
          $_SESSION['errorCalendario'] = "O dia da semana selecionado não pertence ao intervalo escolhido!";
        }
      }
      $db->close();
    }

    public static function calendarioEq(){
      $db = Atalhos::getBanco();
      if($_SESSION['nivel'] == 1){
        $status ='Aprovado';
      }else{
        $status = 'Pendente';
      }
      $subdata = explode(" - ", $_POST['data']);
      $dataini = date("Y-m-d H:i", strtotime(str_replace('/', '-', $subdata[0])));
      $datafim = date("Y-m-d H:i", strtotime(str_replace('/', '-', $subdata[1])));
      switch($_POST['reserva']){
        case 'aula_dcomp':
          $titulo = $_POST['disciplina'];
          $motivo = $_POST['motivo_aula'];
          break;
        case 'aula_outros':
          $titulo = $_POST['titulo_aula'];
          $motivo = $_POST['motivo_aula'];
          break;
        case 'tcc':
          $titulo = 'TCC - '.$_POST['titulo_tcc'];
          $motivo = $_POST['motivo_tcc'];
          break;
        default:
          $titulo = $_POST['titulo_outro'];
          $motivo = $_POST['motivo_outro'];
          break;
      }
      if($_POST['tempo'] == "UmaVez"){

        if($query = $db->prepare("INSERT INTO tbreservaeq (idUser, tituloReEq, motivoReEq) VALUES (?, ?, ?)")){
          $query->bind_param('iss', $_SESSION['id'], $titulo, $motivo);
          $query->execute();
          $idReEq = $query->insert_id;
          Atalhos::addLogsAcoes('Inseriu', 'tbreservaeq', $idReEq);
          $query->close();
        }
        if($query = $db->prepare("SELECT idData FROM tbdata WHERE inicio = ? AND fim = ? LIMIT 1")){
          $query->bind_param('ss', $dataini, $datafim);
          $query->execute();
          $query->bind_result($idData);
          if($query->fetch() == null){
            $auxDb = Atalhos::getBanco();
            if($aux = $auxDb->prepare("INSERT INTO tbdata (inicio, fim) VALUES (?, ?)")){
              $aux->bind_param('ss', $dataini, $datafim);
              $aux->execute();
              $idData = $aux->insert_id;
              $aux->close();
              $auxDb->close();
            }
          }
          $j = 1;
          $teste = true;
          while(isset($_POST['eqp'.$j])){
            if($query = $db->prepare("INSERT INTO tbreservatipoeq (idReEq, idTipoEq, numReEq) VALUES (?, ?, ?)")){
              $query->bind_param('iii', $idReEq, $_POST['eqp'.$j], $_POST['numEq'.$j]);
              $query->execute();
              $query->close();
              $result = Atalhos::choqueEq($dataini, $datafim, $_POST['eqp'.$j], $_POST['numEq'.$j++]);
              if($result != false){
                if($status == 'Aprovado'){
                  $status = 'Pendente';
                  $_SESSION['choqueReserva'] = 1;
                }
                if($teste){
                  if($query = $db->prepare("INSERT INTO tbcontroledataeq (idReEq, idData, statusData) VALUES (?, ?, ?)")){
                    $query->bind_param('iis', $idReEq, $idData, $status);
                    $query->execute();
                    $teste = false;
                    Atalhos::includeChoque($result, $idReEq, $idData, 1);
                    $query->close();
                  }
                }
              }
            }
          }
          if($teste){
            if($query = $db->prepare("INSERT INTO tbcontroledataeq (idReEq, idData, statusData) VALUES (?, ?, ?)")){
              $query->bind_param('iis', $idReEq, $idData, $status);
              $query->execute();
              $idCon = $query->insert_id;
              Atalhos::addLogsAcoes('Inseriu', 'tbcontroledataeq', $idCon);
              $query->close();
            }
          }
        }
        $_SESSION['avisoCalendario'] = 1;
      }else{
        $horaIni = explode(" ", $dataini);
        $inicio = $horaIni[0];
        $horaIni = $horaIni[1];
        $horaFim = explode(" ", $datafim);
        $fim = date_create($horaFim[0]);
        $horaFim = $horaFim[1];
        $verificaData = 0;
        if(isset($_POST["dias"])) {
          foreach($_POST["dias"] as $value){
            $auxData = date_create($inicio);
            while(date('N', date_timestamp_get($auxData)) != $value AND $auxData <= $fim){
              date_add($auxData, date_interval_create_from_date_string('1 day'));
            }
            for($ini = $auxData; $ini <= $fim; date_add($auxData, date_interval_create_from_date_string('7 day'))){
              $day = date_format($auxData, 'Y-m-d');
              $dataini = $day." ".$horaIni;
              $datafim = $day." ".$horaFim;
              if($verificaData == 0){
                if($query = $db->prepare("INSERT INTO tbreservaeq (idUser, tituloReEq, motivoReEq) VALUES (?, ?, ?)")){
                  $query->bind_param('iss', $_SESSION['id'], $titulo, $motivo);
                  $query->execute();
                  $idReEq = $query->insert_id;
                  Atalhos::addLogsAcoes('Inseriu', 'tbreservaeq', $idReEq);
                  $query->close();
                }
                $verificaData = 1;
              }
              if($query = $db->prepare("SELECT idData FROM tbdata WHERE inicio = ? AND fim = ? LIMIT 1")){
                $query->bind_param('ss', $dataini, $datafim);
                $query->execute();
                $query->bind_result($idData);
                if($query->fetch() == null){
                  $auxDb = Atalhos::getBanco();
                  if($aux = $auxDb->prepare("INSERT INTO tbdata (inicio, fim) VALUES (?, ?)")){
                    $aux->bind_param('ss', $dataini, $datafim);
                    $aux->execute();
                    $idData = $aux->insert_id;
                    $aux->close();
                    $auxDb->close();
                  }
                }
                $j = 1;
                $teste = true;
                while(isset($_POST['eqp'.$j])){
                  if($query = $db->prepare("INSERT INTO tbreservatipoeq (idReEq, idTipoEq, numReEq) VALUES (?, ?, ?)")){
                    $query->bind_param('iii', $idReEq, $_POST['eqp'.$j], $_POST['numEq'.$j]);
                    $query->execute();
                    $query->close();
                    $result = Atalhos::choqueEq($dataini, $datafim, $_POST['eqp'.$j], $_POST['numEq'.$j++]);
                    if($result != false){
                      if($status == 'Aprovado'){
                        $status = 'Pendente';
                        $_SESSION['choqueReserva'] = 1;
                      }
                      if($teste){
                        if($query = $db->prepare("INSERT INTO tbcontroledataeq (idReEq, idData, statusData) VALUES (?, ?, ?)")){
                          $query->bind_param('iis', $idReEq, $idData, $status);
                          $query->execute();
                          $teste = false;
                          Atalhos::includeChoque($result, $idReEq, $idData, 1);
                          $query->close();
                        }
                      }
                    }
                  }
                }
                if($teste){
                  if($query = $db->prepare("INSERT INTO tbcontroledataeq (idReEq, idData, statusData) VALUES (?, ?, ?)")){
                    $query->bind_param('iis', $idReEq, $idData, $status);
                    $query->execute();
                    $query->close();
                  }
                }
              }
            }
          }
        }
        if ($verificaData == 1){
          $_SESSION['avisoCalendario'] = 1;
        }else{
          $_SESSION['errorCalendario'] = "O dia da semana selecionado não pertence ao intervalo escolhido!";
        }
      }
      $db->close();
    }

    public static function reqAdd(){
      switch($_POST['tipoReq']){
        case 1://Atividades Complementares
          $programa = $_POST['programa'];
          $inicio = $_POST['datainicio'];
          $fim = $_POST['datafim'];
          $requerimento_conteudo = $programa.'/+'.$inicio.'/+'.$fim;
          break;
        case 2://Cadastro de Estágio
          $i1 = $_POST['inst-tipo'];
          $i2 = $_POST['inst-agente'];
          $i3 = $_POST['inst-nome'];
          $i4 = $_POST['inst-cnpj'];
          $i5 = $_POST['inst-logradouro'];
          $i6 = $_POST['inst-numero'];
          $i7 = $_POST['inst-bairro'];
          $i8 = $_POST['inst-complemento'];
          $i9 = $_POST['inst-cidadeuf'];
          $i10 = $_POST['inst-email'];
          $i11 = $_POST['inst-tel1'];
          $i12 = $_POST['inst-tel2'];
          $itudo = $i1.'/+'.$i2.'/+'.$i3.'/+'.$i4.'/+'.$i5.'/+'.$i6.'/+'.$i7.'/+'.$i8.'/+'.$i9.'/+'.$i10.'/+'.$i11.'/+'.$i12;

          $ir1 = $_POST['instresp-nome'];
          $ir2 = $_POST['instresp-cpf'];
          $ir3 = $_POST['instresp-rg'];
          $ir4 = $_POST['instresp-rgorgao'];
          $ir5 = $_POST['instresp-uf'];
          $ir6 = $_POST['instresp-data'];
          $ir7 = $_POST['instresp-sexo'];
          $ir8 = $_POST['instresp-cargo'];
          $irtudo = $ir1.'/+'.$ir2.'/+'.$ir3.'/+'.$ir4.'/+'.$ir5.'/+'.$ir6.'/+'.$ir7.'/+'.$ir8;

          $est1 = $_POST['est-tipo'];
          $est2 = $_POST['est-horas'];
          $est3 = $_POST['est-bolsavalor'];
          $est4 = $_POST['est-transpvalor'];
          $est5 = $_POST['est-comeco'];
          $est6 = $_POST['est-fim'];
          $est7 = $_POST['est-seguro'];
          $est8 = $_POST['est-segurocnpj'];
          $est9 = $_POST['est-seguronome'];
          $est10 = $_POST['est-seguroapolice'];
          $est11 = $_POST['est-segurovalor'];
          $est12 = $_POST['est-supervisor'];
          $est13 = $_POST['est-supervisorcpf'];
          $est14 = $_POST['est-supervisoremail'];
          $est15 = $_POST['est-supervisorarea'];
          $est16 = $_POST['est-supervisorformacao'];
          $estudo = $est1.'/+'.$est2.'/+'.$est3.'/+'.$est4.'/+'.$est5.'/+'.$est6.'/+'.$est7.'/+'.$est8.
              '/+'.$est9.'/+'.$est10.'/+'.$est11.'/+'.$est12.'/+'.$est13.'/+'.$est14.'/+'.$est15.'/+'.$est16;

          $h1 = $_POST['2mi'];
          $h2 = $_POST['2mo'];
          $h3 = $_POST['2ti'];
          $h4 = $_POST['2to'];
          $h5 = $_POST['2ni'];
          $h6 = $_POST['2no'];
          $h7 = $_POST['3mi'];
          $h8 = $_POST['3mo'];
          $h9 = $_POST['3ti'];
          $h10 = $_POST['3to'];
          $h11 = $_POST['3ni'];
          $h12 = $_POST['3no'];
          $h13 = $_POST['4mi'];
          $h14 = $_POST['4mo'];
          $h15 = $_POST['4ti'];
          $h16 = $_POST['4to'];
          $h17 = $_POST['4ni'];
          $h18 = $_POST['4no'];
          $h19 = $_POST['5mi'];
          $h20 = $_POST['5mo'];
          $h21 = $_POST['5ti'];
          $h22 = $_POST['5to'];
          $h23 = $_POST['5ni'];
          $h24 = $_POST['5no'];
          $h25 = $_POST['6mi'];
          $h26 = $_POST['6mo'];
          $h27 = $_POST['6ti'];
          $h28 = $_POST['6to'];
          $h29 = $_POST['6ni'];
          $h30 = $_POST['6no'];
          $htudo = $h1.'/+'.$h2.'/+'.$h3.'/+'.$h4.'/+'.$h5.'/+'.$h6.'/+'.$h7.'/+'.$h8.
          '/+'.$h9.'/+'.$h10.'/+'.$h11.'/+'.$h12.'/+'.$h13.'/+'.$h14.'/+'.$h15.'/+'.$h16.
          '/+'.$h17.'/+'.$h18.'/+'.$h19.'/+'.$h20.'/+'.$h21.'/+'.$h22.'/+'.$h23.'/+'.$h24.
          '/+'.$h25.'/+'.$h26.'/+'.$h27.'/+'.$h28.'/+'.$h29.'/+'.$h30;

          $plano = $_POST['plano'];

          $requerimento_conteudo = $itudo.'/-'.$irtudo.'/-'.$estudo.'/-'.$htudo.'/-'.$plano;
          break;
        case 3://Abono de Faltas
          $inicio = $_POST['datacomeco'];
          $fim = $_POST['datafim'];
          $d1 = $_POST['disciplina'];
          $t1 = $_POST['turma'];
          $p1 = $_POST['professor'];
          $p2 = $_POST['professor2'];
          if($p1 != 0)
            $p2 = '';
          $requerimento_conteudo = $inicio.'/+'.$fim.'/+'.$d1.'/+'.$t1.'/+'.$p1.'/+'.$p2;
          break;
        case 4://Estágio Supervisionado
          $codigo = $_POST['codigo'];
          $periodo = $_POST['periodo'];
          $professor = $_POST['professor'];
          $obs = $_POST['obs'];
          $requerimento_conteudo = $codigo.'/+'.$periodo.'/+'.$professor.'/+'.$obs;
          break;
        case 5://Inclusão
          $periodo = $_POST['periodo'];
          $situacao = $_POST['situacao'];
          $reprovou = $_POST['reprovou'];
          $iea = $_POST['iea'];
          $disciplina = $_POST['disciplina'];
          $turma = $_POST['turma'];
          $requerimento_conteudo = $periodo.'/+'.$situacao.'/+'.$reprovou.'/+'.$iea.'/+'.$disciplina.'/+'.$turma;
          break;
        case 6://TCC
          $tipo = $_POST['tipo'];
          $codigo = $_POST['codigo'];
          $periodo = $_POST['periodo'];
          $professor = $_POST['professor'];
          $obs = $_POST['obs'];
          $professor2 = $_POST['professor2'];
          if($professor != 0)
            $professor2 = '';
          $requerimento_conteudo = $tipo.'/+'.$codigo.'/+'.$periodo.'/+'.$professor.'/+'.$obs.'/+'.$professor2;
          break;
        case 7://Geral
          $requerimento_conteudo = $_POST['requerimento'];
          break;
      }
      $db = Atalhos::getBanco();
      if($_POST['tipoReq'] != 3 && $_POST['tipoReq'] != 5){ // REQUERIMENTOS SEM PDF
        if($_POST['tipoReq'] == 6)
          $statusInicial = 'PendenteProf';
        else if($_POST['tipoReq'] == 1)
          $statusInicial = 'Aprovado';
        else
          $statusInicial = 'Pendente';

        if($query = $db->prepare("INSERT INTO tbrequerimentos (idUser, dataReq, conteudoReq, tipoReq, statusReq) VALUES (?, ?, ?, ?, ?)")){
          $query->bind_param('issis', $_SESSION['id'], date("Y-m-d", time()), $requerimento_conteudo, $_POST['tipoReq'], $statusInicial);
          $query->execute();
          $idPdf = $query->insert_id;
          Atalhos::addLogsAcoes('Inseriu', 'tbrequerimentos', $idPdf);
          $_SESSION['avisoReqs'] = 1;
          $query->close();
        }
        if(($_POST['tipoReq'] == 6) && ($query = $db->prepare("INSERT INTO tbreqs_professor (idProfessor, idReq) VALUES (?, ?)"))){
          $query->bind_param('ii', $_POST['professor'], $idPdf);
          $query->execute();
          $query->close();
          if ($query = $db->prepare("SELECT AES_DECRYPT(email, ?)
                                  FROM tbusuario
                                  WHERE idUser = ?")){
            $query->bind_param('si', $_SESSION['chave'], $_POST['professor']);             
            $query->execute();
            $query->bind_result($email);
            $query->fetch();
            $query->close();
            Atalhos::enviarEmail($email,3);
          }
        }
      } elseif(Atalhos::enviarPdfRequerimentos()){ // REQUERIMENTOS COM PDF
          if($_POST['tipoReq'] == 3)
            $statusInicial = 'PendenteProf';
          else
            $statusInicial = 'Pendente';
          if($query = $db->prepare("INSERT INTO tbrequerimentos (idUser, dataReq, conteudoReq, tipoReq, statusReq) VALUES (?, ?, ?, ?, ?)")){
            $query->bind_param('issis', $_SESSION['id'], date("Y-m-d", time()), $requerimento_conteudo, $_POST['tipoReq'], $statusInicial);
            $query->execute();
            $idPdf = $query->insert_id;
            Atalhos::addLogsAcoes('Inseriu', 'tbrequerimentos', $idPdf);
            $_SESSION['avisoReqs'] = 1;
            $query->close();
          }
          if(($_POST['tipoReq'] == 3) && ($query = $db->prepare("INSERT INTO tbreqs_professor (idProfessor, idReq) VALUES (?, ?)"))){
              $query->bind_param('ii', $_POST['professor'], $idPdf);
              $query->execute();
              $query->close();
              if ($query = $db->prepare("SELECT AES_DECRYPT(email, ?)
                                    FROM tbusuario
                                    WHERE idUser = ?")){
              $query->bind_param('si', $_SESSION['chave'], $_POST['professor']);             
              $query->execute();
              $query->bind_result($email);
              $query->fetch();
              $query->close();
              Atalhos::enviarEmail($email,3);
            }
          }
          if(move_uploaded_file($_FILES['pdf']['tmp_name'], "../../pdfs/".$idPdf.".pdf")) {
            //SE ELE PASSOU NESSE IF, TA TRANQUILO E FAVORAVEL
          }
          else {
            // Não foi possível fazer o upload, provavelmente a pasta está incorreta
            $_SESSION['erroPdf'] = "Não foi possível enviar o PDF. Tente novamente!<br/>
                                      Se o problema persistir, comunique o erro à secretaria.";
            return false;
          }
      }
      $db->close();
    }

    public static function reqEdit(){
      switch($_POST['tipoReq']){
        case 1://Atividades Complementares
          $programa = $_POST['programa'];
          $inicio = $_POST['datainicio'];
          $fim = $_POST['datafim'];
          $requerimento_conteudo = $programa.'/+'.$inicio.'/+'.$fim;
          break;
        case 2://Cadastro de Estágio
          $i1 = $_POST['inst-tipo'];
          $i2 = $_POST['inst-agente'];
          $i3 = $_POST['inst-nome'];
          $i4 = $_POST['inst-cnpj'];
          $i5 = $_POST['inst-logradouro'];
          $i6 = $_POST['inst-numero'];
          $i7 = $_POST['inst-bairro'];
          $i8 = $_POST['inst-complemento'];
          $i9 = $_POST['inst-cidadeuf'];
          $i10 = $_POST['inst-email'];
          $i11 = $_POST['inst-tel1'];
          $i12 = $_POST['inst-tel2'];
          $itudo = $i1.'/+'.$i2.'/+'.$i3.'/+'.$i4.'/+'.$i5.'/+'.$i6.'/+'.$i7.'/+'.$i8.'/+'.$i9.'/+'.$i10.'/+'.$i11.'/+'.$i12;

          $ir1 = $_POST['instresp-nome'];
          $ir2 = $_POST['instresp-cpf'];
          $ir3 = $_POST['instresp-rg'];
          $ir4 = $_POST['instresp-rgorgao'];
          $ir5 = $_POST['instresp-uf'];
          $ir6 = $_POST['instresp-data'];
          $ir7 = $_POST['instresp-sexo'];
          $ir8 = $_POST['instresp-cargo'];
          $irtudo = $ir1.'/+'.$ir2.'/+'.$ir3.'/+'.$ir4.'/+'.$ir5.'/+'.$ir6.'/+'.$ir7.'/+'.$ir8;

          $est1 = $_POST['est-tipo'];
          $est2 = $_POST['est-horas'];
          $est3 = $_POST['est-bolsavalor'];
          $est4 = $_POST['est-transpvalor'];
          $est5 = $_POST['est-comeco'];
          $est6 = $_POST['est-fim'];
          $est7 = $_POST['est-seguro'];
          $est8 = $_POST['est-segurocnpj'];
          $est9 = $_POST['est-seguronome'];
          $est10 = $_POST['est-seguroapolice'];
          $est11 = $_POST['est-segurovalor'];
          $est12 = $_POST['est-supervisor'];
          $est13 = $_POST['est-supervisorcpf'];
          $est14 = $_POST['est-supervisoremail'];
          $est15 = $_POST['est-supervisorarea'];
          $est16 = $_POST['est-supervisorformacao'];
          $estudo = $est1.'/+'.$est2.'/+'.$est3.'/+'.$est4.'/+'.$est5.'/+'.$est6.'/+'.$est7.'/+'.$est8.
              '/+'.$est9.'/+'.$est10.'/+'.$est11.'/+'.$est12.'/+'.$est13.'/+'.$est14.'/+'.$est15.'/+'.$est16;

          $h1 = $_POST['2mi'];
          $h2 = $_POST['2mo'];
          $h3 = $_POST['2ti'];
          $h4 = $_POST['2to'];
          $h5 = $_POST['2ni'];
          $h6 = $_POST['2no'];
          $h7 = $_POST['3mi'];
          $h8 = $_POST['3mo'];
          $h9 = $_POST['3ti'];
          $h10 = $_POST['3to'];
          $h11 = $_POST['3ni'];
          $h12 = $_POST['3no'];
          $h13 = $_POST['4mi'];
          $h14 = $_POST['4mo'];
          $h15 = $_POST['4ti'];
          $h16 = $_POST['4to'];
          $h17 = $_POST['4ni'];
          $h18 = $_POST['4no'];
          $h19 = $_POST['5mi'];
          $h20 = $_POST['5mo'];
          $h21 = $_POST['5ti'];
          $h22 = $_POST['5to'];
          $h23 = $_POST['5ni'];
          $h24 = $_POST['5no'];
          $h25 = $_POST['6mi'];
          $h26 = $_POST['6mo'];
          $h27 = $_POST['6ti'];
          $h28 = $_POST['6to'];
          $h29 = $_POST['6ni'];
          $h30 = $_POST['6no'];
          $htudo = $h1.'/+'.$h2.'/+'.$h3.'/+'.$h4.'/+'.$h5.'/+'.$h6.'/+'.$h7.'/+'.$h8.
          '/+'.$h9.'/+'.$h10.'/+'.$h11.'/+'.$h12.'/+'.$h13.'/+'.$h14.'/+'.$h15.'/+'.$h16.
          '/+'.$h17.'/+'.$h18.'/+'.$h19.'/+'.$h20.'/+'.$h21.'/+'.$h22.'/+'.$h23.'/+'.$h24.
          '/+'.$h25.'/+'.$h26.'/+'.$h27.'/+'.$h28.'/+'.$h29.'/+'.$h30;

          $plano = $_POST['plano'];

          $requerimento_conteudo = $itudo.'/-'.$irtudo.'/-'.$estudo.'/-'.$htudo.'/-'.$plano;
          break;
        case 3://Abono de Faltas
          $inicio = $_POST['datacomeco'];
          $fim = $_POST['datafim'];
          $d1 = $_POST['disciplina'];
          $t1 = $_POST['turma'];
          $p1 = $_POST['professor'];
          $p2 = $_POST['professor2'];
          if($p1 != 0)
            $p2 = '';
          $requerimento_conteudo = $inicio.'/+'.$fim.'/+'.$d1.'/+'.$t1.'/+'.$p1.'/+'.$p2;
          break;
        case 4://Estágio Supervisionado
          $codigo = $_POST['codigo'];
          $periodo = $_POST['periodo'];
          $professor = $_POST['professor'];
          $obs = $_POST['obs'];
          $p2 = $_POST['professor2'];
          if($professor != 0)
            $p2 = '';
          $requerimento_conteudo = $codigo.'/+'.$periodo.'/+'.$professor.'/+'.$obs.'/+'.$p2;
          break;
        case 5://Inclusão
          $periodo = $_POST['periodo'];
          $situacao = $_POST['situacao'];
          $reprovou = $_POST['reprovou'];
          $iea = $_POST['iea'];
          $disciplina = $_POST['disciplina'];
          $turma = $_POST['turma'];
          $requerimento_conteudo = $periodo.'/+'.$situacao.'/+'.$reprovou.'/+'.$iea.'/+'.$disciplina.'/+'.$turma;
          break;
        case 6://TCC
          $tipo = $_POST['tipo'];
          $codigo = $_POST['codigo'];
          $periodo = $_POST['periodo'];
          $professor = $_POST['professor'];
          $obs = $_POST['obs'];
          $professor2 = $_POST['professor2'];
          if($professor != 0)
            $professor2 = '';
          $requerimento_conteudo = $tipo.'/+'.$codigo.'/+'.$periodo.'/+'.$professor.'/+'.$obs.'/+'.$professor2;
          break;
        case 7://Geral
          $requerimento_conteudo = $_POST['requerimento'];
          break;
      }
      $db = Atalhos::getBanco();
      if($query = $db->prepare("UPDATE tbrequerimentos SET conteudoReq = ? WHERE idReq = ?")){
        $query->bind_param('si', $requerimento_conteudo, $_POST['idReq']);
        $query->execute();
        Atalhos::addLogsAcoes('Modificou', 'tbrequerimentos', $_POST['idReq']);
        $_SESSION['avisoReqs'] = 1;
        $query->close();
      }
      if(($_POST['tipoReq'] == 3 || $_POST['tipoReq'] == 6) && ($query = $db->prepare("UPDATE tbreqs_professor SET idProfessor = ? WHERE idReq = ?"))){
        $query->bind_param('ii', $_POST['professor'], $_POST['idReq']);
        $query->execute();
        $query->close();
        if ($query = $db->prepare("SELECT AES_DECRYPT(email, ?)
                                  FROM tbusuario
                                  WHERE idUser = ?")){
          $query->bind_param('si', $_SESSION['chave'], $_POST['professor']);             
          $query->execute();
          $query->bind_result($email);
          $query->fetch();
          $query->close();
          Atalhos::enviarEmail($email,3);
        }
      }

      if(($_POST['tipoReq'] == 4) && ($query = $db->prepare("SELECT idReq FROM tbreqs_professor WHERE idReq = ?"))){
        $query->bind_param('i', $_POST['idReq']);
        $query->execute();
        $query->bind_result($idReq);
        $query->fetch();
        $query->close();
        if(is_null($idReq)){
          $query = $db->prepare("INSERT INTO tbreqs_professor (idProfessor, idReq) VALUES (?, ?)");
          $query->bind_param('ii', $_POST['professor'], $_POST['idReq']);
          $query->execute();
          $query->close();
          $query = $db->prepare("UPDATE tbrequerimentos SET statusReq = 'PendenteProf' WHERE idReq = ?");
          $query->bind_param('i', $_POST['idReq']);
          $query->execute();
          Atalhos::addLogsAcoes('Modificou', 'tbrequerimentos', $_POST['idReq']);
          $query->close();
          if ($query = $db->prepare("SELECT AES_DECRYPT(email, ?)
                                  FROM tbusuario
                                  WHERE idUser = ?")){
            $query->bind_param('si', $_SESSION['chave'], $_POST['professor']);             
            $query->execute();
            $query->bind_result($email);
            $query->fetch();
            $query->close();
            Atalhos::enviarEmail($email,3);
          }
        }else{
          $query = $db->prepare("UPDATE tbreqs_professor SET idProfessor = ? WHERE idReq = ?");
          $query->bind_param('ii', $_POST['professor'], $_POST['idReq']);
          $query->execute();
          $query->close();
          $query = $db->prepare("UPDATE tbrequerimentos SET statusReq = 'PendenteProf' WHERE idReq = ?");
          $query->bind_param('i', $_POST['idReq']);
          $query->execute();
          Atalhos::addLogsAcoes('Modificou', 'tbrequerimentos', $_POST['idReq']);
          $query->close();
          if ($query = $db->prepare("SELECT AES_DECRYPT(email, ?)
                                  FROM tbusuario
                                  WHERE idUser = ?")){
            $query->bind_param('si', $_SESSION['chave'], $_POST['professor']);             
            $query->execute();
            $query->bind_result($email);
            $query->fetch();
            $query->close();
            Atalhos::enviarEmail($email,3);
          }
        }
      }
      $db->close();
    }
  }
?>
