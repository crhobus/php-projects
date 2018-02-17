<?php ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
        <title>Jóis D'Vince</title>
    </head>
    <body>

        <?php $titulo = 'Selecione o Módulo'; ?>
        <?php include "cabecalho.php"; ?>

        <br/>
        <br/>

        <button onclick="location.href = 'adm/index.php'">Administrator</button>

        <br/>

        <button onclick="location.href = 'virtual/index.php'">Loja Virtual</button>

    </body>
</html>
