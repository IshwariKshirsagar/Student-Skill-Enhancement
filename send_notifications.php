<?php
include "db_connect.php";
?>

<!-- PAGE-SPECIFIC STYLES -->
<style>
/* Page wrapper (DO NOT style body) */
.send-email-page {
    width: 100%;
    min-height: calc(100vh - 120px); /* adjust if header height differs */
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px;
    box-sizing: border-box;
}

/* Email Card */
.email-container {
    background-color: #ffffff;
    border-radius: 14px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    width: 100%;
    max-width: 700px;
    padding: 30px;
}

/* Title */
.email-container h2 {
    text-align: center;
    font-weight: 700;
    margin-bottom: 25px;
    color: #333;
}

/* Form group */
.form-group {
    margin-bottom: 18px;
}

.form-group label {
    font-weight: 600;
    color: #555;
    margin-bottom: 6px;
    display: block;
}

/* Inputs */
.form-group select,
.form-group input,
.form-group textarea {
    width: 100%;
    padding: 12px 14px;
    font-size: 15px;
    border-radius: 8px;
    border: 2px solid #e0e0e0;
    transition: 0.3s ease;
}

.form-group textarea {
    resize: none;
    height: 140px;
}

/* Focus effect */
.form-group select:focus,
.form-group input:focus,
.form-group textarea:focus {
    border-color: #0ba270;
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(11, 162, 112, 0.2);
}

/* Button */
.form-group button {
    width: 100%;
    background-color: #0ba270;
    color: #fff;
    padding: 14px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    transition: 0.3s ease;
}

.form-group button:hover {
    background-color: #09915f;
}

/* Status message */
#status {
    text-align: center;
    font-weight: 600;
    margin-top: 10px;
}

/* Responsive */
@media (max-width: 768px) {
    .email-container {
        padding: 20px;
    }
}
</style>

<!-- PAGE CONTENT -->
<div class="send-email-page">
    <div class="email-container">

        <form id="email-form">
            <h2>Send Email</h2>

            <!-- Recipient -->
            <div class="form-group">
                <label>Select Recipient</label>
                <select name="recipient" id="recipient" required>
                    <?php
                    $sql = "SELECT email, name FROM users_database";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()):
                    ?>
                        <option value="<?= $row['email']; ?>">
                            <?= $row['name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Subject -->
            <div class="form-group">
                <label>Subject</label>
                <input type="text" id="subject" placeholder="Enter email subject" required>
            </div>

            <!-- Message -->
            <div class="form-group">
                <label>Message</label>
                <textarea id="message" placeholder="Enter your message" required></textarea>
            </div>

            <!-- Button -->
            <div class="form-group">
                <button type="button" onclick="sendEmail()">Send Email</button>
            </div>

            <!-- Status -->
            <div id="status"></div>
        </form>

    </div>
</div>

<!-- SCRIPT -->
<script>
function sendEmail() {
    const recipient = document.getElementById('recipient').value;
    const subject = document.getElementById('subject').value;
    const message = document.getElementById('message').value;
    const statusDiv = document.getElementById('status');

    statusDiv.innerHTML = '<span style="color:green;">Sending email...</span>';

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'send_email.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (xhr.status === 200) {
            statusDiv.innerHTML =
                '<span style="color:green;">' + xhr.responseText + '</span>';

            // Auto hide after 3 seconds
            setTimeout(() => {
                statusDiv.innerHTML = '';
            }, 3000);
        } else {
            statusDiv.innerHTML =
                '<span style="color:red;">Failed to send email.</span>';
        }
    };

    const data =
        'recipient=' + encodeURIComponent(recipient) +
        '&subject=' + encodeURIComponent(subject) +
        '&message=' + encodeURIComponent(message);

    xhr.send(data);
}
</script>
