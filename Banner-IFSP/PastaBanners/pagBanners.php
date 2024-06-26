<?php
require "../Conexao/Conexao.php";

$sql = "SELECT IdForm, Titulo, Descricao, DtInicio, DtFinal, HrIni, HrFinal, pubAlv FROM Form";
$result = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banners</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="#"><img class="back-button" src="icons/back-button.svg" alt="Voltar"></a>
        <img src="icons/ifsp_logo_itp.png" alt="Instituto Federal" class="logo">
    </header>
    <div class="container">
        <h1>Ola <span>Name!</span></h1>
        <div class="banners">
            <h2>Banners</h2>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='banner'>";
                    echo "<a href='detalhes_banner.php?id=" . $row["IdForm"] . "'>";
                    echo "<h2>Responsável: " . $row["pubAlv"] . "</h2>";
                    echo "<h2>Título: " . $row["Titulo"] . "</h2>";
                    echo "<h2>Data de Entrada: " . $row["DtInicio"] . "</h2>";
                    echo "<h2>Data de Saída: " . $row["DtFinal"] . "</h2>";
                    echo "<h2>Hora de Entrada: " . $row["HrIni"] . "</h2>";
                    echo "<h2>Hora de Saída: " . $row["HrFinal"] . "</h2>";
                    echo "<h2>Descrição: " . $row["Descricao"] . "</h2>";
                    echo "</a>";
                    echo "</div>";
                }
            } else {
                echo "0 results";
            }
            mysqli_close($conexao);
            ?>
        </div>
    </div>
</body>
</html>
