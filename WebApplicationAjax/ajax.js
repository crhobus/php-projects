var vUrl = 'books.php';

function getAjax() {
    return new XMLHttpRequest();
}

document.addEventListener('DOMContentLoaded', function () {
    getEl('btnSelect').onclick = btnSelectClick;
    getEl('btnNew').onclick = btnNewClick;
    getEl('btnSave').onclick = btnSaveClick;
    getEl('btnDelete').onclick = btnDeleteClick;
});

function getEl(id) {
    return document.getElementById(id);
}

function getVal(id) {
    return getEl(id).value;
}

function setVal(id, value) {
    getEl(id).value = value;
}

function showMsg() {
    getEl('msg').style.visibility = 'visible';
    //getEl('msg').style.display = 'block';
}

function hideMsg() {
    getEl('msg').style.visibility = 'hidden';
    //getEl('msg').style.display = 'none';
}

function showLoading() {
    getEl('msg').innerHTML = '<img src="loading.gif" alt="Carregando..." style="display:block">';
    showMsg();
}


function msg(text) {
    var msg = getEl('msg');
    msg.innerHTML = text;
    msg.className = 'msg msg-ok';
    showMsg();
}

function error(text) {
    var msg = getEl('msg');
    msg.innerHTML = 'ERRO:' + text;
    msg.className = 'msg msg-error';
    showMsg();
}

function exists(id) {
    var result = false;
    var callbackDone = function (data) {
        result = data.status == 'OK' && data.id == id;
    };

    ajaxGet(vUrl, 'id=' + id, callbackDone, false);
    return result;
}

function btnSelectClick() {
    var id = getVal('txtId');
    var data = 'id=' + id;

    ajaxGet(
            vUrl,
            data,
            function (d) {
                if (d.status == 'OK') {
                    setVal('txtId', d.id);
                    setVal('txtTitle', d.title);
                    setVal('txtAuthor', d.author);
                    setVal('txtPrice', d.price);
                    setVal('txtSite', d.site);
                    getEl('txtId').disable = true;
                    hideMsg();
                } else {
                    error('id: ' + id + 'não encontrado');
                }
            },
            true
            );
}

function btnNewClick() {
    hideMsg();
    setVal('txtId', '');
    setVal('txtTitle', '');
    setVal('txtAuthor', '');
    setVal('txtPrice', '');
    setVal('txtSite', '');
    getEl('txtId').disable = false;
    getEl('txtId').focus();
}

function btnSaveClick() {
    var func;
    var id = getVal('txtId');
    var data = new FormData();
    data.append('id', id);
    data.append('title', getVal('txtTitle'));
    data.append('author', getVal('txtAuthor'));
    data.append('price', getVal('txtPrice'));
    data.append('site', getVal('txtSite'));

    if (exists(id)) {
        func = ajaxPut;
    } else {
        func = ajaxPost;
    }

    var callbackDone = function (data) {
        if (data.status == 'OK') {
            msg('Operação efetuada com sucesso.');
            setVal('txtId', data.id);
        } else {
            error('Ocorreu um erro ao salvar');
        }
    };

    func(vUrl, data, callbackDone);
}

function btnDeleteClick() {
    var r = confirm('Confirma a exclusão do livro "' + getVal('txtTitle') + '"?');
    if (!r) {
        return;
    }

    var id = getVal('txtId');
    var data = new FormData();
    data.append('id', id);
    ajaxDelete(
            vUrl,
            data,
            function (ajax) {
                if (ajax.status == 'OK') {
                    msg('O registro foi excluído!');
                } else {
                    error('Não foi possível excluir: ' + ajax.message);
                }
            }
    );
}

function ajax(type, url, data, callbackDone, mimiType, async) {
    var objAjax = getAjax();
    if (!objAjax) {
        throw new Exception('Erro na obtenção do objeto Ajax');
    }

    showLoading();

    objAjax.onreadystatechange = function () {
        if (objAjax.readyState == 4) {
            if (objAjax.status == 200 || objAjax.status == 304) {
                var objJSON = null;
                try {
                    hideMsg();
                    objJSON = JSON.parse(objAjax.responseText);
                } catch (e) {
                    error(e.message);
                }
                callbackDone(objJSON);
            } else {
                error(objAjax.responseText);
            }
        }
    };

    if (mimiType != '') {
        objAjax.overrideMimeType(mimiType);
    }

    if (type == 'GET') {
        var requestMethod = 'kind=' + type;
        if (data != null
                && data != '') {
            data += '&' + requestMethod;
        } else {
            data = requestMethod;
        }
    } else {
        data.append('kind', type);
        type = 'POST';
    }

    if (type == 'GET'
            && data != null
            && data != '') {
        url += '?' + data;
        data = null;
    }

    objAjax.open(type, url, async);
    objAjax.send(data);
}

function ajaxGet(url, data, callbackDone, async) {
    ajax('GET', url, data, callbackDone, 'application/json; charset:iso-8859-1', async);
}

function ajaxPost(url, data, callbackDone) {
    ajax('POST', url, data, callbackDone, 'application/json; charset:iso-8859-1', true);
}

function ajaxPut(url, data, callbackDone) {
    ajax('PUT', url, data, callbackDone, 'application/json; charset:iso-8859-1', true);
}

function ajaxDelete(url, data, callbackDone) {
    ajax('DELETE', url, data, callbackDone, 'application/json; charset:iso-8859-1', true);
}
