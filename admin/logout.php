
<!DOCTYPE html>
<html>
<body>

<?php
session_start();
// remove all session variables

unset($_SESSION["email"]);
// destroy the session 
session_destroy(); 
header("location:index.php");


	
?>

</body>
</html>