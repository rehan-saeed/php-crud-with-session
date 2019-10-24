<?php

session_start();

include_once ("dbconfig.php");

if ($_SESSION["username"]==true)
{

}
else{
    header('location:login.php');
}

$page=(isset($_GET['page']) ? $_GET['page']:1);
$perpage=(isset($_GET['per-page']) && ($_GET['per-page']) <= 50 ?  $_GET['per-page']:5);
$start=($page>1)? ($page * $perpage) - $perpage:0;


$sql="SELECT * FROM user limit ".$start." , ".$perpage."  ";

$total=mysqli_query($conn, "SELECT * from user")->num_rows;
$pages=ceil($total/$perpage);
$result=mysqli_query($conn, $sql);


// $query="SELECT * FROM user ORDER BY id DESC";
// $result=mysqli_query($conn, $query);



?>

<!doctype html>
<html lang="en">
  <head>
    <title>Admin Panel</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
  .hrow{
    background-color:#004085;
    color:whitesmoke;
  }
  </style>
  </head>
  <body>




  <table class="table table-striped table-inverse table-responsive table-bordered">
  <div class="row hrow">
  <div class="col-sm-4"><h3 ><i class="fa fa-pagelines" aria-hidden="true"></i> AdminPanel</h3></div>  
  <div class="col-sm-4"><a href="insert.php" class="  btn btn-success  " role="button" ><i class="fa fa-plus" aria-hidden="true"></i> Add New User</a> </div>
  <div class="col-sm-4"><a href="signout.php" class="  btn btn-success  " role="button" ><i class="fa fa-plus" aria-hidden="true"></i> logout</a> </div>
</div> <br>

  
  <div class="col-sm-12">
    <h5 class="card-title"><i class="fa fa-fw fa-search"></i> Find User</h5>
    <form method="post" action="searching.php" >
        <div class="row">
            <!-- <div class="col-sm-2">
                <div class="form-group">
                    
                    <input type="text" name="username" id="username" class="form-control"   placeholder="Enter user name">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    
                    <input type="email" name="email" id="useremail" class="form-control"  placeholder="Enter user email">
                </div>
            </div> -->

            <div class="col-sm-4">
                <div class="form-group">
                    
                    <input type="text" name="search" required=""  class="form-control"  placeholder="Search by name">
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    
                <button type="submit" name="submit"   class=" btn btn-primary"   placeholder="Search by name" ><i class="fa fa-fw fa-search"></i> Search </button>
                    <!-- <div><a href="search.php"  type="submit" name="submit" value="search" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Search</a></div> -->
                </div>
            </div>
        </div>
    </form>
</div> 
<br>

  <!-- <h3>List of All Users</h3> <br> -->

      <thead class="thead-inverse">
          <tr>
              <th>id</th>
              <th>name</th>
              <th>email</th>
              <th>password</th>
              <th>confirm password</th>
              <th>Gender</th>
              <th>Action</th>
          </tr>
          </thead>
          <!-- <tbody>
              <tr>
                  <td scope="row"></td>
                  <td></td>
                  <td></td>
              </tr>
              <tr>
                  <td scope="row"></td>
                  <td></td>
                  <td></td>
              </tr>
          </tbody> -->

          <?php

          foreach($result as $res){
            
            
            echo"<tr>";
            echo"<td>".$res['id']. "</td>";
            echo"<td>".$res['username']. "</td>";
            echo"<td>".$res['email']. "</td>";
            echo"<td>".$res['password']. "</td>";
            echo"<td>".$res['cnfpassword']. "</td>";
            echo"<td>".$res['gender']. "</td>";
            echo "<td>";
            echo "<a href='read.php?id=". $res['id'] ."' title='View Record' data-toggle='tooltip'><span class='btn btn-primary'>View</span></a>";
            echo "<a href='update.php?id=". $res['id'] ."' title='Update Record' data-toggle='tooltip'><span class='btn btn-warning'>Update</span></a>";
            echo "<a href='delete.php?id=". $res['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='btn btn-danger'>Delete</span></a>";
            echo "</td>";
            echo "</tr>";
            
          }

          ?>
  </table>  

  

  <ul class="pagination  justify-content-center " style="margin:20px 0" >

  <?php for($i=1; $i<=$pages; $i++): ?>

  
  <li class="page-item "> <a class="page-link" href="?page=<?php echo $i;?>&per-page=<?php echo $perpage;?>"> <?php echo $i; ?> </a>  </li>



        <?php endfor; ?>
      

</ul>








  

  
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>