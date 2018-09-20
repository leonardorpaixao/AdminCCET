    <?php 
    include 'topo.php';
    if(!$_SESSION['logado'] || $_SESSION['nivel'] != 1){
      header('Location: /inicio');
    }
    include 'barra.php';
    include 'menu.php';
    $_SESSION['irPara'] = '/inicio';
    $db = Atalhos::getBanco();
    $link = '/inclusao/moderar';
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
    if ($query = $db->prepare("SELECT idInc FROM tbinclusao")){
        $query->execute();
        $query->store_result();
        $total = $query->num_rows;
      }
      if($total > 0){
        $numPaginas = ceil($total/NumReg);
        if($pagina > $numPaginas){
          $pagina = $numPaginas;
        }
        $inicio = (NumReg*$pagina)-NumReg;
        $query->free_result();
        $query->close();
        if ($query = $db->prepare("SELECT idInc, matricula, curso, disciplina, codigo, turma, periodo, status, dataEnvio FROM tbinclusao
          ORDER BY status, dataEnvio ASC LIMIT ?,".NumReg)){
          $query->bind_param('i', $inicio);
          $query->execute();
          $query->bind_result($idInc, $matricula, $curso, $disciplina, $codigo, $turma, $periodo, $status, $data);
        }
      }
    ?>
      <title>AdminDcomp - Moderar requerimento de inclusão</title> 
      </head>     
    <style type="text/css">
      /* FROM HTTP://WWW.GETBOOTSTRAP.COM
        * Glyphicons
        *
        * Special styles for displaying the icons and their classes in the docs.
        */

      .bs-glyphicons {
        padding-left: 0;
        padding-bottom: 1px;
        margin-bottom: 20px;
        list-style: none;
        overflow: hidden;
      }
      .bs-glyphicons li {
        float: left;
        width: 25%;
        height: 115px;
        padding: 10px;
        margin: 0 -1px -1px 0;
        font-size: 12px;
        line-height: 1.4;
        text-align: center;
        border: 1px solid #ddd;
      }
      .bs-glyphicons .glyphicon {
        margin-top: 5px;
        margin-bottom: 10px;
        font-size: 24px;
      }
      .bs-glyphicons .glyphicon-class {
        display: block;
        text-align: center;
        word-wrap: break-word; /* Help out IE10+ with class names */
      }
      .bs-glyphicons li:hover {
        background-color: rgba(86,61,124,.1);
      }

      @media (min-width: 768px) {
        .bs-glyphicons li {
          width: 12.5%;
        }
      }
    </style>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Moderar requerimento de inclusão
          </h1>
        </section>
       
        <section class="content">
      <div class="box-body table-responsive no-padding">
        <!-- Main content -->
          <!-- Default box -->
          <div class="box">
            <div class="box-body">
              <?php
                if($total == 0):
              ?>
                <div class="callout callout-warning">
                  <h4>Lista Vazia!</h4>
                  <p>Nenhum requerimento a ser moderado.</p>
                </div>
              <?php
                else:
              ?>
              <table class="table table-hover">
                    <tr>
                      <th><center>ID</center></th>
                      <th><center>Matrícula</center></th>
                      <th><center>Disciplina</center></th>
                      <th><center>Código</center></th>
                      <th><center>Turma</center></th>
                      <th><center>Período</center></th>
                      <th><center>Detalhes</center></th>
                      <th><center>Data</center></th>
                      <th><center>Status</center></th>
                      <th><center>Ação</center></th>
                    </tr>
                    <?php
                      while($query->fetch()){
                        $acao = 'Nenhuma ação possivel';
                      switch($status){
                        case 'Em análise':
                          $status2 = '<span class="label label-warning">EM ANÁLISE</span>';
                          $acao = '<button class="btn btn-block btn-success btn-xs" data-toggle="modal" data-target="#simples"
                          data-solict-id='.$idInc.' data-solict-tipo="Deferido" data-solict-frase="Deferir requerimento" 
                          >Deferir</button>
                          <button class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#negativo" 
                          data-solict-id='.$idInc.' data-solict-tipo="Indeferido" data-solict-frase="Indeferir Requerimento">Indeferir</button>';
                          break;
                        case 'Deferido':
                          $status2 = '<span class="label label-success">DEFERIDO</span>';      
                          break;
                        case 'Indeferido':
                          $status2 = '<span class="label label-danger">INDEFERIDO</span>';
                          break;
                      }
                        echo '<tr align="center">
                               <td>'.$idInc.'</td>
                               <td>'.$matricula.'</td>
                                <td>'.$disciplina.'</td>
                                <td>'.$codigo.'</td>
                                <td>'.$turma.'</td>
                                <td>'.$periodo.'</td>
                                <td><a target="_blank" href="forms/form5-2.php?id='.$idInc.'" 
                                 class="btn btn-primary btn-xs" data-toggle="modal"><i class="fa fa-file-pdf-o"></a></td>
                               <td>'.date('d/m/Y H:i', $data).'</td>
                               <td>'.$status2.'</td>
                               <td>'.$acao.'</td>
                              </tr>';
                      }
                    ?>
              </table>
              <?php
                include 'paginacao.php'
              ?>
            </div>
          </div><!-- /.box -->
        <?php endif; ?>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
        <?php include 'rodape.php' ?>
     </div><!-- ./wrapper -->

    <!-- NEGAR -->
    <div class="modal fade" id="negativo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="exampleModalLabel"></h4>
              </div>
              <form role="form" action="post.php" method="post" name="formulario" id="formulario">
                <input type="hidden" id="numPost" name="numPost" value="48"><!-- Número correspodente ao post -->
                <div class="modal-body">
                    <input type="hidden" name="id2" id="id2" />
                    <input type="hidden" name="acao2" id="acao2" />
                    <div class="form-group">
                      <label for="message-text" class="control-label">Justificativa:</label>
                      <textarea class="form-control" name="justificativa" id="justificativa"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-success">Confirmar</button>
                </div>
              </form>
            </div>
        </div>
    </div>
    <!-- FIM NEGAR -->
    <!-- APROVAR -->
    <div class="modal fade" id="simples" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="exampleModalLabel"></h4>
              </div>
              <form role="form" action="post.php" method="post" name="formulario1" id="formulario1">
                <input type="hidden" id="numPost" name="numPost" value="48"><!-- Número correspodente ao post -->
                <div class="modal-body">
                    <input type="hidden" name="id" id="id"/>
                    <input type="hidden" name="acao" id="acao" />
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
                  <button type="submit" class="btn btn-success">Confirmar</button>
                </div>
              </form>
            </div>
        </div>
     </div>
    <!-- FIM APROVAR -->    
    <?php include 'script.php' ?>
    <script>
    $('#simples').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var tipo = button.data('solict-tipo')
    var frase = button.data('solict-frase')
    var id = button.data('solict-id')
    var modal = $(this)
    modal.find('.modal-title').text(frase + ' ' + id)
        $('#id').val(id)
        $('#acao').val(tipo)
    })

    $('#negativo').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var tipo = button.data('solict-tipo')
    var frase = button.data('solict-frase')
    var id = button.data('solict-id') // Extract info from data-* attributes
    var modal = $(this)
    modal.find('.modal-title').text(frase + ' ' + id)
      $('#id2').val(id)
      $('#acao2').val(tipo)
    })
    </script>
  </body>
</html>
