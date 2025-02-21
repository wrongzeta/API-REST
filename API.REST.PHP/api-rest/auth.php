<?php
require_once('../includes/User.class.php');
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($input['email']) && isset($input['password'])) {
    $token = User::authenticate($input['email'], $input['password']);
    if ($token) {
        echo json_encode(['token' => $token]);
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
    }
}
?>