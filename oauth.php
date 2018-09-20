<?php
	require_once 'oauth2/google-api-php-client/src/Google/autoload.php';
	$client = new Google_Client();
	$client->setAuthConfigFile('https://admin.dcomp.ufs.br/client_secret.json');
	//$client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);
	$client->addScope("email");
	if(isset($_GET['code'])){
		$client->authenticate($_GET['code']);
		$_SESSION['access_token'] = $client->getAccessToken();
		header('Location: ' .$_SESSION['irPara']);
		exit;
	}

	if(isset($_SESSION['access_token']) && $_SESSION['access_token'] && !$_SESSION['logado']){
		$client->setAccessToken($_SESSION['access_token']);
		$service = new Google_Service_Oauth2($client);
		$user = $service->userinfo->get();
		$email = explode('@', $user->email);
		$db = Atalhos::getBanco();
 		if ($email[1] == 'dcomp.ufs.br'){
			if($query = $db->prepare("SELECT a.idUser, a.nomeUser, a.nivel, a.statusUser, a.termo, a.idAfiliacao FROM tbusuario a inner join tbemail b on a.idUser = b.idUser WHERE AES_DECRYPT(a.email, ?) = ? OR AES_DECRYPT(b.email, ?) = ? LIMIT 1")){//Por algum motivo quando é desencriptado ele não mostra o original, parece que essa chave ta corronpida, mas não sei como
				$query->bind_param('ssss', $_SESSION['chave'], $user->email, $_SESSION['chave'], $email[0]);
				$query->execute();
				$query->bind_result($id, $nome, $nivel, $status, $termo, $afiliacao);
				if($query->fetch()){
					session_regenerate_id();
					$_SESSION['id'] = $id;
					$_SESSION['nome'] = $nome;
					$_SESSION['nivel'] = $nivel;
					$_SESSION['afiliacao'] = $afiliacao;
					$_SESSION['ativo'] = ($status == 'Ativo') ? true : false;
					Atalhos::addLogsAcoes('Logou', null, null);
					$query->close();
					if($termo == 1){
						$_SESSION['logado'] = true;
						$query = $db->prepare("SELECT sessao FROM tbonline WHERE idUser= ?");
						$query->bind_param('i', $_SESSION['id']);
						$query->execute();
						if($query->fetch()){
							$query->close();
							$query = $db->prepare("UPDATE tbonline SET tempoExpirar= ?,sessao= ? WHERE idUser=?");
							$query->bind_param('sss', date("Y-m-d H:i:s", strtotime("+1 hour 30 minutes")), session_id(), $_SESSION['id']);
							$query->execute();
						}else{
							$query->close();
							$query = $db->prepare("INSERT INTO tbonline (idUser, tempoExpirar, sessao) VALUES (?, ?, ?)");
							$data = date("Y-m-d H:i:s", strtotime("+1 hour 30 minutes"));
							$idSessao = session_id();
							$query->bind_param('sss', $_SESSION['id'], $data, $idSessao);
							$query->execute();
						}
						$query->close();
					}else{
						header('Location: termos-de-uso');
					}
				}else{
					$client->revokeToken();
					$authUrl = $client->createAuthUrl();
					unset($_SESSION['access_token']);
					$_SESSION['errorLogin'] = 'E-mail não cadastrado!';
				}
			}
		}else{
			$client->revokeToken();
			$authUrl = $client->createAuthUrl();
			unset($_SESSION['access_token']);
			$_SESSION['errorLogin'] = 'Este e-mail não faz parte do dcomp!';
		}
	}else{
		$authUrl = $client->createAuthUrl();
	}
