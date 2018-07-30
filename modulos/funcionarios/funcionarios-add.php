<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include '../../includes/topo.php';
?>
<title>AdminDcomp - Cadastrar Funcionário</title>
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

$siapMatricula = $_POST ["siapMatricula"];//atribuição do campo "siapMatricula" vindo do formulário para variavel
$nome	= $_POST ["nome"];	//atribuição do campo "nome" vindo do formulário para variavel
$email	= $_POST ["email"];	//atribuição do campo "email" vindo do formulário para variavel
$departamento	= $_POST ["departamento"];	//atribuição do campo "departamento" vindo do formulário para variavel
$nivel = $_POST ["categoria"];//atribuição do campo "categoria" vindo do formulário para variavel

switch($nivel){
    case '3':
        $idAfiliacao = '1';
        break;
    case '4':
        $idAfiliacao = '3';
        break;    
      }



//Gravando no banco de dados
$conexao = mysqli_connect("localhost","root");
if (!$conexao)
    die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysqli_error($conexao));
//conectando com a tabela do banco de dados
$banco = mysqli_select_db($conexao, "dcomp");
if (!$banco)
    die ("Erro de conexão com banco de dados, o seguinte erro ocorreu -> ".mysqli_error($conexao));


else

    $query = "INSERT INTO `tbusuario` (`idUser`, `siapMatricula`, `idAfiliacao`, `login`, `senha`, `email`, `departamento`, `nomeUser`, `cpf`, `dtnascimento`, `telefone`,
        `nivel`, `statusUser`, `termo`, `statusLogin`, `sudo`)
            VALUES (NULL, '$siapMatricula', '$idAfiliacao', '$email', 'ccet123456', '$email', '$departamento', '$nome', '', '', '', '$nivel', 'Ativo', '0', '1', 'Ativo')";
    mysqli_query($conexao, $query);

mysqli_close($conexao);




echo "<script>window.location='/recursos/cadastrar_funcionarios';alert('O cadastro do Senhor(a) ".$nome." foi efetuado com sucesso! Um e-mail com instruções foi ennviado ao seu respectivo endereço eletrônico.');</script>";


Atalhos::enviarEmail($email, 5);

 ?>


</body>
</html>