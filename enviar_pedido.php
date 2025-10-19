<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

// Recebe dados do formulário
$empresa_id = intval($_POST['empresa_id']);
$produto = $_POST['produto'];
$preco = floatval($_POST['preco']);
$cliente_nome = $_POST['cliente_nome'];
$cliente_telefone = $_POST['cliente_telefone'];
$observacao = $_POST['observacao'] ?? '';
$quantidade = intval($_POST['quantidade']);

// Gerar número do pedido PED2025-XXXX
$ano = date('Y');
$sql_ultimo = "SELECT numero_pedido FROM pedidos WHERE numero_pedido LIKE 'PED{$ano}-%' ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql_ultimo);

if ($result && $result->num_rows > 0) {
    $ultimo = $result->fetch_assoc();
    $ultimo_num = intval(substr($ultimo['numero_pedido'], 7)); // pega os últimos 4 dígitos
    $numero_pedido = 'PED'.$ano.'-'.str_pad($ultimo_num + 1, 4, '0', STR_PAD_LEFT);
} else {
    $numero_pedido = 'PED'.$ano.'-0001';
}

// Preparar e executar INSERT
$stmt = $conn->prepare("INSERT INTO pedidos 
    (numero_pedido, empresa_id, produto, preco, cliente_nome, cliente_telefone, observacao, quantidade)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Erro ao preparar a consulta: " . $conn->error);
}

$stmt->bind_param(
    "sisdsssi", 
    $numero_pedido, 
    $empresa_id, 
    $produto, 
    $preco, 
    $cliente_nome, 
    $cliente_telefone, 
    $observacao, 
    $quantidade
);

if (!$stmt->execute()) {
    die("Erro ao inserir pedido: " . $stmt->error);
}

$stmt->close();

// Criar mensagem para WhatsApp
$telefone_empresa = "5549992022999"; // número fixo da empresa
$mensagem = "Olá! Gostaria de confirmar meu pedido.\n\n";
$mensagem .= "Número do pedido: $numero_pedido\n";
$mensagem .= "Produto: $produto\n";
$mensagem .= "Preço: R$ " . number_format($preco, 2, ',', '.') . "\n";
$mensagem .= "Quantidade: $quantidade\n";
$mensagem .= "Nome: $cliente_nome\n";
$mensagem .= "Telefone: $cliente_telefone\n";
if (!empty($observacao)) $mensagem .= "Observação: $observacao\n";

// Redirecionar para WhatsApp
header("Location: https://wa.me/$telefone_empresa?text=" . urlencode($mensagem));
exit;
?>
