
<?php
include '../../includes/topo.php';
?>
<title xmlns="http://www.w3.org/1999/html">AdminDcomp - Sobre o AdminCCET</title>
</head>
<?php
include '../../includes/barra.php';
include '../../includes/menu.php';
$db = Atalhos::getBanco();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Recuperação de Senha
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="box-body table-responsive no-padding" style="text-align: justify;">


                                
                            </head>

                            <body>
                            <form id="recuperarSenha" name="recuperarSenha" method="post" action="recuperar_senha-add/" data-toggle="validator" role="form" onsubmit="return validaDados();">
                                <table width="625" border="0">

                                    <label for="textNome" class="control-label"> Para recuperar a senha insira seu e-mail de acesso. Enviaremos 
                                    uma nova senha para o e-mail cadastrado. </br></br> </label>
                                                                                   
                                            <div class="form-group">
                                            <label for="inputEmail" class="control-label">Email</label>
                                            <input id="email" name="email" class="form-control" maxlength="40" required="required" placeholder="Digite seu E-mail" type="email">
                                            </div>

                                     

                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </form>



                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>
        </div>
    </section>

</div><!-- /.content-wrapper -->
<?php include '../../includes/rodape.php' ?>
</div><!-- ./wrapper -->
<?php include '../../includes/script.php' ?>

<script type="text/javascript">
    function validaDados(){
        
        alert('teste');
      
        ?>
    }   
</script>

</body>
</html>