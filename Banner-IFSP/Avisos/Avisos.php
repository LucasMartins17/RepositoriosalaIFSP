<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../Login/login.php");
    exit();
}
require "../Conexao/Conexao.php";

// Consulta para obter os avisos do tipo "aviso" da tabela form
$sql = "SELECT form.Titulo, form.Descricao, form.DtInicio, form.pubAlv, Artes.caminhoImg 
        FROM form
        LEFT JOIN Artes ON form.IdForm = Artes.IdForm
        WHERE form.Tipo = 'aviso'";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avisos IFSP</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
    <style>
        .notice img {
            width: 100px; /* Tamanho pequeno para a imagem */
            height: auto;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <a href="#"><img class="back-button" src="icons/back-button.svg" alt="Voltar"></a>
            <div class="title-section">
                <img src="icons/avisos.svg" alt="Avisos" id="img">
                <h1>Avisos</h1>
            </div>
            <img src="icons/ifsp_logo_itp.png" alt="Instituto Federal" class="logo">
        </header>
       
        <main>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="notice">
                        <span class="date"><?php echo date("d/m/Y", strtotime($row['DtInicio'])); ?></span>
                        <div class="title">
                             <span class="material-symbols-outlined">person</span>    
                             <?php echo htmlspecialchars($row['Titulo']); ?>
                        </div>
                        <div class="notice-body">
                            <p>Aviso: <?php echo htmlspecialchars($row['Titulo']); ?></p>
                            <p>Descrição: <?php echo htmlspecialchars($row['Descricao']); ?></p>
                            <p>Para quem: <?php echo htmlspecialchars($row['pubAlv']); ?></p>
                            <?php if (!empty($row['caminhoImg'])): ?>
                                <img src="<?php echo "../" . htmlspecialchars($row['caminhoImg']); ?>" alt="Imagem do Aviso">
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Não há avisos disponíveis.</p>
            <?php endif; ?>
            <a href="../UsuarioBanner/UserTxtBanner.php" class="add-button">Adicionar Avisos</a>
        </main>
        <footer>
        </footer>
    </div>
</body>
</html>

<?php
$conexao->close();
?>
