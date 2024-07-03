<?php
    $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituto Federal - Armarios - cadastrar</title>
    <link rel="stylesheet" href="styles\FormularioAlunoStyle.css">
</head>
<body>
    <?php
        require "1header.php";
    ?>
    <div class="container">
<div id="myForm" class="form">
    <!--Conteúdo do formulario-->
    <div class="form-content">
        <div class="corpo">
            <h1>Preencha as informações abaixo para realizar a locação</h1>
            <div class="conteiner-form">
                <form class="form-conteudo" action="8alunoInsert.php" method="post">
                    <input type="hidden" name="IdArmario" value="<?=$id?>" >
                    <?php 
                    
                    $query = "SELECT * FROM Usuario";
                    $resultado = mysqli_query($conexao, $query);
                    $Usuarios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);?>
                    
                    <select name="Usuarios" id="Usuarios">

                    <?php foreach($Usuarios as $Usuario){
                        if($Usuario['id_func'] === "5"){
                        ?>
                        <option class="OptionUsuario" value="<?=$Usuario["idUsuario"]?>">
                    
                            <p>
                            NOME:  <?=$Usuario["nome"]?>,
                            PRONTUARIO: <?=$Usuario["prontuario"]?>,
                            CPF: <?=$Usuario["CPF"]?>
                            </p>
                        </option>
                    <?php }
                } ?>
                    </select>  
                    
                    <div class="button-form">
                        <button id="confirmBtn" class="submit" type="submit">inserir</button>
                    </div>            
                </form>
            </div>
        </div>
    </div>
</div>
    </div>
</body>
</html>