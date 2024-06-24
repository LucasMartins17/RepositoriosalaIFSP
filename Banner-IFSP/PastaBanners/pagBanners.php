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
            <h2>Banners em rotação:</h2>
            <?php
            require '../Conexao/Conexao.php';

            $sql = "SELECT f.Titulo, f.Descricao, f.DtInicio, f.DtFinal, f.HrIni, f.HrFinal, f.Tipo, f.pubAlv
            FROM Form f";
    $result = $conexao->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='banner'>";
            echo "<h2>Título: " . $row['Titulo'] . "</h2>";
            echo "<h2>Data de Início: " . $row['DtInicio'] . "</h2>";
            echo "<h2>Data de Término: " . $row['DtFinal'] . "</h2>";
            echo "<h2>Horário de Início: " . $row['HrIni'] . "</h2>";
            echo "<h2>Horário de Término: " . $row['HrFinal'] . "</h2>";
            echo "<h2>Tipo: " . $row['Tipo'] . "</h2>";
            echo "<h2>Publicidade/Alvo: " . $row['pubAlv'] . "</h2>";
            echo "</div>";
        }
    } else {
        echo "Nenhum banner encontrado.";
    }
    

            $conexao->close();
            ?>
        </div>  
    </div>
</body>
</html>
