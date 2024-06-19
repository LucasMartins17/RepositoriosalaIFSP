<?php 

session_start();

if(!isset($_SESSION['email'])){
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Logado</h1>
    <a href="FinalizarSessao.php">Deslogar</a>
</body>
</html>