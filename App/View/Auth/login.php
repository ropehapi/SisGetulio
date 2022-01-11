<?php
require_once '../../../vendor/autoload.php';
use App\Controller\User;
use App\Support\Validator;

@$email = $_POST['email'];

if (isset($_POST['btnEntrar'])) {
    if ($_POST['email'] == '' || $_POST['senha'] == '') {
        $ret = 0;
    } else {
        $valido = true;

        if(!Validator::ValidaEmail($_POST['email'])){
            $valido= false;
            $emailInv = true;
        }

        if($valido){
            $ctrl = new User;
            $ret = $ctrl->ValidarLogin($_POST['email'], $_POST['senha']);
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SisGetúlio</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../Assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../../Assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../Assets/dist/css/adminlte.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../../../Assets/plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="../../../Assets/index2.html" class="h1"><b>Sis</b>Getúlio</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Inicie a sua sessão</p>

            <form action="login.php" method="POST">

                <div class="input-group mb-3">
                    <input  <?= @$emailInv ? 'style="border: red solid thin"' : '' ?> type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?= isset($email)?$email:''?>">
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

                <div class="input-group mb-3">
                    <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Lembrar-me
                            </label>
                        </div>
                    </div>

                    <!-- /.col -->
                    <div class="col-4">
                        <button name="btnEntrar" onclick="return ValidarTela(2)" class="btn btn-primary btn-block">
                            Entrar
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!-- /.social-auth-links -->

            <p class="mb-1">
                <a href="forgotPassword.php">Esqueci minha senha</a>
            </p>
            <p class="mb-0">
                <a href="register.php" class="text-center">Criar conta</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

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
