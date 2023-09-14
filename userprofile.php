<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: *");

// Create connection
$conn = new mysqli("localhost", "root", "", "new_project") or die("Error in connection");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
// SQL query to retrieve username and email
$sql = "SELECT user_name, email FROM users WHERE id = 30"; // You can adjust the WHERE clause as needed

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = array(
        'username' => $row['user_name'],
        'email' => $row['email']
    );
   // echo $data;
    echo json_encode($data);
} else {
    echo "No user found";
}

$conn->close();
?>
