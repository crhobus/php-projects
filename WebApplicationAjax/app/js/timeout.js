$(document).ready(function () {
    $('#carregando').hide();
    $('#btnCarregar').click(montarNome);
});

function montarNome() {
    $.ajax({
        url: 'php/timeout.php',
        timeout: 2000,
        method: 'POST',
        data: {nome: 'Caio', sobrenome: 'Hobus'},
        dataType: 'json',
        beforeSend: function () {
            $('#carregando').show();
        }
    })
            .success(function (data) {
                $('#dados').prepend('<br/>' + data.nome + ' ' + data.sobrenome);
            })
            .error(function (obj, status, error) {
                $('#dados').prepend('<br/>' + error);
            })
            .complete(function () {
                $('#carregando').hide();
            });
}
