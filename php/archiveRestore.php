<?php
// Require the Database and centralConnection classes
require_once 'Database.php';
require 'centralConnection.php';

// Set the timezone to Asia/Manila
date_default_timezone_set('Asia/Manila');

$message = "";
$status = "";

// Check if the category id parameter is set in the URL
if(isset($_POST['id'])) {
    // Connect to the database
    $conn = mysqli_connect($Server, $User, $DBPassword, $Database);
    
    // Check if the connection was successful
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Escape the category id parameter to prevent SQL injection
    $ID = mysqli_real_escape_string($conn, $_POST['id']);
    
    if($_POST['action'] == "archive"){
        if($_POST['target'] == "document"){
            // Build the SQL query to archive the category record
            $sql = "UPDATE DocumentCategory SET ArchiveStatus = 'Archived' WHERE id_num = '$ID'";
        }elseif($_POST['target'] == "file"){
            // Build the SQL query to archive the file record
            $sql = "UPDATE Files SET ArchiveStatus = 'Archived' WHERE id_num = '$ID'";
        }elseif($_POST['target'] == "office"){
            // Build the SQL query to archive the category record
            $sql = "UPDATE OfficeSettings SET ArchiveStatus = 'Archived' WHERE office_id_num = '$ID'";
        }elseif($_POST['target'] == "user"){
            // Build the SQL query to archive the user record
            $sql = "UPDATE Users SET ArchiveStatus = 'Archived' WHERE users_id_num = '$ID'";
        }

        // Execute the query
        if(mysqli_query($conn, $sql)) {
            $message = "Record archived successfully";
            $status = "success";
        } else {
            $message = "Error archiving record into database";
            $status = "error";
        }
    }elseif($_POST['action'] == "restore"){
        if($_POST['target'] == "document"){
            // Build the SQL query to archive the category record
            $sql = "UPDATE DocumentCategory SET ArchiveStatus = 'Not Archived' WHERE id_num = '$ID'";
        }elseif($_POST['target'] == "file"){
            // Build the SQL query to archive the file record
            $sql = "UPDATE Files SET ArchiveStatus = 'Not Archived' WHERE id_num = '$ID'";
        }elseif($_POST['target'] == "office"){
            // Build the SQL query to archive the category record
            $sql = "UPDATE OfficeSettings SET ArchiveStatus = 'Not Archived' WHERE office_id_num = '$ID'";
        }elseif($_POST['target'] == "user"){
            // Build the SQL query to archive the user record
            $sql = "UPDATE Users SET ArchiveStatus = 'Not Archived' WHERE users_id_num = '$ID'";
        }

        // Execute the query
        if(mysqli_query($conn, $sql)) {
            $message = "Record restored successfully";
            $status = "success";
        } else {
            $message = "Error restoring record into database";
            $status = "error";
        }
    }
    
} else {
    $message = "Error occured while processing your request";
    $status = "error";
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

    
// Close the database connection
mysqli_close($conn);
?>
