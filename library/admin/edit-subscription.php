<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {   
    header('location:index.php');
} else { 
    if(isset($_POST['update'])) {
        $subid = $_GET['subid'];
        $sub_name = $_POST['sub_name'];
        $time_period = $_POST['time_period'];
        $charges = $_POST['charges'];
        $description = $_POST['description'];

        // Handling file upload
        if ($_FILES['sub_img']['name']) {
            $sub_img = $_FILES['sub_img']['name'];
            $extension = substr($sub_img, strlen($sub_img) - 4, strlen($sub_img));
            $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");

            // Validate file extension
            if(!in_array($extension, $allowed_extensions)) {
                $_SESSION['error'] = "Invalid file format. Only .jpg, .jpeg, .png, .gif formats are allowed.";
                header('location:manage-subscriptions.php');
                exit();
            }

            // Rename the image file
            $imgnewfile = md5($sub_img . time()) . $extension;
            // Move file to the specified directory
            move_uploaded_file($_FILES["sub_img"]["tmp_name"], "subimages/" . $imgnewfile);
        } else {
            // If no new image uploaded, retain the existing one
            $imgnewfile = $_POST['current_sub_img'];
        }

        // Update database
        $sql = "UPDATE subscription SET sub_name=:sub_name, time_period=:time_period, charges=:charges, description=:description, sub_img=:sub_img WHERE sub_id=:subid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sub_name', $sub_name, PDO::PARAM_STR);
        $query->bindParam(':time_period', $time_period, PDO::PARAM_STR);
        $query->bindParam(':charges', $charges, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':sub_img', $imgnewfile, PDO::PARAM_STR);
        $query->bindParam(':subid', $subid, PDO::PARAM_INT);
        $query->execute();

        $_SESSION['updatemsg'] = "Subscription updated successfully";
        header('location:manage-subscriptions.php');
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Edit Subscription</title>
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
                    <h4 class="header-line">Edit Subscription</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Subscription Info
                        </div>
                        <div class="panel-body">
                            <?php 
                            $subid = $_GET['subid'];
                            $sql = "SELECT * FROM subscription WHERE sub_id=:subid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':subid', $subid, PDO::PARAM_INT);
                            $query->execute();
                            $result = $query->fetch(PDO::FETCH_OBJ);
                            ?>
                            <form role="form" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Subscription Name<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="sub_name" value="<?php echo htmlentities($result->sub_name); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Time Period<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="time_period" value="<?php echo htmlentities($result->time_period); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Charges<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="charges" value="<?php echo htmlentities($result->charges); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Description<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="description" value="<?php echo htmlentities($result->description); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Current Subscription Image</label><br/>
                                    <?php if($result->sub_img): ?>
                                    <img src="subimages/<?php echo htmlentities($result->sub_img); ?>" alt="Subscription Image" width="200">
                                    <?php else: ?>
                                    No Image
                                    <?php endif; ?>
                                    <input type="hidden" name="current_sub_img" value="<?php echo htmlentities($result->sub_img); ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Change Subscription Image</label><br/>
                                    <input type="file" name="sub_img" class="form-control">
                                </div>
                                <button type="submit" name="update" class="btn btn-info">Update</button>
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
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
