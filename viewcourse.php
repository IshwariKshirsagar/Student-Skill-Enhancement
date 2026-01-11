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

#videoTable th,
#videoTable td {
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

            <!-- SEARCH + FILTER -->
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

                <!-- WATCHED VIDEOS -->
                <?php for ($i = 1; $i <= 5; $i++): ?>
                <tr data-status="watched">
                    <td class="text-center"><?=$i?></td>
                    <td class="text-center">
                        <img src="https://img.youtube.com/vi/dQw4w9WgXcQ/default.jpg" width="120">
                    </td>
                    <td><b>Watched Video <?=$i?></b></td>
                    <td>Already completed video.</td>
                    <td class="text-center">
                        <span class="badge badge-watched">Watched</span>
                    </td>
                    <td class="text-center">
                        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank"
                           class="btn btn-sm btn-success">
                            View
                        </a>
                    </td>
                </tr>
                <?php endfor; ?>

                <!-- REMAINING VIDEOS -->
                <?php for ($i = 6; $i <= 10; $i++): ?>
                <tr data-status="remaining">
                    <td class="text-center"><?=$i?></td>
                    <td class="text-center">
                        <img src="https://img.youtube.com/vi/9bZkp7q19f0/default.jpg" width="120">
                    </td>
                    <td><b>Remaining Video <?=$i?></b></td>
                    <td>Pending to watch.</td>
                    <td class="text-center">
                        <span class="badge badge-remaining">Remaining</span>
                    </td>
                    <td class="text-center">
                        <a href="https://www.youtube.com/watch?v=9bZkp7q19f0" target="_blank"
                           class="btn btn-sm btn-primary">
                            Watch
                        </a>
                    </td>
                </tr>
                <?php endfor; ?>

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
