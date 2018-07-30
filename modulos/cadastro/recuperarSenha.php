
<?php
include '../../includes/topo.php';
?>
<title xmlns="http://www.w3.org/1999/html">AdminCCET - Recuperação de Senha</title>
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
                            <form id="recuperarSenha" name="recuperarSenha" method="post" action="recuperar_senha-add/" data-toggle="validator" role="form" onsubmit="return validaCampos();">
                                <table width="625" border="0">

                                    <label for="textNome" class="control-label"> Para recuperar a senha insira seu e-mail de acesso e sua data de nascimento. </br></br> </label>
                                                                                   
                                            <div class="form-group">
                                            <label for="inputEmail" class="control-label">Email</label>
                                            <input id="email" name="email" class="form-control" maxlength="40" required="required" placeholder="Digite seu E-mail" type="email">
                                            </div>

                                            <div class="form-group">
                                            <label for="inputCPF" class="control-label">CPF:</label>
                                            <input id="cpf" name="cpf" class="form-control" maxlength="11" required="required" placeholder="Digite seu CPF" type="text">
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

    function validaCPF(cpf){
        var numeros, digitos, soma, i, resultado, digitos_iguais;
        digitos_iguais = 1;
        if (cpf.length < 11)
            return false;
        for (i = 0; i < cpf.length - 1; i++)
            if (cpf.charAt(i) != cpf.charAt(i + 1))
                    {
                    digitos_iguais = 0;
                    break;
                    }
        if (!digitos_iguais)
            {
            numeros = cpf.substring(0,9);
            digitos = cpf.substring(9);
            soma = 0;
            for (i = 10; i > 1; i--)
                    soma += numeros.charAt(10 - i) * i;
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0))
                    return false;
            numeros = cpf.substring(0,10);
            soma = 0;
            for (i = 11; i > 1; i--)
                    soma += numeros.charAt(11 - i) * i;
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1))
                    return false;
            return true;
            }
        else
            return false;
    }


    function validaCampos(){
        if(!validaCPF(document.recuperarSenha.cpf.value)){
            alert("O CPF informado não é valido. Favor incluir um CPF válido");
            return false;
    }else return true;
    }

</script>

</body>
</html>