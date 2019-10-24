<html>

<body>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$db="school";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name=$_POST["name"];
$email=$_POST["email"];
$phone=$_POST["phone_no"];
$address=$_POST["address"];
$class=$_POST["class"];
$subject=$_POST["subject"];
$roll=$_POST["roll_no"];

}

// Create connection
$conn =  mysqli_connect($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";




    $sql = "INSERT INTO student ( name, email, phone_no, address, class, subject, roll_no )
VALUES ('$name', '$email', '$phone', '$address', '$class', '$subject', '$roll')";



if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
 ?>







<h1>A small example page to insert some data in to the MySQL database using PHP</h1>

<form action="" method="post">

Firstname: <input type="text" name="name" /><br><br>

Email: <input type="text" name="email" /><br><br>
Phone: <input type="text" name="phone_no" /><br><br>
Address: <input type="text" name="address" /><br><br>
Class: <input type="text" name="class" /><br><br>
Subject: <input type="text" name="subject" /><br><br>
Roll No: <input type="text" name="roll_no" /><br><br>

 

<input type="submit" />

</form>

</body>
</html>