<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../Login/login.php");
    exit();
}

require "../Conexao/Conexao.php";
$email = $_SESSION['email'];

// Consulta para obter o id_func do usuário
$comando = "SELECT id_func FROM usuario WHERE email = '$email'";
$resultado = mysqli_query($conexao, $comando);

if ($resultado) {
    $usuario = mysqli_fetch_assoc($resultado);
    if ($usuario['id_func'] == 5) {
        header("Location: ../index.php");
        exit();
    }
} else {
    $_SESSION['erro'] = "Erro na consulta ao banco de dados";
    header("Location: ../Login/login.php");
    exit();
}


?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anuncios</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="#"><img class="back-button" src="icons/back-button.svg" alt="Voltar"></a>
        
        <img src="icons/ifsp_logo_itp.png" alt="Instituto Federal" class="logo">
    </header>
    <div class="container">
    <h1>Ola <span><?php echo $_SESSION['nome']; ?>!</span></h1>
        
        <div class="meus-anuncios">
            <a href="../PastaBanners/pagBanners.php"><h2>Banners recebidos</h2></a>
            <a href="../PastaTextBanner/TxtBanner.php"><h2>Upload banner</h2></a>
            <a href="../Anuncio/Anuncio.php"><h2>Anuncios</h2></a>
        </div>
    </div>
</body>
</html>