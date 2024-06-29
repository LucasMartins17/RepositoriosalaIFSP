<?php
require_once("conexao.php");

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$newState = $data['newState'] === 'visible' ? 1 : 0;

$sql = "UPDATE criticas SET visible = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $newState, $id);

$response = ['success' => false];

if ($stmt->execute()) {
    $response['success'] = true;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>
