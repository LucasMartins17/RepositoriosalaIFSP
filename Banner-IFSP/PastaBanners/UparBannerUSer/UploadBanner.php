<?php
require "../../Conexao/Conexao.php";

// Obter os dados do formulário
$titulo = $_POST['title'];
$descricao = $_POST['descricao'];
$pubAlvo = $_POST['alvo'];
$dataInit = $_POST['dataInit'];
$dataFim = $_POST['dataFim'];
$horaInit = $_POST['horaInit'];
$horaFim = $_POST['horaFim'];
$tipo = $_POST['tipo'];
$imagens = $_FILES['imagens'];

// Verificar se existem imagens atuais
if (isset($_POST['imagens_atual'])) {
    $imagens_atual = $_POST['imagens_atual'];
}

// Validar campos obrigatórios
if (empty($titulo) || empty($descricao) || empty($pubAlvo) || empty($dataInit) || empty($dataFim) || empty($horaInit) || empty($horaFim) || empty($tipo)) {
    echo "Preencha todos os campos corretamente.";
} else {
    // Garantir que as datas e horas estejam no formato correto
    $dataInit = date('Y-m-d', strtotime($dataInit));
    $dataFim = date('Y-m-d', strtotime($dataFim));
    $horaInit = date('H:i:s', strtotime($horaInit));
    $horaFim = date('H:i:s', strtotime($horaFim));

    // Combinar data e hora
    $dataInitFull = $dataInit . ' ' . $horaInit;
    $dataFimFull = $dataFim . ' ' . $horaFim;

    // Inserir os dados na tabela "Form"
    $comando = "INSERT INTO Form (Titulo, Descricao, DtInicio, DtFinal, HrIni, HrFinal, Tipo, pubAlv) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $comando);

    if ($stmt) {
        // Vincular as variáveis à declaração
        mysqli_stmt_bind_param($stmt, "ssssssss", $titulo, $descricao, $dataInitFull, $dataFimFull, $horaInit, $horaFim, $tipo, $pubAlvo);

        // Executar a declaração preparada
        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            $form_id = mysqli_insert_id($conexao);

            // Processar imagens atuais
            if (isset($imagens_atual)) {
                foreach ($imagens_atual as $imagem_atual) {
                    // Insira o caminho da imagem atual no banco de dados, se necessário
                    // Exemplo: INSERT INTO Artes (IdForm, caminhoImg) VALUES (?, ?);
                    // $stmt_imagem_atual = mysqli_prepare($conexao, $comando_imagem_atual);
                    // mysqli_stmt_bind_param($stmt_imagem_atual, "is", $form_id, $imagem_atual);
                    // mysqli_stmt_execute($stmt_imagem_atual);
                }
            }

            // Processar novas imagens enviadas
            foreach ($imagens['tmp_name'] as $img => $tmp_name) {
                if ($tmp_name) {
                    $imagem_nome = $imagens['name'][$img];
                    $destino = "../../Uploads/" . $imagem_nome; // Definindo $destino corretamente
                    $destino2 = "Uploads/" . $imagem_nome;
                    move_uploaded_file($tmp_name, $destino);

                    $comando2 = "INSERT INTO Artes (IdForm, Titulo, caminhoImg) VALUES (?, ?, ?)";
                    $stmt2 = mysqli_prepare($conexao, $comando2);

                    if ($stmt2) {
                        // Vincular as variáveis à declaração
                        mysqli_stmt_bind_param($stmt2, "iss", $form_id, $titulo, $destino2);

                        // Executar a declaração preparada
                        $resultado2 = mysqli_stmt_execute($stmt2);

                        if (!$resultado2) {
                            die(mysqli_error($conexao));
                        }
                    } else {
                        die(mysqli_error($conexao));
                    }
                }
            }
            header("Location: ../../index.php");
        } else {
            die(mysqli_error($conexao));
        }
    } else {
        die(mysqli_error($conexao));
    }
}
?>
