<?php
include 'db_connect.php';

$msg = "";

if(isset($_POST['submit'])){

    $notes_name = mysqli_real_escape_string($conn,$_POST['notes_name']);
    $notes_price = mysqli_real_escape_string($conn,$_POST['notes_price']);
    $owner_id = $_SESSION['login_user_id'];

    $file = $_FILES['notes_pdf']['name'];
    $tmp = $_FILES['notes_pdf']['tmp_name'];

    $folder = "../notes/";
    $filename = time()."_".$file;

    if(move_uploaded_file($tmp,$folder.$filename)){

        $conn->query("
            INSERT INTO notes
            (notes_owner_id,notes_name,notes_price,notes_pdf_link)
            VALUES
            ('$owner_id','$notes_name','$notes_price','$filename')
        ");

        $msg = "<div class='alert alert-success'>Notes uploaded successfully!</div>";

    }else{

        $msg = "<div class='alert alert-danger'>Upload failed!</div>";

    }

}
?>

<style>

/* Light borders for inputs */

.form-control,
input[type="file"],
.input-group-text{
border:1px solid #dcdcdc !important;
box-shadow:none !important;
}

.form-control:focus{
border-color:#bfbfbf !important;
box-shadow:none !important;
}

/* Card style */

.notes-card{
border-radius:10px;
border:1px solid #e4e4e4;
}

.notes-header{
font-weight:600;
font-size:18px;
}

.upload-btn{
padding:8px 18px;
font-weight:500;
}

</style>

<div class="container-fluid py-3">

<div class="card notes-card shadow-sm">

<div class="card-header bg-white border-bottom notes-header">
<i class="material-symbols-rounded opacity-5">note_add</i>
Add New Notes
</div>

<div class="card-body">

<?php echo $msg; ?>

<form method="POST" enctype="multipart/form-data">

<div class="row">

<!-- Notes Name -->
<div class="col-md-12 mb-3">

<label class="form-label">Notes Name</label>

<div class="input-group">

<span class="input-group-text">
<i class="material-symbols-rounded opacity-5">description</i>
</span>

<input type="text"
name="notes_name"
class="form-control"
placeholder="Enter notes title"
required>

</div>

</div>

<!-- Notes Price -->
<div class="col-md-6 mb-3">

<label class="form-label">Notes Price</label>

<div class="input-group">

<span class="input-group-text">₹</span>

<input type="number"
name="notes_price"
class="form-control"
placeholder="Enter price"
required>

</div>

</div>

<!-- Upload PDF -->
<div class="col-md-6 mb-3">

<label class="form-label">Upload Notes PDF</label>

<input type="file"
name="notes_pdf"
class="form-control"
accept="application/pdf"
required>

</div>

</div>

<button type="submit"
name="submit"
class="btn btn-success upload-btn">

<i class="material-symbols-rounded align-middle">upload</i>
Upload Notes

</button>

</form>

</div>

</div>

</div>