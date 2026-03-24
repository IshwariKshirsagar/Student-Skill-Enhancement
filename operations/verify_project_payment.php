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

$razorpay_order_id   = $_POST['razorpay_order_id']   ?? '';
$razorpay_payment_id = $_POST['razorpay_payment_id'] ?? '';
$razorpay_signature  = $_POST['razorpay_signature']  ?? '';
$project_id          = isset($_POST['project_id']) ? (int)$_POST['project_id'] : 0;

if (!$razorpay_order_id || !$razorpay_payment_id || !$razorpay_signature || $project_id <= 0) {
    echo json_encode(['status' => 'failed', 'message' => 'Missing payment data']);
    exit;
}

$generated_signature = hash_hmac(
    'sha256',
    $razorpay_order_id . '|' . $razorpay_payment_id,
    RAZORPAY_KEY_SECRET
);

if ($generated_signature !== $razorpay_signature) {
    echo json_encode(['status' => 'failed', 'message' => 'Payment verification failed. Signature mismatch.']);
    exit;
}

$student_id = (int)$_SESSION['login_user_id'];

$check = $conn->query("
    SELECT id FROM studentprojectregistered
    WHERE project_id = $project_id AND student_id = $student_id
");

if ($check->num_rows > 0) {
    // Already purchased — just return the download link
    $proj = $conn->query("SELECT project_link FROM project WHERE project_id = $project_id")->fetch_assoc();
    echo json_encode(['status' => 'already_purchased', 'project_link' => $proj['project_link']]);
    exit;
}

$insert = $conn->query("
    INSERT INTO studentprojectregistered (project_id, student_id)
    VALUES ($project_id, $student_id)
");

if ($insert) {
    $proj = $conn->query("SELECT project_link FROM project WHERE project_id = $project_id")->fetch_assoc();
    echo json_encode([
        'status'       => 'success',
        'payment_id'   => $razorpay_payment_id,
        'project_link' => $proj['project_link']
    ]);
} else {
    echo json_encode([
        'status'     => 'failed',
        'message'    => 'Purchase failed after payment. Contact support.',
        'payment_id' => $razorpay_payment_id
    ]);
}
