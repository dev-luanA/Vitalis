<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <link rel="stylesheet" href="entrar.css"> 
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="left-section">
                <h1>BEM VINDO</h1>
                <img src="img/logo.png" alt="Logo" class="logo"> 
                <p>Não tem uma conta?</p>
                <button class="create-account-btn">CRIAR CONTA</button>
            </div>
            <div class="right-section">
                <h1>FAÇA LOGIN</h1>
                <form action="process_login.php" method="POST">
                    <div class="input-group">
                        <label for="username"><i class="fa fa-user"></i></label>
                        <input type="text" id="username" name="username" placeholder="Usuário" required>
                    </div>
                    <div class="input-group">
                        <label for="password"><i class="fa fa-lock"></i></label>
                        <input type="password" id="password" name="password" placeholder="Senha" required>
                        <span class="toggle-password">👁️</span>
                    </div>
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Lembrar de mim</label>
                    </div>
                    <button type="submit" class="login-btn">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
