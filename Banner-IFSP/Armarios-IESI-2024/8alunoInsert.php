<?php
session_start();

require "conexao.php";

$IdArmario = $_POST['IdArmario'];
$IdUser = $_POST['Usuarios'];

// Preparação da consulta de atualização
$sqlAtualizacao = "UPDATE Armario SET IdUsuario = $IdUser, Estado = false, Dt_Emprestimo = NOW() WHERE idArmario = $IdArmario";
$result= mysqli_query($conexao, $sqlAtualizacao);

header("Location: 6armariosAdm.php");