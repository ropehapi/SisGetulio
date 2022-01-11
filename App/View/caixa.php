<?php
require '../../vendor/autoload.php';

use App\Controller\Movimento;
use App\Model\CaixaCategory;
use App\Model\CaixaConta;
use App\Model\CaixaEmpresa;
use App\Support\Sessions;

$categoriaModel = new CaixaCategory;
$empresaModel = new CaixaEmpresa;
$contaModel = new CaixaConta;

if(isset($_POST['btnCadastrar'])){
    Sessions::RegistrarAtividade();
    if($_POST['tipo']!=''&&$_POST['categoria']!=''&&$_POST['data']!=''&&$_POST['empresa']!=''&&$_POST['valor']!=''&&$_POST['conta']){
        var_dump('cu');
        $movimentoController = new Movimento;
        $ret = $movimentoController->inserirMovimento($_POST);
    }else{
        $ret = 0;
    }
}

$categorias = $categoriaModel->DevolverCategorias();
$empresas = $empresaModel->DevolverEmpresas();
$contas = $contaModel->DevolverContas();
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
                                <li class="breadcrumb-item active">Fluxo de caixa</li>
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
                                    <h3 class="card-title">Cadastrar movimento</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST" action="caixa.php">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tipo de movimento</label>
                                                    <select name="tipo" class="form-control">
                                                        <option selected disabled>Escolha um tipo de movimento</option>
                                                        <option value="0">Entrada</option>
                                                        <option value="1">Saída</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <label>Categoria</label>
                                                    <select name="categoria" class="form-control">
                                                        <option selected disabled>Escolha uma categoria</option>
                                                        <?php foreach ($categorias as $key => $value) { ?>
                                                        <option value="<?= $categorias[$key]['id_categoria'] ?>"><?= $categorias[$key]['nome'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Data</label>
                                                    <input name="data" type="date" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <label>Empresa</label>
                                                    <select name="empresa" class="form-control">
                                                        <option selected disabled>Escolha uma empresa</option>
                                                        <?php foreach ($empresas as $key => $value) { ?>
                                                        <option value="<?= $empresas[$key]['id_empresa'] ?>"><?= $empresas[$key]['nome'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Valor</label>
                                                    <input name="valor" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <label>Conta</label>
                                                    <select name="conta" class="form-control">
                                                        <option selected disabled>Escolha uma conta</option>
                                                        <?php foreach ($contas as $key => $value) { ?>
                                                        <option value="<?= $contas[$key]['id_conta'] ?>"><?= $contas[$key]['banco'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Observação(Opcional)</label>
                                                    <textarea name="observacao" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-info float-right" name="btnCadastrar">Cadastrar</button>
                                    </div>
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