<?php
require '../../vendor/autoload.php';

use App\Model\ArquivosCategory;
use App\Model\File;
use App\Support\Sessions;
use App\Support\Util;

$categoryModel = new ArquivosCategory;
$categorias = $categoryModel->DevolverCategorias();

if(isset($_POST['btnEnviar'])){
    Sessions::RegistrarAtividade();
    if(isset($_FILES['arquivo'])){
        if(@$_POST['categoria']!='' && $_POST['data_hora_arquivo']!=''){
            $dao = new File;
            $categoria = $categoryModel->TraduzirCategoria($_POST['categoria'])[0]['nome'];

            $nomeArquivo = $categoria. '-' . $_POST['data_hora_arquivo']. '-' .$_FILES['arquivo']['name'];
            $diretorio = "uploads/";
    
            if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$nomeArquivo)){
                $ret = 2;
            }else{
                $ret = -1;
            }
    
        }else{
            $ret = 0;
        }
        
    }
}
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
                                <li class="breadcrumb-item active">Arquivos</li>
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
                            <form method="POST" action="arquivos.php" enctype="multipart/form-data">
                                <div class="card card-gray-dark">
                                    <div class="card-header">
                                        <h3 class="card-title">Arquivar documento</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="customFile">Arquivo</label>
                                            <div class="custom-file">
                                                <input required name="arquivo" type="file" id="customFile">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
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

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Data</label>
                                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                        <input name="data_hora_arquivo" type="date" class="form-control datetimepicker-input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button class="btn btn-success float-lg-right" name="btnEnviar">Arquivar</button>
                                    </div>
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