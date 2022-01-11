<!DOCTYPE html>
<html lang="pt-BR">

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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v2</li>
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
                    <!--Seu conteúdo aqui-->
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