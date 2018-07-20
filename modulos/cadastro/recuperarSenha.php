
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
                            <form id="recuperarSenha" name="recuperarSenha" data-toggle="validator" role="form" onsubmit="return teste();">
                                <table width="625" border="0">

                                    <label for="textNome" class="control-label"> Para recuperar a senha insira seu e-mail de acesso e a sua data de nascimento. Enviaremos 
                                    uma nova senha para o e-mail cadastrado. </br></br> </label>
                                                                                   
                                            <div class="form-group">
                                            <label for="inputEmail" class="control-label">Email</label>
                                            <input id="email" name="email" class="form-control" maxlength="40" placeholder="Digite seu E-mail" type="email">
                                            </div>

                                            <div class="form-group">
                                            <label for="inputDataNascimento" class="control-label">Data de nascimento:</label>
                                            <input id="dtnascimento" name="dtnascimento" class="form-control" required="required" maxlength="40" type="date">
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
        var email, dtnascimento;
        var emailaux, dtnascimentoaux;
        email = document.recuperarSenha.email.value;
        dtnascimento = document.recuperarSenha.dtnascimento.value;
       alert("teste");
       <?php
        if ($query = $db->prepare("SELECT email, dtnascimento FROM tbusuario WHERE (idSala = ? AND dtnascimento = ?)")){
            $query->bind_param('i', email, dtnascimento);
            $query->execute();
            $query->bind_result($nomeSala, $numPessoa);
            $query->fetch();
            $query->close();
            $db->close();
        }

       $db = Atalhos::getBanco();
       if($query = $db->prepare("SELECT email, dtnascimento from tbUsuario SET senha = 'ccet123456', WHERE email = ?")){ 
       $query->bind_param('i', email);
       $query->execute();
       }
       ?>
       
       <?php
       $db = Atalhos::getBanco();
       if($query = $db->prepare("UPDATE tbUsuario SET senha = 'ccet123456', WHERE email = ?")){ 
       $query->bind_param('i', email);
       $query->execute();
       }
       ?>
    }

    function validaCampo(){
        

        if(document.cadastro.senha.value != document.cadastro.novaSenha.value){
            alert("As senhas digitadas não coincidem");
            return false;
        }else if(!validaCPF(document.cadastro.cpf.value)){
            alert("O CPF informado não é valido. Favor incluir um CPF válido");
            return false;
    }else return true;  
    }


</script>

</body>
</html>