<?php
// Incluiu o arquivo de conexão
require_once('../db/conexao.php');

// Verifica se existe o parâmetro ID
if (isset($_REQUEST['id'])) {
    // Criar as variáveis para identificar a operação
    $textoAcao = 'Alterar';
    $action = 'update';
    // Pega o ID do Usuario
    $idUsuario = $_REQUEST['id'];
    // Seleciona o Usuario no banco
    $sql = "SELECT * FROM tb_usuario WHERE id_usuario = $idUsuario";
    $resultado = executarSQL($sql);
    // Transforma o resultado em array
    $linha = mysqli_fetch_assoc($resultado);
    // Pega as variáveis com os dados
    $nome = $linha['nome'];
    $email = $linha['email'];
    $senha = $linha['senha'];
    $administrador = $linha['administrador'];
    $id_usuario = $linha['id_usuario'];
} else {
    // Criar as variáveis para identificar a operação
    $textoAcao = 'Criar';
    $action = 'insert';
    // Cria as variáveis em branco
    $nome = '';
    $email = '';
    $senha = '';
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
        .container {
            max-width: 600px;
            margin-top: 20px;
        }
        .form-container {
            padding: 20px;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h1 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="text-center"><?php echo $textoAcao ?> Usuário</h1>
            <form action="/controle/controle_usuario.php" method="post">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" value="<?php echo htmlspecialchars($nome) ?>" required />
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo htmlspecialchars($email) ?>" required />
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" value="<?php echo htmlspecialchars($senha) ?>" required />
                </div>
                <div class="mb-3">
                    <label for="senha_confirmacao" class="form-label">Confirme a Senha</label>
                    <input type="password" class="form-control" name="senha_confirmacao" id="senha_confirmacao" placeholder="Confirme a senha" value="<?php echo htmlspecialchars($senha) ?>" required />
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
                    <button type="submit" class="btn btn-primary" id="enviar">Enviar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let senha = document.getElementById('senha');
        let senhaC = document.getElementById('senha_confirmacao');
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
