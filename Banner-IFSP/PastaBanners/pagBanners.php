<?php
require "../Conexao/Conexao.php";

$sql = "SELECT Titulo, Descricao, DtFinal FROM Form";
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
                    echo "<h2>Responsavel: </h2>";
                    echo "<h2>Titulo: " . $row["Titulo"] . "</h2>";
                    echo "<h2>Data entrega: " . $row["DtFinal"] . "</h2>";
                    echo "<h2>Descrição: " . $row["Descricao"] . "</h2>";
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
