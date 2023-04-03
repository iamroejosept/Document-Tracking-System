<?php
// Require the Database and centralConnection classes
require_once 'Database.php';
require 'centralConnection.php';

// Set the timezone to Asia/Manila
date_default_timezone_set('Asia/Manila');

// Connect to the database
$conn = mysqli_connect($Server, $User, $DBPassword, $Database);

// Check if the connection was successful
if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";
$status = "";
$frequency = "";
$category = mysqli_real_escape_string($conn, $_POST['category']);

$query ="SELECT Frequency FROM DocumentCategory WHERE DocumentCategoryName='$category'";
$result = mysqli_query($conn, $query);

if($result){
    $row = mysqli_fetch_assoc($result);
    $frequency = $row['Frequency'];
}

$XMLData = '';
$XMLData .= ' <output ';
$XMLData .= ' frequency = ' . '"'.$frequency.'"';
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
