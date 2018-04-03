<?php
  //Documentação em http://php.net/manual/en/book.ldap.php

  include 'sessao.php';


  $senha = 'Eu<3DC0MP'; //User LOGGED IN
  $login = 'admin'; //User LOGGED IN

  $userremove = 'obi_aluno';//user to be ADDED
  $ldaprdn2 = "uid={$userremove},ou=pessoas,dc=computacao,dc=ufs,dc=br";//User to be ADDED
  $groupinfo['member'] = $ldaprdn2;

  //$_SESSION['ldaphost'] = '182.16.1.99';
  if($ping = Atalhos::serviceping($_SESSION['ldaphost'])){ // is server up?
	$ds = ldap_connect("ldaps://{$_SESSION['ldaphost']}") or die("Conexão recusada");
  	$ldaprdn  = "uid={$login},ou=pessoas,dc=computacao,dc=ufs,dc=br"; //login of CURRENT USER
	if($ds){
	  ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
	  $ldapbind = ldap_bind($ds, $ldaprdn, $senha);
	  if($ldapbind){
		$result = ldap_search($ds, 'cn=adm,ou=grupos,dc=computacao,dc=ufs,dc=br', "cn=adm");
		if ($result){
		  echo 'nice<br/>';
		  $data = ldap_get_entries($ds, $result);
		  for ($i=0; $i < $data['count']; $i++) {
			for ($j=0; $j < $data[$i]['member']['count'];$j++) {
    	      echo ($data[$i]['member'][$j]);
              echo '<br/>';
		    }
          }
		} else {
		  echo 'Error';
		}
	  }
  	}
  }

?>
