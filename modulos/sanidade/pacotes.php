<?php
  include '../../includes/topo.php';
?>
<title>AdminDcomp - Repositório</title>
</head>
<?php
  if(!$_SESSION['logado'] || ($_SESSION['nivel'] > 0)){
    header('Location: /inicio');
  }
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $link = '/repositorio';
  $_SESSION['irPara'] = '/inicio';
  //verifica a página atual caso seja informada na URL, senão atribui como 1ª página

  function extensionCatcher($nomeArquivo){
    # separa strings em substrigs divididas pelo '.' e a retorna num array das substrings
    $idtArr = explode('.',$nomeArquivo);
    # retorna o ultimo indice do array e letras minusculas
        $extensao = strtolower(end($idtArr));
        # retorna extensão
        return $extensao;
  }

  function nomePacoteCatcher($nomeArquivo){
    # separa string em substrings separadas pelo '-' e retorna um array das substrings
    $idpkg = explode('-', $nomeArquivo);
    #
    $idarch = explode('.', $idpkg[(count($idpkg) - 1)]);
    $idpkg[(count($idpkg) - 1)] = $idarch[0];
    $nome = "";
    # loop que monta o nome do pacote, que esta dividido, em uma string apenas. Ou seja:
    #        [0] nome
    # (no array) [1] do      -----> nome-do-pacote (na string de saída)
    #      [2] pacote
    $i = (count($idpkg) - 3);
    $j = 0;
    while($j < $i){
      $nome = $nome . $idpkg[$j];
      $j++;
      if($j != $i){
        $nome = $nome . "-";
      }
     }
    # Retorna array com as informações: nome, versão, release e arquitetura
    $infoPacote = array($nome, $idpkg[$i], $idpkg[($i+1)], $idpkg[($i+2)]);
    return $infoPacote;
  }
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Repositório
      <!--<small>Recursos</small>-->
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <?php
      if(isset($_SESSION['avisoPacoteEnviado'])):
    ?>
        <div class="callout callout-success">
          <h4>Upload efetuado com sucesso!</h4>
          <p>Índice do repositório atualizado com sucesso.</p>
        </div>
    <?php
      unset($_SESSION['avisoPacoteEnviado']);
      elseif(isset($_SESSION['erroPacote'])):
    ?>
      <div class="callout callout-danger">
        <h4>Erro de Upload:</h4>
        <p><?php echo $_SESSION['erroPacote'] ?></p>
      </div>
    <?php
      unset($_SESSION['erroPacote']);
      elseif(isset($_SESSION['falhaPacote'])):
    ?>
        <div class="callout callout-danger">
          <h4>Falha na atualização do repositório.</h4>
          <p>Por Favor, tente novamente.</p>
        </div>
    <?php
      unset($_SESSION['falhaPacote']);
      elseif(isset($_SESSION['avisoPacoteExcluido'])):
    ?>
        <div class="callout callout-success">
          <h4>Pacote excluído com sucesso!</h4>
          <p>Índice do repositório atualizado com sucesso.</p>
        </div>
    <?php
      unset($_SESSION['avisoPacoteExcluido']);
      elseif(isset($_SESSION['avisoPacoteNaoExcluido'])):
    ?>
        <div class="callout callout-danger">
          <h4>Pacote não excluído!</h4>
          <p>Índice do repositório não atualizado.</p>
        </div>
    <?php
      unset($_SESSION['avisoPacoteNaoExcluido']);
      elseif(isset($_SESSION['avisoPacoteAtualizado'])):
    ?>
          <div class="callout callout-success">
            <h4>Pacote atualizado com sucesso!</h4>
          <p>Índice do repositório atualizado com sucesso.</p>
        </div>
    <?php
      unset($_SESSION['avisoPacoteAtualizado']);
      endif;
    ?>
      <div class="row">
      <div class="col-xs-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab">x86_64</a></li>
          <li><a href="#tab_2" data-toggle="tab">armv7h</a></li>
          <li><a href="#tab_3" data-toggle="tab">i686</a></li>
          <li><a href="#tab_4" data-toggle="tab">any</a></li>
          <li class="dropdown">
        </ul>
        <div class="box">
          <div class="box-header">
            <a href="/repositorio/adicionar"><button class="btn btn-success">Adicionar</button></a>
          </div>
            <div class="box-tools">
            </div><!-- /.box-header -->
            <div class="tab-content">
               <div class="tab-pane active" id="tab_1">
                <?php
                  $path = "../../repo_dcomp/x86_64/";
                  $diretorio = dir($path);
                  $i = 0;
                  while( $arquivo = $diretorio -> read() ){
                    $ext = extensionCatcher($arquivo);
                    # Adiciona à variável $lista apenas os arquivos com extensão "xz" (ou seja, apenas pacotes)
                    if( $ext == "xz" ){
                        $lista[$i] = $arquivo;
                        $i = $i + 1;
                    }
                  }
                  # Fecha o ponteiro do diretorio
                  $diretorio -> close();
                  $j = 0;

                  if($i != 0):
                  ?>
                  <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th><center>Nome</center></th>
                        <th><center>Versão</center></th>
                        <th><center>Release</center></th>
                        <th><center>Arquitetura</center></th>
                        <th><center>Ação</center></th>
                        <th></th>
                      </tr>
                    </thead>
                      <?php
                        $j = 0;
                        # echoa o formulario em HTML com as opções de remover e atualizar pacotes.
                        # Os formulários estão numa tabela, para organizar a disposição.
                        while ( $j < $i ) {
                          $nomePacote = $lista[$j];
                          $infoPacote = nomePacoteCatcher($nomePacote);
                          echo '<tr align="center">
                            <td>'.$infoPacote[0].'</td>
                            <td>'.$infoPacote[1].'</td>
                            <td>'.$infoPacote[2].'</td>
                            <td>'.$infoPacote[3].'</td>
                            <td><button data-target="#atualizar" data-solict-id="'.$nomePacote.'" class="btn btn-primary btn-xs"
                              data-solict-tipo="'.$infoPacote[0].'" data-toggle="modal" data-solict-frase="Atualizar Pacote" data-solict-nome="'.$infoPacote[0].'">Atualizar Pacote</button></td>
                            <td><button class="close" data-target="#excluir" data-solict-id="'.$nomePacote.'"
                              data-solict-tipo="'.$infoPacote[0].'" data-toggle="modal" data-solict-frase="Excluir" data-solict-nome="'.$infoPacote[0].'">
                              <span aria-hidden="true">&times;</span></button></td>
                          </tr>';
                          $j = $j + 1;
                        }
                      ?>
                        </table><ul class="pagination pagination-sm no-margin pull-right">
                          </ul>
                      </div><!-- /.box-body -->
                    <?php else: ?>
                    <div class="box-body">
                      <div class="callout callout-warning">
                        <h4>Repositório Vazio!</h4>
                        <p>Não foi encontrado nenhum pacote no repositório selecionado.</p>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="tab-pane" id="tab_2">
                    <?php
                      # pasta que contém o repositório e cria ponteiro para a pasta.
                      $path = "../../repo_dcomp/armv7h/";
                      $diretorio = dir($path);
                      $i = 0;
                      while( $arquivo = $diretorio -> read() ){
                        $ext = extensionCatcher($arquivo);
                        # Adiciona à variável $lista apenas os arquivos com extensão "xz" (ou seja, apenas pacotes)
                        if( $ext == "xz" ){
                            $lista[$i] = $arquivo;
                            $i = $i + 1;
                        }
                      }
                      # Fecha o ponteiro do diretorio
                      $diretorio -> close();
                      if($i != 0):
                    ?>

                      <div class="box-body table-responsive">
                        <table id="example2" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th><center>Nome</center></th>
                              <th><center>Versão</center></th>
                              <th><center>Release</center></th>
                              <th><center>Arquitetura</center></th>
                              <th><center>Ação</center></th>
                              <th></th>
                            </tr>
                          </thead>
                          <?php
                            $j = 0;
                            # echoa o formulario em HTML com as opções de remover e atualizar pacotes.
                            # Os formulários estão numa tabela, para organizar a disposição.
                            while ( $j < $i ) {
                              $nomePacote = $lista[$j];
                              $infoPacote = nomePacoteCatcher($nomePacote);
                              echo '<tr align="center">
                                <td>'.$infoPacote[0].'</td>
                                <td>'.$infoPacote[1].'</td>
                                <td>'.$infoPacote[2].'</td>
                                <td>'.$infoPacote[3].'</td>
                                <td><button data-target="#atualizar" data-solict-id="'.$nomePacote.'" class="btn btn-primary btn-xs"
                                  data-solict-tipo="'.$infoPacote[0].'" data-toggle="modal" data-solict-frase="Atualizar Pacote" data-solict-nome="'.$infoPacote[0].'">Atualizar Pacote</button></td>
                                <td><button class="close" data-target="#excluir" data-solict-id="'.$nomePacote.'"
                                  data-solict-tipo="'.$infoPacote[0].'" data-toggle="modal" data-solict-frase="Excluir" data-solict-nome="'.$infoPacote[0].'">
                                  <span aria-hidden="true">&times;</span></button></td>
                              </tr>';
                              $j = $j + 1;
                            }
                          ?>
                        </table>
                      </div><!-- /.box-body -->
                    <?php else: ?>
                    <div class="box-body">
                      <div class="callout callout-warning">
                        <h4>Repositório Vazio!</h4>
                        <p>Não foi encontrado nenhum pacote no repositório selecionado.</p>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="tab-pane" id="tab_3">
                    <?php
                      # pasta que contém o repositório e cria ponteiro para a pasta.
                      $path = "../../repo_dcomp/i686/";
                      $diretorio = dir($path);
                      $i = 0;
                      while( $arquivo = $diretorio -> read() ){
                        $ext = extensionCatcher($arquivo);
                        # Adiciona à variável $lista apenas os arquivos com extract(var_array)ensão "xz" (ou seja, apenas pacotes)
                        if( $ext == "xz" ){
                            $lista[$i] = $arquivo;
                            $i = $i + 1;
                        }
                      }
                      # Fecha o ponteiro do diretorio
                      $diretorio -> close();
                      if($i != 0): ?>
                      <div class="box-body table-responsive">
                        <table id="example3" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th><center>Nome</center></th>
                              <th><center>Versão</center></th>
                              <th><center>Release</center></th>
                              <th><center>Arquitetura</center></th>
                              <th><center>Ação</center></th>
                              <th></th>
                            </tr>
                          </thead>
                          <?php
                            $j = 0;
                            # echoa o formulario em HTML com as opções de remover e atualizar pacotes.
                            # Os formulários estão numa tabela, para organizar a disposição.
                            while ( $j < $i ) {
                              $nomePacote = $lista[$j];
                              $infoPacote = nomePacoteCatcher($nomePacote);
                              echo '<tr align="center">
                                <td>'.$infoPacote[0].'</td>
                                <td>'.$infoPacote[1].'</td>
                                <td>'.$infoPacote[2].'</td>
                                <td>'.$infoPacote[3].'</td>
                                <td><button data-target="#atualizar" data-solict-id="'.$nomePacote.'" class="btn btn-primary btn-xs"
                                  data-solict-tipo="'.$infoPacote[0].'" data-toggle="modal" data-solict-frase="Atualizar Pacote" data-solict-nome="'.$infoPacote[0].'">Atualizar Pacote</button></td>
                                <td><button class="close" data-target="#excluir" data-solict-id="'.$nomePacote.'"
                                  data-solict-tipo="'.$infoPacote[0].'" data-toggle="modal" data-solict-frase="Excluir" data-solict-nome="'.$infoPacote[0].'">
                                  <span aria-hidden="true">&times;</span></button></td>
                              </tr>';
                              $j = $j + 1;
                            }
                          ?>
                        </table>
                      </div><!-- /.box-body -->
                  <div class="tab-pane active" id="tab_3">
                    <?php
                      $path = "../../repo_dcomp/any/";
                      $diretorio = dir($path);
                      $i = 0;
                      while( $arquivo = $diretorio -> read() ){
                        $ext = extensionCatcher($arquivo);
                        # Adiciona à variável $lista apenas os arquivos com extensão "xz" (ou seja, apenas pacotes)
                        if( $ext == "xz" ){
                            $lista[$i] = $arquivo;
                            $i = $i + 1;
                        }
                      }
                      # Fecha o ponteiro do diretorio
                      $diretorio -> close();
                      $j = 0;

                      if($i != 0):
                      ?>
                      <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                          <tr>
                            <th><center>Nome</center></th>
                            <th><center>Versão</center></th>
                            <th><center>Release</center></th>
                            <th><center>Arquitetura</center></th>
                            <th><center>Ação</center></th>
                            <th></th>
                          </tr>
                          <?php
                            $j = 0;
                            # echoa o formulario em HTML com as opções de remover e atualizar pacotes.
                            # Os formulários estão numa tabela, para organizar a disposição.
                            while ( $j < $i ) {
                              $nomePacote = $lista[$j];
                              $infoPacote = nomePacoteCatcher($nomePacote);
                              echo '<tr align="center">
                                <td>'.$infoPacote[0].'</td>
                                <td>'.$infoPacote[1].'</td>
                                <td>'.$infoPacote[2].'</td>
                                <td>'.$infoPacote[3].'</td>
                                <td><button data-target="#atualizar" data-solict-id="'.$nomePacote.'" class="btn btn-primary btn-xs"
                                  data-solict-tipo="'.$infoPacote[0].'" data-toggle="modal" data-solict-frase="Atualizar Pacote" data-solict-nome="'.$infoPacote[0].'">Atualizar Pacote</button></td>
                                <td><button class="close" data-target="#excluir" data-solict-id="'.$nomePacote.'"
                                  data-solict-tipo="'.$infoPacote[0].'" data-toggle="modal" data-solict-frase="Excluir" data-solict-nome="'.$infoPacote[0].'">
                                  <span aria-hidden="true">&times;</span></button></td>
                              </tr>';
                              $j = $j + 1;
                            }
                          ?>
                            </table>
                      </div><!-- /.box-body -->
                    <?php else: ?>
                    <div class="box-body">
                      <div class="callout callout-warning">
                        <h4>Repositório Vazio!</h4>
                        <p>Não foi encontrado nenhum pacote no repositório selecionado.</p>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>                    <?php else: ?>
                    <div class="box-body">
                      <div class="callout callout-warning">
                        <h4>Repositório Vazio!</h4>
                        <p>Não foi encontrado nenhum pacote no repositório selecionado.</p>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
             </div>
        </div><!-- /.box -->
      </div>
    </div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div class="modal fade" id="excluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
      <form role="form" action="post/" method="post" name="formulario1" id="formulario1">
      <div class="modal-body">
        <input type="hidden" id="numPost" name="numPost" value="41"><!-- Número correspodente ao post -->
        <input type="hidden" name="nomePacoteCompleto" id="nomePacoteCompleto"/>
        <input type="hidden" name="nomePacote" id="nomePacote"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="atualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
      <form role="form" action="post/" method="post" name="formulario1" id="formulario1" enctype="multipart/form-data">
      <div class="modal-body">
       <input type="hidden" id="numPost" name="numPost" value="42"><!-- Número correspodente ao post -->
       <input type="hidden" name="nomePacoteCompleto2" id="nomePacoteCompleto2"/>
       <input type="hidden" name="nomePacote2" id="nomePacote2"/>
       <input type="file" name="pacote" id="pacote" required />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php include '../../includes/rodape.php' ?>
    </div><!-- ./wrapper -->
    <?php include '../../includes/script.php' ?>
    <script>
    //DataTable
    $(function () {
      $('#example1').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
        }
      });
    });

    $(function () {
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
        }
      });
    });

    $(function () {
      $('#example3').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
        }
      });
    });

    $('#excluir').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var tipo = button.data('solict-tipo')
      var frase = button.data('solict-frase')
      var id = button.data('solict-id')
      var nome = button.data('solict-nome')
      var modal = $(this)
      modal.find('.modal-title').text(frase + ' - ' + nome)
      $('#nomePacoteCompleto').val(id)
      $('#nomePacote').val(tipo)
    })

    $('#atualizar').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var tipo = button.data('solict-tipo')
      var frase = button.data('solict-frase')
      var id = button.data('solict-id')
      var nome = button.data('solict-nome')
      var modal = $(this)
      modal.find('.modal-title').text(frase + ' - ' + nome)
      $('#nomePacoteCompleto2').val(id)
      $('#nomePacote2').val(tipo)

    })
    </script>
  </body>
</html>
