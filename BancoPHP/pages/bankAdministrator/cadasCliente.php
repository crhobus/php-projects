<?php
include '../../include/dao/Factory.php';
include '../../include/model/Funcionario.php';
include '../../include/dao/FuncionarioDAO.php';
include '../../include/control/BancoSession.php';

$BancoSession = new BancoSession();
$Funcionario = $BancoSession->obterFuncionarioSession();
$nome = '';
if ($Funcionario) {
    $nome = $Funcionario->getNome();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Banco online::Bank Administrator</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../css/style.css" rel="stylesheet" type="text/css"/>
        <script src="../../js/jquery/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="../../js/utils.js" type="text/javascript"></script>
        <script src="../../js/cadasCliente.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">

            <span id="ola">Olá <?php echo $nome; ?></span>
            <a href="login.php">Sair</a>

            <h2>Bank Administrator - Cadastro de Clientes</h2>

            <form id="formCadasCliente">

                <input type="hidden" id="id" value="0">

                <label for="nome">Nome:</label><br/>
                <input type="text" id="nome" name="nome" class="field">
                <span id="nomeObrig" class="obrigatorio"></span>

                <br/>

                <label for="agencia">Agência:</label><br/>
                <input type="text" id="agencia" name="agencia" class="field">
                <span id="agenciaObrig" class="obrigatorio"></span>

                <br/>

                <label for="nrConta">Conta:</label><br/>
                <input type="text" id="nrConta" name="nrConta" class="field">
                <span id="nrContaObrig" class="obrigatorio"></span>

                <br/>

                <label for="senha">Senha:</label><br/>
                <input type="password" id="senha" name="senha" maxlength="6" class="field">
                <span id="senhaObrig" class="obrigatorio"></span>

                <br/>

                <label for="confirmaSenha">Confirma senha:</label><br/>
                <input type="password" id="confirmaSenha" name="confirmaSenha" maxlength="6" class="field">
                <span id="confirmaSenhaObrig" class="obrigatorio"></span>

                <br/>

                <label for="letrasSeguranca">Letras seguranca:</label><br/>
                <input type="text" id="letrasSeguranca" name="letrasSeguranca" maxlength="3" class="field">
                <span id="letrasSegurancaObrig" class="obrigatorio"></span>

                <br/>

                <label for="saldoEspecial">Cheque especial:</label><br/>
                <input type="text" id="saldoEspecial" name="saldoEspecial" value="0" class="field">
                <span id="saldoEspecialObrig" class="obrigatorio"></span>

                <br/>

                <label for="nrTentativas">Nr Tentativas:</label><br/>
                <input type="text" id="nrTentativas" name="nrTentativas" value="0" readonly="true" class="field">

                <br/>

                <label for="foto">Foto:</label><br/>
                <input type="file" id="foto" name="foto" class="select_image">

                <div id="imagem"></div>

                <br/>
                <br/>

                <input type="button" id="novo" value="Novo" class="button">
                <input type="button" id="salvar" value="Salvar" class="button">
                <input type="button" id="limpar" value="Limpar" class="button">
                <input type="button" id="listar" value="Listar" class="button">

                <br/>
                <br/>


            </form>

            <span id="msg" class="msg"></span>

            <div id="clientes"></div>

            <br/>

            <a href="bankAdministrator.php">Voltar</a>

        </div>
    </body>
</html>
