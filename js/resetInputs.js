document.addEventListener('DOMContentLoaded', function() {
    var allInputs = document.querySelectorAll('input[type="text"]');
    allInputs.forEach(function(singleInput) {
        singleInput.value = '';
    });
});

document.getElementById('produtoForm').addEventListener('submit', function(event) {
    var allInputs = document.querySelectorAll('input[type="text"]');
    allInputs.forEach(function(singleInput) {
        singleInput.value = '';
    });

    // Mensagem de feedback (opcional)
    var output = document.createElement('div');
    output.innerHTML = "Form submitted and cleared successfully!";
    document.body.appendChild(output);
});
