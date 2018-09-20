<?php
	include 'topo.php';
?>
<title>AdminDcomp - Ferramentas</title>
</head>

<?php

	if(!(isset($_SESSION["user"]))){
		$_SESSION["user"]= "root";	
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
	if($query = $db->prepare("SELECT subRede  from tblaboratorio WhERE nomeLab=?")){
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
$ips2='127.0.0.1-127.0.0.1';
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
	include 'barra.php';
	include 'menu.php';
	$_SESSION['irPara'] = '/inicio';
	
	?>
	<div class="content-wrapper">
			<section class="content-header">
      		<h1>
      			Executar comandos
        			
      		</h1>
    		</section>
			<section class="content">
				<?php include 'menuSanity.php'; ?>
				<div class="box-body">			
				<small>Atalhos :</small>
				
				<!--Primeira-->
				<div class="row-fluid">
					<div class="form-group col-xs-2">
						
							<!--Botões de Comandos-->
							<input type="hidden" value="who -u" name="cmd">
							<button type="button" onclick="get_request('who -u')" class="btn bg-purple margin"
								title="Verificar quais usuários estão logados no Linux.">
								Usuários On</button>
					</div>
					<div class="form-group col-xs-2">
						
							<input type="hidden" value="last" name="cmd">
							<button type="button" onclick="get_request('last')" class="btn bg-purple margin"
								title="Verificar Histórico dos Últimos Usuários que efetuaram Login">
								Usuários Off</button>
						
					</div>
					<div class="form-group col-xs-2">
						
							<input type="hidden" value="uname -a" name="cmd">
							<button type="button" onclick="get_request('uname -a')" class="btn bg-purple margin"
								title="Mostra breve informações do Sistema Operacional e Kernel">
								S.O e Kernel</button>
							<br>
						
					</div>
					<div class="form-group col-xs-2">
						
							<input type="hidden" value="lsmod" name="cmd">
							<button type="button" onclick="get_request('lsmod')" class="btn bg-purple margin"
								title="Verificar módulos carregados na Memória">
								Módulos On</button>
							<br>
						
					</div>
					<div class="form-group col-xs-2">
						
							<input type="hidden" value="cat /proc/cmdline" name="cmd">
							<button type="button" onclick="get_request('cat /proc/cmdline')" class="btn bg-purple margin"
								title="Mostra informações dos parâmetros utilizados para inicializar o sistema(Boot)">
								Boot Info</button>
							<br>
						
					</div>
					<div class="form-group col-xs-2">
						
							<input type="hidden" value="pstree -hlp" name="cmd">
							<button type="button" onclick="get_request('pstree -hlp')" class="btn bg-purple margin"
								title="Mostra a Árvore/Hierarquia de Processos que estão rodando">
								Árvore Proc.</button>
							<br>
						
					</div>
				</div>	
					<!--Segunda-->
				<div class="row-fluid">
						<div class="form-group col-xs-2">
							
								<!--Botões de Comandos-->
								<input type="hidden" value="uname -m" name="cmd">
								<button type="button" onclick="get_request('uname -m')" class="btn bg-purple margin"
									title="Verificar se o sistema é 32 Bits(i386, i486,i586 e i686) ou 64 Bits(x86_64).">
									Arquitetura S.O</button>
							</form>
						</div>
						<div class="form-group col-xs-2">
							
								<input type="hidden" value="cat /proc/meminfo" name="cmd">
								<button type="button" onclick="get_request('cat /proc/meminfo')" class="btn bg-purple margin"
									title="Verificar informações sobre a memória RAM.">
									Memória RAM</button>
							
						</div>
						<div class="form-group col-xs-2">
							
								<input type="hidden" value="cat /proc/iomem" name="cmd">
								<button type="button" onclick="get_request('cat /proc/iomem')" class="btn bg-purple margin"
									title="Verificar informações sobre a memória de I/O">
									Memória de I/O</button>
								<br>
							
						</div>
						<div class="form-group col-xs-2">
							
								<input type="hidden" value="cat /proc/stat" name="cmd">
								<button type="button" onclick="get_request('cat /proc/stat')" class="btn bg-purple margin"
									title="Verificar estado atual do processador.">
									Status Proc.</button>
								<br>
							
						</div>
						<div class="form-group col-xs-2">
								<input type="hidden" value="cat /proc/filesystems" name="cmd">
								<button type="button" onclick="get_request('cat /proc/filesystems')" class="btn bg-purple margin"
									title="Verificar sistemas de arquivos suportados pelo sistema.">
									Sis. de Arq.</button>
								<br>
						</div>
						<div class="form-group col-xs-2">
							
								<input type="hidden" value="cat /proc/vmstat" name="cmd">
								<button type="button" onclick="get_request('cat /proc/vmstat')" class="btn bg-purple margin"
									title="Mostra informações sobre o uso de Memória Virtual.">
									Mem. Virtual</button>
								<br>
							
						</div>
					
						<div class="form-group col-xs-2">
								<button type="button" onclick="get_passwd()" class="btn bg-purple margin"
									title="Configuração de Senha.">
									gerenciar Senha(root)</button>
								<br>
							
						</div>

						<div class="form-group col-xs-2">
								<button type="button"  class="btn bg-purple margin" onclick="show_list()">
									Espelhamento</button>
								<br>
							
						</div>


				</div>
			</div>
			<div id="request"></div>
				
				
		
		
	</section>


		<div class="example-modal">
            <div id="lista" class="modal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Lista de pacotes</h4>
                  </div>
                  <div id="bodylist" class="modal-body">
                    
                  <div id="tabela" class="box-body table-responsive no-padding">
	                  
                	</div>
                  </div>
                  <div class="modal-footer">
                  
                    <button type="button" onclick="espelha()" class="btn btn-success btn-sm pull-left" >espelhar</button>
	                <div class="col-sm-offset-6">
	                <div class="input-group input-group-xs pull-right">
                    	<input type="text" placeholder="nome do pacote" id="nomepacote" class="form-control">
                    	<span class="input-group-btn">
                      	<button class="btn btn-info btn-flat"  onclick="add_pacote()"  type="button">add novo</button>
                    	</span>
                  </div>
              </div>
	                    
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div><!-- /.example-modal -->
      </div>











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


<script src="js/shell.js"></script>
<script src="js/controlpw.js"></script>

<?php
	include 'rodape.php';
	include 'script.php';
?>
</html>