<?php
    class Functions{
        public function getFileData($ID, $conn){
            // Prepare the SQL query
            $sql = "SELECT * FROM Files WHERE id_num = $ID";

            // Execute the query
            $result = mysqli_query($conn, $sql);

            // Get the user data
            $fileData = mysqli_fetch_assoc($result);

            // Return the user data
            return $fileData;
        }
    }
?>