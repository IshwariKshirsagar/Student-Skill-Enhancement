<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$notes_id = intval($_GET['id']);

$qry = $conn->query("
    SELECT 
        n.notes_name,
        n.notes_price,
        n.notes_pdf_link,
        u.name AS owner_name,
        COUNT(snr.student_id) AS total_purchased
    FROM notes n
    JOIN users_database u ON n.notes_owner_id = u.user_id
    LEFT JOIN studentnotesregistered snr 
        ON snr.notes_id = n.notes_id
    WHERE n.notes_id = $notes_id
    GROUP BY n.notes_id
");

if ($qry->num_rows == 0) {
    die("Notes not found.");
}

$data = $qry->fetch_assoc();
$pdf_path = $data['notes_pdf_link'];

if (!file_exists($pdf_path)) {
    die("PDF file not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $data['notes_name']; ?> | Notes PDF</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">

    <style>
        body {
            background: #f4f6f9;
        }
        .info-card {
            background: #fff;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .pdf-container {
            background: #fff;
            border-radius: 6px;
            overflow: hidden;
            height: 80vh;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .pdf-container embed {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>

<body>

<div class="container-fluid mt-3">

<!-- Notes Info -->
<div class="info-card mb-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 font-weight-bold">
            <i class="fa fa-book text-primary mr-2"></i>
            <?php echo $data['notes_name']; ?>
        </h4>
        <a href="index.php?page=notes" class="btn btn-sm btn-outline-secondary">
            ← Back to Notes
        </a>
    </div>

    <div class="row text-center">
    <div class="col-md-4 mb-2">
        <div class="p-2 border rounded bg-light">
            <i class="fa fa-user-tie text-dark"></i>
            <small class="text-muted d-block">Owner</small>
            <div class="font-weight-bold small"><?php echo $data['owner_name']; ?></div>
        </div>
    </div>

    <div class="col-md-4 mb-2">
        <div class="p-2 border rounded bg-light">
            <i class="fa fa-rupee-sign text-success"></i>
            <small class="text-muted d-block">Price</small>
            <div class="font-weight-bold small">₹<?php echo $data['notes_price']; ?></div>
        </div>
    </div>

    <div class="col-md-4 mb-2">
        <div class="p-2 border rounded bg-light">
            <i class="fa fa-users text-info"></i>
            <small class="text-muted d-block">Purchased By</small>
            <div class="font-weight-bold small">
                <?php echo $data['total_purchased']; ?> Students
            </div>
        </div>
    </div>
</div>

    </div>
</div>


    <!-- PDF Viewer -->
    <div class="pdf-container">
        <embed src="<?php echo $pdf_path; ?>" type="application/pdf">
    </div>

</div>

</body>
</html>
