<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituto Federal - Armarios - regras</title>
    <link rel="stylesheet" href="styles\StyleRegras.css">
</head>
<body>
    <?php
        require "1header.php";
    ?>
    <div class="container">
        <div class="titulo">
            <h1>REGRAS</h1>
            <p>Atenção as regras, caso tenha alguma duvida procure a CAE</p>
        </div>
        <div class="Convert">
            <a href="regras-locacao.pdf" download="file:///F:/IFSP/4_sem/Eng.Soft/ProjetoIf-main/ProjetoIf-main/DocPDF/regras-locacao.pdf">
                <button id="Button-convert">
                    <img src="assets/download-direto.png" alt="download-img">
                    <p>Baixar em arquivo PDF</p>
                </button>
            </a>
        </div>
        <div class="imagem-pdf">
            <img src="assets/regras.png" alt="Imagem-regras-de-locação-png">
        </div>
    </div>
</body>
</html>
