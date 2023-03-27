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
$fullName = mysqli_real_escape_string($conn, $_POST['addUserFullName']);
$accessLevel = mysqli_real_escape_string($conn, $_POST['addUserAccessLevel']);
$username = mysqli_real_escape_string($conn, $_POST['addUserUsername']);
$password = mysqli_real_escape_string($conn, $_POST['addUserPassword']);

//Encrypt the password
// Store a string into the variable which need to be Encrypted
$simple_string = $password;
  
// Store the cipher method
$ciphering = "AES-128-CTR";

// Use OpenSSl Encryption method
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;

// Non-NULL Initialization Vector for encryption
$encryption_iv = '1234567891011121';

// Store the encryption key
$encryption_key = "DocumentTrackingSystem";

// Use openssl_encrypt() function to encrypt the data
$encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);

// File uploaded successfully, proceed with database insert
$sql = "INSERT INTO Users (Fullname, Username, Password, AccessLevel, Status) VALUES ('$fullName', '$username', '$encryption', '$accessLevel', 'Activated')";
$result = mysqli_query($conn, $sql);
    
if ($result) {
    $message = "User added successfully";
    $status = "success";
} else {
    $message = "Error adding user into database";
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
