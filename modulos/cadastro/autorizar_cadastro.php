<?php
include '../../includes/topo.php';
?>
<title>AdminDcomp - Moderar Cadastros</title>
</head>
<?php
include '../../includes/barra.php';
include '../../includes/menu.php';
$_SESSION['irPara'] = '/inicio';
$db = Atalhos::getBanco();
$link = '/recursos/salas';
if($query = $db->prepare("SELECT nome, email, siapMatricula, status FROM tbprimeiroacessoccet")){
    $query->execute();
    $query->bind_result($nome, $email, $siapMatricula, $statusCadastro);
}
?>
<!-- Content Wrapper. Contains page0content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Solicitações de Cadastros
            <small>Autorizar Cadastro</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php
        if(isset($_SESSION['avisoSala'])):
            ?>
            <div class="callout callout-success">
                <h4><?php echo $_SESSION['avisoSala'] ?></h4>
            </div>
            <?php
            unset($_SESSION['avisoSala']);
        endif;
        ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-body table-responsive">
                        <!-- Tabela de Salas -->
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th><center>Nome</center></th>
                                <th><center>Email</center></th>
                                <th><center>SIAP/Matricula</center></th>
                                <th><center>Status</center></th>
                                <?php
                                if($_SESSION['logado'] && $_SESSION['nivel'] <= 1)
                                    echo '<th><center>Ação</th>';

                                ?>
                            </tr>
                            </thead>
                            <?php
                            //exibe os equipamentos selecionados
                            while ($query->fetch()) {
                                switch($statusCadastro){
                                    case 'Inativo':
                                        $status = '<span class="label label-warning">INATIVO</span>';
                                        $acao = '<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#simples"
                              data-solict-id="'.$siapMatricula.'"data-solict-tipo="2" data-solict-nome="'.$nome.'"
                              data-solict-frase="Ativar">Ativar</button>';
                                        break;
                                }
                                echo '<tr align="center">
                                  <td>'.$nome.'</td>
                                  <td>'.$email .'</td>
                                  <td>'.$siapMatricula.'</td>
                                  <td>'.$status.'</td>
                                  <td>'.$acao.'</td>';
                                  echo '</tr>';



                            }
                            $query->close();
                            $db->close();
                            ?>

                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div class="modal fade" id="simples" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel"></h4>
            </div>
            <form role="form" action="post/" method="post" name="formulario1" id="formulario1">
                <div class="modal-body">
                    <input type="hidden" id="numPost" name="numPost" value="36"><!-- Número corrsalasodente ao post -->
                    <input type="hidden" name="idSala" id="idSala"/>
                    <input type="hidden" name="acao" id="acao"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../../includes/rodape.php' ?>
</div><!-- ./wrapper -->
<?php include '../../includes/script.php' ?>
<script>
    //DataTable
    $(function () {
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            }
        });
    });

    $('#simples').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var tipo = button.data('solict-tipo')
        var frase = button.data('solict-frase')
        var nome = button.data('solict-nome')
        var id = button.data('solict-id')
        var modal = $(this)
        modal.find('.modal-title').text(frase + ' - Sala: ' + nome)
        $('#idSala').val(id)
        $('#acao').val(tipo)
    })
</script>
</body>
</html>
