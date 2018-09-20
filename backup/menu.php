<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <li>
              <a href="/inicio">
                <i class="fa fa-home"></i> <span>Início</span> 
              </a>
            </li>
            <li class="treeview">
                <a href="http://mail.dcomp.ufs.br/"  target="_blank">
                  <i class="fa fa-envelope"></i>
                  <span>E-mail</span>
                </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder-o"></i>
                <span>Recursos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php if($_SESSION['logado'] && $_SESSION['nivel'] <= 1): ?>
                  <li><a href="/recursos/alunos"><i class="fa fa-group"></i> Alunos</a></li>
                  <li><a href="/recursos/contas-temporarias"><i class="fa fa-group"></i> Contas Temporários</a></li> 
                  <li><a href="/recursos/funcionarios"><i class="fa fa-user-secret"></i> Funcionários</a></li>  
                <?php endif; ?>
                <li><a href="/recursos/professores"><i class="fa fa-graduation-cap"></i> Professores</a></li> 
                <li><a href="/recursos/disciplinas"><i class="fa fa-book"></i> Disciplinas</a></li>  
                <li><a href="/recursos/laboratorios"><i class="fa fa-th"></i> Laboratórios</a></li>
                <li><a href="/recursos/equipamentos"><i class="fa fa-laptop"></i> Equipamentos</a></li>
                <li><a href="/recursos/salas"><i class="fa fa-bank"></i> Salas</a></li>  
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Laboratórios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/laboratorios/calendario"><i class="fa fa-calendar"></i> Calendário</a></li>
                <?php if($_SESSION['logado'] && $_SESSION['nivel'] == 1): ?>
                  <li><a href="/laboratorios/moderar"><i class="fa fa-pencil-square-o"></i> Reservas 
                  <?php
                    $db = Atalhos::getBanco();
                    if ($query = $db->prepare("SELECT a.idReLab FROM tbreservalab a 
                          WHERE EXISTS (SELECT y.idReLab FROM tbcontroledatalab y
                          WHERE a.idReLab = y.idReLab AND y.statusData = 'Pendente')")){
                      $query->execute();
                      $query->bind_result($idReLab);
                      $query->store_result();
                      $total = $query->num_rows;
                      if($total != 0){
                        echo '<small class="label pull-right bg-yellow">'.$total.'</small>';
                      }
                      $query->close();
                    }
                  ?>
                </a></li>
                <?php elseif($_SESSION['logado']):  ?>
                  <li><a href="/laboratorios/meus"><i class="fa  fa-pencil-square-o"></i> Reservas</a></li>
                <?php endif ?>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Equipamentos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/equipamentos/calendario"><i class="fa fa-calendar"></i> Calendário</a></li>
                <?php if($_SESSION['logado'] && $_SESSION['nivel'] == 1): ?>
                  <li><a href="/equipamentos/moderar"><i class="fa  fa-pencil-square-o"></i> Reservas 
                  <?php
                    if($query = $db->prepare("SELECT a.idReEq FROM tbreservaeq a 
                          WHERE EXISTS (SELECT y.idReEq FROM tbcontroledataeq y
                          WHERE a.idReEq = y.idReEq AND y.statusData = 'Pendente')")){
                      $query->execute();
                      $query->bind_result($idReLab);
                      $query->store_result();
                      $total = $query->num_rows;
                      if($total != 0)
                        echo '<small class="label pull-right bg-yellow">'.$total.'</small>';
                      $query->close();
                    }
                  ?>
                </a></li>
                <?php elseif($_SESSION['logado']):  ?>
                  <li>
                    <a href="/equipamentos/meus">
                      <i class="fa  fa-pencil-square-o"></i>
                       Reservas
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-bank"></i>
                  <span>Salas</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="/salas/calendario"><i class="fa fa-calendar"></i> Calendário</a></li>
                  <?php if($_SESSION['logado'] && $_SESSION['nivel'] == 1): ?>
                    <li><a href="/salas/moderar"><i class="fa  fa-pencil-square-o"></i> Reservas 
                      <?php
                        if($query = $db->prepare("SELECT a.idReSala FROM tbreservasala a 
                              WHERE EXISTS (SELECT y.idReSala FROM tbcontroledatasala y
                              WHERE a.idReSala = y.idReSala AND y.statusData = 'Pendente')")){
                          $query->execute();
                          $query->bind_result($idReLab);
                          $query->store_result();
                          $total = $query->num_rows;
                          if($total != 0)
                            echo '<small class="label pull-right bg-yellow">'.$total.'</small>';
                          $query->close();
                        }
                        $db->close();
                      ?>
                    </a></li>
                  <?php elseif($_SESSION['logado'] && $_SESSION['nivel'] < 4):  ?>
                    <li>
                      <a href="/salas/minhas">
                        <i class="fa  fa-pencil-square-o"></i>
                         Reservas
                      </a>
                    </li>
                  <?php endif; ?>
                </ul>
              </li>
            <?php if(!($_SESSION['logado']) || $_SESSION['nivel'] != 0 || $_SESSION['nivel'] != 2): ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pencil-square-o"></i>
                <span>Requerimentos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php if($_SESSION['logado'] && $_SESSION['nivel'] == 1): ?>
                  <li><a href="/requerimentos/moderar"><i class="fa fa-pencil"></i> Moderar 
                  <?php
                    $db = atalhos::getBanco();
                    if($query = $db->prepare("SELECT a.idReq FROM tbrequerimentos a NATURAL LEFT JOIN tbreqs_professor d WHERE a.tipoReq != 5 AND ((d.idProfessor = 0) OR (d.idProfessor IS NULL) OR (a.statusReq = 'ConfirmadoProf') OR (a.statusReq = 'NegadoProf')) AND ((a.statusReq = 'Pendente') OR (a.statusReq = 'PendenteProf') OR (a.statusReq = 'ConfirmadoProf') OR (a.statusReq = 'NegadoProf'))")){
                      $query->execute();
                      $query->bind_result($idInc);
                      $query->store_result();
                      $total = $query->num_rows;
                      if($total != 0)
                        echo '<small class="label pull-right bg-yellow">'.$total.'</small>';
                      $query->close();
                    }
                    $db->close();
                  ?>
                  </a></li>
                  <li><a href="/requerimentos/classificar"><i class="fa fa-cubes"></i> Classificar Inclusão
                  <?php
                    $db = atalhos::getBanco();
                    if($query = $db->prepare("SELECT idReq FROM tbrequerimentos WHERE statusReq = 'Pendente' AND tipoReq = 5")){
                      $query->execute();
                      $query->bind_result($idInc);
                      $query->store_result();
                      $total = $query->num_rows;
                      if($total != 0)
                        echo '<small class="label pull-right bg-yellow">'.$total.'</small>';
                      $query->close();
                    }
                    $db->close();
                  ?>
                  </a></li>
                  <li><a href="/requerimentos/configurar"><i class="fa fa-calendar-o"></i> Configurar</a></li>
                  <li><a href="/requerimentos/alunos_externos"><i class="fa fa-group"></i> Alunos Externos</a></li>
                <?php elseif($_SESSION['logado'] && $_SESSION['afiliacao'] == 1): ?>
                  <li><a href="/requerimentos/moderar/docente"><i class="fa fa-pencil"></i> Moderar 
                  <?php
                    $db = atalhos::getBanco();
                    if($query = $db->prepare("SELECT a.idReq FROM tbrequerimentos a WHERE a.idReq IN (SELECT idReq FROM tbreqs_professor WHERE idProfessor = ?) AND a.statusReq = 'PendenteProf'")){
                      $query->bind_param('i', $_SESSION['id']);
                      $query->execute();
                      $query->bind_result($idInc);
                      $query->store_result();
                      $total = $query->num_rows;
                      if($total != 0)
                        echo '<small class="label pull-right bg-yellow">'.$total.'</small>';
                      $query->close();
                    }
                    $db->close();
                  ?>
                  </a></li>
                <?php elseif($_SESSION['logado'] && $_SESSION['nivel'] == 4): ?>
                  <li><a href="/requerimentos/solicitar"><i class="fa fa-pencil-square-o"></i> Solicitar</a></li>
                  <li><a href="/requerimentos/meus"><i class="fa fa-pencil-square-o"></i> Meus</a></li>
                <?php else: ?>
                  <li><a href="/requerimentos/solicitar"><i class="fa fa-pencil-square-o"></i> Solicitar</a></li>
                  <li><a href="/requerimentos/acompanhar"><i class="fa fa-search"></i> Acompanhar</a></li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
            <?php if($_SESSION['logado']): ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-ticket"></i>
                <span>Tickets</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php if($_SESSION['logado']): ?>
                  <li>
                    <a href="/tickets/adicionar"><i class="fa fa-pencil-square-o"></i> Adicionar ticket</a>
                  </li>
                  <li class="treeview">
                    <a href="/tickets/meus">
                      <i class="fa fa-ticket"></i> 
                      <span>Meus tickets</span>
                      <?php
                        $db = atalhos::getBanco();
                        if($query = $db->prepare("SELECT idTicket FROM tbticket WHERE statusTicket = 'Respondido' AND idUser = ?")){
                          $query->bind_param('i', $_SESSION['id']);
                          $query->execute();
                          $query->bind_result($idReLab);
                          $query->store_result();
                          $total = $query->num_rows;
                          if($total != 0)
                            echo '<small class="label pull-right bg-blue">'.$total.'</small>';
                          $query->close();
                        }
                        $db->close();
                      ?>
                    </a>
                  </li>
                <?php 
                  endif;
                  if($_SESSION['logado'] && $_SESSION['afiliacao'] >= 5  && $_SESSION['afiliacao'] <= 7): ?>
                  <li class="treeview">
                    <a href="/tickets/moderar">
                      <i class="fa fa-ticket"></i> 
                      <span>Moderar tickets</span>
                      <?php
                        $db = atalhos::getBanco();
                        if($query = $db->prepare("SELECT idTicket FROM tbticket WHERE statusTicket = 'Em Analise'")){
                          $query->execute();
                          $query->bind_result($idReLab);
                          $query->store_result();
                          $total = $query->num_rows;
                          if($total != 0)
                            echo '<small class="label pull-right bg-yellow">'.$total.'</small>';
                          $query->close();
                        }
                        $db->close();
                      ?>
                    </a>
                  </li>       
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>            
            <?php if($_SESSION['logado'] && $_SESSION['nivel'] == 1): ?>
            <li class="treeview">
                <a href="/avisos">
                  <i class="fa fa-newspaper-o"></i>
                  <span>Avisos</span>
                </a>
            </li>
            <?php endif; ?>
            <?php if($_SESSION['logado'] && $_SESSION['nivel'] == 0): ?>
              <li class="treeview">
                  <a href="/repositorio">
                    <i class="fa fa-folder-open"></i>
                    <span>Repositório</span>
                  </a>
              </li>
              <li class="treeview">
                  <a href="/atualizar">
                    <i class="fa fa-database"></i>
                    <span>Atualizar Base</span>
                  </a>
              </li>              
              <li class="treeview">
                  <a href="/sanidade">
                    <i class="fa fa-gavel"></i>
                    <span>Controle de Sanidade</span>
                  </a>
              </li>
              <li class="treeview">
              <a href="#">
                <i class="fa fa-unlock"></i>
                <span>Controle de Acesso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="treeview">
                <a href="/acesso/logs-acoes">
                  <i class="fa fa-clock-o"></i>
                  <span>LOGs - Ações</span>
                </a>
                <a href="/acesso/logs">
                  <i class="fa fa-clock-o"></i>
                  <span>LOGs - Acessos</span>
                </a>
                <a href="/acesso/logs-forcados">
                  <i class="fa fa-minus-circle"></i>
                  <span>LOGs - Forçados</span>
                </a>
                </li>
              </ul>
              </li>
            <?php endif;
             if (!($_SESSION['mobile'])):
            ?>
            <li class="treeview">
                <a href="/mapa">
                  <i class="fa fa-map-marker"></i>
                  <span>Mapa do DCOMP</span>
                </a>
            </li>
            <?php endif;?> 
           <li class="treeview">
                <a href="/faleconosco">
                  <i class="fa fa-phone"></i>
                  <span>Fale Conosco</span>
                </a>
            </li>
            <li class="treeview">
                <a href="/sobre">
                  <i class="fa fa-info-circle"></i>
                  <span>Sobre o AdminDcomp</span>
                </a>
            </li>
            <li class="treeview">
                <a href="/faqs">
                  <i class="fa fa-question-circle text-aqua"></i>
                  <span>Reportar um problema</span>
                </a>
            </li>
            <!--
            <li>
              <a href="/reportarbugs">
                <i class="fa fa-bug text-aqua"></i>
                <span>Reporte um bug</span>
              </a>
            </li>
            -->
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
