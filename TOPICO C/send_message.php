<?php
session_start();
include('conectiondb.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipient = $_POST['recipient'] ?? 'public';
    $message = $_POST['message'] ?? '';
    $sender = $_SESSION['username'];

    if (!empty($message)) {
        $stmt = $conn->prepare("INSERT INTO messages (sender, message, recipient) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $sender, $message, $recipient);

        if ($stmt->execute()) {
            echo "Mensagem enviada com sucesso!";
        } else {
            echo "Erro ao enviar mensagem: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
