<?php
session_start();
require "config.php";

$prontuario = $_POST['prontuario'];
$senha = $_POST['senha'];

$comando = "SELECT * FROM usuario WHERE prontuario = '$prontuario' AND senha = '$senha'";
$resultado = mysqli_query($conn, $comando);

if ($resultado) {
    $nLinhas = mysqli_num_rows($resultado);
    if ($nLinhas == 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        $_SESSION['prontuario'] = $prontuario;
        $_SESSION['id_func'] = $usuario['id_func'];

        // Verifica o id_func do usuário
        if ($_SESSION['id_func'] == 1 || $_SESSION['id_func'] == 4) {
            header("Location: indexadm.php");
        } else {
            echo "<script>alert('Permissão negada'); window.location.href = 'login.php';</script>";
        }
        exit();
    } else {
        $_SESSION['erro'] = "Prontuário ou senha inválidos.";
        header("Location: login.php");
        exit();
    }
} else {
    $_SESSION['erro'] = "Erro na consulta ao banco de dados";
    header("Location: login.php");
    exit();
}
?>
