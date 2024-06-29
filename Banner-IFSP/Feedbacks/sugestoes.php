<?php
// Incluir a configuração do banco de dados
require_once("config.php");

// Selecionar os dados da tabela sugestoes
$sql = "SELECT nome, conteudo, created_at FROM sugestoes WHERE visible = TRUE ORDER BY created_at DESC";
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
include 'header.php';
?>
    <div class="container_criticas">
        <h1 class="criticas_h1">Sugestões</h1>
        <a href="sugestoes_user.html"><button class="add-review-button">Adicionar sugestão</button></a>
        <div class="reviews">
            <?php
            foreach ($sugestoes as $sugestao) {

                echo '<div class="review">';
                echo '    <div class="review-header">';
                echo '        <div class="user_name">';
                echo '            <img src="assets/user_icognite.svg" alt="user" class="user-icon">';
                echo '            <span class="nome_span">' . htmlspecialchars($sugestao['nome']) . '</span>';
                echo '        </div>';
                echo '        <span class="date">' . date('d/m/Y', strtotime($sugestao['created_at'])) . '</span>';
                echo '    </div>';
                echo '    <p class="texto">' . htmlspecialchars($sugestao['conteudo']) . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>
