<?php
include('../templates/header.php'); 
?>
<?php
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

$sql = "INSERT INTO estoque (cod_produto, produto, categoria, preco_fab, preco, tamanho, sabor, cor, quantidade, validade)
        VALUES ('$cod_produto', '$produto','$categoria','$preco_fab','$preco','$tamanho','$sabor','$cor','$quantidade','$validade')";
if ($conn->query($sql) === TRUE) {
   $envio_check = $produto;
} else {
    echo "Erro: " .$sql. "<br>" .$conn->error;
}

$conn->close();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <title>Produto cadastrado</title>
</head>
<body>

<div class="container">
    <?php echo "Produto: "  .$produto. " Cadastrado com sucesso!"."<br>"?>
<br>
    <a class="container btn" href="cadastro.php">Cadastrar outro produto!</a>
</div>
        
        

    <script src="../js/resetInputs.js"></script>
</body>

