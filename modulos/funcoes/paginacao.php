<?php
define('PAdjacente',3);
	
	if(isset($busca)){
		$get = "?busca=".$busca."&";
		if(isset($filtro)){
			$get .= "filtro=".$filtro."&";
		}
	}else if(isset($filtro)){
		$get = "?filtro=".$filtro."&";
	}else{
		$get = "?";
	}
	$get .= "pagina="; 
	if(isset($numPaginas) && $numPaginas > 1){
		echo '<div class="box-footer">
			<ul class="pagination pagination-sm no-margin pull-right">';
        if($pagina > 1){
          echo '<li><a href="'.$link.$get.($pagina - 1).'">&laquo;</a></li>';
	    }
	   $adjMe = $pagina-PAdjacente;
	   $adjMa = $pagina+PAdjacente;
	   if($adjMe > 1){
		   echo '<li><a href="'.$link.$get.'1">Primeira</a></li>
				<li class="disabled"><a> . . .</a></li>';
	   }else{
		   $adjMe = 1;
	   }
	   if($adjMa > $numPaginas){
		  $adjMa = $numPaginas;
	   }
       for($i = $adjMe; $i <= $adjMa; $i++) {
			if($i == $pagina){
				echo "<li class='active'><a href='".$get.$i."'>".$i."</a></li>";
			}else{
				echo "<li><a href='".$link.$get.$i."'>".$i."</a></li>";
			}
		}
		if($adjMa < $numPaginas){
			echo '<li class="disabled"><a> . . .</a></li>
				<li><a href="'.$link.$get.($numPaginas).'">Ultima</a></li>';
		}
         if($pagina < $numPaginas){
             echo '<li><a href="'.$link.$get.($pagina + 1).'">&raquo;</a></li>';
       }
       echo '</ul></div>';
	}
?>
