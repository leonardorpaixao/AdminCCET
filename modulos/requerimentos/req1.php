        <?php
          include '../../includes/topo.php';
        ?>
        <title>AdminDcomp - Requerimento de Atividades Complementares</title> 
        </head>
        <?php
          include '../../includes/barra.php';
          include '../../includes/menu.php';
          if($_SESSION['logado']){
            $acao = (isset($_GET['acao']))? $_GET['acao'] : 'inserir';          
            $id = (isset($_GET['id']))? $_GET['id'] : NULL;

            $db = Atalhos::getBanco();
            
            if ($query = $db->prepare("SELECT b.nomeUser, AES_DECRYPT(b.email, ?), c.afiliacao, e.matricula
              FROM tbUsuario b
              inner join tbAfiliacao c on b.idAfiliacao = c.idAfiliacao
              inner join tbMatricula e on b.idUser = e.idUser
              WHERE b.idUser = ?")){
              $query->bind_param('si', $_SESSION['chave'], $_SESSION['id']);             
              $query->execute();
              $query->bind_result($nomeUser, $email, $afiliacao, $matricula);
              $query->fetch();
              $query->close();
            }

            if ($query = $db->prepare("SELECT AES_DECRYPT(numTelefone, ?) FROM tbTelefone WHERE idUser = ?")){
              $query->bind_param('si', $_SESSION['chave'], $_SESSION['id']);
              $query->execute();
              $query->bind_result($numTelefone);
              $query->fetch();
              $query->close();
            }
    ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Atividades Complementares (Aproveitamento de Créditos)
            <small>Requerimentos</small>     
          </h1> 
        </section>
        <?php
          // FORMULÁRIO PARA INSERÇÃO
          if($acao == 'inserir'){
        ?>
        <!-- Main content -->
        <section class="content">
        <?php
          if(isset($_SESSION['avisoReqs'])):
        ?>
            <div class="callout callout-success">
              <h4>Requerimento enviado com sucesso!</h4>
              <p>Acesse a <a href="/requerimentos/meus">página de requerimentos</a> para visualizar, editar e acompanhar a sua solicitação.</p>
            </div>
        <?php
          unset($_SESSION['avisoReqs']);
          endif;
        ?>
          <div class="callout callout-warning">
              <h4>NOVO PROCEDIMENTO PARA REQUERIMENTOS DE <b>ATIVIDADES COMPLEMENTARES</b></h4>
              <p>A partir de 10/11/2016 novos requerimentos para Atividades Complementares NÃO serão controlados pelo DComp.</p>
              <p>Novo procedimento:</p>
              <p>
                1 - Clique abaixo em "Gerar documento".<br>
                2 - Imprima o documento gerado.<br>
                3 - Leve o documento gerado, juntamente com os anexos necessários, para o <b>SECOM - Serviço Geral de Comunicação e Arquivo</b> (localizado na Reitoria da UFS) e solicite o Aproveitamento de Créditos.<br>
                4 - Acompanhe o processo pelo seu SIGAA.</p>
              <p>OBS: <b>NÃO</b> preencha nenhuma informação do documento gerado.</p>
          </div>
          <!-- Default box -->
          <div class="box" id="forminsere">
            <div class="box-header with-border">
                  <h3 class="box-title">Dados básicos</h3>
            </div>
                <form role="form" action="post/" method="post" class="formulario">
                  <input type="hidden" id="numPost" name="numPost" value="20"><!-- Número correspodente ao post -->
                  <input type="hidden" id="tipoReq" name="tipoReq" value="1"><!-- Número correspodente ao tipo -->
                  <div class="box-body">
                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" class="form-control" name="nome" value="<?php echo $nomeUser; ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label>Matrícula</label>
                      <input type="text" class="form-control" name="matricula" value="<?php echo $matricula; ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label>Curso</label>
                      <input type="text" class="form-control" name="curso" value="<?php echo $afiliacao; ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label>Telefone</label>
                      <input type="text" class="form-control" name="telefone" value="<?php echo $numTelefone; ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label>E-mail</label>
                      <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" disabled>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button id="botaoEnviar" type="submit" class="btn btn-primary">Gerar documento</button>
                  </div>
                  </form>
          </div><!-- /.box -->

        </section><!-- /.content -->
        
        <?php
          } else echo Atalhos::aviso(1); //FIM DA PERMISSÃO
        ?>
      </div><!-- /.content-wrapper -->
      <?php 
        } //Termina IF de permissão logado
      ?>
    <?php include '../../includes/rodape.php' ?>
    <?php include '../../includes/script.php' ?>
  </body>
</html>
