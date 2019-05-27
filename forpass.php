<?php

session_start();

if (!isset($_SESSION['logged_in'])) {
  $nav ='includes/nav.php';
}
error_reporting(0);

require 'includes/header.php';
require $nav; ?>




<div class="container-fluid center-align sign">
  <div class="container">

    <div class="row">
      <div class="col s12">
       <ul class="tabs">
        <li class="tab col s3"><a  href="#test1">Forgot Password</a></li>
      </ul>
    </div>


 <?php

        // Establish database connection

define('HOST','localhost');
define('USER','admin');
define('PASS','admin123');
define('DB','hirent');
$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
        // mysql_connect('localhost', 'alister', 'alister123') or die(mysql_error()); // Connect to database server(localhost) with username and password.
        // mysql_select_db('registrations') or die(mysql_error()); // Select registrations database.



        if(isset($_POST['email1']) && !empty($_POST['email1'])){
        // Form Submited
            $email1 = mysqli_real_escape_string($con,$_POST['email1']); // Turn our post into a local variable
            if(!filter_var($email1,FILTER_VALIDATE_EMAIL)){
    // Return Error - Invalid Email
                $msg = 'The email you have entered is invalid, please try again.';
            }else{
    // Return Success - Valid Email
               $sql = "SELECT name from users where email='".$email1."' ";

              $result = $con->query($sql);
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_object())
                {
                  $name1=$row->name;
                }

                $passw = rand(1000,5000);



                $sql2 = "UPDATE users SET password='".md5($passw)."' where email='".$email1."' ";
              $result2 = $con->query($sql2);

$to      = $email1; // Send email to our user
$subject = 'Forgot Password | hiREnt'; // Give the email a subject 
$message = '

'.$name1.', as per your request your password has been changed.
Please login with your new password.

Details:
------------------------
Email: '.$email1.'
Password: '.$passw.'
------------------------


'; // Our message above including the link
// From:alisterpereira96@gmail.com
$headers = 'From:hiREnt' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email

// $msg = 'Password has been sent to your Email';
//  $error='You have not Created have an account
//                   Please Sign up with hiREnt';

echo "<script>
        alert('Password has been sent to your Email');
        window.location.href='login'</script>"; 



              }
              else{
$msg = 'You have not Created have an account
                  Please Sign up with hiREnt';
               
              }
}
}

?>

<!-- stop php code -->

<!-- title and description -->   

<p>Please enter your Email Addres</p>

<?php 
    if(isset($msg)){  // Check if $msg is not empty
        echo '<div>'.$msg.'</div>'; // Display our message and wrap it with a div with the class "statusmsg".
    } 
    ?>



<div class="card">
    <div class="row">
     <form class="col s12" method="POST" >

       <div class="input-field col s12">
         <i class="material-icons prefix">email</i>
         <input id="email1" type="text" name="email1" class="validate">
         <label for="email1">Email</label>
       </div>
       

       <div class="center-align">
      <!--   <button type='submit' id='submit' name='submit' class='btn-large meh button-rounded waves-light'>Submit</button> -->
        <input type="submit" id="submit" class="btn-large meh button-rounded waves-light" value="Submit" />
       </div>

    

     </form>


<?php



//if(isset($_GET['submit'])){
           // if(isset($_POST['submit'])){

               // $email1 = mysqli_real_escape_string($con,$_POST['email1']);

//                $passw = rand(1000,5000);

//               $sql = "SELECT name from users where email='".$email1."' ";

//               $result = $con->query($sql);
//               if ($result->num_rows > 0) {
//                 while ($row = $result->fetch_object())
//                 {
//                   $name1=$row->name;
//                 }

//                 $sql2 = "UPDATE users SET password='".md5($passw)."' where email='".$email1."' ";
//               $result2 = $con->query($sql2);

// $to      = $email1; // Send email to our user
// $subject = 'Forgot Password | hiREnt'; // Give the email a subject 
// $message = '

// '.$name1.',As per your request your password has been changed.
// Please login with your new password.

// Details:
// ------------------------
// Email: '.$email1.'
// Password: '.$passw.'
// ------------------------


// '; // Our message above including the link
// // From:alisterpereira96@gmail.com
// $headers = 'From:hiREnt' . "\r\n"; // Set from headers
// mail($to, $subject, $message, $headers); // Send our email

//                 alert("Password has been sent to your Email");
//                header('Location: login');
//               }
//               else{
//                 $error='You have not Created have an account
//                   Please Sign up with hiREnt';
// echo "<script type='text/javascript'>alert(<?php echo $error; <!--  -->
                
//                header('Location: sign');
//               }

              



//}
//}

?>

   </div>
 </div>
</div>
</div>
</div>
</div>


  <?php require 'includes/footer.php'; ?>