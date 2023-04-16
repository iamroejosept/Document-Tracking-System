<?php
session_start();

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
$user_name = $_SESSION['user_id'];

if($_POST['target'] == "document"){
    $DCN = mysqli_real_escape_string($conn, $_POST['addDCN']);
    $Description = mysqli_real_escape_string($conn, $_POST['addDescription']);
    $Frequency = mysqli_real_escape_string($conn, $_POST['addFrequency']);
    
    // Build the SQL query to add the category record
    $sql = "INSERT INTO DocumentCategory (DocumentCategoryName, Description, Frequency) VALUES ('$DCN', '$Description', '$Frequency')";
    
    // Execute the query
    if(mysqli_query($conn, $sql)) {
        $message = "Document category inserted successfully";
        $status = "success";

        $DocumentData = array(
            'Document Value' => array(
                'Document Category' => $DCN,
                'Description' => $Description,
                'Frequency' => $Frequency
            )
        );

        // Construct the description of the change
        $description = "Added a Document Category: <br>";
        foreach ($DocumentData['Document Value'] as $key => $Value) {
            $description .= sprintf("%s: %s<br> ", $key, $Value);
        }

        $currentDateTime = date('Y-m-d H:i A');

        //Code for the logs
        $sql_logs = "INSERT INTO Logs (User, LogType, Description, Date) VALUES ('$user_name', 'Add', '$description', '$currentDateTime')";

         mysqli_query($conn, $sql_logs);
    } else {
        $message = "Error inserting document category into database";
        $status = "error";
    }
}elseif($_POST['target'] == "office"){
    $province = mysqli_real_escape_string($conn, $_POST['addProvince']);
    $cityMunicipality = mysqli_real_escape_string($conn, $_POST['addCityMunicipality']);
    
    // Build the SQL query to add the category record
    $sql = "INSERT INTO OfficeSettings (Province, cityMunicipality) VALUES ('$province', '$cityMunicipality')";
    
    // Execute the query
    if(mysqli_query($conn, $sql)) {
        $message = "Office category inserted successfully";
        $status = "success";

        $OfficeData = array(
            'Office Value' => array(
                'Province' => $province,
                'City / Municipality' => $cityMunicipality
            )
        );

        // Construct the description of the change
        $description = "Added an Office Category: <br>";
        foreach ($OfficeData['Office Value'] as $key => $Value) {
            $description .= sprintf("%s: %s<br> ", $key, $Value);
        }

        $currentDateTime = date('Y-m-d H:i A');

        //Code for the logs
        $sql_logs = "INSERT INTO Logs (User, LogType, Description, Date) VALUES ('$user_name', 'Add', '$description', '$currentDateTime')";

         mysqli_query($conn, $sql_logs);
    } else {
        $message = "Error inserting office category into database";
        $status = "error";
    }
}elseif($_POST['target'] == "user"){
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

        $UserData = array(
            'User Value' => array(
                'Full Name' => $fullName,
                'Username' => $username,
                'Access Level' => $accessLevel,
                'Status' => 'Activated'
            )
        );

        // Construct the description of the change
        $description = "Added a User: <br>";
        foreach ($UserData['User Value'] as $key => $Value) {
            $description .= sprintf("%s: %s<br> ", $key, $Value);
        }

        $currentDateTime = date('Y-m-d H:i A');

        //Code for the logs
        $sql_logs = "INSERT INTO Logs (User, LogType, Description, Date) VALUES ('$user_name', 'Add', '$description', '$currentDateTime')";

         mysqli_query($conn, $sql_logs);
    } else {
        $message = "Error adding user into database";
        $status = "error";
    }
}elseif($_POST['target'] == "files"){
    $office="";
    $fileName = "";
    $fileTmpName = "";
    $fileCategory = mysqli_real_escape_string($conn, $_POST['fileCategory']);
    $barcode = mysqli_real_escape_string($conn, $_POST['txtBarcode']);
    $fileDescription = mysqli_real_escape_string($conn, $_POST['fileDescription']);
    $fileLocation = mysqli_real_escape_string($conn, $_POST['fileFileLocation']);
    $fileDateUploaded = mysqli_real_escape_string($conn, $_POST['fileDate']);
    $fileProvince = mysqli_real_escape_string($conn, $_POST['fileProvince']);
    $fileCityMunicipality = mysqli_real_escape_string($conn, $_POST['fileCityMunicipality']);
    $fileRemark = mysqli_real_escape_string($conn, $_POST['fileRemark']);

    $fileDateUploaded = date('Y-m-d', strtotime($fileDateUploaded));

    $query ="SELECT office_id_num FROM OfficeSettings WHERE Province='$fileProvince' AND cityMunicipality='$fileCityMunicipality'";
    $result = mysqli_query($conn, $query);

    if($result){
        $row = mysqli_fetch_assoc($result);
        $office = $row['office_id_num'];
    }

    // Check if a file has been uploaded
    if(isset($_FILES['inputFile']) && $_FILES['inputFile']['error'] !== UPLOAD_ERR_NO_FILE) {
        $fileName = $_FILES['inputFile']['name'];
        $fileTmpName = $_FILES['inputFile']['tmp_name']; // Temporary file path

        $uploadDir = '../files/'; // Upload directory
        $uploadPath = $uploadDir . basename($fileName);

        if (move_uploaded_file($fileTmpName, $uploadPath)) {
            // File uploaded successfully, proceed with database insert
            $sql = "INSERT INTO Files (Barcode, Category, Description, FileLocation, File, UploadedBy, Date, office_id_num, Remark) VALUES ('$barcode', '$fileCategory', '$fileDescription', '$fileLocation', '$fileName', '$user_name', '$fileDateUploaded', '$office', '$fileRemark')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $message = "File uploaded and record inserted successfully";
                $status = "success";

                $FileData = array(
                    'File Value' => array(
                        'File' => $fileName,
                        'Barcode' => $barcode,
                        'Category' => $fileCategory,
                        'Province' => $fileProvince,
                        'City / Municipality' => $fileCityMunicipality,
                        'Date Uploaded' => $fileDateUploaded,
                        'Description' => $fileDescription,
                        'File Location' => $fileLocation,
                        'Remark' => $fileRemark
                    )
                );
        
                // Construct the description of the change
                $description = "Added a File: <br>";
                foreach ($FileData['File Value'] as $key => $Value) {
                    $description .= sprintf("%s: %s<br> ", $key, $Value);
                }
        
                $currentDateTime = date('Y-m-d H:i A');
        
                //Code for the logs
                $sql_logs = "INSERT INTO Logs (User, LogType, Description, Date) VALUES ('$user_name', 'Add', '$description', '$currentDateTime')";
        
                 mysqli_query($conn, $sql_logs);
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
        $sql = "INSERT INTO Files (Barcode, Category, Description, FileLocation, UploadedBy, Date, office_id_num, Remark) VALUES ('$barcode', '$fileCategory', '$fileDescription', '$fileLocation', '$user_name', '$fileDateUploaded', '$office', '$fileRemark')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $message = "Record inserted successfully";
            $status = "success";

            $FileData = array(
                'File Value' => array(
                    'Barcode' => $barcode,
                    'Category' => $fileCategory,
                    'Province' => $fileProvince,
                    'City / Municipality' => $fileCityMunicipality,
                    'Date Uploaded' => $fileDateUploaded,
                    'Description' => $fileDescription,
                    'File Location' => $fileLocation,
                    'Remark' => $fileRemark
                )
            );
    
            // Construct the description of the change
            $description = "Added a File: <br>";
            foreach ($FileData['File Value'] as $key => $Value) {
                $description .= sprintf("%s: %s<br> ", $key, $Value);
            }
    
            $currentDateTime = date('Y-m-d H:i A');
    
            //Code for the logs
            $sql_logs = "INSERT INTO Logs (User, LogType, Description, Date) VALUES ('$user_name', 'Add', '$description', '$currentDateTime')";
    
             mysqli_query($conn, $sql_logs);
        } else {
            $message = "Error inserting record into database";
            $status = "error";
        }
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
