<?php
session_start();
 include 'db.php';
  $idsess = $_SESSION['email'];
   $pid = $_SESSION['pid'];
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="mrXdz3wVev";
If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
  
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   }
	   else {

$sql = "INSERT INTO payment(txnid,amount,email,status,productid,ttime) VALUES('".$txnid."','".$amount."','".$email."','".$status."','".$pid."',CURRENT_TIMESTAMP)";  
       
       if(mysqli_query($con,$sql)){

$sql1 = "UPDATE product SET deleted='yes' WHERE id = $pid" ;
if(mysqli_query($con,$sql1)){
          echo"<div  align='center'>";
          echo "<h3>Thank You. Your order status is ". $status .".</h3>";
          echo "<h4>Your Transaction ID for this transaction is ".$txnid.".You may try making the payment by clicking the link below.</h4>";
          //echo "<button class type='submit' onclick='Hirent1/index.php' value='Back to to hiREnt' title='Continue to hiREnt'></button>";
          echo' <a href="upload.php" shape="rect" > Try again</a>';
          echo "</div>" ;
        }
   else{
          
    echo $con->error;
  }
   
   }
    else{
          
    echo $con->error;
  }
  mysqli_close($con);


		 } 
?>
