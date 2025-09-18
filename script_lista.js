
//contador de clicks 
let contadorProdutos = {
    Cookie: 0,
    brownie: 0
    // Adicione mais produtos conforme necessário
};

// Contador total de cliques para gerar número do pedido
let totalDeCliques = 0;








function comprarProduto(botao) {
    //Pegar nome do produto
    const nomeProduto = botao.getAttribute('nome');

    //Adicionar um click ao produto
    contadorProdutos[nomeProduto]++;

    // Incrementar contador total
    totalDeCliques++;

    //criar mensagem
    const numeroPedido = totalDeCliques;
    const whatsinsa = "5549988183883";
    const mensagem = `O número do pedido é ${numeroPedido} e o produto é ${nomeProduto}`;
    const linkWhatsApp = `https://wa.me/${whatsinsa}?text=${encodeURIComponent(mensagem)}`;

    //mandar para whatsapp
    window.open(linkWhatsApp, '_blank');
}