$(document).ready(function () {
    $('#btnUpload').click(upload);
});

function upload() {
    var data = new FormData();
    var file = $('#file')[0].files[0];

    data.append('file', file);

    $.ajax({url: 'php/upload.php',
        method: 'POST',
        processData: false,
        contentType: false,
        data: data})
            .success(function (data) {
                $('body').append('<hr/>' + data);
            })
            .error(function (obj, status, erro) {
                alert('Erro ' + status + ', ' + erro);
            });
}
