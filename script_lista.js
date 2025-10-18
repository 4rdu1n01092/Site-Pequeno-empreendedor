//contador de clicks 
let contadorProdutos = {
    // Cookie: 0,
    // brownie: 0
    // Adicione mais produtos conforme necessário (serão inicializados dinamicamente)
};

// Contador total de cliques para gerar número do pedido
let totalDeCliques = 0;

function comprarProduto(botao) {
    // Pegar nome do produto (usa data-nome que agora é definido nos botões)
    const nomeProduto = botao.getAttribute('data-nome') || botao.getAttribute('nome') || (botao.textContent || '').trim();

    if (!nomeProduto) {
        alert('Nome do produto não disponível.');
        return;
    }

    // Garantir que exista a chave no objeto contador
    if (typeof contadorProdutos[nomeProduto] === 'undefined') {
        contadorProdutos[nomeProduto] = 0;
    }

    //Adicionar um click ao produto
    contadorProdutos[nomeProduto]++;

    // Incrementar contador total
    totalDeCliques++;

    //criar mensagem
    const numeroPedido = totalDeCliques;
    const whatsinsa = "5549992022999";
    const mensagem = `O número do pedido é ${numeroPedido} e o produto é ${nomeProduto}`;
    const linkWhatsApp = `https://wa.me/${whatsinsa}?text=${encodeURIComponent(mensagem)}`;

    //mandar para whatsapp
    window.open(linkWhatsApp, '_blank');
}