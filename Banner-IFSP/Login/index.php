<?php

session_start();

// Verificar se a sessão está ativa
if (isset($_SESSION['email'])) {
    // Se estiver, redirecionar para a página logada
    header('Location: ../Perfil/index.php');
    exit(); // Certifique-se de encerrar o script após o redirecionamento
}
?>

<!DOCTYPE html>
<html lang="Pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="capa">

      <?php if (isset($_SESSION['erro'])) {
        echo '<h2 style="color: red;">' . $_SESSION['erro'] . '</h2 >';
        unset($_SESSION['erro']); 
    }?>
        <form action="Login.php" method="post">
          <h1>Login</h1>
          <div class="inputs">
                <input type="email" name="email" id="email" placeholder="Email" required>
                <div class="icon"><span><ion-icon name="person-circle-outline"></span></ion-icon></div>
          </div>
          <div class="inputs">
            <input type="password" name="senha" id="senha" placeholder="Senha" required>
            <div class="icon2"><span><ion-icon name="lock-closed-outline"></span></ion-icon></div>
          </div>

          <div class="lembrar-de-mim">
                <label for="lembrar"><input type="checkbox"><span>Lembre-se de mim</span></label>
                <a href="#">Esqueci minha senha</a>
          </div>

          <button type="submit" class="bnt">Login</button>
          <div class="registrar"><p>Ainda não tem uma conta ?<a href="../CadastoUsuario/index.html">Crie uma conta aqui</a></p></div>
        </form>
    </div>   

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>