<?php
include 'db_connect.php';

$course_id = isset($_GET['course_id']) ? (int)$_GET['course_id'] : 0;

$qry = $conn->query("
    SELECT * 
    FROM course_videos 
    WHERE course_id = $course_id
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Course Videos</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<style>
#videoTable {
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
}
#videoTable th, #videoTable td {
    vertical-align: middle;
}
.badge-watched {
    background-color: #28a745;
}
.badge-remaining {
    background-color: #ffc107;
    color: #000;
}
</style>
</head>

<body class="bg-light">

<div class="container mt-4">

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Course Videos</h5>

        <div class="d-flex">
            <input type="text" id="videoSearch"
                   class="form-control form-control-sm mr-2"
                   placeholder="Search videos...">

            <select id="videoFilter" class="form-control form-control-sm">
                <option value="all">All Videos</option>
                <option value="watched">Watched Videos</option>
                <option value="remaining">Remaining Videos</option>
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
                    <th>Status</th>
                    <th>Watch</th>
                </tr>
            </thead>

            <tbody id="videoList">
            <?php
            $i = 1;
            if ($qry->num_rows > 0):
                while ($row = $qry->fetch_assoc()):
                    $statusText = $row['Status'] == 1 ? 'watched' : 'remaining';
            ?>
            <tr data-status="<?= $statusText ?>">
                <td class="text-center"><?= $i++ ?></td>

                <td class="text-center">
                    <img src="<?= htmlspecialchars($row['Thumbnail']) ?>" width="160">
                </td>

                <td><b><?= htmlspecialchars($row['VideoTitle']) ?></b></td>

                <td><?= htmlspecialchars($row['Description']) ?></td>

                <td class="text-center">
                    <?php if ($row['Status'] == 1): ?>
                        <span class="badge badge-watched">Watched</span>
                    <?php else: ?>
                        <span class="badge badge-remaining">Remaining</span>
                    <?php endif; ?>
                </td>

                <td class="text-center">
                    <a href="./index.php?page=playvideo&id=<?= $row['id'] ?>&course_id=<?= $course_id ?>"
                       class="btn btn-sm btn-primary">
                        View
                    </a>
                </td>
            </tr>
            <?php endwhile; else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        No videos found
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div>

<script>
function filterVideos() {
    let filter = document.getElementById("videoFilter").value;
    let search = document.getElementById("videoSearch").value.toLowerCase();
    let rows = document.querySelectorAll("#videoList tr");

    rows.forEach(row => {
        let status = row.getAttribute("data-status");
        let text = row.innerText.toLowerCase();

        let statusMatch = (filter === "all" || filter === status);
        let searchMatch = text.includes(search);

        row.style.display = (statusMatch && searchMatch) ? "" : "none";
    });
}

document.getElementById("videoFilter").addEventListener("change", filterVideos);
document.getElementById("videoSearch").addEventListener("keyup", filterVideos);
</script>

</body>
</html>
