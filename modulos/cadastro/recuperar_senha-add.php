
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



echo "<script>window.location='/inicio';alert('teste1.$email.');</script>";

$db = Atalhos::getBanco();
if ($query = $db->prepare("SELECT email FROM tbusuario WHERE (email = ?)")){
    $query->bind_param('i', $email);
    $query->execute();
    $query->bind_result($emailaux);
    $rs = $query->fetch();
    echo "<script>window.location='/inicio';alert('teste1.$emailaux.');</script>";


    if($email==$emailaux){
        if($query = $db->prepare("UPDATE tbUsuario SET senha = 'ccet123456', WHERE email = ?")){ 
        $query->bind_param('i', $email);
        $query->execute();
        $query->close();
        echo "<script>window.location='/inicio';alert('teste1');</script>";
        }
    }
    $query->close();
    $db->close();
    echo "<script>window.location='/inicio';alert('teste2');</script>";
    
    }else{

    echo "<script>window.location='/inicio';alert('Seu requerimento foi enviado a secretaria. Em breve você receberá e-mail com novas orientações. \\nPor favor, aguarde!');</script>";
    }
 ?>


</body>
</html>