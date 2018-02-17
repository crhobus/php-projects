<?php ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Banco online::Cash Register</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../css/style.css" rel="stylesheet" type="text/css"/>
        <script src="../../js/jquery/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="../../js/utils.js" type="text/javascript"></script>
        <script src="../../js/saque.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">

            <h2>Cash Register - Saques</h2>

            <form id="formSaque">

                <input type="hidden" id="id" value="0">

                <label for="agencia">Agência:</label><br/>
                <input type="text" id="agencia" name="agencia" class="field">

                <br/>

                <label for="nrConta">Conta:</label><br/>
                <input type="text" id="nrConta" name="nrConta" class="field">

                <br/>

                <div id="imagem"></div>

                <br/>

                <input type="button" id="ok" value="OK" class="button">
                <input type="button" id="cancelar" value="Cancelar" class="button">

                <br/>
                <br/>

                <label for="valor">Valor:</label><br/>
                <input type="text" id="valor" name="valor" class="field">

                <input type="button" id="sacar" value="Sacar" class="button">

                <br/>
                <br/>

            </form>

            <span id="msg" class="msg"></span>

            <div id="espacamento"></div>

            <br/>

            <a href="cashRegister.php">Voltar</a>

        </div>
    </body>
</html>
