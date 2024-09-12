<?php 
    include('../includes/conexao.php');
    include('../templates/conection_check.php');
    include('../templates/header.php'); 
    ?>

<div class="container">
<h2 class="container title">Lista de Produtos</h2>
<form action="buscar.php" method="get" class="container">
    <input class="search" type="text" name="query" placeholder="Buscar produtos...">
    <input class="btn" type="submit" value="Buscar">
</form>
<section class='container card_section'>
<?php

$sql = "SELECT * FROM estoque ORDER BY produto ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "
            
                <div class='product_card'>
                    <label for='id'>ID:</label>
                    <input type='text' id='id' value='" . $row["id"] . "' disabled><br>
                    
                    <label for='cod_produto'>Código do Produto:</label>
                    <input type='text' id='cod_produto' value='" . $row["cod_produto"] . "' disabled><br>
                    
                    <label for='produto'>Nome:</label>
                    <input type='text' id='produto' value='" . $row["produto"] . "' disabled><br>
                    
                    <label for='categoria'>Categoria:</label>
                    <input type='text' id='categoria' value='" . $row["categoria"] . "' disabled><br>
                    
                    <label for='preco_fab'>Preço de Fabrica:</label>
                    <input type='text' id='preco_fab' value='" . $row["preco_fab"] . "' disabled><br>
                    
                    <label for='preco'>Preço de Venda:</label>
                    <input type='text' id='preco' value='" . $row["preco"] . "' disabled><br>
                    
                    <label for='tamanho'>Tamanho:</label>
                    <input type='text' id='tamanho' value='" . $row["tamanho"] . "' disabled><br>
                    
                    <label for='sabor'>Sabor:</label>
                    <input type='text' id='sabor' value='" . $row["sabor"] . "' disabled><br>
                    
                    <label for='cor'>Cor:</label>
                    <input type='text' id='cor' value='" . $row["cor"] . "' disabled><br>
                    
                    <label for='quantidade'>Quantidade:</label>
                    <input type='text' id='quantidade' value='" . $row["quantidade"] . "' disabled><br>
                    
                    <label for='validade'>Validade:</label>
                    <input type='date' id='validade' value='" . $row["validade"] . "' disabled><br>
                    
                    <a class='btn' href='editar.php?id=" . $row["id"] . "'>Editar</a>
                </div>
            
        ";
    }
} else {
    echo "0 resultados";
}
$conn->close();
?>
</section>
</div>
<?php include('../templates/footer.php'); ?>
