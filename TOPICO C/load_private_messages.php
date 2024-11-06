<?php
session_start();  // Inicia a sessão

include('conectiondb.php');

$recipient = $_GET['recipient'] ?? '';  // Obtém o destinatário da requisição

if (!empty($recipient)) {
    $sender = $_SESSION['username'];  // Nome de usuário do remetente

    // Consulta para buscar mensagens privadas entre o remetente e o destinatário
    $query = "SELECT sender, message FROM messages WHERE (sender = ? AND recipient = ?) OR (sender = ? AND recipient = ?) ORDER BY id DESC LIMIT 20";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $sender, $recipient, $recipient, $sender);
    $stmt->execute();
    $result = $stmt->get_result();

    $messages = array();

    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    echo json_encode($messages);
} else {
    echo json_encode(["status" => "error", "message" => "Destinatário não especificado."]);
}

$conn->close();
?>
