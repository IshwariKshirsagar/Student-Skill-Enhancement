<?php
session_start();
include('db_connect.php');

if(isset($_SESSION['login_user_id'])){
    header("location:index.php?page=home");
    exit;
}

$msg = "";

// REGISTER BACKEND
if(isset($_POST['register'])){
    
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $user_type = intval($_POST['user_type']);

    // check existing email
    $check = $conn->query("SELECT * FROM users_database WHERE email='$email'");
    if($check->num_rows > 0){
        $msg = "<div class='alert alert-danger'>Email already registered!</div>";
    }
    else{
        // NOTE: your DB currently stores plain password
        $insert = $conn->query("
            INSERT INTO users_database
            (name,email,password,user_type,phone_number,address,facebook,instagram,linkedin,twitter,github,profile_information,recent_activities)
            VALUES
            ('$name','$email','$password','$user_type','$phone','$address','','','','','','','')
        ");

        if($insert){
            $msg = "<div class='alert alert-success'>Account Created Successfully! You can login now.</div>";
        }else{
            $msg = "<div class='alert alert-danger'>Registration Failed!</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>

<link rel="icon" href="./assets/images/favicon.png" type="image/png">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
body{
    background-image: url('assets/background/background.png');
    background-size: cover;
    background-position:center;
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
}

.overlay{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);
    backdrop-filter: blur(10px);
}

.register-box{
    position:relative;
    z-index:2;
    width:100%;
    max-width:450px;
}

.card{
    border-radius:12px;
}

.card-body{
    background:rgba(255,255,255,0.92);
    border-radius:12px;
}

.logo-text{
    font-size:2.3rem;
    font-weight:bold;
    color:#fff;
    text-shadow:0 0 10px #fff,0 0 20px gold;
}
</style>
</head>

<body>

<div class="overlay"></div>

<div class="register-box">

    <div class="text-center mb-3">
        <span class="logo-text">Student Skill Enhancement</span>
    </div>

    <div class="card">
        <div class="card-body">

            <?php echo $msg; ?>

            <form method="POST">

                <!-- Name -->
                <div class="mb-2 input-group">
                    <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>

                <!-- Email -->
                <div class="mb-2 input-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>

                <!-- Password -->
                <div class="mb-2 input-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>

                <!-- Phone -->
                <div class="mb-2 input-group">
                    <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>

                <!-- Address -->
                <div class="mb-2 input-group">
                    <input type="text" name="address" class="form-control" placeholder="Address" required>
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>

                <!-- Account Type -->
                <div class="mb-3">
                    <label class="form-label">Register As</label>
                    <select name="user_type" class="form-select" required>
                        <option value="">Select Account Type</option>
                        <option value="2">Course Owner</option>
                        <option value="3">Student</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="login.php" class="text-decoration-none">Already have account?</a>
                    <button type="submit" name="register" class="btn btn-success">Create Account</button>
                </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>
