<?php 
include '../../includes/atalhos.php';
$id = (isset($_GET['idTipoEq']))? $_GET['idTipoEq'] : NULL;
$name = (isset($_GET['name']))? $_GET['name'] : NULL;
$db = Atalhos::getBanco();
?>
<div class="form-group">
  Escolha a quantidade:
  <select name="<?php echo $name ?>" class="form-control">
    <?php
    	if ($query = $db->prepare("SELECT numEq FROM tbTipoEq WHERE idTipoEq = ?")){
    		$query->bind_param('i', $id);
    		$query->execute();
    		$query->bind_result($numEq);
    		$query->fetch();
    		$query->close;
    	}
      for($i = 1; $i <= $numEq; $i++) {
      	echo '<option value="'.$i.'">'.$i.'</option>';
      }
    ?>
  </select>
</div>
