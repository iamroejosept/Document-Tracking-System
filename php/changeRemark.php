<?php
    // Require the Database and centralConnection classes
    require_once 'Database.php';
    require 'centralConnection.php';

    // Connect to the database
    $conn = mysqli_connect($Server, $User, $DBPassword, $Database);

    $id = $_REQUEST["id"];
    $remark = $_REQUEST["remark"];

    if($remark == "Submitted"){
        $sql = "UPDATE Files SET Remark='Not Submitted' WHERE id_num = $id";
        $result = mysqli_query($conn, $sql);
        header('Location: ../admin/index.php');
    }else{
        $sql = "UPDATE Files SET Remark='Submitted' WHERE id_num = $id";
        $result = mysqli_query($conn, $sql);
        header('Location: ../admin/index.php');
    }
    
?>