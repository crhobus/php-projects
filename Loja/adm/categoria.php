<?php
include "../include/global.php";

$LojaSession = new LojaSession();

if (!$LojaSession->obterAdministradorSession()) {
    header("Location: index.php");
}

$acao = $_GET['acao'];
$id = '';
$nome = '';

if ($acao == 'update') {
    $id = $_GET['id'];
    $CategoriaDAO = new CategoriaDAO();
    $Categoria = $CategoriaDAO->consultar($id);

    $nome = $Categoria->getNome();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="../js/controlaOperacao.js" type="text/javascript"></script>
        <title>Jóis D'Vince</title>
    </head>
    <body class="central">

        <?php $titulo = 'Cadastro de Categorias'; ?>
        <?php include "../cabecalho.php"; ?>

        <form id="frmCategoria" name="frmCategoria">

            <input type="hidden" id="id" name="id" value="<?php echo $id ?>">

            <label class="lb_dir">Nome</label>   
            <input type="text" name="nome" id="nome" maxlength="50" value="<?php echo $nome ?>">
            <span id="nomeObrig" class="obrigatorio"></span>

            <br/>

            <div id="divBotoes" style="text-align: center">
                <button type="button" onclick="location.href = 'listaCategorias.php'" style="width: 100px">Voltar</button>
                <button type="button" onclick="cadastrarCategoria()" style="width: 100px">Salvar</button>
            </div>

        </form>
    </body>
</html>
