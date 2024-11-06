<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <style>
         * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        
        #chat-screen {
            background-color: #ffffff;
            width: 100vw;
            height: 100vh;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #4CAF50;
            font-size: 2em;
            margin-bottom: 10px;
        }
        
        #chat-box, #private-chat-box {
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fafafa;
            padding: 15px;
            height: 60vh;
            overflow-y: auto;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .chat-footer, .private-chat-footer {
            display: flex;
            gap: 10px;
        }
        
        input[type="text"] {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            font-size: 1em;
            color: #333;
            background-color: #fafafa;
            transition: border-color 0.2s;
        }

        input[type="text"]:focus {
            border-color: #4CAF50;
        }

        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .user-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .user-list li {
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            background-color: #e7f5e9;
            margin-bottom: 5px;
            text-align: center;
            color: #4CAF50;
            font-weight: bold;
            transition: background-color 0.2s;
        }

        .user-list li:hover {
            background-color: #d0e6d5;
        }

        .private-chat-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: #ffffff;
            border-radius: 0;
            box-shadow: none;
            padding: 20px;
            z-index: 1000;
        }

        .private-chat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            color: #4CAF50;
        }

        .private-chat-header h2 {
            font-size: 1.5em;
            margin: 0;
        }

        .private-chat-header button {
            background: none;
            border: none;
            color: #999;
            font-size: 1.5em;
            cursor: pointer;
            transition: color 0.3s;
        }

        .private-chat-header button:hover {
            color: #555;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 500;
        }
    </style>
</head>
<body>
    <div class="overlay" id="overlay"></div>

    <!-- Chat Público -->
    <div id="chat-screen">
        <h2>Chat Público</h2>
        <div id="chat-box">
            <!-- Mensagens do chat público aparecerão aqui -->
        </div>
        <div class="chat-footer">
            <input type="text" id="message" placeholder="Digite sua mensagem">
            <button id="sendBtn">Enviar</button>
            <button id="openPrivateChatBtn">Iniciar Chat Privado</button>
        </div>
    </div>

    <!-- Área de chat privado (escondida até que seja aberta) -->
    <div class="private-chat-container" id="private-chat-container">
        <div class="private-chat-header">
            <h2>Chat Privado com <span id="private-recipient-name"></span></h2>
            <button id="closePrivateChat">Fechar</button>
        </div>

        <div class="private-chat-box" id="private-chat-box">
            <!-- Mensagens privadas vão aparecer aqui -->
        </div>

        <div class="private-chat-footer">
            <input type="text" id="privateMessage" placeholder="Digite sua mensagem privada">
            <button id="sendPrivateBtn">Enviar Privado</button>
        </div>
    </div>

    <div id="user-list-popup" style="display:none;">
        <h3>Escolha um Usuário para Chat Privado</h3>
        <ul class="user-list" id="users"></ul>
    </div>

    <script>
        // Função para carregar mensagens públicas
        function loadPublicMessages() {
            fetch('get_messages.php')
                .then(response => response.json())
                .then(messages => {
                    let chatBox = document.getElementById('chat-box');
                    chatBox.innerHTML = '';
                    messages.forEach(msg => {
                        chatBox.innerHTML += `<p><strong>${msg.sender}:</strong> ${msg.message}</p>`;
                    });
                });
        }

        // Função para carregar usuários do banco de dados
        function loadUsers() {
            fetch('load_users.php')  // Novo arquivo para carregar usuários
                .then(response => response.json())
                .then(users => {
                    let userList = document.getElementById('users');
                    userList.innerHTML = '';
                    users.forEach(user => {
                        userList.innerHTML += `<li onclick="openPrivateChat('${user.username}')">${user.username}</li>`;
                    });
                });
        }

        // Função para abrir o chat privado
        function openPrivateChat(recipient) {
            document.getElementById('private-recipient-name').innerText = recipient;
            document.getElementById('private-chat-container').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
            loadPrivateMessages(recipient);
        }

        // Função para carregar mensagens privadas
        function loadPrivateMessages(recipient) {
            fetch(`load_private_messages.php?recipient=${recipient}`)
                .then(response => response.json())
                .then(messages => {
                    let privateChatBox = document.getElementById('private-chat-box');
                    privateChatBox.innerHTML = '';
                    messages.forEach(msg => {
                        privateChatBox.innerHTML += `<p><strong>${msg.sender}:</strong> ${msg.message}</p>`;
                    });
                });
        }

        // Função para enviar mensagem pública
        document.getElementById('sendBtn').addEventListener('click', () => {
            let message = document.getElementById('message').value;
            fetch('send_message.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `message=${message}&recipient=public`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    loadPublicMessages();
                    document.getElementById('message').value = '';
                }
            });
        });

        // Função para enviar mensagem privada
        document.getElementById('sendPrivateBtn').addEventListener('click', () => {
            let privateMessage = document.getElementById('privateMessage').value;
            let recipient = document.getElementById('private-recipient-name').innerText;
            fetch('send_private_message.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `message=${privateMessage}&recipient=${recipient}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    loadPrivateMessages(recipient);
                    document.getElementById('privateMessage').value = '';
                }
            });
        });

        // Fecha o chat privado
        document.getElementById('closePrivateChat').addEventListener('click', () => {
            document.getElementById('private-chat-container').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        });

        // Abre a lista de usuários para chat privado
        document.getElementById('openPrivateChatBtn').addEventListener('click', () => {
            loadUsers();
            document.getElementById('user-list-popup').style.display = 'block';
        });

        // Inicialização
        loadPublicMessages();
    </script>
</body>
</html>
