<?php
require '../../vendor/autoload.php';

use App\Model\CaixaEmpresa;
use App\Support\Sessions;

$dao = new CaixaEmpresa;

if (isset($_POST['btnAdicionarEmpresa'])) {
    Sessions::RegistrarAtividade();
    $dao->setNome($_POST['nome']);
    $ret = $dao->InserirEmpresa();
}else if (isset($_POST['btnExcluir'])) {
    Sessions::RegistrarAtividade();
    $ret = $dao->ExcluirEmpresa($_POST['cod_item']);
}

$empresas = $dao->DevolverEmpresas();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '_head.php' ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

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
                                <li class="breadcrumb-item"><a href="#">Tesouraria</a></li>
                                <li class="breadcrumb-item active">Caixa/Empresas</li>
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
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-gray-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Cadastrar empresa</h3>
                                </div>

                                <form method="post" action="caixaEmpresas.php">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Nome da empresa</label>
                                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Ex: Comprovantes, Boletos.">
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button class="btn btn-success float-lg-right" name="btnAdicionarEmpresa">Adicionar</button>
                                    </div>
                                </form>

                            </div>

                            <div class="card card-gray-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Empresas</h3>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Nome</th>
                                            <th class="float-right">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($empresas as $key => $value) { ?>
                                            <tr>
                                                <td><?= $empresas[$key]['id_empresa'] ?></td>
                                                <td><?= $empresas[$key]['nome'] ?></td>
                                                <td>
                                                    <a class="btn btn-danger btn-xs float-right" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $empresas[$key]['id_empresa'] ?>','<?= $empresas[$key]['nome'] ?>')">Excluir</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <form method="post" action="caixaEmpresas.php">
                                <?php include 'Modals/_modalExcluir.php' ?>
                            </form>

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

    <!-- Scripts -->
    <?php require_once '_scripts.php' ?>
    <?php include_once '_msg.php' ?>

</body>

</html>