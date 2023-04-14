<?php
require_once 'Database.php';
require 'centralConnection.php';

$message = "";
$status = "";

// Connect to the database
$conn = mysqli_connect($Server, $User, $DBPassword, $Database);

// Check if file was uploaded successfully
if ($_FILES['backup_file']['error'] !== UPLOAD_ERR_OK) {
    $message = "Failed to upload file";
    $status = "error";
}else{
    // Get temporary filename
    $temp_file = $_FILES['backup_file']['tmp_name'];

    $sql = file_get_contents($temp_file);
    $queries = explode(';', $sql);
    $error = false;

    foreach ($queries as $query) {
        if (mysqli_query($conn, $query) === false) {
            $error = true;
            break;
        }
    }

    if ($error) {
        $message = "Failed to restore backup file";
        $status = "error";
    } else {
        $message = "Success to restore backup file";
        $status = "success";
    }

}

$XMLData = '';  
$XMLData .= ' <output ';
$XMLData .= ' message = ' . '"'.$message.'"';
$XMLData .= ' status = ' . '"'.$status.'"';
$XMLData .= ' />';
    
//Generate XML output
header('Content-Type: text/xml');
//Generate XML header
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
echo '<Document>';      
echo $XMLData;
echo '</Document>';

?>


