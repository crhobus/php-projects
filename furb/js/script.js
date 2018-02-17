var vApi = 'http://localhost/furb/api/api.php';
var vTemplate = null;
var vFormObj = null;
var vSalvar = '';

$(document).ready(function () {
    obterForm('Livro');
});

function obterForm(tipo) {
    $.ajax({
        url: vApi,
        dataType: 'json',
        method: 'GET'
    })
            .success(function (data) {
                vFormObj = null;
                $.each(data, function (i, obj) {
                    if (obj.object == tipo) {
                        vFormObj = obj;
                        return false;
                    }
                });
                if (vFormObj == null) {
                    log('Objeto ' + tipo + ' não encontrado');
                    return;
                }
                obterOperacao('new');
            })
            .error(function (xmlHttpRequest, textStatus, errorThrown) {
                logErro(xmlHttpRequest, textStatus, errorThrown);
            });
}

function obterOperacao(operacao) {
    $.ajax({
        url: vFormObj.uri,
        dataType: 'json',
        method: vFormObj.method
    })
            .success(function (data) {
                var operationObj = null;
                $.each(data.operations, function (i, obj) {
                    if (obj.operation == operacao
                            && obj.type == 'template') {
                        operationObj = obj;
                        return false;
                    }
                });
                if (operationObj == null) {
                    log('Não foi possível encontrar a operação "' + operacao + '" no template do objeto "' + data.object + '"');
                    return;
                }
                if (operacao == 'new') {
                    montarForm(operationObj);
                } else if (operacao == 'select') {
                    montarRequisicaoLeituraRegistro(operationObj);
                } else if (operacao == 'delete') {
                    montarRequisicaoExcluirRegistro(operationObj);
                } else if (operacao == 'update') {
                    montarRequisicaoAlterarRegistro(operationObj);
                } else if (operacao == 'selectAll') {
                    montarRequisicaoLeituraTodosRegistros(operationObj);
                }
            })
            .error(function (xmlHttpRequest, textStatus, errorThrown) {
                logErro(xmlHttpRequest, textStatus, errorThrown);
            });
}

function montarForm(operationObj) {
    $.ajax({
        url: operationObj.uri,
        dataType: 'json',
        method: operationObj.method
    })
            .success(function (data) {
                vTemplate = data;
                var xFormName = 'frm' + data.object;
                $('#panel').empty();
                $('#console').empty();
                var html = '<form name="' + xFormName + '" id="' + xFormName + '">';
                html += '<fieldset>';
                html += '<legend>' + data.object + '</legend>';
                $.each(data.fields, function (i, obj) {
                    html += '<label for="' + obj.name + '">' + obj.description + ':</label>';
                    html += '<input type="text" id="' + obj.name + '" name="' + obj.name + '" class="field">';
                    html += '<br/>';
                });
                html += '</fieldset>';
                html += '</form>';
                html += '<br/>';
                html += '<input type="button" id="btnNew' + data.object + '" value="Novo" class="button">';
                html += '<input type="button" id="btnSave' + data.object + '" value="Salvar" class="button">';
                html += '<input type="button" id="btnDel' + data.object + '" value="Excluir" class="button">';
                html += '<input type="button" id="btnSelect' + data.object + '" value="Consultar registro" class="button">';
                html += '<input type="button" id="btnSelectAll' + data.object + '" value="Ver todos registros" class="button">';
                $('#panel').html(html);
                createEventsInput(data);
                createEventsButtons(data);
            })
            .error(function (xmlHttpRequest, textStatus, errorThrown) {
                logErro(xmlHttpRequest, textStatus, errorThrown);
            });
}

function createEventsButtons(data) {
    $('#btnNew' + data.object).click(novo);
    $('#btnSave' + data.object).click(salvar);
    $('#btnDel' + data.object).click(excluir);
    $('#btnSelect' + data.object).click(selecionarRegistro);
    $('#btnSelectAll' + data.object).click(selecionarTodosRegistros);
}

function createEventsInput(data) {
    $.each(data.fields, function (i, obj) {
        if (obj.kind == 'integer') {
            $('#' + obj.name).keypress(function (event) {
                return somenteNumeros(event);
            });
        } else if (obj.kind == 'double') {
            $('#' + obj.name).keyup(function () {
                return valor($('#' + obj.name));
            });
        }
    });
}

function salvar() {
    vSalvar = 'S';
    obterOperacao('select');
}

function selecionarRegistro() {
    obterOperacao('select');
}

function montarRequisicaoLeituraRegistro(operationObj) {
    $.ajax({
        url: operationObj.uri,
        dataType: 'json',
        method: operationObj.method
    })
            .success(function (data) {
                obterRegistro(data);
            })
            .error(function (xmlHttpRequest, textStatus, errorThrown) {
                logErro(xmlHttpRequest, textStatus, errorThrown);
            });
}

function obterRegistro(obj) {
    $.ajax({
        url: obj.uri,
        dataType: 'json',
        method: obj.method,
        data: obj.parameter.name + '=' + $('#' + obj.parameter.name).val()
    })
            .success(function (data) {
                if (data.result == 'ERROR') {
                    if (vSalvar == 'S') {
                        doSave();
                    } else {
                        log(data.result + ' - ' + data.message);
                    }
                } else {
                    if (vSalvar == 'S') {
                        vSalvar = 'A';
                        doSave();
                    } else {
                        for (var attr in data.record) {
                            $('#' + attr).val(data.record[attr]);
                        }
                    }
                }
            })
            .error(function (xmlHttpRequest, textStatus, errorThrown) {
                logErro(xmlHttpRequest, textStatus, errorThrown);
            });
}

function excluir() {
    obterOperacao('delete');
}

function montarRequisicaoExcluirRegistro(operationObj) {
    $.ajax({
        url: operationObj.uri,
        dataType: 'json',
        method: operationObj.method
    })
            .success(function (data) {
                deletarRegistro(data);
            })
            .error(function (xmlHttpRequest, textStatus, errorThrown) {
                logErro(xmlHttpRequest, textStatus, errorThrown);
            });
}

function deletarRegistro(obj) {
    $.ajax({
        url: obj.uri,
        dataType: 'json',
        method: obj.method,
        data: obj.parameter.name + '=' + $('#' + obj.parameter.name).val()
    })
            .success(function (data) {
                log(data.result + ' - ' + data.message);
            })
            .error(function (xmlHttpRequest, textStatus, errorThrown) {
                logErro(xmlHttpRequest, textStatus, errorThrown);
            });
}

function montarRequisicaoAlterarRegistro(operationObj) {
    $.ajax({
        url: operationObj.uri,
        dataType: 'json',
        method: operationObj.method
    })
            .success(function (data) {
                alterarRegistro(data);
            })
            .error(function (xmlHttpRequest, textStatus, errorThrown) {
                logErro(xmlHttpRequest, textStatus, errorThrown);
            });
}

function alterarRegistro(data) {
    var xData = new FormData();
    $.each(data.fields, function (i, obj) {
        xData.append(obj.name, $('#' + obj.name).val());
    });

    $.ajax({
        url: data.uri,
        dataType: 'json',
        method: data.method,
        processData: false,
        contentType: false,
        data: xData
    })
            .success(function (data) {
                log(data.result + ' - ' + data.message);
            })
            .error(function (xmlHttpRequest, textStatus, errorThrown) {
                logErro(xmlHttpRequest, textStatus, errorThrown);
            })
            .complete(function () {
                vSalvar = '';
            });
}

function doSave() {
    if (vSalvar == 'A') {
        obterOperacao('update');
    } else {
        var xData = new FormData();
        $.each(vTemplate.fields, function (i, obj) {
            xData.append(obj.name, $('#' + obj.name).val());
        });

        $.ajax({
            url: vTemplate.uri,
            dataType: 'json',
            method: vTemplate.method,
            processData: false,
            contentType: false,
            data: xData
        })
                .success(function (data) {
                    log(data.result + ' - ' + data.message);
                })
                .error(function (xmlHttpRequest, textStatus, errorThrown) {
                    logErro(xmlHttpRequest, textStatus, errorThrown);
                })
                .complete(function () {
                    vSalvar = '';
                });
    }
}

function selecionarTodosRegistros() {
    obterOperacao('selectAll');
}

function montarRequisicaoLeituraTodosRegistros(operationObj) {
    $.ajax({
        url: operationObj.uri,
        dataType: 'json',
        method: operationObj.method
    })
            .success(function (data) {
                obterTodosRegistros(data);
            })
            .error(function (xmlHttpRequest, textStatus, errorThrown) {
                logErro(xmlHttpRequest, textStatus, errorThrown);
            });
}

function obterTodosRegistros(obj) {
    $.ajax({
        url: obj.uri,
        dataType: 'json',
        method: obj.method
    })
            .success(function (data) {
                $('#tabela').empty();
                if (data.result == 'ERROR') {
                    log(data.result + ' - ' + data.message);
                } else {
                    var html = '<table class="tabela">';
                    html += '<thead>';
                    html += '<tr>';
                    $.each(data.descriptions, function (i, obj) {
                        html += '<th>' + obj.description + '</th>';
                    });
                    html += '</tr>';
                    html += '</thead>';
                    html += '<tbody>';

                    $.each(data.records, function (i, obj) {
                        html += '<tr>';
                        $.each(obj, function (y, o) {
                            html += '<td>' + o + '</td>';
                        });
                        html += '</tr>';
                    });

                    html += '</tbody>';
                    html += '</table>';
                    $('#tabela').html(html);
                }
            })
            .error(function (xmlHttpRequest, textStatus, errorThrown) {
                logErro(xmlHttpRequest, textStatus, errorThrown);
            });
}

function novo() {
    obterOperacao('new');
}

function logErro(xmlHttpRequest, textStatus, errorThrown) {
    log('Erro: ' + xmlHttpRequest.status + ' - ' + errorThrown);
}

function log(texto) {
    $('#console').empty();
    var html = $('#console').html();
    html = '<span class="log">' + getDateTime() + ' - ' + texto + '</span><br/>' + html;
    $('#console').html(html);
}

function getDateTime() {
    var now = new Date();

    var day = now.getDate();
    if (day < 10) {
        day = '0' + day;
    }

    var month = now.getMonth();
    month++;
    if (month < 10) {
        month = '0' + month;
    }

    var year = now.getFullYear();

    var hours = now.getHours();
    if (hours < 10) {
        hours = '0' + hours;
    }

    var minute = now.getMinutes();
    if (minute < 10) {
        minute = '0' + minute;
    }

    var second = now.getSeconds();
    if (second < 10) {
        second = '0' + second;
    }

    return day + '/' + month + '/' + year + ' ' + hours + ':' + minute + ':' + second;
}

function somenteNumeros(event) {
    var tecla = (window.event) ? event.keyCode : event.which;

    if ((tecla >= 48 && tecla <= 57) || (tecla >= 0 && tecla <= 31)) {
        return true;
    } else {
        return false;
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
