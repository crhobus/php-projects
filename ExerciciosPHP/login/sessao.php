<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sessão</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>
            Olá <?php echo $_SESSION['usuario']; ?>
            <a href="logout.php">Logout</a>
        </div>
    </body>
</html>
