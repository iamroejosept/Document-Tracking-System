<?php
// Require the Database and centralConnection classes
require_once 'Database.php';
require 'centralConnection.php';

// Set the timezone to Asia/Manila
date_default_timezone_set('Asia/Manila');

$message = "";
$status = "";

// Check if the category id parameter is set in the URL
if(isset($_POST['editID'])) {
    // Connect to the database
    $conn = mysqli_connect($Server, $User, $DBPassword, $Database);
    
    // Check if the connection was successful
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Escape the following to prevent SQL injection
    $officeID = mysqli_real_escape_string($conn, $_POST['editID']);
    $officeProvince = mysqli_real_escape_string($conn, $_POST['editProvince']);
    $officeCityMunicipality = mysqli_real_escape_string($conn, $_POST['editCityMunicipality']);
    
    // Build the SQL query to update the category record
    $sql = "UPDATE OfficeSettings SET Province = '$officeProvince', cityMunicipality = '$officeCityMunicipality' WHERE office_id_num = '$officeID'";
    
    // Execute the query
    if(mysqli_query($conn, $sql)) {
        $message = "Office category saved successfully";
        $status = "success";
    } else {
        $message = "Error saving record into database";
        $status = "error";
    }
} else {
    $message = "Error saving record into database";
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
