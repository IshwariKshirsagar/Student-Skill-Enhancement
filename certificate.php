<?php
include 'db_connect.php';
session_start();

$user_id = $_SESSION['login_user_id'];
$course_id = $_GET['course_id'];

// Fetch student name
$user = $conn->query("SELECT name FROM users_database WHERE user_id = $user_id")->fetch_assoc();

// Fetch course name
$course = $conn->query("SELECT course_name FROM course_database WHERE course_id = $course_id")->fetch_assoc();

$student_name = $user['name'];
$course_name = $course['course_name'];

$date = date("F d, Y");
?>

<!DOCTYPE html>
<html>

<head>

    <title>Course Certificate</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <style>
    body {
        background: #f4f4f4;
        text-align: center;
    }

    .certificate {
        width: 900px;
        margin: auto;
        background: white;
        padding: 60px;
        border: 10px solid #0d6efd;
        border-radius: 15px;
    }

    .title {
        font-size: 40px;
        font-weight: bold;
    }

    .subtitle {
        font-size: 22px;
        margin-top: 20px;
    }

    .name {
        font-size: 35px;
        font-weight: bold;
        color: #0d6efd;
        margin: 20px 0;
    }

    .course {
        font-size: 25px;
        font-weight: bold;
    }

    .date {
        margin-top: 30px;
        font-size: 18px;
    }
    </style>

</head>

<body>

    <br>

    <div id="certificate" class="certificate">

        <div class="title">
            Certificate of Completion
        </div>

        <div class="subtitle">
            This certificate is proudly presented to
        </div>

        <div class="name">
            <?php echo $student_name; ?>
        </div>

        <div class="subtitle">
            for successfully completing the course
        </div>

        <div class="course">
            <?php echo $course_name; ?>
        </div>

        <div class="date">
            Date: <?php echo $date; ?>
        </div>

        <br><br>

        <div class="row">

            <div class="col">
                <hr>
                Instructor Signature
            </div>

            <div class="col">
                <hr>
                Authorized Signature
            </div>

        </div>

    </div>

    <br>

    <button onclick="downloadCertificate()" class="btn btn-success btn-lg">
        Download Certificate
    </button>

    <script>
    function downloadCertificate() {

        html2canvas(document.querySelector("#certificate")).then(canvas => {

            const imgData = canvas.toDataURL("image/png");

            const {
                jsPDF
            } = window.jspdf;

            const pdf = new jsPDF("landscape");

            pdf.addImage(imgData, 'PNG', 10, 10, 270, 150);

            pdf.save("course_certificate.pdf");

        });

    }
    </script>

</body>

</html>