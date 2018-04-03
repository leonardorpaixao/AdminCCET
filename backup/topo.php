<?php
    include_once 'sessao.php';
    //constante que define a quantidade de itens por página
    define('NumReg',20);
    define('Senha','A senha necessita ter pelo menos 8 digitos, e ser formada por dois tipos de caracteres diferentes, sendo eles:
        letras maúsculas, letras minusculas, números e caracteres especiais.');
    define('textoReserva','Escolha Única para somente uma reserva e Recorrente para diversas reservas.');
    define('Dominio','@dcomp.ufs.br');
    define('mesagemAuto','Caro usuário,<br><br>O seu e-mail institucional já foi criado, a senha temporária está no final do ticket e abaixo seguem as instruções para fazer o primeiro acesso:<br><br>1º: Acesse gmail.com<br>2º: Digite o seu e-mail<br>3º: Digite sua senha temporária<br>4º: Faça o login.<br><br>Obs: A senha é gerada randomicamente e deverá ser alterada, obrigatoriamente, em seu primeiro acesso.<br><br>Além do e-mail estão disponíveis outros recursos como: Google Drive (ilimitado), Google Agenda, Documentos Google (ferramentas para criação e edição de textos, planilhas, formulários, apresentações e sites) e Sala de Aula Google.<br><br>Utilize sempre respeitando os termos de uso do DCOMP e do Google.<br><br>Bom proveito!');
?>
<!DOCTYPE html>
<html>
  <head>
  <?php

        echo '<base href="https://'.$_SERVER['SERVER_NAME'].'/"/>';
    ?>
    <link rel="icon" type="image/png" href="forms/dcomp.png"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar 2.2.5-->
    <link href="plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />
    <!-- daterange picker -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
     <link href="css/t.css" rel="stylesheet" type="text/css" />
    <link href="css/linux.css" rel="stylesheet" type="text/css" />
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="plugins/datatables/buttons.dataTables.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->
