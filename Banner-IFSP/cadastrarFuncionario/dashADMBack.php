<?php
require "conexao.php";

// Função para recuperar as funções do banco de dados
function getFuncoes($conn) {
    $comando = "SELECT Id, nomeFunc FROM funcao";
    $resultado = mysqli_query($conn, $comando);

    if (!$resultado) {
        die("Erro ao buscar funções: " . mysqli_error($conn));
    }

    $funcoes = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $funcoes[] = $row;
    }

    return $funcoes;
}

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $prontuario = trim($_POST['prontuario']);
    $cpf = trim($_POST['cpf']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $senhaconfrimada = $_POST['senhaconfrimada'];
    $funcao = $_POST['funcao'];

    if (empty($nome) || empty($prontuario) || empty($cpf) || empty($email) || empty($senha) || empty($senhaconfrimada) || empty($funcao)) {
        echo "Preencha todos os campos corretamente";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email inválido";
    } elseif ($senha !== $senhaconfrimada) {
        echo "As senhas não coincidem";
    } elseif (!preg_match('/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/', $cpf)) {
        echo "CPF inválido";
    } else {
        $nome = mysqli_real_escape_string($conn, $nome);
        $prontuario = mysqli_real_escape_string($conn, $prontuario);
        $cpf = mysqli_real_escape_string($conn, $cpf);
        $email = mysqli_real_escape_string($conn, $email);
        $senha = password_hash($senha, PASSWORD_BCRYPT);
        $funcao = (int)$funcao;

        $comando = "INSERT INTO usuario (id_func, CPF, nome, email, senha, prontuario, dataInscricao) VALUES (?, ?, ?, ?, ?, ?, NOW())";
        $stmt = mysqli_prepare($conn, $comando);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "isssss", $funcao, $cpf, $nome, $email, $senha, $prontuario);

            $resultado = mysqli_stmt_execute($stmt);

            if ($resultado) {
                header("Location: dashADM.php");
                exit();
            } else {
                die(mysqli_error($conn));
            }
        } else {
            die(mysqli_error($conn));
        }
    }
}

// Recuperar as funções do banco de dados para exibir no formulário
$funcoes = getFuncoes($conn);
?>
