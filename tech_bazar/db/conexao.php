<?php
    function conectarDB(){
        $servidor = "db";
        $usuario ="root";
        $senha = "123";
        $nome_banco ="TechBazar";
        $conexao = mysqli_connect($servidor, $usuario, $senha, $nome_banco );
        return $conexao;
    }

    function desconectarDB($conexao){
        mysqli_close($conexao);
    }

    function executarSQL($sql){
        $conexao = conectarDB();
        $retorno = mysqli_query($conexao, $sql);
        desconectarDB($conexao);
        return $retorno;
    }
?>