<?php
    session_start();
    include_once 'atalhos.php';
    $db = Atalhos::getBanco();
    if ($query = $db->prepare("SELECT termo FROM tbTermo ORDER BY idTermo LIMIT 1")){ 
        $query->execute();
        $query->bind_result($termo);    
        $query->fetch();
        $query->close();
        $db->close();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
        echo '<base href="https://'.$_SERVER['SERVER_NAME'].'/"/>';
        ?>
        <link rel="icon" type="image/png" href="forms/dcomp.jpg"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Select2 -->
        <link href="plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
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
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <![endif]-->
        <title>AdminDcomp - Termos de Uso</title>
    </head>
    <style type="text/css">
        .product .img-responsive {
        margin: 0 auto;
        }
    </style>
    <body class="skin-blue layout-top-nav">
        <div class="wrapper">
            <header class="main-header">
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <div class="navbar-header">
                        <a href="/inicio" class="navbar-brand"><b>Admin</b>DCOMP</a>
                    </div>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php
                                        echo "<img height='25' width='25' class='img-circle' src='getImagem.php?idUser=".$_SESSION['id']."' >"; 
                                    ?>
                                    <span class="hidden-xs"><?php echo Atalhos::nome($_SESSION['nome']) ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-body">
                                        <?php
                                            echo "<img height='160' width='160' src='getImagem.php?idUser=".$_SESSION['id']."' class='img-circle img-responsive center-block'>"; 
                                        ?>
                                        <div style="text-align: center;">
                                            <strong>
                                                <?php echo '<span style="font-size: 12pt;">'.Atalhos::nome($_SESSION['nome']).'</span>'?>
                                            </strong>
                                        </div>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="/configuracao" class="btn btn-default disabled">Configurações</a>
                                        </div>
                                        <div class="pull-right">
                                            <form action = "post2.php" method = "post">
                                                <input type="hidden" name="numPost" value="2"><!-- Número correspodente ao post -->
                                                <button type="submit" class="btn btn-default">Sair</button>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <div class="content-wrapper">
                <div class="container">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1>Bem-vindo ao AdminDCOMP</h1>
                    </section>
                    <section class="content">
                        <div class="box box-solid">
                            <div class="box-header">
                                <h4>Antes de continuar com o seu acesso você precisar ler e concordar com os termos de uso abaixo.</h4>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <div style="width:100%; height:250px; overflow: auto;">
                                        <?php echo $termo;?>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <form action="post2.php" method="POST" id="formulario">
                                    <input type="hidden" id="numPost" name="numPost" value="3"/><!-- Número correspodente ao post -->
                                    <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.form.submit();">Eu Aceito</button>
                                    <a href="/inicio"<span class="btn btn-default">Sair</span></a>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div><!-- /.content-wrapper -->
        <?php include 'rodape.php' ?>
        <?php include 'script.php' ?>
    </body>
</html>
