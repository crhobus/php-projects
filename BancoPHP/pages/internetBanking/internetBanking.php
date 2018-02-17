<?php
include '../../include/dao/Factory.php';
include '../../include/model/Cliente.php';
include '../../include/dao/ClienteDAO.php';
include '../../include/control/BancoSession.php';

$BancoSession = new BancoSession();
$Cliente = $BancoSession->obterClienteSession();
$nome = '';
if ($Cliente) {
    $nome = $Cliente->getNome();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Banco online::Internet Banking</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">

            <span id="ola">Olá <?php echo $nome; ?></span>
            <a href="login.php">Sair</a>

            <h2>Internet Banking</h2>

            <nav>
                <ul>
                    <li><a href='saldoBancario.php'>Saldo</a></li>
                    <li><a href='extratoBancario.php'>Extrato</a></li>
                    <li><a href='transferencia.php'>Transferências</a></li>
                    <li><a href='pagamentoRecargaCelular.php'>Pagamentos - Recarga Celular Pré Pago</a></li>
                    <li><a href='pagamentoBoletoBancario.php'>Pagamentos - Boleto Bancário</a></li>
                </ul>
            </nav>

        </div>
    </body>
</html>
