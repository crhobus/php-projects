<?php
if (isset($_POST['usuario']) && isset($_POST['senha'])) {
    if ($_POST['usuario'] == 'furb' && $_POST['senha'] == 'posweb11') {
        $msg = null;
        session_start();
        $_SESSION['usuario'] = $_POST['usuario'];
        header('Location: sessao.php');
    } else {
        $msg = 'Login incorreto';
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

                <input type="submit" id="login" value="Login"/>

            </form>
        </div>
    </body>
</html>
