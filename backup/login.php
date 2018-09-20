<?php
	include 'atalhos.php';
	$login = $_GET['login'];
	$db = Atalhos::getBanco();
	if($query = $db->prepare("SELECT login FROM tbusuario WHERE login = ?")){
		$query->bind_param('s', $login);
		$query->execute();
		$query->store_result();
		$total = $query->num_rows();
		$query->close();
	}
	if ($total > 0){
		echo '<b><font color="red"> <i class="fa fa-fw fa-ban"></i>Indisponivel, alguém já possui esse login! </font></b>';
	}else{
		echo '<b><font color="green"> <i class="fa fa-fw fa-check-square-o"></i>Disponivel </font></b>';
	}
?>