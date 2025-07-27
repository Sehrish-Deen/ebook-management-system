<?php
session_start();
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
    exit(); // Ensure script stops execution after redirect
}

if (isset($_POST['btnSubmit'])) {
    $title = $_POST['Title'];
    $description = $_POST['Description'];
    $start_date = $_POST['StartDate'];
    $end_date = $_POST['EndDate'];
    $competition_type = $_POST['Competition_Type'];

    // Handling file uploads
    $comp_img = $_FILES['comp_img']['name'];
    $target_dir = "uploads/books/";

    // Check if the directory exists, if not, create it
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if ($comp_img) {
        $target_file_img = $target_dir . basename($comp_img);
        if (!move_uploaded_file($_FILES['comp_img']['tmp_name'], $target_file_img)) {
            $_SESSION['error'] = "Error uploading the image. Please try again.";
            header('location:add-competition.php');
            exit();
        }
    }

    // Insert into database
    $sql = "INSERT INTO competitions (Title, comp_img, Description, StartDate, EndDate, Competition_Type) 
            VALUES (:title, :comp_img, :description, :start_date, :end_date, :competition_type)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':comp_img', $comp_img, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);
    $query->bindParam(':start_date', $start_date, PDO::PARAM_STR);
    $query->bindParam(':end_date', $end_date, PDO::PARAM_STR);
    $query->bindParam(':competition_type', $competition_type, PDO::PARAM_STR);
    $query->execute();

    $_SESSION['message'] = "Competition added successfully";
    header('location:manage-competitions.php');
    exit(); // Ensure script stops execution after redirect
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Add Competition</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <!-- MENU SECTION START -->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END -->

    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Add Competition</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Competition Info
                        </div>
                        <div class="panel-body">
                            <?php
                            if (isset($_SESSION['message'])) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        '.$_SESSION['message'].'
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      </div>';
                                unset($_SESSION['message']);
                            }
                            if (isset($_SESSION['error'])) {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        '.$_SESSION['error'].'
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      </div>';
                                unset($_SESSION['error']);
                            }
                            ?>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label">Title:<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="Title" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Image:<span style="color:red;">*</span></label>
                                    <input type="file" name="comp_img" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description:<span style="color:red;">*</span></label>
                                    <textarea name="Description" class="form-control" rows="2" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Start Date:<span style="color:red;">*</span></label>
                                    <input type="date" class="form-control" name="StartDate" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">End Date:<span style="color:red;">*</span></label>
                                    <input type="date" class="form-control" name="EndDate" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Competition Type:<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="Competition_Type" required>
                                </div>
                                <button type="submit" name="btnSubmit" class="btn btn-info">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END -->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END -->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
