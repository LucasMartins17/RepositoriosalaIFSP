<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituto Federal - Armarios - gerar form</title>
    <link rel="stylesheet" href="styles/FormularioStyle.css">
    <!--Biblioteca para tranformar HTML em PDF-->
    
</head>
<body>
    <?php
        require "1header.php";
    ?>
    <div class="container">
        <div class="titulo">
            <h1>Formulario do aluno</h1>
        </div>
        <div class="Convert">
            <a href="formulario-locacao-armario.pdf" download="file:///F:/IFSP/4_sem/Eng.Soft/ProjetoIf-main/ProjetoIf-main/DocPDF/formulario-locacao-armario.pdf">
                <button id="Button-convert">
                    <img src="assets/download-direto.png" alt="download-img">
                    <p>Baixar em arquivo PDF</p>
                </button>
            </a>
        </div>
    </div>
</body>
</html>
