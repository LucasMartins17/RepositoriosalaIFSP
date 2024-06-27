<?php
require "../Conexao/Conexao.php";

$id = $_GET['id'];

// Seleciona os detalhes do userform
$sql = "SELECT IdUserForm, Titulo, Descricao, DtInicio, DtFinal, HrIni, HrFinal, Tipo, pubAlv, NomeUsuario FROM userform WHERE IdUserForm = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

// Seleciona os caminhos das imagens relacionadas ao userform
$sqlImages = "SELECT caminhoImg FROM Artes WHERE IdForm = ?";
$stmtImages = $conexao->prepare($sqlImages);
$stmtImages->bind_param("i", $id);
$stmtImages->execute();
$resultImages = $stmtImages->get_result();
$images = [];
while ($imgRow = $resultImages->fetch_assoc()) {
    $images[] = $imgRow['caminhoImg'];
}
$stmtImages->close();
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
        <a href="#"><img class="back-button" src="../icons/back-button.svg" alt="Voltar"></a>
        <img src="../icons/ifsp_logo_itp.png" alt="Instituto Federal" class="logo">
    </header>
    <div class="container">
        <h1>Detalhes</h1>
        <div class="banners">
            <div class="banner">
                <h2>Responsável: <?php echo $row["NomeUsuario"]; ?></h2>
                <h2>Título: <?php echo $row["Titulo"]; ?></h2>
                <h2>Publico alvo: <?php echo $row["pubAlv"]; ?></h2>
                <h2>Tipo: <?php echo $row["Tipo"]; ?></h2>
                <h2>Data de Entrada: <?php echo $row["DtInicio"]; ?></h2>
                <h2>Data de Saída: <?php echo $row["DtFinal"]; ?></h2>
                <h2>Hora de Entrada: <?php echo $row["HrIni"]; ?></h2>
                <h2>Hora de Saída: <?php echo $row["HrFinal"]; ?></h2>
                <h2>Descrição: <?php echo $row["Descricao"]; ?></h2>
                <h2>Imagens:</h2>
                <?php foreach ($images as $image): ?>
                    <img src="../<?php echo $image; ?>" alt="Banner Image" style="width: 200px; height: auto;">
                <?php endforeach; ?>
            </div>
        </div>
        <form action="UparBannerUser/TxtBanner.php" method="post">
            <input type="hidden" name="NomeUsuario" value="<?php echo $row["NomeUsuario"]; ?>">
            <input type="hidden" name="Titulo" value="<?php echo $row["Titulo"]; ?>">
            <input type="hidden" name="pubAlv" value="<?php echo $row["pubAlv"]; ?>">
            <input type="hidden" name="Tipo" value="<?php echo $row["Tipo"]; ?>">
            <input type="hidden" name="DtInicio" value="<?php echo $row["DtInicio"]; ?>">
            <input type="hidden" name="DtFinal" value="<?php echo $row["DtFinal"]; ?>">
            <input type="hidden" name="HrIni" value="<?php echo $row["HrIni"]; ?>">
            <input type="hidden" name="HrFinal" value="<?php echo $row["HrFinal"]; ?>">
            <input type="hidden" name="Descricao" value="<?php echo $row["Descricao"]; ?>">
            <button type="submit">Upload do banner</button>
        </form>
    </div>
</body>
</html>
