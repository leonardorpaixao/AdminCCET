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
            Solicitação Cadastro
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
                                    if(document.cadastro.confirmaremail.value=="")
                                    {
                                        alert("O Campo Confirmar email é obrigatório!");
                                        return false;
                                    }
                                    else
                                    if(document.cadastro.confirmaremail.value!=document.cadastro.email.value)
                                    {
                                        alert("Os e-mails inseridos não conferem");
                                        return false;
                                    }
                                    if(document.cadastro.departamento.value=="")
                                    {
                                        alert("O campo departamento é obrigatório");
                                        return false;
                                    }
                                    if(document.cadastro.categoria.value=="")
                                    {
                                        alert("Selecione categoria!");
                                        return false;
                                    }
                                    else
                                        return true;
                                }
                                <!-- Fim do JavaScript que validará os campos obrigatórios! -->
                            </script>
                            </head>

                            <body>

                                    <form id="cadastro" name="cadastro" method="post" action="cadastro.php" data-toggle="validator" role="form" onsubmit="return validaCampo();">
                                        <div class="form-group">
                                            <label for="textNome" class="control-label">Nome</label>
                                            <input id="nome" class="form-control" maxlength="40" placeholder="Digite seu Nome..." type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail" class="control-label">Email</label>
                                            <input id="email" class="form-control" maxlength="40" placeholder="Digite seu E-mail" type="email">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputConfirmarEmail" class="control-label">Confirmar e-mail</label>
                                            <input name="confirmaremail" id="corfirmaremail" class="form-control" maxlength="40" placeholder="Repita seu E-mail" type="email">
                                        </div>


                                        <div class="form-group">
                                            <label for="inputDepartamento" class="control-label">Departamento / Centro</label>
                                            <input id="departamento" name="departamento" class="form-control" maxlength="20" placeholder="Informe seu departamento" type="text">
                                        </div>



                                        <fieldset><label> Categoria</label>
                                            <div >
                                                    <label class="radio-inline">
                                                        <input type="radio" id="categoria" name="categoria">Professor
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" id="categoria" name="categoria">Técnico
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" id="categoria" name="categoria">Aluno
                                                    </label>

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