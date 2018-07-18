
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
                            <form id="cadastro" name="cadastro" method="post" data-toggle="validator" role="form" onsubmit="validaCampo();">
                                <table width="625" border="0">

                                    <label for="textNome" class="control-label"> Olá, <?php echo($_SESSION['nome']); ?>!</br> Para concluir o cadastro, 
                                            favor preencher os campos abaixo. </br></br> </label>
                                                                                   
                                     

                                        <div class="form-group">
                                            <label for="inputEmail" class="control-label">CPF:</label>
                                            <input id="cpf" name="cpf" class="form-control" maxlength="14"  placeholder="Digite seu CPF" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputpalavra" class="control-label">Palavra:</label>
                                            <input id="palavra" name="palavra" class="form-control" maxlength="14" placeholder="digite uma palabvra" type="text">
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

  function validaCPF(cpf)
  {
      alert("teste");
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

    function validaCampo(){
        
        if(chamada(document.cadastro.palavra.value)){
         alert("True");
         
        }else{ 
            alert("False");
           
        }
        
        if(validaCPF(document.cadastro.cpf.value)){
            alert("O CPF informado não é valido. Favor incluir um CPF válido");
            return false;
        }

        return true;
    }
    

function chamada(palavra){
if (palavra=="true"){
return true;
}else return false;
}
function teste(){

if(!chamada(document.cadastro.palavra.value)){
    alert("True");
}else alert("False")
}

</script>

</body>
</html>