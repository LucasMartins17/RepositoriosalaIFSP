<?php 

session_start();

require 'conexao.php';

$id = $_GET['id'];

$sql = "UPDATE Armario SET IdUsuario = null, Estado = true WHERE idArmario = $id";
$query = mysqli_query($conexao, $sql);

header("Location: 6armarioAdm.php");