<?php
	include '../../includes/sessao.php';
	$db = Atalhos::getBanco();
	$id = (isset($_GET['id']))? $_GET['id'] : NULL;
	if ($query = $db->prepare("SELECT idUser FROM tbRequerimentos WHERE idReq = ?")){
                $query->bind_param('i', $id);
                $query->execute(); 
                $query->bind_result($idUser);
                $query->fetch();
                $query->close();
    }
	if((!is_null($id)) && $_SESSION['logado'] && ($_SESSION['nivel'] == '1' || $_SESSION['nivel'] == '0' || $_SESSION['nivel'] == '3' || $_SESSION['id'] == $idUser)){
		$file = '../../pdfs/'.$id.'.pdf';
		if (file_exists($file)) {
		    header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename='.basename($file));
		    header('Content-Transfer-Encoding: binary');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($file));
		    ob_clean();
		    flush();
		    readfile($file);
		    exit();
		} else
			header('Location: /inicio');
	} else
		header('Location: /inicio');

?>