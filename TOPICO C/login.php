<?php
session_start();
include('conectiondb.php'); // Inclua seu arquivo de conexão com o banco de dados

// Captura mensagens de sessão
$errorMessage = $_SESSION['error'] ?? '';

// Limpa a mensagem após ser exibida
unset($_SESSION['error']);

// Processamento de login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica se o usuário existe no banco de dados
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1"); // Modifique 'users' para o nome da sua tabela
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o usuário foi encontrado
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifica a senha (supondo que você armazena a senha hashada)
        if (password_verify($password, $user['password'])) {
            // Inicia a sessão do usuário
            $_SESSION['username'] = $user['username']; // Armazena o nome de usuário na sessão
            header("Location: index.php"); // Redireciona para a página do chat
            exit();
        } else {
            // Senha incorreta
            $_SESSION['error'] = "Senha incorreta!";
            header("Location: login.php"); // Redireciona para a página de login
            exit();
        }
    } else {
        // Usuário não encontrado
        $_SESSION['error'] = "Usuário não encontrado!";
        header("Location: login.php"); // Redireciona para a página de login
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Chat App</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

<div id="login-screen">
    <h2>Login</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Nome de usuário" required>
        <input type="password" name="password" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
    
    <?php if (!empty($errorMessage)): ?>
        <div class="error-message"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <div class="register-link">
        <p>Ainda não tem uma conta? <a href="register.php">Cadastre-se aqui!</a></p>
        <p><a href="../home.php">Voltar ao inicio</a></p>
    </div>
</div>

</body>
</html>
