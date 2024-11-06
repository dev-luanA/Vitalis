<?php
include('conectiondb.php');

// Testa a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$query = "SELECT sender, message FROM messages WHERE recipient = 'public' ORDER BY id DESC LIMIT 20";
$result = $conn->query($query);

if ($result === false) {
    echo "Erro na consulta: " . $conn->error; // Verifica erros na consulta
} elseif ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>{$row['sender']}</strong>: {$row['message']}</p>";
    }
} else {
    echo "<p>Nenhuma mensagem encontrada.</p>";
}

$conn->close();
?>
