<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

// Verifica se o ID da empresa foi passado
if (!isset($_GET['empresa_id'])) {
    echo "Empresa não especificada.";
    exit;
}

$empresa_id = intval($_GET['empresa_id']);

// Busca dados da empresa
$sql_empresa = "SELECT Nome, descricao, Caminho_imagem FROM empresas WHERE id = $empresa_id";
$result_empresa = $conn->query($sql_empresa);

if (!$result_empresa || $result_empresa->num_rows == 0) {
    echo "Empresa não encontrada.";
    exit;
}

$empresa = $result_empresa->fetch_assoc();

// Busca produtos das duas tabelas
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
    <script src="script_lista.js"></script>
</head>
<body>
    <!-- Navegação -->
    <nav>
        <ul id="menu">
            <li><a href="index.php">⇽ Voltar ao menu inicial</a></li>
            <li><a href="sobre.html">Sobre</a></li>
        </ul>
    </nav>

    <!-- Cabeçalho da empresa -->
    <header>
        <img id="logoEmpresa" src="<?php echo htmlspecialchars($empresa['Caminho_imagem'] ?? 'imagens/sem-foto.png'); ?>" width="155" height="155" alt="Logo da Empresa">
        <h1 id="Name"><?php echo htmlspecialchars($empresa['Nome']); ?></h1>
        <p class="texto"><?php echo htmlspecialchars($empresa['descricao'] ?? 'Descrição não disponível.'); ?></p>
    </header>

    <!-- Grid de produtos -->
    <div class="container-grid">
        <?php
        $temProdutos = false;

        // Função para exibir produtos
        function exibirProdutos($result) {
            $html = '';
            while ($p = $result->fetch_assoc()) {
                $nome = htmlspecialchars($p['Nome'] ?? 'Sem nome');
                $preço = isset($p['preço']) ? number_format($p['preço'], 2, ',', '.') : 'Indisponível';
                $imagem = htmlspecialchars($p['imagem'] ?? 'imagens/sem-foto.png');

                $html .= '<div class="produto">';
                $html .= "<h3>$nome</h3>";
                $html .= "<img src=\"$imagem\" width=\"155\" height=\"155\" alt=\"$nome\">";
                $html .= "<p>Preço: R$ $preço</p>";
                $html .= "<button class=\"comprar\" onclick=\"comprarProduto(this)\" nome=\"$nome\"><em>COMPRE AQUI</em></button>";
                $html .= '</div>';
            }
            return $html;
        }

        if (($result1 && $result1->num_rows > 0) || ($result2 && $result2->num_rows > 0)) {
            $temProdutos = true;
            if ($result1 && $result1->num_rows > 0) echo exibirProdutos($result1);
            if ($result2 && $result2->num_rows > 0) echo exibirProdutos($result2);
        }

        if (!$temProdutos) {
            echo "<p>Nenhum produto encontrado.</p>";
        }
        ?>
    </div>

    <!-- Rodapé -->
    <footer>
        <img src="https://i.imgur.com/iiPIgtl.png" width="155" height="155" alt="Logo do Site">
        <p>"Insafods - Simples, rápido, seu"</p>
        <p>Contato: clube@insabots.com.br</p>
        <h5><em>Site construído por: Arthur Pohl, Samuel "Jesus" Nascimento, Ísis Oliveira</em></h5>
    </footer>
</body>
</html>

<?php
$conn->close();
?>