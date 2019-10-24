<?php
// session_start();
// if (isset($_SESSION['username'])!="")
// {
//     header("Location:signup.php");
// }

$nameErr=$emailErr=$passwordErr=$cnfpasswordErr="";
$username=$email=$password=$cnfpassword="";


include_once 'dbconfig.php' ;

if(isset($_POST['submit'])){



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

		$query="INSERT INTO user(username,email,password,cnfpassword)
		VALUES('".$username."','".$email."','".$password."','".$cnfpassword."')";
		$result=mysqli_query($conn,$query);

		if($result="true")

		{
			// $msg='congratulation you have sucessfully registered.';
			header("Location:home.php");
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








<html>
<head>
<link rel="stylesheet" href="signup.css">
<title>Creative Colorlib SignUp Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>Creative SignUp Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<input class="text" type="text" name="username" placeholder="username" required="">
					<span class="error">* <?php echo $nameErr;?></span>
					<input class="text " type="email" name="email" placeholder="email" required="">
					<span class="error">*<?php echo $emailErr;?></span>
					<input class="text" type="password" name="password" placeholder="password" required="">
					<span class="error">* <?php echo $passwordErr;?></span>
					<input class="text " type="password" name="cnfpassword" placeholder="Confirm Password" required="">
					<span class="error">* <?php echo $cnfpasswordErr;?></span> <br>
					Gender:
  <input type="radio" name="gender" required=""<?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" required=""<?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" required=""<?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
  <span class="error">* </span>  <br> <br>
					<div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox" required="">
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div>
					<input type="submit" name="submit" value="SIGNUP">
				</form>
				<p>Don't have an Account? <a href="#"> Login Now!</a></p>
			</div>
		</div>
		<!-- copyright -->
		<div class="colorlibcopy-agile">
			<p>© 2018 Colorlib Signup Form. All rights reserved | Design by <a href="https://colorlib.com/" target="_blank">Colorlib</a></p>
		</div>
		<!-- //copyright -->
		<ul class="colorlib-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<!-- //main -->
</body>
</html>