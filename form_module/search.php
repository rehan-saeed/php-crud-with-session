<?php 
include 'dbconfig.php';
if(isset($_POST['submit'])){
    $search = $_POST['search'];
    
   
    $sql = "select * from user where username  LIKE '%$search%'";
    $result = mysqli_query($conn,$sql);
?>




<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>


<div>
    <h2>Search User</h2>
</div>

<table>
<thead>
 <tr>
    <th>#serial</th>
    <th>First Name</th>
    <th>Last Name</th>
    
  </tr>
</thead>
 <tbody>
  
     
    
    <?php  while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['id'];?></td>
         <td><?php echo $row['username'];?></td>
         <td><?php echo $row['email']; ?></td>
         
    </tr>
    
    <?php 
        
      }  
    
               
               
     } ?>
     
 </tbody>


</table>

</body>
</html>