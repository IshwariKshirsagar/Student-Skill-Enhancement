<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Projects</title>

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

<div class="container-fluid mt-4"> 
    <div class="card card-outline card-success">     
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Projects Management</h4>
            <input type="text" id="searchInput" class="form-control form-control-sm w-25" placeholder="Search projects...">
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="projectsTable">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" onclick="sortTable(0)">Project ID</th>
                            <th class="text-center" onclick="sortTable(1)">Project Name</th>
                            <th class="text-center" onclick="sortTable(2)">Language</th>
                            <th class="text-center" onclick="sortTable(3)">Purchased By</th>
                            <th class="text-center" onclick="sortTable(4)">Price (₹)</th>
                            <th class="text-center">Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $qry = $conn->query("
                            SELECT 
                                p.project_id,
                                p.project_name,
                                p.project_language,
                                p.project_price,
                                p.project_link,
                                COUNT(spr.student_id) AS total_purchased
                            FROM project p
                            LEFT JOIN studentprojectregistered spr
                                ON spr.project_id = p.project_id
                            GROUP BY p.project_id
                        ");

                        while ($row = $qry->fetch_assoc()):
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $row['project_id']; ?></td>
                            <td class="text-center"><?php echo $row['project_name']; ?></td>
                            <td class="text-center"><?php echo $row['project_language']; ?></td>
                            <td class="text-center">
                                <?php echo $row['total_purchased']; ?> Peoples
                            </td>
                            <td class="text-center"><?php echo $row['project_price']; ?></td>
                            <td class="text-center">
                                <a href="../projects/<?php echo $row['project_link']; ?>" 
                                   class="btn btn-sm btn-success" 
                                   download>
                                    <i class="fa fa-download" style="font-size:16px;"></i> Download
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
// 🔍 Live Search
$("#searchInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#projectsTable tbody tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
});

// ↕ Column Sorting
function sortTable(columnIndex) {
    const table = document.getElementById("projectsTable");
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
