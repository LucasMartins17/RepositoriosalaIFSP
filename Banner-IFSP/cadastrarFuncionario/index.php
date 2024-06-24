<!DOCTYPE php>
<php lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fale Conosco - IFSP</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <a href="#" class="header-left">
                <img src="assets/back.svg" alt="Back" class="back">
            </a>
            <h1 class="bodia">Bem-vindo, <span class="highlight">Adm!</span></h1>
            <div class="header-right">
                <img src="assets/ifsp_logo_itp.png" alt="Instituto Federal São Paulo" class="logo-if">
            </div>
            
        </header>
        <main>
            
            <p class="select">Você selecionou: <span class="highlight">Fale Conosco</span></p>
            <div class="buttons">
                <button class="button" onclick="window.location.href='avalAdm.php';">Avaliações</button>
                <button class="button" onclick="window.location.href='criAdm.php';">Críticas</button>
                <button class="button" onclick="window.location.href='sugAdm.php';">Sugestões</button>
            </div>
        </main>
        <div class="botton">
            <img src="assets/exit.svg" class="exit" alt="Sair">
        </div>
    </div>
</body>
</php>