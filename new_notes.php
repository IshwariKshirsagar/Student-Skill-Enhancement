<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Notes</title>

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

    <div class="card-header">
        <div class="card-tools">
            <?php if ($_SESSION['login_user_type'] == 3): ?>
                <span class="badge badge-info">Buy Notes</span>
            <?php endif; ?>
        </div>
    </div>

    <div class="card card-outline card-success">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Notes Management</h4>
            <input type="text" id="searchInput" class="form-control form-control-sm w-25" placeholder="Search notes...">
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="notesTable">
                    <thead class="thead-light text-center">
                        <tr>
                            <th onclick="sortTable(0)">Notes ID</th>
                            <th onclick="sortTable(1)">Notes Name</th>
                            <th onclick="sortTable(2)">Owner</th>
                            <th onclick="sortTable(3)">Price (₹)</th>
                            <th onclick="sortTable(4)">Purchased By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

<?php
if ($_SESSION['login_user_type'] == 3) {
    // STUDENT → show only NOT purchased notes
    $qry = $conn->query("
        SELECT 
            n.notes_id,
            n.notes_name,
            n.notes_price,
            u.name AS owner_name,
            COUNT(snr_all.student_id) AS total_purchased
        FROM notes n
        JOIN users_database u ON n.notes_owner_id = u.user_id
        LEFT JOIN studentnotesregistered snr_user
            ON snr_user.notes_id = n.notes_id
            AND snr_user.student_id = " . (int)$_SESSION['login_user_id'] . "
        LEFT JOIN studentnotesregistered snr_all
            ON snr_all.notes_id = n.notes_id
        WHERE snr_user.student_id IS NULL
        GROUP BY n.notes_id
    ");
} else {
    // ADMIN / OWNER → show all notes
    $qry = $conn->query("
        SELECT 
            n.notes_id,
            n.notes_name,
            n.notes_price,
            u.name AS owner_name,
            COUNT(snr.student_id) AS total_purchased
        FROM notes n
        JOIN users_database u ON n.notes_owner_id = u.user_id
        LEFT JOIN studentnotesregistered snr ON snr.notes_id = n.notes_id
        GROUP BY n.notes_id
    ");
}

while ($row = $qry->fetch_assoc()):
?>

<tr class="text-center">
    <td><?php echo $row['notes_id']; ?></td>
    <td><?php echo $row['notes_name']; ?></td>
    <td><?php echo $row['owner_name']; ?></td>
    <td><?php echo $row['notes_price']; ?></td>
    <td><?php echo $row['total_purchased']; ?> Peoples</td>
    <td>
        <?php if ($_SESSION['login_user_type'] == 3): ?>
            <button class="btn btn-sm btn-success enroll_notes"
                    data-notesid="<?php echo $row['notes_id']; ?>">
                Buy
            </button>
        <?php else: ?>
            <span class="text-muted">—</span>
        <?php endif; ?>
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
    $("#notesTable tbody tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
});

// ↕ Column Sorting
function sortTable(columnIndex) {
    const table = document.getElementById("notesTable");
    const tbody = table.tBodies[0];
    const rows = Array.from(tbody.rows);
    const asc = table.getAttribute("data-sort") !== "asc";

    rows.sort((a, b) => {
        let x = a.cells[columnIndex].innerText.trim();
        let y = b.cells[columnIndex].innerText.trim();
        if (!isNaN(x) && !isNaN(y)) return asc ? x - y : y - x;
        return asc ? x.localeCompare(y) : y.localeCompare(x);
    });

    rows.forEach(row => tbody.appendChild(row));
    table.setAttribute("data-sort", asc ? "asc" : "desc");
}

// 🛒 Buy Notes
$(document).on('click', '.enroll_notes', function () {
    const notesId = $(this).data('notesid');
    if (!confirm("Do you want to buy this notes?")) return;

    $.ajax({
        url: "enroll_notes.php",
        type: "POST",
        data: { notes_id: notesId },
        success: function (res) {
            res = res.trim();
            if (res === "1") {
                alert("Notes purchased successfully!");
                location.reload();
            } else if (res === "2") {
                alert("You already purchased this notes.");
            } else {
                alert("Purchase failed.");
            }
        }
    });
});
</script>

</body>
</html>
