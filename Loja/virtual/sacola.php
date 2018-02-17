<?php
include "../include/global.php";

$VirtualSession = new VirtualSession();

if ($VirtualSession->obterClienteSession()) {

    $ClienteDAO = new ClienteDAO();
    $Cliente = $ClienteDAO->consultar($VirtualSession->obterClienteSession());
    $nome = $Cliente->getNome();
    $logado = 1;
} else {
    $nome = 'Visitante';
    $logado = 0;
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

        <?php
        if (isset($_COOKIE['carrinho'])) {

            $ProdutoDAO = new ProdutoDAO;
            ?>
            <table border="1" style="width: 600px; text-align: center; margin-left: auto; margin-right: auto;">
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th>Quantidade</th>
                    <th>Excluir</th>
                </tr>

                <?php
                foreach ($_COOKIE['carrinho'] as $cookie_name => $cookie_value) {
                    $Produto = $ProdutoDAO->consultar($cookie_name);
                    ?>
                    <tr>
                        <td><a class="item_sacola" href="#"><?php echo $Produto->getId(); ?> </a></td>
                        <td><a class="item_sacola" href="#"><?php echo $Produto->getNome(); ?> </a></td>
                        <td><a class="item_sacola" href="#"><?php echo $Produto->getPreco(); ?> </a></td>
                        <td><input id="<?php echo $cookie_name; ?>" name="<?php echo $cookie_name; ?>" 
                                   value="<?php echo $cookie_value; ?> " style="width: 50px;text-align: center" onchange="alteraQuantidade(this.id, this.value)">
                        </td>
                        <td><a class="item_sacola" href="carrinho.php?action=delete&id=<?php echo $cookie_name; ?> ">
                                <img src="../img/remove.png" width="25px" height="25px" style="margin-top: 5px;">
                            </a>
                        </td>

                    </tr>
                    <?php
                }
            } else {
                ?>

                <div>
                    <h2>Sacola Vazia</h2>
                </div>

            <?php }
            ?>

        </table>

        <br/>
        <br/>

        <?php
        if (isset($_COOKIE['carrinho'])) {
            ?>
            <div id="calcularCep" style="width: 600px; text-align: center; margin-left: auto; margin-right: auto;">
                <label for="cep" style="width: 200px; float: none">Consulte frete para seu CEP</label>
                <input id="cep" name="cep" value="" maxlength="8" style="width: 100px">
                <button style="width: 100px" onclick="calcularFrete()">OK</button>
                <br/>
                <br/>
                <label for="frete" style="width: 200px; float: none">Valor Frete</label>
                <input id="frete" name="frete" value="" style="width: 100px" readonly="true">

            </div>

            <br/>

            <div id="finalizar">
                <?php if ($logado == 1) { ?>
                    <button style="margin-left: 106px" onclick="finalizaCompra()">Finalizar Compra</button>
                <?php } else { ?>
                    <button style="margin-left: 106px" onclick="location.href = 'login.php'">Finalizar Compra</button>
                <?php } ?>
            </div>

        <?php } else { ?>
            <button onclick="location.href = 'index.php'">Voltar</button>
        <?php } ?>

        <?php include 'rodape.php'; ?>

    </body>
</html>
