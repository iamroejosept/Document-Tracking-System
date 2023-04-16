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

        public function getDocumentCategoryData($ID, $conn){
            // Prepare the SQL query
            $sql = "SELECT * FROM DocumentCategory WHERE id_num = $ID";

            // Execute the query
            $result = mysqli_query($conn, $sql);

            // Get the user data
            $Data = mysqli_fetch_assoc($result);

            // Return the user data
            return $Data;
        }

        public function getOfficeCategoryData($ID, $conn){
            // Prepare the SQL query
            $sql = "SELECT * FROM OfficeSettings WHERE office_id_num = $ID";

            // Execute the query
            $result = mysqli_query($conn, $sql);

            // Get the user data
            $Data = mysqli_fetch_assoc($result);

            // Return the user data
            return $Data;
        }

        public function getUsersData($ID, $conn){
            // Prepare the SQL query
            $sql = "SELECT * FROM Users WHERE users_id_num = $ID";

            // Execute the query
            $result = mysqli_query($conn, $sql);

            // Get the user data
            $Data = mysqli_fetch_assoc($result);

            // Return the user data
            return $Data;
        }
    }
?>