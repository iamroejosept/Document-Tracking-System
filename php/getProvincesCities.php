<?php
// Require the Database and centralConnection classes
require_once 'Database.php';
require 'centralConnection.php';

// Connect to the database
$conn = mysqli_connect($Server, $User, $DBPassword, $Database);

// Check if the connection was successful
if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if region or province value is passed via POST
if (isset($_POST["region"])) {
  // Get list of provinces based on selected region
  $region = mysqli_real_escape_string($connect, $_POST["region"]);
  $query = "SELECT DISTINCT Province FROM OfficeSettings WHERE Region = '$region' AND ArchiveStatus = 'Not Archived' ORDER BY Province ASC";
  $result = mysqli_query($connect, $query);
  $options = "";
  while ($row = mysqli_fetch_array($result)) {
    $options .= "<option value='" . $row['Province'] . "'>" . $row['Province'] . "</option>";
  }
  echo $options;
} else if (isset($_POST["province"])) {
  // Get list of cities/municipalities based on selected province
  $province = mysqli_real_escape_string($connect, $_POST["province"]);
  $query = "SELECT DISTINCT cityMunicipality FROM OfficeSettings WHERE Province = '$province' AND ArchiveStatus = 'Not Archived' ORDER BY cityMunicipality ASC";
  $result = mysqli_query($connect, $query);
  $options = "";
  while ($row = mysqli_fetch_array($result)) {
    $options .= "<option value='" . $row['cityMunicipality'] . "'>" . $row['cityMunicipality'] . "</option>";
  }
  echo $options;
}

// Close database connection
mysqli_close($connect);
?>