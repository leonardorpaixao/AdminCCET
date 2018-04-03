<?php 
	$_SESSION["pcs1"];
  
    $_SESSION["laboratorio"];
    
	?>
<div class="row">
	
    <style>
  .modal-header, .close {
      background-color: #009FA6;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-footer {
      background-color: #f9f9f9;
  }
  </style>

    <div class="col-xs-12">
		<div class="box-body">
			<a data-toggle="tooltip" title="Voltar à página de sanidade" class="btn btn-app" href="/sanidade" >
			<i class="fa  fa-reply-all" ></i>Voltar
			</a>

			<a data-toggle="tooltip" 
            title="Log" class="btn btn-app" href="/sanidade2/" >
			 <i class="fa  fa-file-text-o"></i>
          Log
      </a>          
       <a data-toggle='tooltip'  title='Ver informações sobre pacotes' class='btn btn-app'>
            <i class="fa fa-list"></i> Pacotes
         
         </a>
      <a   data-toggle="tooltip" title="Atualizar estado da máquina" class="btn btn-app">
            	<i class="fa fa-refresh"></i> Atualizar 
      </a>          
         	
      <a   data-toggle='tooltip' href="/shell/" class='btn btn-app'  >
	            
         	<i class="fa  fa-desktop"></i>Shell          
      </a>
                                 
        
      <a   data-toggle='tooltip' href="/utilitarios/" class='btn btn-app'  >

            <i class="fa  fa-wrench"></i>Extras
      </a>
      
      <a data-toggle="tooltip"  title="Desligar máquina" onclick="get_request('shutdown now -h')" class="btn btn-app">
         	<i class="fa  fa-power-off"></i>
          Desligar
         </a>
		</div>  
	   
      

    </div>



</div>  