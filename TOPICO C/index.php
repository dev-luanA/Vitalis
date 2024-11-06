<?php 
session_start();
include('conectiondb.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$errorMessage = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - App</title>
    <link rel="stylesheet" href="ind.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div id="chat-screen">
    <div class="sidebar">
        <div class="logo">
            <img src="vitalis2.png" alt="Logo" class="logo-img">
        </div>
        <div class="profile">
            <p>Bem-vindo, <strong><?php echo htmlspecialchars($_SESSION['username']); ?>!</strong></p>
        </div>
        <a href="logout.php" class="logout">Sair</a>
    </div>

    <div class="chat">
        <div class="chat-header">
            <h2>Chat Público</h2>
        </div>

        <div class="chat-box" id="public-chat-box"></div>

        <div class="chat-footer">
            <input type="text" id="public-message" placeholder="Digite sua mensagem">
            <button id="sendPublicBtn">Enviar</button>
        </div>
    </div>

    <div class="private-chat">
        <h2>Chat Privado</h2>
        <select id="recipient">
            <option value="">Selecione um destinatário</option>
            <?php
            $result = $conn->query("SELECT username FROM users WHERE username != '" . $_SESSION['username'] . "'");
            while ($user = $result->fetch_assoc()) {
                echo "<option value=\"" . htmlspecialchars($user['username']) . "\">" . htmlspecialchars($user['username']) . "</option>";
            }
            ?>
        </select>

        <div class="private-chat-box" id="private-chat-box"></div>
        
        <div class="chat-footer">
            <input type="text" id="private-message" placeholder="Digite sua mensagem privada">
            <button id="sendPrivateBtn">Enviar Mensagem Privada</button>
        </div>
    </div>
</div>

<script>
function loadPublicMessages() {
    $.ajax({
        url: 'get_messages.php',
        method: 'GET',
        success: function (data) {
            $('#public-chat-box').html(data);
        },
        error: function () {
            $('#public-chat-box').html('<p>Erro ao carregar mensagens.</p>');
        }
    });
}

function loadPrivateMessages(recipient) {
    $.ajax({
        url: 'load_private_messages.php?recipient=' + recipient,
        method: 'GET',
        success: function (data) {
            const messages = JSON.parse(data);
            if (Array.isArray(messages)) {
                let messageHtml = '';
                messages.forEach(msg => {
                    messageHtml += '<p><strong>' + msg.sender + ':</strong> ' + msg.message + '</p>';
                });
                $('#private-chat-box').html(messageHtml);
            } else {
                $('#private-chat-box').html('<p>' + messages.message + '</p>');
            }
        },
        error: function () {
            $('#private-chat-box').html('<p>Erro ao carregar mensagens privadas.</p>');
        }
    });
}

setInterval(loadPublicMessages, 2000);

$('#sendPublicBtn').click(function () {
    const message = $('#public-message').val();
    if (message.trim() !== '') {
        $.ajax({
            url: 'send_message.php',
            method: 'POST',
            data: { message: message, recipient: 'public' },
            success: function () {
                $('#public-message').val('');
                loadPublicMessages();
            },
            error: function () {
                alert('Erro ao enviar mensagem pública.');
            }
        });
    }
});

$('#sendPrivateBtn').click(function () {
    const recipient = $('#recipient').val();
    const message = $('#private-message').val();
    if (recipient.trim() !== '' && message.trim() !== '') {
        $.ajax({
            url: 'send_private_message.php',
            method: 'POST',
            data: { recipient: recipient, message: message },
            success: function () {
                $('#private-message').val('');
                loadPrivateMessages(recipient);
            },
            error: function () {
                alert('Erro ao enviar mensagem privada.');
            }
        });
    }
});

$('#recipient').change(function () {
    const recipient = $(this).val();
    if (recipient) {
        loadPrivateMessages(recipient);
    } else {
        $('#private-chat-box').empty();
    }
});
</script>

</body>
</html>
