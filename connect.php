																																	
<?php 
require "db.php";

$email1= mysqli_real_escape_string($con,$_POST['email1']);
$password12= mysqli_real_escape_string($con,md5($_POST['password']));

$sql = "SELECT email,password,name from users where email='".$email1."' and password='".$password12."' and  active='1' ";

$result = $con->query($sql);
if ($result->num_rows > 0) {
	while($rowfirst = mysqli_fetch_assoc($result)) {

             $uname = $rowfirst['name'];
         }
	session_start();
	$_SESSION["email"] = $email1;
   $_SESSION['logged_in']= 'True';
	$_SESSION["name"] = $uname;
   
	echo "1";
}
else
{
	echo "0";
}