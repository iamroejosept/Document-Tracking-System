<?php
session_start();

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

    if($_POST['target'] == "document"){
        // Escape the following to prevent SQL injection
        $categoryId = mysqli_real_escape_string($conn, $_POST['editID']);
        $categoryName = mysqli_real_escape_string($conn, $_POST['editDCN']);
        $description = mysqli_real_escape_string($conn, $_POST['editDescription']);
        $frequency = mysqli_real_escape_string($conn, $_POST['editFrequency']);
        
        // Build the SQL query to update the category record
        $sql = "UPDATE DocumentCategory SET DocumentCategoryName = '$categoryName', Description = '$description', Frequency = '$frequency' WHERE id_num = '$categoryId'";
        
        // Execute the query
        if(mysqli_query($conn, $sql)) {
            $message = "Document category saved successfully";
            $status = "success";
        } else {
            $message = "Error saving record into database";
            $status = "error";
        }
    }elseif($_POST['target'] == "office"){
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
    }elseif($_POST['target'] == "user"){
        // Escape the following to prevent SQL injection
        $editID = mysqli_real_escape_string($conn, $_POST['editID']);
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
            $sql = "UPDATE Users SET Fullname = '$editFullname', Username = '$editUsername', Password = '$editPassword', AccessLevel = '$editAccessLevel', Status = '$editStatus' WHERE users_id_num = '$editID'";
            
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
            $sql = "UPDATE Users SET Fullname = '$editFullname', Username = '$editUsername', Password = '$encryption', AccessLevel = '$editAccessLevel', Status = '$editStatus' WHERE users_id_num = '$editID'";
            
            // Execute the query
            if(mysqli_query($conn, $sql)) {
                $message = "User updated successfully";
                $status = "success";
            } else {
                $message = "Error updating user";
                $status = "error";
            }
        }
    }elseif($_POST['target'] == "files"){
        $office = "";
        $user_name = $_SESSION['user_id'];

        // Escape the following to prevent SQL injection
        $editID = mysqli_real_escape_string($conn, $_POST['editID']);
        $editCategoryName = mysqli_real_escape_string($conn, $_POST['nameEditCategoryName']);
        $editBarcode = mysqli_real_escape_string($conn, $_POST['nameEditBarcode']);
        $editDescription = mysqli_real_escape_string($conn, $_POST['nameEditDescription']);
        $editFileLocation = mysqli_real_escape_string($conn, $_POST['nameEditFileLocation']);
        $editDateUploaded = mysqli_real_escape_string($conn, $_POST['nameEditDateUploaded']);
        $editProvince = mysqli_real_escape_string($conn, $_POST['namefileProvince']);
        $editCityMunicipality = mysqli_real_escape_string($conn, $_POST['namefileCityMunicipality']);
        $editRemark = mysqli_real_escape_string($conn, $_POST['nameEditRemark']);

        $editDateUploaded = date('Y-m-d', strtotime($editDateUploaded));

        $query ="SELECT office_id_num FROM OfficeSettings WHERE Province='$editProvince' AND cityMunicipality='$editCityMunicipality'";
        $result = mysqli_query($conn, $query);

        if($result){
            $row = mysqli_fetch_assoc($result);
            $office = $row['office_id_num'];
        }

        if($_FILES['nameEditInputFile']['name'] == null){
            // Build the SQL query to update the category record
            $sql = "UPDATE Files SET Barcode = '$editBarcode', Category = '$editCategoryName', Description = '$editDescription', FileLocation = '$editFileLocation', Date = '$editDateUploaded', office_id_num = '$office', Remark = '$editRemark', UploadedBy = '$user_name' WHERE id_num = '$editID'";
            
            // Execute the query
            if(mysqli_query($conn, $sql)) {
                $message = "File updated successfully";
                $status = "success";
            } else {
                $message = "Error updating file";
                $status = "error";
            }
        }else{
            $fileName = $_FILES['nameEditInputFile']['name'];
            $fileTmpName = $_FILES['nameEditInputFile']['tmp_name']; // Temporary file path
            $uploadDir = '../files/'; // Upload directory
            $uploadPath = $uploadDir . basename($fileName);

            //Delete the old file
            $sql = "SELECT * FROM Files WHERE id_num = '$editID'";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_array($result);
            if (!empty($row['File'])) {
                $file_path = '../files/'.$row['File'];
                unlink($file_path);
            }

            if (move_uploaded_file($fileTmpName, $uploadPath)) {
                // Build the SQL query to update the category record
                $sql = "UPDATE Files SET Barcode = '$editBarcode', Category = '$editCategoryName', File = '$fileName', Description = '$editDescription', FileLocation = '$editFileLocation', Date = '$editDateUploaded', office_id_num = '$office', Remark = '$editRemark', UploadedBy = '$user_name' WHERE id_num = '$editID'";
                
                // Execute the query
                if(mysqli_query($conn, $sql)) {
                    $message = "File updated successfully";
                    $status = "success";
                } else {
                    $message = "Error updating file";
                    $status = "error";
                }
            } else {
                $message = "Error uploading file";
                $status = "error";
            }

            
        }
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
