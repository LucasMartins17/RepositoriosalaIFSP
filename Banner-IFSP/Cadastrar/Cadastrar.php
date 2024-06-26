<?php
require "../Conexao/Conexao.php";

$nome = $_POST['nome'];
$prontuario = $_POST['prontuario'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$id_func = 5; // Definindo "usuario normal" como padrão

if (empty($nome) || empty($prontuario) || empty($cpf) || empty($email) || empty($senha)) {
    echo "Preencha todos os campos corretamente";
} else {
    $comando = "INSERT INTO usuario (id_func, CPF, nome, email, senha, prontuario, dataInscricao) VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conexao, $comando);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "isssss", $id_func, $cpf, $nome, $email, $senha, $prontuario);

        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            echo "Novo registro criado com sucesso!";
            header("Location: ../Anuncieaqui/AnuncieAqui.html");
            exit();
        } else {
            die(mysqli_error($conexao));
        }
    } else {
        die(mysqli_error($conexao));
    }
}
?>
    