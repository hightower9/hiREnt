<?php 
require "connect.php";

$email= mysqli_real_escape_string($con,$_POST['email']);
$password= mysqli_real_escape_string($con,$_POST['password']);
$sql = "SELECT email,password from uadmin where email='".$email."' and password='".$password."' ";

$result = $con->query($sql);
if ($result->num_rows > 0) {
	session_start();
	$_SESSION['email'] = $email;
	echo "1";
}
else
{
	echo "0";
}