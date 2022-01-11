<?php
require '../../vendor/autoload.php';

use App\Controller\FolhaPagamento as ControllerFolhaPagamento;
use App\Model\FolhaPagamento;
use App\Model\Member;
use App\Support\Sessions;

if (isset($_POST['btnConsultar'])) {
    Sessions::RegistrarAtividade();
    if ($_POST['membro'] != '' && $_POST['ano'] != '') {
        $folhaPagamentoModel = new FolhaPagamento;
        $folhaPagamento = $folhaPagamentoModel->consultarFolhaPagamento($_POST['membro'], $_POST['ano'])[0];
    } else {
        $ret = 0;
    }
} else if (isset($_POST['btnSalvar'])) {
    Sessions::RegistrarAtividade();
    $ctrl = new ControllerFolhaPagamento;
    $ret = $ctrl->salvarFolhaPagamento($_POST);
}

$dao = new Member;
$membros = $dao->DevolverMembros();
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
                                <li class="breadcrumb-item active">Mensalidades</li>
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
                            <form method="POST" action="controleMensalidades.php">
                                <div class="card card-gray-dark">
                                    <div class="card-header">
                                        <h3 class="card-title">Controle de mensalidades</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label>Membro</label>
                                                    <select name="membro" class="form-control">
                                                        <option selected disabled>Escolha um membro</option>
                                                        <?php foreach ($membros as $key => $value) { ?>
                                                            <option value="<?= $membros[$key]['id_membro'] ?>"><?= $membros[$key]['nome'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Ano</label>
                                                <select name="ano" class="form-control">
                                                    <option selected disabled>Escolha um ano</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button class="btn btn-success float-lg-right" name="btnConsultar">Consultar</button>
                                    </div>
                                </div>

                                <?php if (isset($folhaPagamento)) { ?>
                                    <input type="hidden" value="<?= $folhaPagamento['id_membro'] ?>" name="id_membro">
                                    <input type="hidden" value="<?= $folhaPagamento['ano'] ?>" name="ano">
                                    <div class="card card-gray-dark">
                                        <div class="card-header">
                                            <h3 class="card-title">Folha de mensalidades <?= $folhaPagamento['nome_membro'] . '/' . $folhaPagamento['ano'] ?></h3>
                                        </div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">Ano</th>
                                                    <th>Janeiro</th>
                                                    <th>Fevereiro</th>
                                                    <th>Março</th>
                                                    <th>Abril</th>
                                                    <th>Maio</th>
                                                    <th>Junho</th>
                                                    <th>Julho</th>
                                                    <th>Agosto</th>
                                                    <th>Setembro</th>
                                                    <th>Outubro</th>
                                                    <th>Novembro</th>
                                                    <th>Dezembro</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?= @$folhaPagamento['ano'] ?></td>
                                                    <td>
                                                        <div class="form-check"><input name="janeiro" class="form-check-input" type="checkbox" <?= @$folhaPagamento['janeiro'] == '1' ? 'checked' : '' ?>><label class="form-check-label"><?= @$folhaPagamento['janeiro'] == '0' ? 'Pendente' : 'Pago' ?></label></div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check"><input name="fevereiro" class="form-check-input" type="checkbox" <?= @$folhaPagamento['fevereiro'] == '1' ? 'checked' : '' ?>><label class="form-check-label"><?= @$folhaPagamento['fevereiro'] == '0' ? 'Pendente' : 'Pago' ?></label></div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check"><input name="marco" class="form-check-input" type="checkbox" <?= @$folhaPagamento['marco'] == '1' ? 'checked' : '' ?>><label class="form-check-label"><?= @$folhaPagamento['marco'] == '0' ? 'Pendente' : 'Pago' ?></label></div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check"><input name="abril" class="form-check-input" type="checkbox" <?= @$folhaPagamento['abril'] == '1' ? 'checked' : '' ?>><label class="form-check-label"><?= @$folhaPagamento['abril'] == '0' ? 'Pendente' : 'Pago' ?></label></div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check"><input name="maio" class="form-check-input" type="checkbox" <?= @$folhaPagamento['maio'] == '1' ? 'checked' : '' ?>><label class="form-check-label"><?= @$folhaPagamento['maio'] == '0' ? 'Pendente' : 'Pago' ?></label></div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check"><input name="junho" class="form-check-input" type="checkbox" <?= @$folhaPagamento['junho'] == '1' ? 'checked' : '' ?>><label class="form-check-label"><?= @$folhaPagamento['junho'] == '0' ? 'Pendente' : 'Pago' ?></label></div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check"><input name="julho" class="form-check-input" type="checkbox" <?= @$folhaPagamento['julho'] == '1' ? 'checked' : '' ?>><label class="form-check-label"><?= @$folhaPagamento['julho'] == '0' ? 'Pendente' : 'Pago' ?></label></div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check"><input name="agosto" class="form-check-input" type="checkbox" <?= @$folhaPagamento['agosto'] == '1' ? 'checked' : '' ?>><label class="form-check-label"><?= @$folhaPagamento['agosto'] == '0' ? 'Pendente' : 'Pago' ?></label></div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check"><input name="setembro" class="form-check-input" type="checkbox" <?= @$folhaPagamento['setembro'] == '1' ? 'checked' : '' ?>><label class="form-check-label"><?= @$folhaPagamento['setembro'] == '0' ? 'Pendente' : 'Pago' ?></label></div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check"><input name="outubro" class="form-check-input" type="checkbox" <?= @$folhaPagamento['outubro'] == '1' ? 'checked' : '' ?>><label class="form-check-label"><?= @$folhaPagamento['outubro'] == '0' ? 'Pendente' : 'Pago' ?></label></div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check"><input name="novembro" class="form-check-input" type="checkbox" <?= @$folhaPagamento['novembro'] == '1' ? 'checked' : '' ?>><label class="form-check-label"><?= @$folhaPagamento['novembro'] == '0' ? 'Pendente' : 'Pago' ?></label></div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check"><input name="dezembro" class="form-check-input" type="checkbox" <?= @$folhaPagamento['dezembro'] == '1' ? 'checked' : '' ?>><label class="form-check-label"><?= @$folhaPagamento['dezembro'] == '0' ? 'Pendente' : 'Pago' ?></label></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="card-footer">
                                            <button class="btn btn-success float-lg-right" name="btnSalvar">Salvar</button>
                                        </div>
                                    </div>
                            </form>
                        <?php } ?>
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