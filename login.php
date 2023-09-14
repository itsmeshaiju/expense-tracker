<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: *");

// Ensure the request method is POST


$data = json_decode(file_get_contents('php://input'));

if (!$data) {
    echo "error"; // Invalid JSON data
    
} else {
    $email = $data->email;
    $password = $data->password;
    $con = new mysqli("localhost", "root", "", "new_project") or die("Error in connection");
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $email); // Bind the email parameter
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    echo $newHashedPassword = password_hash('$password', PASSWORD_BCRYPT);
    echo "\n";
    echo $user['password'];

   
   // if (($email === $user['email']) && ($password === $user['password'])) {
    if (($email === $user['email']) && (password_verify($password, $user['password']))) {
   
        $response = [
            "success" => true,
            "user" => $user
        ];
       echo json_encode($response);
         
         
        
} else {
    $response = [
        "success" => false,
        "error" => "User not found or invalid credentials"
    ];
    echo json_encode($response);

}
    $stmt->close();
    $con->close();
}

   
?>
