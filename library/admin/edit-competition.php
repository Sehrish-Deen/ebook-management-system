<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['update'])) {
        $compid = $_GET['compid'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $competition_type = $_POST['competition_type'];

        // Handling file upload
        if ($_FILES['comp_img']['name']) {
            $comp_img = $_FILES['comp_img']['name'];
            $extension = substr($comp_img, strlen($comp_img) - 4, strlen($comp_img));
            $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");

            // Validate file extension
            if (!in_array($extension, $allowed_extensions)) {
                $_SESSION['error'] = "Invalid file format. Only .jpg, .jpeg, .png, .gif formats are allowed.";
                header('location:manage-competitions.php');
                exit();
            }

            // Rename the image file
            $imgnewfile = md5($comp_img . time()) . $extension;
            // Move file to the specified directory
            move_uploaded_file($_FILES["comp_img"]["tmp_name"], "uploads/books/" . $imgnewfile);
        } else {
            // If no new image uploaded, retain the existing one
            $imgnewfile = $_POST['current_comp_img'];
        }

        // Update database
        $sql = "UPDATE competitions SET Title=:title, Description=:description, StartDate=:start_date, EndDate=:end_date, Competition_Type=:competition_type, comp_img=:comp_img WHERE Competition_ID=:compid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $query->bindParam(':end_date', $end_date, PDO::PARAM_STR);
        $query->bindParam(':competition_type', $competition_type, PDO::PARAM_STR);
        $query->bindParam(':comp_img', $imgnewfile, PDO::PARAM_STR);
        $query->bindParam(':compid', $compid, PDO::PARAM_INT);
        $query->execute();

        $_SESSION['updatemsg'] = "Competition updated successfully";
        header('location:manage-competitions.php');
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Edit Competition</title>
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
                    <h4 class="header-line">Edit Competition</h4>
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
                            $compid = $_GET['compid'];
                            $sql = "SELECT * FROM competitions WHERE Competition_ID=:compid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':compid', $compid, PDO::PARAM_INT);
                            $query->execute();
                            $result = $query->fetch(PDO::FETCH_OBJ);
                            ?>
                            <form role="form" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Title<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="title" value="<?php echo htmlentities($result->Title); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Description<span style="color:red;">*</span></label>
                                    <textarea class="form-control" name="description" required><?php echo htmlentities($result->Description); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Start Date<span style="color:red;">*</span></label>
                                    <input type="date" class="form-control" name="start_date" value="<?php echo htmlentities($result->StartDate); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>End Date<span style="color:red;">*</span></label>
                                    <input type="date" class="form-control" name="end_date" value="<?php echo htmlentities($result->EndDate); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Competition Type<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="competition_type" value="<?php echo htmlentities($result->Competition_Type); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Current Competition Image</label><br/>
                                    <?php if($result->comp_img): ?>
                                    <img src="uploads/books/<?php echo htmlentities($result->comp_img); ?>" alt="Competition Image" width="200">
                                    <?php else: ?>
                                    No Image
                                    <?php endif; ?>
                                    <input type="hidden" name="current_comp_img" value="<?php echo htmlentities($result->comp_img); ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Change Competition Image</label><br/>
                                    <input type="file" name="comp_img" class="form-control">
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
