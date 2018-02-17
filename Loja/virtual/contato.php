<?php
include "../include/global.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../css/virtual.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
        <title>Jóis D'Vince</title>
    </head>
    <body>

        <?php include 'header.php'; ?>

        <?php $titulo = "Jóias D'Vite"; ?>
        <?php include "../cabecalho.php"; ?>

        <form action="contato.php" method="POST" style="height: 620px">
            <fieldset>

                <legend>Entre em contato</legend>

                <small>*Campos de Preenchimentos Obrigatório</small>

                <br/>

                <?php include("./enviar.php") ?>

                <label for="nome"> * Seu nome:</label>
                <input id="nome" name="nome" size="31" type="text" value="<?php echo $nome; ?>">

                <br/>

                <label for="email">* Seu email:</label>
                <input id="email" name="email" size="31" type="text" value="<?php echo $email; ?>">

                <br/>

                <label for="assunto">* Assunto:</label>
                <input id="assunto" maxlength="50" name="assunto" size="15" type="text" value="<?php echo $assunto_user; ?>">

                <br/>

                <label for="mensagem">* Mensagem:</label>
                <br/>
                <textarea id="mensagem" cols="53" rows="5" name="mensagem"><?php echo $mensagem; ?></textarea>

                <br/>

                <button name="enviar" type="submit" class="botao_100" >Enviar</button>
                <button name="cancelar" type="reset" class="botao_100" >Limpar</button>

            </fieldset>            
        </form>

        <?php include 'rodape.php'; ?>

    </body>
</html>
