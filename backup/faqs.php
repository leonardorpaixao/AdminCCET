<?php
  include 'topo.php';
?>
<title>AdminDcomp - FAQs</title> 
</head>     
<?php
  include 'barra.php';
  include 'menu.php';
  $_SESSION['irPara'] = '/faqs';
  $link = '/faqs';
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            FAQs
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="box-group" id="accordion">
            <div class="panel box box-primary" style="text-align: justify;">
              <div class="box-header with-border">
                <h4 class="box-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#faq1">
                    Não consigo logar na minha conta
                  </a>
                </h4>
              </div>
              <div id="faq1" class="panel-collapse collapse">
                <div class="box-body">
                  <p>Várias situações podem levar ao insucesso do login no AdminDComp.</p>
                  <ul>
                    <li><b>Você não é aluno ou membro do DComp.</b> - Você deve ser aluno ou membro (professor, técnico ou funcionário) do Departamento de Computação para acessar o AdminDComp. Adesões recentes podem demorar para entrar no banco de dados.</li>
                    <li><b>Usuário errado.</b> - O seu usuário deve ser igual ao do SIGAA e não pode iniciar com números, caso contrário procure procure o NTI da UFS e solicite a mudança de usuário.</li>
                    <li><b>Você alterou o usuário e/ou a senha do SIGAA recentemente.</b> - Nessa situação aguarde até 24h para que a nossa base seja atualizada com os novos dados para acesso.</li>
                  </ul>
                  <p>Caso nenhuma solução resolva, utilize a nossa ferramenta para reportar bugs <a href="https://admin.dcomp.ufs.br/reportarbugs">clicando aqui</a>.
                </div>
              </div>
              <div class="box-header with-border">
                <h4 class="box-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#faq2">
                    Como solicitar um e-mail institucional?
                  </a>
                </h4>
              </div>
              <div id="faq2" class="panel-collapse collapse">
                <div class="box-body">
                  Para solicitar o e-mail institucional você deve logar na sua conta, acessar o seu perfil e clicar em <b>Requisitar e-mail DComp</b>. Você deverá escolher entre 3 opções e após isso aguardar a resposta de um técnico do DComp.
                </div>
              </div>
            </div>
          </div>
          <div class="callout callout-warning">
            <h4>Nenhuma resposta serviu?</h4>

            <p>Clique <a href="/reportarbugs">aqui</a> e reporte um problema.</p>
          </div>
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <?php include 'rodape.php' ?>
    <?php include 'script.php' ?>
  </body>
</html>