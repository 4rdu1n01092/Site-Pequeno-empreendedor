function comprarProduto(botao){
    const numeroPedido = Math.floor(Math.random() * 1000) + 1;
    const nomeProduto =botao.getAtrubute(nome)
    const whatsinsa = 5549988183883
    const mensagem = `O número do pedido é ${numeroPedido} e o produto é ${nomeproduto}`;
    const linkWhatsApp = `https://wa.me/${encodeURIComponent(Wahtsinsa)}?text=${encodeURIComponent(mensagem)}`;
    

    window.open(linkWhatsApp, '_blank');
}