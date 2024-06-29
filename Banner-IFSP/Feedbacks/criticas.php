<?php
// Incluir a configuração do banco de dados
require_once("config.php");

// Selecionar os dados da tabela 
$sql = "SELECT conteudo, created_at FROM criticas WHERE visible = TRUE ORDER BY created_at DESC";
$result = $conn->query($sql);

$criticas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $criticas[] = $row;
    }
} else {
    echo "Nenhuma critica encontrada.";
}
$conn->close();
include 'header.php';
?>
    <div class="container_criticas">
        <h1 class="criticas_h1">Críticas</h1>
        <a href="criticas_user.html"><button class="add-review-button">Adicionar critica</button></a>
        <div class="reviews">
            <?php
            foreach ($criticas as $critica) {

                echo '<div class="review">';
                echo '    <div class="review-header">';
                echo '        <div class="user_name">';
                echo '            <img src="assets/user_icognite.svg" alt="user" class="user-icon">';
                echo '        </div>';
                echo '        <span class="date">' . date('d/m/Y', strtotime($critica['created_at'])) . '</span>';
                echo '    </div>';
                echo '    <p class="texto">' . htmlspecialchars($critica['conteudo']) . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>
