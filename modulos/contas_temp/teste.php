<?php
	//Documentaçao LDAP
	//http://www.openldap.org/faq/data/cache/347.html
	//http://coding.debuntu.org/php-how-calculate-ssha-value-string
		include '../../includes/topo.php';

		$info = Atalhos::getAdmin();

		$ldaprdn  = "uid={$info[0]},ou=pessoas,dc=computacao,dc=ufs,dc=br";
		$ldaphost = "ldaps://{$_SESSION['ldaphost']}";	//endereço do servidor
		$ds = ldap_connect($ldaphost, 636)or die("Não foi possivel se conectart ao serviço de autentificação {$ldaphost}");
		if ($ds) {
		echo "Conexão com o servidor<br>";

		// define protocolo de LDAP
		ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($ds, LDAP_OPT_SIZELIMIT, 0);
		// logando no servidor ldap
		$ldapbind = ldap_bind($ds, $ldaprdn, $info[1]);

		// Verifica se conectou
		if ($ldapbind) {
			echo "LDAP bind</br>";
		} else{	//Teste de conexão na base secundária
			$dn = "ou=pessoas,dc=computacao,dc=ufs,dc=br";
			$ldaprdn  = "uid={$person},{$dn}";
			$ldapbind = ldap_bind($ds, $ldaprdn, $info[1]);
		}
		if ($ldapbind) {
			//filtro de pesquisa uid=* (todos os usuários com logins válidos)
			$filter="(ou=*)";

			//Filtro dos atributos pesquisados
			$justthese = array("ou");

			$sr = ldap_search($ds, 'dc=computacao,dc=ufs,dc=br', $filter, $justthese);
			$info = ldap_get_entries($ds, $sr);

			//removendo nó de grupos e váriáveis usadas pelo sistema
			for ($i=0; $i<$info["count"]; $i++) {
				if (strcmp($info[$i]["ou"][0],'posix') || strcmp($info[$i]["ou"][0],"grupos")) {

				}
			}

			//Loop de pesquisa na base
			echo "<br>";
			for ($i=0; $i<$info["count"]; $i++) {
				if (strcmp($info[$i]["ou"][0],'posix') && strcmp($info[$i]["ou"][0],'grupos')) { //removendo nós administrativos
					$bases[] = $info[$i]["ou"][0];
				}
			}
			for ($i=0; $i<count($bases); $i++) {
				echo "OU: {$bases[$i]}<br>";
			}
		} else {
			echo "Usuário ou senha errados<br>";
		}
	}
?>
