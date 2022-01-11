
function ValidarTela(tela) {
    var ret = true;

    switch (tela) {
        case 1:
            if ($("#nome").val().trim() == '' || $("#email").val().trim() == '' || $("#senha").val().trim() == '' || $("#rSenha").val().trim() == '') {
                toastr.warning('Por favor, preencha todos os campos');
                ret = false;
            }
            break;

        case 2:
            if ($("#email").val().trim() == '' || $("#senha").val().trim() == '') {
                toastr.warning('Por favor, preencha todos os campos');
                ret = false;
            }
            break;

        case 3:
            if ($("#nome").val().trim() == '' || $("#email").val().trim() == '') {
                toastr.warning('Por favor, preencha todos os campos');
                ret = false;
            }
            break;

        case 4:
            if ($("#senha").val().trim() == '' || $("#novaSenha").val().trim() == '' || $("#rNovaSenha").val().trim() == '') {
                toastr.warning('Por favor, preencha todos os campos');
                ret = false;
            }
            break;

        case 5:
            if ($("#categoria").val().trim() == '' || $("#data").val().trim() == '') {
                toastr.warning('Por favor, preencha todos os campos');
                ret = false;
            }
            break;
    }

    return ret;
}