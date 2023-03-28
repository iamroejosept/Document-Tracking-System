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
$office="";
$fileName = "";
$fileTmpName = "";
$fileCategory = mysqli_real_escape_string($conn, $_POST['fileCategory']);
$barcode = mysqli_real_escape_string($conn, $_POST['txtBarcode']);
$fileDescription = mysqli_real_escape_string($conn, $_POST['fileDescription']);
$fileProvince = mysqli_real_escape_string($conn, $_POST['fileProvince']);
$fileCityMunicipality = mysqli_real_escape_string($conn, $_POST['fileCityMunicipality']);

$query ="SELECT office_id_num FROM OfficeSettings WHERE Province='$fileProvince' AND cityMunicipality='$fileCityMunicipality'";
$result = mysqli_query($conn, $query);

if($result){
    $row = mysqli_fetch_assoc($result);
    $office = $row['office_id_num'];
}

$currentDateTime = new DateTime();
$formattedDateTime = $currentDateTime->format('Y-m-d');

// Check if a file has been uploaded
if(isset($_FILES['inputFile']) && $_FILES['inputFile']['error'] !== UPLOAD_ERR_NO_FILE) {
    $fileName = $_FILES['inputFile']['name'];
    $fileTmpName = $_FILES['inputFile']['tmp_name']; // Temporary file path

    $uploadDir = '../files/'; // Upload directory
    $uploadPath = $uploadDir . basename($fileName);

    if (move_uploaded_file($fileTmpName, $uploadPath)) {
        // File uploaded successfully, proceed with database insert
        $sql = "INSERT INTO Files (Barcode, Category, Description, File, UploadedBy, Date, office_id_num) VALUES ('$barcode', '$fileCategory', '$fileDescription', '$fileName', '', '$formattedDateTime', '$office')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $message = "File uploaded and record inserted successfully";
            $status = "success";
        } else {
            $message = "Error inserting record into database";
            $status = "error";
        }
    } else {
        $message = "Error uploading file";
        $status = "error";
    }
} else {
    // No file uploaded, proceed with database insert without file
    $sql = "INSERT INTO Files (Barcode, Category, Description, UploadedBy, Date, office_id_num) VALUES ('$barcode', '$fileCategory', '$fileDescription', '', '$formattedDateTime', '$office')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $message = "Record inserted successfully";
        $status = "success";
    } else {
        $message = "Error inserting record into database";
        $status = "error";
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

    
// Close the database connection
mysqli_close($conn);

?>
