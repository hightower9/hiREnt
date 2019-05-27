<?php
 
require "db.php";


  $email = mysqli_real_escape_string($con,$_POST['email']);
  $firstname = mysqli_real_escape_string($con,$_POST['firstname']);
  $password1= mysqli_real_escape_string($con,$_POST['password1']);
  $zp = mysqli_real_escape_string($con,$_POST['zp']);
  $state = mysqli_real_escape_string($con,$_POST['state']);
  $mb = mysqli_real_escape_string($con,$_POST['mb']);

  $encryptedpass = md5($password1);


$sql = "INSERT INTO users(email,firstname,password,zipcode,mob_no,state,logged_in) VALUES('".$email."','".$firstname."','".$encryptedpass."','".$zp."','".$mb."','".$state."','False')";			


$result = $con->query($sql);
if ($result->num_rows > 0) {
// if(mysqli_query($con,$sql))
  echo "1";
}else
{
 echo "0";
}

// mysqli_close($con);