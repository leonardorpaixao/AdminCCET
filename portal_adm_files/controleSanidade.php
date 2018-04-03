<?php 
  include 'topo.php'
 

?>
<title>AdminDcomp - Controle de Sanidade</title>

</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 0){
    header('Location: /inicio');
  }
  include 'barra.php';
  include 'menu.php' ;
  require 'verifica_sanity.php';
  $_SESSION['irPara'] = '/inicio';

  if(isset($_SESSION["user"])){
   unset($_SESSION["user"]); 
  }

  if(isset($_SESSION["password"])){
   unset($_SESSION["password"]); 
  }
?>

 


  <div class="content-wrapper">
    <section class="content-header">
      <h1>
          Controle de Sanidade
          <small>Laboratórios</small>
      </h1>
    </section>

        <!-- Main content -->
       <section class="content">
         <div class="row">
          <div class="col-xs-12">           
      
          
          <div  id="cont">

           
          
          <?php
        
            build_lab();
              //   teste();  ?>
           
          </div>
      

    </div>
  </div>
  </section>
  </div>


<script src="js/control_sanity.js"></script>   
<script src="js/control_sanity2.js"></script>    
<?php include 'rodape.php' ?>
<?php include 'script.php' ?>

</body>
</html>