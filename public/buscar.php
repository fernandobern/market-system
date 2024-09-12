<?php 
    include('../templates/conection_check.php');
    include('../templates/header.php'); 
?>

<h2 class="title container">Resultados da Busca</h2>
<section class='container card_section'>
<?php
if (isset($_GET['query'])) {
    $query = $_GET['query'];

    // Use prepared statements para prevenir SQL injection
    $sql = "SELECT * FROM estoque WHERE produto LIKE ? OR cod_produto LIKE ? ORDER BY produto ASC";
    $stmt = $conn->prepare($sql);
    $search = "%{$query}%";
    $stmt->bind_param("ss",$search, $search);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='card_section'>";
        while($row = $result->fetch_assoc()) {
            echo "
                <div class='product_card'>
                    <label for='id'>ID:</label>
                    <input type='text' id='id' value='" . $row["id"] . "' disabled>
                    
                    <label for='cod_produto'>Código do Produto:</label>
                    <input type='text' id='cod_produto' value='" . $row["cod_produto"] . "' disabled>
                    
                    <label for='produto'>Nome:</label>
                    <input type='text' id='produto' value='" . $row["produto"] . "' disabled>
                    
                    <label for='categoria'>Categoria:</label>
                    <input type='text' id='categoria' value='" . $row["categoria"] . "' disabled>
                    
                    <label for='preco_fab'>Preço de Fabrica:</label>
                    <input type='text' id='preco_fab' value='" . $row["preco_fab"] . "' disabled>
                    
                    <label for='preco'>Preço de Venda:</label>
                    <input type='text' id='preco' value='" . $row["preco"] . "' disabled>
                    
                    <label for='tamanho'>Tamanho:</label>
                    <input type='text' id='tamanho' value='" . $row["tamanho"] . "' disabled>
                    
                    <label for='sabor'>Sabor:</label>
                    <input type='text' id='sabor' value='" . $row["sabor"] . "' disabled>
                    
                    <label for='cor'>Cor:</label>
                    <input type='text' id='cor' value='" . $row["cor"] . "' disabled>
                    
                    <label for='quantidade'>Quantidade:</label>
                    <input type='text' id='quantidade' value='" . $row["quantidade"] . "' disabled>
                    
                    <label for='validade'>Validade:</label>
                    <input type='date' id='validade' value='" . $row["validade"] . "' disabled>
                    
                    <a href='editar.php?id=" . $row["id"] . "'>Editar</a>
                </div>
            ";
        }
        echo "</section>";
    } else {
        echo "Nenhum produto encontrado.";
    }

    $stmt->close();
} else {
    echo "Por favor, insira um termo de busca.";
}

$conn->close();
?>
</div>
<?php include('../templates/footer.php'); ?>
