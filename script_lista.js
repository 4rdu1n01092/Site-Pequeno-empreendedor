
//contador de clicks 
let contadorProdutos = {
    Cookie: 0,
    brownie: 0
    // Adicione mais produtos conforme necessário
};








function comprarProduto(botao){
    //Pegar nome do produto
    const nomeProduto =botao.getAttribute('nome');



   //Adicionar um clik ao produto
    contadorProdutos[nomeProduto]++;
   
   //criar mensagem
    const numeroPedido = Math.floor(totaldecliques+ 1);
    const whatsinsa = "5549988183883"
    const mensagem = `O número do pedido é ${numeroPedido} e o produto é ${nomeProduto}`;
    const linkWhatsApp = `https://wa.me/${encodeURIComponent(whatsinsa)}?text=${encodeURIComponent(mensagem)}`;
    
    //mandar para whatsapp
    window.open(linkWhatsApp, '_blank');
}