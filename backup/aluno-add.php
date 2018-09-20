<?php
  include 'topo.php';
?>
<title>AdminDcomp - Adicionar Aluno</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 0){
    header('Location: /inicio');
  }
  include 'barra.php';
  include 'menu.php';
  $_SESSION['irPara'] = '/inicio';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Adicionar Aluno
        <small>Recursos</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#tab_1" data-toggle="tab">Individual</a>
          </li>
          <li>
            <a href="#tab_2" data-toggle="tab">Coletivo</a>
          </li>
        </ul>
        <div class="box" id="box">
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <form action="post.php" method="post">
                <input type="hidden" id="numPost" name="numPost" value="22"><!-- Número correspodente ao post -->        
                <div class="box-body">
                  <div class="form-group col-xs-6">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" id="nome">
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="CPF">CPF:</label>
                    <input type="number" class="form-control" name="cpf" id="cpf">
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="matricula">Matrícula:</label>
                    <input type="text" class="form-control" name="matricula" id="matricula">
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="email">E-mail:</label>
                    <input type="email" class="form-control" name="email" id="email">
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="email">Afiliação:</label>
                    <select name="idAfiliacao" id="idAfiliacao" class="form-control" onchange="NovoTipo(this.value);">
                      <?php
                        echo '<option value="">Selecionar Afiliação</option>';
                        echo '<option value="-1">Adicinar Nova Afiliação</option>';
                        $db = Atalhos::getBanco();
                        if ($query =  $db->prepare("SELECT idAfiliacao, afiliacao FROM tbafiliacao WHERE nivel = 4")){
                          $query->execute();                        
                          $query->bind_result($idAfiliacao, $afiliacao);
                          while($query->fetch()){
                            echo '<option value="'.$idAfiliacao.'">'.$afiliacao.'</option>';
                          }
                          $query->close();
                          $db->close();
                        }
                      ?>
                    </select>
                  </div>
                    <div class="form-group" id="txtHint"></div>                  
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Adicionar</button>
                  <a href="/recursos/alunos"><span class="btn btn-default">Cancelar</span></a>
                </div>
              </form>
            </div>
            <div class="tab-pane" id="tab_2">
              <form action="testeAdicinar.php" method="post" enctype="multipart/form-data">
                <input type="hidden" id="numPost" name="numPost" value="22"><!-- Número correspodente ao post -->        
                <div class="box-body">
                  <div class="form-group">
                    <select name="var1" id="var1" onchange="comboBox(1, this.value)">
                      <option value="-1"> Selecione a 1ª variavel</option>
                      <option value="nome"> Nome</option>
                      <option value="matricula"> Matricula</option>
                      <option value="curso"> Curso</option>
                      <option value="cpf"> CPF</option>
                      <option value="email"> Email</option>
                    </select>
                    <select name="var2" id="var2" onchange="comboBox(2, this.value)">
                      <option value="-1"> Selecione a 2ª variavel</option>
                      <option value="nome"> Nome</option>
                      <option value="matricula"> Matricula</option>
                      <option value="curso"> Curso</option>
                      <option value="cpf"> CPF</option>
                      <option value="email"> Email</option>
                    </select>
                    <select name="var3" id="var3" onchange="comboBox(3, this.value)">
                      <option value="-1"> Selecione a 3ª variavel</option>
                      <option value="nome"> Nome</option>
                      <option value="matricula"> Matricula</option>
                      <option value="curso"> Curso</option>
                      <option value="cpf"> CPF</option>
                      <option value="email"> Email</option>
                    </select>
                    <select name="var4" id="var4" onchange="comboBox(4, this.value)">
                      <option value="-1"> Selecione a 4ª variavel</option>
                      <option value="nome"> Nome</option>
                      <option value="matricula"> Matricula</option>
                      <option value="curso"> Curso</option>
                      <option value="cpf"> CPF</option>
                      <option value="email"> Email</option>
                    </select>
                    <select name="var5" id="var5" onchange="comboBox(5, this.value)">
                      <option value="-1"> Selecione a 5ª variavel</option>
                      <option value="nome"> Nome</option>
                      <option value="matricula"> Matricula</option>
                      <option value="curso"> Curso</option>
                      <option value="cpf"> CPF</option>
                      <option value="email"> Email</option>
                    </select>
                  </div>
                  <div class="form-group col-xs-3">
                    <label>Simbolo de separação:</label>
                    <input type="text" class="form-control" name="simbolo">
                  </div>
                  <div class="form-group col-xs-8">
                    <label>Selecione o Arquivo:</label>
                    <input type="file" name="arquivo">
                  </div>
                </div>
                <div class="box-footer">
                  <div class="form-group col-xs-12">
                    <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.form.submit();">Adicionar</button>
                    <a href="/recursos/alunos"><span class="btn btn-default">Cancelar</span></a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div><!-- /.box -->
      </div>
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
<?php include 'rodape.php' ?>
</div><!-- ./wrapper -->
  <?php include 'script.php' ?>
  <script type="text/javascript">

    /*function comboBox(combo){
      j = 1;
      alert("ok");
      for(i = 1; i < combo.length; i = i + 1){
        if(combo.selectedIndex != i){
          var aux = document.getElementById('var2');
          var opt = document.createElement("option");
          opt.value = combo.options[i].value;
          opt.text = combo.options[i].text;
          aux.add(opt, combo.options[j]);
          j++;
        }
      }
    }*/ 
  
    function comboBox(num, item){
      var index = document.getElementById('var'+num).selectedIndex;
      if(item != -1){
        for(var i = (num+1); i < 6; i++) {
          var id = 'var'+i;
          //reset(id, i);
          document.getElementById(id).remove(index);
        };
      }
    }

    /*function reset(id, num){
      var combo = document.getElementById(id);
      alert("id: "+id+" num: "+num);
      var opt0 = document.createElement("option");
      opt0.value = "-1";
      opt0.text = "Selecione a "+num+"ª variavel";
      combo.add(opt0, combo.options[0]);

      var opt1 = document.createElement("option");
      opt1.value = "0";
      opt1.text = "Nome";
      combo.add(opt1, combo.options[1]);

      var opt2 = document.createElement("option");
      opt2.value = "1";
      opt2.text = "Matricula";
      combo.add(opt2, combo.options[2]);

      var opt3 = document.createElement("option");
      opt3.value = "2";
      opt3.text = "Curso";
      combo.add(opt3, combo.options[3]);

      var opt4 = document.createElement("option");
      opt4.value = "3";
      opt4.text = "CPF";
      combo.add(opt4 combo.options[4]);

      var opt5 = document.createElement("option");
      opt5.value = "4";
      opt5.text = "Email";
      combo.add(opt5, combo.options[5]);
    }*/

    $('#box').find('.formulario').submit(function() {
        var nome = $.trim($(this).find('#nome').val());
        var cpf = $.trim($(this).find('#cpf').val());
        var matricula = $.trim($(this).find('#matricula').val());
        var email = $.trim($(this).find('#email').val());
        var idAfiliacao = $.trim($(this).find('#idAfiliacao').val());

        
        if(!(nome.length != 0 && cpf.length != 0 && matricula.length != 0 && email.length != 0 && idAfiliacao != "")) {
            alert("Por favor, preencha todos os campos!");
            return false;
        }
    });
    function NovoTipo(str) {

      if(str != -1 || str == ''){
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
        xmlhttp.open("GET","novoTipo.php?nome=Nova Afiliação&name=novaAfiliacao",true);
        xmlhttp.send();
      }
    }
  </script>
</body>
</html>
