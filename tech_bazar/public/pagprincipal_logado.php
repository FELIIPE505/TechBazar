<?php 
session_start();
// Verifica se o usuário não está autenticado
if (!isset($_SESSION['nome_usuario']) || !isset($_SESSION['email_usuario'])) {
    header('Location: login.php');
    exit; // Sempre use exit após um redirecionamento
}

// Verifica se o usuário é administrador
if (!isset($_SESSION['administrador']) || $_SESSION['administrador'] !== '1') {
    header('Location: login.php');
    exit; // Sempre use exit após um redirecionamento
}
require_once('../db/conexao.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body background="/imagens/hex2f3136.png">

    <!-- Header -->
    <header>
        <div class="logo">
            <img src="/imagens/logo.png" alt="Logo" id="logo">
        </div>
        <nav>
            <button onclick="window.location.href='pagprincipal_logado.php'">Loja</button>
            <button onclick="window.location.href='biblioteca.php'">Minha Biblioteca</button>
            <button onclick="window.location.href='categorias.php'">Categorias</button>
        </nav>
        <div class="search-user">
            <input type="text" placeholder="Pesquisar...">
            <button>🔍</button>
            <a href="perfil_usuario.php"><button>👤</button></a>
        </div>
    </header>

    <br><br>
    <!-- Main Content -->
    <main>
        <!-- Carrossel de Imagens -->
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
              <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
              <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
              <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="/imagens/a.png" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="/imagens/b.png" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="/imagens/a.png" alt="Third slide">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>
    </main>

    <!-- Cards de Jogos -->
    <div class="container mt-5">
            <div class="row">
                <?php
                    $conexao = conectarDB();

                    // Consulta à tabela tb_jogo
                    $sql = "SELECT * FROM tb_jogo";
                    $result = mysqli_query($conexao, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $count = 0; // Contador para criar novas linhas a cada 5 cards
                        while($row = mysqli_fetch_assoc($result)) {
                            // Exibe os dados de cada jogo
                            if ($count % 5 === 0) {
                                echo '<div class="w-100"></div>'; // Cria uma nova linha a cada 5 cards
                            }
                            echo '
                            <div class="col-md-2 mb-4">
                                <div class="card h-100">
                                    <img src="/imagens/' . $row['nome_jogo'] . '.png" class="card-img-top" alt="' . $row['nome_jogo'] . '">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $row['nome_jogo'] . '</h5>
                                        <p class="card-text">' . $row['descricao_jogo'] . '</p>
                                        <p class="card-text">Categoria: ' . $row['categoria_jogo'] . '</p>
                                        <p class="card-text">Preço: R$ ' . number_format($row['preco_jogo'], 2, ',', '.') . '</p>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary">Comprar</button>
                                    </div>
                                </div>
                            </div>
                            ';
                            $count++;
                        }
                    } else {
                        echo '<p class="text-center">Nenhum jogo encontrado.</p>';
                    }

                    desconectarDB($conexao);
                ?>
            </div>
        </div>
    </main>
    <?php echo($_SESSION['id_usuario']) ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
