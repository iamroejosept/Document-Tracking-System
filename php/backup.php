<?php
require 'centralConnection.php';

$message = "";
$status = "";

// Get backup name and date from form input
$backup_name = $_POST['backup_name'];
$backup_date = $_POST['backup_date'];

// Set backup directory and filename
$backup_dir = '../backups';
if (!file_exists($backup_dir)) {
  mkdir($backup_dir, 0777, true);
}
$backup_file = $backup_dir . '/' . $backup_name . '_' . $backup_date . '.sql';

$result = exec("mysqldump --user=$User --password=$DBPassword $Database > $backup_file", $output, $return);

if ($return !== 0) {
  $message = "The backup of the database failed due to an error.";
  $status = "error";
}else{
  $message = "Database backup completed successfully";
  $status = "success";
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


