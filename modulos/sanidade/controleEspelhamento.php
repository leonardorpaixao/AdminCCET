<?php

function listar_pacotes(){

	$pacote="null"; //auxiliar
	$file = fopen($_SERVER['DOCUMENT_ROOT']."log/lista.txt", "r+") or die("Unable to open file!"); //abrindo arquivo da lista
	echo	"<table class=\"table table-hover\">\n                          
	                    <tr>\n
	                      <th>Nome do Pacote</th>\n
	                      <th>Opção<th>\n
	                    </tr>\n"; //cabecalho da tabela
	
// Corpo da tabela
  	while(!feof($file)) {
  		$pacote =trim(fgets($file));
  		if($pacote != "" ){
  		echo  "<tr>
	          <td>$pacote</td>\n 
	          <td><button  onclick=\"del('$pacote')\" class=\"btn btn-danger btn-xs\">\n";
	    echo  "excluir</button></td>\n
	          </tr>";
	    }      

	}

	fclose($file);  //fechando arqquivo	                    
	
	echo "</table>"; //fechando tabela

}


function add_pacote($nome_pacote){
	
	$file = fopen($_SERVER['DOCUMENT_ROOT']."log/lista.txt", "a") or die("Unable to open file!"); //abrindo arquivo

	fwrite($file,PHP_EOL."$nome_pacote"); //adicionando no final
	
	fclose($file);                //fechando arquivo;


}

function excluir_pacote($nome_pacote){

	$delete=$nome_pacote;

	$lines = file($_SERVER['DOCUMENT_ROOT']."log/lista.txt");

 	$out = array();

 	foreach($lines as $line) {
    	 if(trim($line) != $delete) {
        	 $out[] = $line;
  		   }
 	}
	$fp = fopen($_SERVER['DOCUMENT_ROOT']."log/lista.txt", "w+");
 	
 	flock($fp, LOCK_EX);
 
 	foreach($out as $line) {
     	fwrite($fp, $line);
 	}
 	flock($fp, LOCK_UN);
 	fclose($fp);  

}

//recebendo posts
if( isset($_POST['op']) ){  
	
	if( $_POST['op'] == 0 ) 	
	{	
		listar_pacotes();
	}
	if($_POST['op'] == 1)
	{
		add_pacote($_POST['pacote']);
	}
	if($_POST['op'] == 2)
	{
		excluir_pacote($_POST['pac']);
	}	
}

else{

	echo "erro";
}



























?>