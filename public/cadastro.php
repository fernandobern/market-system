
<?php
    include('../templates/conection_check.php');
    include('../templates/header.php');
?>

<div class="form_comp container">
    <h2 class="title">Cadastrar Produto</h2>
    <form id="produtoForm" action="cadastrar_produto.php" method="post">
        <label for="cod_produto">Código do Produto:</label><br>
        <input type="text" name="cod_produto" id="cod_produto"><br>
        
        <label for="produto">Nome:</label><br>
        <input type="text" name="produto" id="produto"><br>
        
        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria">
            <option value="">Selecionar</option>
            <option value="Alimento">Alimento</option>
            <option value="Casa">Casa</option>
            <option value="Brinquedos">Brinquedos</option>
            <option value="Pet">Pet</option>
        </select><br>
        
        <label for="preco_fab">Preço de Fabrica:</label><br>
        <input type="text" name="preco_fab" id="preco_fab"><br>
        
        <label for="preco">Preço de Venda:</label><br>
        <input type="text" name="preco" id="preco"><br>
        
        <label for="tamanho">Tamanho:</label><br>
        <input type="text" name="tamanho" id="tamanho"><br>
        
        <label for="sabor">Sabor:</label><br>
        <input type="text" name="sabor" id="sabor"><br>
        
        <label for="cor">Cor:</label><br>
        <input type="text" name="cor" id="cor"><br>
        
        <label for="quantidade">Quantidade:</label><br>
        <input type="text" name="quantidade" id="quantidade"><br>
        
        <label for="validade">Validade:</label><br>
        <input type="date" name="validade" id="validade"><br>
        
        <input class="btn" type="submit" value="Cadastrar">
    </form>
</div>

<!-- Inclua o arquivo JavaScript externo -->
<?php include('../templates/footer.php'); ?>
