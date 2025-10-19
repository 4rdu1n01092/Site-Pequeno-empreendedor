<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

if (!isset($_GET['empresa_id'])) {
    echo "Empresa não especificada.";
    exit;
}

$empresa_id = intval($_GET['empresa_id']);

$sql_empresa = "SELECT id, Nome, descricao, Caminho_imagem FROM empresas WHERE id = $empresa_id";
$result_empresa = $conn->query($sql_empresa);

if (!$result_empresa || $result_empresa->num_rows == 0) {
    echo "Empresa não encontrada.";
    exit;
}

$empresa = $result_empresa->fetch_assoc();

$sql_produtos1 = "SELECT Nome, preço, imagem FROM produto1 WHERE Empresa = (SELECT Nome FROM empresas WHERE id = $empresa_id)";
$sql_produtos2 = "SELECT Nome, preço, imagem FROM produto2 WHERE Empresa = (SELECT Nome FROM empresas WHERE id = $empresa_id)";

$result1 = $conn->query($sql_produtos1);
$result2 = $conn->query($sql_produtos2);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($empresa['Nome']); ?> - Produtos</title>
<link rel="stylesheet" href="style-lista.css">
</head>
<body>
<nav>
    <ul id="menu">
        <li><a href="index.php">⇽ Voltar ao menu inicial</a></li>
        <li><a href="sobre.html">Sobre</a></li>
    </ul>
</nav>

<header>
    <img id="logoEmpresa" src="<?php echo htmlspecialchars($empresa['Caminho_imagem'] ?? 'imagens/sem-foto.png'); ?>" width="155" height="155" alt="Logo da Empresa">
    <h1 id="Name"><?php echo htmlspecialchars($empresa['Nome']); ?></h1>
    <p class="texto"><?php echo htmlspecialchars($empresa['descricao'] ?? 'Descrição não disponível.'); ?></p>
</header>

<div class="container-grid">
<?php
$temProdutos = false;
$modaisHtml = ''; 
function exibirProdutos($result, $empresaNome, $empresaId, &$modaisHtml) {
    $html = '';
    while ($p = $result->fetch_assoc()) {
        $nome = htmlspecialchars($p['Nome'] ?? 'Sem nome');
        $preco = isset($p['preço']) ? number_format($p['preço'], 2, ',', '.') : 'Indisponível';
        $imagem = htmlspecialchars($p['imagem'] ?? 'imagens/sem-foto.png');
        $modalId = "modal_" . md5($nome . $empresaId);

        
        $html .= '<div class="produto">';
        $html .= "<h3>$nome</h3>";
        $html .= "<img src=\"$imagem\" width=\"155\" height=\"155\" alt=\"$nome\">";
        $html .= "<p>Preço: R$ $preco</p>";
        $html .= "<button class='comprar' onclick=\"abrirModal('$modalId')\">COMPRAR</button>";
        $html .= '</div>';

        
        $modaisHtml .= "
        <div id='$modalId' class='modal'>
            <div class='modal-content'>
                <span class='fechar' onclick=\"fecharModal('$modalId')\">&times;</span>
                <h2>$nome - Pedido</h2>
                <form method='post' action='enviar_pedido.php'>
                    <input type='hidden' name='produto' value='$nome'>
                    <input type='hidden' name='preco' value='".$p['preço']."'>
                    <input type='hidden' name='empresa_id' value='$empresaId'>

                    <label>Nome completo:</label><br>
                    <input type='text' name='cliente_nome' required><br>

                    <label>Telefone:</label><br>
                    <input type='text' name='cliente_telefone' required><br>

                    <label>Observações (opcional):</label><br>
                    <textarea name='observacao'></textarea><br>

                    <label>Quantidade:</label><br>
                    <input type='number' name='quantidade' value='1' min='1' required><br><br>

                    <button type='submit'>Enviar pedido via WhatsApp</button>
                </form>
            </div>
        </div>
        ";
    }
    return $html;
}

if (($result1 && $result1->num_rows > 0) || ($result2 && $result2->num_rows > 0)) {
    $temProdutos = true;
    if ($result1 && $result1->num_rows > 0) echo exibirProdutos($result1, $empresa['Nome'], $empresa['id'], $modaisHtml);
    if ($result2 && $result2->num_rows > 0) echo exibirProdutos($result2, $empresa['Nome'], $empresa['id'], $modaisHtml);
}

if (!$temProdutos) {
    echo "<p>Nenhum produto encontrado.</p>";
}
?>
</div>

<?php

echo $modaisHtml;
?>

<footer>
    <img src="https://i.imgur.com/iiPIgtl.png" width="155" height="155" alt="Logo do Site">
    <p>"Insafods - Simples, rápido, seu"</p>
    <p>Contato: clube@insabots.com.br</p>
    <h5><em>Site construído por: Arthur Pohl, Samuel "Jesus" Nascimento, Ísis Oliveira</em></h5>
</footer>

<script>

document.addEventListener("DOMContentLoaded", function() {
    var modais = document.querySelectorAll('.modal');
    modais.forEach(function(m) {
        m.style.display = 'none';
    });
});

function abrirModal(id) {
    document.getElementById(id).style.display = 'block';
}
function fecharModal(id) {
    document.getElementById(id).style.display = 'none';
}


window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}
</script>
</body>
</html>

<?php $conn->close(); ?>
