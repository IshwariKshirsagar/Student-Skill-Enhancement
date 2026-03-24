<?php
include 'db_connect.php';

$course_id  = isset($_GET['course_id']) ? (int)$_GET['course_id'] : 0;
$force_test = isset($_GET['retest']) && $_GET['retest'] == 1;

// Only enrolled students
if (!isset($_SESSION['login_user_id']) || $_SESSION['login_user_type'] != 3) {
    echo "<script>window.location.href='index.php?page=home';</script>";
    exit;
}

$student_id = (int)$_SESSION['login_user_id'];

// Fetch course name
$course = $conn->query("SELECT course_name FROM course_database WHERE course_id = $course_id")->fetch_assoc();
if (!$course) { echo "Course not found."; exit; }

// Check if course has any quiz questions
$q_count = $conn->query("SELECT COUNT(*) AS cnt FROM course_quiz WHERE course_id = $course_id")->fetch_assoc()['cnt'];

// No questions → redirect directly to certificate
if ($q_count == 0) {
    echo "<script>window.location.href='certificate.php?course_id=$course_id';</script>";
    exit;
}

// Check if student already passed this quiz
$already_passed = $conn->query("
    SELECT id FROM student_quiz_pass
    WHERE student_id = $student_id AND course_id = $course_id
")->num_rows > 0;

// Already passed and not requesting retest → show choice screen
$show_choice = $already_passed && !$force_test;

// Fetch up to 10 random questions (only needed if taking the quiz)
$questions = [];
$total = 0;
if (!$show_choice) {
    $questions_result = $conn->query("
        SELECT * FROM course_quiz WHERE course_id = $course_id ORDER BY RAND() LIMIT 10
    ");
    while ($q = $questions_result->fetch_assoc()) $questions[] = $q;
    $total = count($questions);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Course Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background: #f4f6f9; }

        .quiz-wrapper {
            max-width: 760px;
            margin: 40px auto;
        }

        .quiz-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.10);
            overflow: hidden;
        }

        .quiz-header {
            background: linear-gradient(135deg, #28a745, #20c997);
            padding: 24px 28px;
            color: #fff;
        }

        .quiz-header h4 { font-weight: 700; margin: 0; }
        .quiz-header p  { margin: 4px 0 0; opacity: 0.85; font-size: 13px; }

        .quiz-body { padding: 28px; }

        .question-block {
            background: #fff;
            border: 1.5px solid #e9ecef;
            border-radius: 12px;
            padding: 20px 22px;
            margin-bottom: 20px;
        }

        .question-block .q-number {
            font-size: 12px;
            font-weight: 700;
            color: #28a745;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .question-block .q-text {
            font-size: 15px;
            font-weight: 600;
            color: #222;
            margin-bottom: 14px;
        }

        .option-label {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border: 1.5px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 8px;
            cursor: pointer;
            font-size: 14px;
            color: #444;
            transition: border-color 0.15s, background 0.15s;
        }

        .option-label:hover { border-color: #28a745; background: #f0fff4; }

        .option-label input[type="radio"] { accent-color: #28a745; width: 16px; height: 16px; flex-shrink: 0; }

        .option-label input[type="radio"]:checked + span { color: #28a745; font-weight: 600; }

        .option-label:has(input:checked) { border-color: #28a745; background: #f0fff4; }

        .progress-bar-custom {
            height: 6px;
            background: #e9ecef;
            border-radius: 4px;
            margin-bottom: 24px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #28a745, #20c997);
            border-radius: 4px;
            width: 0%;
            transition: width 0.3s;
        }

        .btn-submit {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none; color: #fff; font-weight: 600;
            padding: 12px 36px; border-radius: 8px; font-size: 15px;
        }

        .btn-submit:hover { opacity: 0.88; color: #fff; }

        /* Result overlay */
        #resultBox {
            display: none;
            text-align: center;
            padding: 40px 20px;
        }

        #resultBox .result-icon { font-size: 64px; margin-bottom: 16px; }
        #resultBox h3 { font-weight: 700; }
        #resultBox p  { font-size: 15px; color: #555; }

        .no-questions {
            text-align: center;
            padding: 60px 20px;
            color: #888;
        }

        .no-questions i { font-size: 48px; margin-bottom: 12px; display: block; }
    </style>
</head>
<body>

<div class="quiz-wrapper">
    <div class="quiz-card card">

        <div class="quiz-header">
            <h4><i class="fa fa-question-circle mr-2"></i> Course Quiz</h4>
            <p><?php echo htmlspecialchars($course['course_name']); ?> &mdash;
                <?php echo $already_passed ? 'You have already passed this quiz.' : 'Answer all questions correctly to unlock your certificate.'; ?>
            </p>
        </div>

        <div class="quiz-body">

            <?php if ($show_choice): ?>
            <!-- Already passed — give choice -->
            <div style="text-align:center; padding:40px 20px;">
                <div style="font-size:64px; margin-bottom:16px;">🏆</div>
                <h4 style="font-weight:700; color:#28a745;">You already passed this quiz!</h4>
                <p style="color:#555; font-size:15px; margin-bottom:28px;">
                    You can download your certificate directly or take the quiz again.
                </p>
                <a href="certificate.php?course_id=<?= $course_id ?>"
                   class="btn btn-success btn-lg mr-2">
                    <i class="fa fa-certificate mr-1"></i> Download Certificate
                </a>
                <a href="index.php?page=quiz&course_id=<?= $course_id ?>&retest=1"
                   class="btn btn-outline-warning btn-lg">
                    <i class="fa fa-redo mr-1"></i> Retake Quiz
                </a>
            </div>

            <?php else: ?>

            <!-- Progress bar -->
            <div class="progress-bar-custom">
                <div class="progress-bar-fill" id="progressFill"></div>
            </div>

            <form id="quizForm">
                <input type="hidden" name="course_id" value="<?= $course_id ?>">

                <?php foreach ($questions as $idx => $q): ?>
                <div class="question-block">
                    <div class="q-number">Question <?= $idx + 1 ?> of <?= $total ?></div>
                    <div class="q-text"><?= htmlspecialchars($q['question']) ?></div>

                    <?php foreach (['A' => $q['option_a'], 'B' => $q['option_b'], 'C' => $q['option_c'], 'D' => $q['option_d']] as $key => $val): ?>
                    <label class="option-label">
                        <input type="radio" name="q_<?= $q['id'] ?>" value="<?= $key ?>"
                               data-qindex="<?= $idx ?>">
                        <span><?= $key ?>. <?= htmlspecialchars($val) ?></span>
                    </label>
                    <?php endforeach; ?>

                    <input type="hidden" name="correct_<?= $q['id'] ?>" value="<?= htmlspecialchars($q['correct_option']) ?>">
                </div>
                <?php endforeach; ?>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-submit">
                        <i class="fa fa-paper-plane mr-1"></i> Submit Quiz
                    </button>
                </div>
            </form>

            <!-- Result box (shown after submit) -->
            <div id="resultBox">
                <div class="result-icon" id="resultIcon"></div>
                <h3 id="resultTitle"></h3>
                <p id="resultMsg"></p>
                <div id="resultActions" class="mt-3"></div>
            </div>

            <?php endif; ?>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php if (!$show_choice): ?>
<script>
// Update progress bar as user answers
$(document).on('change', 'input[type="radio"]', function () {
    const total   = <?= $total ?>;
    const answered = new Set();
    $('input[type="radio"]:checked').each(function () {
        answered.add($(this).data('qindex'));
    });
    const pct = (answered.size / total) * 100;
    $('#progressFill').css('width', pct + '%');
});

$('#quizForm').on('submit', function (e) {
    e.preventDefault();

    // Client-side: check all answered
    const total    = <?= $total ?>;
    const answered = new Set();
    $('input[type="radio"]:checked').each(function () {
        answered.add($(this).data('qindex'));
    });

    if (answered.size < total) {
        alert('Please answer all ' + total + ' questions before submitting.');
        return;
    }

    // Submit to server
    $.ajax({
        url: 'operations/submit_quiz.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function (raw) {
            let res;
            try { res = typeof raw === 'object' ? raw : JSON.parse(raw); }
            catch(e) { alert('Server error.'); return; }

            $('#quizForm').hide();
            $('#resultBox').show();

            if (res.passed) {
                $('#resultIcon').html('<span style="color:#28a745;">🎉</span>');
                $('#resultTitle').text('Congratulations! You Passed!').css('color','#28a745');
                $('#resultMsg').text('You scored ' + res.score + ' out of ' + res.total + '. Your certificate is ready.');
                $('#resultActions').html(
                    '<a href="certificate.php?course_id=<?= $course_id ?>" class="btn btn-success btn-lg">' +
                    '<i class="fa fa-certificate mr-1"></i> Download Certificate</a>'
                );
            } else {
                $('#resultIcon').html('<span style="color:#dc3545;">😔</span>');
                $('#resultTitle').text('You did not pass.').css('color','#dc3545');
                $('#resultMsg').text('You scored ' + res.score + ' out of ' + res.total + '. You need all answers correct. Please try again.');
                $('#resultActions').html(
                    '<button onclick="location.reload()" class="btn btn-warning btn-lg mr-2">' +
                    '<i class="fa fa-redo mr-1"></i> Retry Quiz</button>' +
                    '<a href="index.php?page=viewcourse&course_id=<?= $course_id ?>&course_access=allowed" class="btn btn-secondary btn-lg">' +
                    '<i class="fa fa-arrow-left mr-1"></i> Back to Course</a>'
                );
            }
        },
        error: function () { alert('Submission failed. Please try again.'); }
    });
});
</script>
<?php endif; ?>

</body>
</html>
