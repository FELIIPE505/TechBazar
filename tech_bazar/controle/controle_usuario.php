<?php
    // Inicia a sessão
    session_start();

    include_once('../db/conexao.php');

    $action = $_REQUEST['action'];

    switch ($action) {
        case 'insert':
            $nome_usuario  = $_REQUEST['nome_usuario'];
            $email_usuario  = $_REQUEST['email_usuario'];
            $senha_usuario = $_REQUEST['senha_usuario'];
            $administrador = $_REQUEST['administrador'];

            $sql = "INSERT INTO tb_usuario VALUES (NULL, '$nome_usuario', '$email_usuario', '$senha_usuario', '$administrador') ";

            $retorno = executarSQL($sql);

            if ($retorno) {
                header('Location: /public/login.php');
            } else {
                echo "Deu ruim!";
            }
            break;
        
            case 'delete':
                $id = $_REQUEST['id'];
            
                // Verificar se o ID é válido
                if (!isset($id) || empty($id)) {
                    echo "
                    <script> 
                        window.alert('ID inválido!');
                        window.location.href='../public/index.php';
                    </script>
                    ";
                    exit;
                }
            
                // Executar a exclusão do usuário
                $sql = "DELETE FROM tb_usuario WHERE id_usuario = ?";
                
                $conexao = conectarDB();
                $stmt = $conexao->prepare($sql);
                $stmt->bind_param('i', $id);
                $retorno = $stmt->execute();
                desconectarDB($conexao);
            
                // Se a exclusão for bem-sucedida
                if ($retorno) {
                    session_destroy();  // Destroi a sessão ao deletar o perfil
                    echo "
                    <script> 
                        window.alert('Conta excluída com sucesso!');
                        window.location.href='/public/index.php;
                    </script>
                    ";
                } else {
                    echo "
                    <script> 
                        window.alert('Erro ao deletar!');
                        window.location.href='/public/index.php';
                    </script>
                    ";
                }
                break;

        case 'update':
            $nome_usuario  = $_REQUEST['nome_usuario'];
            $email_usuario  = $_REQUEST['email_usuario'];
            $senha_usuario = $_REQUEST['senha_usuario'];
            $administrador = $_REQUEST['administrador'];
            $id = $_REQUEST['id'];

            $sql = "UPDATE tb_usuario SET nome_usuario = '$nome_usuario', email_usuario = '$email_usuario', senha_usuario = '$senha_usuario', administrador = '$administrador' WHERE id_usuario = $id;";

            $retorno = executarSQL($sql);

            if ($retorno) {
                header('Location: /public/login.php');
            } else {
                echo "Deu ruim!";
            }
            break;

        case 'login':
            $email_usuario  = $_REQUEST['email_usuario'];
            $senha_usuario = $_REQUEST['senha_usuario'];
            
            $sql = "SELECT * FROM tb_usuario WHERE email_usuario = '$email_usuario' AND senha_usuario = '$senha_usuario'";

            $retorno = executarSQL($sql);

            if (mysqli_num_rows($retorno) == 1) {
                // Armazena informações na sessão
                $linha = mysqli_fetch_array($retorno);
                $_SESSION['nome_usuario'] = $linha['nome_usuario'];
                $_SESSION['email_usuario'] = $linha['email_usuario'];
                $_SESSION['id_usuario'] = $linha['id_usuario'];
                $_SESSION['administrador'] = $linha['administrador'];
                
                // Verifica se o usuário é administrador
                if ($_SESSION['administrador'] == 1) {
                    echo "
                    <script> 
                        window.alert('Bem-vindo, adm do grupo!');
                        window.location.href='../public/pagprinc_logadoadm.php';
                    </script>";
                } else {
                    echo "
                    <script> 
                        window.alert('Sucesso!');
                        window.location.href='../public/pagprincipal_logado.php';
                    </script>";
                }
            } else {
                echo "
                    <script> 
                        window.alert('Algo deu errado');
                        window.location.href='../public/login.php';
                    </script>";
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
