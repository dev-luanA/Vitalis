document.addEventListener("DOMContentLoaded", function() {
    const chatBox = document.getElementById('chat-box');
    const sendBtn = document.getElementById('sendBtn');
    const messageInput = document.getElementById('message');

    // Função para enviar a mensagem
    sendBtn.addEventListener('click', function() {
        const message = messageInput.value;

        if (message.trim() !== "") {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "send_message.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Se a mensagem for enviada com sucesso, limpamos o input e recarregamos o chat
                    messageInput.value = '';
                    loadMessages(); // Carregar e atualizar mensagens
                }
            };

            xhr.send("message=" + encodeURIComponent(message) + "&recipient=public");
        }
    });

    // Função para carregar as mensagens do banco de dados
    function loadMessages() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "get_messages.php", true);  // Arquivo PHP que vai retornar as mensagens em formato JSON

        xhr.onload = function() {
            if (xhr.status === 200) {
                const messages = JSON.parse(xhr.responseText);
                chatBox.innerHTML = '';  // Limpa o conteúdo do chatBox

                messages.forEach(function(msg) {
                    const messageElement = document.createElement('div');
                    messageElement.textContent = msg.sender + ": " + msg.message;
                    chatBox.appendChild(messageElement);
                });
            }
        };

        xhr.send();
    }

    // Carregar mensagens ao abrir a página
    loadMessages();

    // Atualizar o chat periodicamente (ex: a cada 5 segundos)
    setInterval(loadMessages, 5000);
});



    // Função para tratar o login via AJAX
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita a submissão padrão do formulário

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Enviar dados de login para o backend usando Fetch API
        fetch('login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Log para depuração

            if (data.includes('Login successful')) {
                // Esconde as telas de login e registro e mostra o chat
                document.getElementById('login-screen').style.display = 'none';
                document.getElementById('register-screen').style.display = 'none';
                document.getElementById('chat-screen').style.display = 'block';

                // Atualiza o nome de usuário logado
                const chatUsername = document.getElementById('username');
                chatUsername.value = username;  // Armazena o nome de usuário logado
            } else {
                alert(data);  // Exibe a mensagem de erro se houver
            }
        })
        .catch(error => console.error('Erro:', error));
    });
