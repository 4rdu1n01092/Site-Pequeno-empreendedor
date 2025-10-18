<?php
// Credenciais de conexão
$servername = "localhost";
$username = "u252634646_clube";
$password = "4rdu1N0...";
$dbname = "u252634646_site";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
