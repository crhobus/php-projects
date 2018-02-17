<?php
include "../include/global.php";

$LojaSession = new LojaSession();
$id = $LojaSession->obterAdministradorSession();

if ($id) {
    $ProdutoDAO = new ProdutoDAO;
    $acao = '';
    $idCategoria = '';
    if (isset($_GET['acao'])) {
        $acao = $_GET['acao'];
        if ($acao == 'listar') {
            $idCategoria = $_GET['categoria'];
        }
    }
    $lista = $ProdutoDAO->listar($idCategoria);
    $CategoriaDAO = new CategoriaDAO();
    $listaCategoria = $CategoriaDAO->listar();
} else {
    header("Location: index.php");
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
    <body>

        <?php $titulo = 'Cadastro de Produtos'; ?>
        <?php include "../cabecalho.php"; ?>

        <br/>

        <input type="hidden" id="idCategoria" name="idCategoria" value="<?php echo $idCategoria ?>" >

        <div style="width: 420px; margin-right:auto; margin-left:auto;">
            <label class="lb_dir" style="float: none; color: #464545; font-weight:bold; font-size: 18px;">Filtrar Categoria:</label>
            <select name="categoria" id="categoria" onchange="onChangeCategoria()" style="border: 1px solid #c7c7c7; width: 211px; padding: 3px 2px; resize: none">
                <option value="">Escolha a Categoria</option>
                <?php foreach ($listaCategoria as $Categoria) { ?>
                    <option value="<?php echo $Categoria->getId(); ?>"><?php echo $Categoria->getNome(); ?></option> 
                <?php } ?>
            </select>
        </div>

        <br/>

        <div style="text-align: center">
            <table style="width: 800px; margin-right:auto; margin-left:auto;">
                <tr>
                    <th>ID</th>
                    <th>Categoria</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php
                if ($lista) {
                    foreach ($lista as $Produto) {
                        $Categoria = $CategoriaDAO->consultar($Produto->getIdCategoria());
                        ?>
                        <tr>
                            <td><?php echo $Produto->getId(); ?></td>
                            <td style="width: 200px"><?php echo $Categoria->getNome(); ?></td>
                            <td style="width: 200px"><?php echo $Produto->getNome(); ?></td>
                            <td style="width: 200px"><?php echo $Produto->getPreco(); ?></td>
                            <td style="width: 150px"><?php echo $Produto->getQtEstoque(); ?></td>
                            <td style="width: 40px"><a href="produto.php?id=<?php echo $Produto->getId(); ?>&acao=update">
                                    <img border="0" alt="editar" src="../img/edit.png" width="20" height="20"></a></td>
                            <td style="width: 40px"><a href="#" onclick="excluirProduto(<?php echo $Produto->getId(); ?>)">
                                    <img border="0" src="../img/delete.png" width="20" height="20"></a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>

        <br/>
        <br/>

        <button type="button" onclick="location.href = 'index.php'" style="width: 170px">Voltar</button>
        <button type="button" onclick=" window.open('produtosXML.php')" style="width: 170px" value="blank">XML Produtos</button>
        <button type="button" onclick="location.href = 'produto.php?acao=insert'" style="width: 170px">Novo Produto</button>

    </body>
</html>
<?php if ($acao == 'listar') { ?>
    <script>
        $("#categoria").val($("#idCategoria").val());
    </script>
    <?php
}
