<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['login_user_id']) || $_SESSION['login_user_type'] != 3) {
    echo 0;
    exit;
}

if (!isset($_POST['notes_id'])) {
    echo 0;
    exit;
}

$notes_id   = (int)$_POST['notes_id'];
$student_id = (int)$_SESSION['login_user_id'];

// Check already purchased
$check = $conn->query("
    SELECT id FROM studentnotesregistered
    WHERE notes_id = $notes_id AND student_id = $student_id
");

if ($check->num_rows > 0) {
    echo 2; // already purchased
    exit;
}

// Insert purchase
$insert = $conn->query("
    INSERT INTO studentnotesregistered (notes_id, student_id)
    VALUES ($notes_id, $student_id)
");

echo $insert ? 1 : 0;
