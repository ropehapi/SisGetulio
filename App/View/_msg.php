<?php

if (isset($_GET['ret'])) {
    $ret = $_GET['ret'];
}

if (isset($ret)) {

    switch ($ret) {
        case -7:
            echo "<script>
                    toastr.warning('Por favor, escolha ao menos um setor');
                </script>";
            break;

        case -6:
            echo "<script>
                    toastr.error('Senha incorreta, tente novamente');
                </script>";
            break;

        case -5:
            echo "<script>
                    toastr.error('Login e/ou senha incorreto(s), tente novamente');
                </script>";
            break;

        case -4:
            echo "<script>
                    toastr.error('Já existe um usuário com esse email');
                </script>";
            break;
        case -3:
            echo "<script>
                    toastr.warning('Por favor, preencha todos os campos e aceite os termos');
                </script>";
            break;
        case -2:
            echo "<script>
                    toastr.warning('As senhas não conferem');
                </script>";
            break;

        case -1:
            echo "<script>
                        toastr.error('Ocorreu um erro durante a operação, tente novamente mais tarde');
                    </script>";
            break;

        case 0:
            echo "<script>
                        toastr.warning('Por favor, preencha todos os campos');
                    </script>";
            break;

        case 1:
            echo "<script>
                    toastr.success('Cadastro realizado com sucesso');
                </script>";
            break;

        case 2:
            echo "<script>
                    toastr.success('Dados atualizados com sucesso');
                </script>";
            break;

        case 3:
            echo "<script>
                    toastr.success('Senha alterada com sucesso');
                </script>";
            break;

        case 4:
            echo "<script>
                        toastr.success('Item excluido com sucesso');
                    </script>";
            break;
        case 5:
            echo "<script>
                        toastr.success('Folha de pagamentos alterada com sucesso');
                    </script>";
            break;
    }
}
