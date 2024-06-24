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
        $_SESSION['email'] = $email;
        header("Location: ../PastaTextBanner/TxtBanner.php");
        exit();
    } else {
        $_SESSION['erro'] = "Email ou senha inválidos.";
        header("Location: login.php");
        exit();
    }
} else {
    $_SESSION['erro'] = "Erro na consulta ao banco de dados";
    header("Location: index.php");
    exit();
}
?>

