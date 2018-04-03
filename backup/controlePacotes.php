<?php 
  include 'topo.php';
  include 'barra.php';
  include 'menu.php' ;
  require   'verifica_sanity.php';
  $_SESSION['irPara'] = 'index.php';
?>

 
  <div class="content-wrapper">
       

        <!-- Main content -->
       <section class="content">
         <div class="row">
          <div class="col-xs-12">           
      
            <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Atenção!</h4>
                    Tenha certeza do que está prestes a fazer
                  </div>



     <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Inserir  Novo Pacote no Espelho </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form">

                  <div class="box-body">
                    
                    <div class="form-group">
                      <label for="exampleInputFile">Selecionar Pacote</label>
                      <input type="file" id="exampleInputFile">
                      <p class="help-block">Pacotes ".pkg.xz"</p>
                    </div>
                    <div class="checkbox">
                                          </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
      </div>
    
  </div>
  </section>
  </div>    



  

<script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js" type="text/javascript"></script>
<?php include 'rodape.php' ?>
  

 