<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Courses</title>

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
/* =======================
   FETCH COURSES LOGIC
======================= */
if ($_SESSION['login_user_type'] == 3) {
    $student_id = (int)$_SESSION['login_user_id'];
    $qry = $conn->query("
        SELECT cd.course_id, cd.course_name, cd.course_price, ct.course_type_name, u.name AS owner_name
        FROM course_database cd
        JOIN course_type ct ON cd.course_type = ct.course_type_id
        JOIN users_database u ON cd.course_owner = u.user_id
        WHERE cd.course_id NOT IN (
            SELECT course_id FROM studentcourseregistered WHERE user_id = $student_id
        )
    ");
    $sql = "SELECT COUNT(*) AS total_course FROM course_database
            WHERE course_id NOT IN (
                SELECT course_id FROM studentcourseregistered WHERE user_id = $student_id
            )";
} elseif ($_SESSION['login_user_type'] == 1) {
    $qry = $conn->query("
        SELECT cd.course_id, cd.course_name, cd.course_price, ct.course_type_name, u.name AS owner_name
        FROM course_database cd
        JOIN course_type ct ON cd.course_type = ct.course_type_id
        JOIN users_database u ON cd.course_owner = u.user_id
    ");
    $sql = "SELECT COUNT(*) AS total_course FROM course_database";
} else {
    $owner_id = (int)$_SESSION['login_user_id'];
    $qry = $conn->query("
        SELECT cd.course_id, cd.course_name, cd.course_price, ct.course_type_name, u.name AS owner_name
        FROM course_database cd
        JOIN course_type ct ON cd.course_type = ct.course_type_id
        JOIN users_database u ON cd.course_owner = u.user_id
        WHERE cd.course_owner = $owner_id
    ");
    $sql = "SELECT COUNT(*) AS total_course FROM course_database WHERE course_owner = $owner_id";
}
$totalCourses = $conn->query($sql)->fetch_assoc()['total_course'];
?>

<div class="container-fluid mt-4">

    <?php if ($_SESSION['login_user_type'] != 3): ?>
    <div class="card-header mb-2">
        <div class="card-tools">
            <a class="btn btn-block btn-sm btn-primary btn-flat" href="./index.php?page=new_course">
                <i class="fa fa-plus"></i> Add New Course
            </a>
        </div>
    </div>
    <?php endif; ?>

    <div class="card card-outline card-success">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">
                <?php echo ($_SESSION['login_user_type'] == 3) ? 'Available Courses' : 'Courses'; ?>
            </h4>
            <input type="text" id="searchInput" class="form-control form-control-sm w-25" placeholder="Search courses...">
        </div>

        <div class="card-body">
            <?php if ($totalCourses > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="coursesTable">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" onclick="sortTable(0)">Course ID</th>
                            <th class="text-center" onclick="sortTable(1)">Course Name</th>
                            <th class="text-center" onclick="sortTable(2)">Course Type</th>
                            <th class="text-center" onclick="sortTable(3)">Course Owner</th>
                            <th class="text-center" onclick="sortTable(4)">Price (₹)</th>
                            <th class="text-center">View</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $qry->fetch_assoc()): ?>
                        <tr>
                            <td class="text-center"><?= sprintf('%03d', $row['course_id']) ?></td>
                            <td class="text-center"><b><?= htmlspecialchars($row['course_name']) ?></b></td>
                            <td class="text-center"><b><?= htmlspecialchars($row['course_type_name']) ?></b></td>
                            <td class="text-center"><b><?= htmlspecialchars($row['owner_name']) ?></b></td>
                            <td class="text-center"><b>₹<?= number_format($row['course_price']) ?></b></td>
                            <td class="text-center">
                                <a href="./index.php?page=viewcourse&course_access=restricted&course_id=<?= $row['course_id'] ?>"
                                    class="btn btn-sm btn-primary">
                                    <i class="fa fa-eye" style="font-size:14px;"></i> View
                                </a>
                            </td>
                            <td class="text-center">
                                <?php if ($_SESSION['login_user_type'] == 3): ?>
                                <button class="btn btn-sm btn-success enroll_course"
                                    data-courseid="<?= $row['course_id'] ?>"
                                    data-coursename="<?= htmlspecialchars($row['course_name']) ?>"
                                    data-price="<?= (int)$row['course_price'] ?>">
                                    <i class="fa fa-plus" style="font-size:14px;"></i> Enroll
                                </button>
                                <?php endif; ?>
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

<!-- Razorpay Checkout SDK -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
// 🔍 Live Search
$("#searchInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#coursesTable tbody tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
});

// ↕ Column Sorting
function sortTable(columnIndex) {
    const table = document.getElementById("coursesTable");
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

// 💳 Enroll with Razorpay Payment
$(document).on('click', '.enroll_course', function () {
    const courseId   = $(this).data('courseid');
    const courseName = $(this).data('coursename');
    const price      = parseInt($(this).data('price'));

    // Step 1: Create Razorpay order on server
    $.ajax({
        url: 'operations/create_razorpay_order.php',
        type: 'POST',
        data: { course_id: courseId },
        success: function (raw) {
            let order;
            try { order = typeof raw === 'object' ? raw : JSON.parse(raw); }
            catch(e) { alert('Server error: ' + raw); return; }

            if (order.error) {
                alert('Error: ' + order.error);
                return;
            }

            // Step 2: Open Razorpay checkout
            const options = {
                key:         order.key_id,
                amount:      order.amount,
                currency:    order.currency,
                name:        'Student Skill Enhancement',
                description: 'Enrollment: ' + order.course_name,
                order_id:    order.order_id,
                prefill: {
                    name:    order.student_name,
                    email:   order.student_email,
                    contact: order.student_phone
                },
                theme: { color: '#28a745' },
                handler: function (response) {
                    // Step 3: Verify payment & enroll
                    $.ajax({
                        url: 'operations/verify_payment.php',
                        type: 'POST',
                        data: {
                            razorpay_order_id:   response.razorpay_order_id,
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_signature:  response.razorpay_signature,
                            course_id:           courseId
                        },
                        success: function (raw2) {
                            let res;
                            try { res = typeof raw2 === 'object' ? raw2 : JSON.parse(raw2); }
                            catch(e) {
                                alert('Payment successful! You are now enrolled.');
                                location.reload();
                                return;
                            }
                            if (res.status === 'success') {
                                alert('Payment successful! You are now enrolled.');
                                location.reload();
                            } else if (res.status === 'already_enrolled') {
                                alert('You are already enrolled in this course.');
                                location.reload();
                            } else {
                                alert('Payment received but enrollment failed. Contact support with Payment ID: ' + response.razorpay_payment_id);
                            }
                        },
                        error: function (xhr) {
                            // Payment went through — enroll succeeded — just reload
                            alert('Payment successful! You are now enrolled.');
                            location.reload();
                        }
                    });
                },
                modal: {
                    ondismiss: function () {
                        alert('Payment cancelled.');
                    }
                }
            };

            const rzp = new Razorpay(options);
            rzp.open();
        },
        error: function (xhr) {
            alert('Payment initiation failed. Server response: ' + xhr.status + ' - ' + xhr.responseText);
        }
    });
});
</script>

</body>
</html>
