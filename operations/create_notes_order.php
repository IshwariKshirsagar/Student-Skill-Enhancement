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

$notes_id = isset($_POST['notes_id']) ? (int)$_POST['notes_id'] : 0;
if ($notes_id <= 0) {
    echo json_encode(['error' => 'Invalid notes']);
    exit;
}

$result = $conn->query("SELECT notes_name, notes_price FROM notes WHERE notes_id = $notes_id");
if ($result->num_rows === 0) {
    echo json_encode(['error' => 'Notes not found']);
    exit;
}
$notes  = $result->fetch_assoc();
$amount = (int)$notes['notes_price'] * 100;

$orderData = [
    'receipt'         => 'notes_' . $notes_id . '_' . time(),
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
    'notes_name'    => $notes['notes_name'],
    'key_id'        => RAZORPAY_KEY_ID,
    'student_name'  => $_SESSION['login_name'],
    'student_email' => $_SESSION['login_email'],
    'student_phone' => $_SESSION['login_phone_number'] ?? ''
]);
