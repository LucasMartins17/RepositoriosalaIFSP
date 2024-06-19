<?php
session_start();
require "../Requires/conectar.php";

$email = $_POST['email'];
$senha = $_POST['senha'];

$comando = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
$resultado = mysqli_query($conexao, $comando);

if ($resultado) {
    $nLinhas = mysqli_num_rows($resultado);
    if ($nLinhas == 1) {
        $_SESSION['email'] = $email;
        $_SESSION['cargo'] = mysqli_fetch_assoc($resultado)['cargo'];

        if ($_SESSION['cargo'] == 'administrador') {
            header("Location: ../PaginaAdministrador/adm.php");
            exit();
        } else {
            header("Location: ../index.php");
            exit();
        }

    } else {
        $_SESSION['erro'] = "Email ou senha inválidos.";
        header("Location: index.php");
        exit();
    }
} else {
    $_SESSION['erro'] = "Erro na consulta ao banco de dados";
    header("Location: index.php");
    exit();
}
?>
