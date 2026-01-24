$(document).ready(function () {

    /* LOGIN */
    $("#signin").click(function (e) {
        e.preventDefault();

        let mydata = {
            email: $('#email').val(),
            password: $('#password').val()
        };

        $.ajax({
            url: "operations/logincheck.php",
            method: "POST",
            data: JSON.stringify(mydata),
            success: function (data) {
                if (data == 1) {
                    location.href = 'index.php?page=home';
                } else {
                    $('#login-form').prepend(
                        '<div class="alert alert-danger">Username or password is incorrect.</div>'
                    );
                }
            }
        });
    });

    /* ENROLL COURSE */
    $(document).on('click', '.enroll_course', function () {

        let courseId = $(this).data('courseid');

        if (!confirm('Enroll in this course?')) return;

        $.ajax({
            url: 'enroll_course.php',
            type: 'POST',
            data: { course_id: courseId },
            success: function (response) {

                response = response.trim();

                if (response === '1') {
                    alert('Successfully enrolled!');
                    location.reload();
                }
                else if (response === '2') {
                    alert('Already enrolled.');
                }
                else {
                    alert('Enrollment failed.');
                }
            },
            error: function () {
                alert('AJAX request failed.');
            }
        });

    });

});
