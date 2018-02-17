$(document).ready(function () {
    $('#btnLoad').click(loadData);
});


function loadData() {
    var url = 'http://www.koiote.com.br/dojsonp.php?koiote_json_callback=?';
    $('#dados').empty();
    $('#dados').html('<span style="border: 1px solid #000; background-color:yellow; text-align:center; padding:3px; color:red">Carregando...</span>');

    $.getJSON(url).done(function (data) {
        processData(data);
    })
            .fail(function (obj, status, erro) {
                $('#dados').empty();
                var text = $('span')
                        .css('color', 'red').
                        text('Erro: ' + status + ' (' + erro + ')');
                $('#dados').append(text);
            });
}

function processData(data) {
    $('#dados').empty();
    var html = '<table>'
            + '<thead>'
            + '<tr>'
            + '<th>Id</th>'
            + '<th>Nome</th>'
            + '<th>E-Mail</th>'
            + '</tr>'
            + '</thead>'
            + '<tbody>';
    $('input[value=""]').attr('value', data.length);
    $('label:eq(2) > span').text('Todos[' + data.length + ']');

    var numReg = $(':checked').attr('value');
    $.each(data, function (i, obj) {
        if (i < numReg) {
            html += '<tr>'
                    + '<td>'
                    + obj.id
                    + '</td>'
                    + '<td>'
                    + obj.nome
                    + '</td>'
                    + '<td>'
                    + obj.email
                    + '</td>'
                    + '</tr>';
        } else {
            return false;
        }
    });

    html += '</tbody>'
            + '</table>';

    $('#dados').append(html);

    $('#dados table thead tr').css('backgroundColor', '#e3f1ff');
    $('#dados table tbody tr:odd').css('backgroundColor', '#f6faff');
    $('#dados tbody td:first-child').css('backgroundColor', '#e3f1ff');
}
