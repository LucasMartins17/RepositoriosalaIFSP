<?php
require "../Conexao/Conexao.php";

$id = $_GET['id'];

$sql = "SELECT Titulo, Descricao, DtInicio, DtFinal, HrIni, HrFinal, pubAlv FROM Form WHERE IdForm = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes Banner</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="#"><img class="back-button" src="icons/back-button.svg" alt="Voltar"></a>
        <img src="icons/ifsp_logo_itp.png" alt="Instituto Federal" class="logo">
    </header>
    <div class="container">
        <h1>Detalhes</h1>
        <div class="banners">
            <div class="banner">
                <h2>Responsável: <?php echo $row["pubAlv"]; ?></h2>
                <h2>Título: <?php echo $row["Titulo"]; ?></h2>
                <h2>Data de Entrada: <?php echo $row["DtInicio"]; ?></h2>
                <h2>Data de Saída: <?php echo $row["DtFinal"]; ?></h2>
                <h2>Hora de Entrada: <?php echo $row["HrIni"]; ?></h2>
                <h2>Hora de Saída: <?php echo $row["HrFinal"]; ?></h2>
                <h2>Descrição: <?php echo $row["Descricao"]; ?></h2>
            </div>
        </div>
        <button type="submit">Upload do banner</button>
    </div>
</body>
</html>
