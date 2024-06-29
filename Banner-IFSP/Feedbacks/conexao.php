<?php
    $conn = mysqli_connect("localhost", "root", "", "geral");
    $cod = mysqli_set_charset($conn, 'utf8');

    if(!$conn){
        die("Conexao falhou: " . mysqli_connect_error());
    }