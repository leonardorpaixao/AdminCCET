  <?php 
    include '../../includes/topo.php';
  ?>
  <title>AdminDcomp - Adicionar Ticket</title>
  </head>
  <?php
    if(!$_SESSION['logado']){
      header('Location: /inicio');
    }
    include '../../includes/barra.php';
    include '../../includes/menu.php';
    $_SESSION['irPara'] = '/tickets/adicionar';
    $acao = (isset($_GET['acao']))? $_GET['acao'] : 'inserir';          
    $id = (isset($_GET['id']))? $_GET['id'] : NULL;
    $db = Atalhos::getBanco();
    if ($query = $db->prepare("SELECT b.nomeUser, AES_DECRYPT(b.email, ?), c.afiliacao FROM tbusuario b
      inner join tbafiliacao c on b.idAfiliacao = c.idAfiliacao WHERE b.idUser = ?")){
      $query->bind_param('si', $_SESSION['chave'], $_SESSION['id']);                
      $query->execute();
      $query->bind_result($nomeUser, $email, $afiliacao);
      $query->fetch();
      $query->close();
    }
  ?>
    <title>AdminDcomp - Adicionar Ticket</title> 
      </head>     
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Adicionar Ticket<small> Tickets </small>      
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
        	<div class="callout callout-warning">
              <h4>AVISO: SOLICITAÇÃO DE E-MAIL INSTITUCIONAL</h4>
              <p>Para solicitar o seu e-mail institucional acesse o seu perfil e clique na opção <b>Requisitar E-mail Dcomp</b>.</p>
              <p>NÃO envie um ticket por aqui. O assunto "E-mail Dcomp" deve ser utilizado apenas para problemas com o e-mail e NÃO para solicitar um.</p>
          </div>
          <!-- Default box -->
          <div class="box" id="forminsere">
            <div class="box-header with-border">
                  <h3 class="box-title">Dados básicos</h3>
            </div>
                <form role="form" action="post/" method="post" class="formulario">
                  <input type="hidden" id="numPost" name="numPost" value="43"><!-- Número correspodente ao post -->
                  <div class="box-body">
                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" class="form-control" name="nome" value="<?php echo $nomeUser; ?>" disabled>
                    </div>
                  </div><!-- /.box-body -->
            <div class="box-header with-border">
                <h3 class="box-title">Dados complementares</h3>
            </div>
              <div class="box-body">

	          <div class="form-group">
	            <label for="email">Assunto:</label>
	            <select name="idAssunto" id="idAssunto" class="form-control">
	              <?php
	                echo '<option value="">Selecione o Assunto</option>';
	                echo '<option value="0">Laboratórios</option>';
	                echo '<option value="1">Equipamentos</option>';
	                echo '<option value="2">Reclamações</option>';
   	              echo '<option value="3">Sugestões</option>';
                  echo '<option value="5">E-mail Dcomp</option>';
	                echo '<option value="4">Outros</option>';

	              ?>
	            </select>
	          </div>
                <div class="form-group">
                  <label>Título:</label>
                  <input name="titulo" id="titulo" class="form-control"></input>
                </div>
                <div class="form-group">
                  <label>Resumo:</label>
                  <textarea name="resumo" id="resumo" class="form-control"></textarea>
                </div>
              </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="botaoEnviar">Enviar</button>
                    <a href="/tickets/meus"<span class="btn btn-default">Cancelar</span></a>
                  </div>
                  </form>
          </div><!-- /.box -->

        </section><!-- /.content -->
    
      </div><!-- /.content-wrapper -->
    <?php include '../../includes/rodape.php' ?>

    </div><!-- ./wrapper -->
    <?php include '../../includes/script.php' ?>
    <script>
    $('#forminsere').find('.formulario').submit(function() {
        $("#botaoEnviar").attr("disabled","disabled");
        var assunto = $.trim($(this).find('#idAssunto').val());
        var titulo = $.trim($(this).find('#titulo').val());
        var resumo = $.trim($(this).find('#resumo').val());
        if(!(titulo.length != 0 && resumo.length != 0 && assunto.length != "")) {
            $("#botaoEnviar").attr("disabled",false);
            alert("Por favor, preencha todos os campos!");
            return false;
        }
    });

    </script>
  </body>
</html>
