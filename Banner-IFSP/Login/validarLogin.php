<?php
session_start();
require "../Conexao/Conexao.php";

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

        // Verifica o idFunc do usuário
        if ($usuario['idFunc'] == 5) {
            header("Location: ../UsuarioBanner/UserTxtBanner.php");
        } else {
            header("Location: ../PastaTextBanner/TxtBanner.php");
        }
        exit();
    } else {
        $_SESSION['erro'] = "Email ou senha inválidos.";
        header("Location: login.php");
        exit();
    }
} else {
    $_SESSION['erro'] = "Erro na consulta ao banco de dados";
    header("Location: login.php");
    exit();
}
?>
