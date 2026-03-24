<?php
error_reporting(0);
ini_set('display_errors', 0);
if (session_status() === PHP_SESSION_NONE) session_start();
include '../db_connect.php';
include '../razorpay_config.php';

header('Content-Type: application/json');

// Only students
if (!isset($_SESSION['login_user_id']) || $_SESSION['login_user_type'] != 3) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$razorpay_order_id   = $_POST['razorpay_order_id']   ?? '';
$razorpay_payment_id = $_POST['razorpay_payment_id'] ?? '';
$razorpay_signature  = $_POST['razorpay_signature']  ?? '';
$course_id           = isset($_POST['course_id']) ? (int)$_POST['course_id'] : 0;

if (!$razorpay_order_id || !$razorpay_payment_id || !$razorpay_signature || $course_id <= 0) {
    echo json_encode(['status' => 'failed', 'message' => 'Missing payment data']);
    exit;
}

// Verify Razorpay signature
$generated_signature = hash_hmac(
    'sha256',
    $razorpay_order_id . '|' . $razorpay_payment_id,
    RAZORPAY_KEY_SECRET
);

if ($generated_signature !== $razorpay_signature) {
    echo json_encode(['status' => 'failed', 'message' => 'Payment verification failed. Signature mismatch.']);
    exit;
}

// Signature valid — enroll the student
$user_id = (int)$_SESSION['login_user_id'];

// Check already enrolled
$check = $conn->query("
    SELECT id FROM studentcourseregistered
    WHERE user_id = $user_id AND course_id = $course_id
");

if ($check->num_rows > 0) {
    echo json_encode(['status' => 'already_enrolled']);
    exit;
}

$insert = $conn->query("
    INSERT INTO studentcourseregistered (course_id, user_id)
    VALUES ($course_id, $user_id)
");

if ($insert) {
    echo json_encode([
        'status'     => 'success',
        'payment_id' => $razorpay_payment_id
    ]);
} else {
    echo json_encode([
        'status'     => 'failed',
        'message'    => 'Enrollment failed after payment. Contact support.',
        'payment_id' => $razorpay_payment_id
    ]);
}
