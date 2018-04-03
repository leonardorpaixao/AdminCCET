        <?php
          include 'topo.php';
        ?>
        <title>AdminDcomp - Cadastro de Estágio</title>
        </head>
        <?php
          include 'barra.php';
          include 'menu.php';
          if($_SESSION['logado']){
            $acao = (isset($_GET['acao']))? $_GET['acao'] : 'inserir';
            $id = (isset($_GET['id']))? $_GET['id'] : NULL;
            $db = Atalhos::getBanco();

            if ($query = $db->prepare("SELECT b.nomeUser, b.email, c.afiliacao, e.matricula
                FROM tbUsuario b
                inner join tbAfiliacao c on b.idAfiliacao = c.idAfiliacao
                inner join tbMatricula e on b.idUser = e.idUser
                WHERE b.idUser = ?")){
              $query->bind_param('i', $_SESSION['id']);
              $query->execute();
              $query->bind_result($nomeUser, $email, $afiliacao, $matricula);
              $query->fetch();
              $query->close();
            }

            if ($query = $db->prepare("SELECT numTelefone FROM tbTelefone WHERE idUser = ?")){
              $query->bind_param('i', $_SESSION['id']);
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
            Cadastro de Estágio
            <small>Requerimentos</small>
          </h1>
        </section>
        <?php
          // FORMULÁRIO PARA INSERÇÃO
          if($acao == 'inserir'){
        ?>
  
        <!-- Main content -->
        <section class="content">

      <?php
          if(isset($_SESSION['avisoReqs'])):
        ?>
            <div class="callout callout-success">
              <h4>Requerimento enviado com sucesso!</h4>
              <p>Acesse a <a href="/requerimentos/meus">página de requerimentos</a> para visualizar, editar e acompanhar a sua solicitação.</p>
            </div>
        <?php
          unset($_SESSION['avisoReqs']);
          endif;
        ?>
          <!-- Default box -->
          <div class="box" id="forminsere">

            <div class="box-header with-border">
              <h3 class="box-title">Dados básicos</h3>
            </div>

            <form role="form" action="post.php" method="post" class="formulario">
              <input type="hidden" id="numPost" name="numPost" value="20"><!-- Número correspodente ao post -->
              <input type="hidden" id="tipoReq" name="tipoReq" value="2"><!-- Número correspodente ao tipo -->
              <div class="box-body">
                <div class="form-group">
                  <label>Nome</label>
                  <input type="text" class="form-control" value="<?php echo $nomeUser; ?>" disabled>
                </div>
                <div class="form-group">
                  <label>Matrícula</label>
                  <input type="text" class="form-control" value="<?php echo $matricula; ?>" disabled>
                </div>
              </div><!-- /.box-body -->

              <div class="box1">
                <div class="box-header with-border">
                  <h3 class="box-title">Dados da Instituição</h3>
                </div>
                <div class="box-body">
                  <div class="form-group">
                    <label>Tipo de Instituição</label>
                    <div class="radio">
                      <label>
                        <input type="radio" name="inst-tipo" id="inst-tipo" value="Federal"/>
                        Federal
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="inst-tipo" id="inst-tipo" value="Estadual"/>
                        Estadual
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="inst-tipo" id="inst-tipo" value="Municipal"/>
                        Municipal
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="inst-tipo" id="inst-tipo" value="Privada"/>
                        Privada
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Instituição é um Agente de Integração</label>
                    <div class="radio">
                      <label>
                        <input type="radio" name="inst-agente" id="inst-agente" value="Sim"/>
                        Sim
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="inst-agente" id="inst-agente" value="Não"/>
                        Não
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="inst-nome" id="inst-nome">
                  </div>
                  <div class="form-group">
                    <label>CPF/CNPJ (somente números)</label>
                    <input type="number" class="form-control" name="inst-cnpj" id="inst-cnpj">
                  </div>
                  <div class="form-group">
                    <label>Logradouro</label>
                    <input type="text" onkeyup="limitarInput(this, 40)" class="form-control" name="inst-logradouro" id="inst-logradouro">
                  </div>
                  <div class="form-group">
                    <label>Número</label>
                    <input type="number" onkeyup="limitarInput(this, 5)" class="form-control" name="inst-numero" id="inst-numero">
                  </div>
                  <div class="form-group">
                    <label>Bairro</label>
                    <input type="text" onkeyup="limitarInput(this, 15)" class="form-control" name="inst-bairro" id="inst-bairro">
                  </div>
                  <div class="form-group">
                    <label>Complemento</label>
                    <input type="text" onkeyup="limitarInput(this, 20)" class="form-control" name="inst-complemento" id="inst-complemento">
                  </div>
                  <div class="form-group">
                    <label>Cidade/UF</label>
                    <input type="text" onkeyup="limitarInput(this, 15)" class="form-control" name="inst-cidadeuf" id="inst-cidadeuf">
                  </div>
                  <div class="form-group">
                    <label>E-mail Institucional</label>
                    <input type="text" onkeyup="limitarInput(this, 30)" class="form-control" name="inst-email" id="inst-email">
                  </div>
                  <div class="form-group">
                    <label>Telefone fixo</label>
                    <input type="text" name="inst-tel1" id="inst-tel1" class="form-control" data-inputmask='"mask": "(99) 99999999"' data-mask/>
                  </div>
                  <div class="form-group">
                    <label>Telefone celular</label>
                    <input type="text" name="inst-tel2" id="inst-tel2" class="form-control" data-inputmask='"mask": "(99) 99999999"' data-mask/>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <div class="box2">
                <div class="box-header with-border">
                  <h3 class="box-title">Dados do responsável pela Instituição</h3>
                </div>
                <div class="box-body">
                  <div class="form-group">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="instresp-nome" id="instresp-nome">
                  </div>
                  <div class="form-group">
                    <label>CPF (somente números)</label>
                    <input type="number" class="form-control" name="instresp-cpf" id="instresp-cpf">
                  </div>
                  <div class="form-group">
                    <label>RG (somente números)</label>
                    <input type="number" class="form-control" name="instresp-rg" id="instresp-rg">
                  </div>
                  <div class="form-group">
                    <label>Órgão de Expedição</label>
                    <input type="text" class="form-control" name="instresp-rgorgao" id="instresp-rgorgao">
                  </div>
                   <div class="form-group">
                    <label>UF</label>
                    <input type="text" class="form-control" name="instresp-uf" id="instresp-uf">
                  </div>
                  <div class="form-group">
                    <label>Data de Nascimento</label>
                    <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask name="instresp-data" id="instresp-data"/>
                  </div>
                  <div class="form-group">
                    <label>Sexo</label>
                    <select name="instresp-sexo" class="form-control">
                      <option value="Masculino">Masculino</option>
                      <option value="Feminino">Feminino</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Cargo</label>
                    <input type="text" class="form-control" name="instresp-cargo" id="instresp-cargo">
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <div class="box3">
                <div class="box-header with-border">
                  <h3 class="box-title">Dados do estágio</h3>
                </div>
                <div class="box-body">
                  <div class="form-group">
                    <label>Tipo de Estágio</label>
                    <select name="est-tipo" class="form-control">
                      <option value="Estágio Curricular Obrigatório">Estágio Curricular Obrigatório</option>
                      <option value="Estágio Curricular Não Obrigatório">Estágio Curricular Não Obrigatório</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Carga horária semanal (em horas)</label>
                    <input type="number" class="form-control" name="est-horas" id="est-horas">
                  </div>
                  <div class="form-group">
                    <label>Valor da Bolsa (ao mês)</label>
                    <input type="number" class="form-control" name="est-bolsavalor" id="est-bolsavalor">
                  </div>
                  <div class="form-group">
                    <label>Valor Aux. Transporte (ao mês)</label>
                    <input type="number" class="form-control" name="est-transpvalor" id="est-transpvalor">
                  </div>
                  <div class="form-group">
                    <label>Data de Início do Estágio</label>
                    <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask name="est-comeco" id="est-comeco"/>
                  </div>
                  <div class="form-group">
                    <label>Data de Fim do Estágio</label>
                    <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask name="est-fim" id="est-fim"/>
                  </div>

                  <script type="text/javascript">
                function id(el) {
                  return document.getElementById(el);
                }
                function mostra(element) {
                  if (element.value) {
                    id(element.value).style.display = 'block';
                  }
                }
                function esconde_todos($element, tagName) {
                  var $elements = $element.getElementsByTagName(tagName),
                      i = $elements.length;
                  while(i--) {
                    $elements[i].style.display = 'none';
                  }
                }
                window.addEventListener('load', function() {
                  var $Nao = id('Nao'),
                      $Sim = id('Sim'),
                      $tiporeserva  = id('est-seguro');
                  esconde_todos(id('palco'), 'div');
                  mostra($tiporeserva);
                  $tiporeserva.addEventListener('change', function() {
                    esconde_todos(id('palco'), 'div');
                    mostra(this);
                  });
                });
                </script>
                <div class="form-group">
                  <label>Seguro contra Acidentes Pessoais pela Concedente</label>
                  <select name="est-seguro" id="est-seguro" class="form-control">
                    <option value="Nao">Não</option>
                    <option value="Sim">Sim</option>
                  </select>
                </div>
                  <div id="palco">
                    <div id="Sim">
                      <label>CNPJ</label>
                      <input type="number" class="form-control" name="est-segurocnpj">
                      <label>Seguradora</label>
                      <input type="text" class="form-control" name="est-seguronome">
                      <label>Apólice</label>
                      <input type="text" class="form-control" name="est-seguroapolice">
                      <label>Valor do Seguro</label>
                      <input type="number" class="form-control" name="est-segurovalor">
                    </div>
                    <div id="Nao"></div>
                  </div>
                  <div class="form-group">
                    <label>Nome do Supervisor Técnico</label>
                    <input type="text" class="form-control" name="est-supervisor" id="est-supervisor">
                  </div>
                  <div class="form-group">
                    <label>CPF (somente números)</label>
                    <input type="number" class="form-control" name="est-supervisorcpf" id="est-supervisorcpf">
                  </div>
                  <div class="form-group">
                    <label>E-mail</label>
                    <input type="text" class="form-control" name="est-supervisoremail" id="est-supervisoremail">
                  </div>
                  <div class="form-group">
                    <label>Área de Atuação</label>
                    <input type="text" class="form-control" name="est-supervisorarea" id="est-supervisorarea">
                  </div>
                  <div class="form-group">
                    <label>Formação</label>
                    <input type="text" class="form-control" name="est-supervisorformacao" id="est-supervisorformacao">
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <div class="box4">
                <div class="box-header with-border">
                  <h3 class="box-title">Proposta de Horário de Atividade</h3>
                </div>
                  <div class="box-body">
                    <div class="form-group">
                      <div style="width: 20%;float:left;text-align: center;border-right: 1px solid black;">
                        <label style="width: 100%">Segunda</label>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>M</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="2mi" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="2mo" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>T</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="2ti" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="2to" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>N</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="2ni" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="2no" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                      </div>

                      <div style="width: 20%;float:left;text-align: center;border-right: 1px solid black;">
                        <label style="width: 100%">Terça</label>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>M</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="3mi" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="3mo" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>T</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="3ti" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="3to" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>N</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="3ni" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="3no" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                      </div>

                      <div style="width: 20%;float:left;text-align: center;border-right: 1px solid black;">
                        <label style="width: 100%">Quarta</label>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>M</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="4mi" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="4mo" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>T</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="4ti" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="4to" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>N</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="4ni" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="4no" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                      </div>

                      <div style="width: 20%;float:left;text-align: center;border-right: 1px solid black;">
                        <label style="width: 100%">Quinta</label>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>M</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="5mi" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="5mo" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>T</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="5ti" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="5to" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>N</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="5ni" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="5no" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                      </div>

                      <div style="width: 20%;float:left;text-align: center;">
                        <label style="width: 100%">Sexta</label>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>M</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="6mi" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="6mo" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>T</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="6ti" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="6to" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>N</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="6ni" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="6no" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                      </div>
                    </div> <!-- /.form-group -->
                  </div><!-- /.box-body -->
                  </div><!-- /.box -->

              <div class="box5">
                <div class="box-header with-border">
                  <h3 class="box-title">Plano de trabalho<div id="contador"></div></h3>
                </div>
                <div class="box-body">
                  <textarea onkeyup="limitarInput(this, 3700)" maxlenght="3700" name="plano" id="plano" class="form-control" rows="15" cols="auto"></textarea>
                </div>
              </div><!-- /.box -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="botaoEnviar">Enviar requerimento</button>
              </div>
            </form>
          </div><!-- /.box -->

        </section><!-- /.content -->
        <?php
          }
          //FORMULÁRIO PARA EDIÇÃO
        elseif($acao == 'edit' && (!is_null($id))){


            if($query = $db->prepare("SELECT a.conteudoReq, b.nomeUser,  AES_DECRYPT(b.email, ?), c.afiliacao, a.tipoReq, b.idUser, a.statusReq, e.matricula
                        FROM tbRequerimentos a
                        inner join tbUsuario b on a.idUser = b.idUser
                          inner join tbAfiliacao c on b.idAfiliacao = c.idAfiliacao
                          inner join tbMatricula e on b.idUser = e.idUser
                          WHERE a.idReq = ?")){
              $query->bind_param('si', $_SESSION['chave'], $id);
              $query->execute();
              $query->bind_result($conteudoReq, $nomeUser, $email, $afiliacao, $tipoReq, $idUser, $statusReq, $matricula);
              $query->fetch();
              $query->close();
            }
            if ($query = $db->prepare("SELECT AES_DECRYPT(numTelefone, ?) FROM tbTelefone WHERE idUser = ?")){
              $query->bind_param('si', $_SESSION['chave'], $idUser);
              $query->execute();
              $query->bind_result($numTelefone);
              $query->fetch();
              $query->close();
            }
            $conteudo = explode("/-", $conteudoReq);
            $i = explode("/+", $conteudo[0]);
            $ir = explode("/+", $conteudo[1]);
            $est = explode("/+", $conteudo[2]);
            $h = explode("/+", $conteudo[3]);
              if(($_SESSION['nivel'] == '1' || $_SESSION['id'] == $idUser) && ($statusReq != 'Aprovado') && ($tipoReq == 2)){
        ?>
        <!-- Main content -->
        <section class="content">
        <?php
          if(isset($_SESSION['avisoReqs'])):
        ?>
            <div class="callout callout-success">
              <h4>Requerimento editado com sucesso!</h4>
              <p>Acesse a <a href="requerimentos/meus">página de requerimentos</a> para visualizar, editar e acompanhar a sua solicitação.</p>
            </div>
        <?php
          unset($_SESSION['avisoReqs']);
          endif;
        ?>
          <!-- Default box -->
          <div class="box" id="formedita">
            <div class="box-header with-border">
                  <h3 class="box-title">Dados básicos</h3>
            </div>
                <form role="form" action="post.php" method="post" class="formulario">
                  <input type="hidden" id="numPost" name="numPost" value="21"><!-- Número correspodente ao post -->
                  <input type="hidden" id="tipoReq" name="tipoReq" value="2"><!-- Número correspodente ao tipo -->
                  <input type="hidden" id="idReq" name="idReq" value="<?php echo $id; ?>"><!-- Número correspodente ao ID-->
                  <div class="box-body">
                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" class="form-control" value="<?php echo $nomeUser;?>" disabled>
                    </div>
                    <div class="form-group">
                      <label>Matrícula</label>
                      <input type="text" class="form-control" value="<?php echo $matricula;?>" disabled>
                    </div>
                  </div><!-- /.box-body -->


                  </div>
                  <div class="box">
                    <div class="box-header with-border">
                          <h3 class="box-title">Dados da Instituição</h3>
                    </div>
                  <div class="box-body">
                    <div class="form-group">
                      <label>Tipo de Instituição</label>
                      <div class="radio">
                        <label>
                          <input type="radio" name="inst-tipo" id="inst-tipo" value="Federal" <?php if($i[0] == 'Federal') echo 'checked';?>/>
                          Federal
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="inst-tipo" id="inst-tipo" value="Estadual" <?php if($i[0] == 'Estadual') echo 'checked';?>/>
                          Estadual
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="inst-tipo" id="inst-tipo" value="Municipal" <?php if($i[0] == 'Municipal') echo 'checked';?>/>
                          Municipal
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="inst-tipo" id="inst-tipo" value="Privada" <?php if($i[0] == 'Privada') echo 'checked';?>/>
                          Privada
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Instituição é um Agente de Integração</label>
                      <div class="radio">
                        <label>
                          <input type="radio" name="inst-agente" id="inst-agente" value="Sim" <?php if($i[1] == 'Sim') echo 'checked';?>/>
                          Sim
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="inst-agente" id="inst-agente" value="Não" <?php if($i[1] == 'Não') echo 'checked';?>/>
                          Não
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" class="form-control" name="inst-nome" id="inst-nome" value="<?php echo $i[2];?>" required>
                    </div>
                    <div class="form-group">
                      <label>CPF/CNPJ (somente números)</label>
                      <input type="number" class="form-control" name="inst-cnpj" id="inst-cnpj" value="<?php echo $i[3];?>" required>
                    </div>
                    <div class="form-group">
                      <label>Logradouro</label>
                      <input type="text" onkeyup="limitarInput(this, 40)" class="form-control" name="inst-logradouro" id="inst-logradouro" value="<?php echo $i[4];?>" required>
                    </div>
                    <div class="form-group">
                      <label>Número</label>
                      <input type="number" onkeyup="limitarInput(this, 5)" class="form-control" name="inst-numero" id="inst-numero" value="<?php echo $i[5];?>" required>
                    </div>
                    <div class="form-group">
                      <label>Bairro</label>
                      <input type="text" onkeyup="limitarInput(this, 15)" class="form-control" name="inst-bairro" id="inst-bairro" value="<?php echo $i[6];?>" required>
                    </div>
                    <div class="form-group">
                      <label>Complemento</label>
                      <input type="text" onkeyup="limitarInput(this, 20)" class="form-control" name="inst-complemento" id="inst-complemento" value="<?php echo $i[7];?>" required>
                    </div>
                    <div class="form-group">
                      <label>Cidade/UF</label>
                      <input type="text" onkeyup="limitarInput(this, 15)" class="form-control" name="inst-cidadeuf" id="inst-cidadeuf" value="<?php echo $i[8];?>" required>
                    </div>
                    <div class="form-group">
                      <label>E-mail Institucional</label>
                      <input type="text" onkeyup="limitarInput(this, 30)" class="form-control" name="inst-email" id="inst-email" value="<?php echo $i[9];?>" required>
                    </div>
                    <div class="form-group">
                      <label>Telefone fixo</label>
                      <input type="text" name="inst-tel1" id="inst-tel1" class="form-control" value="<?php echo $i[10];?>" data-inputmask='"mask": "(99) 99999999"' data-mask required/>
                    </div>
                    <div class="form-group">
                      <label>Telefone celular</label>
                      <input type="text" name="inst-tel2" id="inst-tel2" class="form-control" value="<?php echo $i[11];?>" data-inputmask='"mask": "(99) 99999999"' data-mask required/>
                    </div>
                  </div><!-- /.box-body -->

                  </div>
                  <div class="box">
                    <div class="box-header with-border">
                          <h3 class="box-title">Dados do responsável pela Instituição</h3>
                    </div>
                  <div class="box-body">
                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" class="form-control" name="instresp-nome" id="instresp-nome" value="<?php echo $ir[0];?>" required>
                    </div>
                    <div class="form-group">
                      <label>CPF (somente números)</label>
                      <input type="number" class="form-control" name="instresp-cpf" id="instresp-cpf" value="<?php echo $ir[1];?>" required>
                    </div>
                    <div class="form-group">
                      <label>RG (somente números)</label>
                      <input type="number" class="form-control" name="instresp-rg" id="instresp-rg" value="<?php echo $ir[2];?>" required>
                    </div>
                    <div class="form-group">
                      <label>Órgão de Expedição</label>
                      <input type="text" class="form-control" name="instresp-rgorgao" id="instresp-rgorgao" value="<?php echo $ir[3];?>" required>
                    </div>
                     <div class="form-group">
                      <label>UF</label>
                      <input type="text" class="form-control" name="instresp-uf" id="instresp-uf" value="<?php echo $ir[4];?>" required>
                    </div>
                    <div class="form-group">
                      <label>Data de Nascimento</label>
                      <input type="text" class="form-control" value="<?php echo $ir[5];?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask name="instresp-data" id="instresp-data" required/>
                    </div>
                    <div class="form-group">
                      <label>Sexo</label>
                      <select name="instresp-sexo" class="form-control">
                        <option value="Masculino" <?php if($ir[6] == 'Masculino') echo 'selected';?>>Masculino</option>
                        <option value="Feminino" <?php if($ir[6] == 'Feminino') echo 'selected';?>>Feminino</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Cargo</label>
                      <input type="text" class="form-control" name="instresp-cargo" id="instresp-cargo" value="<?php echo $ir[7];?>" required>
                    </div>
                  </div><!-- /.box-body -->

                  </div>
                  <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Dados do estágio</h3>
                </div>
                  <div class="box-body">
                    <div class="form-group">
                      <label>Tipo de Estágio</label>
                      <select name="est-tipo" class="form-control">
                        <option value="Estágio Curricular Obrigatório" <?php if($est[0] == 'Estágio Curricular Obrigatório') echo 'selected';?>>Estágio Curricular Obrigatório</option>
                        <option value="Estágio Curricular Não Obrigatório" <?php if($est[0] == 'Estágio Curricular Não Obrigatório') echo 'selected';?>>Estágio Curricular Não Obrigatório</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Carga horária semanal (em horas)</label>
                      <input type="number" class="form-control" name="est-horas" id="est-horas" value="<?php echo $est[1];?>" required>
                    </div>
                    <div class="form-group">
                      <label>Valor da Bolsa (ao mês)</label>
                      <input type="number" class="form-control" name="est-bolsavalor" id="est-bolsavalor" value="<?php echo $est[2];?>" required>
                    </div>
                    <div class="form-group">
                      <label>Valor Aux. Transporte (ao mês)</label>
                      <input type="number" class="form-control" name="est-transpvalor" id="est-transpvalor" value="<?php echo $est[3];?>" required>
                    </div>
                    <div class="form-group">
                      <label>Data de Início do Estágio</label>
                      <input type="text" class="form-control" value="<?php echo $est[4];?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask name="est-comeco" id="est-comeco" required/>
                    </div>
                    <div class="form-group">
                      <label>Data de Fim do Estágio</label>
                      <input type="text" class="form-control" value="<?php echo $est[5];?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask name="est-fim" id="est-fim" required/>
                    </div>
                    <div class="form-group">
                      <label>Seguro contra Acidentes Pessoais pela Concedente</label>
                      <select name="est-seguro" class="form-control">
                        <option value="Não" <?php if($est[6] == 'Não') echo 'selected';?>>Não</option>
                        <option value="Sim" <?php if($est[6] == 'Sim') echo 'selected';?>>Sim</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>CNPJ</label>
                      <input type="number" class="form-control" name="est-segurocnpj" value="<?php echo $est[7];?>">
                    </div>
                    <div class="form-group">
                      <label>Seguradora</label>
                      <input type="text" class="form-control" name="est-seguronome" value="<?php echo $est[8];?>">
                    </div>
                    <div class="form-group">
                      <label>Apólice</label>
                      <input type="text" class="form-control" name="est-seguroapolice" value="<?php echo $est[9];?>">
                    </div>
                    <div class="form-group">
                      <label>Valor do Seguro</label>
                      <input type="number" class="form-control" name="est-segurovalor" value="<?php echo $est[10];?>">
                    </div>
                    <div class="form-group">
                      <label>Nome do Supervisor Técnico</label>
                      <input type="text" class="form-control" name="est-supervisor" id="est-supervisor" value="<?php echo $est[11];?>" required>
                    </div>
                    <div class="form-group">
                      <label>CPF (somente números)</label>
                      <input type="number" class="form-control" name="est-supervisorcpf" id="est-supervisorcpf" value="<?php echo $est[12];?>">
                    </div>
                    <div class="form-group">
                      <label>E-mail</label>
                      <input type="text" class="form-control" name="est-supervisoremail" id="est-supervisoremail" value="<?php echo $est[13];?>" required>
                    </div>
                    <div class="form-group">
                      <label>Área de Atuação</label>
                      <input type="text" class="form-control" name="est-supervisoremail" id="est-supervisoremail" value="<?php echo $est[14];?>" required>
                    </div>
                    <div class="form-group">
                      <label>Formação</label>
                      <input type="text" class="form-control" name="est-supervisorformacao" id="est-supervisorformacao" value="<?php echo $est[15];?>" required>
                    </div>
                  </div><!-- /.box-body -->

                  </div>
                  <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Proposta de Horário de Atividade</h3>
                </div>
                  <div class="box-body">
                    <div class="form-group">
                      <div style="width: 20%;float:left;text-align: center;border-right: 1px solid black;">
                        <label style="width: 100%">Segunda</label>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>M</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="2mi" value="<?php echo $h[0];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="2mo" value="<?php echo $h[1];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>T</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="2ti" value="<?php echo $h[2];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="2to" value="<?php echo $h[3];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>N</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="2ni" value="<?php echo $h[4];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="2no" value="<?php echo $h[5];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                      </div>

                      <div style="width: 20%;float:left;text-align: center;border-right: 1px solid black;">
                        <label style="width: 100%">Terça</label>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>M</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="3mi" value="<?php echo $h[6];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="3mo" value="<?php echo $h[7];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>T</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="3ti" value="<?php echo $h[8];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="3to" value="<?php echo $h[9];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>N</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="3ni" value="<?php echo $h[10];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="3no" value="<?php echo $h[11];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                      </div>

                      <div style="width: 20%;float:left;text-align: center;border-right: 1px solid black;">
                        <label style="width: 100%">Quarta</label>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>M</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="4mi" value="<?php echo $h[12];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="4mo" value="<?php echo $h[13];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>T</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="4ti" value="<?php echo $h[14];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="4to" value="<?php echo $h[15];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>N</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="4ni" value="<?php echo $h[16];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="4no" value="<?php echo $h[17];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                      </div>

                      <div style="width: 20%;float:left;text-align: center;border-right: 1px solid black;">
                        <label style="width: 100%">Quinta</label>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>M</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="5mi" value="<?php echo $h[18];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="5mo" value="<?php echo $h[19];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>T</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="5ti" value="<?php echo $h[20];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="5to" value="<?php echo $h[21];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>N</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="5ni" value="<?php echo $h[22];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="5no" value="<?php echo $h[23];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                      </div>

                      <div style="width: 20%;float:left;text-align: center;">
                        <label style="width: 100%">Sexta</label>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>M</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="6mi" value="<?php echo $h[24];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="6mo" value="<?php echo $h[25];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>T</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="6ti" value="<?php echo $h[26];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="6to" value="<?php echo $h[27];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;padding-top: 20px;">
                          <label>N</label>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Entrada</label>
                          <input name="6ni" value="<?php echo $h[28];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                        <div style="width: 65px;float:left;text-align: center;">
                          <label>Saída</label>
                          <input name="6no" value="<?php echo $h[29];?>" type="text" style="width: 60px;" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask name="est-fim"/>
                        </div>
                      </div>
                    </div>
                  </div><!-- /.box -->

            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Plano de trabalho<div id="contador"></div></h3>
                </div>
                  <div class="box-body">
                    <textarea onkeyup="limitarInput(this, 3700)" maxlenght="3700" name="plano" id="plano" class="form-control" rows="15" cols="auto" required><?php echo $conteudo[4];?></textarea>
                    </div>
                  </div><!-- /.box -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="botaoEditar">Editar requerimento</button>
                  </div>
                  </form>
           </div><!-- /.box -->
          </div><!-- /.box -->

        </section><!-- /.content -->
        <?php
          } else echo Atalhos::aviso(1); //FIM DA PERMISSÃO
          } //FIM DA EDIÇÃO
        ?>
      </div><!-- /.content-wrapper -->
      <?php
        } //Termina IF de permissão logado
      ?>
    <?php include 'rodape.php' ?>

    <?php include 'script.php' ?>
    <script>
    function limitarInput(obj, max) {
      obj.value = obj.value.substring(0,max);
    }
    $(document).ready(function() {
      var text_max = 3700;
      $('#contador').html(text_max + ' caracteres restantes');

      $('#plano').keyup(function() {
          var text_tam_atual = $('#plano').val().length;
          var text_restante = text_max - text_tam_atual;

          $('#contador').html(text_restante + ' caracteres restantes');
      });
    });
    $('#forminsere').find('.formulario').submit(function() {
        $("#botaoEnviar").attr("disabled","disabled");
        var f1 = $.trim($(this).find('#inst-nome').val());
        var f2 = $.trim($(this).find('#inst-cnpj').val());
        var f3 = $.trim($(this).find('#inst-logradouro').val());
        var f4 = $.trim($(this).find('#inst-numero').val());
        var f5 = $.trim($(this).find('#inst-bairro').val());
        var f6 = $.trim($(this).find('#inst-cidadeuf').val());
        var f7 = $.trim($(this).find('#inst-email').val());
        var f8 = $.trim($(this).find('#inst-tel1').val());
        var f9 = $.trim($(this).find('#inst-tel2').val());
        var f10 = $.trim($(this).find('#instresp-nome').val());
        var f11 = $.trim($(this).find('#instresp-cpf').val());
        var f12 = $.trim($(this).find('#instresp-rg').val());
        var f13 = $.trim($(this).find('#instresp-rgorgao').val());
        var f14 = $.trim($(this).find('#instresp-uf').val());
        var f15 = $.trim($(this).find('#instresp-data').val());
        var f16 = $.trim($(this).find('#instresp-cargo').val());
        var f17 = $.trim($(this).find('#est-horas').val());
        var f18 = $.trim($(this).find('#est-bolsavalor').val());
        var f19 = $.trim($(this).find('#est-transpvalor').val());
        var f20 = $.trim($(this).find('#est-comeco').val());
        var f21 = $.trim($(this).find('#est-fim').val());
        var f22 = $.trim($(this).find('#est-supervisor').val());
        var f23 = $.trim($(this).find('#est-supervisorcpf').val());
        var f24 = $.trim($(this).find('#est-supervisoremail').val());
        var f25 = $.trim($(this).find('#est-supervisorarea').val());
        var f26 = $.trim($(this).find('#est-supervisorformacao').val());
        var f27 = $.trim($(this).find('#plano').val());

        if(!(f1.length != 0 && f2.length != 0 && f3.length != 0 && f4.length != 0
          && f5.length != 0 && f6.length != 0 && f7.length != 0 && f8.length != 0
          && f9.length != 0 && f10.length != 0 && f11.length != 0 && f12.length != 0
          && f13.length != 0 && f14.length != 0 && f15.length != 0 && f16.length != 0
          && f17.length != 0 && f18.length != 0 && f19.length != 0 && f20.length != 0
          && f21.length != 0 && f22.length != 0 && f23.length != 0 && f24.length != 0
          && f25.length != 0 && f26.length != 0 && f27.length != 0)) {
            $("#botaoEnviar").attr("disabled",false);
            alert("Por favor, preencha todos os campos!");
            return false;
        }

    });
    </script>
  </body>
</html>
