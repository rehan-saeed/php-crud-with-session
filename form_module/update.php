<?php include "dbconfig.php";
if(isset($_POST['update'])){
  $id = $_POST['id'];
  $username       = $_POST['username'];
  $email = $_POST['email'];
  $password      = $_POST['password'];
  $cnfpassword     = $_POST['cnfpassword'];
  $gender     = $_POST['gender'];
  
  $query      = mysqli_query($conn, "UPDATE user SET username = '$username' ,password = '$password', email = '$email', cnfpassword = '$cnfpassword', gender='$gender' WHERE id = '$id'");
  if ($query) {
    header("location:table.php");
  }else{
    echo "<script>alert('Sorry update query not work')</script>";
  }
}
 ?>
<!DOCTYPE html>
<html>
<head>
 <title>PHP Crud Using Mysqli</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>
<div class="container" style="margin-top: 70px;">
 <div class="row justify-content-center">
  <div class="col-md-10 text-center">
   <?php

  if(isset($_GET['id'])): ?>
  <?php $id = $_GET['id']; ?>
  <?php $query = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id' ");
  $r = mysqli_fetch_array($query);
  $username = $r['username'];
  $email = $r['email'];
  $password = $r['password'];
  $cnfpassword = $r['cnfpassword'];
  $gender = $r['gender'];
   ?>
    <form method="POST" action="update.php">
        <div class="form-group">
          <input type="text" name="username" class="form-control" placeholder="Enter Name..." required="" value="<?php echo $username; ?>">
        </div><!-- form-group -->
        <div class="form-group">
          <input type="text" name="email" class="form-control" placeholder="Enter marks..." required="" value="<?php echo $email; ?>">
        </div><!-- form-group -->
        <div class="form-group">
          <input type="text" name="password" class="form-control" placeholder="Enter Department..." required="" value="<?php echo $password; ?>">
        </div><!-- form-group -->
        <div class="form-group">
          <input type="text" name="cnfpassword" class="form-control" placeholder="Enter result..." required="" value="<?php echo $cnfpassword; ?>">
        </div><!-- form-group -->
        <input type="hidden" name="id" value="<?php echo $id; ?>">


        <div class="form-group">

        Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
         
        </div><!-- form-group -->
        
        <div class="form-group">
          <input type="submit" name="update" class="btn btn-info" value="Edit Student">
        </div><!-- form-group -->        
       </form><!-- form -->
<?php endif; ?>



  </div><!-- col -->
 </div><!-- row -->
</div><!-- container -->


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>

</html>
