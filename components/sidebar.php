<?php
$current_page = $_GET['page'] ?? 'home';
?>

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2"
    id="sidenav-main">

    <div class="sidenav-header">
        <a class="navbar-brand px-4 py-3 m-0" href="#">
            <img src="assets/img/favicon.png" class="navbar-brand-img" width="26" height="26">

            <?php if($_SESSION['login_user_type'] == 1): ?>
            <span class="ms-1 text-sm text-dark">ADMIN</span>
            <?php elseif($_SESSION['login_user_type'] == 2): ?>
            <span class="ms-1 text-sm text-dark">COURSE OWNER</span>
            <?php elseif($_SESSION['login_user_type'] == 3): ?>
            <span class="ms-1 text-sm text-dark">STUDENT</span>
            <?php endif; ?>
        </a>
    </div>

    <hr class="horizontal dark mt-0 mb-2">

    <div class="collapse navbar-collapse w-auto">
        <ul class="navbar-nav">

            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link <?= ($current_page == 'home') ? 'active bg-gradient-dark text-white' : 'text-dark' ?>"
                    href="index.php?page=home">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <?php if($_SESSION['login_user_type'] == 1): ?>

            <li class="nav-item">
                <a class="nav-link <?= ($current_page == 'list_user' || $current_page == 'new_user') ? 'active bg-gradient-dark text-white' : 'text-dark' ?>"
                    href="index.php?page=list_user">
                    <i class="material-symbols-rounded opacity-5">list</i>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
            </li>

            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link <?= ($current_page == 'notes' || $current_page == 'view_notes_pdf' || $current_page == 'new_notes') ? 'active bg-gradient-dark text-white' : 'text-dark' ?>"
                    href="index.php?page=notes">
                    <i class="material-symbols-rounded opacity-5">menu_book</i>
                    <span class="nav-link-text ms-1">Notes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($current_page == 'projects') ? 'active bg-gradient-dark text-white' : 'text-dark' ?>"
                    href="index.php?page=projects">
                    <i class="material-symbols-rounded opacity-5">school</i>
                    <span class="nav-link-text ms-1">Projects</span>
                </a>
            </li>

            <?php if($_SESSION['login_user_type'] == 3): ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'courses') ? 'active bg-gradient-dark text-white' : 'text-dark' ?>"
                        href="index.php?page=courses">
                        <i class="material-symbols-rounded opacity-5">library_add</i>
                        <span class="nav-link-text ms-1">Enroll</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'enrolled_courses') ? 'active bg-gradient-dark text-white' : 'text-dark' ?>"
                        href="index.php?page=enrolled_courses">
                        <i class="material-symbols-rounded opacity-5">list</i>
                        <span class="nav-link-text ms-1">Enrolled Courses</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($_SESSION['login_user_type'] == 1 || $_SESSION['login_user_type'] == 2): ?>

            <li class="nav-item">
                <a class="nav-link <?= ($current_page == 'course' || $current_page == 'new_course') ? 'active bg-gradient-dark text-white' : 'text-dark' ?>"
                    href="index.php?page=course">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Courses</span>
                </a>
            </li>

            <?php endif; ?>

            <?php if($_SESSION['login_user_type'] == 2): ?>

            <li class="nav-item">
                <a class="nav-link <?= ($current_page == 'new_course') ? 'active bg-gradient-dark text-white' : 'text-dark' ?>"
                    href="index.php?page=new_course">
                    <i class="material-symbols-rounded opacity-5">add_box</i>
                    <span class="nav-link-text ms-1">Add Course</span>
                </a>
            </li>

            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link <?= ($current_page == 'Q-A') ? 'active bg-gradient-dark text-white' : 'text-dark' ?>"
                    href="index.php?page=Q-A">
                    <i class="material-symbols-rounded opacity-5">chat</i>
                    <span class="nav-link-text ms-1">CHAT / Q&A</span>
                </a>
            </li>

            <?php if($_SESSION['login_user_type'] == 1): ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'send_notifications') ? 'active bg-gradient-dark text-white' : 'text-dark' ?>"
                        href="index.php?page=send_notifications">
                        <i class="material-symbols-rounded opacity-5">notifications</i>
                        <span class="nav-link-text ms-1">Send Notifications</span>
                    </a>
                </li>
            <?php endif; ?>
            
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark opacity-5">Account Pages</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= ($current_page == 'profile') ? 'active bg-gradient-dark text-white' : 'text-dark' ?>"
                    href="index.php?page=profile">
                    <i class="material-symbols-rounded opacity-5">person</i>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="logout.php">
                    <i class="material-symbols-rounded opacity-5">logout</i>
                    <span class="nav-link-text ms-1">Log Out</span>
                </a>
            </li>

        </ul>
    </div>

    <div class="sidenav-footer position-absolute w-100 bottom-0">
        <div class="mx-3">
            <a class="btn btn-outline-dark mt-4 w-100" href="index.php?page=developers">
                Developers
            </a>
            <a class="btn bg-gradient-dark w-100" href="index.php?page=razorpay">
                DONATE USING RAZORPAY
            </a>
        </div>
    </div>

</aside>