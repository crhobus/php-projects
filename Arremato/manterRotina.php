<?php

include "./include/global.php";

$operacao = $_POST['operacao'];

//Cliente

if ($operacao == 'incluirCliente') {

    $tipo_pessoa = $_POST['tipo_pessoa'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $sexo = $_POST['sexo'];
    $estado_civil = $_POST['estado_civil'];
    $data_nascimento = $_POST['data_nascimento'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $oferta_parceiros = $_POST['oferta_parceiros'];

    $ClienteDAO = new ClienteDAO();
    if ($ClienteDAO->verificaEmailCadastrado($email)) {
        echo json_encode(array('status' => 'NOK', 'msg' => 'Já possui um cliente cadastrado no sistema com este email!'));
    } else {
        $ClienteDAO->inserir(new Cliente(NULL, $tipo_pessoa, $login, $senha, $nome, $cpf, $rg, $sexo, $estado_civil, $data_nascimento, $celular, $email, $oferta_parceiros));
        echo json_encode(array('status' => 'OK', 'msg' => 'Cliente cadastrado com sucesso!'));
    }
}
