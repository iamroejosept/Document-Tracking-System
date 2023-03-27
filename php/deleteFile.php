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
    $fileID = mysqli_real_escape_string($conn, $_POST['id']);
    
    // Build the SQL query to delete the category record
    $sql = "DELETE FROM Files WHERE id_num = '$fileID'";
    
    // Execute the query
    if(mysqli_query($conn, $sql)) {
        $message = "File and record deleted successfully";
        $status = "success";
    } else {
        $message = "Error deleting file and record";
        $status = "error";
    }
} else {
    $message = "Error deleting file and record";
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
