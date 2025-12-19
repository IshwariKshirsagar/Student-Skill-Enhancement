<?php 
    include 'db_connect.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Manage Users</title>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

    <!-- Font Awesome (Using CDN instead of kit) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Bootstrap CSS (Optional for better styling) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
</head>

<body>

    <div class="col-lg-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <div class="card-tools">
                    <a class="btn btn-block btn-sm btn-primary btn-flat" href="./index.php?page=course">
                        <i class="fa fa-arrow-left"></i> Go Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <?php
                            $i = 1;
                            $course_id = isset($_GET['course_id']) ? $_GET['course_id'] : 0;
                            $type = array('', "Admin", "Course Owner", "Student");

                            $count_qry = $conn->query("
                                SELECT COUNT(*) AS total_students
                                FROM studentcourseregistered
                                WHERE course_id = $course_id
                            ");

                            $count_row = $count_qry->fetch_assoc();
                            $total_students = $count_row['total_students'];
                            
                            $qry = $conn->query("
                                SELECT u.*, scr.course_id
                                FROM users_database u
                                INNER JOIN studentcourseregistered scr 
                                    ON scr.user_id = u.user_id
                                    WHERE scr.course_id = $course_id
                                
                            ");
                            ?>
                    <?php if($total_students > 0): ?>
                        <table class="table table-hover table-bordered" id="sortableTable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" onclick="sortTable(0)">#</th>
                                    <th onclick="sortTable(1)">Name</th>
                                    <th onclick="sortTable(2)">Email</th>
                                    <th onclick="sortTable(3)">Phone Number</th>
                                    <th onclick="sortTable(4)">Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $qry->fetch_assoc()): ?>
                                <tr>
                                    <th class="text-center"><?php echo $i++ ?></th>
                                    <td><b><?php echo ucwords($row['name']) ?></b></td>
                                    <td><b><?php echo $row['email'] ?></b></td>
                                    <td><b><?php echo $row['phone_number'] ?></b></td>
                                    <td><b><?php echo $type[$row['user_type']] ?></b></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger remove_user"
                                            data-id="<?php echo $row['user_id'] ?>"
                                            data-courseid="<?php echo $row['course_id'] ?>">
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php endif;?>
                    <?php if($total_students <= 0): ?>
                        <div class="card-body p-3">
                            <div class="text-center">
                                <h6 class="text-muted">No Students found</h6>
                            </div>
                        </div>
                    <?php endif;?>

                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $(document).on('click', '.remove_user', function() {
            var userId = $(this).data('id');
            var courseid = $(this).data('courseid');

            if (confirm("Are you sure you want to remove this user?")) {
                remove_user(userId, courseid);
            }
        });
    });

    function remove_user(userId, courseid) {
        $.ajax({
            url: 'remove_user.php',
            method: 'POST',
            data: {
                id: userId,
                courseid: courseid
            },
            success: function(resp) {
                if (resp == 1) {
                    alert("User successfully removed.");
                    location.reload();
                } else {
                    alert("Failed to remove user.");
                }
            },
            error: function() {
                alert("AJAX error occurred.");
            }
        });
    }

    function sortTable(columnIndex) {
        const table = document.getElementById("sortableTable");
        const rows = Array.from(table.rows).slice(1);
        const isAscending = table.getAttribute(`data-sort-${columnIndex}`) !== "asc";

        rows.sort((a, b) => {
            const cellA = a.cells[columnIndex].innerText.trim().toLowerCase();
            const cellB = b.cells[columnIndex].innerText.trim().toLowerCase();
            if (cellA < cellB) return isAscending ? -1 : 1;
            if (cellA > cellB) return isAscending ? 1 : -1;
            return 0;
        });

        rows.forEach(row => table.tBodies[0].appendChild(row));
        table.setAttribute(`data-sort-${columnIndex}`, isAscending ? "asc" : "desc");
    }
    </script>

</body>

</html>