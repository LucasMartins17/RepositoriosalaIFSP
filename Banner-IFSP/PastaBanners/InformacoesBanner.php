
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../Login/login.php");
    exit();
}
require "../Conexao/Conexao.php";

// Obtém o ID do banner da URL
$id_banner = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_banner === null) {
    header("Location: index.php");
    exit();
}

// Consulta para obter os detalhes do banner, incluindo o caminho da imagem
$sql = "SELECT uf.IdUserForm, uf.Titulo, uf.Descricao, uf.DtInicio, uf.DtFinal, uf.HrIni, uf.HrFinal, uf.Tipo, uf.pubAlv, uf.NomeUsuario, a.caminhoImg
        FROM UserForm uf
        INNER JOIN artes a ON uf.IdUserForm = a.IdForm
        WHERE uf.IdUserForm = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id_banner);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Banner não encontrado.";
    exit();
}

$banner = $result->fetch_assoc();
$stmt->close();
$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Banner</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="index.php"><img class="back-button" src="icons/back-button.svg" alt="Voltar"></a>
        <img src="icons/ifsp_logo_itp.png" alt="Instituto Federal" class="logo">
    </header>
    <div class="container-info">
        <h1>Detalhes do Banner</h1>
        <div class="banner-info">
            <h2>Responsável: <?php echo $banner["NomeUsuario"]; ?></h2>
            <h2>Título: <?php echo $banner["Titulo"]; ?></h2>
            <h2>Público Alvo: <?php echo $banner["pubAlv"]; ?></h2>
            <h2>Tipo: <?php echo $banner["Tipo"]; ?></h2>
            <h2>Data de Entrada: <?php echo $banner["DtInicio"]; ?></h2>
            <h2>Data de Saída: <?php echo $banner["DtFinal"]; ?></h2>
            <h2>Hora de Entrada: <?php echo $banner["HrIni"]; ?></h2>
            <h2>Hora de Saída: <?php echo $banner["HrFinal"]; ?></h2>
            <h2>Descrição: <?php echo $banner["Descricao"]; ?></h2>
            <h2>Imagem: </h2>
            <br>
            <!-- Exibir a imagem do banner -->
            <img src="../<?php echo $banner["caminhoImg"]; ?>" alt="Imagem do Banner" width = "200px">
        </div>
        <form action="UparBannerUser/TxtBanner.php" method="post">
            <input type="hidden" name="NomeUsuario" value="<?php echo htmlspecialchars($banner["NomeUsuario"]); ?>">
            <input type="hidden" name="Titulo" value="<?php echo htmlspecialchars($banner["Titulo"]); ?>">
            <input type="hidden" name="pubAlv" value="<?php echo htmlspecialchars($banner["pubAlv"]); ?>">
            <input type="hidden" name="Tipo" value="<?php echo htmlspecialchars($banner["Tipo"]); ?>">
            <input type="hidden" name="DtInicio" value="<?php echo htmlspecialchars($banner["DtInicio"]); ?>">
            <input type="hidden" name="DtFinal" value="<?php echo htmlspecialchars($banner["DtFinal"]); ?>">
            <input type="hidden" name="HrIni" value="<?php echo htmlspecialchars($banner["HrIni"]); ?>">
            <input type="hidden" name="HrFinal" value="<?php echo htmlspecialchars($banner["HrFinal"]); ?>">
            <input type="hidden" name="Descricao" value="<?php echo htmlspecialchars($banner["Descricao"]); ?>">
    <button type="submit">Upload do banner</button>
</form>

    </div>
</body>
</html>