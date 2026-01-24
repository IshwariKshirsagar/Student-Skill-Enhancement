<?php
include 'db_connect.php';
?>

<style>
#sortableTable {
    border-radius: 10px;
    overflow: hidden;
    background-color: #ffffff;
}
#sortableTable th,
#sortableTable td {
    background-color: #ffffff;
}
</style>

<div class="table-responsive">

<?php
/* =======================
   FETCH COURSES LOGIC
======================= */

if ($_SESSION['login_user_type'] == 3) {
    // STUDENT → NOT ENROLLED COURSES
    $student_id = (int)$_SESSION['login_user_id'];

    $qry = $conn->query("
        SELECT 
            cd.course_id,
            cd.course_name,
            ct.course_type_name,
            u.name AS owner_name
        FROM course_database cd
        JOIN course_type ct ON cd.course_type = ct.course_type_id
        JOIN users_database u ON cd.course_owner = u.user_id
        WHERE cd.course_id NOT IN (
            SELECT course_id 
            FROM studentcourseregistered 
            WHERE user_id = $student_id
        )
    ");

    $sql = "
        SELECT COUNT(*) AS total_course
        FROM course_database
        WHERE course_id NOT IN (
            SELECT course_id 
            FROM studentcourseregistered 
            WHERE user_id = $student_id
        )
    ";
}
elseif ($_SESSION['login_user_type'] == 1) {
    // ADMIN → ALL COURSES
    $qry = $conn->query("
        SELECT 
            cd.course_id,
            cd.course_name,
            ct.course_type_name,
            u.name AS owner_name
        FROM course_database cd
        JOIN course_type ct ON cd.course_type = ct.course_type_id
        JOIN users_database u ON cd.course_owner = u.user_id
    ");

    $sql = "SELECT COUNT(*) AS total_course FROM course_database";
}
else {
    // COURSE OWNER → OWN COURSES
    $owner_id = (int)$_SESSION['login_user_id'];

    $qry = $conn->query("
        SELECT 
            cd.course_id,
            cd.course_name,
            ct.course_type_name,
            u.name AS owner_name
        FROM course_database cd
        JOIN course_type ct ON cd.course_type = ct.course_type_id
        JOIN users_database u ON cd.course_owner = u.user_id
        WHERE cd.course_owner = $owner_id
    ");

    $sql = "SELECT COUNT(*) AS total_course FROM course_database WHERE course_owner = $owner_id";
}

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalCourses = $row['total_course'];
?>

<div class="card-header">
    <div class="card-tools">
        <?php if ($_SESSION['login_user_type'] != 3): ?>
        <a class="btn btn-block btn-sm btn-primary btn-flat" href="./index.php?page=new_course">
            <i class="fa fa-plus"></i> Add New Course
        </a>
        <?php endif; ?>
    </div>
</div>

<?php if ($totalCourses > 0): ?>
<table class="table table-hover table-bordered bg-white" id="sortableTable">
    <thead class="thead-light text-center">
        <tr>
            <th>Course ID</th>
            <th>Course Name</th>
            <th>Course Type</th>
            <th>Course Owner</th>
            <th>View</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody class="text-center">
    <?php while ($row = $qry->fetch_assoc()): ?>
        <tr>
            <td><?= sprintf('%03d', $row['course_id']) ?></td>
            <td><b><?= htmlspecialchars($row['course_name']) ?></b></td>
            <td><b><?= htmlspecialchars($row['course_type_name']) ?></b></td>
            <td><b><?= htmlspecialchars($row['owner_name']) ?></b></td>

            <td>
                <a href="./index.php?page=viewcourse&course_id=<?= $row['course_id'] ?>"
                   class="btn btn-sm btn-info">
                    View
                </a>
            </td>

            <td>
            <?php if ($_SESSION['login_user_type'] == 3): ?>
                <button class="btn btn-sm btn-success enroll_course"
                        data-courseid="<?= $row['course_id'] ?>">
                    Enroll
                </button>
            <?php else: ?>
                <button class="btn btn-sm btn-danger delete_course"
                        data-id="<?= $row['course_id'] ?>">
                    Delete
                </button>
            <?php endif; ?>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<?php else: ?>
<div class="card-body p-3 text-center">
    <h6 class="text-muted">No Courses found</h6>
</div>
<?php endif; ?>

</div>

<!-- IMPORTANT: jQuery is already loaded in index.php -->
<script>
$(document).on('click', '.enroll_course', function () {

    let courseId = $(this).data('courseid');

    if (!confirm('Enroll in this course?')) return;

    $.ajax({
        url: './enroll_course.php',
        type: 'POST',
        data: { course_id: courseId },
        success: function (resp) {
            resp = resp.trim();

            if (resp === '1') {
                alert('Successfully enrolled!');
                location.reload();
            } else if (resp === '2') {
                alert('Already enrolled.');
            } else {
                alert('Enrollment failed.');
            }
        },
        error: function () {
            alert('AJAX error');
        }
    });
});
</script>
