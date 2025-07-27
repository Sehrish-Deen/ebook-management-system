<?php
if(isset($_GET['file'])){
    $file = $_GET['file'];

    // Define the path to the PDF directory
    $filePath = 'admin/uploads/books/' . $file;

    // Check if the file exists
    if(file_exists($filePath)){
        // Define headers
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));
        flush(); 
        readfile($filePath);
        exit;
    } else {
        echo "File does not exist.";
    }
} else {
    echo "No file specified.";
}
?>
