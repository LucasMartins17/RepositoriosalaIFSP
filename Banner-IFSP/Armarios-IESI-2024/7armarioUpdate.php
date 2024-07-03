<?php
session_start();

require "conexao.php";

$id = $_GET['id'];

$sql = "SELECT * FROM Usuario usr INNER JOIN Armario arm ON usr.IdUsuario = arm.IdUsuario WHERE idArmario = $id";

$query = mysqli_query($conexao, $sql);
$Aluno = mysqli_fetch_assoc($query);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituto Federal - Armarios - atualizar dados</title>
    <link rel="stylesheet" href="styles\UpdateAluno.css">
</head>
<body>
    <?php
        require "1header.php";
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
            <div class="ButtonEditArmario">
                <button>
                    <a href="8alunoDelete.php?id=<?=$Aluno['idArmario']?>">
                        Excluir o aluno deste armario
                    </a>
                </button>
            </div>
        </div>  
    </div>
</body>
</html>