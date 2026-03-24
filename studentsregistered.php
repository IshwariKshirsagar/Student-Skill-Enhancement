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
                    <button class="btn btn-sm btn-info" id="showVideoList">
                        <i class="fa fa-play-circle"></i> Course Videos
                    </button>
                    <button class="btn btn-sm btn-warning" id="showQuiz">
                        <i class="fa fa-question-circle"></i> Quiz Questions
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
                    <div class="card" style="border:none; border-radius:16px; box-shadow:0 4px 24px rgba(0,0,0,0.10); max-width:640px; margin:0 auto;">
                        <div class="card-header" style="background:linear-gradient(135deg,#28a745,#20c997); border-radius:16px 16px 0 0; padding:22px 28px 18px; border:none;">
                            <h5 style="color:#fff; font-weight:700; margin:0;"><i class="fa fa-video mr-2"></i> Add Course Video</h5>
                            <p style="color:rgba(255,255,255,0.80); font-size:13px; margin:4px 0 0;">Upload a new video lecture for this course.</p>
                        </div>
                        <div class="card-body" style="padding:28px;">
                            <form method="POST" enctype="multipart/form-data" id="videoUploadForm">

                                <!-- Video Title -->
                                <div class="form-group">
                                    <label style="font-weight:600; font-size:13px; color:#444; text-transform:uppercase; letter-spacing:0.4px;">
                                        <i class="fa fa-heading mr-1 text-success"></i> Video Title
                                    </label>
                                    <input type="text" name="video_title" class="form-control" placeholder="e.g. Introduction to Variables" required
                                        style="border:1.5px solid #dee2e6; border-radius:8px; padding:10px 14px; font-size:14px; box-shadow:none;">
                                </div>

                                <!-- Description -->
                                <div class="form-group">
                                    <label style="font-weight:600; font-size:13px; color:#444; text-transform:uppercase; letter-spacing:0.4px;">
                                        <i class="fa fa-align-left mr-1 text-success"></i> Description
                                    </label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Brief description of this video..." required
                                        style="border:1.5px solid #dee2e6; border-radius:8px; padding:10px 14px; font-size:14px; box-shadow:none; resize:vertical;"></textarea>
                                </div>

                                <!-- Thumbnail Upload -->
                                <div class="form-group">
                                    <label style="font-weight:600; font-size:13px; color:#444; text-transform:uppercase; letter-spacing:0.4px;">
                                        <i class="fa fa-image mr-1 text-success"></i> Thumbnail Image
                                    </label>
                                    <div id="thumbUploadBox" style="border:2px dashed #ced4da; border-radius:8px; padding:18px 14px; text-align:center; cursor:pointer; background:#fafafa; position:relative; transition:border-color 0.2s, background 0.2s;">
                                        <input type="file" name="thumbnail" id="thumbInput" accept="image/*" required
                                            style="position:absolute; inset:0; opacity:0; cursor:pointer; width:100%; height:100%;">
                                        <i class="fa fa-cloud-upload-alt" style="font-size:26px; color:#adb5bd; display:block; margin-bottom:6px;"></i>
                                        <div style="font-size:13px; color:#888;">Click or drag &amp; drop thumbnail here</div>
                                        <div id="thumbFileName" style="font-size:13px; color:#28a745; font-weight:600; margin-top:4px;">No file chosen</div>
                                    </div>
                                </div>

                                <!-- Video File Upload -->
                                <div class="form-group">
                                    <label style="font-weight:600; font-size:13px; color:#444; text-transform:uppercase; letter-spacing:0.4px;">
                                        <i class="fa fa-film mr-1 text-success"></i> Video File
                                    </label>
                                    <div id="videoUploadBox" style="border:2px dashed #ced4da; border-radius:8px; padding:18px 14px; text-align:center; cursor:pointer; background:#fafafa; position:relative; transition:border-color 0.2s, background 0.2s;">
                                        <input type="file" name="video" id="videoInput" accept="video/*" required
                                            style="position:absolute; inset:0; opacity:0; cursor:pointer; width:100%; height:100%;">
                                        <i class="fa fa-video" style="font-size:26px; color:#adb5bd; display:block; margin-bottom:6px;"></i>
                                        <div style="font-size:13px; color:#888;">Click or drag &amp; drop video file here</div>
                                        <div id="videoFileName" style="font-size:13px; color:#28a745; font-weight:600; margin-top:4px;">No file chosen</div>
                                    </div>
                                </div>

                                <hr class="mt-4">

                                <div class="d-flex justify-content-end" style="gap:10px;">
                                    <button type="button" onclick="$('#videoSection').hide(); $('#studentsSection').show();"
                                        style="border:1.5px solid #ced4da; background:#fff; color:#555; font-weight:600; padding:10px 24px; border-radius:8px; font-size:14px;">
                                        Cancel
                                    </button>
                                    <button type="submit" name="save_video"
                                        style="background:linear-gradient(135deg,#28a745,#20c997); border:none; color:#fff; font-weight:600; padding:10px 28px; border-radius:8px; font-size:14px;">
                                        <i class="fa fa-upload mr-1"></i> Upload Video
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!-- ===========================
             COURSE VIDEOS LIST SECTION
             =========================== -->
                <div id="videoListSection" style="display:none;">
                    <?php
                    $videos_qry = $conn->query("
                        SELECT * FROM course_videos WHERE course_id = $course_id ORDER BY id ASC
                    ");
                    if ($videos_qry->num_rows > 0):
                    ?>
                    <div class="row">
                        <?php while ($vid = $videos_qry->fetch_assoc()): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <img src="<?php echo htmlspecialchars($vid['Thumbnail']); ?>"
                                     class="card-img-top"
                                     alt="<?php echo htmlspecialchars($vid['VideoTitle']); ?>"
                                     style="height:180px; object-fit:cover;">
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title font-weight-bold mb-1">
                                        <?php echo htmlspecialchars($vid['VideoTitle']); ?>
                                    </h6>
                                    <p class="card-text text-muted small flex-grow-1" style="overflow:hidden; max-height:60px;">
                                        <?php echo htmlspecialchars($vid['Description']); ?>
                                    </p>
                                    <a href="./index.php?page=playvideo&id=<?php echo $vid['id']; ?>&course_id=<?php echo $course_id; ?>"
                                       class="btn btn-sm btn-primary mt-2">
                                        <i class="fa fa-play mr-1"></i> Watch
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <?php else: ?>
                    <div class="text-center text-muted py-4">
                        <i class="fa fa-video fa-2x mb-2 d-block"></i>
                        No videos uploaded yet for this course.
                    </div>
                    <?php endif; ?>
                </div>

                <!-- ===========================
                 QUIZ QUESTIONS SECTION
                 =========================== -->
                <div id="quizSection" style="display:none;">
                    <?php
                    // Handle add question
                    if (isset($_POST['save_question'])) {
                        $question  = mysqli_real_escape_string($conn, $_POST['question']);
                        $option_a  = mysqli_real_escape_string($conn, $_POST['option_a']);
                        $option_b  = mysqli_real_escape_string($conn, $_POST['option_b']);
                        $option_c  = mysqli_real_escape_string($conn, $_POST['option_c']);
                        $option_d  = mysqli_real_escape_string($conn, $_POST['option_d']);
                        $correct   = mysqli_real_escape_string($conn, $_POST['correct_option']);
                        $conn->query("INSERT INTO course_quiz (course_id, question, option_a, option_b, option_c, option_d, correct_option)
                                      VALUES ($course_id, '$question', '$option_a', '$option_b', '$option_c', '$option_d', '$correct')");
                        echo "<script>alert('Question added successfully!');</script>";
                    }
                    // Handle delete question
                    if (isset($_POST['delete_question'])) {
                        $del_id = (int)$_POST['delete_question'];
                        $conn->query("DELETE FROM course_quiz WHERE id = $del_id AND course_id = $course_id");
                    }

                    $quiz_qry = $conn->query("SELECT * FROM course_quiz WHERE course_id = $course_id ORDER BY id ASC");
                    $quiz_count = $quiz_qry->num_rows;
                    ?>

                    <!-- Add Question Form -->
                    <div class="card mb-4" style="border:none; border-radius:16px; box-shadow:0 4px 24px rgba(0,0,0,0.10); max-width:680px; margin:0 auto 24px;">
                        <div class="card-header" style="background:linear-gradient(135deg,#ffc107,#fd7e14); border-radius:16px 16px 0 0; padding:20px 26px 16px; border:none;">
                            <h5 style="color:#fff; font-weight:700; margin:0;"><i class="fa fa-plus-circle mr-2"></i> Add Quiz Question</h5>
                            <p style="color:rgba(255,255,255,0.85); font-size:13px; margin:4px 0 0;">Add MCQ questions for the certificate quiz (need at least 10).</p>
                        </div>
                        <div class="card-body" style="padding:24px;">
                            <form method="POST">
                                <div class="form-group">
                                    <label style="font-weight:600; font-size:13px; color:#444; text-transform:uppercase; letter-spacing:0.4px;">
                                        <i class="fa fa-question mr-1 text-warning"></i> Question
                                    </label>
                                    <textarea name="question" class="form-control" rows="2" placeholder="Enter the question..." required
                                        style="border:1.5px solid #dee2e6; border-radius:8px; font-size:14px; box-shadow:none;"></textarea>
                                </div>
                                <div class="row">
                                    <?php foreach (['A','B','C','D'] as $opt): ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="font-weight:600; font-size:13px; color:#444; text-transform:uppercase; letter-spacing:0.4px;">
                                                Option <?= $opt ?>
                                            </label>
                                            <input type="text" name="option_<?= strtolower($opt) ?>" class="form-control"
                                                placeholder="Option <?= $opt ?>" required
                                                style="border:1.5px solid #dee2e6; border-radius:8px; font-size:14px; box-shadow:none;">
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight:600; font-size:13px; color:#444; text-transform:uppercase; letter-spacing:0.4px;">
                                        <i class="fa fa-check-circle mr-1 text-success"></i> Correct Answer
                                    </label>
                                    <select name="correct_option" class="form-control" required
                                        style="border:1.5px solid #dee2e6; border-radius:8px; font-size:14px; box-shadow:none;">
                                        <option value="">-- Select correct option --</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                                <div class="text-right">
                                    <button type="submit" name="save_question"
                                        style="background:linear-gradient(135deg,#ffc107,#fd7e14); border:none; color:#fff; font-weight:600; padding:10px 28px; border-radius:8px; font-size:14px;">
                                        <i class="fa fa-plus mr-1"></i> Add Question
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Existing Questions List -->
                    <?php if ($quiz_count > 0): ?>
                    <div class="card" style="border:none; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,0.07);">
                        <div class="card-header d-flex justify-content-between align-items-center" style="background:#f8f9fa; border-radius:12px 12px 0 0;">
                            <h6 class="mb-0 font-weight-bold"><i class="fa fa-list mr-1 text-warning"></i> Existing Questions (<?= $quiz_count ?>)</h6>
                            <?php if ($quiz_count < 10): ?>
                            <span class="badge badge-warning" style="font-size:12px;">Need <?= 10 - $quiz_count ?> more for quiz</span>
                            <?php else: ?>
                            <span class="badge badge-success" style="font-size:12px;"><i class="fa fa-check mr-1"></i> Quiz Ready</span>
                            <?php endif; ?>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center" style="width:40px;">#</th>
                                            <th>Question</th>
                                            <th class="text-center">A</th>
                                            <th class="text-center">B</th>
                                            <th class="text-center">C</th>
                                            <th class="text-center">D</th>
                                            <th class="text-center">Answer</th>
                                            <th class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $qi = 1; while ($qrow = $quiz_qry->fetch_assoc()): ?>
                                        <tr>
                                            <td class="text-center"><?= $qi++ ?></td>
                                            <td><?= htmlspecialchars($qrow['question']) ?></td>
                                            <td class="text-center small"><?= htmlspecialchars($qrow['option_a']) ?></td>
                                            <td class="text-center small"><?= htmlspecialchars($qrow['option_b']) ?></td>
                                            <td class="text-center small"><?= htmlspecialchars($qrow['option_c']) ?></td>
                                            <td class="text-center small"><?= htmlspecialchars($qrow['option_d']) ?></td>
                                            <td class="text-center">
                                                <span class="badge badge-success"><?= htmlspecialchars($qrow['correct_option']) ?></span>
                                            </td>
                                            <td class="text-center">
                                                <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this question?');">
                                                    <input type="hidden" name="delete_question" value="<?= $qrow['id'] ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="text-center text-muted py-4">
                        <i class="fa fa-question-circle fa-2x mb-2 d-block text-warning"></i>
                        No questions added yet. Add at least 10 questions for the quiz.
                    </div>
                    <?php endif; ?>
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
        $('#videoListSection').hide();
        $('#quizSection').hide();
    });

    $('#showVideos').click(function() {
        $('#studentsSection').hide();
        $('#videoSection').show();
        $('#videoListSection').hide();
        $('#quizSection').hide();
    });

    $('#showVideoList').click(function() {
        $('#studentsSection').hide();
        $('#videoSection').hide();
        $('#videoListSection').show();
        $('#quizSection').hide();
    });

    $('#showQuiz').click(function() {
        $('#studentsSection').hide();
        $('#videoSection').hide();
        $('#videoListSection').hide();
        $('#quizSection').show();
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

    // File input preview — thumbnail
    document.getElementById('thumbInput').addEventListener('change', function () {
        const name = this.files[0] ? this.files[0].name : 'No file chosen';
        document.getElementById('thumbFileName').textContent = name;
        document.getElementById('thumbUploadBox').style.borderColor = this.files[0] ? '#28a745' : '#ced4da';
        document.getElementById('thumbUploadBox').style.background  = this.files[0] ? '#f0fff4' : '#fafafa';
    });

    // File input preview — video
    document.getElementById('videoInput').addEventListener('change', function () {
        const name = this.files[0] ? this.files[0].name : 'No file chosen';
        document.getElementById('videoFileName').textContent = name;
        document.getElementById('videoUploadBox').style.borderColor = this.files[0] ? '#28a745' : '#ced4da';
        document.getElementById('videoUploadBox').style.background  = this.files[0] ? '#f0fff4' : '#fafafa';
    });

    // Focus ring on form controls
    document.querySelectorAll('#videoUploadForm .form-control').forEach(function(el) {
        el.addEventListener('focus', function() { this.style.borderColor = '#28a745'; this.style.boxShadow = '0 0 0 3px rgba(40,167,69,0.12)'; });
        el.addEventListener('blur',  function() { this.style.borderColor = '#dee2e6'; this.style.boxShadow = 'none'; });
    });
    </script>

</body>

</html>