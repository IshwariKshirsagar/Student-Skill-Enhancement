<!DOCTYPE html>
<html>
<head>
    <title>Enrolled Courses</title>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        #searchInput {
            border: 1px solid #666;
            border-radius: 4px;
            padding: 6px 10px;
        }
        #searchInput:focus {
            border-color: #000;
            box-shadow: none;
            outline: none;
        }
    </style>
</head>
<body>

<?php
if ($_SESSION['login_user_type'] == 1) {
    $qry = $conn->query("
        SELECT cd.course_id, cd.course_name, ct.course_type_name, u.name AS owner_name
        FROM course_database cd
        JOIN course_type ct ON cd.course_type = ct.course_type_id
        JOIN users_database u ON cd.course_owner = u.user_id
    ");
    $sql = "SELECT COUNT(*) AS total_course FROM course_database cd
            JOIN course_type ct ON cd.course_type = ct.course_type_id
            JOIN users_database u ON cd.course_owner = u.user_id";
} elseif ($_SESSION['login_user_type'] == 2) {
    $owner_id = (int)$_SESSION['login_user_id'];
    $qry = $conn->query("
        SELECT cd.course_id, cd.course_name, ct.course_type_name, u.name AS owner_name
        FROM course_database cd
        JOIN course_type ct ON cd.course_type = ct.course_type_id
        JOIN users_database u ON cd.course_owner = u.user_id
        WHERE cd.course_owner = $owner_id
    ");
    $sql = "SELECT COUNT(*) AS total_course FROM course_database cd
            JOIN course_type ct ON cd.course_type = ct.course_type_id
            JOIN users_database u ON cd.course_owner = u.user_id
            WHERE cd.course_owner = $owner_id";
} elseif ($_SESSION['login_user_type'] == 3) {
    $userId = (int)$_SESSION['login_user_id'];
    $qry = $conn->query("
        SELECT DISTINCT cd.course_id, cd.course_name, ct.course_type_name, u.name AS owner_name
        FROM studentcourseregistered scr
        JOIN course_database cd ON scr.course_id = cd.course_id
        JOIN course_type ct ON cd.course_type = ct.course_type_id
        JOIN users_database u ON cd.course_owner = u.user_id
        WHERE scr.user_id = $userId
    ");
    $sql = "SELECT COUNT(DISTINCT cd.course_id) AS total_course
            FROM studentcourseregistered scr
            JOIN course_database cd ON scr.course_id = cd.course_id
            JOIN course_type ct ON cd.course_type = ct.course_type_id
            JOIN users_database u ON cd.course_owner = u.user_id
            WHERE scr.user_id = $userId";
}
$totalCourses = $conn->query($sql)->fetch_assoc()['total_course'];
?>

<div class="container-fluid mt-4">
    <div class="card card-outline card-success">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">
                <?php echo ($_SESSION['login_user_type'] == 3) ? 'My Enrolled Courses' : 'All Courses'; ?>
            </h4>
            <input type="text" id="searchInput" class="form-control form-control-sm w-25" placeholder="Search courses...">
        </div>

        <div class="card-body">
            <?php if ($totalCourses > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="enrolledTable">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" onclick="sortTable(0)">Course ID</th>
                            <th class="text-center" onclick="sortTable(1)">Course Name</th>
                            <th class="text-center" onclick="sortTable(2)">Course Type</th>
                            <th class="text-center" onclick="sortTable(3)">Course Owner</th>
                            <th class="text-center">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $qry->fetch_assoc()): ?>
                        <tr>
                            <td class="text-center"><?= sprintf('%03d', $row['course_id']) ?></td>
                            <td class="text-center"><b><?= htmlspecialchars($row['course_name']) ?></b></td>
                            <td class="text-center"><b><?= htmlspecialchars($row['course_type_name']) ?></b></td>
                            <td class="text-center"><b><?= htmlspecialchars($row['owner_name']) ?></b></td>
                            <td class="text-center">
                                <a href="./index.php?page=viewcourse&course_access=allowed&course_id=<?= $row['course_id'] ?>"
                                    class="btn btn-sm btn-primary">
                                    <i class="fa fa-eye" style="font-size:14px;"></i> View
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="text-center py-3">
                <h6 class="text-muted">No Courses found</h6>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// 🔍 Live Search
$("#searchInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#enrolledTable tbody tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
});

// ↕ Column Sorting
function sortTable(columnIndex) {
    const table = document.getElementById("enrolledTable");
    const tbody = table.tBodies[0];
    const rows = Array.from(tbody.rows);
    const asc = table.getAttribute("data-sort") !== "asc";

    rows.sort((a, b) => {
        let x = a.cells[columnIndex].innerText.trim();
        let y = b.cells[columnIndex].innerText.trim();

        if (!isNaN(x) && !isNaN(y)) {
            return asc ? x - y : y - x;
        }
        return asc ? x.localeCompare(y) : y.localeCompare(x);
    });

    rows.forEach(row => tbody.appendChild(row));
    table.setAttribute("data-sort", asc ? "asc" : "desc");
}
</script>

</body>
</html>
