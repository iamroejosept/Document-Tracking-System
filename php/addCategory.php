<?php
// Require the Database and centralConnection classes
require_once 'Database.php';
require 'centralConnection.php';

// Set the timezone to Asia/Manila
date_default_timezone_set('Asia/Manila');

$message = "";
$status = "";

    // Connect to the database
    $conn = mysqli_connect($Server, $User, $DBPassword, $Database);
    
    // Check if the connection was successful
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $DCN = mysqli_real_escape_string($conn, $_POST['addDCN']);
    $Description = mysqli_real_escape_string($conn, $_POST['addDescription']);
    $Frequency = mysqli_real_escape_string($conn, $_POST['addFrequency']);
    
    // Build the SQL query to add the category record
    $sql = "INSERT INTO DocumentCategory (DocumentCategoryName, Description, Frequency) VALUES ('$DCN', '$Description', '$Frequency')";
    
    // Execute the query
    if(mysqli_query($conn, $sql)) {
        $message = "Document category inserted successfully";
        $status = "success";
    } else {
        $message = "Error inserting document category into database";
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
