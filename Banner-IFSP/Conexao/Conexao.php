<?php

$conexo = mysqli_connect("localhost","root","lu172005","geral");

if($conexo == true){
    header("location: deucerto.html ");
    exit;
}else{
    die("Falha na conexão: " . mysqli_connect_error());
}

?>