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
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Salas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/laboratorios/calendario"><i class="fa fa-calendar"></i> Calendário</a></li>
                <?php if($_SESSION['logado'] && $_SESSION['nivel'] == 1): ?>
                  <li><a href="/laboratorios/moderar"><i class="fa fa-pencil-square-o"></i> Moderar reservas
                  <?php
                    $db = Atalhos::getBanco();
                    if ($query = $db->prepare("SELECT a.idReLab FROM tbReservaLab a 
                          WHERE EXISTS (SELECT y.idReLab FROM tbControleDataLab y
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
                <li><a href="/laboratorios/controlar"><i class="fa fa-clock-o"></i> Controlar reservas</a></li>
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
                    if($query = $db->prepare("SELECT a.idReEq FROM tbReservaEq a
                          WHERE EXISTS (SELECT y.idReEq FROM tbControleDataEq y
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


            <?php if(!($_SESSION['logado']) || $_SESSION['nivel'] != 0 || $_SESSION['nivel'] != 2): ?>


            <?php endif; ?>
            <?php if($_SESSION['logado']): ?>


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
                  <a href="/moderar/bugs">
                    <i class="fa fa-bug"></i>
                    <span>Moderar Bugs/Problemas</span>
                    <?php
                        $db = atalhos::getBanco();
                        if($query = $db->prepare("SELECT idBug FROM tbBugs WHERE status = 'Em análise'")){
                          $query->execute();
                          $query->bind_result($idBug);
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

            <?php endif;?>

            <li class="treeview">
                <a href="/sobre">
                  <i class="fa fa-info-circle"></i>
                  <span>Sobre o AdminCCET</span>
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