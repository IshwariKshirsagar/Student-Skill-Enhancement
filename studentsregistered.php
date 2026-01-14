<?php 
include 'db_connect.php';

$course_id = isset($_GET['course_id']) ? (int)$_GET['course_id'] : 0;

/* ===========================
   ADD VIDEO LOGIC
   =========================== */
if (isset($_POST['save_video'])) {

    $title = $_POST['video_title'];
    $desc  = $_POST['description'];

    // folders
    $thumbDir = "../thumbnail/";
    $videoDir = "../course_videos/";

    if (!is_dir($thumbDir)) mkdir($thumbDir, 0777, true);
    if (!is_dir($videoDir)) mkdir($videoDir, 0777, true);

    $thumbName = time().'_'.$_FILES['thumbnail']['name'];
    $videoName = time().'_'.$_FILES['video']['name'];

    $thumbPath = $thumbDir.$thumbName;
    $videoPath = $videoDir.$videoName;

    move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbPath);
    move_uploaded_file($_FILES['video']['tmp_name'], $videoPath);

    $conn->query("
        INSERT INTO course_videos
        (course_id, Thumbnail, VideoTitle, Description, video, Status)
        VALUES
        ('$course_id', '$thumbPath', '$title', '$desc', '$videoPath', 0)
    ");

    echo "<script>alert('Video added successfully');</script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Course Details</title>

    <!-- Bootstrap & jQuery -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <div class="col-lg-12 mt-3">
        <div class="card card-outline card-success">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Course Management</h5>
                <a class="btn btn-sm btn-secondary" href="./index.php?page=course">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>

            <div class="card-body">

                <!-- Buttons -->
                <div class="mb-3 text-right">
                    <button class="btn btn-sm btn-success" id="showStudents">
                        <i class="fa fa-users"></i> Registered Students
                    </button>
                    <button class="btn btn-sm btn-primary" id="showVideos">
                        <i class="fa fa-video"></i> Add Videos
                    </button>
                </div>

                <!-- ===========================
             STUDENTS SECTION (UNCHANGED LOGIC)
             =========================== -->
                <div id="studentsSection">

                    <?php
        $i = 1;
        $type = array('', "Admin", "Course Owner", "Student");

        $count_qry = $conn->query("
            SELECT COUNT(*) AS total_students
            FROM studentcourseregistered
            WHERE course_id = $course_id
        ");
        $total_students = $count_qry->fetch_assoc()['total_students'];

        $qry = $conn->query("
            SELECT u.*, scr.course_id
            FROM users_database u
            INNER JOIN studentcourseregistered scr 
                ON scr.user_id = u.user_id
            WHERE scr.course_id = $course_id
        ");
        ?>

                    <?php if($total_students > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $qry->fetch_assoc()): ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++; ?></td>
                                    <td><b><?php echo ucwords($row['name']); ?></b></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['phone_number']; ?></td>
                                    <td><?php echo $type[$row['user_type']]; ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-danger remove_user"
                                            data-id="<?php echo $row['user_id']; ?>"
                                            data-courseid="<?php echo $row['course_id']; ?>">
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="text-center text-muted">No Students Found</div>
                    <?php endif; ?>

                </div>

                <!-- ===========================
             ADD VIDEO SECTION
             =========================== -->
                <div id="videoSection" style="display:none;">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h6 class="mb-0">Add Course Video</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label>Video Title</label>
                                    <input type="text" name="video_title" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="3" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Thumbnail</label>
                                    <input type="file" name="thumbnail" class="form-control-file" required>
                                </div>

                                <div class="form-group">
                                    <label>Video File</label>
                                    <input type="file" name="video" class="form-control-file" required>
                                </div>

                                <button type="submit" name="save_video" class="btn btn-success btn-sm">
                                    <i class="fa fa-upload"></i> Upload Video
                                </button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ===========================
     JS
     =========================== -->
    <script>
    document.querySelector("form").addEventListener("submit", function(e) {
        const video = document.querySelector("input[name='video']").files[0];
        if (video && video.size > 5000 * 1024 * 1024) {
            alert("Video size is much bigger");
            e.preventDefault();
        }
    });
    $('#showStudents').click(function() {
        $('#studentsSection').show();
        $('#videoSection').hide();
    });

    $('#showVideos').click(function() {
        $('#studentsSection').hide();
        $('#videoSection').show();
    });

    $(document).on('click', '.remove_user', function() {
        if (confirm('Remove this student?')) {
            $.post('remove_user.php', {
                id: $(this).data('id'),
                courseid: $(this).data('courseid')
            }, function(resp) {
                if (resp == 1) location.reload();
                else alert('Failed');
            });
        }
    });
    </script>

</body>

</html>