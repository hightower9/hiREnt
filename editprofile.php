<?php

session_start();

if (!isset($_SESSION['logged_in'])) {
  header('Location: sign');
}

else {
  $sessid = $_SESSION['email'];
}
require 'includes/header.php';
require 'includes/navconnected.php'; //require $nav;?>

<div class="container-fluid product-page">
 <div class="container current-page">
  <nav>
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="index" class="breadcrumb">hiREnt</a>
        <a href="editprofile" class="breadcrumb">Edit Profile</a>
      </div>
    </div>
  </nav>
</div>
</div>

<div class="container editprofile">
  <div class="container" style="margin-top: 40px;">
    <div class="card">
      <div class="row">

       <form class="col s12" method="POST" >
         <div class="row">

           <?php
           require "db.php";
           if (isset($_POST['update'])) {
             $pk1 = mysqli_real_escape_string($con,$_POST['pk1']);
             $pk2 = mysqli_real_escape_string($con,$_POST['pk2']);
             $mb = mysqli_real_escape_string($con,$_POST['mb']);


                if(isset($_POST['pk1'])){
             if (strcmp($pk1,$pk2) != 0) {
               $msg = 'The password entered do not match.';
             }else{

               // $newemail = $_POST['email'];
               $newpassword = md5($_POST['pk1']);

               
              // update info on users Toble
               $queryupdate = "UPDATE users SET password ='".$newpassword."' WHERE email='".$sessid."'";
               $result = $con->query($queryupdate);
               

               echo "<meta http-equiv='refresh' content='0'; url='editprofile' />";
             }
           }
             if(isset($_POST['mb'])){
               $queryupdate1 = "UPDATE users SET mob ='".$mb."' WHERE email='".$sessid."'";
               $result1 = $con->query($queryupdate1);

             }
             echo "<script>
  alert('Details updated successfully');
  window.location.href='index'</script>"; 
           }

           ?>
           <?php 
    if(isset($msg)){  // Check if $msg is not empty
        echo '<label class="statusmsg">'.$msg.'</label>'; // Display our message and wrap it with a div with the class "statusmsg".
      } 
      ?>


      <div class="col s12" style="padding-left: 40px;padding-right: 40px;padding-top: 20px;">
        
       
      <!--  <div class="input-field col s12">
         <i class="material-icons prefix">email</i>
         <input id="icon_prefix" type="text" name="email" value="<?php $sessid ?>" class="validate" required>
         <label for="icon_prefix">Email</label>
       </div> -->

       <div class="input-field col s12">
         <i class="material-icons prefix">lock</i>
         <input id="pk1" type="password" name="pk1" class="validate value1">
         <label for="pk1">New Password</label>
       </div>

       <div class="input-field col s12 meh">
         <i class="material-icons prefix">lock</i>
         <input id="pk2" type="password" name="pk2" class="validate value2">
         <label for="pk2">Confirm Password</label>
       </div>

       <div class="input-field col s12 meh">
         <i class="material-icons prefix">phone</i>
             <input type="tel" id="mb" name="mb" maxlength="10" pattern="^\d{10}$">
             <label for="mb">Mobile Number</label>
       </div>


     </div>
     

     <div class="center-align">
       <button type="submit" id="update" name="update" class="btn teal accent-3 button-rounded waves-light" title="Submit">Submit</button>
     </div>

   </div>
 </form>
</div>
</div>
</div>
</div>

<?php require 'includes/footer.php'; ?>
