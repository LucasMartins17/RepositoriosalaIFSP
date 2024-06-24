<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anuncios</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: ../Login/login.php");
    exit();
}

// Verifique o cargo do usuário (você deve ter essa informação no banco de dados)
$cargo = $_SESSION['cargo']; // Suponha que o cargo esteja armazenado na sessão

// Redirecione com base no cargo
if ($cargo === 'usuario') {
    header("Location: ../UsuarioBanner/TxtBanner.php");
    exit();
} elseif ($cargo === 'adm') {
    // Redirecione para outra página de acordo com o cargo de administrador
    // Por exemplo: header("Location: ../AdminPage.php");
    // Substitua "../AdminPage.php" pelo caminho correto para a página de administração
    // Se você tiver diferentes tipos de administradores, ajuste o redirecionamento conforme necessário
    // ...
} else {
    // Redirecione para uma página padrão (caso o cargo não seja reconhecido)
    header("Location: ../PaginaPadrao.php");
    exit();
}
?>
>
    <header>
        <a href="#"><img class="back-button" src="icons/back-button.svg" alt="Voltar"></a>
        <img src="icons/ifsp_logo_itp.png" alt="Instituto Federal" class="logo">
    </header>
    <div class="container">
        <h1>Insira o texto do</h1>
        <h1 class="descer">Banner</h1>
        <form action="UploadBanner.php" method="post" enctype="multipart/form-data">
            <label for="title">Título:</label>
            <input type="text" id="title" name="title">
            
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" placeholder="Por favor seja direto"></textarea>
            
            <label for="alvo">Público alvo:</label>
            <input type="text" id="alvo" name="alvo" placeholder="Ex: Integrado">
            
            <label for="dataInit">Data inicial:</label>
            <input type="date" id="dataInit" name="dataInit" placeholder="Ex: 10/03/2024">
            
            <label for="dataFim">Data Final:</label>
            <input type="date" id="dataFim" name="dataFim" placeholder="Ex: 10/03/2024">
            
            <label for="horaInit">Horário de início:</label>
            <input type="time" id="horaInit" name="horaInit" placeholder="Ex: 10:10">
            
            <label for="horaFim">Horário de Término:</label>
            <input type="time" id="horaFim" name="horaFim" placeholder="Ex: 10:10">
            
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo">
                <option value="aviso">Aviso</option>
                <option value="anuncio">Anuncio</option>
            </select>
            <label class="custom-upload" for="banner">Upload do banner</label>
            <input type="file" id="banner" name="imagens[]" class="hidden-upload" multiple required>
            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>
