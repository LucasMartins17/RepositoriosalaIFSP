<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituto Federal - Feedback</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="#"><img class="back-button" src="assets/back-button.svg" alt="Voltar"></a>
        <img src="assets/ifsp_logo_itp.png" alt="Instituto Federal" class="logo">
    </header>
    <div class="container">
        <h1>Queremos ouvir <span>você!</span></h1>
        <div class="buttons">
            <a href="criticas.php">
                <button class="btn">
                    <img class="icon" src="assets/critica.svg" alt="Críticas">
                    Críticas
                </button>
            </a>
            <a href="sugestoes.php">
                <button class="btn">
                    <img class="icon" src="assets/sugestoes.svg" alt="Sugestões">
                    Sugestões
                </button>
            </a>
            <a href="contatos.php">
                <button class="btn">
                    <img class="icon" src="assets/contatos.svg" alt="Contatos">
                    Contatos
                </button>
            </a>
            <a href="avaliacoes.php">
                <button class="btn">
                    <img class="icon" src="assets/avaliacoes.svg" alt="Avaliações">
                    Avaliações
                </button>
            </a>
            <button class="btn" id="denuncia-btn">
                <img class="icon" src="assets/denuncia.svg" alt="Denúncias">
                Denúncias
            </button>
        </div>
    </div>
    <script>
        document.getElementById('denuncia-btn').addEventListener('click', function() {
            fetch('save_denuncia.php', { method: 'POST' })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    window.location.href = 'https://falabr.cgu.gov.br/web/home';
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
