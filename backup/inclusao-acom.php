    <?php 
    include 'topo.php';
    include 'barra.php';
    include 'menu.php';
    $_SESSION['irPara'] = '/inicio';
    $matricula = (isset($_GET['mat']))? $_GET['mat'] : NULL;
    $email = (isset($_GET['email']))? $_GET['email'] : NULL;
    $db = Atalhos::getBanco();
    $link = '/inclusao/acompanhar';
    $total = 0;
    if($matricula != NULL && $email != NULL){
      $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
      if ($query = $db->prepare("SELECT idInc FROM tbInclusao WHERE matricula = ? AND email = AES_ENCRYPT(?, ?)")){
          $query->bind_param('sss', $matricula, $email, $_SESSION['chave']);
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
          if ($query = $db->prepare("SELECT status, disciplina, codigo, turma, dataEnvio, motivo2 FROM tbInclusao WHERE matricula = ? AND email = AES_ENCRYPT(?, ?) ORDER BY dataEnvio ASC LIMIT ?,".NumReg)){
            $query->bind_param('sssi', $matricula, $email, $_SESSION['chave'], $inicio);
            $query->execute();
            $query->bind_result($status, $disciplina, $codigo, $turma, $dataEnvio, $motivo2);
          }
        }
    }
    ?>
      <title>AdminDcomp - Acompanhar requerimento</title> 
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
            Acompanhar requerimento
          </h1>
        </section>
       
        <section class="content">
      <div class="box-body table-responsive no-padding">
        <!-- Main content -->
          <!-- Default box -->
          <div class="box">
            <div class="box-body">
              <form action="" method="get">
                    <div class="form-group">
                      <label>Matrícula</label>
                      <input type="number" class="form-control" name="mat">
                    </div>
                    <div class="form-group">
                      <label>E-mail</label>
                      <input type="email" class="form-control" name="email">
                    </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Pesquisar situação</button>
                    </div>
              </form>
            </div>
          </div>
          <div class="box">
            <div class="box-body">
              <?php
                if($total == 0):
              ?>
                <div class="callout callout-warning">
                  <h4>Não encontramos nenhum requerimento com esse e-mail e/ou matrícula!</h4>
                </div>
              <?php
                else:
              ?>
              <table class="table table-hover">
                    <tr>
                      <th><center>Matrícula</center></th>
                      <th><center>Disciplina</center></th>
                      <th><center>Código</center></th>
                      <th><center>Turma</center></th>
                      <th><center>Data</center></th>
                      <th><center>Status</center></th>
                    </tr>
                    <?php
                      while($query->fetch()){
                        switch($status){
                        case 'Em análise':
                          $status2 = '<span class="label label-warning">EM ANÁLISE</span>';
                          break;
                        case 'Deferido':
                          $status2 = '<span class="label label-success">DEFERIDO</span>';      
                          break;
                        case 'Indeferido':
                          $status2 = '<span class="label label-danger" data-toggle="tooltip" data-original-title="'.$motivo2.'">INDEFERIDO</span>';
                          break;
                      }
                        echo '<tr align="center">
                               <td>'.$matricula.'</td>
                               <td>'.$disciplina.'</td>
                               <td>'.$codigo.'</td>
                               <td>'.$turma.'</td>
                                <td>'.date('d/m/Y H:i', $dataEnvio).'</td>
                                <td>'.$status2.'</td>
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

  
    <?php include 'script.php' ?>
  </body>
</html>
