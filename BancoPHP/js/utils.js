function somenteNumeros(event) {
    var tecla = (window.event) ? event.keyCode : event.which;

    if ((tecla >= 0 && tecla <= 31)
            || (tecla >= 48 && tecla <= 57)) {
        return true;
    } else {
        return false;
    }
}

function caracteresDigitosSenha(event) {
    var tecla = (window.event) ? event.keyCode : event.which;

    if ((tecla >= 0 && tecla <= 31)
            || (tecla >= 48 && tecla <= 57)
            || (tecla >= 64 && tecla <= 90)
            || (tecla >= 97 && tecla <= 122)) {
        return true;
    } else {
        return false;
    }
}

function caracteresMaiusculos(event) {
    var tecla = (window.event) ? event.keyCode : event.which;

    if ((tecla >= 0 && tecla <= 31)
            || (tecla >= 65 && tecla <= 90)) {
        return true;
    } else {
        return false;
    }
}

function nomeUsuario() {
    var nmUsuario = $('#nome').val().split(" ");

    var str = "";
    var s = "";
    for (var i = 0; i < nmUsuario.length; i++) {
        str = nmUsuario[i];
        if (i == nmUsuario.length - 1) {
            s = s.concat(str);
        } else {
            s = s.concat(str.substring(0, 1));
        }
    }

    if (!$('#usuario').prop('readonly')) {
        $('#usuario').val(s.toLowerCase());
    }
}

function valor(value) {
    v = value.val();
    v = v.replace(/\D/g, "");  //permite digitar apenas números
    v = v.replace(/[0-9]{12}/, "invalid");//limita pra máximo 999.999.999,99
    v = v.replace(/(\d{1})(\d{8})$/, "$1.$2");//coloca ponto antes dos últimos 8 digitos
    v = v.replace(/(\d{1})(\d{5})$/, "$1.$2");//coloca ponto antes dos últimos 5 digitos
    v = v.replace(/(\d{1})(\d{1,2})$/, "$1,$2");//coloca virgula antes dos últimos 2 digitos
    if (v == "invalid") {
        value.val("");
    } else {
        value.val(v);
    }
}
