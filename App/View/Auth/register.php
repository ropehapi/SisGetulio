<?php
//Requires de namespaces + autoload
use App\Controller\Usuario;
use App\Support\Util;
use App\Model\Usuario as ModelUsuario;
use App\Support\Validator;

require_once '../../../vendor/autoload.php';

@$nome = $_POST['nome'];
@$email = $_POST['email'];

if (isset($_POST['btnRegistrar'])) {

    $ctrl = new Usuario;
    $util = new Util;

    if ($_POST['nome'] == '' || $_POST['email'] == '' || $_POST['senha'] == '' || $_POST['rSenha'] == '' || @$_POST['termos'] != 'aceito') {
        $ret = -3;
    } else {
        $valido = true;

        //Validações
        if (!Validator::ValidaEmail($_POST['email'])) {
            $valido = false;
            $emailInv = true;
        }
        if (!$ctrl->ConsultarEmail($_POST['email'])) {
            $valido = false;
            $emailExist = true;
        }
        if (!$ctrl->CompararSenhas($_POST['senha'], $_POST['rSenha'])) {
            $valido = false;
            $senhaDif = true;
        }

        if ($valido) {
            $dao = new ModelUsuario;

            $dao->setNome($_POST['nome']);
            $dao->setEmail($_POST['email']);
            $dao->setSenha($util->RetornaCriptografado($_POST['senha']));

            $ret = $dao->InserirUsuario();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OnlineRPG | Cadastro</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../Assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../../Assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../Assets/dist/css/adminlte.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../../../Assets/plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition register-page">
<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="../../../Assets/index2.html" class="h1"><b>Online</b>RPG</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Cadastre-se</p>

            <form action="register.php" method="POST">

                <div class="input-group mb-3">
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome completo" value="<?= isset($nome) ? $nome : '' ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input <?= @$emailInv || @$emailExist ? 'style="border: red solid thin"' : '' ?> type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?= isset($email) ? $email : '' ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <!--Labels que devem ser exibidas caso os dados não sejam válidos-->
                <?php if (@$emailInv) { ?>
                    <label style="color: red;">Insira um email
                        válido</label>
                <?php } ?>
                <?php if (@$emailExist) { ?>
                    <label style="color: red;">Esse email já está
                        cadastrado</label>
                <?php } ?>

                <div class="input-group mb-3">
                    <input <?= @$senhaDif ? 'style="border: red solid thin"' : '' ?> type="password" name="senha" id="senha" class="form-control" placeholder="Senha">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <!--Labels que devem ser exibidas caso os dados não sejam válidos-->
                <?php if (@$senhaDif) { ?>
                    <label style="color: red;">As senhas não conferem</label>
                <?php } ?>

                <div class="input-group mb-3">
                    <input type="password" name="rSenha" id="rSenha" class="form-control" placeholder="Repita sua senha">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <?php if (@$senhaDif) { ?>
                    <label style="color: red;">As senhas não conferem</label>
                <?php } ?>

                <div class="row">
                    <div class="col-12">
                        <div class="icheck-primary">
                            <input type="checkbox" id="termos" name="termos" value="aceito">
                            <label for="termos">
                                Eu li e concordo com os <a href="#">termos de uso</a>
                            </label>
                        </div>
                    </div>

                    <div class="col-12" align="center">
                        <button type="submit" name="btnRegistrar" onclick="return ValidarTela(1)" class="btn btn-primary btn-block">Registrar</button>
                    </div>
                </div>

            </form>

            <a href="login.php" class="text-center">Já tenho uma conta</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../../Assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../../Assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../Assets/dist/js/adminlte.min.js"></script>
<!-- Js da notificão -->
<script src="../../../Assets/plugins/toastr/toastr.min.js"></script>

<!-- Meus JS -->
<script src="../../../Assets/dist/js/validacao.js"></script>
<script src="../../../Assets/dist/js/funcoes.js"></script>

<?php include_once '../_msg.php' ?>
</body>

</html>