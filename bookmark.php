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

<div class="container-fluid product-page">
   <div class="container current-page">
      <nav>
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="index" class="breadcrumb">Home</a>
            <a href="bookmark.php" class="breadcrumb">Bookmarks</a>
          </div>
        </div>
      </nav>
    </div>
   </div>


   
<div class="container most">
  <div class="row">
    <?php

     include 'db.php';

    $queryfirst = "SELECT product.id,product.name,product.price,product.thumbnail FROM product INNER JOIN bookmark ON product.id=bookmark.pid where bookmark.saved= 1 and bookmark.email='".$idsess."' "; 
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
   
  echo"<a href='save1.php?pid=".$id_best."&id=1' class='btn-floating red halfway-fab waves-effect waves-light right'><i class='material-icons'>bookmark</i></a>";
 } 
 else
{
   
  echo"<a href='save1.php?pid=".$id_best."&id=2' class='btn-floating black halfway-fab waves-effect waves-light right'><i class='material-icons'>bookmark</i></a>";
}

            }
               }

                 else
                 {
                  
   
  echo"<a href='save1.php?pid=".$id_best."&id=3' class='btn-floating black halfway-fab waves-effect waves-light right'><i class='material-icons'>bookmark</i></a>";


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
              <?php    }}

             
           
                
?>

                </div>
            
          </div>
          

<?

        
require 'includes/secondfooter.php';
require 'includes/footer.php'; ?>