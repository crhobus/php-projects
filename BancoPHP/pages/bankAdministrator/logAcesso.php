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
        <script src="../../js/logAcesso.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">

            <span id="ola">Olá <?php echo $nome; ?></span>
            <a href="login.php">Sair</a>

            <h2>Bank Administrator - Logs de Acesso Cientes</h2>

            <label for="nome">Nome:</label><br/>
            <input type="text" id="nome" name="nome" class="field">

            <br/>

            <label for="agencia">Agência:</label><br/>
            <input type="text" id="agencia" name="agencia" class="field">

            <br/>

            <label for="nrConta">Conta:</label><br/>
            <input type="text" id="nrConta" name="nrConta" class="field">

            <br/>
            <br/>

            <input type="button" id="listar" value="Listar" class="button">
            <input type="button" id="gerarPDF" value="Gerar PDF" class="button">

            <br/>
            <br/>

            <span id="msg" class="msg"></span>

            <div id="logs"></div>

            <br/>

            <a href="bankAdministrator.php">Voltar</a>

        </div>
    </body>
</html>
