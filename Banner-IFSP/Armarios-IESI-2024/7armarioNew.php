<?php
session_start();

require "conexao.php";

$sql = "SELECT * FROM Armario";
$result = mysqli_query($conexao, $sql);
$armarios = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
    <title>Instituto Federal - Armarios - adicionar armario</title>
    <link rel="stylesheet" href="styles/Armario.css">
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
        </a>
        <img src="assets/ifsp_logo_itp.png" alt="Instituto Federal" class="logo">
    </header>
    <div class="container">
        <div class="titulo">
            <h1>ADICIONAR UM NOVO ARMÁRIO</h1>
            
        </div>
        <div class="ContainerArmario">
        <?php
            foreach($armarios as $armario):?>
                <div class="armarios">
                    <button class="armarios-livre">
                        <img  src="assets/cadeado-aberto.png" alt="cadeado-aberto">
                        <p><?=$armario["NomeArmario"]?></p>
                    </button>
                </div>
            <?php endforeach ?>
        </div>
    </div>
<!--formulario-->
<div id="myForm" class="form">
    <!--Conteúdo do formulario-->
    <div class="form-content">
        <div class="corpo">
            <h1></h1>
            <div class="conteiner-form">
                <form class="form-conteudo" action="7armarioInsert.php" method="post">
                    
                    <label for="numeracao"> Numeração: </label>
                    <input name="numeracao" type="text">
                    
                <div class="button-form">
                    <button id="voltarBtn">Voltar</button>
                    <button id="confirmBtn" type="submit">Prosseguir</button>
                </div>
                </form>
            </div>
            
            <img class="close" src="assets/excluir.png" alt="sair-imagem" width="50">
        </div>
    </div>
</div>
<script>
    var modal = document.getElementById("myForm"); // Obtém a modal
    var btn = document.getElementById("openform");   // Obtém o botão que abre a modal
    var span = document.getElementsByClassName("close")[0];// Obtém o elemento <span> que fecha a modal
    var voltarBtn = document.getElementById("voltarBtn");// Obtém o botão que representa a ação de voltar
            // Quando o usuário clica no botão, abre a modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }
            // Quando o usuário clica em <span> (x), fecha a modal
    span.onclick = function() {
        modal.style.display = "none";
    }
            // Quando o usuário clica fora da modal, ela se fecha
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
</body>
</html>