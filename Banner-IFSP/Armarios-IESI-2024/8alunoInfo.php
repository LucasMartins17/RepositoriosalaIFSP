<?php
session_start();

require "conexao.php";

$id = $_GET['id'];

$sql = "SELECT * FROM Usuario usr INNER JOIN Armario arm ON usr.IdUsuario = arm.IdUsuario WHERE idArmario = $id";

$query = mysqli_query($conexao, $sql);
$Aluno = mysqli_fetch_assoc($query);

//header info
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituto Federal - Armarios - dados aluno</title>
    <link rel="stylesheet" href="styles/InformacaoAluno.css">
</head>
<body>
    <header>
        <a href="#"><img class="back-button" src="assets/back-button.svg" alt="Voltar"></a>
        <a href="#" class="loginBtn">
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

    <div class="container">
            <div class="campo-info">
                <h1 class="tituloInfo">NOME: </h1>
                <p class="paragrafo"><?=$Aluno['nome']?></p>
                <h1 class="tituloInfo">CPF: </h1>
                <p class="paragrafo"><?=$Aluno['CPF']?></p>
                <h1 class="tituloInfo">EMAIL:</h1>
                <p class="paragrafo"><?=$Aluno['email']?></p>
                <h1 class="tituloInfo">PRONTUARIO: </h1>
                <p class="paragrafo"><?=$Aluno['prontuario']?></p>
                <h1 class="tituloInfo">Data Emprestimo</h1>
                <p class="paragrafo"><?=$Aluno['Dt_Emprestimo']?></p>
            </div>
    </div>
</body>
</html>