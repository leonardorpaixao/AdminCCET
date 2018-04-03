<?php
  include '../../includes/topo.php';
?>
<title>AdminDcomp - Reporte um bug</title> 
</head>     
<?php
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $_SESSION['irPara'] = '/reportarbugs';
  $link = '/reportarbugs';
  $acao = (isset($_GET['acao']))? $_GET['acao'] : 'inserir';     
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Reporte um bug
            <small>Suporte dos alunos PRODAP</small>  
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
        <?php
          if(isset($_SESSION['avisoBugs'])):
        ?>
            <div class="callout callout-success">
              <h4>Bug reportado com sucesso!</h4>
              <p>Agradecemos a sua ajuda e esperamos resolver o problema o mais rápido possível.</p>
              <o>Obs: Entraremos em contato pelo e-mail somente para recolher mais informações sobre o bug, <b>se for necessário</b>!</p>
            </div>
        <?php
          unset($_SESSION['avisoBugs']);
          endif;
        ?>
        <!-- Default box -->
          <div class="callout callout-info">
              <h4>Por que reportar um bug?</h4>
              <p>O AdminDComp é um portal desenvolvido do zero por alunos dos cursos de SI, CC e EC. Essa é a primeira experiência com programação web da maioria e por isso podemos ter deixado passar pequenos erros. Reportando um bug você estará contribuindo para a evolução do AdminDComp em termos de usabilidade e segurança, e nós ficamos bastante agradecidos por isso!</p>
          </div>
          <div class="callout callout-warning">
              <h4>Leia antes de enviar</h4>
              <p>Esse meio deve ser usado <b>SOMENTE</b> para reportar problemas com o AdminDComp! Para assuntos acadêmicos deve ser utilizado o Fale Conosco ou o sistema de Tickets.</p>
          </div>
          <div class="box" id="forminsere2">
            <div class="box-header with-border">
                  <h3 class="box-title">Informações</h3>
            </div>
                <form role="form" action="post2/" method="post" class="formulario" autocomplete="off" enctype="multipart/form-data">
                  <input type="hidden" id="numPost" name="numPost" value="5"><!-- Número correspodente ao post -->
                  <div class="box-body">
                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" class="form-control" name="nome" id="nome">
                    </div>
                    <div class="form-group">
                      <label>E-mail</label>
                      <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                      <label>Em que página o erro foi encontrado?</label>
                      <input type="text" class="form-control" name="pagina" id="pagina">
                    </div>
                    <div class="form-group">
                      <label>Descreva brevemente como aconteceu o bug</label>
                      <textarea name="bug" id="bug" class="form-control"></textarea>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="botaoEnviar">Reportar bug</button>
                  </div>
                  </form>
          </div><!-- /.box -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <?php include '../../includes/rodape.php' ?>
    <?php include '../../includes/script.php' ?>
    <script>
    $('#forminsere2').find('.formulario').submit(function() {
        $("#botaoEnviar").attr("disabled","disabled");
        var nome = $.trim($(this).find('#nome').val());
        var email = $.trim($(this).find('#email').val());
        var pagina = $.trim($(this).find('#pagina').val());
        var bug = $.trim($(this).find('#bug').val());
        if(!(nome.length != 0 && pagina.length != 0 && bug.length != 0 && email.length != 0)) {
            $("#botaoEnviar").attr("disabled",false);
            alert("Por favor, preencha todos os campos!");
            return false;
        }
    });
    </script>
  </body>
</html>