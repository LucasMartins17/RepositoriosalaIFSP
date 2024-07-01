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

        // Inserir dados na tabela form
        $comandoForm = "INSERT INTO form (Titulo, Descricao, DtInicio, DtFinal, HrIni, HrFinal, Tipo, pubAlv) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtForm = mysqli_prepare($conexao, $comandoForm);

        if ($stmtForm) {
            mysqli_stmt_bind_param($stmtForm, "ssssssss", $titulo, $descricao, $dataInit, $dataFim, $horaInit, $horaFim, $tipo, $pubAlvo);
            $resultadoForm = mysqli_stmt_execute($stmtForm);

            if ($resultadoForm) {
                $idForm = mysqli_insert_id($conexao);

                // Preparar caminho da imagem para inserção
                $caminhoImg = ""; // Inicializar variável

                // Para cada imagem enviada, realizar o upload
                foreach ($imagens['tmp_name'] as $img => $tmp_name) {
                    if ($tmp_name) {
                        $imagem_nome = $imagens['name'][$img];
                        $destino = "../UserUploads/" . $imagem_nome;
                        $destino2 = "UserUploads/" . $imagem_nome;
                        move_uploaded_file($tmp_name, $destino);

                        // Definir o caminho da imagem para ser inserido em userform
                        $caminhoImg = $destino2; // Usando o caminho relativo

                        // Inserir dados na tabela artes
                        $comandoArtes = "INSERT INTO artes (IdForm, Titulo, caminhoImg) VALUES (?, ?, ?)";
                        $stmtArtes = mysqli_prepare($conexao, $comandoArtes);

                        if ($stmtArtes) {
                            mysqli_stmt_bind_param($stmtArtes, "iss", $idForm, $titulo, $caminhoImg);
                            $resultadoArtes = mysqli_stmt_execute($stmtArtes);

                            if (!$resultadoArtes) {
                                throw new Exception(mysqli_error($conexao));
                            }
                        } else {
                            throw new Exception(mysqli_error($conexao));
                        }
                    }
                }

                // Inserir dados na tabela userform
                $comandoUserForm = "INSERT INTO userform (Titulo, Descricao, DtInicio, DtFinal, HrIni, HrFinal, Tipo, pubAlv, NomeUsuario, EmailUsuario, idUsuario, caminhoImg) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmtUserForm = mysqli_prepare($conexao, $comandoUserForm);

                if ($stmtUserForm) {
                    mysqli_stmt_bind_param($stmtUserForm, "ssssssssssss", $titulo, $descricao, $dataInitFull, $dataFimFull, $horaInit, $horaFim, $tipo, $pubAlvo, $nomeUsuario, $emailUsuario, $idUsuario, $caminhoImg);
                    
                    $resultadoUserForm = mysqli_stmt_execute($stmtUserForm);

                    if ($resultadoUserForm) {
                        mysqli_commit($conexao);
                        header("Location: ../index.php");
                        exit();
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
