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

});
