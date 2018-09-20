<?php
	include_once '../../includes/sessao.php';
	$db = Atalhos::getBanco();
	/*if($query = $db->prepare("UPDATE tbUsuario SET  email = 'test@mail.com', cpf = '327.475.384-43'")){
		$query->execute();
	}*/
	if($query = $db->prepare("SELECT idUser, email, cpf, nomeUser FROM tbUsuario ORDER BY idUser")){
		$query->execute();
		$query->bind_result($id, $email, $cpf, $nome);
		while($query->fetch()){
			$auxDb = Atalhos::getBanco();
			if($aux = $auxDb->prepare("UPDATE tbUsuario SET  email = AES_ENCRYPT(?, ?), cpf = AES_ENCRYPT(?, ?) WHERE idUser = ?")){
				$aux->bind_param('ssssi', $email, $_SESSION['chave'], $cpf, $_SESSION['chave'], $id);
				$aux->execute();
				//echo "Error: ".$aux->error."</br>";
				$aux->close();
			}
			//echo "Error: ".$auxDb->error."</br>";
			$auxDb->close();
			//echo $nome.": ".$email." <==> ".Atalhos::decode($email)."</br>".$cpf." <==> ".Atalhos::decode($cpf)."</br></br>";
		}
	}
?>