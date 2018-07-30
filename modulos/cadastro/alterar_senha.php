
<?php
include '../../includes/topo.php';
?>
<title xmlns="http://www.w3.org/1999/html">AdminCCET - Alterar Senha</title>
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
           Alterar de Senha
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
                            <form id="alterarSenha" name="alterarSenha" action="perfil/alterar_senha-add/" method="post"  data-toggle="validator" role="form" onsubmit="return validaDados();">
                                <table width="625" border="0">

                                    <label for="textNome" class="control-label"> Para alterar sua senha, digite: </br></br> </label>
                                    <label for="textNome" class="control-label"> Sua nova senha deve ter no mínimo 6 digitos </br></br> </label>
                                    
                                                                                   
                                            <div class="form-group">
                                            <label for="inputEmail" class="control-label">Senha antiga</label>
                                            <input id="senhaAtual" name="senhaAtual" class="form-control" maxlength="40" required="required" placeholder="Digite sua senha atual" type="password">
                                            </div>

                                            <div class="form-group">
                                            <label for="inputEmail" class="control-label">Nova senha</label>
                                            <input id="senhaNova" name="senhaNova" class="form-control" maxlength="40" required="required" placeholder="digite uma nova senha" type="password">
                                            </div>

                                            <div class="form-group">
                                            <label for="inputEmail" class="control-label">Conforme nova senha</label>
                                            <input id="senhaNova2" name="senhaNova2" class="form-control" maxlength="40" required="required" placeholder="Digite seu E-mail" type="password">
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
        if (document.alterarSenha.senhaNova.value.length < 6){
        alert('A senha deve ter 6 ou mais dígitos');
        return false;

        }else if (document.alterarSenha.senhaNova.value != document.alterarSenha.senhaNova2.value){
        alert('As senhas inseridas não conferem');
        return false;

        }else
        return true;
        }   
</script>

</body>
</html>