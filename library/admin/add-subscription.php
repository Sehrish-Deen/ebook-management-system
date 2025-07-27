<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin']) == 0) {   
    header('location:index.php');
} else { 

if(isset($_POST['btnSubmit'])) {
    $sub_name = $_POST['sub_name'];
    $time_period = $_POST['time_period'];
    $charges = $_POST['charges'];
    $description = $_POST['description'];

    // Handling file upload
    $sub_img = $_FILES['sub_img']['name'];
    $extension = substr($sub_img, strlen($sub_img) - 4, strlen($sub_img));
    $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");

    // Validate file extension
    if(!in_array($extension, $allowed_extensions)) {
        $_SESSION['error'] = "Invalid file format. Only .jpg, .jpeg, .png, .gif formats are allowed.";
        header('location:manage-subscriptions.php');
    } else {
        // Rename the image file
        $imgnewfile = md5($sub_img . time()) . $extension;
        // Move file to the specified directory
        move_uploaded_file($_FILES["sub_img"]["tmp_name"], "subimages/" . $imgnewfile);

        // Insert into database
        $sql = "INSERT INTO subscription(sub_name, time_period, charges, description, sub_img) VALUES(:sub_name, :time_period, :charges, :description, :sub_img)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sub_name', $sub_name, PDO::PARAM_STR);
        $query->bindParam(':time_period', $time_period, PDO::PARAM_STR);
        $query->bindParam(':charges', $charges, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':sub_img', $imgnewfile, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if($lastInsertId) {
            $_SESSION['msg'] = "Subscription added successfully";
            header('location:manage-subscriptions.php');
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
            header('location:manage-subscriptions.php');
        }
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Add Subscription</title>
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
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->

    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Add Subscription</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Subscription Info
                        </div>
                        <div class="panel-body">
                            <form role="form" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Subscription Name<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="sub_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Time Period<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="time_period" required>
                                </div>
                                <div class="form-group">
                                    <label>Charges<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="charges" required>
                                </div>
                                <div class="form-group">
                                    <label>Description<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="description" required>
                                </div>
                                <div class="form-group">
                                    <label>Subscription Image<span style="color:red;">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" name="sub_img" class="custom-file-input" required>
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                                <button type="submit" name="btnSubmit" class="btn btn-info">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME-->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
