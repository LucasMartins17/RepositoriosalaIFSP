<?php
session_start();
require "config.php";

$prontuario = $_POST['prontuario'];
$senha = $_POST['senha'];

// Preparar a consulta segura para evitar SQL Injection
$stmt = $conn->prepare("SELECT * FROM usuario WHERE prontuario = ?");
$stmt->bind_param("s", $prontuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    
    // Verificar a senha
    if (password_verify($senha, $usuario['senha'])) {
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
    $_SESSION['erro'] = "Prontuário ou senha inválidos.";
    header("Location: login.php");
    exit();
}

$stmt->close();
$conn->close();
?>
