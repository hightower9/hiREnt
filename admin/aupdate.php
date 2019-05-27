<?php
require_once('connect.php');
session_start();
$email=$_SESSION['email'];
$fullname= mysqli_real_escape_string($con,$_POST['fullname']);
$password= mysqli_real_escape_string($con,$_POST['password']);

$sql = "update uadmin set fullname='".$fullname."', password='".$password."' where email='".$email."'";

if(mysqli_query($con,$sql)){
	echo '1';
}else{

	echo $con->error;
}
mysqli_close($con);