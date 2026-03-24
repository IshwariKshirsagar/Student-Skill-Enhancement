<?php
include 'db_connect.php';

$student_id   = (int)$_SESSION['login_user_id'];
$is_student   = ($_SESSION['login_user_type'] == 3);

// For students: fetch which projects they already purchased
$purchased = [];
if ($is_student) {
    $pRes = $conn->query("SELECT project_id FROM studentprojectregistered WHERE student_id = $student_id");
    while ($p = $pRes->fetch_assoc()) {
        $purchased[] = (int)$p['project_id'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Projects</title>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        #searchInput { border: 1px solid #666; border-radius: 4px; padding: 6px 10px; }
        #searchInput:focus { border-color: #000; box-shadow: none; outline: none; }
    </style>
</head>
<body>

<div class="container-fluid mt-4">
    <div class="card card-outline card-success">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Projects</h4>
            <input type="text" id="searchInput" class="form-control form-control-sm w-25" placeholder="Search projects...">
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="projectsTable">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" onclick="sortTable(0)">Project ID</th>
                            <th class="text-center" onclick="sortTable(1)">Project Name</th>
                            <th class="text-center" onclick="sortTable(2)">Language</th>
                            <th class="text-center" onclick="sortTable(3)">Purchased By</th>
                            <th class="text-center" onclick="sortTable(4)">Price (₹)</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$qry = $conn->query("
    SELECT
        p.project_id, p.project_name, p.project_language,
        p.project_price, p.project_link,
        COUNT(spr.student_id) AS total_purchased
    FROM project p
    LEFT JOIN studentprojectregistered spr ON spr.project_id = p.project_id
    GROUP BY p.project_id
");
while ($row = $qry->fetch_assoc()):
    $already_bought = in_array((int)$row['project_id'], $purchased);
?>
                        <tr>
                            <td class="text-center"><?php echo $row['project_id']; ?></td>
                            <td class="text-center"><?php echo htmlspecialchars($row['project_name']); ?></td>
                            <td class="text-center"><?php echo htmlspecialchars($row['project_language']); ?></td>
                            <td class="text-center"><?php echo $row['total_purchased']; ?> Peoples</td>
                            <td class="text-center">₹<?php echo number_format($row['project_price']); ?></td>
                            <td class="text-center">
                                <?php if (!$is_student || $already_bought): ?>
                                    <!-- Admin / Owner / Already purchased student → direct download -->
                                    <a href="../projects/<?php echo $row['project_link']; ?>"
                                       class="btn btn-sm btn-primary" download>
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                <?php else: ?>
                                    <!-- Student who hasn't purchased → Buy & Download -->
                                    <button class="btn btn-sm btn-success buy_project"
                                        data-projectid="<?php echo $row['project_id']; ?>"
                                        data-projectname="<?php echo htmlspecialchars($row['project_name']); ?>"
                                        data-price="<?php echo (int)$row['project_price']; ?>"
                                        data-link="<?php echo htmlspecialchars($row['project_link']); ?>">
                                        <i class="fa fa-shopping-cart"></i> Buy &amp; Download
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
<?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Razorpay Checkout SDK -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
// 🔍 Live Search
$("#searchInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#projectsTable tbody tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
});

// ↕ Column Sorting
function sortTable(columnIndex) {
    const table = document.getElementById("projectsTable");
    const tbody = table.tBodies[0];
    const rows  = Array.from(tbody.rows);
    const asc   = table.getAttribute("data-sort") !== "asc";
    rows.sort((a, b) => {
        let x = a.cells[columnIndex].innerText.trim();
        let y = b.cells[columnIndex].innerText.trim();
        if (!isNaN(x) && !isNaN(y)) return asc ? x - y : y - x;
        return asc ? x.localeCompare(y) : y.localeCompare(x);
    });
    rows.forEach(row => tbody.appendChild(row));
    table.setAttribute("data-sort", asc ? "asc" : "desc");
}

// 💳 Buy & Download Project with Razorpay
$(document).on('click', '.buy_project', function () {
    const projectId   = $(this).data('projectid');
    const projectName = $(this).data('projectname');
    const projectLink = $(this).data('link');

    $.ajax({
        url: 'operations/create_project_order.php',
        type: 'POST',
        data: { project_id: projectId },
        success: function (raw) {
            let order;
            try { order = typeof raw === 'object' ? raw : JSON.parse(raw); }
            catch(e) { alert('Server error: ' + raw); return; }

            if (order.error) { alert('Error: ' + order.error); return; }

            const options = {
                key:         order.key_id,
                amount:      order.amount,
                currency:    order.currency,
                name:        'Student Skill Enhancement',
                description: 'Purchase: ' + order.project_name,
                order_id:    order.order_id,
                prefill: {
                    name:    order.student_name,
                    email:   order.student_email,
                    contact: order.student_phone
                },
                theme: { color: '#28a745' },
                handler: function (response) {
                    $.ajax({
                        url: 'operations/verify_project_payment.php',
                        type: 'POST',
                        data: {
                            razorpay_order_id:   response.razorpay_order_id,
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_signature:  response.razorpay_signature,
                            project_id:          projectId
                        },
                        success: function (raw2) {
                            let res;
                            try { res = typeof raw2 === 'object' ? raw2 : JSON.parse(raw2); }
                            catch(e) {
                                // Payment went through — trigger download
                                triggerDownload(projectLink);
                                location.reload();
                                return;
                            }
                            if (res.status === 'success' || res.status === 'already_purchased') {
                                alert('Purchase successful! Your download will start now.');
                                triggerDownload(res.project_link || projectLink);
                                location.reload();
                            } else {
                                alert('Payment received but purchase failed. Contact support with Payment ID: ' + response.razorpay_payment_id);
                            }
                        },
                        error: function () {
                            alert('Purchase successful! Your download will start now.');
                            triggerDownload(projectLink);
                            location.reload();
                        }
                    });
                },
                modal: {
                    ondismiss: function () { alert('Payment cancelled.'); }
                }
            };

            const rzp = new Razorpay(options);
            rzp.open();
        },
        error: function (xhr) {
            alert('Payment initiation failed. Server response: ' + xhr.status + ' - ' + xhr.responseText);
        }
    });
});

function triggerDownload(link) {
    const a = document.createElement('a');
    a.href = '../projects/' + link;
    a.download = '';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}
</script>

</body>
</html>
