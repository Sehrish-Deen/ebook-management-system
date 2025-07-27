<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Redirect to login page if user is not logged in
if (!isset($_SESSION['login']) || empty($_SESSION['stdid'])) { 
    header('location:index.php');
    exit();
}

// Get the student ID from session
$sid = $_SESSION['stdid'];

// Fetch prize details with competition information
$prizes_query = "SELECT c.Title, c.Competition_Type, s.prize, s.Submission_Date
                FROM submissions s
                INNER JOIN competitions c ON s.Competition_ID = c.Competition_ID
                WHERE s.Student_ID = :sid
                ORDER BY s.Submission_Date DESC";

try {
    $query = $dbh->prepare($prizes_query);
    $query->bindParam(':sid', $sid, PDO::PARAM_INT);
    $query->execute();
    $prizes = $query->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Ebook Management System | Prizes Won</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Prizes Won</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php if (!empty($prizes)): ?>
                        <?php foreach ($prizes as $prize): ?>
                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Prize Details
                                    </div>
                                    <div class="panel-body">
                                        <p><strong>Title:</strong> <?php echo htmlentities($prize->Title); ?></p>
                                        <p><strong>Competition Type:</strong> <?php echo htmlentities($prize->Competition_Type); ?></p>
                                        <p><strong>Prize:</strong> <?php echo htmlentities($prize->prize); ?></p>
                                        <p><strong>Submission Date:</strong> <?php echo date('d-M-Y H:i:s', strtotime($prize->Submission_Date)); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info">No prizes won yet.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
