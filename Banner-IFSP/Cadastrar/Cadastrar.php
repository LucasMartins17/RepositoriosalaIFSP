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
    $comando = "INSERT INTO usuario (id_func, CPF, nome, email, senha, prontuario, funcao, dataInscricao) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conexao, $comando);

    if ($stmt) {
        // Mapear o id_func para o nome da função correspondente
        $funcao = "Usuario"; // Nome correspondente ao id_func padrão

        mysqli_stmt_bind_param($stmt, "issssss", $id_func, $cpf, $nome, $email, $senha, $prontuario, $funcao);

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
