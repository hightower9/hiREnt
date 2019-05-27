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
            <a href="myprod" class="breadcrumb">Edit Profile</a>
          </div>
        </div>
      </nav>
    </div>
   </div>

<div class="container editprofile">
  <div class="container">
<div class="card">
      <div class="row">

        <?php

// connect to the database
require "db.php";

// confirm that the 'id' variable has been set
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
// get the 'id' variable from the URL
$id = $_GET['id'];

// delete record from database

 mysqli_query($con,"UPDATE product SET deleted='yes' WHERE id = '".$id."'" )or die(mysql_error());

   // header('Location: myprod');
  echo "<script>
  alert('Product Deleted');
  window.location.href='myprod'</script>";

$con->close();


}


?>

</div>
</div>
</div>
</div>

    <?php require 'includes/footer.php'; ?>