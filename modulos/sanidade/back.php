<?php

include '../../includes/atalhos.php';

/* colocando a senha padrão
if($query = $db->prepare("INSERT INTO tblabpasswd (passwd) VALUES (AES_ENCRYPT(?, ?))")){
                  echo "dntro do if";
                  $query->bind_param('ss',$senha,$_SESSION['chave']);
                  $query->execute();
                  $query->close();
}

/*
$results_array = array();
$nome;
if($query = $db->prepare("SELECT AES_DECRYPT (passwd,?)  from tblabpasswd order by id desc")){
			 echo "dentro";
			 $query->bind_param('s', $_SESSION['chave']);
             $query->execute();
			 $query->bind_result($nome);
			 while($query->fetch()){
			 	$results_array []=$nome;
			 } 
  			 	
		}
		else{

			echo "errou";
		}

		
		$db->close();
		$_SESSION["password"]=Atalhos::encode($results_array[0]);
		#$_SESSION["password"]=Atalhos::encode(implode('-',$results_array));
*/


	if(isset($_POST['kill'])){
	$comando=exec("kill -9 $(pgrep execute_shell.p)",$saida,$status);
	echo $saida[0];
	echo "processo cancelado..voltando ao inicio";

}
	header("Location: https://admin.dcomp.ufs.br/sanidade");
?>
