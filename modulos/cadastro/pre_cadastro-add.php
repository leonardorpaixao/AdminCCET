<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
$idAfiliacao = $_POST ["categoria"];//atribuição do campo "categoria" vindo do formulário para variavel
//Gravando no banco de dados


$conexao = mysqli_connect("localhost","root");
if (!$conexao)
    die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysqli_error($conexao));
//conectando com a tabela do banco de dados
$banco = mysqli_select_db($conexao, "dcomp");
if (!$banco)
    die ("Erro de conexão com banco de dados, o seguinte erro ocorreu -> ".mysqli_error($conexao));


else
    $query = "INSERT INTO `tbprimeiroacessoccet` (`nome`, `email`, `idAfiliacao`, `siapMatricula`, `departamento`) 
VALUES ('$nome', '$email', '$idAfiliacao', '$siapMatricula', '$departamento')";
mysqli_query($conexao, $query);

mysqli_close($conexao);
echo "Seu precadastro foi enviado a secretaria. em breve você receberá e-mail com novas orientações.<br>Agradecemos a atenção.";
?>
</body>
</html>