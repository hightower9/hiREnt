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
  $idsess = $_SESSION['email'];
}
error_reporting(0);

require 'includes/header.php';
require $nav; ?>




<div class="container-fluid center-align sign">
  <div class="container">

    <div class="row">
      <div class="col s12">
       <ul class="tabs">
        <!-- <li class="tab col s3"><a  href="#test2">Sign Up</a></li> -->
        <li class="tab col s3"><a  href="#test1">Log In</a></li>
      </ul>
    </div>

<div class="card">
    <div class="row">
     <form class="col s12" method="POST" >

       <div class="input-field col s12">
         <i class="material-icons prefix">email</i>
         <input id="email1" type="text" name="email1" class="validate">
         <label for="email1">Email</label>
       </div>
       <div class="input-field col s12">
         <i class="material-icons prefix">lock</i>
         <input id="password" type="password" name="password" class="validate">
         <label for="password">Password</label>
       </div>
   <p>Not Created an Account yet??? <a href="sign" title="Sign Up" style="margin-right: 340px;">Sign Up</a><a href="forpass" title="Forgot Password">Forgot Password</a></p>

       <div class="center-align">
         <input type="button" id="login" name="login" value="login" class="btn button-rounded teal accent-3"/>
       </div>

    

     </form>
   </div>
 </div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
    $(function(){
      $("#login").click(function(event) {
        $.ajax({
          url: 'connect.php',
          type: 'POST',
          data: {email1: $("#email1").val(),password: $("#password").val()},
          success:function(response){
            if(response==1)
            {
               //alert("User logged in successfully");
               window.location.href="index.php"
            }
            else
            {
              alert("Error logging user");
            }
          }
        })  
      });
    });
  </script>

  <?php require 'includes/footer.php'; ?>