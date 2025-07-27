<?php
session_start();
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $competition_id = isset($_POST['competition_id']) ? $_POST['competition_id'] : '';
    $submission_details = isset($_POST['submission_details']) ? $_POST['submission_details'] : '';
    $student_id = isset($_SESSION['stdid']) ? $_SESSION['stdid'] : '';

    if (!$student_id) {
        $_SESSION['error'] = 'Error: Student ID not set in session.';
        header('location: participate.php');
        exit();
    }

    // Retrieve the id from tblstudents using StudentId
    $studentCheckSql = "SELECT id FROM tblstudents WHERE StudentId = :student_id";
    $studentCheckQuery = $dbh->prepare($studentCheckSql);
    $studentCheckQuery->bindParam(':student_id', $student_id, PDO::PARAM_STR);
    $studentCheckQuery->execute();

    if ($studentCheckQuery->rowCount() == 0) {
        $_SESSION['error'] = 'Error: Invalid Student ID.';
        header('location: participate.php');
        exit();
    }

    $studentData = $studentCheckQuery->fetch(PDO::FETCH_ASSOC);
    $studentId = $studentData['id'];

    // Check if file upload key exists and handle file upload
    if (isset($_FILES["submission_file"]) && $_FILES["submission_file"]["error"] == 0) {
        $target_dir = "admin/uploads/submissions/";
        $file_name = basename($_FILES["submission_file"]["name"]);
        $target_file = $target_dir . $file_name;
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file type
        if ($fileType != "pdf") {
            $_SESSION['error'] = "Sorry, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Move uploaded file
        if ($uploadOk && move_uploaded_file($_FILES["submission_file"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO submissions (Competition_ID, Student_ID, Submission_File, Submission_Details) VALUES (:competition_id, :student_id, :submission_file, :submission_details)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':competition_id', $competition_id, PDO::PARAM_INT);
            $query->bindParam(':student_id', $studentId, PDO::PARAM_INT); // Corrected to use id
            $query->bindParam(':submission_file', $file_name, PDO::PARAM_STR);
            $query->bindParam(':submission_details', $submission_details, PDO::PARAM_STR);
            $query->execute();

            $_SESSION['msg'] = "The file ". htmlspecialchars($file_name). " has been uploaded.";
            header('location: participate.php');
            exit();
        } else {
            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        }
    }
}

// Fetch competitions data
$sql = "SELECT * FROM competitions WHERE status = 'active'";
$query = $dbh->prepare($sql);
$query->execute();
$competitions = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Competitions</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
        .card {
            margin: 20px 0;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-img-top {
            height: 250px;
            width: 100%;
            object-fit: contain;
        }
        .card-body {
            padding: 15px;
            text-align: center;
        }
        .card-title {
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .card-text {
            font-size: 1em;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Competitions</h4>
                </div>
            </div>
            <?php if(isset($_SESSION['msg']) || isset($_SESSION['error'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <?php if(isset($_SESSION['msg'])) { ?>
                    <div class="alert alert-success">
                        <strong>Success:</strong>
                        <?php echo htmlentities($_SESSION['msg']); ?>
                        <?php unset($_SESSION['msg']); ?>
                    </div>
                    <?php } else if(isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger">
                        <strong>Error:</strong>
                        <?php echo htmlentities($_SESSION['error']); ?>
                        <?php unset($_SESSION['error']); ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
            <div class="row">
                <?php foreach ($competitions as $competition) : ?>
                    <div class="col-md-4">
                        <div class="card">
                            <?php if($competition->comp_img): ?>
                                <img class="card-img-top" src="admin/uploads/books/<?php echo htmlentities($competition->comp_img);?>" alt="Competition Image">
                            <?php else: ?>
                                <img class="card-img-top" src="uploads/books/no_image.png" alt="No Image">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlentities($competition->Title);?></h5>
                                <p class="card-text"><?php echo htmlentities($competition->Description);?></p>
                                <p class="card-text">Start Date: <?php echo htmlentities($competition->StartDate);?></p>
                                <p class="card-text">End Date: <?php echo htmlentities($competition->EndDate);?></p>
                                <form method="post" action="participate.php" enctype="multipart/form-data">
                                    <input type="hidden" name="competition_id" value="<?php echo htmlentities($competition->Competition_ID); ?>">
                                    <div class="form-group">
                                        <label for="submission_details">Submission Details</label>
                                        <textarea class="form-control" id="submission_details" name="submission_details" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="submission_file">Submission File (PDF only)</label>
                                        <input type="file" class="form-control-file" id="submission_file" name="submission_file" accept=".pdf" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
