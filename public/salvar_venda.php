<?php
include('../includes/conexao.php');

$data = json_decode(file_get_contents('php://input'), true);

if (empty($data)) {
    echo 'Nenhum dado recebido';
    exit;
}

$total = 0;

$conn->begin_transaction();

try {
    // Primeiro, insira a venda na tabela de vendas
    $sql = "INSERT INTO vendas (data_venda) VALUES (NOW())";
    $stmt = $conn->prepare($sql);
    if (!$stmt->execute()) {
        throw new Exception("Erro ao salvar a venda: " . $stmt->error);
    }

    $venda_id = $stmt->insert_id;

    // Depois, insira cada item do carrinho na tabela itens_venda
    $sql = "INSERT INTO itens_venda (venda_id, cod_produto, produto, preco, quantidade, preco_total) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    foreach ($data as $item) {
        $codProduto = $item['codProduto'];
        $produto = $item['produto'];
        $preco = $item['preco'];
        $quantidade = $item['quantidade'];
        $precoTotal = $item['precoTotal'];

        $stmt->bind_param("issdii", $venda_id, $codProduto, $produto, $preco, $quantidade, $precoTotal);
        if (!$stmt->execute()) {
            throw new Exception("Erro ao salvar item da venda: " . $stmt->error);
        }

        // Incrementar o valor total da venda
        $total += $precoTotal;
    }

    // Atualizar a venda com o valor total calculado
    $sql = "UPDATE vendas SET valor_total = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("di", $total, $venda_id);
    if (!$stmt->execute()) {
        throw new Exception("Erro ao atualizar o valor total da venda: " . $stmt->error);
    }

    $conn->commit();
    echo "Venda salva com sucesso!";
} catch (Exception $e) {
    $conn->rollback();
    echo $e->getMessage();
}

$stmt->close();
$conn->close();
?>
