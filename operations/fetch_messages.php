<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$conn = new mysqli("localhost", "root", "", "StudentSkillEnhancement");
if ($conn->connect_error) {
    die("Database connection failed");
}

if (!isset($_SESSION['login_user_id'])) {
    die("Not logged in");
}

$my_id = $_SESSION['login_user_id'];

/* GLOBAL Q&A CHAT */
$query = "
SELECT c.message, c.timestamp, c.user_id, u.name
FROM chat c
JOIN users_database u ON c.user_id = u.user_id
ORDER BY c.timestamp ASC
";

$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {

    $class = ($row['user_id'] == $my_id) ? "sent" : "received";

    echo "<div class='message $class'>";
    echo "<strong>" . htmlspecialchars($row['name']) . "</strong><br>";
    echo htmlspecialchars($row['message']);
    echo "<br><small>{$row['timestamp']}</small>";
    echo "</div>";
}

$conn->close();
?>
