
$(document).ready(function () {

    $("#signin").click(function (e) {
        console.log("signin Button Clicked");
        e.preventDefault();

        let email = $('#email').val();
        let password = $('#password').val();
        console.log(email);
        console.log(password);
        mydata = {email:email,password:password};
        console.log(mydata);
        $.ajax({
            url: "operations/logincheck.php",
            method: "POST",
            data: JSON.stringify(mydata), // Convert Object to String
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    location.href ='index.php?page=home';
                } else if (data == 2) {
                    $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
                    end_load();
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: ", status, error);
                console.error("Response: ", xhr.responseText);
            }
        });
    });
});
