<?php
  include '../../includes/topo.php';
  ?>
<title>AdminCCET - Adicionar Funcionário</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] > 1){
    header('Location: /inicio');
  }
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $db = Atalhos::getBanco();
  $_SESSION['irPara'] = '/inicio';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cadastrar Funcionário
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="box-body table-responsive no-padding" style="text-align: justify;">
                                           
                            <body>

                            <form id="cadastro" name="cadastro" method="post"  action="recursos/funcionarios/adicionar" data-toggle="validator" role="form" onsubmit="return validaCampo();">

                                <div class="form-group">
                                    <label for="inputSiapMatricula" class="control-label">SIAP|Matricula</label>
                                    <input id="siapMatricula" name="siapMatricula" class="form-control" maxlength="12" placeholder="Digite o SIAP ou Matricula" type="number">
                                </div>

                                <div class="form-group">
                                    <label for="textNome" class="control-label">Nome</label>
                                    <input id="nome" name="nome" class="form-control" maxlength="40" placeholder="Nome" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail" class="control-label">Email</label>
                                    <input id="email" name="email" class="form-control" maxlength="40" placeholder="E-mail" type="email">
                                </div>

                                <div class="form-group">
                                    <label for="inputConfirmarEmail" class="control-label">Confirmar e-mail</label>
                                    <input name="confirmaremail" id="corfirmaremail" class="form-control" maxlength="40" placeholder="Confirmação de e-mail" type="email">
                                </div>


                                <div class="form-group">
                                    <label for="inputDepartamento" class="control-label">Departamento / Centro</label>
                                    <input id="departamento" name="departamento" class="form-control" maxlength="20" placeholder="Departamento" type="text">
                                </div>



                                <fieldset><label> Categoria</label>
                                    <div>
                                    <label class=".checkbox-inline">
                                            <input type="radio" value="3" id="professor" name="categoria">Professor
                                        </label>
                                        <label class=".checkbox-inline">
                                            <input type="radio" value="3" id="tecnico" name="categoria">Técnico
                                        </label>
                                        <label class=".checkbox-inline">
                                            <input type="radio" value="4" id="aluno" name="categoria">Empresas Juniores ou Centros Acadêmicos 
                                        </label>

                                    </div>
                                </fieldset>

                                    <br /><br />
                                    <button id="cadastrar" name="cadastrar" type="submit" class="btn btn-primary">Enviar</button>
                                    <a href="/inicio"<span class="btn btn-primary">Cancelar</span></a>
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

function validaCampo()
{
    if (document.cadastro.siapMatricula.value==""){
        alert("O campo SIAP|Matricula é obrigatório");
        return false;
    }
    else
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
</script>





</body>
</html>