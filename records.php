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
            <a href="myprod" class="breadcrumb">Edit Products</a>
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

require "db.php";

/*

EDIT RECORD

*/
// if the 'id' variable is set in the URL, we know that we need to edit a record
if (isset($_GET['id']))
{
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
 $price = mysqli_real_escape_string($con,$_POST['price']);
  $available = mysqli_real_escape_string($con,$_POST['available']);
  $id = mysqli_real_escape_string($con,$_GET['id']);


// check that firstname and lastname are both not empty
if ($price == '' || $available == '')
{
// if they are empty, show an error message and display the form
alert("Please enter the field details");
}else
{
   mysqli_query($con,"UPDATE product SET price = '".$price."', available = '".$available."'
WHERE id='".$id."'")or die(mysql_error());

   // header('Location: myprod');
   echo "<script>
  alert('Product Updated');
  window.location.href='myprod'</script>";
}
}

}


// close the mysqli connection

?>
<h3 style="margin-left: 40px;padding-top: 20px;"><?php if ($sessid != '') { echo "Edit"; } ?></h3>



<form method="post">
<div style="padding: 40px;">
<?php if ($sessid != '') { ?>
<p style="font-weight: bold;">ID: <?php echo $sessid; ?></p>
<?php } ?>

<div class="input-field col s6">
           <i class="material-icons prefix">local_atm</i>
           <input id="price" class="validate" type="text" name="price" >
           <label for="price">Price per Day</label>
         </div>

<div class="input-field col s6"><i class="material-icons prefix">flag</i>
              <select class="icons" id="available" name="available" multiples>
                <option  disabled selected>Choose Available</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
              <label>Available</label>
            </div>

<div class="center-align">
         <input type="submit" name="submit" value="Edit" class="btn button-rounded waves-effect waves-light" style="margin-top: 30px;"/> 
         
       </div>
</div>
</form>





</div>
</div>
</div>
</div>

    <?php require 'includes/footer.php'; ?>