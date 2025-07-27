<?php
session_start();
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
    exit();
}

if (isset($_POST['update_prize'])) {
    $submission_id = $_POST['submission_id'];
    $prize = $_POST['prize'];
    try {
        $dbh->beginTransaction();

        $sql_update_prize = "UPDATE submissions SET prize = :prize WHERE id = :submission_id";
        $stmt_update_prize = $dbh->prepare($sql_update_prize);
        $stmt_update_prize->bindParam(':prize', $prize, PDO::PARAM_STR);
        $stmt_update_prize->bindParam(':submission_id', $submission_id, PDO::PARAM_INT);
        $stmt_update_prize->execute();

        // Update the competitions table
        $sql_update_competition = "UPDATE competitions c
                                    INNER JOIN submissions s ON c.Competition_ID = s.Competition_ID
                                    SET c.status = :prize
                                    WHERE s.id = :submission_id";
        $stmt_update_competition = $dbh->prepare($sql_update_competition);
        $stmt_update_competition->bindParam(':prize', $prize, PDO::PARAM_STR);
        $stmt_update_competition->bindParam(':submission_id', $submission_id, PDO::PARAM_INT);
        $stmt_update_competition->execute();

        $dbh->commit();
        $_SESSION['message'] = 'Prize has been updated!';
    } catch (Exception $e) {
        $dbh->rollBack();
        $_SESSION['message'] = 'Failed to update prize: ' . $e->getMessage();
    }
    header('location: submission-details.php');
    exit();
}

// Delete submission if requested
if (isset($_GET['delete'])) {
    $submission_id = $_GET['delete'];
    try {
        $dbh->beginTransaction();

        // Delete submission
        $sql_delete_submission = "DELETE FROM submissions WHERE id = :submission_id";
        $stmt_delete_submission = $dbh->prepare($sql_delete_submission);
        $stmt_delete_submission->bindParam(':submission_id', $submission_id, PDO::PARAM_INT);
        $stmt_delete_submission->execute();

        // Optionally delete associated data or update related tables as needed

        $dbh->commit();
        $_SESSION['message'] = 'Submission has been deleted!';
    } catch (Exception $e) {
        $dbh->rollBack();
        $_SESSION['message'] = 'Failed to delete submission: ' . $e->getMessage();
    }
    header('location: submission-details.php');
    exit();
}

// Fetch submissions from the database
$sql = "SELECT s.*, c.Title AS CompetitionTitle, ts.FullName AS StudentName
        FROM submissions s
        INNER JOIN competitions c ON s.Competition_ID = c.Competition_ID
        INNER JOIN tblstudents ts ON s.Student_ID = ts.id
        ORDER BY s.Submission_Date DESC";
$query = $dbh->prepare($sql);
$query->execute();
$submissions = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Manage Submissions</title>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- Include your custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- Optionally, include font-awesome for icons -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Responsive DataTable CSS -->
    <link href="assets/css/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-header">Manage Submissions</h2>
                    <!-- Display Session Message -->
                    <?php if (isset($_SESSION['message'])) : ?>
                        <div class="alert alert-info">
                            <?php echo $_SESSION['message']; ?>
                        </div>
                        <?php unset($_SESSION['message']); ?>
                    <?php endif; ?>
                    <!-- End Display Session Message -->

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Submission Details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Competition Title</th>
                                            <th>Student Name</th>
                                            <th>Submission File</th>
                                            <th>Submission Details</th>
                                            <th>Prize</th>
                                            <th>Delete</th> <!-- Added delete column -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($submissions)) : ?>
                                            <?php foreach ($submissions as $key => $submission) : ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $key + 1; ?></td>
                                                    <td><?php echo htmlentities($submission['CompetitionTitle']); ?></td>
                                                    <td><?php echo htmlentities($submission['StudentName']); ?></td>
                                                    <td>
                                                        <?php
                                                        $submission_file = htmlentities($submission['Submission_File']);
                                                        if (!empty($submission_file)) {
                                                            echo '<a href="download.php?id=' . htmlentities($submission['id']) . '" target="_blank">Download File</a>';
                                                        } else {
                                                            echo 'No file uploaded';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo htmlentities($submission['Submission_Details']); ?></td>
                                                    <td>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="submission_id" value="<?php echo htmlentities($submission['id']); ?>">
                                                            <select name="prize">
                                                                <option value="passed" <?php echo $submission['prize'] == 'passed' ? 'selected' : ''; ?>>Passed</option>
                                                                <option value="1st prize" <?php echo $submission['prize'] == '1st prize' ? 'selected' : ''; ?>>1st Prize</option>
                                                                <option value="2nd prize" <?php echo $submission['prize'] == '2nd prize' ? 'selected' : ''; ?>>2nd Prize</option>
                                                                <option value="3rd prize" <?php echo $submission['prize'] == '3rd prize' ? 'selected' : ''; ?>>3rd Prize</option>
                                                            </select>
                                                            <button type="submit" name="update_prize" class="btn btn-info btn-sm">Update</button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <a href="?delete=<?php echo htmlentities($submission['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this submission?')">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="8">No submissions found.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER SECTION -->
    <?php include('includes/footer.php'); ?>

    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME -->
    <!-- CORE JQUERY -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- DATATABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
