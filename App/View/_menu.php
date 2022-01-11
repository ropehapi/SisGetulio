<?php
require '../../vendor/autoload.php';

use App\Model\User;
use App\Support\Sessions;

if (isset($_GET['close']) && $_GET['close'] == '1') {
    Sessions::Deslogar();
}
$dao = new User;
$nomeUserLogado = $dao->DetalharUsuario(Sessions::CodigoUserLogado())[0]['nome'];
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="../../Assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SisGetúlio</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../Assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="meuPerfil.php" class="d-block"><?= $nomeUserLogado ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->

                <li class="nav-header">Usuários</li>
                <li class="nav-item">
                    <a href="meuPerfil.php" class="nav-link">
                        <i class="fas fa-user"></i>
                        <p>Meu perfil</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="usuarioCadastrar.php" class="nav-link">
                        <i class="fas fa-user-plus"></i>
                        <p>Cadastrar Usuários</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="usuarioListar.php" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p>Listar usuários</p>
                    </a>
                </li>

                <li class="nav-header">Membros</li>
                <li class="nav-item">
                    <a href="membroCadastrar.php" class="nav-link">
                        <i class="fas fa-user-plus"></i>
                        <p>Cadastrar membros</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="membroListar.php" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p>Listar membros</p>
                    </a>
                </li>

                <li class="nav-header">Tesouraria</li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cash-register"></i>
                        <p>
                            Fluxo de caixa
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="caixaCategorias.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categorias</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="caixaEmpresas.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Empresas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="caixaContas.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="caixa.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cadastrar movimento</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="controleMensalidades.php" class="nav-link">
                        <i class="fas fa-coins"></i>
                        <p>Controle mensalidades</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="controlePromoções.php" class="nav-link">
                        <i class="fas fa-coins"></i>
                        <p>Controle promoções</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-archive"></i>
                        <p>
                            Arquivos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="arquivosCategorias.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categorias</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="arquivos.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Arquivar documento</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="_menu.php?close=1" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>
                            Sair
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>