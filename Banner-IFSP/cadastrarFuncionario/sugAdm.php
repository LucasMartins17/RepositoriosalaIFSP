<?php
// Incluir a configuração do banco de dados
require_once("conexao.php");

// Selecionar os dados da tabela sugestoes
$sql = "SELECT nome, email, conteudo, created_at, visible, id FROM sugestoes ORDER BY created_at DESC";
$result = $conn->query($sql);

$sugestoes = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $sugestoes[] = $row;
    }
} else {
    echo "Nenhuma sugestão encontrada.";
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituto Federal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <a href="index.php" class="header-left">
            <img src="assets/back.svg" alt="Back" class="back">
        </a>
        <h1 class="bodia">Bem-vindo, <span class="highlight">Adm!</span></h1>
        <div class="header-right">
            <img src="assets/ifsp_logo_itp.png" alt="Instituto Federal São Paulo" class="logo-if">
        </div>
    </header>
    <main>
        <h2>Você selecionou: <span>Sugestões</span></h2>
        <div class="reviews">
        <?php foreach ($sugestoes as $sugestao): ?>
    <div class="review <?php echo $sugestao['visible'] ? '' : 'hidden-review'; ?>" data-id="<?php echo $sugestao['id']; ?>">
        <div class="review-header">
            <img src="assets/user_icognite.svg" class="icon_review" alt="">
            <div class="review-info">
                <h3><?php echo htmlspecialchars($sugestao['nome']); ?></h3>
                <a class="a-sugestoes" href="mailto:<?php echo htmlspecialchars($sugestao['email']); ?>">
                    <?php echo htmlspecialchars($sugestao['email']); ?>
                </a>
                <p><?php echo date("d/m/Y", strtotime($sugestao['created_at'])); ?></p>
            </div>
            <div class="visibility-icon">
                <img src="assets/<?php echo $sugestao['visible'] ? 'visible' : 'invisible'; ?>.svg" alt="Ícone de Visibilidade">
            </div>
        </div>
        <p class="review-text">
            <?php echo htmlspecialchars($sugestao['conteudo']); ?>
        </p>
    </div>
<?php endforeach; ?>

        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.visibility-icon img').forEach(function(icon) {
                icon.addEventListener('click', function() {
                    const review = this.closest('.review');
                    const id = review.getAttribute('data-id');
                    const currentState = this.src.includes('visible.svg') ? 'visible' : 'hidden';
                    const newState = currentState === 'visible' ? 'hidden' : 'visible';
                    const imgSrc = `assets/${newState}.svg`;

                    fetch('sugestoes_visibility.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ id: id, newState: newState })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.src = imgSrc;
                            if (newState === 'hidden') {
                                review.classList.add('hidden-review');
                            } else {
                                review.classList.remove('hidden-review');
                            }
                        } else {
                            alert('Erro ao atualizar a visibilidade.');
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        alert('Erro ao atualizar a visibilidade.');
                    });
                });
            });
        });
    </script>
</body>
</html>
