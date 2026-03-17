<?php
session_start();
include "db_connect.php";

if (!isset($_POST['course_id'])) {
    echo 0;
    exit;
}

$course_id = (int)$_POST['course_id'];
$user_id   = (int)$_SESSION['login_user_id'];
$user_type = (int)$_SESSION['login_user_type'];

/*
 user_type:
 1 = Admin
 2 = Course Owner
*/

// 🔐 Authorization
if ($user_type == 1) {
    // Admin can delete any course
    $sql = "DELETE FROM course_database WHERE course_id = ?";
} elseif ($user_type == 2) {
    // Course owner can delete ONLY own course
    $sql = "DELETE FROM course_database WHERE course_id = ? AND course_owner = ?";
} else {
    // Students cannot delete
    echo 2;
    exit;
}

$stmt = $conn->prepare($sql);

if ($user_type == 1) {
    $stmt->bind_param("i", $course_id);
} else {
    $stmt->bind_param("ii", $course_id, $user_id);
}

if ($stmt->execute()) {
    echo 1;
} else {
    echo 0;
}
