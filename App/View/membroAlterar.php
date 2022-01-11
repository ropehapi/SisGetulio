<?php
require '../../vendor/autoload.php';

use App\Controller\Member;
use App\Model\Member as ModelMember;
use App\Support\Sessions;
use App\Support\Validator;

@$nome = $_POST['nome'];
@$email = $_POST['email'];
@$email = $_POST['telefone'];
@$email = $_POST['endereco'];
@$status = $_POST['status'];

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $dao = new ModelMember;
    $dados = $dao->DetalharMembro($_GET['cod']);

    if (count($dados) == 0) {
        header('location: http://localhost/SoftwareDM/App/View/membroListar.php');
        exit;
    }
}

if (isset($_POST['btnAlterar'])) {
    Sessions::RegistrarAtividade();
    if ($_POST['nome'] != '' && $_POST['email'] != '' && $_POST['telefone'] != '' && $_POST['endereco'] != '' && $_POST['status'] != '') {
        $valido = true;

        if (!Validator::ValidaEmail($_POST['email'])) {
            $valido = false;
            $emailInv = true;
        }

        if ($valido) {
            $ctrl = new Member;
            $ret = $ctrl->AlterarMembro($_POST, $_GET['cod']);
            header('location: http://localhost/SoftwareDM/App/View/membroAlterar.php?cod=' . $_GET['cod'] . '&ret=' . $ret);
        }
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
                                <li class="breadcrumb-item"><a href="#">Membros</a></li>
                                <li class="breadcrumb-item active">Atualizar membros</li>
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
                                    <h3 class="card-title">Atualizar membro</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST" action="membroAlterar.php?cod=<?= $_GET['cod'] ?>">
                                    <div class="card-body">

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" align="right">Nome completo</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nome" value="<?= $dados[0]['nome'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" align="right">Email</label>
                                            <div class="col-sm-10">
                                                <input <?= @$emailInv || @$emailExist ? "style='border:red solid thin'" : '' ?> type="email" class="form-control" name="email" value="<?= $dados[0]['email'] ?>">
                                            </div>
                                            <?php if (@$emailInv) { ?>
                                                <label style="color: red;">Por favor, insira um formato de email válido.</label>
                                            <?php } ?>

                                            <?php if (@$emailExist) { ?>
                                                <label style="color: red;">Já existe um usuário com este email.</label>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" align="right">Telefone</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="telefone" value="<?= $dados[0]['telefone'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" align="right">Endereço</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="endereco" value="<?= $dados[0]['endereco'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" align="right">Status</label>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" value="0" <?= $dados[0]['status']==0?'checked':'' ?>>
                                                    <label class="form-check-label">Ativo</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" value="1" <?= $dados[0]['status']==1?'checked':'' ?>>
                                                    <label class="form-check-label">Inativo</label>
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