<?php
// Script para deletar arquivos que foram anexados via requerimentos e o requerimento não existe mais.
include '../../includes/sessao.php';
$db = Atalhos::getBanco();
if ($query = $db->prepare("SELECT idReq FROM tbrequerimentos")){
	$query->execute();
	$query->bind_result($data);
	while ($query->fetch()) {
		$ed[] = $data; // Array com todos os requerimentos existentes.
	}
    $query->close();
}
$dir    = $_SERVER['DOCUMENT_ROOT'].'pdfs/'; 
$files1 = scandir($dir); // Array com todos os arquivos no diretório $dir.
unset($files1 [0]); // Referente ao .
unset($files1 [1]); // Referente ao ..
unset($files1 [2]); // Referente ao .htaccess

foreach ($files1 as $value){
	if (!in_array($value,$ed)) { // Arquivo existe mas não tem o requerimento não.
		$arquivo = $_SERVER['DOCUMENT_ROOT']."pdfs/".$value;
		unlink($arquivo);
	}
}

?>