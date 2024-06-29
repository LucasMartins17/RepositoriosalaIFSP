<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Instituto Federal</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        /* Estilos CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            background-color: white;
            padding: 10px;
        }

        .back {
            width: 32px;
            height: auto;
            cursor: pointer;
        }

        .title-section {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .logo {
            width: 80px;
            height: auto;
        }

        .login-form {
            margin-top: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .forgot-password {
            margin-bottom: 10px;
            font-size: 14px;
            color: #333;
            text-decoration: none;
        }

        .connect-button {
            background-color: #008000;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .connect-button:hover {
            background-color: #005c00;
        }

        .signup-link {
            text-decoration: none;
            color: #008000;
            font-weight: bold;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <a href="index.php" class="header-left">
                <img src="assets/back-button.svg" alt="Back" class="back">
            </a>  
            <div class="title-section"></div>
            <img src="icons/ifsp_logo_itp.png" alt="" class="logo">
        </header>

        <div class="login-form">
            <form action="validarLogin.php" method="post" onsubmit="return validateForm();">
                <label for="prontuario">Prontuário:</label>
                <input type="text" id="prontuario" name="prontuario" required>
                
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
                
                <a href="#" class="forgot-password">Esqueceu a senha</a>
                
                <button type="submit" class="connect-button">Entrar</button>
                
                <p>Não tem conta? <a href="#" class="signup-link">clique aqui</a></p>
            </form>
            <?php
            session_start();
            if (isset($_SESSION['erro'])) {
                echo "<p class='error-message'>" . $_SESSION['erro'] . "</p>";
                unset($_SESSION['erro']);
            }
            ?>
        </div>
    </div>

    <script>
        function validateForm() {
            var prontuario = document.getElementById('prontuario').value;
            var senha = document.getElementById('senha').value;

            if (prontuario.trim() === '' || senha.trim() === '') {
                alert('Por favor, preencha todos os campos.');
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
