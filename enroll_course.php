<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['login_user_id']) || $_SESSION['login_user_type'] != 3) {
    http_response_code(403);
    exit;
}

$user_id = (int) $_SESSION['login_user_id'];
$course_id = isset($_POST['course_id']) ? (int) $_POST['course_id'] : 0;

if ($course_id <= 0) {
    echo 0;
    exit;
}

/* Check already enrolled */
$check = $conn->query("
    SELECT id 
    FROM studentcourseregistered 
    WHERE user_id = $user_id AND course_id = $course_id
");

if ($check->num_rows > 0) {
    echo 2; // already enrolled
    exit;
}

/* Insert enrollment */
$insert = $conn->query("
    INSERT INTO studentcourseregistered (course_id, user_id)
    VALUES ($course_id, $user_id)
");

if ($insert) {
    echo 1; // success
} else {
    echo 0; // failure
}
