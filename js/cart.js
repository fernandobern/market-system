document.addEventListener("DOMContentLoaded", function () {
    const cart = [];

    window.addToCart = function () {
        const codProdutoElement = document.getElementById('cod_produto');
        const codProduto = codProdutoElement.value;
        const produto = codProdutoElement.options[codProdutoElement.selectedIndex].dataset.produto;
        const preco = parseFloat(codProdutoElement.options[codProdutoElement.selectedIndex].dataset.preco);
        const quantidade = parseInt(document.getElementById('quantidade').value);

        const existingProductIndex = cart.findIndex(item => item.codProduto === codProduto);

        if (existingProductIndex >= 0) {
            cart[existingProductIndex].quantidade += quantidade;
            cart[existingProductIndex].precoTotal += preco * quantidade;
        } else {
            cart.push({
                codProduto,
                produto,
                preco,
                quantidade,
                precoTotal: preco * quantidade
            });
        }

        updateCart();
    };

    function updateCart() {
        const cartContainer = document.getElementById('cart');
        cartContainer.innerHTML = '';

        cart.forEach(item => {
            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item');
            cartItem.innerHTML = `
                <p>Produto: ${item.produto}</p>
                <p>Código do Produto: ${item.codProduto}</p>
                <p>Quantidade: ${item.quantidade}</p>
                <p>Preço Total: R$${item.precoTotal.toFixed(2)}</p>
                <button onclick="removeFromCart('${item.codProduto}')">Remover</button>
            `;
            cartContainer.appendChild(cartItem);
        });
    }

    window.removeFromCart = function (codProduto) {
        const index = cart.findIndex(item => item.codProduto === codProduto);
        if (index >= 0) {
            cart.splice(index, 1);
            updateCart();
        }
    };

    window.finalizeSale = function () {
        if (cart.length === 0) {
            alert('Carrinho está vazio!');
            return;
        }

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../public/salvar_venda.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText);
                cart.length = 0;
                updateCart();
            }
        };
        xhr.send(JSON.stringify(cart));
    };
});
