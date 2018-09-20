  <?php
    include 'topo.php';
  ?>
  <title>AdminDcomp - Moderar Requerimentos</title> 
    </head>    
  <?php
    if(!$_SESSION['logado'] || $_SESSION['afiliacao'] != 1){
      header('Location: /inicio');
    }
    include 'barra.php';
    include 'menu.php';
    $_SESSION['irPara'] = '/requerimentos/moderar/docente';
    $db = Atalhos::getBanco();
    $link = '/requerimentos/moderar/docente';
    if($query = $db->prepare("SELECT a.idReq, a.conteudoReq, a.dataReq, a.statusReq, a.tipoReq, a.justificativaReq, b.matricula, c.nomeUser FROM tbrequerimentos a JOIN tbmatricula b ON a.idUser = b.idUser AND a.tipoReq != 5 JOIN tbusuario c ON a.idUser = c.idUser WHERE a.idReq IN (SELECT idReq FROM tbreqs_professor WHERE idProfessor = {$_SESSION['id']}) UNION SELECT a.idReq, a.conteudoReq, a.dataReq, a.statusReq, a.tipoReq, a.justificativaReq, b.matricula, b.nome FROM tbrequerimentos a JOIN tbtemporarios b ON a.idTemp = b.idTemp AND a.tipoReq != 5 WHERE a.idReq IN (SELECT idReq FROM tbreqs_professor WHERE idProfessor = {$_SESSION['id']})")){
      $query->execute();
      $query->bind_result($idReq, $conteudoReq, $dataReq, $statusReq, $tipoReq, $justificativaReq, $matricula, $nome);
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
            Moderar
            <small>Requerimentos</small>
          </h1>
        </section>
       
        <section class="content">
      <div class="box-body">

        <!-- Main content -->
          <!-- Default box -->
          <div class="box">
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped display nowrap" cellspacing="0" >
                  <thead>
                    <tr>
                      <th><center>ID</center></th>
                      <th><center>Matrícula</center></th>
                      <th><center>Nome</center></th>
                      <th><center>Tipo</center></th>
                      <th><center>Data</center></th>
                      <th><center>Status</center></th>
                      <th><center>Visualizar</center></th>
                      <th><center>Ação</center></th>
                    </tr>
                  </thead>
                    <?php
                      while($query->fetch()){
                        $conteudo = explode("/+", $conteudoReq);
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
                            $tipo = 'Requerimento de Estágio Supervisionado<br>'.$conteudo[1].' - '.$conteudo[0];
                            break;
                          case 6:
                            $tipo = 'Requerimento de Trabalho de Conclusão de Curso<br>'.$conteudo[2].' - '.$conteudo[1];
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
                              $acao = '<button class="btn btn-block btn-success btn-xs" data-toggle="modal" 
                                data-target="#simples" data-solict-id="'.$idReq.'" data-solict-tipo="3" 
                                data-solict-frase="Aprovar">APROVAR</button><button class="btn btn-block btn-danger btn-xs" 
                                data-toggle="modal" data-target="#negativo" data-solict-id="'.$idReq.'" data-solict-tipo="2" 
                                data-solict-frase="Negar">NEGAR</button>';
                                if($tipoReq == 4 || $tipoReq == 6)
                                $acao = '<button class="btn btn-block btn-success btn-xs" data-toggle="modal" 
                                data-target="#simples" data-solict-id="'.$idReq.'" data-solict-tipo="6" 
                                data-solict-frase="Aprovar">APROVAR</button><button class="btn btn-block btn-danger btn-xs" 
                                data-toggle="modal" data-target="#negativo" data-solict-id="'.$idReq.'" data-solict-tipo="7" 
                                data-solict-frase="Negar">NEGAR</button>';
                              break;
                            case 'ConfirmadoProf':
                              $status = '<span class="label label-primary" data-toggle="tooltip" title="Confirmado pelo professor!">CONFIRMADO PELO PROFESSOR</span>';
                              $acao = 'Nenhuma.';
                              break;
                            case 'NegadoProf':
                              $status = '<span class="label label-primary" data-toggle="tooltip" title="Negado pelo professor!">NEGADO PELO PROFESSOR</span>';
                              $acao = 'Nenhuma.';
                              break;
                            case 'Pendente':
                              $status = '<span class="label label-warning" data-toggle="tooltip" title="Esse requerimento 
                                está sob analise da secretaria. Não possui validade!">PENDENTE</span>';
                              $acao = '<button class="btn btn-block btn-success btn-xs" data-toggle="modal" 
                                data-target="#simples" data-solict-id="'.$idReq.'" data-solict-tipo="3" 
                                data-solict-frase="Aprovar">APROVAR</button><button class="btn btn-block btn-danger btn-xs" 
                                data-toggle="modal" data-target="#negativo" data-solict-id="'.$idReq.'" data-solict-tipo="2" 
                                data-solict-frase="Negar">NEGAR</button>';
                              if($tipoReq == 4)
                                $acao = $acao.'<a href="/requerimentos/editar/'.$tipoReq.'/'.$idReq.'/" class="btn btn-block btn-default btn-xs" data-toggle="modal">EDITAR</a>';                         
                              break;
                            case 'Negado':
                              $status = '<span class="label label-danger" data-toggle="tooltip" title="Justificativa: '.$justificativaReq.'">NEGADO</span>';
                              $acao = 'Nenhuma.';
                              break;
                          }
                             echo '<tr align="center">
                               <td>'.$idReq.'</td>
                               <td>'.$matricula.'</td>
                               <td>'.$nome.'</td>
                               <td>'.$tipo.'</td>
                                <td>'.date('d/m/Y', strtotime($dataReq)).'</td>
                                <td>'.$status.'</td>
                                <td><a target="_blank" href="forms/form'.$tipoReq.'.php?id='.$idReq.'" 
                                 class="btn btn-primary btn-xs" data-toggle="modal"><i class="fa fa-file-pdf-o"></i></a>';
                              if($tipoReq == 3)
                                echo '<a target="_blank" href="getPdf.php?id='.$idReq.'" 
                                 class="btn btn-primary btn-xs" data-toggle="modal" style="margin-left: 2px;"><i class="fa fa-download"></i></a>';
                              echo '</td>
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

    <!-- NEGAR -->
    <div class="modal fade" id="negativo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="exampleModalLabel"></h4>
              </div>
              <form role="form" action="post.php" method="post" name="formulario" id="formulario">
                <input type="hidden" id="numPost" name="numPost" value="26"><!-- Número correspodente ao post -->
                <div class="modal-body">
                    <input type="hidden" name="id2" id="id2" />
                    <input type="hidden" name="acao2" id="acao2" />
                    <div class="form-group">
                      <label for="message-text" class="control-label">Justificativa: (obrigatorio)</label>
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
                <input type="hidden" id="numPost" name="numPost" value="26"><!-- Número correspodente ao post -->
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

    //DataTable
    $(function () {
      $('#example1').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ],
        columnDefs: [ {
            visible: false
        } ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "order": [[ 5, "desc" ],[ 0, "asc" ]],
        "info": false,
        "autoWidth": false,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
        }
      });
    });

    $('#simples').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var tipo = button.data('solict-tipo')
    var frase = button.data('solict-frase')
    var id = button.data('solict-id')
    var modal = $(this)
    modal.find('.modal-title').text(frase + ' - Requerimento ' + id)
        $('#id').val(id)
        $('#acao').val(tipo)
    })

    $('#negativo').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var tipo = button.data('solict-tipo')
    var frase = button.data('solict-frase')
    var id = button.data('solict-id') // Extract info from data-* attributes
    var modal = $(this)
    modal.find('.modal-title').text(frase + ' - Requerimento ' + id)
      $('#id2').val(id)
      $('#acao2').val(tipo)
    })
    </script>
  </body>
</html>
