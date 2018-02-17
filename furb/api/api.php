<?php

include 'books.php';

define('API_URI', 'http://localhost/furb/api/api.php');

//Objetos
        const cObject = 'object';
        const cAutor = 'Autor';
        const cEditora = 'Editora';
        const cLivro = 'Livro';
//Métodos
        const cURI = 'uri';
        const cMethod = 'method';
        const cGET = 'GET';
        const cPOST = 'POST';
//Operações
        const cOperations = 'operations';
        const cOperation = 'operation';
        const cNew = 'new';
        const cUpdate = 'update';
        const cDelete = 'delete';
        const cSelect = 'select';
        const cSelectAll = 'selectAll';
//Template
        const cType = 'type';
        const cTemplate = 'template';
        const cFields = 'fields';
        const cRecords = 'records';
        const cRecord = 'record';
        const cParameter = 'parameter';
        const cField_Name = 'name';
        const cField_Kind = 'kind';
        const cField_Description = 'description';
        const cField_Descriptions = 'descriptions';
        const cField_Required = 'required';
        const cField_Value = 'value';
        const cTrue = true;
        const cFalse = false;
//Tipos de campos
        const cString = 'string';
        const cInteger = 'integer';
        const cDouble = 'double';
//Result
        const cResult = 'result';
        const cResult_OK = 'OK';
        const cResult_Error = 'ERROR';
        const cResult_Message = 'message';

// ************** Funções genéricas ******************
function sendJson($json) {
    header('Content-type: application/json; charset=UTF-8');
    echo $json;
}

function getVal($key) {
    if (isset($_GET[$key])) {
        return trim(strip_tags($_GET[$key]));
    } else {
        if (isset($_POST[$key])) {
            return trim(strip_tags($_POST[$key]));
        } else
            return null;
    }
}

//**************************************************

abstract class ApiObject {

    abstract public function run();

    abstract public function getEntryPoints();
}

class Livro extends ApiObject {

    public function getEntryPoints() {
        //"uri": "http://localhost/furb/api/api.php?object=Livro",
        //"uri": "http://localhost/furb/api/api.php?object=Autor&operation=new&type=template",
        //"uri": "http://localhost/furb/api/api.php?object=Autor&operation=edit"
        //"uri": "http://localhost/furb/api/api.php?object=Autor&operation=select"
        //"uri": "http://localhost/furb/api/api.php?object=Autor&operation=selectAll"
        //"uri": "http://localhost/furb/api/api.php?object=Autor&operation=delete"
        //"uri": "http://localhost/furb/api/api.php?object=Autor&operation=new",
        $operations = Array(cNew, cUpdate, cDelete, cSelect, cSelectAll);
        $data = Array(cObject => cLivro);

        $itens = Array();
        foreach ($operations as $op) {
            $item = Array(cURI => API_URI . '?' . cObject . '=' . cLivro . '&' . cOperation . '=' . $op . '&' . cType . '=' . cTemplate,
                cOperation => $op, cType => cTemplate, cMethod => cGET);
            $itens[] = $item; //Adiciona
        }
        $data[cOperations] = $itens;

        sendJson(stripslashes(json_encode($data, JSON_PRETTY_PRINT)));
    }

    private function doNewTemplate() {
        //"uri": "http://localhost/furb/api/api.php?object=Livro&operation=new_template"
        $data = Array(cObject => cLivro,
            cFields => Array(
                Array(cField_Name => 'id', cField_Description => 'Identificador', cField_Kind => cInteger, cField_Required => cTrue, cField_Value => ''),
                Array(cField_Name => 'title', cField_Description => 'Titulo', cField_Kind => cString, cField_Required => cTrue, cField_Value => ''),
                Array(cField_Name => 'author', cField_Description => 'Autor', cField_Kind => cString, cField_Required => cTrue, cField_Value => ''),
                Array(cField_Name => 'price', cField_Description => 'Preco', cField_Kind => cDouble, cField_Required => cTrue, cField_Value => ''),
                Array(cField_Name => 'site', cField_Description => 'Site', cField_Kind => cString, cField_Required => cFalse, cField_Value => '')
            ),
            cURI => API_URI . '?' . cObject . '=' . cLivro . '&' . cOperation . '=' . cNew,
            cMethod => cPOST
        );
        sendJson(stripslashes(json_encode($data, JSON_PRETTY_PRINT)));
    }

    public function doNew() {
        //"uri": "http://localhost/furb/api/api.php?object=Livro&operation=new"
        $id = getVal('id');
        $title = getVal('title');
        $author = getVal('author');
        $price = getVal('price');
        $site = getVal('site');

        $errors = Array();

        if ($id == '')
            $errors[] = 'Id deve ser informado.';

        if ($title == '')
            $errors[] = 'Titulo deve ser informado.';

        if ($author == '')
            $errors[] = 'Autor deve ser informado.';

        if ($price == '')
            $errors[] = 'Preco deve ser informado.';

        if (count($errors) == 0) {
            $boookRest = new BookRest();
            if ($boookRest->restPost()) {
                $data = Array(cResult => cResult_OK, cResult_Message => 'Livro ' . $title . ' cadastrado com sucesso!');
            } else {
                $data = Array(cResult => cResult_Error, cResult_Message => 'Ocorreu um erro ao cadastrar o livro.');
            }
        } else {
            $data = Array(cResult => cResult_Error, cResult_Message => $errors);
        }

        sendJson(stripslashes(json_encode($data, JSON_PRETTY_PRINT)));
    }

    private function doSelectTemplate() {
        //"uri": http://localhost/furb/api/api.php?object=Livro&operation=select&type=template
        $data = Array(cObject => cLivro,
            cParameter => Array(cField_Name => 'id', cField_Description => 'Identificador', cField_Kind => cInteger, cField_Required => cTrue, cField_Value => ''),
            cURI => API_URI . '?' . cObject . '=' . cLivro . '&' . cOperation . '=' . cSelect,
            cMethod => cGET
        );
        sendJson(stripslashes(json_encode($data, JSON_PRETTY_PRINT)));
    }

    public function doSelect() {
        //"uri": "http://localhost/furb/api/api.php?object=Livro&operation=select"
        $id = getVal('id');

        $errors = Array();

        if ($id == '') {
            $errors[] = 'Id deve ser informado.';
        }

        if (count($errors) == 0) {
            $boookRest = new BookRest();
            $data[cResult] = 'OK';
            $data[cRecord] = $boookRest->restGet();
            if ($data[cRecord] == null) {
                $data = Array(cResult => cResult_Error, cResult_Message => 'Livro nao encontrado!');
            }
        } else {
            $data = Array(cResult => cResult_Error, cResult_Message => $errors);
        }

        sendJson(stripslashes(json_encode($data, JSON_PRETTY_PRINT)));
    }

    private function doDeleteTemplate() {
        //"uri": http://localhost/furb/api/api.php?object=Livro&operation=delete&type=template
        $data = Array(cObject => cLivro,
            cParameter => Array(cField_Name => 'id', cField_Description => 'Identificador', cField_Kind => cInteger, cField_Required => cTrue, cField_Value => ''),
            cURI => API_URI . '?' . cObject . '=' . cLivro . '&' . cOperation . '=' . cDelete,
            cMethod => cGET
        );
        sendJson(stripslashes(json_encode($data, JSON_PRETTY_PRINT)));
    }

    public function doDelete() {
        //"uri": "http://localhost/furb/api/api.php?object=Livro&operation=delete"
        $id = getVal('id');

        $errors = Array();

        if ($id == '') {
            $errors[] = 'Id deve ser informado.';
        }

        if (count($errors) == 0) {
            $boookRest = new BookRest();
            if ($boookRest->restDelete()) {
                $data = Array(cResult => cResult_OK, cResult_Message => 'Livro excluido com sucesso!');
            } else {
                $data = Array(cResult => cResult_Error, cResult_Message => 'Livro nao encontrado!');
            }
        } else {
            $data = Array(cResult => cResult_Error, cResult_Message => $errors);
        }

        sendJson(stripslashes(json_encode($data, JSON_PRETTY_PRINT)));
    }

    private function doUpdateTemplate() {
        //"uri": "http://localhost/furb/api/api.php?object=Livro&operation=update&type=template"
        $data = Array(cObject => cLivro,
            cFields => Array(
                Array(cField_Name => 'id', cField_Description => 'Identificador', cField_Kind => cInteger, cField_Required => cTrue, cField_Value => ''),
                Array(cField_Name => 'title', cField_Description => 'Titulo', cField_Kind => cString, cField_Required => cTrue, cField_Value => ''),
                Array(cField_Name => 'author', cField_Description => 'Autor', cField_Kind => cString, cField_Required => cTrue, cField_Value => ''),
                Array(cField_Name => 'price', cField_Description => 'Preco', cField_Kind => cDouble, cField_Required => cTrue, cField_Value => ''),
                Array(cField_Name => 'site', cField_Description => 'Site', cField_Kind => cString, cField_Required => cFalse, cField_Value => '')
            ),
            cURI => API_URI . '?' . cObject . '=' . cLivro . '&' . cOperation . '=' . cUpdate,
            cMethod => cPOST
        );
        sendJson(stripslashes(json_encode($data, JSON_PRETTY_PRINT)));
    }

    public function doUpdate() {
        //"uri": "http://localhost/furb/api/api.php?object=Livro&operation=update"
        $id = getVal('id');
        $title = getVal('title');
        $author = getVal('author');
        $price = getVal('price');
        $site = getVal('site');

        $errors = Array();

        if ($id == '')
            $errors[] = 'Id deve ser informado.';

        if ($title == '')
            $errors[] = 'Titulo deve ser informado.';

        if ($author == '')
            $errors[] = 'Autor deve ser informado.';

        if ($price == '')
            $errors[] = 'Preco deve ser informado.';

        if (count($errors) == 0) {
            $boookRest = new BookRest();
            if ($boookRest->restPut()) {
                $data = Array(cResult => cResult_OK, cResult_Message => 'Livro ' . $id . ' - ' . $title . ' atualizado com sucesso!');
            } else {
                $data = Array(cResult => cResult_Error, cResult_Message => 'Ocorreu um erro ao atualizar o livro.');
            }
        } else {
            $data = Array(cResult => cResult_Error, cResult_Message => $errors);
        }

        sendJson(stripslashes(json_encode($data, JSON_PRETTY_PRINT)));
    }

    private function doSelectAllTemplate() {
        //"uri": http://localhost/furb/api/api.php?object=Livro&operation=selectAll&type=template
        $data = Array(cObject => cLivro,
            cURI => API_URI . '?' . cObject . '=' . cLivro . '&' . cOperation . '=' . cSelectAll,
            cMethod => cGET
        );
        sendJson(stripslashes(json_encode($data, JSON_PRETTY_PRINT)));
    }

    public function doSelectAll() {
        //"uri": "http://localhost/furb/api/api.php?object=Livro&operation=selectAll"

        $boookRest = new BookRest();
        $data[cField_Descriptions] = Array(
            Array(cField_Description => 'Identificador'),
            Array(cField_Description => 'Titulo'),
            Array(cField_Description => 'Autor'),
            Array(cField_Description => 'Preco'),
            Array(cField_Description => 'Site')
        );
        $data[cResult] = 'OK';
        $data[cRecords] = $boookRest->restGetAll();
        if ($data[cRecords] == null) {
            $data = Array(cResult => cResult_Error, cResult_Message => 'Nao ha livros cadastrados!');
        }

        sendJson(stripslashes(json_encode($data, JSON_PRETTY_PRINT)));
    }

    public function run() {
        $operation = getVal(cOperation);
        $type = getVal(cType);
        switch ($operation) {
            case cNew:
                if ($type == cTemplate) {
                    $this->doNewTemplate();
                } else {
                    $this->doNew();
                }
                break;
            case cSelect:
                if ($type == cTemplate) {
                    $this->doSelectTemplate();
                } else {
                    $this->doSelect();
                }
                break;
            case cDelete:
                if ($type == cTemplate) {
                    $this->doDeleteTemplate();
                } else {
                    $this->doDelete();
                }
                break;
            case cUpdate:
                if ($type == cTemplate) {
                    $this->doUpdateTemplate();
                } else {
                    $this->doUpdate();
                }
                break;
            case cSelectAll:
                if ($type == cTemplate) {
                    $this->doSelectAllTemplate();
                } else {
                    $this->doSelectAll();
                }
                break;
            default:
                $this->getEntryPoints();
                break;
        }
    }

}

class Api extends ApiObject {

    public function getEntryPoints() {
        $data = Array(
            Array(cObject => cAutor, cURI => API_URI . '?' . cObject . '=' . cAutor, cMethod => cGET),
            Array(cObject => cEditora, cURI => API_URI . '?' . cObject . '=' . cEditora, cMethod => cGET),
            Array(cObject => cLivro, cURI => API_URI . '?' . cObject . '=' . cLivro, cMethod => cGET),
        );

        sendJson(stripslashes(json_encode($data, JSON_PRETTY_PRINT)));
    }

    public function run() {
        $object = getVal(cObject);
        if ($object != '') {
            (new $object)->run();
        } else {
            $this->getEntryPoints();
        }
    }

}

$api = new Api();
$api->run();
