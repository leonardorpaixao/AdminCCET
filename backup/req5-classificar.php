  <?php
    include 'topo.php';
  ?>
  <title>AdminDcomp - Classificar Inclusão em Disciplina</title> 
    </head>    
  <?php
    if(!$_SESSION['logado'] || $_SESSION['nivel'] != 1){
      header('Location: /inicio');
    }
    include 'barra.php';
    include 'menu.php';
    $_SESSION['irPara'] = '/requerimentos/classificar';
    $db = Atalhos::getBanco();
    $link = '/requerimentos/classificar';
    if($query = $db->prepare("SELECT a.idReq, a.dataReq, a.statusReq, a.tipoReq, a.conteudoReq, a.justificativaReq, b.matricula FROM tbrequerimentos a JOIN tbmatricula b ON a.idUser = b.idUser AND a.tipoReq = 5 UNION SELECT a.idReq, a.dataReq, a.statusReq, a.tipoReq, a.conteudoReq, a.justificativaReq, b.matricula FROM tbrequerimentos a JOIN tbtemporarios b ON a.idTemp = b.idTemp AND a.tipoReq = 5")){
      $query->execute();
      $query->bind_result($idReq, $dataReq, $statusReq, $tipoReq, $conteudoReq, $justificativaReq, $matricula);
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
            Classificar
            <small>Inclusão em Disciplina</small>
          </h1>
        </section>
       
        <section class="content">
      <div class="box-body">

        <!-- Main content -->
          <!-- Default box -->
          <div class="box">
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped display nowrap" cellspacing="0" >
                  <thead>
                    <tr>
                      <th><center>ID</center></th>
                      <th><center>Matricula</center></th>
                      <th><center>Disciplina</center></th>
                      <th><center>Turma</center></th>
                      <th><center>Período</center></th>
                      <th><center>Prioridade</center></th>
                      <th><center>Reprovou/Trancou</center></th>
                      <th><center>IEA</center></th>
                      <th><center>PDF</center></th>
                      <th><center>Data</center></th>
                      <th><center>Status</center></th>
                      <th><center>Ação</center></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th><center>ID</center></th>
                      <th><center>Matricula</center></th>
                      <th><center>Disciplina</center></th>
                      <th><center>Turma</center></th>
                      <th><center>Período</center></th>
                      <th><center>Prioridade</center></th>
                      <th><center>Reprovou/Trancou</center></th>
                      <th><center>IEA</center></th>
                      <th><center>PDF</center></th>
                      <th><center>Data</center></th>
                      <th><center>Status</center></th>
                      <th><center>Ação</center></th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                      while($query->fetch()){
                        switch ($tipoReq) {
                          case 5:
                            $tipo = 'Requerimento de Inclusão em Disciplina';
                            break;
                          default:
                            $tipo = 'Erro!';
                            break;
                        }
                        switch($statusReq){
                            case 'Aprovado':
                              $status = '<span class="label label-success" data-toggle="tooltip" title="Esse requerimento 
                                já foi aceito e está validado pelo DCOMP.">APROVADO</span>';
                              $acao = 'Nenhuma.';
                              break;
                            case 'Pendente':
                              $status = '<span class="label label-warning" data-toggle="tooltip" title="Esse requerimento 
                                está sob analise da secretaria. Não possui validade!">PENDENTE</span>';
                              $acao = '<button class="btn btn-block btn-success btn-xs" data-toggle="modal" 
                                data-target="#simples" data-solict-id="'.$idReq.'" data-solict-tipo="3" 
                                data-solict-frase="Aprovar">APROVAR</button><button class="btn btn-block btn-danger btn-xs" 
                                data-toggle="modal" data-target="#negativo" data-solict-id="'.$idReq.'" data-solict-tipo="2" 
                                data-solict-frase="Negar">NEGAR</button><button class="btn btn-block btn-info btn-xs" 
                                data-toggle="modal" data-target="#negativo" data-solict-id="'.$idReq.'" data-solict-tipo="4" 
                                data-solict-frase="Cancelar">CANCELAR</button>';                         
                              break;
                            case 'Negado':
                              $status = '<span class="label label-danger" data-toggle="tooltip" title="Esse documento possui
                               erros, edite-o para consertar. Motivo: '.$justificativaReq.'">NEGADO</span>';
                              $acao = 'Nenhuma.';
                              break;
                            case 'Cancelado':
                              $status = '<span class="label label-info" data-toggle="tooltip">CANCELADO</span>';
                              $acao = 'Nenhuma.';
                              break;
                          }
                            $conteudo = explode("/+", $conteudoReq);
                             echo '<tr align="center">
                               <td>'.$idReq.'</td>
                               <td>'.$matricula.'</td>
                               <td>'.$conteudo[4].'</td>
                               <td>'.$conteudo[5].'</td>
                               <td>'.$conteudo[0].'</td>
                               <td>'.$conteudo[1].'</td>
                               <td>'.$conteudo[2].'</td>
                               <td>'.$conteudo[3].'</td>
                               <td><a target="_blank" href="getPdf.php?id='.$idReq.'" 
                                 class="btn btn-primary btn-xs" data-toggle="modal"><i class="fa fa-download"></i></a></td>
                                <td>'.date('d/m/Y', strtotime($dataReq)).'</td>
                                <td>'.$status.'</td>
                                <td>'.$acao.'</td>
                              </tr>';
                      }
                    ?>
                    </tbody>
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
      var table = $('#example1').DataTable({
        initComplete: function () {
            this.api().columns([2,3]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
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
            'colvis',
            {
                text: 'Negar selecionados',
                action: function ( e, dt, node, config ) {
                    var rows = table.rows('.active').data();
                    var total = rows.length;
                    var tudo = '';
                    for(var i = 0;i<total;i++){
                      tudo += rows[i][0];
                      if(i != (total-1))
                        tudo += ',';
                    }
                    alert(tudo);
                    //alert( table.rows('.active').data().length +' row(s) selected' );
                }
            }
        ],
        columnDefs: [ {
            visible: false
        }],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "orderFixed": [[ 2, "asc" ],[ 3, "asc" ],[ 5, "asc" ],[ 6, "asc" ],[ 7, "desc" ]],
        "info": false,
        "autoWidth": false,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
        }
      });


      $('#example1 tbody').on( 'click', 'tr', function () {
          $(this).toggleClass('active');
      } );
   
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
