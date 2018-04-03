<?php
  include '../../includes/sessao.php';

  if ($_GET['pass'] == '1ssAs139bC363lcE6aDfF'){

    $db = Atalhos::getBanco();
    if($ping = Atalhos::serviceping($_SESSION['ldaphost'])){
      $person = 'admin';
      $key = Atalhos::decodeKey();
      $ds = ldap_connect("ldaps://{$_SESSION['ldaphost']}") or die("Conexão recusada");
      $ldaprdn  = "uid={$person},ou=pessoas,dc=computacao,dc=ufs,dc=br";
      if($ds){

        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        $ldapbind = ldap_bind($ds, $ldaprdn, $key);
        if($ldapbind){

          $dateNow = date("Y-m-d H:i:s", strtotime("now"));
          if($aux = $db->prepare("SELECT login, a.idUser FROM tbUsuario a INNER JOIN tbUsuarioTemp b ON a.idUser = b.idUser WHERE ? > b.dataFim")){
            $aux->bind_param('s', $dateNow);
            $aux->execute();
            $aux->bind_result($userremove, $idUser);
            while($aux->fetch()){
              $db1 = Atalhos::getBanco();
              if($query = $db1->prepare("DELETE FROM tbUsuario WHERE idUser = ?")){
                echo "FOI";

                $query->bind_param('i',$idUser);
                $ldaprdn2 = "uid={$userremove},ou=pessoas,dc=computacao,dc=ufs,dc=br";//User to be REMOVED
                if($ping = Atalhos::serviceping($_SESSION['ldaphost'])){ // is server up?
                  $ds = ldap_connect("ldaps://{$_SESSION['ldaphost']}") or die("Conexão recusada");
                  $ldaprdn  = "uid={$person},ou=pessoas,dc=computacao,dc=ufs,dc=br"; //login of CURRENT USER
                  if($ds){
                    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
                    $ldapbind = ldap_bind($ds, $ldaprdn, $key);
                    if($ldapbind){
                      $result = ldap_delete ( $ds , $ldaprdn2 );
                      if ($result){
                        //Executa o SQL
                        $query->execute();
                        $query->close();
                        echo "FOI";
                      } else {
                        echo "num foi";
                        $query->close();
                      }
                    }
                  }
                }
              }
            }
            $aux->close();
          }
        }
      }
      $db->close();
    }
  }else{
    //echo $_SESSION['senhaBanco'];
  }
