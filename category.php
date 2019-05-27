<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    $nav ='includes/nav.php';
}
else {
  $nav ='includes/navconnected.php';
  $idsess = $_SESSION['email'];
}

// if(!isset($_GET['id'])){
// header('Location: index');
// }





$id_category =$_GET['id'];
 require 'includes/header.php';
 require $nav; ?>
 <div class="container-fluid product-page">
   <div class="container current-page">
      <nav>
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="index" class="breadcrumb">Home</a>
            <a href="category.php?id=<?= $id_category; ?>" class="breadcrumb">Category</a>
          </div>
        </div>
      </nav>
    </div>
   </div>


 <div class="container-fluid category-page">
    <div class="row">

      <div class="col s12 m2 center-align cat">
        <div class="collection card">
        <?php

          include 'db.php';

          //get categories
            $querycategory = "SELECT id, name FROM category";
            $total = $con->query($querycategory);
            if ($total->num_rows > 0) {
            // output data of each row
            while($rowcategory = $total->fetch_assoc()) {
              $id_categorydb = $rowcategory['id'];
              $name_category = $rowcategory['name'];
          ?>
         <a href="category.php?id=<?= $id_categorydb; ?>" class='collection-item <?php if($id_categorydb == $id_category) {echo"active";} ?>' ><?= $name_category; ?></a>
       <?php }} ?>

       </div>

 
        



<form action="#" method="POST" onsubmit="this.form.submit()">
  <div class="card">
         <div class="input-field col s12">
  <select name="city" >
      <option value="" disabled selected>Choose your option</option>
      <option value="Panaji" id="Panaji" name="Panaji">Panaji</option>
      <option value="Margao" id="Margao" name="Margao">Margao</option>
      <option value="Ponda" id="Ponda" name="Ponda">Ponda</option>
      <option value="Vasco" id="Vasco" name="Vasco">Vasco</option>
      <option value="Mapusa" id="Mapusa" name="Mapusa">Mapusa</option>
    </select>
    <label>Filter by Location</label>
 
  
  </div>
       </div>

        <div class="card">
         <div class="input-field col s12">

  <select name="sort" >    
    <option value="" disabled selected>Choose your option</option>
      <option value="1">Newest first</option>
      <option value="2">Price -- High to Low</option>
      <option value="3">Price -- Low to Highs</option>
    </select>
    <label>Sort</label>
    <button type="submit" id="submit" name="submit" class="btn-large meh button-rounded waves-effect waves-light " style="height: 50px; width:150px; font-size:12px; ">Apply Filter</button>

    </div>
       </div>
  </form>
  

      </div>


      



      <div class="col s12 m10 ">
        <div class="container content">
          <div class="center-align">
            <button class="button-rounded btn-large waves-effect waves-light">Products</button>
          </div>
        <div class="row">
          <?php
          //get products

          //pages links
         

   $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
          $perpage = isset($_GET['per-page']) && $_GET['per-page'] <= 16 ? (int)$_GET['per-page'] : 16;

   $start = ($page > 1) ? ($page * $perpage) - $perpage : 0;
  


if(isset($_POST['city']) )
{

  $city= $_POST['city'];
 
 
  if(isset($_POST['sort']) )
  {


    if($_POST['sort']=="1")
{
   $queryproduct = "SELECT SQL_CALC_FOUND_ROWS id, name, price, thumbnail FROM product WHERE id_category = '{$id_category}' and deleted='no' and city='{$city}'ORDER BY id DESC LIMIT {$start}, 16"; 
}


 if($_POST['sort']=="2")
{
   $queryproduct = "SELECT SQL_CALC_FOUND_ROWS id, name, price, thumbnail FROM product WHERE id_category = '{$id_category}' and deleted='no' and city='{$city}'ORDER BY price DESC LIMIT {$start}, 16"; 
}

 if($_POST['sort']=="3")
{
   $queryproduct = "SELECT SQL_CALC_FOUND_ROWS id, name, price, thumbnail FROM product WHERE id_category = '{$id_category}' and deleted='no' and city='{$city}'ORDER BY price ASC LIMIT {$start}, 16"; 
}
  }
else{
   $queryproduct = "SELECT SQL_CALC_FOUND_ROWS id, name, price, thumbnail FROM product WHERE id_category = '{$id_category}' and deleted='no' and city='{$city}'ORDER BY id DESC LIMIT {$start}, 16"; 
}
 }




else
  {
 if(isset($_POST['sort']) )
  {


    if($_POST['sort']=="1")
{
   $queryproduct = "SELECT SQL_CALC_FOUND_ROWS id, name, price, thumbnail FROM product WHERE id_category = '{$id_category}' and deleted='no' ORDER BY id DESC LIMIT {$start}, 16"; 
}


 if($_POST['sort']=="2")
{
   $queryproduct = "SELECT SQL_CALC_FOUND_ROWS id, name, price, thumbnail FROM product WHERE id_category = '{$id_category}' and deleted='no' ORDER BY price DESC LIMIT {$start}, 16"; 
}

 if($_POST['sort']=="3")
{
   $queryproduct = "SELECT SQL_CALC_FOUND_ROWS id, name, price, thumbnail FROM product WHERE id_category = '{$id_category}' and deleted='no' ORDER BY price ASC LIMIT {$start}, 16"; 
}
  }
else{
   $queryproduct = "SELECT SQL_CALC_FOUND_ROWS id, name, price, thumbnail FROM product WHERE id_category = '{$id_category}' and deleted='no' ORDER BY id DESC LIMIT {$start}, 16"; 
}

  }
          $result = $con->query($queryproduct);

          //pages
           $total = $con->query("SELECT FOUND_ROWS() as total")->fetch_assoc()['total'];
           $pages = ceil($total / $perpage);

            if ($result->num_rows > 0) {
            // output data of each row
            while($rowproduct = $result->fetch_assoc()) {
              $id_product = $rowproduct['id'];
              $name_product = $rowproduct['name'];
              $price_product = $rowproduct['price'];
              // $id_pic = $rowproduct['id_picture'];
              $thumbnail_product = $rowproduct['thumbnail'];


            ?>

                <div class="col s12 m4">
                  <div class="card hoverable animated slideInUp wow">
                    <div class="card-image">
                        <a href="product.php?id=<?= $id_product; ?>">
                          <img src="products/<?= $thumbnail_product; ?>" width="100px" height="200px"></a>
                         <?php
                  if (isset($_SESSION['logged_in'])) {

                    $query2 = "SELECT saved FROM bookmark WHERE pid = '".$id_product."' and email='".$idsess."'";
    $result2=mysqli_query($con,$query2);
    if ($result2->num_rows > 0) {
      while($row = mysqli_fetch_assoc($result2)) {
                      if($row['saved'] == 1)
{
   
  echo"<a href='save2.php?pid=".$id_product."&sid=1&id=".$id_category."' class='btn-floating red halfway-fab waves-effect waves-light right'><i class='material-icons'>bookmark</i></a>";
 } 
 else
{
   
  echo"<a href='save2.php?pid=".$id_product."&sid=2&id=".$id_category."' class='btn-floating black halfway-fab waves-effect waves-light right'><i class='material-icons'>bookmark</i></a>";
}

            }
               }

                 else
                 {
                  
   
  echo"<a href='save2.php?pid=".$id_product."&sid=3&id=".$id_category."' class='btn-floating black halfway-fab waves-effect waves-light right'><i class='material-icons'>bookmark</i></a>";


                      }  }  
                          ?>       



                      </div>
                      <div class="card-action">
                        <div class="container-fluid">
                          <span class="card-title grey-text"><?= $name_product; ?></span>
                          <h5 class="white-text">Rs.<?= $price_product; ?></h5>
                        </div>
                      </div>
                  </div>
                </div>
                 <?php }}?>
              </div>
                <div class="center-align animated slideInUp wow">
                  <ul class="pagination <?php if($total<15){echo "hide";} ?>">
                  <li class="<?php if($page == 1){echo 'hide';} ?>"><a href="?page=<?php echo $page-1; ?>&per-page=15"><i class="material-icons">chevron_left</i></a></li>
                  <?php for ($x=1; $x <= $pages; $x++) : $y = $x;?>


                      <li class="waves-effect pagina  <?php if($page === $x){echo 'active';} elseif($page <  ($x +1) OR $page > ($x +1)){echo'hide';} ?>"><a href="?page=<?php echo $x; ?>&per-page=15" ><?php echo $x; ?></a></li>



                  <?php endfor; ?>
                  <li class="<?php if($page == $y){echo 'hide';} ?>"><a href="?page=<?php echo $page+1; ?>&per-page=15"><i class="material-icons">chevron_right</i></a></li>
                </ul>
                </div>
          </div>
      </div>

    </div>
</div>

  <?php
   require 'includes/secondfooter.php';
   require 'includes/footer.php'; ?>
