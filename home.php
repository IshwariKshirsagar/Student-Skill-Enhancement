<?php include "db_connect.php"; ?>
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" onclick="location.href='./index.php?page=event'">
            <div class="card">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <?php if($_SESSION['login_user_type'] == 1){ $sql = "SELECT count(*) as total_course FROM course_database"; }else { $sql = "SELECT count(*) as total_course FROM course_database WHERE event_organizer_id=".$_SESSION['login_user_id']; } $result = $conn->query($sql); $row = $result->fetch_assoc(); $totalCourse = $row['total_course']; ?>
                            <p class="text-sm mb-0 text-capitalize">Total Courses Enrolled</p>
                            <h4 class="mb-0"><?php echo $totalCourse; ?></h4>
                        </div>
                        <div
                            class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">weekend</i>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+55% </span>than last week</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card" onclick="location.href='./index.php?page=list_user'">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between">
                        <?php $sql = "SELECT count(*) as total_course FROM course_database"; $result = $conn->query($sql); $row = $result->fetch_assoc(); $totalCourse = $row['total_course']; ?>
                        <div>
                            <p class="text-sm mb-0 text-capitalize">Total Courses Completed</p>
                            <h4 class="mb-0"> <?php if($totalCourse==0){ echo "0"; }else{ echo $totalCourse; } ?> </h4>
                        </div>
                        <div
                            class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">leaderboard</i>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+3% </span>than last month</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card" onclick="location.href='./index.php?page=event'">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <?php if($_SESSION['login_user_type'] == 1){ $sql = "SELECT count(name) as total_user FROM users_database"; }  
                            else{  
                                $sql = "SELECT count(name) as total_user FROM users_database WHERE event_organizer_id=".$_SESSION['login_user_id']; 
                                } $result = $conn->query($sql); 
                                $row = $result->fetch_assoc(); 
                                $totalUsers = $row['total_user']; 
                            ?>
                            <p class="text-sm mb-0 text-capitalize">Total Users</p>
                            <h4 class="mb-0"> <?php if($totalUsers==0){ echo "0"; }else{ echo $totalUsers; } ?> </h4>
                        </div>
                        <div
                            class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">person</i>

                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+5% </span>than yesterday</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card" onclick="location.href='./index.php?page=event'">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <?php if($_SESSION['login_user_type'] == 1){ $sql = "SELECT count(course_type_name) as total_course_type FROM course_type"; } 
                            else { 
                                 $sql = "SELECT count(course_type_name) as total_course_type FROM course_type WHERE event_organizer_id=".$_SESSION['login_user_id'];  } 
                                 $result = $conn->query($sql); 
                                 $row = $result->fetch_assoc(); 
                                 $totalCourseType = $row['total_course_type']; ?>
                            <p class="text-sm mb-0 text-capitalize">Total Course Type</p>
                            <h4 class="mb-0"><?php if($totalCourseType==0){ echo "0"; }else{ echo $totalCourseType; } ?>
                            </h4>
                        </div>
                        <div
                            class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">weekend</i>

                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder">-2% </span>than yesterday</p>
                </div>
            </div>
        </div>

    </div>
    <div class="row mb-4 mt-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Courses</h6>
                            <p class="text-sm mb-0">
                                <?php if ($_SESSION['login_user_type'] == 1) { 
                                    $sql = "SELECT COUNT(*) AS total_course FROM course_database"; 
                                    } 
                                    else { 
                                        $sql = "SELECT COUNT(*) AS total_course FROM course_database WHERE course_owner = " . $_SESSION['login_user_id']; 
                                    } 
                                    $result = $conn->query($sql); 
                                    $row = $result->fetch_assoc(); 
                                    $totalCourses = $row['total_course']; 
                                ?>
                                <i class="fa fa-check text-info"></i> <span class="font-weight-bold ms-1">
                                    <?php echo $totalCourses; ?> Registered </span> till now
                            </p>
                        </div>
                    </div>
                </div> <?php if ($totalCourses > 0): ?> <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                        <table id="sortableTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th onclick="sortTable(0)"
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> ID
                                    </th>
                                    <th onclick="sortTable(1)"
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Name </th>
                                    <th onclick="sortTable(2)"
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Type </th>
                                    <th onclick="sortTable(3)"
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Owner </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if ($_SESSION['login_user_type'] == 1) { 
                                        $qry = $conn->query(" SELECT cd.course_id, cd.course_name, ct.course_type_name, u.name AS owner_name FROM course_database cd JOIN course_type ct ON cd.course_type = ct.course_type_id JOIN users_database u ON cd.course_owner = u.user_id "); 
                                    } 
                                    else { 
                                        $qry = $conn->query(" SELECT cd.course_id, cd.course_name, ct.course_type_name, u.name AS owner_name FROM course_database cd JOIN course_type ct ON cd.course_type = ct.course_type_id JOIN users_database u ON cd.course_owner = u.user_id WHERE cd.course_owner = " . $_SESSION['login_user_id'] ); 
                                    } 
                                        while ($row = $qry->fetch_assoc()): 
                                ?>
                                <tr>
                                    <!-- ID -->
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <h6 class="mb-0 text-sm">

                                                <?php
                                                    $num = $row['course_id'];
                                                    $temp = $num;
                                                    $count = 0;

                                                    /* Count digits */
                                                    if ($temp == 0) {
                                                        $count = 1;
                                                    } else {
                                                        while ($temp != 0) {
                                                            $temp = (int)($temp / 10);
                                                            $count++;
                                                        }
                                                    }

                                                    /* Conditions */
                                                    if ($count == 1) {
                                                        echo "00" . $row['course_id'];
                                                    } elseif ($count == 2) {
                                                        echo "0" . $row['course_id'];
                                                    } else {
                                                        echo $row['course_id'];
                                                    }
                                                ?>
                                            </h6>
                                        </div>
                                    </td> <!-- Course Name -->
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <h6 class="mb-0 text-sm"> <?php echo $row['course_name']; ?> </h6>
                                        </div>
                                    </td> <!-- Course Type -->
                                    <td class="align-middle text-center text-sm"> <span
                                            class="text-xs font-weight-bold"> <?php echo $row['course_type_name']; ?>
                                        </span> </td> <!-- Course Owner -->
                                    <td class="align-middle text-center text-sm"> <span
                                            class="text-xs font-weight-bold"> <?php echo $row['owner_name']; ?> </span>
                                    </td>
                                </tr> <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div> <?php else: ?> <div class="card-body p-3">
                    <div class="text-center">
                        <h6 class="text-muted">No events found</h6>
                    </div>
                </div> <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>Orders overview</h6>
                    <p class="text-sm"> <i class="fa fa-arrow-up text-success" aria-hidden="true"></i> <span
                            class="font-weight-bold">24%</span> this month </p>
                </div>
                <div class="card-body p-3">
                    <div class="timeline timeline-one-side">
                        <div class="timeline-block mb-3"> <span class="timeline-step"> <i
                                    class="material-symbols-rounded text-success text-gradient">notifications</i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">$2400, Design changes</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3"> <span class="timeline-step"> <i
                                    class="material-symbols-rounded text-danger text-gradient">code</i> </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">New order #1832412</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 11 PM</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3"> <span class="timeline-step"> <i
                                    class="material-symbols-rounded text-info text-gradient">shopping_cart</i> </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Server payments for April</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 9:34 PM</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3"> <span class="timeline-step"> <i
                                    class="material-symbols-rounded text-warning text-gradient">credit_card</i> </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">New card added for order #4395133
                                </h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3"> <span class="timeline-step"> <i
                                    class="material-symbols-rounded text-primary text-gradient">key</i> </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Unlock packages for development</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 DEC 4:54 AM</p>
                            </div>
                        </div>
                        <div class="timeline-block"> <span class="timeline-step"> <i
                                    class="material-symbols-rounded text-dark text-gradient">payments</i> </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">New order #9583120</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">17 DEC</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
function sortTable(columnIndex) {
    const table = document.getElementById("sortableTable");
    const tbody = table.tBodies[0];
    const rows = Array.from(tbody.rows);

    const isAscending = table.getAttribute("data-sort") !== "asc";

    rows.sort((a, b) => {
        let A = a.cells[columnIndex].innerText.trim().toLowerCase();
        let B = b.cells[columnIndex].innerText.trim().toLowerCase();

        if (!isNaN(A) && !isNaN(B)) {
            return isAscending ? A - B : B - A;
        }

        if (A < B) return isAscending ? -1 : 1;
        if (A > B) return isAscending ? 1 : -1;
        return 0;
    });

    rows.forEach(row => tbody.appendChild(row));
    table.setAttribute("data-sort", isAscending ? "asc" : "desc");
}
</script>