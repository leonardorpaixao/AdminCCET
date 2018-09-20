<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include '../../includes/topo.php';
?>
<title>AdminDcomp - Requisição de cadastro</title>
</head>
<?php
include '../../includes/barra.php';
include '../../includes/menu.php';
$_SESSION['irPara'] = '/inicio';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Untitled Document</title>
</head>

<body>
<?php
// RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO

$senha = $_POST ["senha"];//atribuição do campo "siapMatricula" vindo do formulário para variavel
$cpf	= $_POST ["cpf"];	//atribuição do campo "nome" vindo do formulário para variavel
$dtnascimento	= $_POST ["dtnascimento"];	//atribuição do campo "email" vindo do formulário para variavel
$telefone = $_POST['telefone'];




$db = Atalhos::getBanco();
if($query = $db->prepare("UPDATE tbUsuario SET termo = 1, telefone = $telefone, senha = '$senha', statusUser = 'Ativo', cpf = '$cpf',
 dtnascimento = '$dtnascimento', sudo = 'Ativo' WHERE idUser = ?")){ 
$query->bind_param('i', $_SESSION['id']);
$query->execute();
}


echo "<script>window.location='/inicio';alert('Obrigado! Agora você já pode utilizar todos os recursos disponíveis!');</script>";



 ?>


</body>
</html>