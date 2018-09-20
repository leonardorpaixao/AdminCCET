<?php
	include 'atalhos.php';
	$db = Atalhos::getBanco();
	if($query = $db->prepare("UPDATE tbnotificacao SET statusNoti = 1, expiraData = ? WHERE idNoti = ?")){
		$query->bind_param('si', date("Y-m-d", strtotime("+5 days")), $_GET['id']);
		$query->execute();
		$query->close();
	}
	$db->close();
	header("Location: ".$_GET['ir']);