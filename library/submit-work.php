<?php
session_start();
include('includes/config.php');

if(strlen($_SESSION['login'])==0) {   
    header('location:index.php');
} else { 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['submission'])) {
        $competition_id = intval($_POST['competition_id']);
        $student_id = $_SESSION['stdid'];
        $submission = $_FILES['submission'];

        $target_dir = "uploads/submissions/";
        $target_file = $target_dir . basename($submission["name"]);
        move_uploaded_file($submission["tmp_name"], $target_file);

        // Insert submission record
        $sql = "INSERT INTO submissions (Competition_ID, Student_ID, File_Path) VALUES (:competition_id, :student_id, :file_path)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':competition_id', $competition_id, PDO::PARAM_INT);
        $query->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $query->bindParam(':file_path', $target_file, PDO::PARAM_STR);
        $query->execute();

        $_SESSION['success_msg'] = "Your submission has been successfully uploaded!";
        header('Location: competitions.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
   
