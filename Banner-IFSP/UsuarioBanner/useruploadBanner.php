<?php
require "../Conexao/Conexao.php";
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../Login/login.php");
    exit();
}

if (!isset($_SESSION['nome'])) {
    echo "Erro: Nome do usuário não encontrado na sessão.";
    exit();
}

$titulo = $_POST['title'];
$descricao = $_POST['descricao'];
$pubAlvo = $_POST['alvo'];
$dataInit = $_POST['dataInit'];
$dataFim = $_POST['dataFim'];
$horaInit = $_POST['horaInit'];
$horaFim = $_POST['horaFim'];
$tipo = $_POST['tipo'];
$imagens = $_FILES['imagens'];
$emailUsuario = $_SESSION['email'];
$nomeUsuario = $_SESSION['nome'];

if (empty($titulo) || empty($descricao) || empty($pubAlvo) || empty($dataInit) || empty($dataFim) || empty($horaInit) || empty($horaFim) || empty($tipo) || empty($imagens['name'][0])) {
    echo "Preencha todos os campos corretamente.";
} else {
    mysqli_begin_transaction($conexao);

    try {
        $dataInitFull = $dataInit . ' ' . $horaInit . ':00';
        $dataFimFull = $dataFim . ' ' . $horaFim . ':00';

        $stmt = $conexao->prepare("SELECT idUsuario FROM usuario WHERE email = ?");
        $stmt->bind_param("s", $emailUsuario);
        $stmt->execute();
        $stmt->bind_result($idUsuario);
        $stmt->fetch();
        $stmt->close();

        $comando = "INSERT INTO Form (Titulo, Descricao, DtInicio, DtFinal, HrIni, HrFinal, Tipo, pubAlv) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexao, $comando);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssssss", $titulo, $descricao, $dataInitFull, $dataFimFull, $horaInit, $horaFim, $tipo, $pubAlvo);
            $resultado = mysqli_stmt_execute($stmt);

            if ($resultado) {
                $form_id = mysqli_insert_id($conexao);

                $comando2 = "INSERT INTO UserForm (Titulo, Descricao, DtInicio, DtFinal, HrIni, HrFinal, Tipo, pubAlv, NomeUsuario, EmailUsuario, idUsuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt2 = mysqli_prepare($conexao, $comando2);

                if ($stmt2) {
                    mysqli_stmt_bind_param($stmt2, "ssssssssssi", $titulo, $descricao, $dataInitFull, $dataFimFull, $horaInit, $horaFim, $tipo, $pubAlvo, $nomeUsuario, $emailUsuario, $idUsuario);
                    $resultado2 = mysqli_stmt_execute($stmt2);

                    if ($resultado2) {
                        foreach ($imagens['tmp_name'] as $img => $tmp_name) {
                            if ($tmp_name) {
                                $imagem_nome = $imagens['name'][$img];
                                $destino = "../Uploads/" . $imagem_nome;
                                $destino2 = "Uploads/" . $imagem_nome;
                                move_uploaded_file($tmp_name, $destino);

                                $comando3 = "INSERT INTO Artes (IdForm, Titulo, caminhoImg) VALUES (?, ?, ?)";
                                $stmt3 = mysqli_prepare($conexao, $comando3);

                                if ($stmt3) {
                                    mysqli_stmt_bind_param($stmt3, "iss", $form_id, $titulo, $destino2);
                                    $resultado3 = mysqli_stmt_execute($stmt3);

                                    if (!$resultado3) {
                                        throw new Exception(mysqli_error($conexao));
                                    }
                                } else {
                                    throw new Exception(mysqli_error($conexao));
                                }
                            }
                        }
                        mysqli_commit($conexao);
                        header("Location: ../index.php");
                    } else {
                        throw new Exception(mysqli_error($conexao));
                    }
                } else {
                    throw new Exception(mysqli_error($conexao));
                }
            } else {
                throw new Exception(mysqli_error($conexao));
            }
        } else {
            throw new Exception(mysqli_error($conexao));
        }
    } catch (Exception $e) {
        mysqli_rollback($conexao);
        echo "Falha ao inserir os dados: " . $e->getMessage();
    }
}
?>
