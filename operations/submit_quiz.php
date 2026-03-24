<?php
error_reporting(0);
ini_set('display_errors', 0);
if (session_status() === PHP_SESSION_NONE) session_start();
include '../db_connect.php';

header('Content-Type: application/json');

if (!isset($_SESSION['login_user_id']) || $_SESSION['login_user_type'] != 3) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$course_id = isset($_POST['course_id']) ? (int)$_POST['course_id'] : 0;
if ($course_id <= 0) {
    echo json_encode(['error' => 'Invalid course']);
    exit;
}

// Fetch all questions for this course to validate server-side
$result = $conn->query("SELECT id, correct_option FROM course_quiz WHERE course_id = $course_id");
$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[$row['id']] = strtoupper($row['correct_option']);
}

$total   = count($questions);
$correct = 0;

foreach ($questions as $qid => $correct_option) {
    $submitted = isset($_POST['q_' . $qid]) ? strtoupper(trim($_POST['q_' . $qid])) : '';
    if ($submitted === $correct_option) {
        $correct++;
    }
}

$passed = ($correct === $total);

// If passed, record it so student can skip quiz next time
if ($passed) {
    $student_id = (int)$_SESSION['login_user_id'];
    $conn->query("
        INSERT IGNORE INTO student_quiz_pass (student_id, course_id)
        VALUES ($student_id, $course_id)
    ");
}

echo json_encode([
    'passed' => $passed,
    'score'  => $correct,
    'total'  => $total
]);
