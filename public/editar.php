<?php
include('../templates/header.php');
include('../includes/conexao.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para obter os dados do produto
    $sql = "SELECT * FROM estoque WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Produto não encontrado.";
        exit();
    }
} else {
    echo "ID do produto não especificado.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cod_produto = $_POST['cod_produto'];
    $produto = $_POST['produto'];
    $categoria = $_POST['categoria'];
    $preco_fab = $_POST['preco_fab'];
    $preco = $_POST['preco'];
    $tamanho = $_POST['tamanho'];
    $sabor = $_POST['sabor'];
    $cor = $_POST['cor'];
    $quantidade = $_POST['quantidade'];
    $validade = $_POST['validade'];

    // Atualização dos dados do produto
    $sql = "UPDATE estoque SET cod_produto=?, produto=?, categoria=?, preco_fab=?, preco=?, tamanho=?, sabor=?, cor=?, quantidade=?, validade=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssisi", $cod_produto, $produto, $categoria, $preco_fab, $preco, $tamanho, $sabor, $cor, $quantidade, $validade, $id);

    if ($stmt->execute()) {
        echo "Produto atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar o produto: " . $stmt->error;
    }
}
?>

<div class="card_form container">
    <h2>Editar Produto</h2>
    <form action="editar.php?id=<?php echo $id; ?>" method="post">
        Código do Produto: <input type="text" name="cod_produto" value="<?php echo $row['cod_produto']; ?>"><br>
        Nome: <input type="text" name="produto" value="<?php echo $row['produto']; ?>"><br>
        Categoria: <input type="text" name="categoria" value="<?php echo $row['categoria']; ?>"><br>
        Preço de Fabrica: <input type="text" name="preco_fab" value="<?php echo $row['preco_fab']; ?>"><br>
        Preço de Venda: <input type="text" name="preco" value="<?php echo $row['preco']; ?>"><br>
        Tamanho: <input type="text" name="tamanho" value="<?php echo $row['tamanho']; ?>"><br>
        Sabor: <input type="text" name="sabor" value="<?php echo $row['sabor']; ?>"><br>
        Cor: <input type="text" name="cor" value="<?php echo $row['cor']; ?>"><br>
        Quantidade: <input type="text" name="quantidade" value="<?php echo $row['quantidade']; ?>"><br>
        Validade: <br><input type="date" name="validade" value="<?php echo $row['validade']; ?>"><br>
        <input type="submit" value="Atualizar">
    </form>
</div>

<?php
include('../templates/footer.php');
$stmt->close();
$conn->close();
?>
