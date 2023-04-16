<?php
  // Require the Database and centralConnection classes
    require_once 'Database.php';
    require 'centralConnection.php';

    // Set the timezone to Asia/Manila
    date_default_timezone_set('Asia/Manila');

    // Start a new session
    session_start();

    // Set the default error message, verification status, and account status
    $Message = "Incorrect username or password. Please try again.";
    $Verify = false;
    $AccStatus = "";

    // Receive Data from Client
    $TxtUserName = $_POST['TxtUsername'];
    $TxtPassword = $_POST['TxtPassword'];
    $accessLevel = $_POST['accessLevel'];

    // Create a new Database object and connect to the database
    $DTSDB = new Database($Server,$User,$DBPassword);

    if ($DTSDB->Connect()==true)
    {
    // Select the target database
    $Result = $DTSDB->SelectDatabase($Database);

    if($Result == true)
    {   
        // Call the VerifyUser function to verify the user's credentials
        VerifyUser();
    }
    else
    {
        $Message = 'Failed to search user!';
        $Verify = false;
    }
    }  
    else
    {
    $Message = 'The database is offline!';
    $Verify = false;   
    } 

    // Generate the XML output
    $XMLData = '';	
    $XMLData .= ' <output ';
    $XMLData .= ' Message = ' . '"'.$Message.'"';
    $XMLData .= ' Verify = ' . '"'.$Verify.'"';
    $XMLData .= ' AccStatus = ' . '"'.$AccStatus.'"';
    $XMLData .= ' />';

    // Set the content type to text/xml and generate the XML header
    header('Content-Type: text/xml');
    echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';

    // Generate the XML body
    echo '<Document>';    	
    echo $XMLData;
    echo '</Document>';

    //Function to verify the credential of the user logging in
    function VerifyUser(){
        $sql;

        //Access Global Variables
        global $Verify, $DTSDB, $Message, $AccessLevel, $TxtUserName, $TxtPassword, $accessLevel, $AccStatus;  
        
        if($accessLevel == "staff"){
            $sql = "SELECT * FROM Users WHERE UserName = '$TxtUserName' AND AccessLevel = 'staff' AND Status = 'Activated'";
            $_SESSION['isStaff'] = true;
        }else{
            $sql = "SELECT * FROM Users WHERE UserName = '$TxtUserName' AND AccessLevel = 'admin' AND Status = 'Activated'";
            $_SESSION['isStaff'] = false;
        }
        
        $Result = $DTSDB->Execute($sql);
        
        $DTSQuery = $DTSDB->GetRows($sql);                
        
        if($DTSQuery)
        {            
            $Row = $DTSQuery->fetch_array();
            if($Row)
            {   
                $AccStatus = stripslashes($Row['Status']);

                // Store a string into the variable which need to be Encrypted
                $simple_string = stripslashes($Row['Password']);
    
                // Store the cipher method
                $ciphering = "AES-128-CTR";
    
                // Use OpenSSl Encryption method
                $iv_length = openssl_cipher_iv_length($ciphering);
                $options = 0;
    
                // Non-NULL Initialization Vector for decryption
                $decryption_iv = '1234567891011121';
    
                // Store the decryption key
                $decryption_key = "DocumentTrackingSystem";
    
                // Use openssl_decrypt() function to decrypt the data
                $decryption=openssl_decrypt ($simple_string, $ciphering, $decryption_key, $options, $decryption_iv);

                if($decryption == $TxtPassword){
                    
                    $Message = "Login Successfully.";
                    $Verify = true;
                    $_SESSION['logged_in'] = 1;
                    $_SESSION['user_id'] = stripslashes($Row['users_id_num']);
                    $_SESSION['access_level'] = stripslashes($Row['AccessLevel']);
                }
                else{
                    $Message = "Incorrect username or password. Please try again.";
                    $Verify = false;
                }

            }else{
                $Message = "Account does not exist";
                $Verify = false; 
            }
        }else{
            $Message = "Account does not exist";
            $Verify = false;
        }     
    }      
?>
