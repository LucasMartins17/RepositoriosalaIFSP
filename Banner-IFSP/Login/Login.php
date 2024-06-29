<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Instituto Federal</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="styles5.css">
</head>
<body>
    <?php
    session_start();
    if (isset($_SESSION['email'])) {
        header("Location: ../PastaTextBanner/TxtBanner.php");
        exit();
    }
    ?>
    <div class="container">
        <header>
            <button class="back-button">
                <span class="material-symbols-outlined">arrow_back</span>
            </button>    
            <div class="title-section"></div>
            <img src="icons/ifsp_logo_itp.png" alt="" id="logo">
        </header>

        <div class="login-form">
            <form action="validarLogin.php" method="post">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
                
                <a href="#" class="forgot-password">Esqueceu a senha</a>
                
                <button type="submit" class="connect-button">Entrar</button>
                
                <p>Não tem conta? <a href="../Cadastrar/Cadastrar.html" class="signup-link">clique aqui</a></p>
            </form>
            <?php
            if (isset($_SESSION['erro'])) {
                echo "<p class='error-message'>" . $_SESSION['erro'] . "</p>";
                unset($_SESSION['erro']);
            }
            ?>
        </div>
    </div>
</body>
</html>
