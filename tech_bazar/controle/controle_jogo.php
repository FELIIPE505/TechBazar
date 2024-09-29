<?php
// Inclui o arquivo de conexão
require_once('../db/conexao.php');

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $nome_jogo = $_POST['nome_jogo'];
    $descricao_jogo = $_POST['descricao_jogo'];
    
    $preco_jogo = $_POST['preco_jogo'];
    $categoria_jogo = $_POST['categoria_jogo'];

    // Estabelece a conexão
    $conexao = conectarDB();

    // Verifica se é uma operação de inserção ou atualização
    if ($_POST['action'] == 'insert') {
        // Query para inserir um novo jogo
        $stmt = $conexao->prepare("INSERT INTO tb_jogo (nome_jogo, descricao_jogo, preco_jogo, categoria_jogo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $nome_jogo, $descricao_jogo, $preco_jogo, $categoria_jogo);

        if ($stmt->execute()) {
            echo "<script>
                alert('Jogo cadastrado com sucesso!');
                window.location.href = '../public/pagprinc_logadoadm.php';
            </script>";
        } else {
            echo "<script>
                alert('Erro ao cadastrar jogo!');
                window.location.href = '../public/adc_jogo.php';
            </script>";
        }

        $stmt->close();
    } elseif ($_POST['action'] == 'update') {
        // Para o caso de atualização, recebemos também o ID do jogo
        $id_jogo = $_POST['id_jogo'];

        // Query para atualizar os dados do jogo existente
        $stmt = $conexao->prepare("UPDATE tb_jogo SET nome_jogo = ?, descricao_jogo = ?, preco_jogo = ?, categoria_jogo = ? WHERE id_jogo = ?");
        $stmt->bind_param("ssdsi", $nome_jogo, $descricao_jogo, $preco_jogo, $categoria_jogo, $id_jogo);

        if ($stmt->execute()) {
            echo "<script>
                alert('Jogo atualizado com sucesso!');
                window.location.href = '../public/pagprinc_logadoadm.php';
            </script>";
        } else {
            echo "<script>
                alert('Erro ao atualizar jogo!');
                window.location.href = '../public/adc_jogo.php';
            </script>";
        }

        $stmt->close();
    }

    // Fecha a conexão
    desconectarDB($conexao);
}
?>
