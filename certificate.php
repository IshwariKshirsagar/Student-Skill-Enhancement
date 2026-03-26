<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include 'db_connect.php';

$user_id   = isset($_SESSION['login_user_id']) ? (int)$_SESSION['login_user_id'] : 0;
$course_id = isset($_GET['course_id']) ? (int)$_GET['course_id'] : 0;

if ($user_id <= 0 || $course_id <= 0) {
    die('<p style="font-family:sans-serif;padding:40px;text-align:center;">Invalid request. Please <a href="index.php">go back</a>.</p>');
}

$user   = $conn->query("SELECT name FROM users_database WHERE user_id = $user_id")->fetch_assoc();
$course = $conn->query("SELECT course_name FROM course_database WHERE course_id = $course_id")->fetch_assoc();

if (!$user || !$course) {
    die('<p style="font-family:sans-serif;padding:40px;text-align:center;">Data not found. Please <a href="index.php">go back</a>.</p>');
}

$student_name = strtoupper($user['name']);
$course_name  = $course['course_name'];
$date         = date("F d, Y");
$cert_id      = 'SSE-' . strtoupper(substr(md5($user_id . $course_id), 0, 8));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Certificate of Completion</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: #1a1a2e;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 30px 20px;
            font-family: 'Lato', sans-serif;
        }

        .cert-wrapper {
            position: relative;
            width: 900px;
            background: #fff;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0,0,0,0.5);
        }

        /* Outer gold border frame */
        .cert-wrapper::before {
            content: '';
            position: absolute;
            inset: 10px;
            border: 2px solid #c9a84c;
            border-radius: 2px;
            z-index: 2;
            pointer-events: none;
        }

        /* Inner thin border */
        .cert-wrapper::after {
            content: '';
            position: absolute;
            inset: 16px;
            border: 1px solid rgba(201,168,76,0.4);
            border-radius: 1px;
            z-index: 2;
            pointer-events: none;
        }

        /* Left green accent bar */
        .cert-left-bar {
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 8px;
            background: linear-gradient(180deg, #1a6b3c, #28a745, #1a6b3c);
        }

        /* Right green accent bar */
        .cert-right-bar {
            position: absolute;
            right: 0; top: 0; bottom: 0;
            width: 8px;
            background: linear-gradient(180deg, #1a6b3c, #28a745, #1a6b3c);
        }

        /* Corner ornaments */
        .corner {
            position: absolute;
            width: 60px;
            height: 60px;
            z-index: 3;
        }
        .corner-tl { top: 18px; left: 18px; border-top: 3px solid #c9a84c; border-left: 3px solid #c9a84c; }
        .corner-tr { top: 18px; right: 18px; border-top: 3px solid #c9a84c; border-right: 3px solid #c9a84c; }
        .corner-bl { bottom: 18px; left: 18px; border-bottom: 3px solid #c9a84c; border-left: 3px solid #c9a84c; }
        .corner-br { bottom: 18px; right: 18px; border-bottom: 3px solid #c9a84c; border-right: 3px solid #c9a84c; }

        /* Watermark */
        .watermark {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
            pointer-events: none;
        }
        .watermark span {
            font-family: 'Cinzel', serif;
            font-size: 110px;
            font-weight: 700;
            color: rgba(40,167,69,0.04);
            letter-spacing: 8px;
            transform: rotate(-30deg);
            white-space: nowrap;
        }

        /* Main content */
        .cert-content {
            position: relative;
            z-index: 5;
            padding: 50px 80px 44px;
            text-align: center;
        }

        /* Header row: logo left, org name right */
        .cert-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(201,168,76,0.35);
        }

        .cert-logo img {
            height: 64px;
            object-fit: contain;
        }

        .cert-org {
            text-align: right;
        }

        .cert-org .org-name {
            font-family: 'Cinzel', serif;
            font-size: 15px;
            font-weight: 700;
            color: #1a6b3c;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .cert-org .org-tagline {
            font-size: 11px;
            color: #888;
            letter-spacing: 1px;
            margin-top: 2px;
        }

        /* Title */
        .cert-title-label {
            font-size: 11px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: #c9a84c;
            margin-bottom: 6px;
        }

        .cert-title {
            font-family: 'Cinzel', serif;
            font-size: 36px;
            font-weight: 700;
            color: #1a1a2e;
            letter-spacing: 2px;
            line-height: 1.2;
            margin-bottom: 6px;
        }

        .cert-subtitle {
            font-size: 13px;
            color: #888;
            letter-spacing: 1px;
            margin-bottom: 28px;
        }

        /* Divider */
        .cert-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0 auto 24px;
            width: 60%;
        }
        .cert-divider::before,
        .cert-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, #c9a84c, transparent);
        }
        .cert-divider-diamond {
            width: 8px; height: 8px;
            background: #c9a84c;
            transform: rotate(45deg);
            flex-shrink: 0;
        }

        /* Presented to */
        .cert-presented {
            font-size: 13px;
            color: #666;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        /* Student name */
        .cert-name {
            font-family: 'Cinzel', serif;
            font-size: 42px;
            font-weight: 700;
            color: #1a6b3c;
            letter-spacing: 1px;
            margin-bottom: 6px;
            line-height: 1.1;
        }

        .cert-name-underline {
            width: 200px;
            height: 2px;
            background: linear-gradient(90deg, transparent, #c9a84c, transparent);
            margin: 0 auto 22px;
        }

        /* Body text */
        .cert-body {
            font-size: 14px;
            color: #555;
            line-height: 1.8;
            margin-bottom: 6px;
        }

        /* Course name */
        .cert-course {
            font-family: 'Cinzel', serif;
            font-size: 20px;
            font-weight: 700;
            color: #1a1a2e;
            margin: 8px 0 24px;
            padding: 10px 30px;
            border: 1px solid rgba(201,168,76,0.5);
            display: inline-block;
            background: rgba(201,168,76,0.05);
            border-radius: 2px;
            letter-spacing: 1px;
        }

        /* Footer row */
        .cert-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(201,168,76,0.35);
        }

        .cert-sig {
            text-align: center;
            flex: 1;
        }

        .cert-sig .sig-line {
            width: 140px;
            height: 1px;
            background: #333;
            margin: 0 auto 6px;
        }

        .cert-sig .sig-name {
            font-size: 12px;
            font-weight: 700;
            color: #333;
            letter-spacing: 0.5px;
        }

        .cert-sig .sig-title {
            font-size: 10px;
            color: #888;
            letter-spacing: 0.5px;
            margin-top: 2px;
        }

        .cert-seal {
            flex: 0 0 80px;
            text-align: center;
        }

        .cert-seal .seal-circle {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            border: 3px solid #c9a84c;
            background: linear-gradient(135deg, #1a6b3c, #28a745);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 0 0 2px rgba(201,168,76,0.3);
        }

        .cert-seal .seal-circle span {
            font-family: 'Cinzel', serif;
            font-size: 9px;
            color: #fff;
            font-weight: 700;
            letter-spacing: 1px;
            text-align: center;
            line-height: 1.3;
        }

        /* Meta info */
        .cert-meta {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 20px;
        }

        .cert-meta-item {
            text-align: center;
        }

        .cert-meta-item .meta-label {
            font-size: 9px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #aaa;
        }

        .cert-meta-item .meta-value {
            font-size: 12px;
            font-weight: 700;
            color: #444;
            margin-top: 2px;
        }

        /* Download button */
        .download-btn {
            margin-top: 28px;
            background: linear-gradient(135deg, #1a6b3c, #28a745);
            color: #fff;
            border: none;
            padding: 14px 40px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: 1px;
            box-shadow: 0 4px 20px rgba(40,167,69,0.4);
            transition: opacity 0.2s;
        }

        .download-btn:hover { opacity: 0.88; }
    </style>
</head>
<body>

<div class="cert-wrapper" id="certificate">

    <!-- Accent bars -->
    <div class="cert-left-bar"></div>
    <div class="cert-right-bar"></div>

    <!-- Corner ornaments -->
    <div class="corner corner-tl"></div>
    <div class="corner corner-tr"></div>
    <div class="corner corner-bl"></div>
    <div class="corner corner-br"></div>

    <!-- Watermark -->
    <div class="watermark"><span>CERTIFIED</span></div>

    <div class="cert-content">

        <!-- Header -->
        <div class="cert-header">
            <div class="cert-logo">
                <img src="assets/certificate_logo/Logo.png" alt="Logo">
            </div>
            <div class="cert-org">
                <div class="org-name">Student Skill Enhancement</div>
                <div class="org-tagline">Excellence in Education &amp; Training</div>
            </div>
        </div>

        <!-- Title -->
        <div class="cert-title-label">&#9670; Award of Achievement &#9670;</div>
        <div class="cert-title">Certificate of Completion</div>
        <div class="cert-subtitle">This certificate is proudly awarded to</div>

        <!-- Divider -->
        <div class="cert-divider"><div class="cert-divider-diamond"></div></div>

        <!-- Name -->
        <div class="cert-name"><?php echo htmlspecialchars($student_name); ?></div>
        <div class="cert-name-underline"></div>

        <!-- Body -->
        <div class="cert-body">
            for successfully completing the course
        </div>

        <!-- Course -->
        <div class="cert-course"><?php echo htmlspecialchars($course_name); ?></div>

        <!-- Meta -->
        <div class="cert-meta">
            <div class="cert-meta-item">
                <div class="meta-label">Issue Date</div>
                <div class="meta-value"><?php echo $date; ?></div>
            </div>
            <div class="cert-meta-item">
                <div class="meta-label">Certificate ID</div>
                <div class="meta-value"><?php echo $cert_id; ?></div>
            </div>
        </div>

        <!-- Footer signatures -->
        <div class="cert-footer">
            <div class="cert-sig">
                <div class="sig-line"></div>
                <div class="sig-name">Course Instructor</div>
                <div class="sig-title">Authorized Signature</div>
            </div>

            <div class="cert-seal">
                <div class="seal-circle">
                    <span>VERIFIED<br>&amp;<br>CERTIFIED</span>
                </div>
            </div>

            <div class="cert-sig">
                <div class="sig-line"></div>
                <div class="sig-name">Program Director</div>
                <div class="sig-title">Student Skill Enhancement</div>
            </div>
        </div>

    </div>
</div>

<button class="download-btn" onclick="downloadCertificate()">
    &#8595; Download Certificate (PDF)
</button>

<script>
function downloadCertificate() {
    const btn = document.querySelector('.download-btn');
    btn.textContent = 'Generating PDF...';
    btn.disabled = true;

    html2canvas(document.getElementById('certificate'), {
        scale: 2,
        useCORS: true,
        backgroundColor: '#ffffff'
    }).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF('landscape', 'mm', 'a4');
        const pdfW = pdf.internal.pageSize.getWidth();
        const pdfH = pdf.internal.pageSize.getHeight();
        pdf.addImage(imgData, 'PNG', 0, 0, pdfW, pdfH);
        pdf.save('Certificate_<?php echo preg_replace('/[^a-zA-Z0-9]/', '_', $course_name); ?>.pdf');
        btn.textContent = '✓ Downloaded';
        btn.disabled = false;
    });
}
</script>

</body>
</html>
