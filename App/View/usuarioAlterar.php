<?php
require '../../vendor/autoload.php';

use App\Controller\User;
use App\Model\User as ModelUser;
use App\Support\Sessions;
use App\Support\Validator;

@$nome = $_POST['nome'];
@$email = $_POST['email'];
@$secretaria = $_POST['secretaria'];
@$hospitalaria = $_POST['hospitalaria'];
@$tesouraria = $_POST['tesouraria'];
@$controladoria = $_POST['controladoria'];
@$materiais = $_POST['materiais'];
@$status = $_POST['status'];

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $dao = new ModelUser;
    $dados = $dao->DetalharUsuario($_GET['cod']);

    if (count($dados) == 0) {
        header('location: http://localhost/SoftwareDM/App/View/usuarioListar.php');
        exit;
    }
}

if (isset($_POST['btnAlterar'])) {
    Sessions::RegistrarAtividade();
    if ($_POST['nome'] != '' && $_POST['email'] != '' && $_POST['status'] != '') {
        if (@$_POST['secretaria'] != '' || @$_POST['hospitalaria'] != '' || @$_POST['tesouraria'] != '' || @$_POST['controladoria'] != '' || @$_POST['materiais'] != '') {
            $valido = true;

            if (!Validator::ValidaEmail($_POST['email'])) {
                $valido = false;
                $emailInv = true;
            }

            if ($valido) {
                $ctrl = new User;
                $ret = $ctrl->AlterarUsuario($_POST,$_GET['cod']);
                header('location: http://localhost/SoftwareDM/App/View/usuarioAlterar.php?cod='.$_GET['cod'].'&ret='.$ret);
            }
        } else {
            $ret = -7;
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
                                <li class="breadcrumb-item"><a href="#">Usuários</a></li>
                                <li class="breadcrumb-item active">Atualizar usuário</li>
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
                                    <h3 class="card-title">Atualizar usuário</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST" action="usuarioAlterar.php?cod=<?= $_GET['cod'] ?>">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nome completo</label>
                                                    <input name="nome" type="text" class="form-control" value="<?= $dados[0]['nome'] ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input <?= @$emailInv || @$emailExist ? "style='border:red solid thin'" : '' ?> name="email" type="email" class="form-control" value="<?= $dados[0]['email'] ?>">

                                                    <?php if (@$emailInv) { ?>
                                                        <label style="color: red;">Por favor, insira um formato de email válido.</label>
                                                    <?php } ?>

                                                    <?php if (@$emailExist) { ?>
                                                        <label style="color: red;">Já existe um usuário com este email.</label>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Setores</label>
                                                    <div class="form-check">
                                                        <input name="secretaria" class="form-check-input" type="checkbox" <?= isset($dados[0]['secretaria']) ? 'checked' : '' ?>>
                                                        <label class="form-check-label">Secretaria</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input name="hospitalaria" class="form-check-input" type="checkbox" <?= isset($dados[0]['hospitalaria']) ? 'checked' : '' ?>>
                                                        <label class="form-check-label">Hospitalaria</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input name="tesouraria" class="form-check-input" type="checkbox" <?= isset($dados[0]['tesouraria']) ? 'checked' : '' ?>>
                                                        <label class="form-check-label">Tesouraria</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <div class="form-check">
                                                        <input name="controladoria" class="form-check-input" type="checkbox" <?= isset($dados[0]['controladoria']) ? 'checked' : '' ?>>
                                                        <label class="form-check-label">Controladoria</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input name="materiais" class="form-check-input" type="checkbox" <?= isset($dados[0]['materiais']) ? 'checked' : '' ?>>
                                                        <label class="form-check-label">Materiais</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <label>Status</label>
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status" value="0" <?= $dados[0]['status'] == 0 ? 'checked' : '' ?>>
                                                        <label class="form-check-label">Ativo</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status" value="1" <?= $dados[0]['status'] == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label">Inativo</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button name="btnAlterar" class="btn btn-info float-right">Alterar</button>
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