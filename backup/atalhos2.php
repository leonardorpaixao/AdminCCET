<?php
	class Atalhos {
		public static function updateUser($login, $password){
			$db = Atalhos::getBanco();
			//Faz uma busca pelo login
			if($query = $db->prepare("SELECT idUser FROM tbusuario WHERE login = ? LIMIT 1")){
			    $query->bind_param('s', $login);
			    $query->execute();
			    $query->bind_result($idUser);
			    $query->store_result();
				//UID a ser pesquisado (login do usuário)
				$person = $login;
				//diretório onde ficam os usuários
				$dn = "ou=usuarios,dc=computacao,dc=ufs,dc=br";
				$ldaprdn  = "uid={$person},{$dn}";	//DN  do usuário q se conecta altera somente o campo uid para usuários diferentes
				$ldappass = $password; 	//senha associada
				$ldaphost = "ldaps://10.27.100.2";	//endereço do servidor

				$ds = ldap_connect($ldaphost, 636)	//abre conexão
				or die("Could not connect to {$ldaphost}");

				if ($ds) {
					//echo "Conexão com o servidor<br>";

					// define protocolo de LDAP
					ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);

					// logando no servidor ldap
					$ldapbind = ldap_bind($ds, $ldaprdn, $ldappass);

					// Verifica se conectou
					if ($ldapbind) {
						//echo "LDAP bind</br>";
					} else{	//Teste de conexão na base secundária
						$dn = "ou=pessoas,dc=computacao,dc=ufs,dc=br";
						$ldaprdn  = "uid={$person},{$dn}";
						$ldapbind = ldap_bind($ds, $ldaprdn, $ldappass);
					}
					if ($ldapbind) {
						$filter="(uid={$person})";
						//filtro de atributos a serem pesquisados

						//atributos a serem pegos
						$justthese = array("employeeNumber", "employeeType", "cn", "description");

						// echo $filter;
						$sr = ldap_search($ds, $dn, $filter, $justthese);
						$info = ldap_get_entries($ds, $sr);
						$entry = ldap_first_entry($ds, $sr);

						$matricula = ldap_get_values($ds, $entry, "employeeNumber");
						$matriculaAux = $matricula[0];

						$vinculo = ldap_get_values($ds, $entry, "employeeType");
						$vinculoAux = $vinculo[0];

						$nome = ldap_get_values($ds, $entry, "cn");
						$nomeAux = $nome[0];

						$s_data = ldap_get_values($ds, $entry, "description");
						list($cpf , $email, $telefone1, $telefone2) = explode(',',$s_data[0]);
						$icpf = strlen($cpf);
				    	for(;$icpf < 11; $icpf++){
				    		$cpf = '0'.$cpf;
				    	}
					} else {
						echo "Usuário ou senha errados<br>";
					}
				}
			    if(!($query->fetch())){
			    	$query->close();
			    	$aux = explode(' - ', $vinculo[0]);
			    	$curso = explode('/', $aux[1]);
					$explodeobacharel = explode(' Bacharelado', $curso[0]);
					$encoding = 'UTF-8'; // ou ISO-8859-1...
					$explodeobacharel[0] = mb_convert_case($explodeobacharel[0], MB_CASE_UPPER, $encoding);
					$aux_curso = strtoupper($explodeobacharel[0]);
					//echo "{$aux_curso}<br><br>";

			    	if ($aux[0] == 'Docente'){
			    		$nivel = 3;
			    		$idAfiliacao = 1;
		                $aux_db = Atalhos::getBanco();
				    	if ($query = $aux_db->prepare("INSERT INTO tbusuario (login, nomeUser, nivel, idAfiliacao, cpf, email) VALUES (?, ?, ?, ?, AES_ENCRYPT(?, ?), AES_ENCRYPT(?, ?))")){
				    		$query->bind_param('ssiissss', $login, $nomeAux, $nivel, $idAfiliacao, $cpf, $_SESSION['chave'], $email, $_SESSION['chave']);
				    		$query->execute();
				    		$query->close();
				    	}
			    	}
			    	else if($aux[0] == 'Graduação' || $aux[0] == 'Mestrado'){
				    	$nivel = 4;
						if($aux_curso == 'ENGENHARIA DE COMPUTAÇÃO' || $aux_curso == 'SISTEMAS DE INFORMAÇÃO' || $aux_curso == 'CIÊNCIA DA COMPUTAÇÃO'){
				    		$auxCurso = $curso[0];
				    		if($query = $db->prepare("SELECT idAfiliacao FROM tbafiliacao WHERE afiliacao = ? LIMIT 1")){
				                $query->bind_param('s', $auxCurso);
				                $query->execute();
				                $query->bind_result($idAfiliacao);
				                $query->fetch();
				                $query->close();
				                $aux_db = Atalhos::getBanco();
						    	if ($query = $aux_db->prepare("INSERT INTO tbusuario (login, nomeUser, nivel, idAfiliacao, cpf, email) VALUES (?, ?, ?, ?, AES_ENCRYPT(?, ?), AES_ENCRYPT(?, ?))")){
						    		$query->bind_param('ssiissss', $login, $nomeAux, $nivel, $idAfiliacao, $cpf, $_SESSION['chave'], $email, $_SESSION['chave']);
						    		$query->execute();
						    		$auxId = $query->insert_id;
						    		$query->close();
						    		if ($query = $aux_db->prepare("INSERT INTO tbmatricula (idUser, matricula) VALUES (?, ?)")){
						    			$query->bind_param('ii', $auxId, $matriculaAux);
						    			$query->execute();
						    			$query->close();
						    		}
						    		if($telefone1 != ""){
							    		if ($query = $aux_db->prepare("INSERT INTO tbtelefone (idUser, numTelefone) VALUES (?, AES_ENCRYPT(?, ?))")){
							    			$query->bind_param('iss', $auxId, $telefone1, $_SESSION['chave']);
							    			$query->execute();
							    			$query->close();
						    			}
						    		}
						    		if($telefone2 != ""){
							    		if ($query = $aux_db->prepare("INSERT INTO tbtelefone (idUser, numTelefone) VALUES (?, AES_ENCRYPT(?, ?))")){
							    			$query->bind_param('iss', $auxId, $telefone2, $_SESSION['chave']);
							    			$query->execute();
							    			$query->close();
						    			}
						    		}
						    	}
						    }
				    	}
					}
					else{
						$nivel = 2;
						$idAfiliacao = 7;
		                $aux_db = Atalhos::getBanco();
				    	if ($query = $aux_db->prepare("INSERT INTO tbusuario (login, nomeUser, nivel, idAfiliacao, cpf, email) VALUES (?, ?, ?, ?, AES_ENCRYPT(?, ?), AES_ENCRYPT(?, ?))")){
				    		$query->bind_param('ssiissss', $login, $nomeAux, $nivel, $idAfiliacao, $cpf, $_SESSION['chave'], $email, $_SESSION['chave']);
				    		$query->execute();
				    		$query->close();
				    	}
					}
				}
				//Se já estiver cadastrado, atualiza o email
				else{
					$query->fetch();
					$query->close();
			    	if($query = $db->prepare("UPDATE tbusuario SET email = AES_ENCRYPT(?, ?), nomeUser = ? WHERE idUser = ?")){
			    		$query->bind_param('sssi', $email, $_SESSION['chave'], $nome, $idUser);
			    		$query->execute();
			    		$query->close();
			    	}
			    	if($query = $db->prepare("SELECT idTelefone, numTelefone FROM tbtelefone WHERE idUser = ?")){
			    		$query->bind_param('i', $idUser);
			    		$query->execute();
			    		$query->bind_result($idTel, $tel);
			    		if(!($query->fetch())){
			    			$aux_db = Atalhos::getBanco();
				    		if($telefone1 != ""){
					    		if ($aux = $aux_db->prepare("INSERT INTO tbtelefone (idUser, numTelefone) VALUES (?, AES_ENCRYPT(?, ?))")){
					    			$aux->bind_param('iss', $idUser, $telefone1, $_SESSION['chave']);
					    			$aux->execute();
					    			$aux->close();
				    			}
				    		}
				    		if($telefone2 != ""){
					    		if ($aux = $aux_db->prepare("INSERT INTO tbtelefone (idUser, numTelefone) VALUES (?, AES_ENCRYPT(?, ?))")){
					    			$aux->bind_param('iss', $idUser, $telefone2, $_SESSION['chave']);
					    			$aux->execute();
					    			$aux->close();
				    			}
				    		}
			    		}
			    		while($query->fetch()){
		                	$aux_db = Atalhos::getBanco();
			    			if($tel != $telefone1 && $tel != $telefone2){
			    				if($aux_query = $db->prepare("UPDATE tbusuario SET numTelefone = AES_ENCRYPT(?, ?) WHERE idTelefone = ?")){
						    		$aux_query->bind_param('ssi', $tel, $_SESSION['chave'], $idTel);
						    		$aux_query->execute();
						    		$aux_query->close();
			    				}
			    			}
			    		}
			    	}
		    		$query->close();
			    }
			}
			$db->close();
		}

		public static function updateBD(){
			if(!isset($_SESSION['senhaBanco'])){
				$arquivo = fopen("pass.txt", "r");
				$aux = fscanf($arquivo, "%s\t%s");
				$_SESSION['chave'] = $aux[1];
				$texto = Atalhos::decode($aux[0]);
	            $tm = strlen($texto); //conta a quantidade de caracteres do texto
		        $x = 0;
			    $buf = "";
	            for($i = 1;$i <= $tm;$i++){
		            $letra[$i] = substr($texto,$x,1); //isola cada caractere da string
    	            $cod[$i] = ord($letra[$i]); //converte cada caractere em seu respectivo codigo ascii
	                $bin[$i] = decbin($cod[$i]); //converte cada codigo ascii em seu respectivo codigo binario
	                if ($bin[$i] == 0)
	                    break;
	                $buf = $buf.$letra[$i];
	                $x++;
	            }
	            $_SESSION['senhaBanco'] = $buf;
			}

			//UID a ser pesquisado (login do usuário)
			$person = 'admin';
			//diretório onde ficam os usuários
			$dn = "dc=computacao,dc=ufs,dc=br";
			$ldaprdn  = "cn={$person},{$dn}";	//DN  do usuário q se conecta altera somente o campo uid para usuários diferentes
			$ldappass = $_SESSION['senhaBanco']; 	//senha associada
			$ldaphost = "ldaps://10.27.100.2";	//endereço do servidor

			$ds = ldap_connect($ldaphost, 636)	//abre conexão
			or die("Could not connect to {$ldaphost}");

			if ($ds) {
				//echo "Conexão com o servidor<br>";

				// define protocolo de LDAP
				ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
				ldap_set_option($ds, LDAP_OPT_SIZELIMIT, 0);
				// logando no servidor ldap
				$ldapbind = ldap_bind($ds, $ldaprdn, $ldappass);

				// Verifica se conectou
				if ($ldapbind) {
					//echo "LDAP bind</br>";
				} else{	//Teste de conexão na base secundária
					$dn = "ou=pessoas,dc=computacao,dc=ufs,dc=br";
					$ldaprdn  = "uid={$person},{$dn}";
					$ldapbind = ldap_bind($ds, $ldaprdn, $ldappass);
				}
				if ($ldapbind) {
					//filtro de pesquisa uid=* (todos os usuários com logins válidos)
					$filter="(uid=*)";

					//Filtro dos atributos pesquisados
					$justthese = array("uid", "cn", "employeeNumber", "employeeType", "description");

					$sr = ldap_search($ds, 'dc=computacao,dc=ufs,dc=br', $filter, $justthese);
					$info = ldap_get_entries($ds, $sr);

					//Loop de atualização da base
					//echo $info["count"];
					for ($i=0; $i<$info["count"]; $i++) {
						$login = $info[$i]["uid"][0];
						$matricula = $info[$i]["employeenumber"][0];
						$vinculo = $info[$i]["employeetype"][0];
						$nome = $info[$i]["cn"][0];
						list($cpf , $email, $telefone1, $telefone2) = explode(',',$info[$i]["description"][0]);
						$icpf = strlen($cpf);
				    	for(;$icpf < 11; $icpf++){
				    		$cpf = '0'.$cpf;
				    	}
						//echo "CN: {$nome}<br>";
						//echo "UID: {$login}<br>";
						//echo "Matricula: {$matricula}<br>";
						//echo "Vinculo: {$vinculo}<br>";
						// echo "CPF: ",$cpf, "<br>EMAIL: " , $email,"<br>TEL1: " , $telefone1,"<br>TEL2: ", $telefone2,'<br>-----<br>';

						$db = Atalhos::getBanco();
						//Faz uma busca pelo login
						if($query = $db->prepare("SELECT idUser FROM tbusuario WHERE login = ? LIMIT 1")){
						    $query->bind_param('s', $login);
						    $query->execute();
						    $query->bind_result($idUser);
						    $query->store_result();
						}
						//Se não tiver o login coloque no banco
					    if(!($query->fetch())){
					    	$query->close();
					    	$aux = explode(' - ', $vinculo);
					    	$curso = explode('/', $aux[1]);
							$explodeobacharel = explode(' Bacharelado', $curso[0]);
							$encoding = 'UTF-8'; // ou ISO-8859-1...
							$explodeobacharel[0] = mb_convert_case($explodeobacharel[0], MB_CASE_UPPER, $encoding);
							$aux_curso = strtoupper($explodeobacharel[0]);
							//echo "{$aux_curso}<br><br>";

							$icpf = strlen($cpf);
					    	for(;$icpf < 11; $icpf++){
					    		$cpf = '0'.$cpf;
					    	}
					    	//Testa se é Professor, Aluno ou Outros
					    	if ($aux[0] == 'Docente'){
					    		$nivel = 3;
					    		$idAfiliacao = 1;
				                $aux_db = Atalhos::getBanco();
				                //Insere no Banco
						    	if ($query = $aux_db->prepare("INSERT INTO tbusuario (login, nomeUser, nivel, idAfiliacao, cpf, email) VALUES (?, ?, ?, ?, AES_ENCRYPT(?, ?), AES_ENCRYPT(?, ?))")){
						    		$query->bind_param('ssiissss', $login, $nome, $nivel, $idAfiliacao, $cpf, $_SESSION['chave'], $email, $_SESSION['chave']);
						    		$query->execute();
						    		$auxId = $query->insert_id;
						    		$query->close();
						    		if ($query = $aux_db->prepare("INSERT INTO tbmatricula (idUser, matricula) VALUES (?, ?)")){
						    			$query->bind_param('ii', $auxId, $matricula);
						    			$query->execute();
						    			$query->close();
						    		}
						    	}
					    	}
					    	else if($aux[0] == 'Graduação' || $aux[0] == 'Mestrado'){
						    	$nivel = 4;
						    	//Procura o curso
						    	if($aux_curso == "ENGENHARIA DE COMPUTAÇÃO" || $aux_curso == "SISTEMAS DE INFORMAÇÃO" || $aux_curso == "CIÊNCIA DA COMPUTAÇÃO"){
						    		if($query = $db->prepare("SELECT idAfiliacao FROM tbafiliacao WHERE afiliacao = ? LIMIT 1")){
						                $query->bind_param('s', $aux_curso);
						                $query->execute();
						                $query->bind_result($idAfiliacao);
						                $query->fetch();
						                $query->close();
						                $aux_db = Atalhos::getBanco();
						                //Insere no banco
								    	if ($query = $aux_db->prepare("INSERT INTO tbusuario (login, nomeUser, nivel, idAfiliacao, cpf, email) VALUES (?, ?, ?, ?, AES_ENCRYPT(?, ?), AES_ENCRYPT(?, ?))")){
								    		$query->bind_param('ssiissss', $login, $nome, $nivel, $idAfiliacao, $cpf, $_SESSION['chave'], $email, $_SESSION['chave']);
								    		$query->execute();
								    		$auxId = $query->insert_id;
								    		$query->close();
								    		if ($query = $aux_db->prepare("INSERT INTO tbmatricula (idUser, matricula) VALUES (?, ?)")){
								    			$query->bind_param('ii', $auxId, $matricula);
								    			$query->execute();
								    			$query->close();
								    		}
								    		if($telefone1 != ""){
									    		if ($query = $aux_db->prepare("INSERT INTO tbtelefone (idUser, numTelefone) VALUES (?, AES_ENCRYPT(?, ?))")){
									    			$query->bind_param('iss', $auxId, $telefone1, $_SESSION['chave']);
									    			$query->execute();
									    			$query->close();
								    			}
								    		}
								    		if($telefone2 != ""){
									    		if ($query = $aux_db->prepare("INSERT INTO tbtelefone (idUser, numTelefone) VALUES (?, AES_ENCRYPT(?, ?))")){
									    			$query->bind_param('iss', $auxId, $telefone2, $_SESSION['chave']);
									    			$query->execute();
									    			$query->close();
								    			}
								    		}
								    	}
								    }
						    	}
							}
							else{
								$nivel = 2;
								$idAfiliacao = 7;
				                $aux_db = Atalhos::getBanco();
				                //Insere no Banco
						    	if ($query = $aux_db->prepare("INSERT INTO tbusuario (login, nomeUser, nivel, idAfiliacao, cpf, email) VALUES (?, ?, ?, ?, AES_ENCRYPT(?, ?), AES_ENCRYPT(?, ?))")){
						    		$query->bind_param('ssiissss', $login, $nome, $nivel, $idAfiliacao, $cpf, $_SESSION['chave'], $email, $_SESSION['chave']);
						    		$query->execute();
						    		$auxId = $query->insert_id;
						    		$query->close();
						    		if ($query = $aux_db->prepare("INSERT INTO tbmatricula (idUser, matricula) VALUES (?, ?)")){
						    			$query->bind_param('ii', $auxId, $matricula);
						    			$query->execute();
						    			$query->close();
						    		}
						   		$aux_db->close();
						    	}
							}
						}
						//Se já estiver cadastrado, atualiza o email
						else{
							$query->fetch();
							$query->close();
					    	if($query = $db->prepare("UPDATE tbusuario SET email = AES_ENCRYPT(?, ?), nomeUser = ? WHERE idUser = ?")){
					    		$query->bind_param('sssi', $email, $_SESSION['chave'], $nome, $idUser);
					    		$query->execute();
					    		$query->close();
					    	}
					    	if($query = $db->prepare("SELECT idTelefone, numTelefone FROM tbtelefone WHERE idUser = ?")){
					    		$query->bind_param('i', $idUser);
					    		$query->execute();
					    		$query->bind_result($idTel, $tel);
					    		if(!($query->fetch())){
					    			$aux_db = Atalhos::getBanco();
						    		if($telefone1 != ""){
							    		if ($aux = $aux_db->prepare("INSERT INTO tbtelefone (idUser, numTelefone) VALUES (?, AES_ENCRYPT(?, ?))")){
							    			$aux->bind_param('iss', $idUser, $telefone1, $_SESSION['chave']);
							    			$aux->execute();
							    			$aux->close();
						    			}
						    		}
						    		if($telefone2 != ""){
							    		if ($aux = $aux_db->prepare("INSERT INTO tbtelefone (idUser, numTelefone) VALUES (?, AES_ENCRYPT(?, ?))")){
							    			$aux->bind_param('iss', $idUser, $telefone2, $_SESSION['chave']);
							    			$aux->execute();
							    			$aux->close();
						    			}
						    		}
					    		}
					    		while($query->fetch()){
				                	$aux_db = Atalhos::getBanco();
					    			if($tel != $telefone1 && $tel != $telefone2){
					    				if($aux_query = $db->prepare("UPDATE tbusuario SET numTelefone = AES_ENCRYPT(?, ?) WHERE idTelefone = ?")){
								    		$aux_query->bind_param('ssi', $tel, $_SESSION['chave'], $idTel);
								    		$aux_query->execute();
								    		$aux_query->close();
					    				}
					    			}
					    		}
					    	}
				    		$query->close();
					    }
						$db->close();
					}
				}
				else{
					echo "Usuário ou senha errados<br>";
				}
			}
		}

		public static function notificacao($idUser){
			$db = Atalhos::getBanco();
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
			$noti = '<li>
                      <a href="noti.php?id='.$idNoti.'&ir=/configuracao/emailDcomp" style="background-color: #EFEEEE">
                        <i class="fa fa-pencil-square-o text-red"></i> Você pode requisitar seu email DCOMP clicando aqui!
                      </a>
                    </li>';
            if($query = $db->prepare("INSERT INTO tbnotificacao (idNoti, notificacao, statusNoti) VALUES (?, ?, 'false')")){
              	$query->bind_param('is', $idNoti, $noti);
              	$query->execute();
              	$query->close();
            }
            if($query = $db->prepare("INSERT INTO tbnoticonexao VALUES (?, ?)")){
            	$query->bind_param('ii', $idUser, $idNoti);
              	$query->execute();
              	$query->close();
            }
            $db->close();
		}

		public static function encode($text){
			if(!isset($_SESSION['chave'])){
				$arquivo = fopen("passSecret/pass.txt", "r");
				$aux = fscanf($arquivo, "%s\t%s");
				$_SESSION['chave'] = $aux[1];
			}
			$key = pack('H*', $_SESSION['chave']);
			$iv = openssl_random_pseudo_bytes(16);
			$ciphertext = openssl_encrypt ($text, 'aes-256-cbc', $_SESSION['chave'], true, $iv);
    		$ciphertext = $iv .$ciphertext;
    		return base64_encode($ciphertext);
		}

		public static function decode($text){
			if(!isset($_SESSION['chave'])){
				$arquivo = fopen("passSecret/pass.txt", "r");
				$aux = fscanf($arquivo, "%s\t%s");
				$_SESSION['chave'] = $aux[1];
			}
			$key = pack('H*', $_SESSION['chave']);
			$ciphertext_dec = base64_decode($text);
    		$iv = substr($ciphertext_dec, 0, 16);
    		$ciphertext = substr($ciphertext_dec, 16);
    		return openssl_decrypt($ciphertext, 'aes-256-cbc', $_SESSION['chave'], true, $iv);
		}

		public static function getBanco(){
			if(!isset($_SESSION['senhaBanco'])){
				$arquivo = fopen("passSecret/pass.txt", "r");
				$aux = fscanf($arquivo, "%s\t%s");
				$_SESSION['chave'] = $aux[1];
				$texto = Atalhos::decode($aux[0]);
	            $tm = strlen($texto); //conta a quantidade de caracteres do texto
		        $x = 0;
			    $buf = "";
	            for($i = 1;$i <= $tm;$i++){
		            $letra[$i] = substr($texto,$x,1); //isola cada caractere da string
    	            $cod[$i] = ord($letra[$i]); //converte cada caractere em seu respectivo codigo ascii
	                $bin[$i] = decbin($cod[$i]); //converte cada codigo ascii em seu respectivo codigo binario
	                if ($bin[$i] == 0)
	                    break;
	                $buf = $buf.$letra[$i];
	                $x++;
	            }
	            $_SESSION['senhaBanco'] = $buf;
			}
			$db = new mysqli('localhost', 'root', $_SESSION['senhaBanco'], 'dcomp');
			$db->set_charset("utf8");
			return $db;
	    }

	    public static function mediaAtendimento(){
			$db = Atalhos::getBanco();
			if ($query = $db->prepare("SELECT idTicket, dataLog FROM tblog ORDER BY idTicket ASC")){
				$query->execute();
				$query->bind_result($idTicket, $dataLog);
				$idTicketOld = -1;
				$dataLogOld = -1;
				$dataTotal = 0;
				$i = 0;
				while ($query->fetch()){
					$dataLogStr = strtotime($dataLog);
					$dataLogOldStr = strtotime($dataLogOld);
					$dataLogSec = (($dataLogStr * 60) / 60);
					$dataLogOldSec = (($dataLogOldStr * 60) / 60);
					if ($idTicket == $idTicketOld){
						$dataTotal += $dataLogSec - $dataLogOldSec;
						$i++;
					}
					$dataLogOld = $dataLog;
					$idTicketOld = $idTicket;
				}
				if($i > 0){
					$dataTotal = (int)floor($dataTotal/60)/ $i;
					$mediaHora = (int) ($dataTotal/1440);
					$mediaMinuto = $mediaHora%24;
					$tudoMedia = array($mediaHora,$mediaMinuto);
				}else{
					$tudoMedia = 0;
				}
				$query->close();
				$db->close();
			}
			return $tudoMedia;
	    }

	    public static function mediaNota(){
			$db = Atalhos::getBanco();
			if ($query = $db->prepare ("SELECT avalicao FROM tbticket")){
				$query->execute();
				$query->bind_result($avaliacao);
				$total = 0;
				$i = 0;
				while ($query->fetch()){
					if ($avaliacao > 0){
						$total += $avaliacao;
						$i++;
					}
				}
				if($i > 0){
					$result = (int)floor($total / $i);
				}else{
					$result = 0;
				}
			}
			return $result;
	    }

		public static function diaSemana($dia){
			switch($dia){
				case 1:
					return 'Seg';
				case 2:
					return 'Ter';
				case 3:
					return 'Qua';
				case 4:
					return 'Qui';
				case 5:
					return 'Sex';
				case 6:
					return 'Sab';
				case 7:
					return 'Dom';
			}
		}

		public static function Hora($tempo){
			$tempo = explode(' ', $tempo);
			$aux = explode(':', $tempo[1]);
			$hora = $aux[0];
			if($aux[1] != '00'){
				$hora .= ':'.$aux[1];
			}
			return $hora;
		}

		public static function clean($str) {
			return str_replace("'", "", $str);
		}


		//Gera um HASH usando SSHA, função usada para encripitar a senha
		public static function make_ssha_password($password){
			mt_srand((double)microtime()*1000000);
			$salt = pack("CCCC", mt_rand(), mt_rand(), mt_rand(), mt_rand());
			$hash = "{SSHA}" . base64_encode(pack("H*", sha1($password . $salt)) . $salt);
			return $hash;
		}

		//Verifica se o servidor está operante
		public static function serviceping($host, $port = 389, $timeout=1) {	//porta 6363 =ldaps | timeout de 1 segundo
			$op = fsockopen($host, $port, $errno, $errstr, $timeout);
			if (!$op){
				return 0; //DC is N/A
			}else{
				fclose($op); //explicitly close open socket connection
				return 1; //DC is up & running, we can safely connect with ldap_connect
			}
		}
		//retorna próximo uidNumber
		public static function get_uidNMax($ds){
			//diretório onde ficam os usuários
			$dn = "ou=posix,dc=computacao,dc=ufs,dc=br";

			//filtro de atributos a serem pesquisados
			$filter="(uid=var)";

			//atributos a serem pegos
			$justthese = array("uidNumber");

			$sr = ldap_search($ds, $dn, $filter, $justthese);
			$info = ldap_get_entries($ds, $sr);
			$entry = ldap_first_entry($ds, $sr);

			$values = ldap_get_values($ds, $entry, "uidNumber");
			return  $values[0];
		}

		//seta o uidNumber máximo
		public static function set_uidNMax($ds, $uidN){
			$ldaprdn = "uid=var,ou=posix,dc=computacao,dc=ufs,dc=br";
			$entry = array();
			$entry["uidNumber"] = $uidN;
			ldap_mod_replace ($ds , $ldaprdn , $entry);
		}

		//retorna o atributo pesquisado
		public static function get_LDAPAttribute($ds, $attr, $uid){
			$dn = "ou=pessoas,dc=computacao,dc=ufs,dc=br";

			$justthese = array($attr);

			$sr = ldap_search($ds, $dn, '(uid='.$uid.')', $justthese);
			$info = ldap_get_entries($ds, $sr);
			$entry = ldap_first_entry($ds, $sr);

			$values = ldap_get_values($ds, $entry, $attr);

			return $values[0];

		}

		public static function set_LDAPAttribute($ds, $attr, $uid, $valor){
			$dn = "ou=pessoas,dc=computacao,dc=ufs,dc=br";
			$entry = array();
			$entry[$attr] = $valor;
			$ldaprdn = 'uid='.$uid.','.$dn;
			ldap_mod_replace($ds, $ldaprdn, $entry);
		}

		public static function nome($nome){
			$aux = explode(" ", $nome);
			$num = count($aux);
			if($num > 2){
				return $aux[0].' '.$aux[$num-1];
			}else{
				return $nome;
			}
		}

		public static function enviar($nome, $email, $senha, $login=null){
			if(isset($login)){
				exec("wget -bq --spider 'http://".$_SERVER['SERVER_NAME']."/frontend-v1.8/enviarMail.php?nome=".$nome."&email=".$email."&senha=".$senha."&login=".$login."'");
			}else{
				exec("wget -bq --spider 'http://".$_SERVER['SERVER_NAME']."/frontend-v1.8/enviarMail.php?nome=".$nome."&email=".$email."&senha=".$senha."'");
			}
		}

		public static function getData($inicio, $fim){
			$dataInicio = date('d/m/y', $inicio);
			$dataFim = date('d/m/y', $fim);
			if($dataInicio != $dataFim){
				$str = $dataInicio.' até '.$dataFim;
			}else{
				$str = $dataFim;
			}
			return $str.= '<br>'.date('H:i', $inicio).' - '.date('H:i', $fim);
		}

		public static function gerar($tamanho, $maiusculas, $numeros, $simbolos){
			// Caracteres de cada tipo
			$lmin = 'abcdefghijklmnopqrstuvwxyz';
			$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$num = '1234567890';
			$simb = '!@#$%*-';
			// Variáveis internas
			$retorno = '';
			$caracteres = '';
			// Agrupamos todos os caracteres que poderão ser utilizados
			$caracteres .= $lmin;
			if ($maiusculas) $caracteres .= $lmai;
			if ($numeros) $caracteres .= $num;
			if ($simbolos) $caracteres .= $simb;
			// Calculamos o total de caracteres possíveis
			$len = strlen($caracteres);
				for ($n = 1; $n <= $tamanho; $n++) {
				// Criamos um número aleatório de 1 até $len para pegar um dos caracteres
				$rand = mt_rand(1, $len);
				// Concatenamos um dos caracteres na variável $retorno
				$retorno .= $caracteres[$rand-1];
			}
			return $retorno;
		}

		public static function verificarEmail($email){
			$db = Atalhos::getBanco();
			$result = false;
			if($query = $db->prepare("SELECT idUser FROM tbemail WHERE AES_DECRYPT(email, ?) = ? LIMIT 1")){
				$query->bind_param('ss', $_SESSION['chave'], $email);
				$query->execute();
				if($query->fetch()){
					$result = true;
				}
				$query->close();
			}
			$db->close();
			return $result;
		}

		public static function gerarEmail($nome){
			$nome = strtolower($nome);
			$nome = str_replace(" de ", " ", $nome);
			$nome = str_replace(" da ", " ", $nome);
			$nome = str_replace(" dos ", " ", $nome);
			$aux = explode(" ", $nome);
			$num = count($aux);
			$j = 0;
			if($num > 1){
				do{
					if($j < $num-1){
						$temp = $aux[0];
						$temp .= '.';
						if($j > 0){
							for ($i = 1; $i <= $j && $i < $num-1; $i++) {
								$temp .= $aux[$i][0];
							}
						}
						$temp .= $aux[($num-1)];
					}else{
						if(!isset($base)){
							$i = 1;
							$base = $temp;
						}
						$temp = $base.$i++;
					}
					$j++;
				}while(Atalhos::verificarEmail($temp));
				$email = $temp.' ';
				$j = 0;
				$temp = '';
				do{
					if($j == 0){
						for($i = 0; $i < ($num-1); $i++){
							$temp .= $aux[$i][0];
						}
						$temp .= $aux[($num-1)];
					}else{
						if(!isset($base)){
							$base = $temp;
						}
						$temp = $base.$j;
					}
					$j++;
				}while(Atalhos::verificarEmail($temp));
				$email .= $temp.' ';
				$j = 0;
				do{
					if($j == 0){
						$temp = $aux[0];
						for($i = 1; $i < $num; $i++){
							$temp .= $aux[$i][0];
						}
					}else{
						if(!isset($base)){
							$base = $temp;
						}
						$temp = $base.$j;
					}
					$j++;
				}while(Atalhos::verificarEmail($temp));
				$email .= $temp;
			}else{
				$email = $nome;
			}
			return $email;
		}

		public static function validarCPF($cpf){
			// Verifica se o numero de digitos informados é igual a 11
		    if (strlen($cpf) != 11) {
		        return false;
		    }
		    // Verifica se nenhuma das sequências invalidas abaixo
		    // foi digitada. Caso afirmativo, retorna falso
		    else if ($cpf == '00000000000' ||
		        $cpf == '11111111111' ||
		        $cpf == '22222222222' ||
		        $cpf == '33333333333' ||
		        $cpf == '44444444444' ||
		        $cpf == '55555555555' ||
		        $cpf == '66666666666' ||
		        $cpf == '77777777777' ||
		        $cpf == '88888888888' ||
		        $cpf == '99999999999') {
		        return false;
		     // Calcula os digitos verificadores para verificar se o
		     // CPF é válido
			} else {
		        for ($t = 9; $t < 11; $t++) {

		            for ($d = 0, $c = 0; $c < $t; $c++) {
		                $d += $cpf{$c} * (($t + 1) - $c);
		            }
		            $d = ((10 * $d) % 11) % 10;
		            if ($cpf{$c} != $d) {
		                return false;
		            }
		        }
		        return true;
		    }
		}

		public static function choqueSala($dataInicio, $dataFim, $idSala, $idReSala=null, $idData=null){
			$db = Atalhos::getBanco();
			$idRes = '';
			if(isset($idReSala)){
				if($query = $db->prepare("SELECT g.idData, g.idReSala FROM tbreservasala a
					inner join tbcontroledatasala g on a.idReSala = g.idReSala inner join tbdata h on h.idData = g.idData
	  				inner join tbsala b on a.idSala = b.idSala WHERE (g.statusData = 'Pendente' OR g.statusData = 'Aprovado'
	  				OR g.statusData = 'Entregue') AND (a.idSala = ?) AND (h.inicio < ? AND h.fim > ?)
	  				AND (g.idReSala != ? OR g.idData != ?) ORDER BY h.inicio ASC")){
					$query->bind_param('issii', $idSala, $dataFim, $dataInicio, $idReSala, $idData);
				}
			}else{
				if($query = $db->prepare("SELECT g.idData, g.idReSala FROM tbreservasala a
					inner join tbcontroledatasala g on a.idReSala = g.idReSala inner join tbdata h on h.idData = g.idData
					inner join tbsala b on a.idSala = b.idSala WHERE (g.statusData = 'Pendente' OR g.statusData = 'Aprovado'
					OR g.statusData = 'Entregue') AND (a.idSala = ?) AND (h.inicio < ? AND h.fim > ?) ORDER BY h.inicio ASC")){
					$query->bind_param('iss', $idSala, $dataFim, $dataInicio);
				}
			}
			$query->execute();
			$query->store_result();
			$query->bind_result($data, $idRe);
			if($query->num_rows > 0){
				while($query->fetch()){
					if(!empty($idRes)){
						$idRes .= ' ';
					}
					$idRes .= $idRe.'-'.$data;
				}
				$query->close();
				$db->close();
				return $idRes;
			}else{
				$query->close();
				$db->close();
				return false;
			}
		}

		public static function choqueLab($dataInicio, $dataFim, $idLab, $tipo, $numPc, $idReLab=null, $idData=null){
			$countPc = $numPc;
			$retorno = $idRes = '';
			$privado = false;
			$db = Atalhos::getBanco();
			if(isset($idReLab)){
				if($query = $db->prepare("SELECT h.inicio, h.fim, a.tipoReLab, a.numPc, b.numComp, g.idData, g.idReLab
					FROM tbreservalab a  inner join tbcontroledatalab g on a.idReLab = g.idReLab
					inner join tbdata h on h.idData = g.idData inner join tblaboratorio b on g.idLab = b.idLab
					WHERE (g.statusData = 'Pendente' OR g.statusData = 'Aprovado' OR g.statusData = 'Entregue')
					AND (g.idLab = ?) AND (h.inicio < ? AND h.fim > ?) AND (g.idReLab != ? OR g.idData != ?)
					ORDER BY h.inicio ASC")){
					$query->bind_param('issii', $idLab, $dataFim, $dataInicio, $idReLab, $idData);
				}
			}else{
				if($query = $db->prepare("SELECT h.inicio, h.fim, a.tipoReLab, a.numPc, b.numComp, g.idData, g.idReLab
					FROM tbreservalab a  inner join tbcontroledatalab g on a.idReLab = g.idReLab
					inner join tbdata h on h.idData = g.idData inner join tblaboratorio b on g.idLab = b.idLab
					WHERE (g.statusData = 'Pendente' OR g.statusData = 'Aprovado' OR g.statusData = 'Entregue')
					AND (g.idLab = ?) AND (h.inicio < ? AND h.fim > ?) ORDER BY h.inicio ASC")){
					$query->bind_param('iss', $idLab, $dataFim, $dataInicio);
				}
			}
			$query->execute();
			$query->store_result();
			$query->bind_result($inicio, $fim, $tipoRe, $numPc, $numComp, $data, $idRe);
			if($query->num_rows > 0){
				$i = 0;
				if($tipo == 'Privado'){
					$privado = true;
				}
				while($query->fetch()){
					if(!isset($totalPc)){
						$array = array();
						$totalPc = $numComp;
						$idRes .= $idRe.'-'.$data;
					}else{
						$j = $k = 0;
						$count = $numPc;
						$auxRes = '';
						$aux = array();
						$temp = explode(' ', $idRes);
						do{
							if($array[$j][1] > $inicio && $array[$j][0] < $fim){
								$aux[$k][0] = $array[$j][0];
								$aux[$k][1] = $array[$j][1];
								$aux[$k++][2] = $array[$j][2];
								$count += $aux[$j][2];
								if(!empty($auxRes)){
									$auxRes .= ' ';
								}
								$auxRes .= $temp[$j];
							}
							$j++;
						}while($j < $i);
						if($count != $countPc){
							if($countPc > $totalPc || $privado){
								$returno .= $idRes;
								$privado = false;
							}
							$j = 0;
							while((!$privado) && $j < $k){
								if($aux[$j++][2] == 0){
									$privado = true;
								}
							}
							$idRes = $auxRes;
							$array = $aux;
							$countEq = $count;
							$i = $k;
						}
						$idRes .= ' '.$idRe.'-'.$data;
					}
					$array[$i][0] = $inicio;
					$array[$i][1] = $fim;
					$array[$i++][2] = $numPc;
					$countPc += $numPc;
					if((!$privado) && $tipoRe == 'Privado'){
						$privado = true;
					}
				}
				$query->close();
				$db->close();
				if($countPc > $totalPc || $privado){
					if(!empty($retorno)){
						return $idRes.' '.$retorno;
					}else{
						return $idRes;
					}
				}elseif(!empty($retorno)){
					return $retorno;
				}else{
					return false;
				}
			}else{
				$query->close();
				$db->close();
				return false;
			}
		}

		public static function choqueEq($dataInicio, $dataFim, $idTipoEq, $numEq, $idReEq=null,$idData=null){
			$countEq = $numEq;
			$retorno = '';
			$db = Atalhos::getBanco();
			if(isset($idReEq)){
				if($query = $db->prepare("SELECT c.inicio, c.fim, d.idTipoEq, b.idReEq, b.idData, b.statusData, e.numEq, d.numReEq
					FROM tbreservaeq a inner join tbcontroledataeq b on a.idReEq = b.idReEq
					inner join tbdata c on c.idData = b.idData inner join tbreservatipoeq d on a.idReEq = d.idReEq
			        inner join tbtipoeq e on e.idTipoEq = d.idTipoEq WHERE (b.statusData = 'Pendente'
			        OR b.statusData = 'Aprovado' OR b.statusData = 'Entregue') AND (d.idTipoEq = ?)
			        AND (c.inicio < ? AND c.fim > ?) AND (b.idReEq != ? OR b.idData != ?)
			        ORDER BY c.inicio ASC, c.fim DESC")){
					$query->bind_param('issii', $idTipoEq, $dataFim, $dataInicio, $idReEq, $idData);
				}
			}else{
				if($query = $db->prepare("SELECT c.inicio, c.fim, d.idTipoEq, b.idReEq, b.idData, b.statusData, e.numEq, d.numReEq
					FROM tbreservaeq a inner join tbcontroledataeq b on a.idReEq = b.idReEq
					inner join tbdata c on c.idData = b.idData inner join tbreservatipoeq d on a.idReEq = d.idReEq
			        inner join tbtipoeq e on e.idTipoEq = d.idTipoEq WHERE (b.statusData = 'Pendente'
			        OR b.statusData = 'Aprovado' OR b.statusData = 'Entregue') AND (d.idTipoEq = ?)
			        AND (c.inicio < ? AND c.fim > ?) ORDER BY c.inicio ASC, c.fim DESC")){
					$query->bind_param('iss', $idTipoEq, $dataFim, $dataInicio);
				}
			}
			$query->execute();
			$query->store_result();
			$query->bind_result($inicio, $fim, $idTipoEq, $idRe, $data, $status, $numEq, $numReEq);
			if($query->num_rows > 0){
				$i = 0;
				while($query->fetch()){
					if(!isset($totalEq)){
						$array = array();
						$totalEq = $numEq;
						$idRes = $idRe.'-'.$data;
					}else{
						$j = $k = 0;
						$count = $numEq;
						$auxRes = '';
						$aux = array();
						$temp = explode(' ', $idRes);
						do{
							if($array[$j][1] > $inicio && $array[$j][0] < $fim){
								$aux[$k][0] = $array[$j][0];
								$aux[$k][1] = $array[$j][1];
								$aux[$k++][2] = $array[$j][2];
								$count += $aux[$j][2];
								if(!empty($auxRes)){
									$auxRes .= ' ';
								}
								$auxRes .= $temp[$j];
							}
							$j++;
						}while($j < $i);
						if($count != $countEq){
							if($countEq > $totalEq){
								$returno .= $idRes;
							}
							$idRes = $auxRes;
							$array = $aux;
							$countEq = $count;
							$i = $k;
						}
						$idRes .= ' '.$idRe.'-'.$data;
					}
					$array[$i][0] = $inicio;
					$array[$i][1] = $fim;
					$array[$i++][2] = $numReEq;
					$countEq += $numReEq;
				}
				$query->close();
				$db->close();
				if($countEq > $totalEq){
					if(!empty($retorno)){
						return $idRes.' '.$retorno;
					}else{
						return $idRes;
					}
				}else if(!empty($retorno)){
					return $retorno;
				}else{
					return false;
				}
			}else{
				$query->close();
				$db->close();
				return false;
			}
		}

		public static function unirConjunto($idRe, $idData, $idChoqueRe, $idChoqueData, $tipo){
			$db = Atalhos::getBanco();
			$auxDb = Atalhos::getBanco();
			if($tipo == 1){
				if($query = $db->prepare("SELECT idData, idReEq FROM tbchoqueeq
					WHERE (idData = ? AND idReEq = ?) OR (idChoqueData = ? AND idChoqueReEq = ?)")){
					$query->bind_param('iiii', $idData, $idRe, $idData, $idRe);
					if($aux = $auxDb->prepare("SELECT idData, idReEq FROM tbchoqueeq
						WHERE (idData = ? AND idReEq = ?) OR (idChoqueData = ? AND idChoqueReEq = ?)")){
						$aux->bind_param('iiii', $idChoqueData, $idChoqueRe, $idChoqueData, $idChoqueRe);
						$query->execute();
						$query->store_result();
						$aux->execute();
						$aux->store_result();
						if($query->num_rows > 0){
							$query->bind_result($data, $reserva);
							$query->fetch();
							$query->close();
							if($aux->num_rows > 0){
								$aux->bind_result($data2, $reserva2);
								$aux->fetch();
								$aux->close();
								if($reserva != $reserva2 || $data != $data2){
									if($query = $db->prepare("UPDATE tbchoqueeq SET idReEq = ?, idData = ? WHERE idReEq = ?
										AND idData = ?)")){
										$query->bind_param('iiii', $reserva, $data, $reserva2, $data2);
										$query->execute();
										$query->close();
										if($aux = $auxDb->prepare("INSERT INTO tbchoqueeq VALUES (?, ?, ?, ?)")){
											$aux->bind_param('iiii', $reserva, $data, $reserva2, $data2);
											$aux->execute();
											$aux->close();
										}
									}
								}
							}else{
								$aux->close();
								if($aux = $auxDb->prepare("INSERT INTO tbchoqueeq VALUES (?, ?, ?, ?)")){
									$aux->bind_param('iiii', $reserva, $data, $idChoqueRe, $idChoqueData);
									$aux->execute();
									$aux->close();
								}
							}
						}elseif($aux->num_rows > 0){
							$query->close();
							$aux->bind_result($data2, $reserva2);
							$aux->fetch();
							$aux->close();
							if($aux = $auxDb->prepare("INSERT INTO tbchoqueeq VALUES (?, ?, ?, ?)")){
								$aux->bind_param('iiii', $reserva2, $data2, $idRe, $idData);
								$aux->execute();
								$aux->close();
							}
						}else{
							$query->close();
							$aux->close();
							if($aux = $auxDb->prepare("INSERT INTO tbchoqueeq VALUES (?, ?, ?, ?)")){
								$aux->bind_param('iiii', $idRe, $idData, $idChoqueRe, $idChoqueData);
								$aux->execute();
								$aux->close();
							}
						}
					}
				}
			}elseif($tipo == 2){
				if($query = $db->prepare("SELECT idData, idReLab FROM tbchoquelab
					WHERE (idData = ? AND idReLab = ?) OR (idChoqueData = ? AND idChoqueReLab = ?)")){
					$query->bind_param('iiii', $idData, $idRe, $idData, $idRe);
					if($aux = $auxDb->prepare("SELECT idData, idReLab FROM tbchoquelab
						WHERE (idData = ? AND idReLab = ?) OR (idChoqueData = ? AND idChoqueReLab = ?)")){
						$aux->bind_param('iiii', $idChoqueData, $idChoqueRe, $idChoqueData, $idChoqueRe);
						$query->execute();
						$query->store_result();
						$aux->execute();
						$aux->store_result();
						if($query->num_rows > 0){
							$query->bind_result($data, $reserva);
							$query->fetch();
							$query->close();
							if($aux->num_rows > 0){
								$aux->bind_result($data2, $reserva2);
								$aux->fetch();
								$aux->close();
								if($reserva != $reserva2 || $data != $data2){
									if($query = $db->prepare("UPDATE tbchoquelab SET idReLab = ?, idData = ? WHERE idReLab = ?
										AND idData = ?)")){
										$query->bind_param('iiii', $reserva, $data, $reserva2, $data2);
										$query->execute();
										$query->close();
										if($aux = $auxDb->prepare("INSERT INTO tbchoquelab VALUES (?, ?, ?, ?)")){
											$aux->bind_param('iiii', $reserva, $data, $reserva2, $data2);
											$aux->execute();
											$aux->close();
										}
									}
								}
							}else{
								$aux->close();
								if($aux = $auxDb->prepare("INSERT INTO tbchoquelab VALUES (?, ?, ?, ?)")){
									$aux->bind_param('iiii', $reserva, $data, $idChoqueRe, $idChoqueData);
									$aux->execute();
									$aux->close();
								}
							}
						}elseif($aux->num_rows > 0){
							$query->close();
							$aux->bind_result($data2, $reserva2);
							$aux->fetch();
							$aux->close();
							if($aux = $auxDb->prepare("INSERT INTO tbchoquelab VALUES (?, ?, ?, ?)")){
								$aux->bind_param('iiii', $reserva2, $data2, $idRe, $idData);
								$aux->execute();
								$aux->close();
							}
						}else{
							$query->close();
							$aux->close();
							if($aux = $auxDb->prepare("INSERT INTO tbchoquelab VALUES (?, ?, ?, ?)")){
								$aux->bind_param('iiii', $idRe, $idData, $idChoqueRe, $idChoqueData);
								$aux->execute();
								echo $aux->error.'</br>';
								$aux->close();
							}
						}
					}
				}
			}else{
				if($query = $db->prepare("SELECT idData, idReSala FROM tbchoquesala
					WHERE (idData = ? AND idReSala = ?) OR (idChoqueData = ? AND idChoqueReSala = ?)")){
					$query->bind_param('iiii', $idData, $idRe, $idData, $idRe);
					if($aux = $auxDb->prepare("SELECT idData, idReSala FROM tbchoquesala
						WHERE (idData = ? AND idReSala = ?) OR (idChoqueData = ? AND idChoqueReSala = ?)")){
						$aux->bind_param('iiii', $idChoqueData, $idChoqueRe, $idChoqueData, $idChoqueRe);
						$query->execute();
						$query->store_result();
						$aux->execute();
						$aux->store_result();
						if($query->num_rows > 0){
							$query->bind_result($data, $reserva);
							$query->fetch();
							$query->close();
							if($aux->num_rows > 0){
								$aux->bind_result($data2, $reserva2);
								$aux->fetch();
								$aux->close();
								if($reserva != $reserva2 || $data != $data2){
									if($query = $db->prepare("UPDATE tbchoquesala SET idReSala = ?, idData = ? WHERE idReSala = ?
										AND idData = ?)")){
										$query->bind_param('iiii', $reserva, $data, $reserva2, $data2);
										$query->execute();
										$query->close();
										if($aux = $auxDb->prepare("INSERT INTO tbchoquesala VALUES (?, ?, ?, ?)")){
											$aux->bind_param('iiii', $reserva, $data, $reserva2, $data2);
											$aux->execute();
											$aux->close();
										}
									}
								}
							}else{
								$aux->close();
								if($aux = $auxDb->prepare("INSERT INTO tbchoquesala VALUES (?, ?, ?, ?)")){
									$aux->bind_param('iiii', $reserva, $data, $idChoqueRe, $idChoqueData);
									$aux->execute();
									$aux->close();
								}
							}
						}elseif($aux->num_rows > 0){
							$query->close();
							$aux->bind_result($data2, $reserva2);
							$aux->fetch();
							$aux->close();
							if($aux = $auxDb->prepare("INSERT INTO tbchoquesala VALUES (?, ?, ?, ?)")){
								$aux->bind_param('iiii', $reserva2, $data2, $idRe, $idData);
								$aux->execute();
								$aux->close();
							}
						}else{
							$query->close();
							$aux->close();
							if($aux = $auxDb->prepare("INSERT INTO tbchoquesala VALUES (?, ?, ?, ?)")){
								$aux->bind_param('iiii', $idRe, $idData, $idChoqueRe, $idChoqueData);
								$aux->execute();
								$aux->close();
							}
						}
					}
				}
			}
			$auxDb->close();
			$db->close();
		}

		public static function includeChoque($choque, $idRe, $idData, $tipo){
			$choque = explode(" ", $choque);
			$num = count($choque);
			for($i = 0; $i < $num; $i++){
				$choque[$i] = explode("-", $choque[$i]);
				Atalhos::unirConjunto($idRe, $idData, $choque[$i][0], $choque[$i][1], $tipo);
			}
		}

		public static function getConjunto($idRe, $idData, $tipo){
			$db = Atalhos::getBanco();
			if($tipo == 1){
				if($idData != 0){
					if($query = $db->prepare("SELECT * FROM  tbchoqueeq WHERE (idData = ? AND idReEq = ?) OR
					(idChoqueData = ? AND idChoqueReEq = ?)")){
						$query->bind_param('iiii',$idData, $idRe, $idData, $idRe);
					}
				}else{
					if($query = $db->prepare("SELECT * FROM  tbchoqueeq WHERE idReEq = ? OR idChoqueReEq = ?")){
						$query->bind_param('ii', $idRe, $idRe);
					}
				}
				$query->execute();
				$query->bind_result($Re, $Data, $ChoqueRe, $ChoqueData);
				while($query->fetch()){
					if($ChoqueRe == $idRe){
						if(isset($result)){
							$result .= " ".$Re."-".$Data;
						}else{
							$result = $Re."-".$Data;
						}
						$auxDb = Atalhos::getBanco();
						if($aux = $auxDb->prepare("SELECT idChoqueReEq, idChoqueData FROM tbchoqueeq WHERE idReEq = ?
							AND idData = ? AND idChoqueReSala != ?")){
							$aux->bind_param('iii', $Re, $Data, $ChoqueRe);
							$aux->execute();
							$aux->bind_result($auxRe, $auxData);
							while($aux->fetch()){
								if(isset($result)){
									$result .= " ".$auxRe."-".$auxData;
								}else{
									$result = $auxRe."-".$auxData;
								}
							}
							$aux->close();
						}
						$auxDb->close();
					}else{
						if(isset($result)){
							$result .= " ".$ChoqueRe."-".$ChoqueData;
						}else{
							$result = $ChoqueRe."-".$ChoqueData;
						}
					}
				}
				$query->close();
				$db->close();
				if(empty($result)){
					return false;
				}else{
					return $result;
				}
			}elseif($tipo == 2){
				if($idData != 0){
					if($query = $db->prepare("SELECT * FROM  tbchoquelab WHERE (idData = ? AND idReLab = ?) OR
						(idChoqueData = ? AND idChoqueReLab = ?)")){
						$query->bind_param('iiii',$idData, $idRe, $idData, $idRe);
					}
				}else{
					if($query = $db->prepare("SELECT * FROM  tbchoquelab WHERE idReLab = ? OR idChoqueReLab = ?")){
						$query->bind_param('ii', $idRe, $idRe);
					}
				}
				$query->execute();
				$query->bind_result($Re, $Data, $ChoqueRe, $ChoqueData);
				while($query->fetch()){
					if($ChoqueRe == $idRe){
						if(isset($result)){
							$result .= " ".$Re."-".$Data;
						}else{
							$result = $Re."-".$Data;
						}
						$auxDb = Atalhos::getBanco();
						if($aux = $auxDb->prepare("SELECT idChoqueReLab, idChoqueData FROM  tbchoquesala WHERE idReLab = ?
							AND idData = ? AND idChoqueReLab != ?")){
							$aux->bind_param('iii', $Re, $Data, $ChoqueRe);
							$aux->execute();
							$aux->bind_result($auxRe, $auxData);
							while($aux->fetch()){
								if(isset($result)){
									$result .= " ".$auxRe."-".$auxData;
								}else{
									$result = $auxRe."-".$auxData;
								}
							}
							$aux->close();
						}
						$auxDb->close();
					}else{
						if(isset($result)){
							$result .= " ".$ChoqueRe."-".$ChoqueData;
						}else{
							$result = $ChoqueRe."-".$ChoqueData;
						}
					}
				}
				$query->close();
				$db->close();
				if(empty($result)){
					return false;
				}else{
					return $result;
				}
			}else{
				if($idData != 0){
					if($query = $db->prepare("SELECT * FROM  tbchoquesala WHERE (idData = ? AND idReSala = ?) OR
						(idChoqueData = ? AND idChoqueReSala = ?)")){
						$query->bind_param('iiii',$idData, $idRe, $idData, $idRe);
					}
				}else{
					if($query = $db->prepare("SELECT * FROM  tbchoquesala WHERE idReSala = ? OR idChoqueReSala = ?")){
						$query->bind_param('ii', $idRe, $idRe);
					}
				}
				$query->execute();
				$query->bind_result($Re, $Data, $ChoqueRe, $ChoqueData);
				while($query->fetch()){
					if($ChoqueRe == $idRe){
						if(isset($result)){
							$result .= " ".$Re."-".$Data;
						}else{
							$result = $Re."-".$Data;
						}
						$auxDb = Atalhos::getBanco();
						if($aux = $auxDb->prepare("SELECT idChoqueReSala, idChoqueData FROM  tbchoquesala WHERE idReSala = ?
							AND idData = ? AND idChoqueReSala != ?")){
							$aux->bind_param('iii', $Re, $Data, $ChoqueRe);
							$aux->execute();
							$aux->bind_result($auxRe, $auxData);
							while($aux->fetch()){
								if(isset($result)){
									$result .= " ".$auxRe."-".$auxData;
								}else{
									$result = $auxRe."-".$auxData;
								}
							}
							$aux->close();
						}
						$auxDb->close();
					}else{
						if(isset($result)){
							$result .= " ".$ChoqueRe."-".$ChoqueData;
						}else{
							$result = $ChoqueRe."-".$ChoqueData;
						}
					}
				}
				$query->close();
				$db->close();
				if(empty($result)){
					return false;
				}else{
					return $result;
				}
			}
		}

		public static function verificarConjunto($idRes, $tipo){
			$db = Atalhos::getBanco();
			if($tipo == 1){
				$choque = explode(" ", $idRes);
				$num = count($choque);
				for($i = 0; $i < $num; $i++){
					$choque[$i] = explode("-", $choque[$i]);
					if($query = $db->prepare("SELECT c.inicio, c.fim, d.idTipoEq, d.numReEq FROM tbreservaeq a
						inner join tbcontroledataeq b on a.idReEq = b.idReEq  inner join tbdata c on c.idData = b.idData
						inner join tbreservatipoeq d on a.idReEq = d.idReEq inner join tbtipoeq e on e.idTipoEq = d.idTipoEq
						WHERE b.idReEq = ? AND b.idData = ?")){
						$query->bind_param('ii', $choque[$i][0], $choque[$i][1]);
						$query->execute();
						$query->bind_result($inicio, $fim, $idTipoEq, $numReEq);
						$query->fetch();
						$temp = Atalhos::choqueEq($inicio, $fim, $idTipoEq, $numReEq, $choque[$i][0], $choque[$i][1]);
						if($temp != false){
							Atalhos::includeChoque($temp, $choque[$i][0], $choque[$i][1], $tipo);
						}
						$query->close();
					}
				}
			}elseif($tipo == 2){
				$j = 0;
				$choque = explode(" ", $idRes);
				$num = count($choque);
				for($i = 0; $i < $num; $i++){
					$choque[$i] = explode("-", $choque[$i]);
					if($query = $db->prepare("SELECT h.inicio, h.fim, a.tipoReLab, a.numPc, b.idLab FROM tbreservalab a
						inner join tbcontroledatalab g on a.idReLab = g.idReLab inner join tbdata h on h.idData = g.idData
	  					inner join tblaboratorio b on g.idLab = b.idLab WHERE g.idReLab = ? AND b.idData = ?")){
						$query->bind_param('ii', $choque[$i][0], $choque[$i][1]);
						$query->execute();
						$query->bind_result($inicio, $fim, $tipoRe, $numPc, $idLab);
						$query->fetch();
						$temp = Atalhos::choqueEq($inicio, $fim, $idLab, $tipoRe, $numPc, $choque[$i][0], $choque[$i][1]);
						if($temp != false){
							Atalhos::includeChoque($temp, $choque[$i][0], $choque[$i][1], $tipo);
						}
						$query->close();
					}
				}
			}else{
				$j = 0;
				$choque = explode(" ", $idRes);
				$num = count($choque);
				for($i = 0; $i < $num; $i++){
					$choque[$i] = explode("-", $choque[$i]);
					if($query = $db->prepare("SELECT h.inicio, h.fim, b.idSala FROM tbreservasala a
						inner join tbcontroledatasala g on a.idReSala = g.idReSala inner join tbdata h on h.idData = g.idData
	  					inner join tbsala b on b.idSala = a.idSala WHERE g.idReSala = ? AND b.idData = ?")){
						$query->bind_param('ii', $choque[$i][0], $choque[$i][1]);
						$query->execute();
						$query->bind_result($inicio, $fim, $idSala);
						$query->fetch();
						$temp = Atalhos::choqueEq($inicio, $fim, $idSala, $choque[$i][0], $choque[$i][1]);
						if($temp != false){
							Atalhos::includeChoque($temp, $choque[$i][0], $choque[$i][1], $tipo);
						}
						$query->close();
					}
				}
			}
		}

		public static function deletarConjunto($idRe, $idData, $tipo){
			$db = Atalhos::getBanco();
			if($tipo == 1){
				if($idData != 0){
					if($query = $db->prepare("SELECT idReEq, idData FROM  tbchoqueeq WHERE (idData = ? AND idReEq = ?) OR
							(idChoqueData = ? AND idChoqueReEq = ?) LIMIT 1")){
						$query->bind_param('iiii',$idData, $idRe, $idData, $idRe);
					}
				}else{
					if($query = $db->prepare("SELECT idReEq, idData FROM  tbchoqueeq WHERE idReEq = ? OR idChoqueReEq = ?")){
						$query->bind_param('ii', $idRe, $idRe);
					}
				}
				$query->execute();
				$query->bind_result($Re, $Data);
				$auxDb = Atalhos::getBanco();
				while($query->fetch()){
					if($aux = $auxDb->prepare("DELETE FROM tbchoqueeq WHERE idData = ? AND idReEq = ?")){
						$aux->bind_param('ii', $Data, $Re);
						$aux->execute();
						$aux->close();
					}
				}
				$query->close();
				$auxDb->close();
			}elseif($tipo == 2){
				if($idData != 0){
					if($query = $db->prepare("SELECT idReLab, idData FROM  tbchoquelab WHERE (idData = ? AND idReLab = ?) OR
							(idChoqueData = ? AND idChoqueReLab = ?) LIMIT 1")){
						$query->bind_param('iiii',$idData, $idRe, $idData, $idRe);
					}
				}else{
					if($query = $db->prepare("SELECT idReLab, idData FROM  tbchoquelab WHERE idReLab = ? OR idChoqueReLab = ?")){
						$query->bind_param('ii', $idRe, $idRe);
					}
				}
				$query->execute();
				$query->bind_result($Re, $Data);
				$auxDb = Atalhos::getBanco();
				while($query->fetch()){
					if($aux = $auxDb->prepare("DELETE FROM tbchoquelab WHERE idData = ? AND idReLab = ?")){
						$aux->bind_param('ii', $Data, $Re);
						$aux->execute();
						$aux->close();
					}
				}
				$query->close();
				$auxDb->close();
			}else{
				if($idData != 0){
					if($query = $db->prepare("SELECT idReSala, idData FROM  tbchoquesala WHERE (idData = ? AND idReSala = ?) OR
							(idChoqueData = ? AND idChoqueReSala = ?) LIMIT 1")){
						$query->bind_param('iiii',$idData, $idRe, $idData, $idRe);
					}
				}else{
					if($query = $db->prepare("SELECT idReSala, idData FROM  tbchoquesala WHERE idReSala = ? OR idChoqueReSala = ?")){
						$query->bind_param('ii', $idRe, $idRe);
					}
				}
				$query->execute();
				$query->bind_result($Re, $Data);
				$auxDb = Atalhos::getBanco();
				while($query->fetch()){
					if($aux = $auxDb->prepare("DELETE FROM tbchoquesala WHERE idData = ? AND idReSala = ?")){
						$aux->bind_param('ii', $Data, $Re);
						$aux->execute();
						$aux->close();
					}
				}
				$query->close();
				$auxDb->close();
			}
		}

		public static function aviso($tipo) {
			switch ($tipo) {
				case 1:
					$titulo = 'Sem permissão!';
					$frase = 'Tenha certeza que esse requerimento é seu e que ainda é possível editá-lo.';
					break;
			}
			$aviso = '<div class="callout callout-warning">
	           				<h4>'.$titulo.'</h4>
			                <p>'.$frase.'</p>
		                </div>';
			return $aviso;
		}

		public static function verificarReq($tipo){
            $db = Atalhos::getBanco();
		    if($query = $db->prepare("SELECT inicio, fim FROM tbprazo WHERE idPrazo = ? LIMIT 1")){
			    $query->bind_param('i', $tipo);
			    $query->execute();
			    $query->bind_result($inicio, $fim);
			}
			$query->fetch();
			$query->close();
			$db->close();
          	$transformaHoje = date("Y-m-d", time());
          	$hoje = strtotime($transformaHoje);
          	$data_inicio = date("d/m/Y", strtotime($inicio));
          	$data_fim = date("d/m/Y", strtotime($fim));

          	if(($hoje >= strtotime($inicio) && $hoje <= strtotime($fim)) || (is_null($inicio) && is_null($fim))){
            	$retorno = array(true, $data_inicio, $data_fim);
            	return $retorno;
          	}
          	else{
          		$retorno = array(false, $data_inicio, $data_fim);
            	return $retorno;
          	}
        }

		public static function enviarPdfRequerimentos(){
			$db = Atalhos::getBanco();
			$extensao = pathinfo($_FILES['pdf']['name'], PATHINFO_EXTENSION);
			if($_FILES['pdf']['error'] != 0){
		        $_UP['erros'][1] = 'O PDF é grande demais.';
		        $_UP['erros'][2] = 'O PDF é grande demais.';
		        $_UP['erros'][3] = 'O upload do PDF foi interrompido.';
		        $_UP['erros'][4] = 'Nenhum PDF inserido.';
		        $_SESSION['erroPdf'] = $_UP['erros'][$_FILES['pdf']['error']];
		        return false;
	      	} elseif($extensao != 'pdf'){
	      		$_SESSION['erroPdf'] = 'Arquivo não é PDF.';
	      		return false;
	      	} else
	      		return true;
		}

		public static function enviarEmail($para, $tipoEmail){
			require_once("phpmailer/class.phpmailer.php");
			include("phpmailer/class.smtp.php");
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->SMTPDebug  = false;// enables SMTP debug information (for testing)
			// 1 = errors and messages
			// 2 = messages only
			$mail->CharSet = 'UTF-8';
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
			$mail->Username   = "naoresponder@dcomp.ufs.br";  // GMAIL username
			$mail->Password   = "Gr4nd3sP0d3r3sTr4z3mGr4nd3sR3sp0ns4b1l1d4d3s";            // GMAIL password
			$mail->SetFrom('naoresponder@dcomp.ufs.br', 'Não Responder DCOMP');
			$mail->AltBody    = "Para visualizar esta mensagem é necessario ter um visualizador de e-mail compativel com HTML"; // optional, comment out and test

			switch ($tipoEmail){
				case 1: //Email Admin
					$mail->Subject = "Seu ticket foi respondido!";
					$mail->MsgHTML('<html>
						<head>
							<meta charset="utf-8">
							<title></title>
						</head>
						<body>
							<div>
								<p>Olá usuário,</p>
								<p>A nossa equipe acabou de responder um ticket aberto por você no portal AdminDComp.</p>
								<p>Acesse a sua conta para visualizar a resposta ou executar outras ações.</p>
								<p>Att,<br>DCOMP.</p>
								<img src="forms/dcomp-novo1.png" width="161" height="80">

								<table class="rodape" cellpadding="0" cellspacing="0">
									<tr>
											Cidade Universitária “Prof. José Aloísio de Campos”<br>
											Av. Marechal Rondon, s/n – Jardim Rosa Elze – São Cristóvão-SE – CEP: 49100-000 <br>
											Telefone: (79) 2105-6678 – Endereço Eletrônico: computacao.ufs.br | admin.dcomp.ufs.br
									</tr>
								</table>
							</div>
						</body>
					</html>');
					break;

			}

			$mail->AddAddress($para, 'Destinatário');
			//$mail->AddAttachment("images/phpmailer.gif");      // attachment
			//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
			$enviado = $mail->Send();
			// Limpa os destinatários e os anexos
			$mail->ClearAllRecipients();
			$mail->ClearAttachments();
		}

		public static function enviarEmailPrimeiroAcesso($nome, $email)	{
			require_once("phpmailer/class.phpmailer.php");
			include("phpmailer/class.smtp.php");
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->SMTPDebug  = false;// enables SMTP debug information (for testing)
			// 1 = errors and messages
			// 2 = messages only
			$mail->CharSet = 'UTF-8';
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
			$mail->Username   = "leonardorpaixao3@gmail.com";  // GMAIL username
			$mail->Password   = "leo152476389";            // GMAIL password
			$mail->SetFrom('leonardorpaixao3@gmail.com', 'Não Responder DCOMP');
			$mail->AltBody    = "Para visualizar esta mensagem é necessario ter um visualizador de e-mail compativel com HTML"; // optional, comment out and test

			$mail->Subject = "Teste";
			$mail->MsgHTML('<html>
						<head>
							<meta charset="utf-8">
							<title></title>
						</head>
						<body>
							<div>
								<p>Olá! ISSO É UM TESTE!,</p>
								
								<img src="forms/dcomp-novo1.png" width="161" height="80">

								<table class="rodape" cellpadding="0" cellspacing="0">
									<tr>
											Cidade Universitária “Prof. José Aloísio de Campos”<br>
											Av. Marechal Rondon, s/n – Jardim Rosa Elze – São Cristóvão-SE – CEP: 49100-000 <br>
											Telefone: (79) 2105-6678 – Endereço Eletrônico: computacao.ufs.br | admin.dcomp.ufs.br
									</tr>
								</table>
							</div>
						</body>
					</html>');
					

			

			$mail->AddAddress('leonardorpaixao3@gmail.com');
			//$mail->AddAttachment("images/phpmailer.gif");      // attachment
			//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
			$enviado = $mail->Send();
			// Limpa os destinatários e os anexos
			$mail->ClearAllRecipients();
			$mail->ClearAttachments();
		}
		

		
	}
?>
