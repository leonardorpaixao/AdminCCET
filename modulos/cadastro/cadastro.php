
<?php
include '../../includes/topo.php';
?>
<title xmlns="http://www.w3.org/1999/html">AdminDcomp - Sobre o AdminDComp</title>
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
            Cadastro
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="box-body table-responsive no-padding" style="text-align: justify;">


                                <script type="text/javascript">
                                function validaCampo()
                                {
                                    if(document.cadastro.nome.value=="")
                                    {
                                        alert("O Campo nome é obrigatório!");
                                        return false;
                                    }
                                    else
                                    if(document.cadastro.email.value=="")
                                    {
                                        alert("O Campo email é obrigatório!");
                                        return false;
                                    }
                                    else
                                    if(document.cadastro.endereco.value=="")
                                    {
                                        alert("O Campo endereço é obrigatório!");
                                        return false;
                                    }
                                    else
                                    if(document.cadastro.cidade.value=="")
                                    {
                                        alert("O Campo Cidade é obrigatório!");
                                        return false;
                                    }
                                    else
                                    if(document.cadastro.estado.value=="")
                                    {
                                        alert("O Campo Estado é obrigatório!");
                                        return false;
                                    }
                                    else
                                    if(document.cadastro.bairro.value=="")
                                    {
                                        alert("O Campo Bairro é obrigatório!");
                                        return false;
                                    }
                                    else
                                    if(document.cadastro.pais.value=="")
                                    {
                                        alert("O Campo país é obrigatório!");
                                        return false;
                                    }
                                    else
                                    if(document.cadastro.login.value=="")
                                    {
                                        alert("O Campo Login é obrigatório!");
                                        return false;
                                    }
                                    else
                                    if(document.cadastro.senha.value=="")
                                    {
                                        alert("Digite uma senha!");
                                        return false;
                                    }
                                    else
                                        return true;
                                }
                                <!-- Fim do JavaScript que validará os campos obrigatórios! -->
                            </script>
                            </head>

                            <body>
                            <form id="cadastro" name="cadastro" method="post" action="cadastro.php" onsubmit="return validaCampo(); return false;">
                                <table width="625" border="0">

                                    <form id="form1" data-toggle="validator" role="form">
                                        <div class="form-group">
                                            <label for="textNome" class="control-label">Nome</label>
                                            <input id="nome" class="form-control" maxlength="40" placeholder="Digite seu Nome..." type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail" class="control-label">Email</label>
                                            <input id="email" class="form-control" maxlength="40" placeholder="Digite seu E-mail" type="email">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail" class="control-label">Confirmar e-mail</label>
                                            <input id="corfirmaremail" class="form-control" maxlength="40" placeholder="Repita seu E-mail" type="email">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputtelefone" class="control-label">Telefone</label>
                                            <input class="form-control" type="tel" required="required" maxlength="11" name="phone" pattern="[0-9]{11}$" placeholder="(DDD) + Número para contato" />
                                        </div>

                                        <div class="form-group">
                                            <label for="inputDepartamento" class="control-label">Departamento / Centro</label>
                                            <input id="departamento" class="form-control" maxlength="20" placeholder="Informe seu departamento" type="text">
                                        </div>

                                       <div class="form-group">
                                            <label for="inputPassword" class="control-label">Senha</label>
                                            <input type="password" class="form-control" maxlength="15" id="inputPassword" placeholder="Digite sua Senha...">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputConfirm" class="control-label">Confirmar a Senha</label>
                                            <input type="password" class="form-control" maxlength="15" id="inputConfirm" placeholder="Confirme sua Senha...">
                                        </div>

                                        <fieldset><label> Categoria</label>
                                            <div >
                                                <form>
                                                    <label class="radio-inline">
                                                            <input type="radio" name="categoria">Professor
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="categoria">Técnico
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="categoria">Aluno
                                                    </label>
                                                </form>
                                            </div>

                                        <br /><br />
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
</body>
</html>