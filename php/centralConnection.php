<?php 
  $Server = "localhost";    
  $User = "root";
  $DBPassword = "";
  $Database = "docutrace";

  $con = mysqli_connect($Server, $User, $DBPassword, $Database);
  $connect = mysqli_connect($Server, $User, $DBPassword, $Database);
  $connectPDO = new PDO("mysql:host=$Server;dbname=$Database", $User, $DBPassword);
  $connection = new mysqli($Server, $User, $DBPassword, $Database);
  

?>