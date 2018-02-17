<?php
include "../include/global.php";

$VirtualSession = new VirtualSession();

if ($VirtualSession->obterClienteSession()) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../css/virtual.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="../js/controlaOperacao.js" type="text/javascript"></script>
        <title>Jóis D'Vince</title>
    </head>
    <body>

        <?php include 'header.php'; ?>

        <?php $titulo = "Jóias D'Vite"; ?>
        <?php include "../cabecalho.php"; ?>

        <form id="frmCliente" name="frmCliente">

            <input type="hidden" id="id" name="id">

            <label class="lb_dir">Nome</label>   
            <input type="text" name="nome" id="nome" maxlength="50">
            <span id="nomeObrig" class="obrigatorio"></span>

            <br/>

            <label class="lb_dir">Sobrenome</label>
            <input type="text" name="sobrenome" id="sobrenome" maxlength="50">
            <span id="sobrenomeObrig" class="obrigatorio"></span>

            <br/>

            <label class="lb_dir">Senha</label>
            <input type="password" name="senha" id="senha" maxlength="32">
            <span id="senhaObrig" class="obrigatorio"></span>

            <br/>

            <label class="lb_dir">Email</label>
            <input type="text" name="email" id="email"  maxlength="50">
            <span id="emailObrig" class="obrigatorio"></span>

            <br/>

            <label class="lb_dir">Endereço</label>
            <input type="text" name="endereco" id="endereco"  maxlength="50">
            <span id="enderecoObrig" class="obrigatorio"></span>

            <br/>

            <label class="lb_dir">Cep</label>
            <input type="text" name="cep" id="cep" maxlength="9">
            <span id="cepObrig" class="obrigatorio"></span>

            <br/>

            <label class="lb_dir">Cidade</label>
            <input type="text" name="cidade" id="cidade"  maxlength="50">
            <span id="cidadeObrig" class="obrigatorio"></span>

            <br/>

            <label class="lb_dir">Estado</label>
            <select name="estado" id="estado" style="border: 1px solid #c7c7c7; width: 211px; padding: 3px 2px; resize: none">
                <option value="">Escolha o Estado</option>
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espirito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraiba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
            </select>
            <span id="estadoObrig" class="obrigatorio"></span>

            <br/>

            <div id="divBotoes" style="text-align: center">
                <button type="button" onclick="location.href = 'index.php'" style="width: 100px">Voltar</button>
                <button type="button" onclick="cadastrarCliente('loja')" style="width: 100px">Salvar</button>
            </div>

        </form>

        <?php include 'rodape.php'; ?>

    </body>
</html>
