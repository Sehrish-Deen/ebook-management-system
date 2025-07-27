<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {   
    header('location:index.php');
} else { 


    $q = "SELECT * FROM `competitions`";
    $run = mysqli_query($conn,$q);
    



    ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Manage Subscriptions</title>
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
    <!------MENU SECTION START-->
    <?php include('includes/header.php');?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Manage Subscriptions</h4>
                </div>
            </div>
            <div class="row">
                <?php if($_SESSION['error']!="") { ?>
                <div class="col-md-6">
                    <div class="alert alert-danger">
                        <strong>Error :</strong> 
                        <?php echo htmlentities($_SESSION['error']);?>
                        <?php echo htmlentities($_SESSION['error']="");?>
                    </div>
                </div>
                <?php } ?>
                <?php if($_SESSION['msg']!="") { ?>
                <div class="col-md-6">
                    <div class="alert alert-success">
                        <strong>Success :</strong> 
                        <?php echo htmlentities($_SESSION['msg']);?>
                        <?php echo htmlentities($_SESSION['msg']="");?>
                    </div>
                </div>
                <?php } ?>
                <?php if($_SESSION['updatemsg']!="") { ?>
                <div class="col-md-6">
                    <div class="alert alert-success">
                        <strong>Success :</strong> 
                        <?php echo htmlentities($_SESSION['updatemsg']);?>
                        <?php echo htmlentities($_SESSION['updatemsg']="");?>
                    </div>
                </div>
                <?php } ?>
                <?php if($_SESSION['delmsg']!="") { ?>
                <div class="col-md-6">
                    <div class="alert alert-success">
                        <strong>Success :</strong> 
                        <?php echo htmlentities($_SESSION['delmsg']);?>
                        <?php echo htmlentities($_SESSION['delmsg']="");?>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <table class="table table-bordered">
  <thead class="table-primary table-bordered">
    <tr>
      <th scope="col">Competition ID</th>
      <th scope="col">Title</th>
      <th scope="col">Image</th>
      <th scope="col">Description</th>
      <th scope="col">Start Date</th>
      <th scope="col">End Date</th>
      <th scope="col">Competition Type</th>
      <th scope="col">Status</th>

      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>
 <?php while ($row = mysqli_fetch_array($run)) {?>
       <tr>
      <td><?php echo $row['Competition_ID'] ?></td>
      <td><?php echo $row['Title'] ?></td>
      <td><img src="<?php echo $row['comp_img'] ?>" width='50' height='50' alt=""></td>
      <td><?php echo $row['Description'] ?></td>
      <td><?php echo $row['StartDate'] ?></td>
      <td><?php echo $row['EndDate'] ?></td>
      <td><?php echo $row['Competition_Type'] ?></td>
      <td><?php echo $row['status'] ?></td>
     
      <td>
<div class="d-flex align-items-center list-user-action ">
<a class="bg-green" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="editcomp.php?id=<?php echo $row['Competition_ID']?>"><i class="ri-pencil-line"></i></a>
<a class="bg-green" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="deletecomp.php?id=<?php echo $row['Competition_ID']?>"><i class="ri-delete-bin-line"></i></a>
</div>
</td>
    </tr>
   <?php } ?>  </tbody>
</table>
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
