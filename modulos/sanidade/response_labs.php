<?php 
include "verifica_sanity.php";


if(isset($_POST['lab']) and isset($_POST['pcs']) ){

	make_table($_POST['lab'],$_POST['pcs']);




}else{

	echo "oi";
}
?>