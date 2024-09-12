
<?php
    include('../templates/conection_check.php');
    include('../templates/header.php');
?>

<div class="container">
    <h2>Registrar Venda</h2>
    <form id="add-to-cart-form">
        Produto:
        <select id="cod_produto" name="cod_produto">
            <?php
            include('includes/conexao.php');
            $sql = "SELECT cod_produto, produto, preco FROM estoque";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['cod_produto']}' data-produto='{$row['produto']}' data-preco='{$row['preco']}'>{$row['produto']} ({$row['cod_produto']})</option>";
            }
            ?>
        </select><br>
        Quantidade: <input type="number" id="quantidade" name="quantidade" min="1" required><br>
        <button type="button" onclick="addToCart()">Adicionar ao Carrinho</button>
    </form>

    <h2>Carrinho de Compras</h2>
    <div id="cart"></div>
    <button type="button" onclick="finalizeSale()">Finalizar Venda</button>
</div>
<script src="../js/cart.js"></script>
<?php include('../templates/footer.php'); ?>
