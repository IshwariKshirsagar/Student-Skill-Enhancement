<?php
include 'db_connect.php';

$msg = "";

if (isset($_POST['submit'])) {
    $notes_name  = mysqli_real_escape_string($conn, $_POST['notes_name']);
    $notes_price = mysqli_real_escape_string($conn, $_POST['notes_price']);
    $owner_id    = $_SESSION['login_user_id'];

    $file     = $_FILES['notes_pdf']['name'];
    $tmp      = $_FILES['notes_pdf']['tmp_name'];
    $folder   = "../notes/";
    $filename = time() . "_" . $file;

    if (move_uploaded_file($tmp, $folder . $filename)) {
        $conn->query("
            INSERT INTO notes (notes_owner_id, notes_name, notes_price, notes_pdf_link)
            VALUES ('$owner_id', '$notes_name', '$notes_price', '$filename')
        ");
        $msg = "success";
    } else {
        $msg = "error";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Notes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .notes-form-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.10);
            max-width: 600px;
            margin: 40px auto;
        }

        .notes-form-card .card-header {
            background: linear-gradient(135deg, #28a745, #20c997);
            border-radius: 16px 16px 0 0;
            padding: 24px 28px 20px;
            border: none;
        }

        .notes-form-card .card-header h4 {
            color: #fff;
            font-weight: 700;
            font-size: 20px;
            margin: 0;
        }

        .notes-form-card .card-header p {
            color: rgba(255,255,255,0.80);
            font-size: 13px;
            margin: 4px 0 0;
        }

        .notes-form-card .card-body {
            padding: 28px;
        }

        .form-group label {
            font-weight: 600;
            font-size: 13px;
            color: #444;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .form-group .form-control {
            border: 1.5px solid #dee2e6;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 14px;
            color: #333;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-shadow: none;
        }

        .form-group .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 3px rgba(40,167,69,0.12);
        }

        .file-upload-box {
            border: 2px dashed #ced4da;
            border-radius: 8px;
            padding: 18px 14px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            background: #fafafa;
            position: relative;
        }

        .file-upload-box:hover {
            border-color: #28a745;
            background: #f0fff4;
        }

        .file-upload-box input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .file-upload-box i {
            font-size: 28px;
            color: #adb5bd;
            display: block;
            margin-bottom: 6px;
        }

        .file-upload-box .file-upload-text {
            font-size: 13px;
            color: #888;
        }

        .file-upload-box .file-name {
            font-size: 13px;
            color: #28a745;
            font-weight: 600;
            margin-top: 4px;
        }

        .btn-upload {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 10px 28px;
            border-radius: 8px;
            font-size: 14px;
            transition: opacity 0.2s;
        }

        .btn-upload:hover {
            opacity: 0.88;
            color: #fff;
        }

        .btn-cancel {
            border: 1.5px solid #ced4da;
            background: #fff;
            color: #555;
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 8px;
            font-size: 14px;
            transition: background 0.2s;
        }

        .btn-cancel:hover {
            background: #f1f1f1;
            color: #333;
        }

        .alert {
            border-radius: 8px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card notes-form-card">

        <div class="card-header">
            <h4><i class="fa fa-file-alt mr-2"></i> Add New Notes</h4>
            <p>Fill in the details below to upload your notes.</p>
        </div>

        <div class="card-body">

            <?php if ($msg === "success"): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fa fa-check-circle mr-1"></i> Notes uploaded successfully!
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php elseif ($msg === "error"): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fa fa-times-circle mr-1"></i> Upload failed. Please try again.
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">

                <!-- Notes Name -->
                <div class="form-group">
                    <label><i class="fa fa-book mr-1 text-success"></i> Notes Name</label>
                    <input type="text"
                        name="notes_name"
                        class="form-control"
                        placeholder="e.g. Java Programming Notes"
                        required>
                </div>

                <!-- Price -->
                <div class="form-group">
                    <label><i class="fa fa-tag mr-1 text-success"></i> Price (₹)</label>
                    <input type="number"
                        name="notes_price"
                        class="form-control"
                        placeholder="e.g. 299"
                        min="0"
                        required>
                </div>

                <!-- PDF Upload -->
                <div class="form-group">
                    <label><i class="fa fa-file-pdf mr-1 text-success"></i> Upload PDF</label>
                    <div class="file-upload-box" id="fileUploadBox">
                        <input type="file"
                            name="notes_pdf"
                            id="pdfInput"
                            accept="application/pdf"
                            required>
                        <i class="fa fa-cloud-upload-alt"></i>
                        <div class="file-upload-text">Click or drag &amp; drop your PDF here</div>
                        <div class="file-name" id="fileName">No file chosen</div>
                    </div>
                </div>

                <hr class="mt-4">

                <div class="d-flex justify-content-end" style="gap: 10px;">
                    <a href="index.php?page=notes" class="btn btn-cancel">
                        Cancel
                    </a>
                    <button type="submit" name="submit" class="btn btn-upload">
                        <i class="fa fa-upload mr-1"></i> Upload Notes
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
// Show selected file name
document.getElementById('pdfInput').addEventListener('change', function () {
    const name = this.files[0] ? this.files[0].name : 'No file chosen';
    document.getElementById('fileName').textContent = name;
    const box = document.getElementById('fileUploadBox');
    box.style.borderColor = this.files[0] ? '#28a745' : '#ced4da';
    box.style.background  = this.files[0] ? '#f0fff4' : '#fafafa';
});
</script>

</body>
</html>
