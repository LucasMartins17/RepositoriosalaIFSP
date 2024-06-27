<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../Login/login.php");
    exit();
}

// Conexão com o banco de dados
require "../../Conexao/Conexao.php";

// Obtém o email da sessão
$email = $_SESSION['email'];

// Consulta para obter o id_func do usuário
$comando = "SELECT id_func FROM usuario WHERE email = '$email'";
$resultado = mysqli_query($conexao, $comando);

if ($resultado) {
    $usuario = mysqli_fetch_assoc($resultado);
    if ($usuario['id_func'] == 5) {
        header("Location: ../UsuarioBanner/UserTxtBanner.php");
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
    <title>ADM</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="#" id="back-button"><img class="back-button" src="icons/back-button.svg" alt="Voltar"></a>
        <img src="icons/ifsp_logo_itp.png" alt="Instituto Federal" class="logo">
    </header>
    <div class="container">
        <h1>Insira o texto do</h1>
        <h1 class="descer">Banner</h1>
        <form action="UploadBanner.php" method="post" enctype="multipart/form-data">
            <label for="title">Título:</label>
            <input type="text" id="title" name="title" value="<?php echo $_POST['Titulo']; ?>">
            
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" placeholder="Por favor seja direto"><?php echo $_POST['Descricao']; ?></textarea>
            
            <label for="alvo">Público alvo:</label>
            <input type="text" id="alvo" name="alvo" placeholder="Ex: Integrado" value="<?php echo $_POST['pubAlv']; ?>">
            
            <label for="dataInit">Data inicial:</label>
            <input type="date" id="dataInit" name="dataInit" placeholder="Ex: 10/03/2024" value="<?php echo $_POST['DtInicio']; ?>">
            
            <label for="dataFim">Data Final:</label>
            <input type="date" id="dataFim" name="dataFim" placeholder="Ex: 10/03/2024" value="<?php echo $_POST['DtFinal']; ?>">
            
            <label for="horaInit">Horário de início:</label>
            <input type="time" id="horaInit" name="horaInit" placeholder="Ex: 10:10" value="<?php echo $_POST['HrIni']; ?>">
            
            <label for="horaFim">Horário de Término:</label>
            <input type="time" id="horaFim" name="horaFim" placeholder="Ex: 10:10" value="<?php echo $_POST['HrFinal']; ?>">
            
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo">
                <option value="aviso" <?php if ($_POST['Tipo'] == 'aviso') echo 'selected'; ?>>Aviso</option>
                <option value="anuncio" <?php if ($_POST['Tipo'] == 'anuncio') echo 'selected'; ?>>Anuncio</option>
            </select>
            <label class="custom-upload" for="banner">Upload do banner</label>
            <input type="file" id="banner" name="imagens[]" class="hidden-upload" multiple required>
            <button type="submit">Enviar</button>
        </form>
    </div>
    <script>
        document.getElementById('back-button').addEventListener('click', function(event) {
            event.preventDefault(); // Previne o comportamento padrão do link
            history.back(); // Volta para a página anterior
        });
    </script>
</body>
</html>
