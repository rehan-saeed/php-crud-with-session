<?php
$servername = "localhost";
$username = "root";
$password = "";
$db="forms";

// Create connection
$conn =  mysqli_connect($servername, $username, $password, $db);
// or die("oops something went wrong");

// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";
// $sql = "INSERT INTO student ( name, email, phone_no, address, class, subject, roll_no )
// VALUES ('john', 'Doe@gmail.com', '03029814997', 'sahiwal', 'it', 'computer', '5231')";

// if ($conn->query($sql) === TRUE) {
//     echo "New record created successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

// $conn->close();

?>