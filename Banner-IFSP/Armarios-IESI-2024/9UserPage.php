<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituto Federal - Armarios - regras</title>
    <link rel="stylesheet" href="styles/UserPage.css">
</head>
<body>
    <?php
        require "1header.php";
        
        $IdFunc = $usuario['id_func'];
        $sqlFubc = "SELECT * FROM funcao WHERE Id = $IdFunc";
        $resultFunc = mysqli_query($conexao, $comando);
        $funcao = mysqli_fetch_assoc($resultFunc);
    ?>

    <div class="container">
        <div class="titulo">
            <h1>Informações do usuario</h1>
        </div>
    <div class="infoUser">
        <h1>NOME</h1>
        <p><?=$usuario['nome']?></p>
        <h1>prontuario</h1>
        <p><?=$usuario['prontuario']?></p>
        <h1>DATA DE INSCRIÇÃO</h1>
        <p><?=$usuario['dataInscricao']?></p>
        
    </div>
    </div>
</body>
</html>