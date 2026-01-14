<?php
include 'db_connect.php';

$video_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$course_id = isset($_GET['course_id']) ? (int)$_GET['course_id'] : 0;

$qry = $conn->query("
    SELECT * 
    FROM course_videos 
    WHERE id = $video_id
");

if ($qry->num_rows == 0) {
    die("Video not found");
}

$video = $qry->fetch_assoc();

/* OPTIONAL: Mark video as watched */
$conn->query("UPDATE course_videos SET Status = 1 WHERE id = $video_id");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($video['VideoTitle']) ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
    .video-box {
        background: #fff;
        border-radius: 10px;
        padding: 15px;
    }
    </style>
</head>

<body class="bg-light">

    <div class="container mt-4">

        <a href="./index.php?page=viewcourse&course_id=<?= $course_id ?>" class="btn btn-sm btn-secondary mb-3">
            ← Back to Videos
        </a>

        <div class="video-box">

            <h4><?= htmlspecialchars($video['VideoTitle']) ?></h4>
            <p class="text-muted"><?= htmlspecialchars($video['Description']) ?></p>

            <div class="embed-responsive embed-responsive-16by9">
                <?php if (!empty($video['video'])): ?>
                <!-- Uploaded video -->
                <video controls class="embed-responsive-item">
                    <source src="<?= $video['video'] ?>" type="video/mp4">
                    Your browser does not support video playback.
                </video>
                <?php else: ?>
                <!-- YouTube fallback -->
                <iframe class="embed-responsive-item"
                    src="https://www.youtube.com/embed/<?= basename($video['Thumbnail'], '.jpg') ?>"
                    allowfullscreen></iframe>
                <?php endif; ?>
            </div>

        </div>

    </div>

</body>

</html>