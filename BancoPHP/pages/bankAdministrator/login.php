<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Banco online::Bank Administrator</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../css/style.css" rel="stylesheet" type="text/css"/>
        <script src="../../js/jquery/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="../../js/loginFuncionario.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">

            <a href="../index.php">Home</a>

            <h2>Login - Bank Administrator</h2>

            <form id="formLoginFuncionario">

                <input type="text" id="usuario" name="usuario" placeholder="usuário" class="field">

                <br/>
                <br/>

                <input type="password" id="senha" name="senha" placeholder="senha" class="field">

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
