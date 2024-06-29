<?php
require "../Conexao/Conexao.php";

$id = $_GET['id'];

// Seleciona os detalhes do userform
$sql = "SELECT IdUserForm, Titulo, Descricao, DtInicio, DtFinal, HrIni, HrFinal, Tipo, pubAlv, NomeUsuario FROM userform WHERE IdUserForm = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Seleciona os caminhos das imagens relacionadas ao userform
    $sqlImages = "SELECT caminhoImg FROM Artes WHERE IdForm = ?";
    $stmtImages = $conexao->prepare($sqlImages);
    $stmtImages->bind_param("i", $id);
    $stmtImages->execute();
    $resultImages = $stmtImages->get_result();

    $images = [];
    while ($imgRow = $resultImages->fetch_assoc()) {
        $images[] = "../". $imgRow['caminhoImg'];
    }
    $stmtImages->close();
} else {
    // Caso não haja resultados, pode-se redirecionar ou exibir uma mensagem de erro
    echo "Banner não encontrado.";
    exit;
}
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
                
                <?php if (!empty($images)): ?>
                    <h2>Imagens:</h2>
                    <div class="images-container">
                        <?php foreach ($images as $image): ?>
                            <br>
                            <img src="<?php echo $image; ?>" alt="Imagem do Banner" width="200px">
                        <?php endforeach; ?>
                    </div>
                <?php endif;?>
            </div>
        </div>
        
        <!-- Formulário invisível para enviar os dados para o formulário de upload -->
       <!-- Formulário invisível para enviar os dados para o formulário de upload -->
<form id="formEnviar" action="UparBannerUSer/TxtBanner.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="Titulo" value="<?php echo htmlspecialchars($row['Titulo']); ?>">
    <input type="hidden" name="Descricao" value="<?php echo htmlspecialchars($row['Descricao']); ?>">
    <input type="hidden" name="pubAlv" value="<?php echo htmlspecialchars($row['pubAlv']); ?>">
    <input type="hidden" name="DtInicio" value="<?php echo htmlspecialchars($row['DtInicio']); ?>">
    <input type="hidden" name="DtFinal" value="<?php echo htmlspecialchars($row['DtFinal']); ?>">
    <input type="hidden" name="HrIni" value="<?php echo htmlspecialchars($row['HrIni']); ?>">
    <input type="hidden" name="HrFinal" value="<?php echo htmlspecialchars($row['HrFinal']); ?>">
    <input type="hidden" name="Tipo" value="<?php echo htmlspecialchars($row['Tipo']); ?>">
    <!-- Adicionando os inputs para enviar as imagens -->
    <?php foreach ($images as $index => $image): ?>
        <input type="hidden" name="imagens_atual[]" value="<?php echo htmlspecialchars($image); ?>">
    <?php endforeach; ?>
</form>


        <button id="btnEnviarParaFormulario">Enviar para o formulário</button>

    </div>

    <script>
        document.getElementById('btnEnviarParaFormulario').addEventListener('click', function() {
            document.getElementById('formEnviar').submit();
        });
    </script>
</body>
</html>
