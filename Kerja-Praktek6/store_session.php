<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if ($data && isset($data['user'])) {
    $_SESSION['user'] = $data['user'];
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}
?>
