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
    </head>
    <body>
        <div class="container">

            <span id="ola">Olá <?php echo $nome; ?></span>
            <a href="login.php">Sair</a>

            <h2>Bank Administrator</h2>

            <nav>
                <ul>
                    <li><a href='cadasCliente.php'>Cadastro de Clientes</a></li>
                    <li><a href='logAcesso.php'>Logs de Acesso Cientes</a></li>
                    <li><a href='cadasFuncionario.php'>Cadastro de Funcionários</a></li>
                </ul>
            </nav>

        </div>
    </body>
</html>
