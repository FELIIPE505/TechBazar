<?php
    // Inicia a sessão
    session_start();

    include_once('../db/conexao.php');

    $action = $_REQUEST['action'];

    switch ($action) {
        case 'insert':
            $nome  = $_REQUEST['nome'];
            $email  = $_REQUEST['email'];
            $senha = $_REQUEST['senha'];
            $administrador = $_REQUEST['administrador'];

            $sql = "INSERT INTO tb_usuario VALUES (NULL, '$nome', '$email', '$senha', '$administrador') ";

            $retorno = executarSQL($sql);

            if ($retorno) {
                header('Location: /public/login.php');
            } else {
                echo "Deu ruim!";
            }
            break;
        
        case 'delete':
            $id = $_REQUEST['id'];
            $sql = "DELETE FROM tb_usuario WHERE id_usuario = $id; ";
            $retorno = executarSQL($sql);
            if ($retorno) {
                echo "
                <script> 
                    window.alert('Sucesso!');
                    window.location.href='../public/index.php';
                </script>
                ";
            } else {
                echo "
                <script> 
                    window.alert('Erro ao deletar!');
                    window.location.href='../public/index.php';
                </script>
                ";
            }
            break;

        case 'update':
            $nome  = $_REQUEST['nome'];
            $email  = $_REQUEST['email'];
            $senha = $_REQUEST['senha'];
            $administrador = $_REQUEST['administrador'];
            $id = $_REQUEST['id'];

            $sql = "UPDATE tb_usuario SET nome = '$nome', email = '$email', senha = '$senha', administrador = '$administrador' WHERE id_usuario = $id;";

            $retorno = executarSQL($sql);

            if ($retorno) {
                header('Location: /public/login.php');
            } else {
                echo "Deu ruim!";
            }
            break;

        case 'login':
            $email  = $_REQUEST['email'];
            $senha = $_REQUEST['senha'];
            
            $sql = "SELECT * FROM tb_usuario WHERE email = '$email' AND senha = '$senha'";

            $retorno = executarSQL($sql);

            if (mysqli_num_rows($retorno) == 1) {
                // Armazena informações na sessão
                $linha = mysqli_fetch_array($retorno);
                $_SESSION['nome'] = $linha['nome'];
                $_SESSION['email'] = $linha['email'];
                $_SESSION['id_usuario'] = $linha['id_usuario'];
                $_SESSION['administrador'] = $linha['administrador'];
                echo $_SESSION['id_usuario'];
                echo "
                <script> 
                    window.alert('Sucesso!');
                    window.location.href='../public/index.php';
                </script>";
            } else {
                echo "Deu ruim!";
            }
            break;

        case 'logout':
            // Destrói a sessão e redireciona para a página de login
            session_destroy();
            echo "
            <script> 
                window.alert('Logout realizado com sucesso!');
                window.location.href='../public/login.php';
            </script>";
            break;

        default:
            // Tratamento de erro
            echo "Ação inválida!";
            break;
    }
?>
