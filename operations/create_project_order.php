<?php
error_reporting(0);
ini_set('display_errors', 0);
if (session_status() === PHP_SESSION_NONE) session_start();
include '../db_connect.php';
include '../razorpay_config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['login_user_id']) || $_SESSION['login_user_type'] != 3) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$project_id = isset($_POST['project_id']) ? (int)$_POST['project_id'] : 0;
if ($project_id <= 0) {
    echo json_encode(['error' => 'Invalid project']);
    exit;
}

$result = $conn->query("SELECT project_name, project_price FROM project WHERE project_id = $project_id");
if ($result->num_rows === 0) {
    echo json_encode(['error' => 'Project not found']);
    exit;
}
$project = $result->fetch_assoc();
$amount  = (int)$project['project_price'] * 100;

$orderData = [
    'receipt'         => 'project_' . $project_id . '_' . time(),
    'amount'          => $amount,
    'currency'        => 'INR',
    'payment_capture' => 1
];

$ch = curl_init('https://api.razorpay.com/v1/orders');
curl_setopt($ch, CURLOPT_USERPWD,        RAZORPAY_KEY_ID . ':' . RAZORPAY_KEY_SECRET);
curl_setopt($ch, CURLOPT_POST,           true);
curl_setopt($ch, CURLOPT_POSTFIELDS,     json_encode($orderData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER,     ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    echo json_encode(['error' => 'Failed to create Razorpay order. HTTP: ' . $httpCode]);
    exit;
}

$order = json_decode($response, true);

echo json_encode([
    'order_id'      => $order['id'],
    'amount'        => $order['amount'],
    'currency'      => $order['currency'],
    'project_name'  => $project['project_name'],
    'key_id'        => RAZORPAY_KEY_ID,
    'student_name'  => $_SESSION['login_name'],
    'student_email' => $_SESSION['login_email'],
    'student_phone' => $_SESSION['login_phone_number'] ?? ''
]);
