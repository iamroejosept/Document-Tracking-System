<?php 
// Require the Database and centralConnection classes
require_once 'Database.php';
require 'centralConnection.php';

// Connect to the database
$conn = mysqli_connect($Server, $User, $DBPassword, $Database);

   if(isset($_POST["region"])){
      $region = $_POST["region"];

      $output = '<option id="doNotInclude" selected disabled>Select a province</option>'; // updated default option text

      $query = "SELECT DISTINCT Province FROM OfficeSettings WHERE Region = '".$region."' AND ArchiveStatus = 'Not Archived' ORDER BY Province ASC";  
      $result = mysqli_query($conn, $query);

      if(mysqli_num_rows($result) > 0){
         while($row = mysqli_fetch_array($result)){  
            $province = $row['Province'];
            
            $output .= "  
            <option value='$province'>$province</option>
            ";
         }  
      }
      echo $output;
   }
?>
