<?php
include 'db_connect.php';

$course_id     = isset($_GET['course_id'])      ? (int)$_GET['course_id']              : 0;
$course_access = isset($_GET['course_access'])  ? $_GET['course_access']               : 'restricted';
$user_id       = isset($_SESSION['login_user_id'])   ? (int)$_SESSION['login_user_id'] : 0;
$user_type     = isset($_SESSION['login_user_type'])  ? (int)$_SESSION['login_user_type'] : 0;

// Show Status + Watch columns for all logged-in users
$show_actions = ($user_type == 1) || ($user_type == 2) || ($user_type == 3);

// Fetch all videos for this course
$qry = $conn->query("SELECT * FROM course_videos WHERE course_id = $course_id ORDER BY id ASC");
$total_videos = $qry->num_rows;

// Build watched video IDs set from student_video_watch table (per-student)
$watched_ids = [];
if ($user_id > 0) {
    $wRes = $conn->query("
        SELECT video_id FROM student_video_watch
        WHERE user_id = $user_id AND course_id = $course_id
    ");
    while ($w = $wRes->fetch_assoc()) {
        $watched_ids[] = (int)$w['video_id'];
    }
}
$watched_count = count($watched_ids);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Course Videos</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
#videoTable th, #videoTable td { vertical-align: middle; white-space: normal; word-wrap: break-word; }
.badge-watched   { background-color: #28a745; color: #fff; }
.badge-remaining { background-color: #ffc107; color: #000; }
.progress        { height: 8px; border-radius: 4px; }
</style>
</head>
<body class="bg-light">

<div class="container mt-4">

    <?php if ($course_access == "allowed"): ?>
    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap" style="gap:10px;">
        <a href="index.php?page=quiz&course_id=<?= $course_id ?>"
           class="btn btn-sm btn-success">
            <i class="fa fa-certificate mr-1"></i> Download Certificate
        </a>

        <?php if ($total_videos > 0): ?>
        <div style="min-width:220px;">
            <div class="d-flex justify-content-between mb-1">
                <small class="text-muted">Progress</small>
                <small class="font-weight-bold"><?= $watched_count ?> / <?= $total_videos ?> watched</small>
            </div>
            <div class="progress">
                <div class="progress-bar bg-success"
                     style="width:<?= $total_videos > 0 ? round(($watched_count / $total_videos) * 100) : 0 ?>%">
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Course Videos</h5>
            <div class="d-flex">
                <input type="text" id="videoSearch"
                       class="form-control form-control-sm mr-2"
                       placeholder="Search videos...">
                <select id="videoFilter" class="form-control form-control-sm">
                    <option value="all">All Videos</option>
                    <option value="watched">Watched</option>
                    <option value="remaining">Remaining</option>
                </select>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0" id="videoTable">
                <thead class="thead-light text-center">
                    <tr>
                        <th>#</th>
                        <th>Thumbnail</th>
                        <th>Video Title</th>
                        <th>Description</th>
                        <?php if ($show_actions): ?>
                        <th>Status</th>
                        <th>Watch</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody id="videoList">
                <?php
                $i = 1;
                if ($total_videos > 0):
                    $qry->data_seek(0);
                    while ($row = $qry->fetch_assoc()):
                        // Status based on student_video_watch table — record exists = watched
                        $is_watched = in_array((int)$row['id'], $watched_ids);
                        $statusText = $is_watched ? 'watched' : 'remaining';
                ?>
                <tr data-status="<?= $statusText ?>">
                    <td class="text-center"><?= $i++ ?></td>
                    <td class="text-center">
                        <img src="<?= htmlspecialchars($row['Thumbnail']) ?>" width="160" style="border-radius:4px;">
                    </td>
                    <td><b><?= htmlspecialchars($row['VideoTitle']) ?></b></td>
                    <td><?= htmlspecialchars($row['Description']) ?></td>
                    <?php if ($show_actions): ?>
                    <td class="text-center">
                        <?php if ($is_watched): ?>
                            <span class="badge badge-watched"><i class="fa fa-check mr-1"></i>Watched</span>
                        <?php else: ?>
                            <span class="badge badge-remaining">Remaining</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <a href="./index.php?page=playvideo&id=<?= $row['id'] ?>&course_id=<?= $course_id ?>"
                           class="btn btn-sm btn-primary">
                            <i class="fa fa-play mr-1"></i> Watch
                        </a>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endwhile; else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-3">No videos found</td>
                </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function filterVideos() {
    const filter = document.getElementById("videoFilter").value;
    const search = document.getElementById("videoSearch").value.toLowerCase();
    document.querySelectorAll("#videoList tr").forEach(row => {
        const statusMatch = (filter === "all" || filter === row.getAttribute("data-status"));
        const searchMatch = row.innerText.toLowerCase().includes(search);
        row.style.display = (statusMatch && searchMatch) ? "" : "none";
    });
}
document.getElementById("videoFilter").addEventListener("change", filterVideos);
document.getElementById("videoSearch").addEventListener("keyup",  filterVideos);
</script>

</body>
</html>
