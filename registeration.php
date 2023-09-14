<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: *");

    // Function to validate email address
    function is_valid_email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    $data = json_decode(file_get_contents('php://input'));

    if (!$data) {
        echo "error"; // Invalid JSON data
    } else {
        $username = $data->username;
        $email = $data->email;
        $password = $data->password;

    // Validate data
        if (empty($username) || empty($email) || empty($password) || !is_valid_email($email)) {
            echo "error"; // Invalid or missing data
        } else {
            $con = new mysqli("localhost", "root", "", "new_project") or die("Error in connection");
           
            $hashedPassword = password_hash('$password', PASSWORD_BCRYPT);
          
            $query = "Insert into users(user_name,email,password) values('$username','$email','$hashedPassword');";

            $res = $con->query($query);
        
            if($res) {
                echo "success";
            } 
            else {
                echo "error";
            }
       }
    }
?>
