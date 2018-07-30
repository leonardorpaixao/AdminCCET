
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include '../../includes/topo.php';
?>
<title>AdminCCET - Alterar de Senha</title>
</head>
<?php
include '../../includes/barra.php';
include '../../includes/menu.php';
$_SESSION['irPara'] = '/inicio';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Alterar de Senha</title>
</head>

<body>
<?php
// RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO
$senha	= $_POST ["senhaAtual"];	//atribuição do campo "email" vindo do formulário para variavel 
$senhaNova = $_POST["senhaNova"];





$db = Atalhos::getBanco();
$query = "SELECT senha FROM tbusuario WHERE (senha = ?)";
if ($query = $db->prepare($query)){
    $query->bind_param('s', $senha);
    $query->execute();
    $query->bind_result($senhaaux);
    $query->fetch();

    //echo "<script>window.location='/inicio';alert('teste2" . $emailaux   . " email2 ".$email."');</script>";
      
    if($senha==$senhaaux){
        $db = Atalhos::getBanco();  
        if($query = $db->prepare("UPDATE `tbusuario` SET `senha` = '$senhaNova' WHERE (`tbusuario`.`idUser` = ?)")){ 
        $query->bind_param('i', $_SESSION['id']);
        $query->execute();
        echo "<script>window.location='/inicio';alert('Sua senha foi alterada com sucesso!');</script>";
        }

        $query->close();
        $db->close();
    }
}

if($senha != $senhaaux){
echo "<script>window.location='perfil/alterar_senha/';alert('Senha inválida');</script>";
}
 ?>


</body>
</html>