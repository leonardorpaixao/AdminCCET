<?php
  include '../../includes/topo.php';
?>
<title>AdminDcomp - Atualizar Base</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 0){
    header('Location: /inicio');
  }
  include '../../includes/barra.php';
  include '../../includes/menu.php' ;
  $_SESSION['irPara'] = '/inicio';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Atualização da Base
      </h1>
      </section>
        <!-- Content Header (Page header) -->
      <section class="content">
        <?php
          if(isset($_SESSION['errorAtt'])):
        ?>
          <div class="callout callout-danger">
            <h4>Atualização não realizada!</h4>
            <p>Foi realizada uma atualização a menos de 12 horas.</p>
          </div>
        <?php
          unset($_SESSION['errorAtt']);
          elseif(isset($_SESSION['successAtt'])):
        ?>
          <div class="callout callout-success">
            <h4>Atualização realizada com sucesso!</h4>
            <p>Poderá ser feita uma nova atualização em 12 horas.</p>
          </div>
        <?php
            unset($_SESSION['successAtt']);
          endif;
        ?>
         <div class="box box-solid">
          <form action="post/" method="POST" id="formulario">
            <input type="hidden" id="numPost" name="numPost" value="47"/><!-- Número correspodente ao post -->
            <input type="hidden" id="idAssunto" name="idAssunto" value="6"/>
            <div class="box-body">
              <div>
                Esta seção é destinada à atualização da base de dados dos usuários. Visando a complexidade da operação, orientamos que seja feita em horários os quais o fluxo de usuários é pequeno.
                <br><br>
                O periodo entre atualizações é de 12 horas. <br><br>
                Última atualização realizada:<br>
                <?php
                  $db = atalhos::getBanco();
                  if ($query = $db->prepare("SELECT data FROM tbatualizacao ORDER BY idAtualizacao DESC LIMIT 1")){
                    $query->execute();
                    $query->bind_result($data);
                    $query->fetch();
                    $query->close();
                    $db->close();
                  }
                echo '<b>'.$data.'<b>';
                ?>
              </div>
            </div>
            <div class="box-footer">
              <?php
                  echo '<button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.form.submit();">Atualizar</button>';
              ?>
            </div>
          </form>
        </div>
      </section><!-- /.content -->
    </div><!-- /.container -->
  </div><!-- /.content-wrapper -->
  <?php include '../../includes/rodape.php' ?>
</div><!-- ./wrapper -->
  <?php include '../../includes/script.php' ?>
</body>
</html>
