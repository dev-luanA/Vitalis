<?php
$servername = "localhost";  // Endereço do servidor de banco de dados (geralmente "localhost")
$username = "root";         // Nome de usuário do MySQL
$password = "";             // Senha do MySQL
$dbname = "chat_app";       // Nome do banco de dados

// Criação da conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
