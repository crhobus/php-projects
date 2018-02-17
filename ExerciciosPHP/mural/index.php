<?php
session_start();

try {
    $Conexao = new PDO("mysql:host=localhost;port=3306;dbname=mural", "root", "key50100");

    if (isset($_REQUEST['acao']) && $_REQUEST['acao'] == "inserir") {
        $Conexao->exec("INSERT INTO mural (nome,email,assunto,mensagem,ip) VALUES ('$_POST[nome]','$_POST[email]','$_POST[assunto]','$_POST[mensagem]','$_SERVER[REMOTE_ADDR]')");
    } else if (isset($_REQUEST['acao']) && $_REQUEST['acao'] == "excluir" && isset($_SESSION['usuario'])) {
        $Conexao->exec("DELETE FROM mural WHERE id='$_REQUEST[id]'");
    }

    $resultado = $Conexao->query("SELECT * FROM mural ORDER BY id DESC")->fetchAll();
} catch (PDOException $ex) {
    print $ex->getMessage();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Index</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>

            <?php if (isset($resultado)) { ?>
                <ul>
                    <?php foreach ($resultado as $res) { ?>
                        <li>
                            <?php echo $res["mensagem"] ?><br />
                            <?php echo $res["assunto"] ?><br />
                            <strong><?php echo $res["nome"] ?> (<?php echo $res["email"] ?>) -<?php echo $res["ip"] ?></strong><br />
                            <?php if (isset($_SESSION['usuario'])) { ?><a href="index.php?id=<?php echo $res["id"] ?>&acao=excluir">Excluir</a><?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>

            <form action="index.php" method="POST">

                <h2>Mural</h2>

                <input type="hidden" name="acao" value="inserir"/>

                <input type="text" id="nome" name="nome" required placeholder="nome"/>

                <br/>
                <br/>

                <input type="email" id="email" name="email" placeholder="email"/>

                <br/>
                <br/>

                <input type="text" id="assunto" name="assunto" placeholder="assunto"/>

                <br/>
                <br/>

                <textarea id="mensagem" name="mensagem" placeholder="mensagem"></textarea>

                <br/>
                <br/>

                <input type="submit" id="Enviar" value="Enviar"/>

            </form>
        </div>
    </body>
</html>
