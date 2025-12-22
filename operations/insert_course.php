<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $course_name  = trim($_POST['course_name'] ?? '');
    $course_type  = (int) ($_POST['course_type'] ?? 0);
    $course_owner = (int) ($_POST['course_owner'] ?? 0);

    // Validation
    if ($course_name === '' || $course_type <= 0 || $course_owner <= 0) {
        echo "All fields are required";
        exit;
    }

    // Insert using prepared statement
    $stmt = $conn->prepare(
        "INSERT INTO course_database (course_name, course_type, course_owner)
         VALUES (?, ?, ?)"
    );

    $stmt->bind_param("sii", $course_name, $course_type, $course_owner);

    if ($stmt->execute()) {
        echo 1;
    } else {
        echo "Database error";
    }

    $stmt->close();
    $conn->close();
}
?>
