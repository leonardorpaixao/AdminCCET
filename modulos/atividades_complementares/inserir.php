<?php
  include '../../includes/topo.php';
?>
<title>AdminDcomp - Abrir Processo</title>
</head>
<?php
  if(!$_SESSION['logado'] || $_SESSION['nivel'] != 4){
    header('Location: /inicio');
  }
  include '../../includes/barra.php';
  include '../../includes/menu.php';
  $_SESSION['irPara'] = '/inicio';
  $db = Atalhos::getBanco();
  if ($query = $db->prepare("SELECT b.nomeUser, AES_DECRYPT(b.email,?), c.afiliacao, e.matricula
      FROM tbUsuario b
      inner join tbAfiliacao c on b.idAfiliacao = c.idAfiliacao
      inner join tbMatricula e on b.idUser = e.idUser
      WHERE b.idUser = ?")){
    $query->bind_param('si', $_SESSION['chave'], $_SESSION['id']);                
    $query->execute();
    $query->bind_result($nomeUser, $email, $afiliacao, $matricula);
    $query->fetch();
    $query->close();
  }

  if ($query = $db->prepare("SELECT AES_DECRYPT(numTelefone,?) FROM tbTelefone WHERE idUser = ?")){
    $query->bind_param('si', $_SESSION['chave'], $_SESSION['id']);
    $query->execute();
    $query->bind_result($numTelefone);
    $query->fetch();
    $query->close();
  }
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Abrir Processo Eletrônico
        <small>Atividades Complementares</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="box" id="forminsere">
            <div class="box-header with-border">
                  <h3 class="box-title">Dados básicos</h3>
            </div>
                <form role="form" action="post/" method="post" class="formulario" autocomplete="off" enctype="multipart/form-data">
                  <input type="hidden" id="numPost" name="numPost" value="58"><!-- Número correspodente ao post -->
                  <input type="hidden" id="acao" name="acao" value="1"><!-- Número correspodente ao tipo -->                
                  <div class="box-body">
                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" class="form-control" name="nome" value="<?php echo $nomeUser; ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label>Matrícula</label>
                      <input type="text" class="form-control" name="matricula" value="<?php echo $matricula; ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label>Curso</label>
                      <input type="text" class="form-control" name="curso" value="<?php echo $afiliacao; ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label>Telefone</label>
                      <input type="text" class="form-control" name="telefone" value="<?php echo $numTelefone; ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label>E-mail</label>
                      <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" disabled>
                    </div>
                  </div><!-- /.box-body -->
            <div class="box-header with-border">
                <h3 class="box-title">Documentos Necessários</h3>
            </div>
              <div class="box-body">
                <p>Atenção usuário! Durante o andamento do processo eletrônico, principalmente no início, serão exigidos diversos documentos que comprovem a sua solicitação para Atividades Complementares. Logo abaixo você poderá visualizar uma lista com os documentos que normalmente são solicitados, lembrando que TODOS devem estar no formato PDF.</p>
                <p>
                  <ul>
                    <li>RG e CPF;</li>
                    <li>Certificados de participação em Congressos, Cursos, Palestras, etc;</li>
                    <li>Certificado de participação em projetos de extensão ou pesquisa.</li>
                  </ul>
                </p>
                <p><i>Se o seu documento estiver em formato de imagem (JPEG, JPG, PNG, GIF), você pode realizar a conversão online por meio de ferramentas como o Imagetopdf (<a href="http://imagetopdf.com/pt/" target="_blank">http://imagetopdf.com/pt/</a>). <b>Não nos responsabilizamos pela utilização de sites terceiros, incluindo o indicado anteriormente.</b></i></p>
                
                <div class="checkbox">
                  <label>
                    <input type="checkbox" required="required"> Confirmo que estou ciente dos documentos que serão exigidos e que eles deverão estar no formato PDF.
                  </label>
                </div>
                
              </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Abrir Processo Eletrônico</button>
                  </div>
                  </form>
          </div><!-- /.box -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
<?php include '../../includes/rodape.php' ?>
</div><!-- ./wrapper -->
  <?php include '../../includes/script.php' ?>
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
        xmlhttp.open("GET","novotipo/Nova Afiliação/novaAfiliacao/",true);
        xmlhttp.send();
      }
    }
  </script>
</body>
</html>
