<?php
include '../../includes/topo.php';
?>
<title>AdminDcomp - Moderar Cadastros</title>
</head>
<?php
include("../funcoes/enviarEmailConfirmacao.php");
include '../../includes/barra.php';
include '../../includes/menu.php';

$_SESSION['irPara'] = '/inicio';
$db = Atalhos::getBanco();



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
                            
                            $sql = "SELECT * FROM tbusuario";

                            foreach($db->query($sql) as $row)
                            {
                            
                                    if($row['statusUser'] == 'Inativo')
                                    {
                                        echo '<tr align="center">
                                        <td>' . $row['nomeUser'] . '</td>
                                        <td>' . $row['email'] . '</td>
                                        <td>' . $row['siapMatricula'] . '</td>
                                        <td><span class="label label-warning">' . $row['statusUser'] . '</span></td>
                                        <td><a href="'.$_SERVER['PHP_SELF'].'?idUser='. $row['idUser']. '" class="btn btn-primary btn-xs" role="button">ATIVAR</a></td>';
                                        echo '</tr>';
                                    }
                            }

                            if(isset($_GET['idUser']))
                            {
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                $id  = $_GET['idUser'];
                                $email = $row['email'];
                                $sqlUpdate = "UPDATE tbusuario SET senha = 'ccet123456', statusUser = 'Aguardando Solicitante', sudo = 'Ativo', login = '$email' WHERE idUser = $id";
                                echo "<script>window.location='/recursos/autorizar_cadastro';alert('O cadastro do Senhor(a) ".$row['nomeUser']." foi autorizado com sucesso! Um e-mail com instruções foi ennviado ao seu respectivo endereço eletrônico.');</script>";

                                if(!$db->query($sqlUpdate) === TRUE) {
                                    echo "Error updating record: " . $db->error;
                                }
                                $nomeUser=$row['nomeUser'];
                                $email = $row['email'];
                                enviarEmail::enviarEmailConfirmacao($row['nomeUser'], $row['email']);



                            }
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
        var email = button.data('solict-email')
        var idAfiliacao = button.data('solict-idAfiliacao')
        var id = button.data('solict-siapMatricula')
        var departamento = button.data('solict-departamento')
        var status = button.data('solict-status')
        var modal = $(this)


        //Gravando no banco de dados
        $conexao = mysqli_connect("localhost","root");
        if (!$conexao)
            die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysqli_error($conexao));
//conectando com a tabela do banco de dados
        $banco = mysqli_select_db($conexao, "dcomp");
        if (!$banco)
            die ("Erro de conexão com banco de dados, o seguinte erro ocorreu -> ".mysqli_error($conexao));


        else
//    $query = "INSERT INTO `tbprimeiroacessoccet` (`nome`, `email`, `idAfiliacao`, `siapMatricula`, `departamento`)
//VALUES ('$nome', '$email', '$idAfiliacao', '$siapMatricula', '$departamento')";
//mysqli_query($conexao, $query);

            mysqli_close($conexao);
    })
</script>
</body>
</html>
