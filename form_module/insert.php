<?php
// session_start();
// if (isset($_SESSION['username'])!="")
// {
//     header("Location:signup.php");
// }

$nameErr=$emailErr=$passwordErr=$cnfpasswordErr="";
$username=$email=$password=$cnfpassword=$gender="";


include_once 'dbconfig.php' ;

if(isset($_POST['insert'])){



		$username=test_input($_POST['username']) ;
		if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
			$nameErr = "Only letters and white space allowed";
		  }

	  


		$email=test_input($_POST['email']) ;
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $emailErr = "Invalid email format";
		}
	  
    

		$password=test_input($_POST['password']) ;
		// check if name only contains letters and whitespace
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);
		$specialChars = preg_match('@[^\w]@', $password);
	
	if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
		$passwordErr= 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
	}else{
		$passwordErr= '';
	}
	  



		$cnfpassword=test_input($_POST['cnfpassword']) ;
		if ($cnfpassword!==$password) {
			$cnfpasswordErr = "Enter Correct Password";
		  }

		  $gender=$_POST['gender'];

	  
    
    
	if(!$nameErr && !$emailErr && !$passwordErr && !$cnfpasswordErr  ){

		$sql_u = "SELECT * FROM user WHERE username='$username'";
  	$sql_e = "SELECT * FROM user WHERE email='$email'";
  	$res_u = mysqli_query($conn, $sql_u);
  	$res_e = mysqli_query($conn, $sql_e);

  	if (mysqli_num_rows($res_u) > 0) {
  	  $nameErr = "Sorry... username already taken"; 	
  	}else if(mysqli_num_rows($res_e) > 0){
  	  $emailErr = "Sorry... email already taken"; 	
  	}else{

		$query="INSERT INTO student(username,email,password,cnfpassword,gender)
		VALUES('".$username."','".$email."','".$password."','".$cnfpassword." ','".$gender."')";
		$result=mysqli_query($conn,$query);

		if($result="true")

		{
			// $msg='congratulation you have sucessfully registered.';
			header("Location:table.php");
			// echo "you have registered";
		}


	  }

	


		

	}

	// else
	// 	{
	// 		// $msg='Error while registering you....';
	// 		header("Location:error.php");
	// 		// echo "error";
	// 	}



}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
  }


?>



<!doctype html>
<html lang="en">
  <head>
    <title>insert</title>
    <style>
           .error {color: #FF0000;}
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>


<div class="container">
<h1> Add New User </h1> <br>
 <div class="form-group">
 <form method="POST" action="insert.php">
 
  <input type="text"
	class="form-control" name="username" id=""  placeholder="Username" required=""> 
	<small id="helpId" class="form-text text-muted">Only letters and white space allowed</small>
	<span class="error">* <?php echo $nameErr;?></span>  <br> <br>
	
	
	
    <input type="text"
	class="form-control" name="email" id=""  placeholder="Email" required="">
	<small id="helpId" class="form-text text-muted">Enter Valid Email Address</small>
	<span class="error">* <?php echo $emailErr;?></span> <br> <br>
	
    <input type="password"
	class="form-control" name="password" id=""  placeholder="password" required="">
	<small id="helpId" class="form-text text-muted">Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character</small>
    <span class="error">* <?php echo $passwordErr;?></span> <br> <br>
    <input type="password"
	class="form-control" name="cnfpassword" id=""  placeholder="Enter Password Again" required="">
	<small id="helpId" class="form-text text-muted">Password should be correct</small>
	<span class="error">* <?php echo $cnfpasswordErr;?></span> <br> <br>
	

	Gender:
  <input type="radio" name="gender" required=""<?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" required=""<?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" required=""<?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
  <span class="error">* </span>

    <br><br>

     <input type="submit" name="insert" id="" value="insert" class="btn btn-primary btn-lg btn-block">

    </form>
    
  
</div>


</div>


      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>