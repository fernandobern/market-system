<?php
include '../includes/conexao.php';
include('../templates/header.php'); 
?>

<div class="container">
    <h2 class="title title_main">Bem-vindo ao Sistema de Estoque</h2>
</div>

<?php

// Obter a data atual
$dataAtual = date('Y-m-d');

// Início busca produtos com validade próxima
// Montar a consulta
$sql = "SELECT *, (SELECT COUNT(*) FROM estoque WHERE validade < DATE_ADD(?, INTERVAL 60 DAY)) as total_count FROM estoque WHERE validade < DATE_ADD(?, INTERVAL 60 DAY) ORDER BY validade";

// Preparar a declaração
$stmt = $conn->prepare($sql);

// Verificar se a preparação foi bem-sucedida
if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
}

// Ligar os parâmetros
$stmt->bind_param('ss', $dataAtual, $dataAtual);

// Executar a declaração
$stmt->execute();

// Obter os resultados
$result = $stmt->get_result();

// Início da section container
echo '
    <h3 class="title_med container">Próximos vencimentos</h3>
    <p class="container">Total de produtos com vencimento próximo: ' . htmlspecialchars($result->fetch_assoc()['total_count']) . '</p>
    <section class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Cod</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Tamanho</th>
                <th>Sabor</th>
                <th>Cor</th>
                <th>Quantidade</th>
                <th>Validade</th>
                <th>Ações</th>
            </tr>
        </thead>
    </table>
    </section>
    <section class="table_section container">
    <table class="table">
        <tbody>
';

// Reset the result pointer and process the results
$result->data_seek(0);
while ($row = $result->fetch_assoc()) {
    echo '
        <tr>
            <td>' . htmlspecialchars($row["cod_produto"]) . '</td>
            <td>' . htmlspecialchars($row["produto"]) . '</td>
            <td>' . htmlspecialchars($row["categoria"]) . '</td>
            <td>' . htmlspecialchars($row["preco"]) . '</td>
            <td>' . htmlspecialchars($row["tamanho"]) . '</td>
            <td>' . htmlspecialchars($row["sabor"]) . '</td>
            <td>' . htmlspecialchars($row["cor"]) . '</td>
            <td>' . htmlspecialchars($row["quantidade"]) . '</td>
            <td>' . htmlspecialchars($row["validade"]) . '</td>
            <td><a href="editar.php?id=' . htmlspecialchars($row["id"]) . '">Editar</a></td>
        </tr>';
}

// Fechamento da section container
echo '
        </tbody>
    </table>
    </section><br><br>
    ';

// Fim busca produtos com validade próxima

// Início busca produtos sem estoque
$sqlQuantidadeBaixa = "SELECT *, (SELECT COUNT(*) FROM estoque WHERE quantidade < 5) as total_count FROM estoque WHERE quantidade < 5 ORDER BY quantidade ASC";

// Preparar declaração
$stmtQuantidadeBaixa = $conn->prepare($sqlQuantidadeBaixa);

// Verificar se preparação foi bem-sucedida
if ($stmtQuantidadeBaixa === false) {
    die('Preparação falhou: '. $conn->error);
}

// Executar declaração
$stmtQuantidadeBaixa->execute();

// Armazenar resultados
$resultQuantidadeBaixa = $stmtQuantidadeBaixa->get_result();

// Inicia section com conteúdo HTML de baixa quantidade
echo '
    <h3 class="title_med container">Produtos com quantidade baixa</h3>
    <p class="container">Total de produtos com quantidade baixa: ' . htmlspecialchars($resultQuantidadeBaixa->fetch_assoc()['total_count']) . '</p>
    <section class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Cod</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Tamanho</th>
                <th>Sabor</th>
                <th>Cor</th>
                <th>Quantidade</th>
                <th>Validade</th>
                <th>Ações</th>
            </tr>
        </thead>
    </table>
    </section>
    <section class="table_section container">
    <table class="table">
        <tbody>
';

// Reset the result pointer and process the results
$resultQuantidadeBaixa->data_seek(0);
while ($row = $resultQuantidadeBaixa->fetch_assoc()) {
    echo '
        <tr>
            <td>' . htmlspecialchars($row["cod_produto"]) . '</td>
            <td>' . htmlspecialchars($row["produto"]) . '</td>
            <td>' . htmlspecialchars($row["categoria"]) . '</td>
            <td>' . htmlspecialchars($row["preco"]) . '</td>
            <td>' . htmlspecialchars($row["tamanho"]) . '</td>
            <td>' . htmlspecialchars($row["sabor"]) . '</td>
            <td>' . htmlspecialchars($row["cor"]) . '</td>
            <td>' . htmlspecialchars($row["quantidade"]) . '</td>
            <td>' . htmlspecialchars($row["validade"]) . '</td>
            <td><a href="editar.php?id=' . htmlspecialchars($row["id"]) . '">Editar</a></td>
        </tr>';
}

// Fechamento section baixa validade
echo '
        </tbody>
    </table>
    </section>';

// Fechar a declaração e a conexão
$stmt->close();
$stmtQuantidadeBaixa->close();
$conn->close();

include('../templates/footer.php');
?>
