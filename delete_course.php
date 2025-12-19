<?php
session_start();
include 'db_connect.php';

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_id = $_POST['id'];
    
    // Security check: Only Admins or the course Organizer can delete courses
    if ($_SESSION['login_user_type'] != 1 && $_SESSION['login_user_type'] != 2) {
        echo 0; // Not authorized
        exit;
    }

    // Check if the course belongs to the organizer (if the user is an organizer)
    if ($_SESSION['login_user_type'] == 2) {
        $qry = $conn->query("SELECT * FROM course_database WHERE course_id = $course_id AND course_owner = ".$_SESSION['login_user_id']);
        if ($qry->num_rows == 0) {
            echo 0; // course not found or not authorized
            exit;
        }
    }

    // Delete query with prepared statement to prcourse SQL injection
    $stmt = $conn->prepare("DELETE FROM course_database WHERE course_id = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();

    // Check if the deletion was successful
    if ($stmt->affected_rows > 0) {
        echo 1; // Success
    } else {
        echo 0; // Error or course not found
    }
    $stmt->close();
    $conn->close();
} else {
    echo 0; // Invalid request
}
?>
