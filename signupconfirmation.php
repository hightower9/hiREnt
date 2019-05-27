<?php
if (isset($_POST['signup'])) {

  $email = $_POST['email'];
  $firstname = $_POST['name'];
  $password = $_POST['password'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $country = $_POST['country'];

  $encryptedpass = md5($password);


  include 'db.php';

  //connecting & inserting data

  $query = "INSERT INTO users(email,
firstname,
lastname,
password,
city,
zipcode,
mob_no
state,
logged_in,
) VALUES ('$email',
'$firstname',

'$encryptedpass',
'$address',
'$city',
'$country',
'client')";

if ($connection->query($query) === TRUE) {


         echo "<div class='center-align'>
         <h5 class='black-text'>Welcome <span class='green-text'>$firstname</span> Please Log In</h5><br><br>
         <a class='button-rounded btn waves-effects waves-light'>Log In</a>
         </div>";

     } else {
         echo "<h5 class='red-text'>Error: " . $query . "</h5>" . $connection->error;
     }

     $connection->close();

}

?>
