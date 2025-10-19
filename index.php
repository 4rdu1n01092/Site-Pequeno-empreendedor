<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=VT323&display=swap" rel="stylesheet">
    <title>PEQUENO EMPREENEDOR</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-index.css">
</head>
<body>

<nav>
    <ul id="menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="">Sobre</a></li>
    </ul>
</nav>

<section class="hero-section"></section>

<div class="container-grid">
    <?php
    include 'db.php';
    $sql = "SELECT id, Nome, Caminho_imagem FROM empresas ORDER BY Nome";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div class="Empresa">';
            echo '<h4><strong>' . htmlspecialchars($row["Nome"]) . '</strong></h4>';
            echo '<img src="' . htmlspecialchars($row["Caminho_imagem"] ?: "imagens/default.png") . '" width="155" height="155" alt="Logo da empresa">';
            echo '<button class="botao-empresas" onclick="window.location.href = \'lista.php?empresa_id=' . intval($row["id"]) . '\'">Acesse aqui os itens</button>';
            echo '</div>';
        }
    } else {
        echo "<p>Nenhuma empresa encontrada.</p>";
    }

    $conn->close();
    ?>
</div>

</body>
</html>
