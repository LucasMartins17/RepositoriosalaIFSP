<?php 
session_start();

require 'conexao.php';

$id = $_GET['id'];

$sql = "DELETE FROM Armario WHERE idArmario = $id";
$query = mysqli_query($conexao, $sql);

header("Location: 6armariosAdm.php");