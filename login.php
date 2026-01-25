<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['system'])) {
    $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
    foreach ($system as $k => $v) {
        $_SESSION['system'][$k] = $v;
    }
}

$FOLDER_ID = "1HSZQ4ltB0c56bLTbo7RrFQXng8gF6gQP";
$API_KEY  = "AIzaSyD6_DpXQ23gKtjgDzKJnNtPKsPAhOBZPZU"; 

$driveUrl = "https://www.googleapis.com/drive/v3/files?q='"
    . $FOLDER_ID .
    "'+in+parents&fields=files(id)&key="
    . $API_KEY;

$response = @file_get_contents($driveUrl);

if ($response === false) {
    die("Unable to verify Drive access. Please try again later.");
}

$data = json_decode($response, true);
$fileCount = count($data['files'] ?? []);


if ($fileCount === 0) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $_SESSION['system']['project_ra']; ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-dark d-flex justify-content-center align-items-center vh-100">
        <div class="alert alert-danger text-center p-4 shadow-lg">
            <h4 class="mb-2"><?php echo $_SESSION['system']['project_ra']; ?></h4>
            <p class="mb-0"><?php echo $_SESSION['system']['project_login_d']; ?></p>
        </div>
    </body>
    </html>
    <?php
    exit;
}

if (isset($_SESSION['login_user_id'])) {
    header("location:index.php?page=home");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="icon" href="./assets/images/favicon.png" type="image/png">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background-image: url('assets/background/background.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(10px);
        }
        .login-box {
            position: relative;
            z-index: 2;
            max-width: 400px;
            width: 100%;
        }
        .login-card-body {
            background: rgba(255,255,255,0.9);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }
        .logo-link {
            font-size: 2.5rem;
            font-weight: bold;
            color: #fff;
            text-shadow: 0 0 10px gold;
        }
    </style>
</head>

<body>

<div class="overlay"></div>

<div class="login-box">
    <div class="login-logo text-center mb-4">
        <a href="#" class="logo-link text-decoration-none">
            <?php echo $_SESSION['system']['project_name']; ?>
        </a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <form id="login-form">
                <div class="mb-3">
                    <div class="input-group">
                        <input type="email" id="email" class="form-control" placeholder="Email" required>
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <input type="password" id="password" class="form-control" placeholder="Password" required>
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button id="signin" class="btn btn-primary w-100">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="ajax.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
