<?php
if (isset($_POST['usuario']) && isset($_POST['senha'])) {
    if ($_POST['usuario'] == "posweb" && $_POST['senha'] == "furb") {
        session_start();
        $_SESSION['usuario'] = "furb";
        header("Location: index.php");
    } else {
        $msg = "Usuário e/ou senha incorretos";
    }
} else {
    $msg = null;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>

            <?php echo $msg; ?>
            <form action="login.php" method="POST">

                <h2>Login</h2>

                <input type="text" id="usuario" name="usuario" required placeholder="usuário"/>

                <br/>
                <br/>

                <input type="password" id="senha" name="senha" required placeholder="senha"/>

                <br/>
                <br/>

                <input type="submit" id="entrar" value="Entrar" />

            </form>
        </div>
    </body>
</html>
