<div class="card">
 <div class="row">

  <div id="wrap" style="width: 550px;">

    <!-- start php code -->

    <?php

        // Establish database connection

    define('HOST','localhost');
    define('USER','admin');
    define('PASS','admin123');
    define('DB','hirent');
    $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
        // mysql_connect('localhost', 'alister', 'alister123') or die(mysql_error()); // Connect to database server(localhost) with username and password.
        // mysql_select_db('registrations') or die(mysql_error()); // Select registrations database.



    if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['email']) && !empty($_POST['email'])){
        // Form Submited
            $name = mysqli_real_escape_string($con,$_POST['name']); // Turn our post into a local variable
            $email = mysqli_real_escape_string($con,$_POST['email']); // Turn our post into a local variable
             // $passdb = mysqli_real_escape_string($con,$_POST['passdb']); // Turn our post into a local variable
             // $passdb1 = mysqli_real_escape_string($con,$_POST['passdb1']); // Turn our post into a local variable
            // $state = mysqli_real_escape_string($con,$_POST['state']); // Turn our post into a local variable
             $city = mysqli_real_escape_string($con,$_POST['city']); // Turn our post into a local variable
             $mb = mysqli_real_escape_string($con,$_POST['mob']); // Turn our post into a local variable

            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    // Return Error - Invalid Email
              $msg = 'The email you have entered is invalid, please try again.';
            }
            // if (strcmp($password,$password2) != 0) {
            //   $msg = 'The password entered is Incorrect.';
            // }
            else{

                $sql = "SELECT email from users where email='".$email."' ";

                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                  
                  $msg = 'The Email you have entered is already used, Please try another Email';
                }
                else{

                



    // Return Success - Valid Email
              $msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
                $hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
// Example output: f4552671f8909587cf485ea990207f3b
                 $password = rand(1000,5000); // Generate random number between 1000 and 5000 and assign it to a local variable.
// Example output: 4568
                mysqli_query($con,"INSERT INTO users (name, password, email,city,mob, hash) VALUES(
                  '". mysqli_real_escape_string($con,$name) ."', 
                  '". mysqli_real_escape_string($con,md5($password)) ."', 
                  '". mysqli_real_escape_string($con,$email) ."', 
                  '". mysqli_real_escape_string($con,$city) ."',  
                  '". mysqli_real_escape_string($con,$mb) ."', 
                  '". mysqli_real_escape_string($con,$hash) ."') ") or die(mysql_error());

             //$uid= $con->query("SELECT uid from users where email='".$email."'") or die(mysql_error());

                $to      = $email; // Send email to our user
$subject = 'Signup | Verification'; // Give the email a subject 
$message = '

Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

------------------------
Username: '.$name.'
Email: '.$email.'
Password: '.$password.'
------------------------

Please click this link to activate your account:
192.168.43.94/Hirent/verify.php?email='.$email.'&hash='.$hash.'

'; // Our message above including the link

$headers = 'From:alisterpereira96@gmail.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email
}


}
}

?>

<!-- stop php code -->

<!-- title and description -->   
<!-- <h3>Signup Form</h3>-->
<p>Please enter your Details to Create your Account</p>

<?php 
    if(isset($msg)){  // Check if $msg is not empty
        echo '<label class="statusmsg">'.$msg.'</label>'; // Display our message and wrap it with a div with the class "statusmsg".
      } 
      ?>

      <!-- start sign up form -->  
      <form action="" method="post" class="col s12">
       <div class="row">
         <div class="input-field col s6">
            <i class="material-icons prefix">account_circle</i>
            <input id="name" type="text" name="name" required>
            <label for="name">Full Name</label>
          </div>

        <div class="input-field col s6">
            <i class="material-icons prefix">email</i>
            <input id="email" type="email" name="email">
            <label for="email" data-error="Invalid Email" data-success="Valid">Email</label>
          </div>

           <!-- <div class="input-field col s6">
            <i class="material-icons prefix">lock</i>
            <input id="passdb" type="password" name="password" required>
            <label for="passdb">Password</label>
          </div>

          <div class="input-field col s6">
            <i class="material-icons prefix">lock</i>
            <input id="passdb1" type="password" name="confirmation" required>
            <label for="passdb1">Confirm Password</label>
          </div> -->

          <!-- <div class="input-field col s6"><i class="material-icons prefix">flag</i>
            <select class="icons"  id="state" name="state" multiples>
              <option value=""  disabled selected>Choose your state</option>
              <option value="Maharashtra">Maharashtra</option>
              <option value="Goa">Goa</option>
              <option value="Karnataka">Karnataka</option>
            </select>
            <label for="state">State</label>
          </div> -->

           

          <div class="input-field col s6">
            <i class="material-icons prefix">business</i>
            <input id="city" type="text" name="city" required>
            <label for="city">City</label>
          </div>

          <div class="input-field col s6">
            <i class="material-icons prefix">phone</i>
            <input id="mob" type="tel" name="mob" maxlength="10" class="validate" required>
            <label for="mob">Mobile Number</label>
          </div>

           <div class="col s12">
          <p>By Registering, you agree that you've read and accepted our <a href="">User Agreement</a>,
            you're at least 18 years old, and you consent to our <a href="">Privacy Notice and receiving</a>
          marketing communications from us.</p></div>
        </div>

       

           <div class="center-align">
           <input type="submit" class="btn button-rounded waves-light teal accent-3" value="Sign up" />
         <!--  <button type="submit" id="sign" name="signup" class="btn meh button-rounded waves-light ">Sign up</button>-->
        </div>


      </div>
    </form>
    <!-- end sign up form -->

  </div>
</div>
</div>