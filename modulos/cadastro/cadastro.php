
<?php
include '../../includes/topo.php';
?>
<title xmlns="http://www.w3.org/1999/html">AdminDcomp - Sobre o AdminCCET</title>
</head>
<?php
include '../../includes/barra.php';
include '../../includes/menu.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Confirmação de dados
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
                            <form id="cadastro" name="cadastro" method="post"  action="cadastro-add/" data-toggle="validator" role="form" onsubmit="return validaCampo();">
                                <table width="625" border="0">

                                    <label for="textNome" class="control-label"> Olá, <?php echo($_SESSION['nome']); ?>!</br> Para concluir o cadastro, 
                                            favor preencher os campos abaixo. </br></br> </label>
                                                                                   
                                        <div class="form-group">
                                            <label for="inputPassword" class="control-label">Nova senha</label>
                                            <input id="senha" name="senha" type="password" class="form-control" maxlength="15" required="required" placeholder="Digite uma Senha...">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputConfirm" class="control-label">Confirmar a Senha</label>
                                            <input id="novaSenha" name"novaSenha" type="password" class="form-control" maxlength="15" required="required"  placeholder="Confirme sua Senha...">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail" class="control-label">CPF:</label>
                                            <input id="cpf" name="cpf" class="form-control" maxlength="14" required="required" placeholder="Digite seu CPF" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail" class="control-label">Data de nascimento:</label>
                                            <input id="dtnascimento" name="dtnascimento" class="form-control" required="required" maxlength="40" type="date">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputtelefone" class="control-label">Telefone</label>
                                            <input id="telefone" name="telefone" class="form-control" type="tel" required="required" maxlength="11" name="phone" pattern="[0-9]{11}$" placeholder="(DDD) + Número para contato" />
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
    function validaCampo(){
        if(document.cadastro.senha.value != document.cadastro.novaSenha.value){
            alert("As senhas digitadas não coincidem");
            return false;
        }
        
        }else return true;
    }

</script>

</body>
</html>