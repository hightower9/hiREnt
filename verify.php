<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Hirent > Sign up Verify</title>
    <link href="src/css/style1.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <!-- start header div --> 
    <div id="header">
        <h3 class="center">Hirent | Sign up Verification</h3>
    </div>
    <!-- end header div -->   
    
    <!-- start wrap div -->   
    <div id="wrap">
        <!-- start PHP code --> 
        <?php

        // $email = $_REQUEST['email'];
        // $hash = $_REQUEST['hash'];
        
      define('HOST','localhost');
define('USER','admin');
define('PASS','admin123');
define('DB','hirent');
$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect'); // Select registration database.

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email = mysqli_real_escape_string($con,$_GET['email']); // Set email variable
    $hash = mysqli_real_escape_string($con,$_GET['hash']); // Set hash variable
    
    $search = mysqli_query($con,"SELECT email, hash, active FROM users WHERE email='".$email."' AND hash='".$hash."' AND active='0'") or die(mysql_error()); 

    // $result = $con->query($search);
    // $match=$result->num_rows;
    // $match  = mysql_num_rows($search);
    // if($match > 0)
    if ($search->num_rows > 0){
        // We have a match, activate the account
        mysqli_query($con,"UPDATE users SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'") or die(mysql_error());
        echo '<div class="statusmsg">Your account has been activated, you can now login</div>';
    }else{
        // No match -> invalid url or account has already been activated.
        echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
    }
    
}else{
    // Invalid approach
    echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
}
?>
<!-- stop PHP Code -->


</div>
<!-- end wrap div --> 
</body>
</html>