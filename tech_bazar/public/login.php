<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            background-color: #2f3136; /* Fundo escuro */
            color: #c7d5e0; /* Cor clara */
            font-family: 'Arial', sans-serif;
        }

        .login-container {
            max-width: 400px;
            margin-top: 100px;
            background-color: #3B0076; 
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-left: auto;
            margin-right: auto;
        }

        h2 {
            color: #c7d5e0; /* Título em branco */
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-label {
            color: #c7d5e0;
        }

        .form-control {
            background-color: #1b2838; /* Campo de input escuro */
            color: #c7d5e0;
            border: 1px solid #8B4000;
        }

        .form-control:focus {
            background-color: #1b2838;
            color: #c7d5e0;
            border-color: #8B4000;
        }

        .btn-primary {
            background-color: #FD7014; /* Cor do botão principal */
            border: none;
        }

        .btn-primary:hover {
            background-color: #8B4000;
        }

        a {
            color: #66c0f4; /* Cor do link */
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- header ---> 
    <header>
        <div class="logo">
            <a href="index.php"><img src="/imagens/logo.png" alt="Logo" id="logo"></a>
        </div>
        <div class="search-user">
            <a href="form_usuario.php"><button>👤</button></a>
        </div>
    </header>

    <div class="login-container">
        <h2 class="text-center">Login</h2>
        <form action="/controle/controle_usuario.php" method="post">
            <div class="mb-3">
                <label for="email_usuario" class="form-label">Email</label>
                <input type="email" class="form-control" name="email_usuario" id="email_usuario" placeholder="" required />
            </div>
            <div class="mb-3">
                <label for="senha_usuario" class="form-label">Senha</label>
                <input type="password" class="form-control" name="senha_usuario" id="senha_usuario" placeholder="" required />
            </div>
            <input type="hidden" name="action" id="action" value="login" />
            <button type="submit" class="btn btn-primary w-100">Logar</button><br><br>
            <a href="form_usuario.php">Não tem conta? Cadastre-se aqui!</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-5d4xFgy0txNvxgI0KvR03OqDo9oJfnU68scD0CFVfvrOV0DFL8WzGgX+ITh5HII4" crossorigin="anonymous"></script>
</body>
</html>
