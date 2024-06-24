<?php
require_once("conexao.php");

// Recebe os dados da requisição AJAX
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$newState = $data['newState'] === 'visible' ? 1 : 0;

// Atualiza o campo 'visible' no banco de dados
$stmt = $conn->prepare("UPDATE feedback SET visible = ? WHERE id = ?");
$stmt->bind_param("ii", $newState, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$stmt->close();
$conn->close();
?>
