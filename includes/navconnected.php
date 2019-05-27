
<div class="navbar-fixed">
 <nav class="navblack">
   <div class="nav-wrapper nav-wrapper-2 container white">
     <ul>
       <li><img src="src/img/icon.jpg" style="border-radius: 50%;" ></li>
       <li><a href="index" class="dark-text" style="font-weight: bold;font-size: 40px;">hiREnt</a></li>
<li><a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a></li>
     </ul>

     <!-- <ul class="center hide-on-large-only">
       <li><a href="index" class="dark-text">hiREnt</a></li>

     </ul> -->
     <?php
     
      $name = $_SESSION['name'];
      ?>

  

     <ul  class="right hide-on-med-and-down">
       <li><a href="index" class="waves-effect waves-light btn teal accent-3" title="Home"><i class="material-icons">home</i></a></li>
         <li><a href="upload.php" class="waves-effect waves-light btn button-rounded teal accent-3" title="Post AD"><i class="material-icons">publish</i></a></li>
       <li><a href="bookmark.php" class="waves-effect waves-light btn button-rounded teal accent-3" title="Wish list"><i class="material-icons">bookmark</i></a></li>
     <li> <a class='dropdown-button btn' href='#' data-activates='dropdown1' data-hover="hover"  style="background-color: #66eaaa;" data-beloworigin="true"><i class="material-icons">person</i></a></li>
       <li><label style="font-size:20px;">   <?= $name; ?></label> </li>
     </ul>
   </div>
 </nav>
 <!-- <ul class="sidenav hide-on-large-only" id="mobile-demo">
    <li><a href="index" class="waves-effect waves-light btn teal accent-3" title="Home"><i class="material-icons">home</i></a></li>
         <li><a href="upload.php" class="waves-effect waves-light btn button-rounded teal accent-3" title="Post AD"><i class="material-icons">publish</i></a></li>
       <li><a href="upload.php" class="waves-effect waves-light btn button-rounded teal accent-3" title="Wish list"><i class="material-icons">bookmark</i></a></li>
      <a class='dropdown-button btn' href='#' data-activates='dropdown1' data-hover="hover"   data-beloworigin="true"><i class="material-icons">person</i></a>
        
  </ul>  -->



<ul id='dropdown1' class='dropdown-content'>
    
    <li><a  href="myprod.php#test1" title="My Products">Uploads </a></li>
    <li class="divider"></li>
    <li><a  href="myprod.php#test2" title="My Bookings">Bookings</a></li>
    <li class="divider"></li>
    <li><a  href="includes/logout" title="Logout">Logout</a></li>
    <li class="divider"></li>

    </ul>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
</div>

