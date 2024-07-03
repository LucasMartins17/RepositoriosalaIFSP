<?php
session_start();

require "conexao.php";

$numeracao = $_POST["numeracao"];

$sql = "INSERT INTO Armario(Estado, Nome, IdUsuario, Dt_Emprestimo) VALUES(true, '$numeracao', null, NOW())";


if (mysqli_query($conexao, $sql)) {
    header("Location: 6armariosAdm.php");
} else {
    echo 'Erro no registro: ' . mysqli_error($conexao);
}

?>