<?php
	include '../../includes/topo.php';
?>
<title>AdminDcomp - Shell</title>
</head>

<?php
	
	if(isset($_POST['kill'])){
		
		$comando=exec("pkill -n sshd");
		
		
		unset($_POST['kill']);	
	}
	
	if(!(isset($_SESSION["user"]))){
			
		$_SESSION["user"]="root";	
	}
	if(!(isset($_SESSION["password"]))){
		$db = Atalhos::getBanco();
		$results_array = array();
		if($query = $db->prepare("SELECT AES_DECRYPT (passwd,?)  from tblabpasswd order by id desc")){
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
		
		$_SESSION["password"]=Atalhos::encode(implode('-',$results_array));
	}
	
	
	
	$laboratorio=preg_replace('[-]', ' ',$_SESSION['laboratorio'] );
	//echo "$laboratorio";
	//consultando o banco para definir a sub-rede
	$db = Atalhos::getBanco();
	if($query = $db->prepare("SELECT subRede  from tbLaboratorio WhERE nomeLab=?")){
		$query->bind_param('s', $laboratorio);
		$query->execute();
		$query->bind_result($subRede);
		$query->fetch();
		$query->close();
	}

	$db->close();

	//definindo o ip
	$x=count($_SESSION['pcs1']);
	
	$subRede=$subRede."#";
	#echo $subRede;
	$ips="";
for($i=0;$i<$x;$i++){
	switch ($_SESSION['pcs1'][$i]) {
    case "01":
    	$ip =preg_replace('/.0#/','.1',$subRede);     
        break;
    case "02":
        $ip =preg_replace('/.0#/','.2',$subRede);
        break;
    case "03":
        $ip =preg_replace('/.0#/','.3',$subRede);
        break;
    case "04":
        
        $ip =preg_replace('/.0#/','.4',$subRede);
        break;
    case "05":
        $ip =preg_replace('/.0#/','.5',$subRede);
        break;
    case "06":
        $ip =preg_replace('/.0#/','.6',$subRede);
        break;
    case "07":
        $ip =preg_replace('/.0#/','.7',$subRede);
        break;
    case "08":
        $ip =preg_replace('/.0#/','.8',$subRede);
        break;
    case "09":
        $ip =preg_replace('/.0#/','.9',$subRede);
        break;
    default:
    	$ip =preg_replace('/.0#/',".".$_SESSION['pcs1'][$i],$subRede);	
        

}	if ($i == ($x-1)) {
	$ips=$ips."$ip";
	}else{

		$ips=$ips."$ip-";
	}
	
}
//variavel para testes localmente
$ips2='127.0.0.1';
$_SESSION['ips']=$ips;

#echo $_SESSION['ips'] ;
//echo " IP: $ips ";

//teste localhost
	/*$ip2='127.0.0.1';
	// O ip será definido mais a frente, no momento insira-o nesta var	
	$object = new ssh($ip2, $_SESSION["user"],Atalhos::decode($_SESSION["password"]));
	$object->create_connection();
	if($object->autentication() == FALSE) {
			echo '<script> alert("Login não autorizado! Por favor, 
				contate o suporte."); </script>';
	}
	*/
	include '../../includes/barra.php';
	$_SESSION['irPara'] = '/inicio';
	
	
?>
	<body>
		<?php include '../../includes/menu.php'; ?>
		<div class="content-wrapper">
			<section class="content-header">
      		<h1>
      			Executar comandos
        			<small>Shell</small>
      		</h1>
    		</section>
			<section class="content">
				<?php include 'menuSanity.php'; ?>
					<ul> <p class="text-red">Dicas:</p>
					<li> <p class="text-aqua">Instalar pacotes: pacman -Sy [nome do pacote]  --noconfirm --needed;</p></li>
					<li><p class="text-aqua"> Para mais de um comando usar ";"(ls -l; echo "exemplo";reboot)</p></li>
				</ul>

				<h3>Digite um comando abaixo:</h3>
				
					<div class="form-group">
                      <label>Digite os comandos</label>
                      <textarea id="comandos" class="form-control" rows="5"></textarea>
                    	<button class="btn btn-primary" type="button" onclick="get_request()"  id="botao">Executar</button>
                    	
                    </div>		
                    
                    


					
				<div id="request"></div>




			</section>


			<div class="example-modal">
            <div id="mymodal" class="modal modal-info">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    
                    <h4 class="modal-title">Executando comando(s), aguarde...</h4>
                  </div>
                  <div class="modal-body">
	                   <div class="progress progress active">
	                    <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
	                    </div>
	                  </div>  
                  </div>
                  <div class="modal-footer">
                  	<button class="btn  btn-danger btn-xs" type="button" onclick="interrupt()">Abortar</button> &nbsp; (Atenção a interrupção pode acarretar riscos)
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div><!-- /.example-modal -->



		</div>


		<script src="../../js/shell.js"></script>    

	<?php 
		include '../../includes/script.php';
		include '../../includes/rodape.php';
		
	?>
	</body>
</html>




				