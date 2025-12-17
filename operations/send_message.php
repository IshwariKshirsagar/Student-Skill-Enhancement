<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$conn = new mysqli("localhost", "root", "", "StudentSkillEnhancement");
if ($conn->connect_error) {
    http_response_code(500);
    exit;
}

if (!isset($_SESSION['login_user_id'])) {
    http_response_code(401);
    exit;
}

$user_id = $_SESSION['login_user_id'];
$message = trim($_POST['message'] ?? '');

if ($message === '') {
    exit;
}

$stmt = $conn->prepare("INSERT INTO chat (user_id, message) VALUES (?, ?)");
$stmt->bind_param("is", $user_id, $message);
$stmt->execute();

$stmt->close();
$conn->close();

echo "OK";
