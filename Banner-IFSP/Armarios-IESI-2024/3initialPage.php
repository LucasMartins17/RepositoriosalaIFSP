<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Instituto Federal - Armarios - inicial</title>
        <link rel="stylesheet" href="styles/InitialPage.css">
    </head>
    <body>
        <?php
            require "1header.php";
        ?>
        <div class="container">
            <div class="text">
                <div class="head_img">
                    <img class="headImage" src="assets/headImage.png" alt="Illustrative image">
                </div>
                <div class="headTitle">
                    <h1><span>MOCHILA</span></h1>
                    <h1><span>PESADA?</span></h1>
                </div>
            </div>
            <div class="headSubtitle">
                <p>Otimize seu espaço e simplifique sua rotina escolar com nosso sistema de locação de armários</p>
            </div>
            <div class="buttons">
                <div class="buttons_column">
                    <div id="avisoBox" class="btn">
                        <img id="avisoImg" class="icon" src="assets/aviso.svg" alt="Aviso">
                        <p id="avisoTxt">Alunos do ensino médio integrado tem prioridade</p>
                    </div>
                    <a href="5docs.php" class="btn">
                        <img class="icon" src="assets/documentos.svg" alt="Docs">
                        <p id="docNes">Documentos Nescessários</p>
                    </a>
                </div>
                <div class="buttons_column">
                    <a href="4regras.php" class="btn">
                        <img class="icon" src="assets/regras.svg" alt="Regras">
                        <p>Regras</p>
                    <?php
                    if ($usuario['id_func'] == 4 || $usuario['id_func'] == 3) {
                    ?>
                    <a href="6armariosAdm.php" class="btn">
                        <img class="icon" src="assets/armarios.svg" alt="Armarios">
                        <p>Armários</p>
                    </a>
                    <?php
                    } else {
                    ?>
                        <a  class="btn" id="openModalBtn">
                            <img class="icon" src="assets/armarios.svg" alt="Armarios">
                            <p>Armários</p>
                        </a>
                    </div>
                </div>
            </div>
            <div id="myModal" class="modal">
                <!-- Conteúdo da modal -->
                <div class="modal-content">
                    <div class="corpo">
                        <h1>FORMULARIO GERADO</h1>
                        <p> 
                        Um formulário foi gerado. Por favor, imprima-o, preencha as informações necessárias e, em seguida, apresente o formulário ao Centro de Apoio Educacional.
                        </p>
                        <a href="doc3.html">Sobre o Formulario</a>
                        <div class="button-modal">
                            <button id="voltarBtn">Voltar</button>
                            <button id="prosseguirBtn">Prosseguir</button>
                        </div>
                    </div>
                    <img class="close" src="assets/excluir.png" alt="X-icpne" width="50">
            </div>
        </div>
        <script>
        var modal = document.getElementById("myModal"); // Obtém a modal
        var btn = document.getElementById("openModalBtn");   // Obtém o botão que abre a modal
        var span = document.getElementsByClassName("close")[0];// Obtém o elemento <span> que fecha a modal
        var prosseguirBtn = document.getElementById("prosseguirBtn");// Obtém o botão que representa a ação de prosseguir
        var voltarBtn = document.getElementById("voltarBtn");// Obtém o botão que representa a ação de voltar
            // Quando o usuário clica no botão, abre a modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }
            // Quando o usuário clica em <span> (x), fecha a modal
        span.onclick = function() {
            modal.style.display = "none";
        }
            // Quando o usuário clica em "Prosseguir", redireciona para a próxima página
        prosseguirBtn.onclick = function() {
            window.location.href = "6armariosComon.php"; // Substitua pelo seu URL desejado
        }
            // Quando o usuário clica em "Voltar", fecha a modal
        voltarBtn.onclick = function() {
            modal.style.display = "none";
        }
            // Quando o usuário clica fora da modal, ela se fecha
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>
    </body>
        <?php
                    }
        ?>
</html>