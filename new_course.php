<?php 
include 'db_connect.php';
?>

<div class="col-lg-12">
    <div class="card shadow-lg">
        <div class="card-body">

            <?php if ($_SESSION['login_user_type'] == 1 || $_SESSION['login_user_type'] == 2): ?>
                <h3 class="text-center mb-4">Add New Course</h3>

                <?php
                // Fetch course types
                $typeResult = $conn->query("SELECT * FROM course_type");

                // Fetch course owners (user_type = 2)
                $ownerResult = $conn->query(
                    "SELECT user_id, name FROM users_database WHERE user_type = 2"
                );
                ?>

                <form id="courseForm">

                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Course Name</label>
                                <input type="text" name="course_name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Course Type</label>
                                <select name="course_type" class="form-control" required>
                                    <option value="">Select Course Type</option>
                                    <?php while ($row = $typeResult->fetch_assoc()): ?>
                                        <option value="<?= $row['course_type_id'] ?>">
                                            <?= $row['course_type_name'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Course Owner</label>
                                <select name="course_owner" class="form-control" required>
                                    <option value="">Select Course Owner</option>
                                    <?php while ($row = $ownerResult->fetch_assoc()): ?>
                                        <option value="<?= $row['user_id'] ?>">
                                            <?= $row['name'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                        </div>
                    </div>

                    <hr>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="index.php?page=course_list" class="btn btn-secondary">Cancel</a>
                    </div>

                </form>

                <div id="responseMessage"></div>

            <?php endif; ?>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {

    $('#courseForm').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: 'operations/insert_course.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (resp) {
                if (resp == 1) {
                    $('#responseMessage').html(
                        '<div class="alert alert-success">Course added successfully!</div>'
                    );
                    $('#courseForm')[0].reset();
                } else {
                    $('#responseMessage').html(
                        '<div class="alert alert-danger">' + resp + '</div>'
                    );
                }
            },
            error: function () {
                $('#responseMessage').html(
                    '<div class="alert alert-danger">Server error occurred.</div>'
                );
            }
        });
    });

});
</script>
