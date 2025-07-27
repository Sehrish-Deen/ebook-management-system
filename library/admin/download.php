<?php
session_start();
include('includes/config.php');

if (isset($_GET['id'])) {
    $submission_id = intval($_GET['id']);
    $sql = "SELECT Submission_File FROM submissions WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $submission_id, PDO::PARAM_INT);
    $query->execute();
    $submission = $query->fetch(PDO::FETCH_ASSOC);

    if ($submission) {
        $file = $submission['Submission_File'];
        $filepath = __DIR__ . '/uploads/submissions/' . $file;

        // Debugging: Print the file path
        echo "Requested file: " . htmlentities($file) . "<br>";
        echo "File path: " . htmlentities($filepath) . "<br>";

        // Check if file exists
        if (file_exists($filepath)) {
            // Set headers for file download
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            ob_clean();
            flush();
            readfile($filepath);
            exit;
        } else {
            echo "File does not exist.";
        }
    } else {
        echo "No submission found with the specified ID.";
    }
} else {
    echo "No file specified.";
}
?>
