<?php
// Direct access blocked — use operations/verify_notes_payment.php
http_response_code(403);
exit;

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

echo $insert ? 1 :0;
