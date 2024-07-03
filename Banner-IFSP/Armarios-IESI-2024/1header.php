<?php
if(!isset($_SESSION)){
    session_start();
}

require "conexao.php";

$email = $_SESSION['email'];

$comando = "SELECT * FROM usuario WHERE email = '$email'";
$resultado = mysqli_query($conexao, $comando);

if ($resultado) {
    $nLinhas = mysqli_num_rows($resultado);
    if ($nLinhas == 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        $_SESSION['email'] = $email;
        $_SESSION['nome'] = $usuario['nome']; // Adiciona o nome do usuário à sessão
?>

<header>
    <a href="3initialPage.php"><img class="back-button" src="assets/back-button.svg" alt="Voltar"></a>
    <a href="9UserPage.php" class="loginBtn">
    <?php
    if ($usuario['id_func'] == 4) {
    ?>
        ADM
    <?php
    } else if ($usuario['id_func'] == 3){
    ?>
        Locker
    <?php
    } else {
    ?>
        User
    <?php
    }
    }
}
        ?>
    </a>
    <img src="assets/ifsp_logo_itp.png" alt="Instituto Federal" class="logo">
</header>