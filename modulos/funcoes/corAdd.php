<?php 
  include '../../includes/topo.php';
  ?>
<title>AdminDcomp - Adicionar Cor</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] > 1){
    header('Location: /inicio');
  }
  $_SESSION['irPara'] = '/inicio';
  include '../../includes/menu.php';
  include '../../includes/barra.php';
  $db = Atalhos::getBanco();
  if ($query = $db->prepare("SELECT cor FROM tbCor")){
    $query->execute();
    $query->bind_result($cor);
  } 
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Adicinar Cor
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <form role="form" action="post/" method="post">
          <div class="box-body">
          <label>Cores cadastradas:</label><br>
          <?php
            $j = 1;
            while($query->fetch()){
              echo ' <span class="label" style="background-color: '.$cor.';font-size: 12pt;">Cor '.$j.'</span>';
              $j++;
            }
            $query->close();
            $db->close();
          ?>
            <div class="form-group col-md-6">
            <?php if(isset($_POST['pcs'])): ?>
              <input type="hidden" name="numPost" value="19"><!-- Número correspodente ao post -->
              <input type="hidden" name="nome" <?php echo 'value="'.$_POST['nome'].'"' ?>/>
              <input type="hidden" name="pcs" <?php echo 'value="'.$_POST['pcs'].'"' ?>/>
              <input type="hidden" name="capacidade" <?php echo 'value="'.$_POST['capacidade'].'"' ?>/>
              <input type="hidden" name="status" <?php echo 'value="'.$_POST['status'].'"' ?>/>
            <?php elseif(isset($_POST['patrimonio'])): ?>
              <input type="hidden" name="numPost" value="19"><!-- Número correspodente ao post -->
              <input type="hidden" name="patrimonio" <?php echo 'value="'.$_POST['patrimonio'].'"' ?>/>
              <input type="hidden" name="modelo" <?php echo 'value="'.$_POST['modelo'].'"' ?>/>
              <input type="hidden" name="statusEq" <?php echo 'value="'.$_POST['status'].'"' ?>/>
              <input type="hidden" name="novoTipo" <?php echo 'value="'.$_POST['novoTipo'].'"' ?>/>
            <?php else: ?>
              <input type="hidden" name="numPost" value="19"><!-- Número correspodente ao post -->
              <input type="hidden" name="nome" <?php echo 'value="'.$_POST['nome'].'"' ?>/>
              <input type="hidden" name="cap" <?php echo 'value="'.$_POST['cap'].'"' ?>/>
              <input type="hidden" name="status" <?php echo 'value="'.$_POST['status'].'"' ?>/>
            <?php endif; ?>
              <br><label>Escolha uma cor:</label>
              <div class="input-group my-colorpicker2">
                <input type="text" name="cor" class="form-control"/>
                <div class="input-group-addon">
                  <i></i>
                </div>
              </div><!-- /.input group -->
            </div><!-- /.form group -->
          </div><!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.form.submit();">Confirmar</button>
          </div>
        </form>
      </div><!-- /.box -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <?php include '../../includes/rodape.php' ?>
</div><!-- ./wrapper -->
  <?php include '../../includes/script.php' ?>
</body>
</html>
