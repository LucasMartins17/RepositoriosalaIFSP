<?php
session_start();
require "conexao.php";

$email = $_POST['email'];
$senha = $_POST['senha'];

$comando = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
$resultado = mysqli_query($conexao, $comando);



if ($resultado) {
    $nLinhas = mysqli_num_rows($resultado);
    if ($nLinhas == 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        $_SESSION['email'] = $email;
        $_SESSION['nome'] = $usuario['nome']; // Adiciona o nome do usuário à sessão
        echo $usuario['id_func'];
        // Verifica o id_func do usuário
        if ($usuario['id_func']) {
            header("Location: 3initialPage.php");
        }
        exit();
    } else {
        $_SESSION['erro'] = "Email ou senha inválidos.";
        header("Location: 1login.php");
        exit();
    }
} else {
    $_SESSION['erro'] = "Erro na consulta ao banco de dados";
    header("Location: 1login.php");
    exit();
}
?>