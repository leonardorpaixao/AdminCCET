<?php
  include '../../includes/topo.php';
?>
<title>AdminDcomp - Adicinar Equipamento</title>
</head>
<?php
  if(!$_SESSION['logado'] || ($_SESSION['afiliacao'] != 4 && $_SESSION['afiliacao'] != 2)){
    header('Location: /inicio');
  } 

  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $_SESSION['irPara'] = '/inicio';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Adicionar Equipamento
        <small>Recursos</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box" id="box">
        <form role="form" action="post/" method="post" name="formulario" id="formulario" class="formulario">
          <input type="hidden" id="numPost" name="numPost" value="11"><!-- Número correspodente ao post -->
          <div class="box-body">
            <div class="form-group col-xs-6">
              <label for="patrimonio">Patrimônio:</label>
              <input type="number" class="form-control" min="1" name="patrimonio" id="patrimonio">
            </div>
            <div class="form-group col-xs-6">
              <label for="modelo">Modelo:</label>
              <input type="text" class="form-control" name="modelo" id="modelo" placeholder="Ex: Projetor Samsung M250">
            </div>
            <div class="form-group col-xs-6">
            <label>Escolha o status:</label>
            <select name="status" class="form-control" >
              <option value="Ativo">Ativo</option>
              <option value="Inativo">Inativo</option>
            </select>
          </div>
           <div class="form-group col-xs-6">
            <label>Escolha o tipo:</label>
            <select name="tipo" class="form-control" id="tipoEq" onchange="NovoTipo(this.value);">
              <?php
              $db = Atalhos::getBanco();
              echo '<option value="">Selecionar Tipo</option>';
              echo '<option value="0">Adicinar Novo Tipo</option>';
               if ($query = $db->prepare("SELECT idTipoEq, tipoEq, numEq FROM tbtipoeq 
									WHERE numEq > 0 ORDER BY idTipoEq ASC")){
                  $query->execute();
                  $query->bind_result($idTipoEq, $tipoEq, $numEq);
                  while ($query->fetch()) {
                    echo '<option value="'.$idTipoEq.'">'.$tipoEq.'</option>';
                  }
                  $query->close();
                }
              ?>
            </select>
          </div>
            <div class="form-group" id="txtHint"></div>                  
          </div><!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.form.submit();">Adicionar</button>
            <a href="/recursos/equipamentos"<span class="btn btn-default">Cancelar</span></a>
          </div>
        </form>
      </div><!-- /.box -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <?php include '../../includes/rodape.php' ?>
</div><!-- ./wrapper -->
  <?php include '../../includes/script.php' ?>
<script>
  $('#box').find('.formulario').submit(function() {
    var patrimonio = $.trim($(this).find('#patrimonio').val());
    var modelo = $.trim($(this).find('#modelo').val());
    var tipoEq = $.trim($(this).find('#tipoEq').val());
    
    if(!(patrimonio.length != 0 && modelo.length != 0 && tipoEq != "")) {
        alert("Por favor, preencha todos os campos!");
        return false;
    }
  });
  function NovoTipo(str) {
		if(str != 0 || str == ''){
			document.getElementById("txtHint").innerHTML = "";
		}else{
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
				}else{
					result.innerHTML = "Erro: " + xmlreq.statusText;
				}
			};
			xmlhttp.open("GET","novotipo/Novo Tipo/novoTipo/",true);
			xmlhttp.send();
		}
	}
</script>
</body>
</html>
