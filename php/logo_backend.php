<?php
session_start();
require_once 'Database.php';
require 'centralConnection.php';

date_default_timezone_set('Asia/Manila');

$message = "";
$status = "";
$user_name = $_SESSION['user_id'];
$dataValid = true;

// Connect to the database
$conn = mysqli_connect($Server, $User, $DBPassword, $Database);

if (!isset($_FILES['logo_picture'])) {
    $dataValid = false;
}
if (empty($_POST['logo_name'])) {
    $dataValid = false;
}

if ($dataValid == true) {
    if($_FILES['logo_picture']['error'] !== UPLOAD_ERR_NO_FILE) {
        $logo_picture = $_FILES['logo_picture']['name'];
        $logo_picture_tmp = $_FILES['logo_picture']['tmp_name']; // Temporary file path
        $logo_name = $_POST['logo_name'];
    
        $uploadDir = '../asset/img/logo/'; // Upload directory
        $uploadPath = $uploadDir . basename($logo_picture);
    
        //Delete the old file
        $sql = "DELETE FROM Logo";
        mysqli_query($connect, $sql);
    
        $folder_path = '../asset/img/logo/';
        $files = glob($folder_path.'*'); // Get all files in the folder
    
        // Loop through the files and delete each one except the file named "default-logo.png"
        foreach($files as $file){
            if(is_file($file) && basename($file) !== 'default-logo.png'){
                unlink($file);
            }
        }
    
        if (move_uploaded_file($logo_picture_tmp, $uploadPath)) {
            // File uploaded successfully, proceed with database insert
            $sql = "INSERT INTO Logo (Logo_Picture, Logo_Name) VALUES ('$logo_picture', '$logo_name')";
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                $message = "Logo changed successfully";
                $status = "success";
    
                $logo_data = array(
                    'Logo Value' => array(
                        'Logo Picture' => $logo_picture,
                        'Logo Name' => $logo_name
                    )
                );
        
                // Construct the description of the change
                $description = "Changed the logo into: <br>";
                foreach ($logo_data['Logo Value'] as $key => $Value) {
                    $description .= sprintf("%s: %s<br> ", $key, $Value);
                }
        
                $currentDateTime = date('Y-m-d H:i A');
        
                //Code for the logs
                $sql_logs = "INSERT INTO Logs (User, LogType, Description, Date) VALUES ('$user_name', 'Commit', '$description', '$currentDateTime')";
        
                mysqli_query($conn, $sql_logs);
            } else {
                $message = "Error inserting data into database";
                $status = "error";
            }
        } else {
            $message = "Error uploading picture";
            $status = "error";
        }
    }else{
        $message = "Failed to upload picture";
        $status = "error";
    }
}else{
    $message = "Please fill all the required fields.";
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

?>


