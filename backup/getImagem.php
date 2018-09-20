<?php
	//header( "Content-type: image/jpeg");
        include 'sessao.php';
	$db = Atalhos::getBanco();
	if($query = $db->prepare("SELECT imagem FROM tbImagem WHERE idUser = ?")){
		$query->bind_param('i', $_GET["idUser"]);
        $query->execute();
        $query->bind_result($imagem);
        if($query->fetch()){
        	echo $imagem;
        }else{
        	echo file_get_contents("img/sem-imagem-avatar.jpg");
        }
        $query->close();
        $db->close();
	}