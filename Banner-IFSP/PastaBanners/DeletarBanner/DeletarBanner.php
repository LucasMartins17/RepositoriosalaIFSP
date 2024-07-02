<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../Login/login.php");
    exit();
}

require "../../Conexao/Conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_banner = $_POST['id_banner'];

    // Consulta para excluir o banner
    $sql = "DELETE FROM userform WHERE IdUserForm = ?";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_banner);
    
    if ($stmt->execute()) {
        header("Location: ../../PastaOlaname/olaname.php");
        exit();
    } else {
        echo "Erro ao excluir o banner.";
    }

    $stmt->close();
    $conexao->close();
}
?>
