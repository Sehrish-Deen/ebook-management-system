<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
    header('location:index.php');
}
else { 
    if(isset($_GET['del']))
    {
        $id = $_GET['del'];
        $sql = "DELETE FROM competitions WHERE Competition_ID=:id";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':id', $id, PDO::PARAM_STR);
        $query -> execute();
        $_SESSION['delmsg'] = "Competition deleted successfully";
        header('location:manage-competitions.php'); // Redirect to the same page after deletion
        exit(); // Ensure no further code is executed after redirect
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Manage Competitions</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <!-- MENU SECTION START-->
    <?php include('includes/header.php');?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Manage Competitions</h4>
                </div>
            </div>
            <div class="row">
                <?php if(isset($_SESSION['error']) && $_SESSION['error']!="") { ?>
                <div class="col-md-6">
                    <div class="alert alert-danger">
                        <strong>Error :</strong> 
                        <?php echo htmlentities($_SESSION['error']);?>
                        <?php $_SESSION['error']=""; // Clear the session variable ?>
                    </div>
                </div>
                <?php } ?>
                <?php if(isset($_SESSION['msg']) && $_SESSION['msg']!="") { ?>
                <div class="col-md-6">
                    <div class="alert alert-success">
                        <strong>Success :</strong> 
                        <?php echo htmlentities($_SESSION['msg']);?>
                        <?php $_SESSION['msg']=""; // Clear the session variable ?>
                    </div>
                </div>
                <?php } ?>
                <?php if(isset($_SESSION['updatemsg']) && $_SESSION['updatemsg']!="") { ?>
                <div class="col-md-6">
                    <div class="alert alert-success">
                        <strong>Success :</strong> 
                        <?php echo htmlentities($_SESSION['updatemsg']);?>
                        <?php $_SESSION['updatemsg']=""; // Clear the session variable ?>
                    </div>
                </div>
                <?php } ?>
                <?php if(isset($_SESSION['delmsg']) && $_SESSION['delmsg']!="") { ?>
                <div class="col-md-6">
                    <div class="alert alert-success">
                        <strong>Success :</strong> 
                        <?php echo htmlentities($_SESSION['delmsg']);?>
                        <?php $_SESSION['delmsg']=""; // Clear the session variable ?>
                    </div>
                </div>
                <?php } ?>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Competitions Listing
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Competition Type</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $sql = "SELECT * from competitions";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if($query->rowCount() > 0) {
                                            foreach($results as $result) { ?>                                      
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($result->Title);?></td>
                                            <td class="center"><?php echo htmlentities($result->Description);?></td>
                                            <td class="center"><?php echo htmlentities($result->StartDate);?></td>
                                            <td class="center"><?php echo htmlentities($result->EndDate);?></td>
                                            <td class="center"><?php echo htmlentities($result->Competition_Type);?></td>
                                            <td class="center">
                                                <?php if($result->comp_img): ?>
                                                <img src="uploads/books/<?php echo htmlentities($result->comp_img); ?>" alt="Competition Image" width="100">
                                                <?php else: ?>
                                                No Image
                                                <?php endif; ?>
                                            </td>
                                            <td class="center">
                                                <?php if($result->status=='active') {?>
                                                <a href="#" class="btn btn-success btn-xs">Active</a>
                                                <?php } else {?>
                                                <a href="#" class="btn btn-danger btn-xs">Completed</a>
                                                <?php } ?>
                                            </td>
                                            <td class="center">
                                                <a href="edit-competition.php?compid=<?php echo htmlentities($result->Competition_ID);?>">
                                                    <button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> 
                                                </a>
                                                <a href="manage-competitions.php?del=<?php echo htmlentities($result->Competition_ID);?>" onclick="return confirm('Are you sure you want to delete?');">  
                                                    <button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $cnt = $cnt + 1; } } ?>                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
