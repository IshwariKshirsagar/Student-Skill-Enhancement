<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Skill Enhancement</title>

<link rel="icon" href="./assets/images/favicon.png">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body{
font-family: 'Poppins', sans-serif;
background:#020845;
color:white;
}

.gallery img{
    width: 100%;
    height: 220px;      /* same height for all */
    object-fit: cover;  /* keeps image looking good */
    border-radius: 15px;
}
/* NAVBAR */

.navbar{
background:transparent;
padding:20px;
}

.navbar-brand{
font-weight:bold;
font-size:24px;
}

/* HERO */

.hero{
padding:120px 0;
text-align:center;
}

.hero h1{
font-size:50px;
font-weight:700;
}

.hero p{
opacity:0.8;
max-width:700px;
margin:auto;
}

/* FEATURES */

.feature-box{
background:white;
color:black;
padding:30px;
border-radius:15px;
text-align:center;
}

.feature-box i{
font-size:40px;
margin-bottom:15px;
}

/* ABOUT */

.about{
padding:80px 0;
text-align:center;
}

.about p{
max-width:900px;
margin:auto;
opacity:0.9;
}

/* GALLERY */

.gallery img{
border-radius:15px;
}

/* CTA */

.cta{
padding:80px 0;
text-align:center;
}

.footer{
background:#00042c;
padding:20px;
text-align:center;
opacity:0.7;
}

</style>

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-dark">

<div class="container">

<a class="navbar-brand">Student Skill Enhancement</a>

<div class="ms-auto">

<a href="login.php" class="btn btn-outline-light">Login</a>

</div>

</div>

</nav>

<!-- HERO SECTION -->

<section class="hero">

<div class="container">

<h1>Empower Your Skills for the Future</h1>

<p class="mt-3">

Student Skill Enhancement is a digital learning platform designed to help students
develop technical knowledge, digital literacy, and real-world skills through
courses, projects, and educational resources.

</p>

<div class="mt-4">

<a href="register.php" class="btn btn-primary btn-lg me-3">Create Account</a>

<a href="#about" class="btn btn-outline-light btn-lg">Learn More</a>

</div>

</div>

</section>

<!-- FEATURES -->

<section class="container mb-5">

<div class="row g-4">

<div class="col-md-4">

<div class="feature-box">

<i class="fa-solid fa-laptop-code text-primary"></i>

<h5>Digital Skills</h5>

<p>Learn programming, web development, and modern technology skills.</p>

</div>

</div>

<div class="col-md-4">

<div class="feature-box">

<i class="fa-solid fa-users text-success"></i>

<h5>Life Skills</h5>

<p>Develop communication, teamwork, and behavioral skills.</p>

</div>

</div>

<div class="col-md-4">

<div class="feature-box">

<i class="fa-solid fa-book-open text-danger"></i>

<h5>Continuous Learning</h5>

<p>Access learning resources anytime to improve your knowledge.</p>

</div>

</div>

</div>

</section>

<!-- ABOUT -->

<section id="about" class="about">

<div class="container">

<h2>About Student Skill Enhancement</h2>

<p class="mt-3">

Student Skill Enhancement is an online learning ecosystem that provides
students with high-quality educational resources, practical projects,
and curated courses designed to prepare them for modern careers.
Our goal is to empower learners with digital skills, innovation,
and lifelong learning opportunities.

</p>

</div>

</section>

<!-- GALLERY -->

<section class="container gallery mb-5">

<div class="row g-4">

<div class="col-md-3">
<img src="assets/StudentLearning/Learning2.jpg" class="img-fluid">
</div>

<div class="col-md-3">
<img src="assets/StudentLearning/Learning1.jpg" class="img-fluid">
</div>

<div class="col-md-3">
<img src="assets/StudentLearning/Learning3.jpg" class="img-fluid">
</div>

<div class="col-md-3">
<img src="assets/StudentLearning/Learning4.jpg" class="img-fluid">
</div>

</div>

</section>

<!-- CALL TO ACTION -->

<section class="cta">

<div class="container">

<h3>Start Your Learning Journey Today</h3>

<p class="mt-2">Join the platform and enhance your skills.</p>

<a href="register.php" class="btn btn-primary btn-lg">Create Account</a>

</div>

</section>

<!-- FOOTER -->

<div class="footer">

© 2026 Student Skill Enhancement | All Rights Reserved

</div>

</body>

</html>