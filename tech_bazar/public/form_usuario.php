<?php
// Incluiu o arquivo de conexão
require_once('../db/conexao.php');

// Verifica se existe o parâmetro ID
if (isset($_REQUEST['id'])) {
    $textoAcao = 'Alterar';
    $action = 'update';
    $idUsuario = $_REQUEST['id'];
    $sql = "SELECT * FROM tb_usuario WHERE id_usuario = $idUsuario";
    $resultado = executarSQL($sql);
    $linha = mysqli_fetch_assoc($resultado);
    $nome_usuario = $linha['nome_usuario'];
    $email_usuario = $linha['email_usuario'];
    $senha_usuario = $linha['senha_usuario'];
    $administrador = $linha['administrador'];
    $id_usuario = $linha['id_usuario'];
} else {
    $textoAcao = 'Cadastre-se';
    $action = 'insert';
    $nome_usuario = '';
    $email_usuario = '';
    $senha_usuario = '';
    $administrador = '';
    $id_usuario = '';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $textoAcao ?> Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            background-color: #2f3136; /* Fundo escuro */
            color: #c7d5e0; /* Cor clara */
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 500px;
            margin-top: 50px;
        }

        .form-container {
            background-color: #3B0076; 
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form-container h1 {
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
            border: 1px solid #c7d5e0;
        }

        .form-control:focus {
            background-color: #1b2838;
            color: #c7d5e0;
            border-color: #66c0f4;
        }

        .btn-primary {
            background-color: #FD7014; /* Cor do botão principal */
            border: none;
        }

        .btn-primary:hover {
            background-color: #8B4000;
        }

        .btn-secondary {
            background-color: #c7d5e0;
            color: #1b2838;
        }

        a {
            color: #66c0f4; /* Cor do link */
        }

        a:hover {
            text-decoration: underline;
        }

        .alert {
            margin-top: 10px;
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1><?php echo $textoAcao ?></h1>
            <form action="/controle/controle_usuario.php" method="post">
                <div class="mb-3">
                    <label for="nome_usuario" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="nome_usuario" id="nome_usuario" value="<?php echo htmlspecialchars($nome_usuario) ?>" required />
                </div>
                <div class="mb-3">
                    <label for="email_usuario" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email_usuario" id="email_usuario" value="<?php echo htmlspecialchars($email_usuario) ?>" required />
                </div>
                <div class="mb-3">
                    <label for="senha_usuario" class="form-label">Senha</label>
                    <input type="password" class="form-control" name="senha_usuario" id="senha_usuario" value="<?php echo htmlspecialchars($senha_usuario) ?>" required />
                </div>
                <div class="mb-3">
                    <label for="senha_usuario_confirmacao" class="form-label">Confirme a senha</label>
                    <input type="password" class="form-control" name="senha_usuario_confirmacao" id="senha_usuario_confirmacao" value="<?php echo htmlspecialchars($senha_usuario) ?>" required />
                </div>
                <div class="mb-3">
                    <label for="administrador" class="form-label">Administrador?</label>
                    <select class="form-select" name="administrador" id="administrador">
                        <option value="0" <?php if ($administrador == 0) echo 'selected'; ?>>Não</option>
                        <option value="1" <?php if ($administrador == 1) echo 'selected'; ?>>Sim</option>
                    </select>
                </div>
                <input type="hidden" name="action" id="action" value="<?php echo $action ?>" />
                <input type="hidden" name="id" id="id" value="<?php echo $id_usuario ?>" />
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-secondary" id="conferir" onclick="return validarSenha()">Conferir Senhas</button>
                    <button type="submit" class="btn btn-primary" id="enviar">Enviar</button><br>
                    Já é cadastrado? <a href="login.php">Faça login aqui</a>
                </div>
            </form>
        </div>
        <br><br>
    </div>

    <script>
        let senha = document.getElementById('senha_usuario');
        let senhaC = document.getElementById('senha_usuario_confirmacao');
        let btnEnviar = document.getElementById('enviar');
        
        function validarSenha() {
            if (senha.value !== "" || senhaC.value !== "") {
                if (senha.value !== senhaC.value) {
                    alert('Senhas Diferentes');
                    btnEnviar.disabled = true;
                    return false;
                } else {
                    alert('Senhas iguais, pode continuar');
                    btnEnviar.disabled = false;
                    return true;
                }
            } else {
                alert('Senhas em branco');
                btnEnviar.disabled = true;
                return false;
            }
        }
    </script>
</body>
</html>
