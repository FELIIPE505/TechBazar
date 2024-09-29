<?php
// Inclui o arquivo de conexão
require_once('../db/conexao.php');

// Verifica se existe o parâmetro ID (caso seja edição)
if (isset($_REQUEST['id'])) {
    $textoAcao = 'Alterar Jogo';
    $action = 'update';
    $idJogo = $_REQUEST['id'];

    // Busca os dados do jogo para editar
    $conexao = conectarDB();
    $stmt = $conexao->prepare("SELECT * FROM tb_jogo WHERE id_jogo = ?");
    $stmt->bind_param("i", $idJogo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $linha = $resultado->fetch_assoc();

    $nome_jogo = $linha['nome_jogo'];
    $descricao_jogo = $linha['descricao_jogo'];
    $preco_jogo = $linha['preco_jogo'];
    $categoria_jogo = $linha['categoria_jogo'];
    
    $stmt->close();
    desconectarDB($conexao);
} else {
    $textoAcao = 'Cadastrar Jogo';
    $action = 'insert';
    $nome_jogo = '';
    $descricao_jogo = '';
    $preco_jogo = '';
    $categoria_jogo = '';
    $id_jogo = '';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $textoAcao ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #2f3136; color: #c7d5e0; font-family: Arial, sans-serif; }
        .container { max-width: 500px; margin-top: 50px; }
        .form-container { background-color: #3B0076; padding: 30px; border-radius: 8px; }
        .form-label, .form-control { color: #c7d5e0; }
        .form-control { background-color: #1b2838; border: 1px solid #c7d5e0; }
        .btn-primary { background-color: #FD7014; border: none; }
        .btn-primary:hover { background-color: #8B4000; }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1><?php echo $textoAcao ?></h1>
            <form action="/controle/controle_jogo.php" method="post">
                <div class="mb-3">
                    <label for="nome_jogo" class="form-label">Nome do Jogo</label>
                    <input type="text" class="form-control" name="nome_jogo" id="nome_jogo" value="<?php echo htmlspecialchars($nome_jogo) ?>" required />
                </div>
                <div class="mb-3">
                    <label for="descricao_jogo" class="form-label">Descrição</label>
                    <textarea class="form-control" name="descricao_jogo" id="descricao_jogo" rows="3" required><?php echo htmlspecialchars($descricao_jogo) ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="preco_jogo" class="form-label">Preço (R$)</label>
                    <input type="number" step="0.01" class="form-control" name="preco_jogo" id="preco_jogo" value="<?php echo htmlspecialchars($preco_jogo) ?>" required />
                </div>
                <div class="mb-3">
                    <label for="categoria_jogo" class="form-label">Categoria</label>
                    <input type="text" class="form-control" name="categoria_jogo" id="categoria_jogo" value="<?php echo htmlspecialchars($categoria_jogo) ?>" required />
                </div>
                <input type="hidden" name="action" value="<?php echo $action ?>" />
                <input type="hidden" name="id_jogo" value="<?php echo $id_jogo ?>" />
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Enviar</button><br>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
