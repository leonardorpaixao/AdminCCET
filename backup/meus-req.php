    <?php
      include 'topo.php';
    ?>
    <title>AdminDcomp - Meus Requerimentos</title> 
      </head>     
    <?php
      if(!$_SESSION['logado']){
          header('Location: /inicio');
      }
      include 'barra.php';
      include 'menu.php';
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['acao'])){
          mysql_query("DELETE FROM tbrequerimentos WHERE idReq  = {$_POST['id']} AND idUser = {$_SESSION['id']}");
        }
      }
      $_SESSION['irPara'] = '/inicio';
      $link = '/requerimentos/meus';
      $db = Atalhos::getBanco();
      if ($query = $db->prepare("SELECT idReq, dataReq, statusReq, tipoReq, justificativaReq FROM tbrequerimentos 
          WHERE idUser = ?")){
          $query->bind_param('i', $_SESSION['id']);
          $query->execute();
          $query->bind_result($idReq, $dataReq, $statusReq, $tipoReq, $justificativaReq);
      }
    ?>
      
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
            Meus
            <small>Requerimentos</small>
          </h1>

        </section>

        <!-- Main content -->
        <section class="content">
        <div class="box-body">
          <!-- Default box -->
          <div class="box">
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th><center>Tipo</center></th>
                      <th><center>Data</center></th>
                      <th><center>Status</center></th>
                      <th><center>Visualizar</center></th>
                      <th><center>Ação</center></th>
                    </tr>
                  </thead>
                    <?php
                      while($query->fetch()){
                        switch ($tipoReq) {
                          case 1:
                            $tipo = 'Atividades Complementares';
                            break;
                          case 2:
                            $tipo = 'Cadastro de Estágio';
                            break;
                          case 3:
                            $tipo = 'Requerimento de Abono de Faltas';
                            break;
                          case 4:
                            $tipo = 'Requerimento de Estágio Supervisionado';
                            break;
                          case 5:
                            $tipo = 'Requerimento de Inclusão em Disciplina';
                            break;
                          case 6:
                            $tipo = 'Requerimento de Trabalho de Conclusão de Curso';
                            break;
                          case 7:
                            $tipo = 'Requerimento Geral';
                            break;
                          default:
                            $tipo = 'Erro!';
                            break;
                        }
                        switch($statusReq){
                            case 'Aprovado':
                              $status = '<span class="label label-success" data-toggle="tooltip" title="Requerimento Aprovado.">APROVADO</span>';
                              $acao = 'Nenhuma.';
                              break;
                            case 'PendenteProf':
                              $status = '<span class="label label-warning" data-toggle="tooltip" title="Aguardando resposta do professor!">PENDENTE - PROFESSOR</span>';
                              $acao = 'Nenhuma.';
                              break;
                            case 'ConfirmadoProf':
                              $status = '<span class="label label-primary" data-toggle="tooltip" title="Confirmado pelo professor! Aguarde confirmação da secretaria.">CONFIRMADO - PROFESSOR</span>';
                              $acao = 'Nenhuma.';
                              break;
                            case 'NegadoProf':
                              $status = '<span class="label label-primary" data-toggle="tooltip" title="Negado pelo professor! Aguarde!">NEGADO - PROFESSOR</span>';
                              $acao = 'Nenhuma.';
                              break;
                            case 'Pendente':
                              $status = '<span class="label label-warning" data-toggle="tooltip" title="Aguardando análise da secretaria. Não possui validade!">PENDENTE</span>';
                              $prazo = Atalhos::verificarReq(5);
                              if($tipoReq != 5)
                                $acao = '<a href="/requerimentos/editar/'.$tipoReq.'/'.$idReq.'/" class="btn btn-block 
                                  btn-default btn-xs" data-toggle="modal">EDITAR</a><button class="btn btn-block btn-danger 
                                  btn-xs" data-toggle="modal" data-target="#simples" data-solict-id="'.$idReq.'" 
                                  data-solict-tipo="0" data-solict-frase="Excluir">EXCLUIR</button>
                                         ';       
                              else if($prazo[0])
                                $acao = '<a href="/requerimentos/editar/'.$tipoReq.'/'.$idReq.'/" class="btn btn-block 
                                  btn-default btn-xs" data-toggle="modal">EDITAR</a><button class="btn btn-block btn-danger 
                                  btn-xs" data-toggle="modal" data-target="#simples" data-solict-id="'.$idReq.'" 
                                  data-solict-tipo="0" data-solict-frase="Excluir">EXCLUIR</button>
                                         '; 
                              else
                                $acao = 'Nenhuma.';                    
                              break;
                            case 'Negado':
                              $status = '<span class="label label-danger" data-toggle="tooltip" title="Requerimento Negado. Justificativa: '.$justificativaReq.'">NEGADO</span>';
                              $acao = '<button class="btn btn-block btn-danger 
                                btn-xs" data-toggle="modal" data-target="#simples" data-solict-id="'.$idReq.'" 
                                data-solict-tipo="0" data-solict-frase="Excluir">EXCLUIR</button>
                                       ';                         
                              break;
                            case 'Cancelado':
                              $status = '<span class="label label-info" data-toggle="tooltip" data-toggle="tooltip" title="Requerimento Cancelado. Justificativa: '.$justificativaReq.'">CANCELADO</span>';
                              $acao = 'Nenhuma.';
                              break;
                          }
                        echo '<tr align="center">
                                <td>'.$tipo.'</td>
                                <td>'.date('d/m/Y', strtotime($dataReq)).'</td>
                                <td>'.$status.'</td>
                                <td><a target="_blank" href="forms/form'.$tipoReq.'.php?id='.$idReq.'
                                  " class="btn btn-primary btn-xs" data-toggle="modal"><i class="fa fa-file-pdf-o"></a></td>
                                <td>'.$acao.'</td>
                              </tr>';
                      }
                    ?>
              </table>
            </div>
          </div><!-- /.box -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
  <?php include 'rodape.php' ?>
    </div><!-- ./wrapper -->
    <!-- EXCLUIR -->
    <div class="modal fade" id="simples" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="exampleModalLabel"></h4>
              </div>
              <form role="form" action="post.php" method="post" name="formulario1" id="formulario1">
                <input type="hidden" id="numPost" name="numPost" value="27"><!-- Número correspodente ao post -->
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
    <!-- FIM EXCLUIR -->        
    <?php include 'script.php' ?>
    <script>

    //DataTable
    $(function () {
      $('#example1').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "order": [2,"desc"],
        "info": false,
        "autoWidth": true,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
        }
      });
    });


    $('#simples').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('solict-id')
    var modal = $(this)
    var tipo = button.data('solict-tipo')
    modal.find('.modal-title').text('Excluir - Requerimento ' + id)
        $('#id').val(id)
        $('#acao').val(tipo)
    })
    </script>
  </body>
</html>
