<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Banco online::Internet Banking</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../css/style.css" rel="stylesheet" type="text/css"/>
        <script src="../../js/jquery/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="../../js/utils.js" type="text/javascript"></script>
        <script src="../../js/loginCliente.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">

            <a href="../index.php">Home</a>

            <h2>Login - Internet Banking</h2>

            <form id="formLoginCliente">

                <input type="text" id="agencia" name="agencia" placeholder="agência" class="field">

                <br/>
                <br/>

                <input type="text" id="nrConta" name="nrConta" placeholder="conta" class="field">

                <br/>
                <br/>

                <input type="password" id="senha" name="senha" placeholder="senha" maxlength="6" class="field">

                <br/>
                <br/>

                <input type="text" id="letrasSeguranca" name="letrasSeguranca" placeholder="letras segurança" maxlength="3" class="field">

                <br/>
                <br/>

                <input type="button" id="login" value="Login" class="button">

                <br/>
                <br/>

            </form>

            <span id="msg" class="msg"></span>

        </div>
    </body>
</html>
