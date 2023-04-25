<?php
session_start();

// Require the Database, Functions, and centralConnection classes
require_once 'Database.php';
require_once 'Functions.php';
require 'centralConnection.php';

// Set the timezone to Asia/Manila
date_default_timezone_set('Asia/Manila');

$message = "";
$status = "";
$user_name = $_SESSION['user_id'];

// Create a new instance of the Functions class
$functions = new Functions();

// Connect to the database
$conn = mysqli_connect($Server, $User, $DBPassword, $Database);
    
// Check if the connection was successful
if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the category id parameter is set in the URL
if(isset($_POST['editID'])) {
    if($_POST['target'] == "document"){
        // Escape the following to prevent SQL injection
        $categoryId = mysqli_real_escape_string($conn, $_POST['editID']);
        $categoryName = mysqli_real_escape_string($conn, $_POST['editDCN']);
        $description = mysqli_real_escape_string($conn, $_POST['editDescription']);
        $frequency = mysqli_real_escape_string($conn, $_POST['editFrequency']);

        // Get the old file data
        $oldDocumentCategoryData = $functions->getDocumentCategoryData($categoryId, $conn);
        
        // Build the SQL query to update the category record
        $sql = "UPDATE DocumentCategory SET DocumentCategoryName = '$categoryName', Description = '$description', Frequency = '$frequency' WHERE id_num = '$categoryId'";
        
        // Execute the query
        if(mysqli_query($conn, $sql)) {
            $message = "Document category saved successfully";
            $status = "success";

            // Get the new file data
            $newDocumentCategoryData = $functions->getDocumentCategoryData($categoryId, $conn);

            // Put the old and new file data in an array
            $DocumentCategoryData = array(
                'Old Value' => array(
                    'Document Category' => $oldDocumentCategoryData['DocumentCategoryName'],
                    'Description' => $oldDocumentCategoryData['Description'],
                    'Frequency' => $oldDocumentCategoryData['Frequency']
                ),
                'New Value' => array(
                    'Document Category' => $newDocumentCategoryData['DocumentCategoryName'],
                    'Description' => $newDocumentCategoryData['Description'],
                    'Frequency' => $newDocumentCategoryData['Frequency']
                )
            );

            // Construct the description of the change
            $description = "Commited a Document Category: <br>";
            foreach ($DocumentCategoryData['Old Value'] as $key => $oldValue) {
                $newValue = $DocumentCategoryData['New Value'][$key];
                $description .= sprintf("%s from %s to %s <br> ", $key, $oldValue, $newValue);
            }

            $currentDateTime = date('Y-m-d H:i A');

            //Code for the logs
            $sql_logs = "INSERT INTO Logs (User, LogType, Description, Date) VALUES ('$user_name', 'Commit', '$description', '$currentDateTime')";

            mysqli_query($conn, $sql_logs);
        } else {
            $message = "Error saving record into database";
            $status = "error";
        }
    }elseif($_POST['target'] == "office"){
        // Escape the following to prevent SQL injection
        $officeID = mysqli_real_escape_string($conn, $_POST['editID']);
        $officeRegion = mysqli_real_escape_string($conn, $_POST['editRegion']);
        $officeProvince = mysqli_real_escape_string($conn, $_POST['editProvince']);
        $officeCityMunicipality = mysqli_real_escape_string($conn, $_POST['editCityMunicipality']);

        // Get the old file data
        $oldOfficeCategoryData = $functions->getOfficeCategoryData($officeID, $conn);
        
        // Build the SQL query to update the category record
        $sql = "UPDATE OfficeSettings SET Region = '$officeRegion', Province = '$officeProvince', cityMunicipality = '$officeCityMunicipality' WHERE office_id_num = '$officeID'";
        
        // Execute the query
        if(mysqli_query($conn, $sql)) {
            $message = "Office category saved successfully";
            $status = "success";

            // Get the new file data
            $newOfficeCategoryData = $functions->getOfficeCategoryData($officeID, $conn);

            // Put the old and new file data in an array
            $OfficeCategoryData = array(
                'Old Value' => array(
                    'Region' => $oldOfficeCategoryData['Region'],
                    'Province' => $oldOfficeCategoryData['Province'],
                    'City / Municipality' => $oldOfficeCategoryData['cityMunicipality']
                ),
                'New Value' => array(
                    'Region' => $newOfficeCategoryData['Region'],
                    'Province' => $newOfficeCategoryData['Province'],
                    'City / Municipality' => $newOfficeCategoryData['cityMunicipality']
                )
            );

            // Construct the description of the change
            $description = "Commited an Office Category: <br>";
            foreach ($OfficeCategoryData['Old Value'] as $key => $oldValue) {
                $newValue = $OfficeCategoryData['New Value'][$key];
                $description .= sprintf("%s from %s to %s <br> ", $key, $oldValue, $newValue);
            }

            $currentDateTime = date('Y-m-d H:i A');

            //Code for the logs
            $sql_logs = "INSERT INTO Logs (User, LogType, Description, Date) VALUES ('$user_name', 'Commit', '$description', '$currentDateTime')";

            mysqli_query($conn, $sql_logs);
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
            // Get the old file data
            $oldUserData = $functions->getUsersData($editID, $conn);

            // Build the SQL query to update the category record
            $sql = "UPDATE Users SET Fullname = '$editFullname', Username = '$editUsername', Password = '$editPassword', AccessLevel = '$editAccessLevel', Status = '$editStatus' WHERE users_id_num = '$editID'";
            
            // Execute the query
            if(mysqli_query($conn, $sql)) {
                $message = "User updated successfully";
                $status = "success";

                // Get the new file data
                $newUserData = $functions->getUsersData($editID, $conn);

                // Put the old and new file data in an array
                $UserData = array(
                    'Old Value' => array(
                        'Full Name' => $oldUserData['Fullname'],
                        'Username' => $oldUserData['Username'],
                        'Access Level' => $oldUserData['AccessLevel'],
                        'Status' => $oldUserData['Status']
                    ),
                    'New Value' => array(
                        'Full Name' => $newUserData['Fullname'],
                        'Username' => $newUserData['Username'],
                        'Access Level' => $newUserData['AccessLevel'],
                        'Status' => $newUserData['Status']
                    )
                );

                // Construct the description of the change
                $description = "Commited a User: <br>";
                foreach ($UserData['Old Value'] as $key => $oldValue) {
                    $newValue = $UserData['New Value'][$key];
                    $description .= sprintf("%s from %s to %s <br> ", $key, $oldValue, $newValue);
                }

                $currentDateTime = date('Y-m-d H:i A');

                //Code for the logs
                $sql_logs = "INSERT INTO Logs (User, LogType, Description, Date) VALUES ('$user_name', 'Commit', '$description', '$currentDateTime')";

                mysqli_query($conn, $sql_logs);
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

            // Get the old file data
            $oldUserData = $functions->getUsersData($editID, $conn);

            // Build the SQL query to update the category record
            $sql = "UPDATE Users SET Fullname = '$editFullname', Username = '$editUsername', Password = '$encryption', AccessLevel = '$editAccessLevel', Status = '$editStatus' WHERE users_id_num = '$editID'";
            
            // Execute the query
            if(mysqli_query($conn, $sql)) {
                $message = "User updated successfully";
                $status = "success";

                // Get the new file data
                $newUserData = $functions->getUsersData($editID, $conn);

                // Put the old and new file data in an array
                $UserData = array(
                    'Old Value' => array(
                        'Full Name' => $oldUserData['Fullname'],
                        'Username' => $oldUserData['Username'],
                        'Access Level' => $oldUserData['AccessLevel'],
                        'Status' => $oldUserData['Status']
                    ),
                    'New Value' => array(
                        'Full Name' => $newUserData['Fullname'],
                        'Username' => $newUserData['Username'],
                        'Access Level' => $newUserData['AccessLevel'],
                        'Status' => $newUserData['Status']
                    )
                );

                // Construct the description of the change
                $description = "Commited a User: <br>";
                foreach ($UserData['Old Value'] as $key => $oldValue) {
                    $newValue = $UserData['New Value'][$key];
                    $description .= sprintf("%s from %s to %s <br> ", $key, $oldValue, $newValue);
                }

                $currentDateTime = date('Y-m-d H:i A');

                //Code for the logs
                $sql_logs = "INSERT INTO Logs (User, LogType, Description, Date) VALUES ('$user_name', 'Commit', '$description', '$currentDateTime')";

                mysqli_query($conn, $sql_logs);
            } else {
                $message = "Error updating user";
                $status = "error";
            }
        }
    }elseif($_POST['target'] == "files"){
        $office = "";

        // Escape the following to prevent SQL injection
        $editID = mysqli_real_escape_string($conn, $_POST['editID']);
        $editCategoryName = mysqli_real_escape_string($conn, $_POST['nameEditCategoryName']);
        $editBarcode = mysqli_real_escape_string($conn, $_POST['nameEditBarcode']);
        $editDescription = mysqli_real_escape_string($conn, $_POST['nameEditDescription']);
        $editFileLocation = mysqli_real_escape_string($conn, $_POST['nameEditFileLocation']);
        $editDateUploaded = mysqli_real_escape_string($conn, $_POST['nameEditDateUploaded']);
        $editRegion = mysqli_real_escape_string($conn, $_POST['namefileRegion']);
        $editProvince = mysqli_real_escape_string($conn, $_POST['namefileProvince']);
        $editCityMunicipality = mysqli_real_escape_string($conn, $_POST['namefileCityMunicipality']);
        $editRemark = mysqli_real_escape_string($conn, $_POST['nameEditRemark']);

        $editDateUploaded = date('Y-m-d', strtotime($editDateUploaded));

        $query ="SELECT office_id_num FROM OfficeSettings WHERE Region='$editRegion' AND Province='$editProvince' AND cityMunicipality='$editCityMunicipality'";
        $result = mysqli_query($conn, $query);

        if($result){
            $row = mysqli_fetch_assoc($result);
            $office = $row['office_id_num'];
        }

        if($_FILES['nameEditInputFile']['name'] == null){
            // Get the old file data
            $oldFileData = $functions->getFileData($editID, $conn);

            $query = "SELECT Region, Province, cityMunicipality FROM OfficeSettings WHERE office_id_num='{$oldFileData['office_id_num']}'";
            $result = mysqli_query($conn, $query);
            $oldRegion;
            $oldProvince;
            $oldCityMunicipality;

            if($result){
                $row = mysqli_fetch_assoc($result);
                $oldRegion = $row['Region'];
                $oldProvince = $row['Province'];
                $oldCityMunicipality = $row['cityMunicipality'];
            }

            // Build the SQL query to update the category record
            $sql = "UPDATE Files SET Barcode = '$editBarcode', Category = '$editCategoryName', Description = '$editDescription', FileLocation = '$editFileLocation', Date = '$editDateUploaded', office_id_num = '$office', Remark = '$editRemark', UploadedBy = '$user_name' WHERE id_num = '$editID'";
            
            // Execute the query
            if(mysqli_query($conn, $sql)) {
                $message = "File updated successfully";
                $status = "success";

                // Get the new file data
                $newFileData = $functions->getFileData($editID, $conn);

                $query = "SELECT Region, Province, cityMunicipality FROM OfficeSettings WHERE office_id_num='{$newFileData['office_id_num']}'";
                $result = mysqli_query($conn, $query);
                $newRegion;
                $newProvince;
                $newCityMunicipality;

                if($result){
                    $row = mysqli_fetch_assoc($result);
                    $newRegion = $row['Region'];
                    $newProvince = $row['Province'];
                    $newCityMunicipality = $row['cityMunicipality'];
                }

                // Put the old and new file data in an array
                $FileData = array(
                    'Old Value' => array(
                        'File' => $oldFileData['File'],
                        'Barcode' => $oldFileData['Barcode'],
                        'Category' => $oldFileData['Category'],
                        'Region' => $oldRegion,
                        'Province' => $oldProvince,
                        'City / Municipality' => $oldCityMunicipality,
                        'Date Uploaded' => $oldFileData['Date'],
                        'Description' => $oldFileData['Description'],
                        'File Location' => $oldFileData['FileLocation'],
                        'Remark' => $oldFileData['Remark']
                    ),
                    'New Value' => array(
                        'File' => $newFileData['File'],
                        'Barcode' => $newFileData['Barcode'],
                        'Category' => $newFileData['Category'],
                        'Region' => $newRegion,
                        'Province' => $newProvince,
                        'City / Municipality' => $newCityMunicipality,
                        'Date Uploaded' => $newFileData['Date'],
                        'Description' => $newFileData['Description'],
                        'File Location' => $newFileData['FileLocation'],
                        'Remark' => $newFileData['Remark']
                    )
                );

                // Construct the description of the change
                $description = "Commited a File: <br>";
                foreach ($FileData['Old Value'] as $key => $oldValue) {
                $newValue = $FileData['New Value'][$key];
                $description .= sprintf("%s from %s to %s <br> ", $key, $oldValue, $newValue);
                }

                $currentDateTime = date('Y-m-d H:i A');

                //Code for the logs
                $sql_logs = "INSERT INTO Logs (User, LogType, Description, Date) VALUES ('$user_name', 'Commit', '$description', '$currentDateTime')";

                mysqli_query($conn, $sql_logs);
            } else {
                $message = "Error updating file";
                $status = "error";
            }
        }else{
            $fileName = $_FILES['nameEditInputFile']['name'];
            $fileTmpName = $_FILES['nameEditInputFile']['tmp_name']; // Temporary file path
            $uploadDir = '../files/'; // Upload directory
            $uploadPath = $uploadDir . basename($fileName);

            // Get the old file data
            $oldFileData = $functions->getFileData($editID, $conn);

            $query = "SELECT Region, Province, cityMunicipality FROM OfficeSettings WHERE office_id_num='{$oldFileData['office_id_num']}'";
            $result = mysqli_query($conn, $query);
            $oldRegion;
            $oldProvince;
            $oldCityMunicipality;

            if($result){
                $row = mysqli_fetch_assoc($result);
                $oldRegion = $row['Region'];
                $oldProvince = $row['Province'];
                $oldCityMunicipality = $row['cityMunicipality'];
            }

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

                    // Get the new file data
                    $newFileData = $functions->getFileData($editID, $conn);

                    $query = "SELECT Province, cityMunicipality FROM OfficeSettings WHERE office_id_num='{$newFileData['office_id_num']}'";
                    $result = mysqli_query($conn, $query);
                    $newRegion;
                    $newProvince;
                    $newCityMunicipality;

                    if($result){
                        $row = mysqli_fetch_assoc($result);
                        $newRegion = $row['Region'];
                        $newProvince = $row['Province'];
                        $newCityMunicipality = $row['cityMunicipality'];
                    }

                    // Put the old and new file data in an array
                    $FileData = array(
                        'Old Value' => array(
                            'File' => $oldFileData['File'],
                            'Barcode' => $oldFileData['Barcode'],
                            'Category' => $oldFileData['Category'],
                            'Region' => $oldRegion,
                            'Province' => $oldProvince,
                            'City / Municipality' => $oldCityMunicipality,
                            'Date Uploaded' => $oldFileData['Date'],
                            'Description' => $oldFileData['Description'],
                            'File Location' => $oldFileData['FileLocation'],
                            'Remark' => $oldFileData['Remark']
                        ),
                        'New Value' => array(
                            'File' => $newFileData['File'],
                            'Barcode' => $newFileData['Barcode'],
                            'Category' => $newFileData['Category'],
                            'Region' => $newRegion,
                            'Province' => $newProvince,
                            'City / Municipality' => $newCityMunicipality,
                            'Date Uploaded' => $newFileData['Date'],
                            'Description' => $newFileData['Description'],
                            'File Location' => $newFileData['FileLocation'],
                            'Remark' => $newFileData['Remark']
                        )
                    );

                    // Construct the description of the change
                    $description = "Commited a File: <br>";
                    foreach ($FileData['Old Value'] as $key => $oldValue) {
                    $newValue = $FileData['New Value'][$key];
                    $description .= sprintf("%s from %s to %s <br> ", $key, $oldValue, $newValue);
                    }

                    $currentDateTime = date('Y-m-d H:i A');

                    //Code for the logs
                    $sql_logs = "INSERT INTO Logs (User, LogType, Description, Date) VALUES ('$user_name', 'Commit', '$description', '$currentDateTime')";

                    mysqli_query($conn, $sql_logs);
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
