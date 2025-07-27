<?php
session_start();
include('includes/config.php');

if(strlen($_SESSION['login'])==0) {   
    header('location:index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize input
    $competition_id = intval($_POST['competition_id']);
    $student_id = $_SESSION['stdid'];
    $submission_details = $_POST['submission_details'];

    // File upload handling (adjust as per your needs)
    $file_name = $_FILES['submission_file']['name'];
    $file_tmp = $_FILES['submission_file']['tmp_name'];
    $file_size = $_FILES['submission_file']['size'];
    $file_type = $_FILES['submission_file']['type'];
    $file_ext = strtolower(end(explode('.', $file_name)));
    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extensions) === false) {
        $_SESSION['error_msg'] = "Extension not allowed, please choose a JPEG or PNG file.";
        header('Location: competitions.php');
        exit();
    }

    // Move uploaded file to desired directory (adjust path as per your setup)
    $upload_path = 'admin/uploads/books/'; // adjust path as needed
    $final_file = $upload_path . time() . '_' . $file_name;
    if (move_uploaded_file($file_tmp, $final_file)) {
        // Insert submission record into database
        $sql = "INSERT INTO submissions (Competition_ID, Student_ID, Submission_Details, Submission_File) 
                VALUES (:competition_id, :student_id, :submission_details, :submission_file)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':competition_id', $competition_id, PDO::PARAM_INT);
        $query->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $query->bindParam(':submission_details', $submission_details, PDO::PARAM_STR);
        $query->bindParam(':submission_file', $final_file, PDO::PARAM_STR);
        
        if ($query->execute()) {
            $_SESSION['success_msg'] = "Submission successful!";
        } else {
            $_SESSION['error_msg'] = "Error submitting your entry. Please try again.";
        }
    } else {
        $_SESSION['error_msg'] = "Error uploading file. Please try again.";
    }

    header('Location: competitions.php');
    exit();
} else {
    $_SESSION['error_msg'] = "Invalid request.";
    header('Location: competitions.php');
    exit();
}
?>
