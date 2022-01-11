<?php
require '../../vendor/autoload.php';

use App\Model\Member;
use App\Support\Sessions;

$dao = new Member;

if (isset($_POST['btnExcluir'])) {
    Sessions::RegistrarAtividade();
    $ret = $dao->ExcluirMembro($_POST['cod_item']);
}

$membros = $dao->DevolverMembros();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SisGetúlio</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../Assets/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../Assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../Assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../Assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../Assets/dist/css/adminlte.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../../Assets/plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition  sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <!--        <div class="preloader flex-column justify-content-center align-items-center">-->
        <!--            <img class="animation__wobble" src="../../Assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">-->
        <!--        </div>-->

        <!-- Topo e menu -->
        <?php require_once '_topo.php' ?>
        <?php require_once '_menu.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Membros</a></li>
                                <li class="breadcrumb-item active">Listar membros</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!--Main content-->
            <section class="content">
                <div class="container-fluid">
                    <row>
                        <div class="col-md-12">

                            <div class="card card-gray-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Membros Encontrados</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Nome</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Email</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Telefone</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Endereço</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Status</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Ações</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($membros as $key => $value) { ?>
                                                        <tr class="odd">
                                                            <td class="dtr-control sorting_1" tabindex="0"><?= $membros[$key]['nome'] ?></td>
                                                            <td><?= $membros[$key]['email'] ?></td>
                                                            <td><?= $membros[$key]['telefone'] ?></td>
                                                            <td><?= $membros[$key]['endereco'] ?></td>
                                                            <td><?= $membros[$key]['status']==0?'Ativo':'Inativo' ?></td>
                                                            <td>
                                                                    <a href="membroAlterar.php?cod=<?= $membros[$key]['id_membro'] ?>" class="btn btn-warning btn-xs">Alterar</a>
                                                                    <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $membros[$key]['id_membro'] ?>','<?= $membros[$key]['nome'] ?>')">Excluir</a>
                                                                </td>
                                                        </tr>
                                                        <?php } ?>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th rowspan="1" colspan="1">Nome</th>
                                                            <th rowspan="1" colspan="1">Email</th>
                                                            <th rowspan="1" colspan="1">Telefone</th>
                                                            <th rowspan="1" colspan="1">Endereço</th>
                                                            <th rowspan="1" colspan="1">Status</th>
                                                            <th rowspan="1" colspan="1">Ações</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>


                                                <form method="post" action="membroListar.php">
                                                    <?php include 'Modals/_modalExcluir.php' ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </row>
                </div>
            </section>
            <!--/Main content-->

        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <footer class="main-footer">
            <?php require_once '_footer.php' ?>
        </footer>
    </div>

    <!-- jQuery -->
    <script src="../../Assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../Assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../../Assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../Assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../Assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../Assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../Assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../Assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../Assets/plugins/jszip/jszip.min.js"></script>
    <script src="../../Assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../Assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../Assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../Assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../Assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../Assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../Assets/dist/js/demo.js"></script>
    <!-- Js da notificão -->
    <script src="../../Assets/plugins/toastr/toastr.min.js"></script>
    <!-- Minhas funções -->
    <script src="../../Assets/dist/js/funcoes.js"></script>


    <?php include_once '_msg.php' ?>

</body>

</html>

Page specific script
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>