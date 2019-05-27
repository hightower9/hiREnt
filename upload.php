<?php

session_start();

if (!isset($_SESSION['logged_in'])) {
  $nav ='includes/nav.php';
  header('Location: login.php');
}

else {
  

  $nav ='includes/navconnected.php';
  $idsess = $_SESSION['email'];
}
error_reporting(0);

require 'includes/header.php';
require $nav; 


?>

<div class="container-fluid center-align sign">
  <div class="container">

    <div class="row">
      <div class="col s12">
       <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#test1">Post Ad</a></li>
      </ul>
    </div>

    <div class="container forms">
     <div class="row">


      <div id="test1" class="col s12 left-align">
        <div class="card">
          <div class="row">
           <form class="col s12" method="POST"  action="addpro.php" method="post" enctype="multipart/form-data" id="uploadimage"  >

            <div class="input-field col s6">
              <i class="material-icons prefix">important_devices</i>
              <input id="prodname" type="text" name="prodname" class="validate" required>
              <label for="prodname">Product Name</label>
            </div>
             <input type="hidden" name="email" id="email" value="<?php echo $idsess ?>"/>
            <div class="input-field col s6"><i class="material-icons prefix">flag</i>
              <select class="icons" id="cat" name="cat" multiples>
                <option value=""  disabled selected>Choose your category</option>
                <option value="1">Vehicle</option>
                <option value="2">Furniture</option>
                <option value="3">Electronics</option>
              </select>
              <label>Category</label>
            </div>

            <div class="input-field col s6">
             <i class="material-icons prefix">phone</i>
             <input type="tel" id="mb" name="mb" maxlength="10" pattern="^\d{10}$" required>
             <label for="mb">Mobile Number</label>
           </div>

           <div class="input-field col s6">
            <i class="material-icons prefix">business</i>
            <select class="icons" id="city" name="city" multiples required>
            <option value=""  disabled selected>Choose your City</option>
            <option value="Panaji">Panaji</option>
            <option value="Margao">Margao</option>
            <option value="Vasco">Vasco</option>
            <option value="Mapusa">Mapusa</option>
            <option value="Ponda">Ponda</option>
            </select>
            <label for="city">City</label>
          </div>

          <div class="input-field col s6">
           <i class="material-icons prefix">local_atm</i>
           <input id="ppd" name="ppd" class="validate" type="text" required>
           <label for="ppd">Price per Day</label>
         </div>

         <div class="input-field col s6">
           <i class="material-icons prefix">description</i>
           <input id="descrip" name="descrip" class="validate" type="text" required>
           <label for="descrip">Description...</label>
         </div>


         <div class="input-field col s6">
          <i class="material-icons prefix">flare</i>
          <select class="icons" id="ads" name="ads" multiples required>
            <option value=""  disabled selected>Choose your Ad Type</option>
            <option value="Free">Free</option>
            <option value="Paid">Paid</option>
          </select>
          <label for="ads">Ad Type</label>
        </div>

        <div class="file-field input-field col s6">
          <div class="btn">
            <span><i class="material-icons prefix">attach_file</i></span>
            <input type="file" id="file" name="file" required>
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Choose an Image">
          </div>
        </div>

        

        <div class="center-align">
            
        <input type="submit"  name="post" class="btn button-rounded waves-effect waves-light teal accent-3" title="Post" style="margin-top: 30px;" value="Post"/> 
       </div>
    </form>

  </div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>


<?php require 'includes/footer.php'; ?>
