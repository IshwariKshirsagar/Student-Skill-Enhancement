<?php
include 'db_connect.php';

// Only Admin (1) & Course Owner (2)
if ($_SESSION['login_user_type'] != 1 && $_SESSION['login_user_type'] != 2) {
    echo "<div class='alert alert-danger'>Access Denied</div>";
    exit;
}

// Fetch course types
$typeResult = $conn->query("SELECT * FROM course_type");

// Fetch course owners (only needed for Admin)
$ownerResult = $conn->query("SELECT user_id, name FROM users_database WHERE user_type = 2");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add New Course</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
    .form-control {
        border: 2px solid #ced4da;
        border-radius: 8px;
        padding: 8px 12px;
        transition: all 0.3s ease;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.08);
    }

    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.15rem rgba(40, 167, 69, .25);
    }

    label {
        font-weight: 600;
    }

    .card {
        border-radius: 12px;
    }

    .btn {
        border-radius: 6px;
    }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="card shadow-lg">
                    <div class="card-body">

                        <h4 class="text-center mb-4 font-weight-bold">
                            Add New Course
                        </h4>

                        <form id="courseForm">

                            <div class="row">

                                <!-- LEFT COLUMN -->
                                <div class="col-md-6 border-right">

                                    <div class="form-group">
                                        <label>Course Name</label>
                                        <input type="text" name="course_name" class="form-control form-control-sm"
                                            placeholder="Enter course name" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Course Owner</label>

                                        <?php if ($_SESSION['login_user_type'] == 1): ?>
                                        <!-- ADMIN: selectable -->
                                        <select name="course_owner" class="form-control form-control-sm" required>
                                            <option value="">-- Select Course Owner --</option>
                                            <?php while ($row = $ownerResult->fetch_assoc()): ?>
                                            <option value="<?= $row['user_id'] ?>">
                                                <?= $row['name'] ?>
                                            </option>
                                            <?php endwhile; ?>
                                        </select>

                                        <?php elseif ($_SESSION['login_user_type'] == 2): ?>
                                        <!-- COURSE OWNER: auto-selected & locked -->
                                        <select class="form-control form-control-sm" disabled>
                                            <option selected>
                                                <?= $_SESSION['login_name'] ?> (You)
                                            </option>
                                        </select>

                                        <!-- Hidden input to submit value -->
                                        <input type="hidden" name="course_owner"
                                            value="<?= $_SESSION['login_user_id'] ?>">
                                        <?php endif; ?>

                                    </div>

                                </div>

                                <!-- RIGHT COLUMN -->
                                <div class="col-md-6 mt-4 mt-md-0">
                                    <div class="form-group">
                                        <label>Course Type</label>
                                        <select name="course_type" class="form-control form-control-sm" required>
                                            <option value="">-- Select Course Type --</option>
                                            <?php while ($row = $typeResult->fetch_assoc()): ?>
                                            <option value="<?= $row['course_type_id'] ?>">
                                                <?= $row['course_type_name'] ?>
                                            </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <hr>

                            <!-- Buttons -->
                            <div class="text-right">
                                <button type="submit" class="btn btn-success btn-sm px-4">
                                    Save
                                </button>
                                <a href="index.php?page=course_list" class="btn btn-secondary btn-sm px-4">
                                    Cancel
                                </a>
                            </div>

                        </form>

                        <!-- Response -->
                        <div id="responseMessage" class="mt-3"></div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {

        $('#courseForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'operations/insert_course.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(resp) {

                    if (resp == 1) {
                        $('#responseMessage').html(
                            '<div class="alert alert-success fade show" id="successAlert">' +
                            '<strong>Success!</strong> Course added successfully.' +
                            '</div>'
                        );

                        // Auto hide after 3 seconds
                        setTimeout(function() {
                            $('#successAlert').fadeOut('slow');
                        }, 3000);

                        $('#courseForm')[0].reset();
                    } else {
                        $('#responseMessage').html(
                            '<div class="alert alert-danger">' + resp + '</div>'
                        );
                    }
                },
                error: function() {
                    $('#responseMessage').html(
                        '<div class="alert alert-danger">Server error occurred.</div>'
                    );
                }
            });
        });

    });
    </script>

</body>

</html>