
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include '../../includes/topo.php';
?>
<title>AdminCCET - Recuperação de Senha</title>
</head>
<?php
include '../../includes/barra.php';
include '../../includes/menu.php';
$_SESSION['irPara'] = '/inicio';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Recuperação de Senha</title>
</head>

<body>
<?php
// RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO
$email	= $_POST ["email"];	//atribuição do campo "email" vindo do formulário para variavel 
$cpf = $_POST["cpf"];

$emailaux = 'nadaaqui';
$cpfaux = 'nadaaqui';





$db = Atalhos::getBanco();
$query = "SELECT email, cpf FROM tbusuario WHERE (email = ? AND cpf = ?)";
if ($query = $db->prepare($query)){
    $query->bind_param('ss', $email, $cpf);
    $query->execute();
    $query->bind_result($emailaux, $cpfaux);
    $query->fetch();

    echo "<script>window.location='/inicio';alert('teste2" . $emailaux   . " email2 ".$email."');</script>";
      
    if($email==$emailaux){
        $db = Atalhos::getBanco();  
        if($query = $db->prepare("UPDATE `tbusuario` SET `senha` = 'senhaalterada123' WHERE (`tbusuario`.`email` = ?)")){ 
        $query->bind_param('s', $email);
        $query->execute();
        echo "<script>window.location='/inicio';alert('testeee!!! " . $emailaux   . " \\n email2 ".$email."');</script>";
        Atalhos::enviarEmail($email, 4);
        }
    }
    $query->close();
    $db->close();

    
    }
    
    if(($email!=$emailaux) || ($cpf!=$cpfaux)){
    echo "<script>window.location='recuperar_senha-add/';alert('O email e CPF informados não conferem. \\n favor reeinserir');</script>";
    }
 ?>


</body>
</html>