<?php
require '../../vendor/autoload.php';

use App\Model\CaixaConta;
use App\Support\Sessions;

$dao = new CaixaConta;

if (isset($_POST['btnAdicionarConta'])) {
    Sessions::RegistrarAtividade();

    $dao->setBanco($_POST['banco']);
    $dao->setAgencia($_POST['agencia']);
    $dao->setNumero($_POST['numero']);
    $dao->setSaldo($_POST['saldo']);

    $ret = $dao->InserirConta();
} else if (isset($_POST['btnExcluir'])) {
    Sessions::RegistrarAtividade();
    $ret = $dao->ExcluirConta($_POST['cod_item']);
}

$contas = $dao->DevolverContas();
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
                                <li class="breadcrumb-item active">Caixa/Contas</li>
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
                                    <h3 class="card-title">Cadastrar conta</h3>
                                </div>

                                <form method="post" action="caixaContas.php">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nome da banco</label>
                                                    <input type="text" class="form-control" name="banco" id="banco" placeholder="Ex: Santander, BB, Itaú.">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Agência</label>
                                                    <input type="text" class="form-control" name="agencia" id="agencia" placeholder="Digite sua agência aqui.">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Número da conta</label>
                                                    <input type="text" class="form-control" name="numero" id="numero" placeholder="Digite o número da sua conta aqui.">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Saldo</label>
                                                    <input type="text" class="form-control" name="saldo" id="saldo" placeholder="Digite o saldo da conta aqui.">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button class="btn btn-success float-lg-right" name="btnAdicionarConta">Adicionar</button>
                                    </div>
                                </form>

                            </div>

                            <div class="card card-gray-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Contas</h3>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Banco</th>
                                            <th>Agência</th>
                                            <th>Número da conta</th>
                                            <th>Saldo</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($contas as $key => $value) { ?>
                                            <tr>
                                                <td><?= $contas[$key]['id_conta'] ?></td>
                                                <td><?= $contas[$key]['banco'] ?></td>
                                                <td><?= $contas[$key]['agencia'] ?></td>
                                                <td><?= $contas[$key]['numero'] ?></td>
                                                <td><?= $contas[$key]['saldo'] ?></td>
                                                <td>
                                                    <a href="caixaContaAlterar.php?cod=<?= $contas[$key]['id_conta'] ?>" class="btn btn-warning btn-xs">Alterar</a>
                                                    <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $contas[$key]['id_conta'] ?>','<?= $contas[$key]['banco'] ?>')">Excluir</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <form method="post" action="caixaContas.php">
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