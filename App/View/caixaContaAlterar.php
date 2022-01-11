<?php
require '../../vendor/autoload.php';

use App\Controller\CaixaConta as ControllerCaixaConta;
use App\Controller\Member;
use App\Model\CaixaConta;
use App\Support\Sessions;
use App\Support\Validator;

@$banco = $_POST['banco'];
@$agencia = $_POST['agencia'];
@$numero = $_POST['numero'];
@$saldo = $_POST['saldo'];

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $dao = new CaixaConta;
    $dados = $dao->DetalharConta($_GET['cod'])[0];

    if (count($dados) == 0) {
        header('location: http://localhost/SoftwareDM/App/View/caixaContas.php');
        exit;
    }
}

if (isset($_POST['btnAlterar'])) {
    Sessions::RegistrarAtividade();
    if ($_POST['banco'] != '' && $_POST['agencia'] != '' && $_POST['numero'] != '' && $_POST['saldo'] != '') {
        
            $ctrl = new ControllerCaixaConta;
            $ret = $ctrl->AlterarConta($_POST, $_GET['cod']);
            header('location: http://localhost/SoftwareDM/App/View/caixaContaAlterar.php?cod=' . $_GET['cod'] . '&ret=' . $ret);

    } else {
        $ret = 0;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '_head.php' ?>
</head>

<body class="hold-transition  sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
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

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-gray-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Atualizar conta</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST" action="caixaContaAlterar.php?cod=<?= $_GET['cod'] ?>">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nome da banco</label>
                                                    <input value="<?= $dados['banco'] ?>" type="text" class="form-control" name="banco" id="banco" placeholder="Ex: Santander, BB, Itaú.">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Agência</label>
                                                    <input value="<?= $dados['agencia'] ?>" type="text" class="form-control" name="agencia" id="agencia" placeholder="Digite sua agência aqui.">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Número da conta</label>
                                                    <input value="<?= $dados['numero'] ?>" type="text" class="form-control" name="numero" id="numero" placeholder="Digite o número da sua conta aqui.">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Saldo</label>
                                                    <input value="<?= $dados['saldo'] ?>" type="text" class="form-control" name="saldo" id="saldo" placeholder="Digite o saldo da conta aqui.">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-info float-right" name="btnAlterar">Alterar</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->

                        </div>
                    </div>
                </div>
            </section>
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