<?php
// Script para deletar LOGs de acesso que tenham mais de 6 meses.
include '../../includes/sessao.php';
$db = Atalhos::getBanco();
if ($query = $db->prepare("SELECT idLogs, data FROM tblogsacesso")){
	$query->execute();
	$query->bind_result($idLogs, $data);
	while ($query->fetch()) {
		$ids[] = array($idLogs,$data);
	}
    $query->close();
}

$timestamp = strtotime("-6 months"); // Hoje - 6 meses

foreach ($ids as $value){
	if($value[1] < $timestamp) { // Se a data for menor significa que tem mais de 6 meses
		if($query = $db->prepare("DELETE FROM tblogsacesso WHERE idLogs = ?")){
        	$query->bind_param('i',$value[0]);
        	$query->execute();
        	$query->close();
        }
    }
}

?>