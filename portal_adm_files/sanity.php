<?php 
  
  include 'topo.php';
 
?>
<title>AdminDcomp - Controle de Sanidade</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 0){
    header('Location: /inicio');
  }


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
        

} if ($i == ($x-1)) {
  $ips=$ips."$ip";
  }else{

    $ips=$ips."$ip-";
  }
  
}
$ips2='127.0.0.1-127.0.0.1';
$_SESSION['ips']=$ips;



  include 'barra.php';
  include 'menu.php' ;
  require   'verifica_sanity.php';
  $_SESSION['irPara'] = '/inicio';
?>

<div class="content-wrapper">
  <section class="content-header"> 
    <h1>
      <br>Controle de Sanidade</br>
      <small>
      <?php

        if(isset($_POST['lab'])){
          
        $aux=preg_split('[->]',$_POST['lab']); 
        $_SESSION['laboratorio']=$aux[0];
       
        
        $pcs_aux=preg_replace('[,]','', $aux[1]);
        
        $pcs=str_split($pcs_aux,2);
        
        $_SESSION['pcs1']=$pcs;; 
          

  }
      $lab=preg_replace('[-]', ' ',$_SESSION['laboratorio'] );
			echo "<h4><br>$lab</br></h4>";
      echo "<h5><br>PCs: ";
      for($i=0;$i<count($_SESSION['pcs1']);$i++){  
      echo $_SESSION['pcs1'][$i]." ";
    }
    echo "</br></h5>";
      //$_SESSION["pc"]=$pc;
      //$_SESSION["lab"]=$lab;
		

      ?>
		</small>
    </h1>
  </section>
<!-- Main content -->
  <section class="content">
    <?php include 'menuSanity.php'; ?>

     <div id="request"></div> 
    
    <div class="box-body">
      <?php 

       for($i=0;$i < count($_SESSION['pcs1']);$i++) {
             
             echo "<h3><br>PC " ;
             echo $_SESSION['pcs1'][$i];
             echo "</br></h3>";         
            sanity_tabela("pc".$_SESSION['pcs1'][$i]);
            //echo "</div></div>;      

            }

       


      ?>
    </div>
      
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
                    <span id="count"></span>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div><!-- /.example-modal -->
          
</div>
<script src="js/shell.js"></script>
<?php 
	include 'rodape.php';
   include 'script.php'; 
   ?>
   
    
  