<?php 
  include 'topo.php';
  ?>
<title>AdminDcomp - Entregar Equipamento</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 1){
    header('Location: /inicio');
  }
  $_SESSION['irPara'] = '/inicio';
  $db = Atalhos::getBanco();
  include 'menu.php';
  include 'barra.php'; 
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Entregar Equipamento
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <form role="form" action="post.php" method="post">
          <input type="hidden" name="numPost" value="17"><!-- Número correspodente ao post -->
          <input type="hidden" name="idReEq" <?php echo 'value="'.$_GET['idReEq'].'"'?> >
          <input type="hidden" name="idData" <?php echo 'value="'.$_GET['idData'].'"'?> >
          <div class="box-body">
            <?php
              $j = 1;
              if ($query = $db->prepare("SELECT a.numReEq, b.tipoEq, a.idTipoEq 
                  FROM tbReservaTipoEq a inner join tbTipoEq b on a.idTipoEq = b.idTipoEq
                  WHERE a.idReEq = ?")){
                $query->bind_param('i', $_GET['idReEq']);
                $query->execute();
                $query->bind_result($numReEq, $tipoEq, $idTipoEq);
                $aux_db = Atalhos::getBanco();
                while($query->fetch()){
                  if($numReEq > 1){
                    for($i = 1; $i <= $numReEq; $i++){
                      if ($aux = $aux_db->prepare("SELECT patrimonio, modelo FROM tbEquipamento 
                        WHERE statusEq='Ativo' AND idTipoEq= ?")){
                        $aux->bind_param('i', $idTipoEq);
                        $aux->execute();
                        $aux->bind_result($patrimonio, $modelo);
                        echo'<div class="form-group">
                              <label>'.$tipoEq.' '.$i.':</label>
                            <select name="eqp'.$j++.'" class="form-control">
                              <option value="">Selecine o patrimonio do equipamento:</option>';
                        while($aux->fetch()){
                          echo '<option value="'.$patrimonio.'">'.$patrimonio.'</option>';
                        }
                        echo '</select>
                          </div>';
                      }
                      $aux->close();
                    }
                  }else{
                    if ($aux = $aux_db->prepare("SELECT patrimonio, modelo FROM tbEquipamento 
                      WHERE statusEq='Ativo' AND idTipoEq = ?")){
                      $aux->bind_param('i', $idTipoEq);
                      $aux->execute();
                      $aux->bind_result($patrimonio, $modelo);
                      echo'<div class="form-group">
                            <label>'.$tipoEq.':</label>
                          <select name="eqp'.$j++.'" class="form-control">
                            <option value="">Selecine o patrimonio do equipamento:</option>';
                      while($aux->fetch()){
                        echo '<option value="'.$patrimonio.'">'.$patrimonio.'</option>';
                      }
                      echo '</select>
                        </div>';
                     $aux->close();
                    }
                  }
                }
              }
              $query->close();
              $aux_db->close();
              $db->close();
            ?>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Confirmar</button>
            <button type="button" class="btn btn-default" onclick="Cancelar();">Cancelar</button>
          </div>
        </form>
      </div><!-- /.box -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <?php include 'rodape.php' ?>
</div><!-- ./wrapper -->
  <?php include 'script.php' ?>
<script language="JavaScript"> 
  function Cancelar(){
    window.location="moderar-eqp.php"; 
  }
</script> 
</body>
</html>
