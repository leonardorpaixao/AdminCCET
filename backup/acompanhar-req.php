  <?php
      include 'topo.php';
  ?>
  <title>AdminDcomp - Acompanhar Requerimentos</title> 
    </head>     
  <?php
    include 'barra.php';
    include 'menu.php';
    $_SESSION['irPara'] = '/inclusao/acompanhar';
    $link = '/inclusao/acompanhar';
    $_SESSION['irPara'] = '/inicio';
    $matricula = (isset($_GET['matricula']))? $_GET['matricula'] : NULL;
    $email = (isset($_GET['email']))? $_GET['email'] : NULL;
    $veriMat = (isset($_GET['veriMat']))? $_GET['veriMat'] : NULL;
    
    $db = Atalhos::getBanco();
    
    $total = 0;
    if($matricula != NULL && $email != NULL && $veriMat == 1){
      $semRequerimento = 1; 
      if ($query = $db->prepare("SELECT a.idReq FROM tbRequerimentos a INNER JOIN tbTemporarios b on a.idTemp = b.idTemp AND b.matricula = ? AND b.email = AES_ENCRYPT(?, ?)")){
          $query->bind_param('sss', $matricula, $email, $_SESSION['chave']);
          $query->execute();
          $query->store_result();
          $total = $query->num_rows;
        }
        if($total > 0){
          $query->free_result();
          $query->close();
          if ($query = $db->prepare("SELECT a.statusReq, a.dataReq, a.tipoReq, a.justificativaReq FROM tbRequerimentos a INNER JOIN tbTemporarios b on a.idTemp = b.idTemp AND b.matricula = ? AND b.email = AES_ENCRYPT(?, ?) ORDER BY dataReq ASC")){
            $query->bind_param('sss', $matricula, $email, $_SESSION['chave']);
            $query->execute();
            $query->bind_result($status, $dataEnvio, $tipo, $motivo2);
          }
          unset($semRequerimento);
        }
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
            Requerimentos
            <small>Acompanhar</small>
          </h1>
        </section>
       
        <section class="content">
      <div class="box-body">
        <!-- Main content -->
          <!-- Default box -->
          <div class="box">
            <div class="box-body" id="forminsere">
              <form action="" method="get" class="formulario" autocomplete="off">
                    <div class="form-group">
                      <label>Matrícula</label>
                      <input type="number" class="form-control" name="matricula" id="matricula">
                    </div>
                    <div class="form-group">
                      <button type="button" class="btn btn-default" onclick="testeMatricula();">Verificar matrícula</button>
                    </div>
                    <div id="matResp" name="matResp"></div>
              </form>
            </div>
          </div>
          <?php
            if(isset($semRequerimento)):
          ?>
              <div class="callout callout-danger">
                <p>Nenhum requerimento encontrado com essas informações.</p>
              </div>
          <?php
            unset($semRequerimento);
            endif;
          ?>
          <?php
            if($total > 0){
          ?>
          <div class="box">
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th><center>Matrícula</center></th>
                      <th><center>Tipo</center></th>
                      <th><center>Data</center></th>
                      <th><center>Status</center></th>
                    </tr>
                  </thead> 
                    <?php
                      while($query->fetch()){
                        switch($status){
                          case 'Pendente':
                            $status2 = '<span class="label label-warning">EM ANÁLISE</span>';
                            break;
                          case 'Aprovado':
                            $status2 = '<span class="label label-success">DEFERIDO</span>';      
                            break;
                          case 'Negado':
                            $status2 = '<span class="label label-danger" data-toggle="tooltip" data-original-title="'.$motivo2.'">INDEFERIDO</span>';
                            break;
                        }

                        switch($tipo){
                          case 3:
                            $tipoReq = 'Atividades Complementares';
                            break;
                          case 5:
                            $tipoReq = 'Inclusão em Disciplina';
                            break;
                          case 7:
                            $tipoReq = 'Requerimento Geral';
                            break;
                        }

                        echo '<tr align="center">
                               <td>'.$matricula.'</td>
                               <td>'.$tipoReq.'</td>
                                <td>'.date('d/m/Y', strtotime($dataEnvio)).'</td>
                                <td>'.$status2.'</td>
                              </tr>';
                      }
                    ?>
              </table>
            </div>
          </div><!-- /.box -->
          <?php
            }
          ?>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
        <?php include 'rodape.php' ?>
     </div><!-- ./wrapper -->

  
    <?php include 'script.php' ?>

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

      $('#forminsere').find('.formulario').submit(function() {
        testeMatricula();
        $("#botaoPesquisar").attr("disabled","disabled");
        var matricula = $.trim($(this).find('#matricula').val());
        var email = $.trim($(this).find('#email').val());
        var veriMat = $.trim($(this).find('#veriMat').val());
        if(!(matricula.length != 0 && email.length != 0 && veriMat == 1)) {
            $("#botaoPesquisar").attr("disabled",false);
            alert("Por favor, preencha todos os campos!");
            return false;
        }
    });

      function testeMatricula() {
        var matricula = document.getElementById("matricula").value;
        if(matricula == '' || matricula.length != 12){
          document.getElementById("matResp").innerHTML = "<div class='callout callout-danger'><p>Digite uma matrícula válida (12 dígitos).</p></div>";
        }else{
          if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
          } else {
              // code for IE6, IE5
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function(){
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("matResp").innerHTML = xmlhttp.responseText;
            }else{
              result.innerHTML = "Erro: " + xmlhttp.statusText;
            }
          };
          xmlhttp.open("GET","verifica_matricula.php?tipo=buscar&matricula="+matricula,true);
          xmlhttp.send();
        }
      }
    </script>
  </body>
</html>
