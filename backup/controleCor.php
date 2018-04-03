<?php 
  include 'topo.php';]
?>
<title>AdminDcomp - Gerenciar Cores</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 1){
    header('Location: /inicio');
  }
  $_SESSION['irPara'] = '/inicio';
  $db = Atalhos::getBanco();

  if($query = $db->prepare("SELECT idCor, cor FROM tbCor")){
    $query->execute();
    $query->bind_result($idCor, $cor);
  } 
  include 'menu.php';
  include 'barra.php'; 
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gerenciar Cores
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <form role="form" action="post.php" method="post">
          <input type="hidden" name="numPost" value="20"><!-- Número correspodente ao post -->
          <div class="box-body">
            <div class="form-group col-md-6">
              <table class="table table-hover">
                <tr>
                  <th><center>Cor</center></th>
                  <th><center>Ação</center></th>
                </tr>
                <?php $j = 1;
                  while($query->fetch()){
                    echo "<tr align='center'>";
                    echo '<td><span class="label" style="background-color: '.$cor.';font-size: 14pt;">Cor '.$j.'</span></td>';
                    echo '<td><a href="gerenciar-cores/editar/'.$idCor.'/">
                      <button class="btn btn-default">Editar</button></a></td>';
                    $j++;
                    echo '</tr>';
                  }
                  $query->close();
                  $db->close();
                ?>
              </table>
            </div><!-- /.form group -->
          </div><!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Confirmar</button>
          </div>
        </form>
      </div><!-- /.box -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <?php include 'rodape.php' ?>
</div><!-- ./wrapper -->
  <?php include 'script.php' ?>
</body>
</html>
