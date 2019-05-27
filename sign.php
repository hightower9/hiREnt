<?php

session_start();

if (!isset($_SESSION['logged_in'])) {
  $nav ='includes/nav.php';
}

elseif($_SESSION['logged_in'] == 'True') {
  header('Location: index.php');
}

else{
  $nav ='includes/navconnected.php';
  $idsess = $_SESSION['uid'];
}
error_reporting(0);

require 'includes/header.php';
require $nav; ?>



<div class="container-fluid center-align sign">
  <div class="container">

    <div class="row">
      <div class="col s12">
     <!--   <ul class="tabs"> -->
       <!--  <li class="tab col s3"><a  href="#test2">Sign Up</a></li> -->
       <!--  <li class="tab col s3"><a  href="#test1">Log In</a></li> -->
   <!--    </ul> -->
    </div>

    <div class="container forms">
     <div class="row">

      <div id="test2" class="col s12 left-align">
       <?php require '12.php';?>
</div>



<!-- <div id="test1" class="col s12 left-align">

  <div class="card">
    <div class="row">
     <form class="col s12" method="POST" >

       <div class="input-field col s12">
         <i class="material-icons prefix">email</i>
         <input id="uid" type="text" name="uid" class="validate">
         <label for="uid">User ID</label>
       </div>
       <div class="input-field col s12">
         <i class="material-icons prefix">lock</i>
         <input id="password" type="password" name="password" class="validate">
         <label for="password">Password</label>
       </div>


       <div class="center-align">
         <input type="button" id="login" name="login" value="login" class="btn button-rounded"/>
       </div>

    

     </form>
   </div>
 </div>

</div> -->
</div>
</div>
</div>
</div>
</div>
 

<!-- <script type="text/javascript">
    $(function(){
      $("#sign").click(function(event) {

 var password = $("#pwd1").val();
      var confirmPassword = $("#pwd2").val();
if (password != confirmPassword) 
        {
          alert("Passwords do not match.");
        }
        else
        {

        $.ajax({
          url: 'signin.php',
          type: 'POST',
          data: {email: $("#email").val(),password1: $("#pwd1").val(),firstname: $("#name").val(),state: $("#state").val(),zp: $("#zp").val(),mb: $("#mb").val()},
          success:function(response){
            if(response==1)
            {
               alert("You have signed in successfully!!")
            }
            else
            {
              alert("Error");
            }
          }
        })  
      }
      });
    });
  </script> -->
<?php require 'includes/footer.php'; ?>
