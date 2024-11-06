<?php
session_start();  // Inicia a sessão

include('conectiondb.php');

// Verifica se a requisição POST foi feita
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipient = $_POST['recipient'] ?? '';
    $message = $_POST['message'] ?? '';
    $sender = $_SESSION['username'];  // Nome de usuário do remetente

    // Verifica se a mensagem e o destinatário não estão vazios
    if (!empty($recipient) && !empty($message)) {
        // Prepared statement para evitar SQL Injection
        $stmt = $conn->prepare("INSERT INTO messages (sender, message, recipient) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $sender, $message, $recipient);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Mensagem privada enviada com sucesso!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Erro ao enviar mensagem: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Destinatário ou mensagem não podem estar vazios."]);
    }
}

$conn->close();
?>
