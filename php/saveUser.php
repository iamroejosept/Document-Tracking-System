<?php
// Require the Database and centralConnection classes
require_once 'Database.php';
require 'centralConnection.php';

// Set the timezone to Asia/Manila
date_default_timezone_set('Asia/Manila');

$message = "";
$status = "";

// Check if the category id parameter is set in the URL
if(isset($_POST['nameEditID'])) {
    // Connect to the database
    $conn = mysqli_connect($Server, $User, $DBPassword, $Database);
    
    // Check if the connection was successful
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Escape the following to prevent SQL injection
    $editID = mysqli_real_escape_string($conn, $_POST['nameEditID']);
    $editFullname = mysqli_real_escape_string($conn, $_POST['nameEditUserFullName']);
    $editAccessLevel = mysqli_real_escape_string($conn, $_POST['nameEditUserAccessLevel']);
    $editUsername = mysqli_real_escape_string($conn, $_POST['nameEditUserUsername']);
    $editStatus = mysqli_real_escape_string($conn, $_POST['nameEditUserStatus']);
    $editPassword = mysqli_real_escape_string($conn, $_POST['nameEditUserPassword']);

    $query ="SELECT * FROM Users";  
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    if($row['Password'] == $editPassword){
        // Build the SQL query to update the category record
        $sql = "UPDATE Users SET Fullname = '$editFullname', Username = '$editUsername', Password = '$editPassword', AccessLevel = '$editAccessLevel', Status = '$editStatus' WHERE id_num = '$editID'";
        
        // Execute the query
        if(mysqli_query($conn, $sql)) {
            $message = "User updated successfully";
            $status = "success";
        } else {
            $message = "Error updating user";
            $status = "error";
        }
    }else{
        //Encrypt the password
        // Store a string into the variable which need to be Encrypted
        $simple_string = $editPassword;
        
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

        // Build the SQL query to update the category record
        $sql = "UPDATE Users SET Fullname = '$editFullname', Username = '$editUsername', Password = '$encryption', AccessLevel = '$editAccessLevel', Status = '$editStatus' WHERE id_num = '$editID'";
        
        // Execute the query
        if(mysqli_query($conn, $sql)) {
            $message = "User updated successfully";
            $status = "success";
        } else {
            $message = "Error updating user";
            $status = "error";
        }
    }

        
} else {
    $message = "Error updating user";
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
