    <?php include 'topo.php';
          include 'barra.php';
          include 'menu.php';
    ?>
    <title>AdminDcomp - Requerimento de Inclusão em Disciplinas</title> 
      </head>      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Requerimento de Inclusão em Disciplinas      
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
        <?php
          if(isset($_SESSION['avisoInclusao'])):
        ?>
            <div class="callout callout-success">
              <h4>Requerimento enviado com sucesso!</h4>
              <p>Acesse <a href="/inclusao/acompanhar">essa página</a> para acompanhar a sua solicitação.</p>
            </div>
        <?php
          unset($_SESSION['avisoInclusao']);
          endif;
        ?>
          <!-- Default box -->
        <div class="callout callout-info">
              <h4>Atenção requerentes!</h4>
              <p>A solicitação NÃO garante a inclusão na disciplina. Para verificar a situação do seu requerimento de inclusão acesse a página <a href="http://admin.dcomp.ufs.br/inclusao/acompanhar">http://admin.dcomp.ufs.br/inclusao/acompanhar</a> e digite a sua matrícula e o seu e-mail.</p>
              <p>Qualquer dúvida entre em contato conosco através do e-mail <b>secretaria@dcomp.ufs.br</b></p>
              <p>Antes de enviar um requerimento verifique se a turma desejada possui vagas. Entre no <b>SIGAA</b> e acesse o menu <b>Ensino > Consultar Turma</b>. <a href="tuto_inclusao.gif" target="_blank">Clique aqui e veja um tutorial!</a></p>
            </div>
          <div class="box" id="forminsere">
            <div class="box-header with-border">
                  <h3 class="box-title">Dados básicos</h3>
            </div>
                <form role="form" action="post2.php" method="post" class="formulario">
                  <input type="hidden" id="numPost" name="numPost" value="4"/><!-- Número correspodente ao post -->
                  <input type="hidden" id="inclusaoDisc" name="inclusaoDisc" value="1">
                  <div class="box-body">
                    <div class="form-group">
                      <label>Nome completo</label>
                      <input type="text" class="form-control" name="nome" id="nome">
                    </div>
                    <div class="form-group">
                      <label>Matrícula</label>
                      <input type="number" class="form-control" name="matricula" id="matricula">
                    </div>
                    <div class="form-group">
                      <label>Curso</label>
                      <input type="text" class="form-control" name="curso" id="curso">
                    </div>
                    <div class="form-group">
                      <label>Telefone</label>
                      <input type="text" name="telefone" id="telefone" class="form-control" data-inputmask='"mask": "(99) 999999999"' data-mask/>
                    </div>
                    <div class="form-group">
                      <label>E-mail</label>
                      <input type="email" class="form-control" name="email" id="email">
                    </div>
                  </div><!-- /.box-body -->
            <div class="box-header with-border">
                <h3 class="box-title">Dados complementares (<a href="tuto_inclusao.gif" target="_blank">veja o tutorial sobre como pegar essas informações</a>)</h3>
            </div>
              <div class="box-body">
                  <div class="form-group">
                    <label>Disciplina</label>
                    <select class="form-control" name="disciplina" id="disciplina">
                      <option selected disabled>Selecione uma disciplina</option>
                      <?php
                        $db = Atalhos::getBanco();
                        if($query = $db->prepare("SELECT idDisc, nome, codigo, carga FROM tbDisciplinas")){
                              $query->execute();
                              $query->bind_result($idDisc, $nome, $codigo, $carga);
                        }
                        while($query->fetch()){
                          echo '<option value="'.$idDisc.'">'.$codigo.' - '.$nome.' ('.$carga.')</option>';
                            }        
                        $query->close();
                      ?>
                    </select>
                  </div>
                    <div class="form-group">
                      <label>Turma (verifique se há vaga pelo SIGAA)</label>
                      <select class="form-control" name="turma" id="turma">
                      <option selected disabled>Selecione a turma desejada</option>
                      <?php
                        for($i=1; $i <= 15; $i++)
                          echo '<option value="'.$i.'">Turma '.$i.'</option>';
                      ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Período letivo</label>
                      <select class="form-control" name="periodo" id="periodo">
                      <option selected disabled>Selecione um período</option>
                      <?php
                        $ano_atual = (int) date("Y", time());
                          $ano_passado = $ano_atual - 1;
                          for($i=0;$i<3;$i++){
                            $ano = $ano_passado + $i;
                            echo '<option value="'.$ano.'/1">'.$ano.'/1</option>';
                            echo '<option value="'.$ano.'/2">'.$ano.'/2</option>';
                          }
                      ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Anexar histórico (acesse seu SIGAA, baixe o seu histórico e anexe o PDF aqui):</label>
                      <input type="file" name="historico" id="historico">
                    </div>
                    <div class="form-group">
                      <label>Motivo (opcional):</label>
                      <input type="text" class="form-control" name="motivo" id="motivo">
                    </div>    
              </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Enviar requerimento</button>
                  </div>
                  </form>
          </div><!-- /.box -->
         
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->
    <?php include 'rodape.php' ?>

    <?php include 'script.php' ?>
    <script>
    function limitarInput(obj, max) {
      obj.value = obj.value.substring(0,max);
    }
    $(document).ready(function() {
      var text_max = 3700;
      $('#contador').html(text_max + ' caracteres restantes');

      $('#plano').keyup(function() {
          var text_tam_atual = $('#plano').val().length;
          var text_restante = text_max - text_tam_atual;

          $('#contador').html(text_restante + ' caracteres restantes');
      });
    });
    $('#forminsere').find('.formulario').submit(function() {
        var nome = $.trim($(this).find('#nome').val());
        var email = $.trim($(this).find('#email').val());
        var telefone = $.trim($(this).find('#telefone').val());
        var disciplina = $.trim($(this).find('#disciplina').val());
        var turma = $.trim($(this).find('#turma').val());
        var curso = $.trim($(this).find('#curso').val());
        var matricula = $.trim($(this).find('#matricula').val());
        var historico = $.trim($(this).find('#historico').val());
        var periodo = $.trim($(this).find('#periodo').val());
        if(!(disciplina.length != 0 && turma.length != 0 && nome.length != 0 && historico.length != 0 && periodo.length != 0 && email.length != 0 && telefone.length != 0 && curso.length != 0 && matricula.length != 0)) {
            alert("Por favor, preencha todos os campos!");
            return false;
        }
    });
    </script>
  </body>
</html>