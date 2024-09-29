<?php
session_start();
require_once('../db/conexao.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    echo "<script>alert('Você precisa estar logado para acessar essa página.'); window.location.href='login.php';</script>";
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

// Buscar as informações do usuário no banco de dados
$sql = "SELECT * FROM tb_usuario WHERE id_usuario = ?";
$conexao = conectarDB();
$stmt = $conexao->prepare($sql);
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();
desconectarDB($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #2f3136;
            color: #c7d5e0;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .card {
            background-color: #3B0076;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .btn-primary {
            background-color: #FD7014;
            border: none;
        }
        .btn-primary:hover {
            background-color: #8B4000;
        }
        .btn-danger {
            background-color: #e63946;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Perfil de Usuário</h1>
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($usuario['nome_usuario']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email_usuario']); ?></p>
            <p><strong>Administrador:</strong> <?php echo $usuario['administrador'] == 1 ? 'Sim' : 'Não'; ?></p>

            <!-- Botões de Ações -->
            <a href="form_usuario.php?id=<?php echo $usuario['id_usuario']; ?>" class="btn btn-primary">Editar Perfil</a>
            <a href="/controle/controle_usuario.php?action=delete&id=<?php echo $usuario['id_usuario']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir sua conta?')">Deletar Perfil</a>
            <a href="/controle/controle_usuario.php?action=logout" class="btn btn-secondary">Logout</a>
        </div>
    </div>
</body>
</html>
