<style>
    #sortableTable {
        border-radius: 10px;
        overflow: hidden; /* IMPORTANT for rounded corners */
        background-color: #ffffff;
    }

    #sortableTable th,
    #sortableTable td {
        background-color: #ffffff;
    }
</style>


<div class="table-responsive">
    <?php
if ($_SESSION['login_user_type'] == 1) { 
    $qry = $conn->query("
        SELECT 
            cd.course_id,
            cd.course_name,
            ct.course_type_name,
            u.name AS owner_name
        FROM course_database cd
        JOIN course_type ct ON cd.course_type = ct.course_type_id
        JOIN users_database u ON cd.course_owner = u.user_id
    ");
} else { 
    $qry = $conn->query("
        SELECT 
            cd.course_id,
            cd.course_name,
            ct.course_type_name,
            u.name AS owner_name
        FROM course_database cd
        JOIN course_type ct ON cd.course_type = ct.course_type_id
        JOIN users_database u ON cd.course_owner = u.user_id
        WHERE cd.course_owner = " . $_SESSION['login_user_id']
    );
}
?>
<div class="card-header">
            <div class="card-tools">
                <a class="btn btn-block btn-sm btn-primary btn-flat" href="./index.php?page=new_course">
                    <i class="fa fa-plus"></i> Add New Course
                </a>
            </div>
        </div>
    <table class="table table-hover table-bordered bg-white" id="sortableTable">
        <thead class="thead-light text-center">
            <tr>
                <th onclick="sortTable(0)">Course ID</th>
                <th onclick="sortTable(1)">Course Name</th>
                <th onclick="sortTable(2)">Course Type</th>
                <th onclick="sortTable(3)">Course Owner</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody class="text-center">
            <?php while ($row = $qry->fetch_assoc()): ?>
            <tr>
                <td>
                    <?php
                        $num = $row['course_id'];
                        $temp = $num;
                        $count = 0;

                        if ($temp == 0) {
                            $count = 1;
                        } else {
                            while ($temp != 0) {
                                $temp = (int)($temp / 10);
                                $count++;
                            }
                        }

                        if ($count == 1) {
                            echo "00" . $row['course_id'];
                        } elseif ($count == 2) {
                            echo "0" . $row['course_id'];
                        } else {
                            echo $row['course_id'];
                        }
                    ?>
                </td>

                <td><b><?php echo $row['course_name']; ?></b></td>

                <td><b><?php echo $row['course_type_name']; ?></b></td>

                <td><b><?php echo $row['owner_name']; ?></b></td>

                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-danger delete_user"
                        data-id="<?php // echo $row['course_id']; ?>">
                        Delete
                    </button>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
