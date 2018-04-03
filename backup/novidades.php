<?php 
  include 'topo.php';
?>
<title>AdminDcomp - Novidades</title>
</head>
<?php
  include 'barra.php';
  include 'menu.php';
  $_SESSION['irPara'] = '/notas';
 ?>
      
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        
        <section class="content-header">
        <h1>
          Notas de Atualização
        </h1>

    </section> 
          <!-- START ACCORDION & CAROUSEL-->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Admin DCOMP</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseEight">
                            v1.8
                          </a>
                        </h4>
                      </div>
                      <div id="collapseEight" class="panel-collapse collapse in">
                        <div class="box-body">
                          <b>Modificações:</b>
                          <ul>                           
                            <li><b>Melhorias:</b>
                            <ul>
                              <li>Correções de Bugs;</li>
                              <li>Mudança no adicionar usuários;</li>
                            </ul></li>
                          </ul>
                          <b>Funções Adicionadas:</b>
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseEight">
                            v1.7
                          </a>
                        </h4>
                      </div>
                      <div id="collapseEight" class="panel-collapse collapse">
                        <div class="box-body">
                          <b>Modificações:</b>
                          <ul>                           
                            <li><b>Melhorias:</b>
                            <ul>
                              <li>Correções de Bugs;</li>
                              <li>Mudança na exibição de reservas nos calendários;</li>
                            </ul></li>
                          </ul>
                          <b>Funções Adicionadas:</b>
                          <ul>
                            <li><b>Página de Perfil:</b>
                            <ul>
                              <li>Visualizar historico de bloqueios;</li>
                              <li>Botão de retornar;</li>
                            </ul></li>
                            <li><b>Gerenciamento de Pacotes:</b>
                            <ul>
                              <li>Exibe todos os pacotes contidos no repositório, separados por arquiteturas em abas distintas;</li>
                              <li>É capaz de adicionar, editar ou remover um pacote;</li>
                            </ul></li>
                            <li><b>Moderar Reservas/Minhas Reservas</b>
                            <ul>
                              <li>Permite a exclusão de uma determinada reserva;</li>
                            </ul></li>    
                              <li><b>Visualizar mapa dos prédios do DCOMP:</b>
                            <ul>
                              <li>Exibe um mapa detalhado de todas as dependencias dos dois departamentos de computação;</li>
                            </ul></li>
                          </ul> 
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">
                            v1.6.1
                          </a>
                        </h4>
                      </div>
                      <div id="collapseSeven" class="panel-collapse collapse">
                        <div class="box-body">
                          <b>Modificações:</b>
                          <ul>                           
                            <li><b>Melhorias:</b>
                            <ul>
                              <li>Correções de Bugs;</li>
                              <li>Página de calendário aprimorada;</li>
                              <li>Alterada a cor de exibição da quantidade de reservas pendentes;</li>
                            </ul></li>
                          </ul> 
                        </div>
                      </div>
                    </div>  
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                            v1.6
                          </a>
                        </h4>
                      </div>
                      <div id="collapseSix" class="panel-collapse collapse">
                        <div class="box-body">
                          <b>Modificações:</b>
                          <ul>                           
                            <li><b>Melhorias:</b>
                            <ul>
                              <li>Correções de Bugs;</li>
                              <li>Adicionado links amigáveis;</li>
                              <li>Adicionado novos avisos, para informar os campos vazios;</li>
                            </ul></li>
                          </ul>
                          <b>Funções Adicionadas:</b>
                          <ul>
                            <li><b>Página de Perfil:</b>
                            <ul>
                              <li>Criada página de perfil;</li>
                              <li>Nesta página o administrador pode alterar as informações e permissões do usuário;</li>
                            </ul></li>
                            <li><b>Notificações:</b>
                            <ul>
                              <li>Adicionado icone para a exibição das notificações; </li>
                            </ul></li>
                            <li><b>Página de Controle de Sanidade:</b>
                            <ul>
                              <li>Novas funções inseridas;</li>
                            </ul></li>                           
                            <li><b>Página de Configuração:</b>
                            <ul>
                              <li>Adicionar ou remover imagem de perfil;</li>
                              <li>É realizada uma checagem de segurança ao alterar a senha;</li>
                            </ul></li>
                            <li><b>Pagina Moderar Reservas:</b>
                            <ul>
                              <li>Adicionados avisos para identificar caso sejam aprovadas solicitações em choque;</li>
                              <li>Função para alterar entre os laboratórios preferenciais em caso de choque;</li>                          
                            </ul></li>
                          </ul>
                        </div>
                      </div>
                    </div>  
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                            v1.5
                          </a>
                        </h4>
                      </div>
                      <div id="collapseFive" class="panel-collapse collapse">
                        <div class="box-body">
                          <b>Modificações:</b>
                          <ul>                           
                            <li><b>Recursos:</b>
                            <ul>
                              <li>Reorganizada apresentação dos dados nas páginas: Alunos, Professores, Funcionários;</li>
                              <li>O administrador agora pode adicionar: Alunos, Professores e Funcionários;</li>
                              <li>O administrador agora pode inativar/ativar: Alunos, Professores, Funcionários, Laboratórios e Equipamentos;</li>
                            </ul></li>
                            <li><b>Melhorias:</b>
                            <ul>
                              <li>Correção de bugs;</li>
                              <li>Melhorias de segurança;</li>
                              <li>Barra de login e logout modificada;</li>
                            </ul></li>            
                          </ul>
                          <b>Funções Adicionadas:</b>
                          <ul>
                            <li><b>Salas:</b>
                            <ul>
                              <li>Criado páginas para administrar salas(auditório, sala de apresentação);</li>
                              <li>Criado páginas de reservas de salas;</li>
                            </ul></li>
                            <li><b>Página Inicial:</b>
                            <ul>
                              <li>Quadro de avisos dinâmico criado;</li>
                              <li>Função para expandir o quadro de avisos;</li>
                            </ul></li>
                            <li><b>Página de Login:</b>
                            <ul>
                              <li>Recuperação de senha;</li>
                              <li>Criado Captcha que aparecerá após 3 tentativas sem sucesso de login;</li>
                            </ul></li>                           
                            <li><b>Página de Configuração:</b>
                            <ul>
                              <li>Adicionar ou remover imagem de perfil;</li>
                              <li>É realizada uma checagem de segurança ao alterar a senha;</li>
                            </ul></li>
                            <li><b>Pagina Moderar Reservas:</b>
                            <ul>
                              <li>Adicionados avisos para identificar caso sejam aprovadas solicitações em choque;</li>
                              <li>Função para alterar entre os laboratórios preferenciais em caso de choque;</li>                          
                            </ul></li>
                            <li><b>Página Meus Requerimentos:</b>
                            <ul>
                              <li>Criada página de meus requerimentos para os alunos e professores;</li>
                              <li>Visualizar o arquivo PDF de um determinado requerimento;</li>
                              <li>Editar requerimento solicitado;</li>
                              <li>Excluir requerimento solicitado;</li>
                            </ul></li>
                            <li><b>Página Moderar Requerimentos:</b>
                            <ul>
                              <li>Criada página para moderação dos requerimentos solicitados;</li>
                              <li>Visualizar o arquivo PDF de um determinado requerimento;</li>
                              <li>Aprovar um determinado requerimento;</li>
                              <li>Negar um determinado requerimento;</li>
                            </ul></li>  
                            <li><b>Painel de Avisos:</b>
                            <ul>
                              <li>Criada página para adicionar, remover, ativar e inativar avisos;</li>
                            </ul></li>                             
                            <li><b>Página Fale Conosco:</b>
                            <ul>
                              <li>Criada página contendo informações adicionais sobre o departamento;</li>
                            </ul></li>
                            <li><b>Funções de Senha:</b>
                            <ul>
                              <li>Verifica nivel de dificudade de senha;</li>
                              <li>Verifica se o confirma senha é igual a senha;</li>
                              <li>Balão que explica as caracteristicas necessarias para aceitar senha;</li>
                            </ul></li>                           
                          </ul>
                        </div>
                      </div>
                    </div>                     
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                            v1.4
                          </a>
                        </h4>
                      </div>
                      <div id="collapseFour" class="panel-collapse collapse">
                        <div class="box-body">
                          <b>Modificações:</b>
                          <ul>
                            <li><b>Página de Laboratórios:</b>
                            <ul>
                              <li>Deixou de exibir o ID do laboratórios;</li>
                            </ul></li>
                          </ul>
                          <b>Funções Adicionadas:</b>
                          <ul>
                            <li><b>Login:</b>
                            <ul>
                              <li>Aviso para usuário ou senha incorreta;</li>
                            </ul></li>
                          </ul>
                          <ul>
                            <li><b>Página de Laboratórios/Equipamentos:</b>
                            <ul>
                              <li>Excluir um determinado Laboratório/Equipamento;</li>
                              <li>Alterar e/ou adicionar novas cores em um determinado Laboratório;</li>
                            </ul></li>
                          </ul>
                          <ul>
                            <li><b>Página de Moderar Reservas:</b>
                            <ul>
                              <li>Exibe todos os choques de horário entre os requerimentos realizados pelo usuário;</li>
                            </ul></li>
                          </ul>
                        </div>
                      </div>
                    </div>                    
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            v1.3.1
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse">
                        <div class="box-body">
                          <b>Modificações:</b>
                          <ul>
                            <li><b>Laboratórios/Equipamentos:</b>
                            <ul>
                              <li>Função para reserva recorrente corrigida;</li>
                              <li>Alterada a maneira de se exibir a data na aba: Moderar/Meus;</li>
                              <li>Correção de bugs.</li>
                            </ul></li>
                          </ul>
                          <b>Funções Adicionadas:</b>
                          <ul>
                            <li><b>Requerimentos:</b>
                            <ul>
                              <li>Realiza o requerimento online dos seguintes formulários: Atividades Complementares, Cadastro de Estágio, Requerimento de Abono de Faltas, Requerimento de Estágio Supervisionado, Requerimento de Trabalho de Conclusão de Curso e Requerimento Geral;</li>
                              <li>Exibe todos os requerimentos realizados pelo usuário.</li>
                            </ul></li>
                          </ul>
                          <ul>
                            <li><b>Página de Configurações:</b>
                            <ul>
                              <li>Criada a página de configuração de conta do usuário;</li>
                              <li>Nesta página o usuário pode mudar nome, email cadastrado, senha e telefones cadastrados;</li>
                            </ul></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            v1.3
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="box-body">
                        <b>Modificações:</b>
                        <ul>
                          <li><b>Laboratórios/Equipamentos</b>
                            <ul>
                              <li>Adicionado campo para inserir o título da solicitação;</li>
                              <li>Adicionado campo para a exibição do título da solicitação;</li>
                              <li>Correção de bugs;</li>
                            </ul>
                          </li>
                        </ul>
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            v1.2
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse">
                        <div class="box-body">
                        <b>Funções Adicionadas:</b>
                        <ul>
                          <li><b>Recursos:</b>
                          <ul>
                            <li>Lista todos os alunos cadastrados;</li>
                            <li>Ativar/inativar alunos;</li>
                            <li>Lista todos os funcionários cadastrados;</li>
                            <li>Adicionar novos funcionários;</li>
                            <li>Ativar/inativar funcionários;</li>
                            <li>Lista todos os professores cadastrados;</li>
                            <li>Adicionar novos professores;</li>
                            <li>Ativar/inativar professores;</li>
                            <li>Lista todos os laboratórios cadastrados;</li>
                            <li>Adicionar novos laboratórios;</li>
                            <li>Editar laboratório selecionado;</li>
                            <li>Ativar/inativar laboratório;</li>
                            <li>Lista todos os equipamentos cadastrados;</li>
                            <li>Adicionar novos equipamentos;</li>
                            <li>Ativar/inativar equipamento;</li>
                          </ul></li>
                          <li><b>Laboratórios:</b>
                            <ul>
                              <li>Exibe todas as solicitações aprovadas no calendário;</li>
                              <li>Realiza a reserva de um determinado laboratório em um período;</li>
                              <li>Lista todas as solicitações realizadas por usuário;</li>
                              <li>Exclui solicitação selecionada pelo usuário;</li>
                              <li>A secretaria é capaz de moderar todas as reservas requeridas, podendo: Aprovar, Negar, Entregar Chave, Receber Chave e Cancelar;</li>
                              <li>A secretaria é capaz de alterar o laboratório escolhido pelo usuário caso julgue necessário;</li>
                            </ul></li>
                          <li><b>Equipamentos:</b>
                            <ul>
                              <li>Exibe todas as solicitações aprovadas no calendário;</li>
                              <li>Realiza a reserva de um determinado equipamento em um período;</li>
                              <li>Lista todas as solicitações realizadas pelo usuário;</li>
                              <li>Exclui a solicitação selecionada pelo usuário;</li>
                              <li>A secretaria é capaz de moderar todas as solicitações requeridas, podendo: Aprovar, Negar, Entregar Equipamento, Receber Equipamento e Cancelar;</li>
                            </ul>
                          </li>
                        </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          </section>
          <!-- END ACCORDION & CAROUSEL-->
          </div>
  <?php include 'rodape.php' ?>
  <?php include 'script.php' ?>
<script>
  $('#simples').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var tipo = button.data('solict-tipo')
    var frase = button.data('solict-frase')
    var id = button.data('solict-id') 
    var modal = $(this)
    modal.find('.modal-title').text(frase + ' - Aluno de Matrícula Nº' + id)
    $('#idsol2').val(id)
    $('#acsol2').val(tipo)
  })
</script>
</body>
</html>
