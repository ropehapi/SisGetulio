<?php
require '../../vendor/autoload.php';

use App\Controller\User as ControllerUser;
use App\Support\Sessions;
use App\Model\User;
use App\Support\Util;
use App\Support\Validator;

$dao = new User();
$ctrl = new ControllerUser();

if (isset($_POST['btnAlterarDados'])) {
    Sessions::RegistrarAtividade();
    //Validação de campos
    if ($_POST['nome'] == '' || $_POST['email'] == '') {
        $ret = 0;
    } else {
        $valido = true;

        if (!Validator::ValidaEmail($_POST['email'])) {
            $valido = false;
            $emailInv = true;
        }

        if ($valido) {
            $dao->setNome($_POST['nome']);
            $dao->setEmail($_POST['email']);

            $ret = $dao->AlterarDadosMeuUsuario(Sessions::CodigoUserLogado());
        }
    }
} elseif (isset($_POST['btnAlterarSenha'])) {
    Sessions::RegistrarAtividade();
    //Validação de campos
    if ($_POST['senha'] == '' || $_POST['novaSenha'] == '' || $_POST['rNovaSenha'] == '') {
        $ret = 0;
    } else {
        $valido = true;

        //Valida se a senha atual está certa
        if (!$ctrl->ValidarSenha($_POST['senha'])) {
            $valido = false;
            $senhaInc = true;
        }

        //Valida se as senhas digitadas são iguais
        if (!$ctrl->CompararSenhas($_POST['novaSenha'], $_POST['rNovaSenha'])) {
            $valido = false;
            $senhaDif = true;
        }

        if ($valido) {

            $novaSenhaHash = Util::RetornaCriptografado($_POST['novaSenha']);
            $dao->setSenha($novaSenhaHash);

            $ret = $dao->AlterarSenha(Sessions::CodigoUserLogado());
        }
    }
}

$usuario = $dao->DetalharUsuario(Sessions::CodigoUserLogado())[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '_head.php' ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <!--    <div class="preloader flex-column justify-content-center align-items-center">-->
        <!--        <img class="animation__wobble" src="../../Assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"-->
        <!--             width="60">-->
        <!--    </div>-->

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
                                <li class="breadcrumb-item"><a href="#">Sobre mim</a></li>
                                <li class="breadcrumb-item active">Meu perfil</li>
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
                                    <h3 class="card-title">Alterar meus dados</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" action="meuPerfil.php">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Meu nome</label>
                                            <input type="text" class="form-control" name="nome" id="nome" value="<?= $usuario['nome'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Meu email</label>
                                            <input <?= @$emailInv ? 'style="border: red solid thin"' : '' ?> type="email" class="form-control" name="email" id="email" value="<?= $usuario['email'] ?>">
                                            <?php if (@$emailInv) { ?>
                                                <label style="color: red;">Insira um email
                                                    válido</label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button class="btn btn-info float-lg-right" name="btnAlterarDados">Alterar</button>
                                    </div>

                            </div>

                            <div class="card card-gray-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Alterar minha senha</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Senha atual</label>
                                        <input <?= @$senhaInc ? 'style="border: red solid thin"' : '' ?> type="password" class="form-control" id="senha" name="senha">
                                        <?php if (@$senhaInc) { ?>
                                                <label style="color: red;">Sua senha atual está incorreta.</label>
                                            <?php } ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Nova senha</label>
                                        <input <?= @$senhaDif ? 'style="border: red solid thin"' : '' ?> type="password" class="form-control" id="novaSenha" name="novaSenha">
                                    </div>

                                    <div class="form-group">
                                        <label>Repita a nova senha</label>
                                        <input <?= @$senhaDif ? 'style="border: red solid thin"' : '' ?> type="password" class="form-control" id="rNovaSenha" name="rNovaSenha">
                                        <?php if (@$senhaDif) { ?>
                                                <label style="color: red;">As senhas não conferem.</label>
                                            <?php } ?>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button class="btn btn-info float-lg-right" name="btnAlterarSenha">Alterar</button>
                                </div>
                                </form>
                            </div>
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