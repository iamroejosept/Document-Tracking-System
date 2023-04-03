<?php 
// Require the Database and centralConnection classes
require_once 'Database.php';
require 'centralConnection.php';

// Connect to the database
$conn = mysqli_connect($Server, $User, $DBPassword, $Database);

   if(isset($_POST["province"])){
      $province = $_POST["province"];

      $output = '<option id="doNotInclude" selected disabled>Select a city/municipality</option>'; // updated default option text

      $query = "SELECT DISTINCT cityMunicipality FROM OfficeSettings WHERE Province = '".$province."' ORDER BY cityMunicipality ASC";  
      $result = mysqli_query($conn, $query);

      if(mysqli_num_rows($result) > 0){
         while($row = mysqli_fetch_array($result)){  
            $cityMunicipality = $row['cityMunicipality'];
            
            $output .= "  
            <option value='$cityMunicipality'>$cityMunicipality</option>
            ";
         }  
      }
      echo $output;
   }
?>
