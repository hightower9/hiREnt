<?php

session_start();

if (!isset($_SESSION['logged_in'])) {
  $nav ='includes/nav.php';
}
else {
    $idsess = $_SESSION['email'];
  $nav ='includes/navconnected.php';


}


require 'includes/header.php';
require $nav; ?>

<div class="container-fluid home" id="top">
  <div class="container search">
    <nav class="animated slideInUp wow">
      <div class="nav-wrapper">
        <form method="GET" action="search.php">
          <div class="input-field">
            <input id="search" class="searching"  type="search" name='searched' required>
            <label class="label-icon" for="search"><i class="material-icons">search</i></label>
            <i class="material-icons">close</i>
          </div>

          <div class="center-align">
            <button type="submit" name="search" class="blue waves-light miaw waves-effect btn hide">Search</button>
          </div>
        </form>
      </div>
    </nav>
  </div>
</div>

<div class="container most">
  <div class="row">
    <?php

     include 'db.php';

    $queryfirst = "SELECT id,name,price,thumbnail FROM product where adtype='Paid'  and deleted='no'"; 
    $resultfirst=mysqli_query($con,$queryfirst);
    if ($resultfirst->num_rows > 0) {
      // output data of each row
      while($rowfirst = mysqli_fetch_assoc($resultfirst)) {

             $id_best = $rowfirst['id'];
            $name_best = $rowfirst['name'];
            $price_best = $rowfirst['price'];
            $thumbnail_best = $rowfirst['thumbnail'];
           

            ?>

            <div class="col s12 m4">
              <div class="card hoverable animated slideInUp wow">
          <div class="card-image">
       <a href="product.php?id=<?= $id_best;  ?>"><img style="height:250px;padding-left:50px;padding-right:50px" src="products/<?= $thumbnail_best; ?>"></a>


                 <?php
                  if (isset($_SESSION['logged_in'])) {

                    $query2 = "SELECT saved FROM bookmark WHERE pid = '".$id_best."' and email='".$idsess."'";
    $result2=mysqli_query($con,$query2);
    if ($result2->num_rows > 0) {
      while($row = mysqli_fetch_assoc($result2)) {
                      if($row['saved'] == 1)
{
   
  echo"<a href='save.php?pid=".$id_best."&id=1' title='bookmark' class='btn-floating red halfway-fab waves-effect waves-light right'><i class='material-icons'>bookmark</i></a>";
 } 
 else
{
   
  echo"<a href='save.php?pid=".$id_best."&id=2' title='bookmark' class='btn-floating black halfway-fab waves-effect waves-light right'><i class='material-icons'>bookmark</i></a>";
}

            }
               }

                 else
                 {
                  
   
  echo"<a href='save.php?pid=".$id_best."&id=3' title='bookmark' class='btn-floating black halfway-fab waves-effect waves-light right'><i class='material-icons'>bookmark</i></a>";


                      }  }  
                          ?>       



                 
                  </div>
    
       <span class="card-title red-text" style="padding-left:10px"><?= $name_best; ?></span>
                  <div class="card-content">
                    <div class="container">
                      <div class="row">
                        <div class="col s6">

                          <p class="white-text" ><b>Rs.</b> <?= $price_best; ?></p>
                        </div>
                        <div class="col s6">
                          
                        </div>
                      </div>
                    </div>

                  </div>

                </div>
              </div>
              <?php    }} ?>


            </div>
          </div>

          <div class="container-fluid center-align categories">
            <a href="#category" class="button-rounded btn-large waves-effect waves-light teal accent-3">Categories</a>
            <div class="container" id="category">
              <div class="row">
                <?php

                //get categories
                $querycategory = "SELECT id, name, icon  FROM category";
                $total = $con->query($querycategory);
                if ($total->num_rows > 0) {
                  // output data of each row
                  while($rowcategory = $total->fetch_assoc()) {
                    $id_category = $rowcategory['id'];
                    $name_category = $rowcategory['name'];
                    $icon_category = $rowcategory['icon'];

                    ?>

                    <div class="col s12 m4">
                      <div class="card hoverable animated slideInUp wow" style="border-radius: 20px;">
                        <span textalign="center" class="card-title black-text"><?= $name_category; ?></span>
                        <div class="card-image">
                          <a href="category.php?id=<?= $id_category; ?>">
                            <img src="src/img/<?= $icon_category; ?>.jpg"  alt="" width="100px" height="300px">

                          </a>
                          
                        </div>
                      </div>
                    </div>

                    <?php }} ?>
                  </div>
                </div>
              </div>


              <div class="container-fluid about" id="about">
                <div class="container">
                  <div class="row">
                    <div class="col s12 m6">
                      <div class="card animated slideInUp wow">
                        <div class="card-image">
                          <img src="src/img/aboutus.jpg" alt="">
                        </div>
                      </div>
                    </div>

                    <div class="col s12 m6">
                      <h3 class="animated slideInUp wow">About Us</h3>
                      <div class=" animated slideInUp wow"></div>
                      <p class="animated slideInUp wow">hiREnt works on the notion, “Why buy when you can borrow.” 
                        We operate with the aim to provide people with the access to things they need without having to own
                         them, which saves them money. Wondering how would you trust the lender or borrower? This is where 
                         technology comes into the picture. It is building up an aggregator platform using the edge cutting
                          technology to deliver you a comprehensive experience of sharing stuff among trusted communities,
                           societies, groups or friends.</p>
                      </div>

                    </div>
                  </div>
                </div>

                <!-- <div class="container contact" id="contact">
                  <div class="row">
                    <form class="col s12 animated slideInUp wow">
                      <div class="row">
                        <div class="input-field col s12 m6">
                          <i class="material-icons prefix">account_circle</i>
                          <input id="icon_prefix" type="text" class="validate">
                          <label for="icon_prefix">Full Name</label>
                        </div>
                        <div class="input-field col s12 m6">
                          <i class="material-icons prefix">email</i>
                          <input id="email" type="email" class="validate">
                          <label for="email" data-error="wrong" data-success="right">Email</label>
                        </div>



                        <div class="input-field col s12 ">
                          <i class="material-icons prefix">message</i>
                          <textarea id="icon_prefix2" class="materialize-textarea" type="text" name="message" rows="8" style="resize: vertical;min-height: 16rem;" required></textarea>
                          <label for="icon_prefix2">Your message</label>
                        </div>

                        <div class="center-align">
                          <button type="submit" name="contact" class="button-rounded btn-large waves-effect waves-light">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
 -->
                <?php
               require 'includes/secondfooter.php';
                require 'includes/footer.php'; ?>
