<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituto Federal - Armarios</title>
    <link rel="stylesheet" href="styles/Armario.css">
    
</head>
<body>
    <?php
        require "1header.php";

        //pegando dados da tabela armario
        $sql = "SELECT * FROM Armario";
        $result = mysqli_query($conexao, $sql);
        $armarios = mysqli_fetch_all($result, MYSQLI_ASSOC);

               
    ?>
    <div class="container">
        <div class="titulo">
            <h1>Armários</h1>
            <div class="novo-armario">
                <button id="openform"> Novo armario</button>
            </div>
        </div>
        <div class="ContainerArmario">
            <!--se o idAlunoLoc for == a null ira abrir o formulario para que possa inserir informações nele-->    
            <?php
            
            foreach($armarios as $armario){
            if($armario['IdUsuario'] === null){ ?>
            <div class="ContainerEditArm">
                <div class="opcoes">
                    <a href="7armarioDelete.php?id=<?=$armario['idArmario']?>">
                        <img src="assets/trash-can.png" alt="excluir" width="20">
                    </a>
                </div>
                <div class="armarios">
                    <a href="8alunoFormulario.php?id=<?=$armario['idArmario']?>">
                        <button class="armarios-livre">
                            <img  src="assets/cadeado-aberto.png" alt="cadeado-aberto">
                            <p><?=$armario['Nome']?></p>
                        </button>
                    </a>       
                </div>
            </div>
            <?php }elseif ($armario['IdUsuario'] !== null) {?>
                <div class="ContainerEditArm">
                <div class="opcoes">
                        <a href="7armarioUpdate.php?id=<?=$armario['idArmario']?>">
                            <img src="assets/lapis.png" alt="editar" width="20">
                        </a>
                        <a href="7armarioDelete.php?id=<?=$armario['idArmario']?>">
                            <img src="assets/trash-can.png" alt="excluir" width="20">
                        </a>
                    </div>
                <div class="armarios">
                    <a href="8alunoInfo.php?id=<?=$armario['idArmario']?>">
                        <button class="armarios-ocupado">
                            <img  src="assets/cadeado.png" alt="cadeado-fechado">
                            <p><?=$armario['Nome']?></p>
                        </button>
                    </a>       
                </div>
            </div>
            <?php }
            }
            ?>
            <!--Caso o armario tenha um idAlunoLoc vinculado, ou seja, idAlunoLoc !=, ele ira ficar vermelho e MOSTRAR as informações de quem esta ocupando o armario -->
        </div>
        
<!--ABRE O FOEMULARIO PARA INSERIR UM NOVO ARMARIO-->
<div id="myForm" class="form">
    <!--Conteúdo do formulario-->
    <div class="form-content">
        <div class="corpo">
            <h1></h1>
            <div class="conteiner-form">
                <form class="form-conteudo" action="7armarioInsert.php" method="post">
                    
                    <label for="numeracao"> Numeração: </label>
                    <input name="numeracao" type="text">
                    
                <div class="button-form">
                    <button id="voltarBtn">Voltar</button>
                    <button id="confirmBtn" type="submit">Prosseguir</button>
                </div>
                </form>
            </div>
            
            <img class="close" src="assets/excluir.png" alt="sair-imagem" width="50">
        </div>
    </div>
</div>
<script>
    var modal = document.getElementById("myForm"); // Obtém a modal
    var btn = document.getElementById("openform");   // Obtém o botão que abre a modal
    var span = document.getElementsByClassName("close")[0];// Obtém o elemento <span> que fecha a modal
    var voltarBtn = document.getElementById("voltarBtn");// Obtém o botão que representa a ação de voltar
            // Quando o usuário clica no botão, abre a modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }
            // Quando o usuário clica em <span> (x), fecha a modal
    span.onclick = function() {
        modal.style.display = "none";
    }
            // Quando o usuário clica fora da modal, ela se fecha
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
    </div>                    