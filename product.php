<?php
session_start();

if (!isset($_GET['id'])) {
  header('Location: index');
}

if (!isset($_SESSION['logged_in'])) {
  $nav = 'includes/nav.php';
}
else {
  $nav ='includes/navconnected.php';
  $idsess = $_SESSION["email"];
}

$id_product =$_GET['id'];
require 'includes/header.php';
require $nav;?>

<div class="container-fluid product-page" id="top">
 <div class="container current-page">
  <nav>
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="index" class="breadcrumb">Home</a>
        <a href="product.php?id=<? $id_product; ?>" class="breadcrumb">Product</a>
      </div>
    </div>
  </nav>
</div>
</div>


<div class="container-fluid product">
  <div class="container">
   <div class="row">
     <div class="col s12 m6">
      <div class="card">
        <div class="card-image">


          <?php

        // Establish database connection

          define('HOST','localhost');
          define('USER','admin');
          define('PASS','admin123');
          define('DB','hirent');
          $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');


//notify----------------------------------------------------------------------------------

          if(isset($_GET['id'])){
            if(isset($_POST['submit'])){
              $dt1 = mysqli_real_escape_string($con,$_POST['dt1']);
                $dt2 = mysqli_real_escape_string($con,$_POST['dt2']);
                $curr = date("Y-m-d");
              if($dt1>=$curr && $curr < $dt2 && $dt1 <= $dt2){
              if($_SESSION['logged_in'] == 'True'){

                $sql = "SELECT name,mob from users where email='".$idsess."' ";

                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_object())
                  {
                    $name1=$row->name;
                    $mob1=$row->mob;
                  }
                }


                $sql1 = "SELECT name,email,numb from product where id='".$id_product."' ";

                $result1 = $con->query($sql1);
                if ($result1->num_rows > 0) {
                  while ($row1 = $result1->fetch_object())
                  {
                    $pname=$row1->name;
                    $pemail=$row1->email;
                    $pmob=$row1->numb;
                  }
                }


                

                $notify= "INSERT INTO notifications(pid, fromdt,todt, lessee,lessor,dttime,action)
                VALUES ('".$id_product."','".$dt1."','".$dt2."', '".$idsess."','".$pemail."', CURRENT_TIMESTAMP,'notify')";
                $resu = $con->query($notify);


                $s1 = "SELECT MAX(todt) from notifications where pid='".$id_product."' AND lessor='".$pemail."' AND action='book' ";
                 $r1 =mysqli_query($con,$s1);
               
               
                if ($r1->num_rows > 0) {
                while ($r4 = mysqli_fetch_assoc($r1))
               
                  {
                      $ndate=implode($r4);
                    }
                  }


$to      = $idsess; // Send email to our user
$subject = 'Notification | hiREnt'; // Give the email a subject 
$message = '

The Product '.$pname.' that you are interested in will be available on '.$ndate.'
If you are interestred in the Product for Rent/Hire when available, Contact the lessor for details.

Contact Details:
------------------------
Email: '.$pemail.'
Mobile No.: '.$pmob.'
------------------------


'; 
$headers = 'From:hiREnt' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email
}else{
  echo "<script>
  alert('You must Login to Book a product');
  window.location.href='index'</script>"; 
}
}else{echo "<script>
  alert('Dates not selected properly');
  window.location.href='index'</script>"; }
}
}



//book------------------------------------------------------------------------

if(isset($_GET['id'])){
  if(isset($_POST['book'])){
$dt1 = mysqli_real_escape_string($con,$_POST['dt1']);
      $dt2 = mysqli_real_escape_string($con,$_POST['dt2']);
      $curr = date("Y-m-d");
              if($dt1>=$curr && $curr < $dt2 && $dt1 <= $dt2){
    if($_SESSION['logged_in'] == 'True'){

      $sql = "SELECT name,mob,city from users where email='".$idsess."' ";

      $result = $con->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_object())
        {
          $name1=$row->name;
          $mob1=$row->mob;
          $city1=$row->city;
        }
      }


      $sql1 = "SELECT name,email,numb,city,available from product where id='".$id_product."' ";

      $result1 = $con->query($sql1);
      if ($result1->num_rows > 0) {
        while ($row1 = $result1->fetch_object())
        {
          $pname=$row1->name;
          $pemail=$row1->email;
          $pmob=$row1->numb;
          $pcity=$row1->city;
          $pav=$row1->available;
        }
      }
      if($pav =='yes'){


      $dt1 = mysqli_real_escape_string($con,$_POST['dt1']);
      $dt2 = mysqli_real_escape_string($con,$_POST['dt2']);

      $notify= "INSERT INTO notifications(pid, fromdt,todt, lessee,lessor,dttime,action)
      VALUES ('".$id_product."','".$dt1."','".$dt2."', '".$idsess."','".$pemail."', CURRENT_TIMESTAMP,'book')";
      $resu = $con->query($notify);

//updating the database
$sql2 = "UPDATE product SET available='no' where id='".$id_product."' ";
$result2 = $con->query($sql2);


//lessor-----------------------------------------------------------------

$to      = $pemail; // Send email to our user
$subject = 'Product Booked | hiREnt'; // Give the email a subject 
$message = '

'.$name1.' has booked your Product '.$pname.'
In order to give the product, you can contact the lessee with the details given below

Details:
------------------------
Email: '.$idsess.'
Mobile No.: '.$mob1.'
Location: '.$city1.'
------------------------
'; // Our message above including the link
// From:alisterpereira96@gmail.com
$headers = 'From:hiREnt' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email



//lessee----------------------------------------------------------------

$to1      = $idsess; // Send email to our user
$subject1 = 'Product Booked | hiREnt'; // Give the email a subject 
$message1 = '

'.$name1.', your product '.$pname.' has been Booked.
In order to exchange the products you can contact the lessor with the details given below

Details:
------------------------
Email: '.$pemail.'
Mobile No.: '.$pmob.'
Location: '.$pcity.'
------------------------
'; // Our message above including the link
// From:alisterpereira96@gmail.com
$headers1 = 'From:hiREnt' . "\r\n"; // Set from headers
mail($to1, $subject1, $message1, $headers1); // Send our email




}else{
  echo "<script>
  alert('Sorry, The product is unavailable');
  window.location.href='product?id=".$id_product."'</script>"; 
}


}else{
  echo "<script>
  alert('You must Login to Book a product');
  window.location.href='index'</script>"; 
}
}else{echo "<script>
  alert('Dates not selected properly');
  window.location.href='index'</script>"; }
}
}

?>

<?php



            //get products
$queryproduct = "SELECT id, name, price, description, thumbnail
FROM product WHERE id = '{$id_product}' ";
$result1 = $con->query($queryproduct);
if ($result1->num_rows > 0) {
            // output data of each row
  while($rowproduct = $result1->fetch_assoc()) {
    $id_productdb = $rowproduct['id'];
    $name_product = $rowproduct['name'];
    $price_product = $rowproduct['price'];
              // $id_pic = $rowproduct['id_picture'];
    $description = $rowproduct['description'];
    $thumbnail_product = $rowproduct['thumbnail']; }}?>
    
  </div>
</div>
<div class="row">

 <div class="col s12 m4">
   <div class="card hoverable">
<img class="materialboxed" width="400" height="300"src="products/<?= $thumbnail_product; ?>" alt="">
   </div>
 </div>
 
</div>
<?php 
$query = "SELECT COUNT(r_id) as count , AVG(rating) as avg FROM rating WHERE p_id ='".$id_product."'";
$result = $con->query($query);
$ratingRow = $result->fetch_assoc();

  
   if( $ratingRow['count'] > 0 ) 
{
  $avg= round($ratingRow['avg'],1);
    
  echo"<span class='fa fa-star checked' style='font-size:60px;color:gold'></span><i style='font-size:40px'>" .$avg. "/5</i>
     based on <span id=totalrat'>".$ratingRow['count']. "</span> ratings </span>";
}
else{

echo"<span class='fa fa-star checked' style='font-size:60px;color:gold'></span></span>Not rated yet</span>";


}
?>
<span><h5>Reviews</h5></span>
<?php

$sql = $con->query("SELECT rating.comment,rating.modified,users.name from rating INNER JOIN users ON rating.r_email=users.email where rating.p_id = '".$id_productdb."'");
// $result = mysqli_query($con, $sql);
  if ($sql->num_rows > 0){


while ($row = $sql->fetch_object()) {  
  if($row->comment != ""){
    
         ?>
            
           
                         <div class="comment-row">
                         <div class="comment-info"><span class="commet-row-label"></span> 
                                <span class="posted-by"><?= $row->name; ?> </span> 
                                    <span class="commet-row-label">at</span>
                                    <span class="posted-at"><?= $row->modified; ?> </span>
                                    </div>
                                    <div class="comment-text"><?= $row->comment;  ?></div>
                                    </div>
     <?php }}}?>        
 
</div> 

<div class="col s12 m6">
 <form method="post">
   <h2><?= $name_product; ?></h2>
   <b>Share on : </b>
<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
<!-- <a class="a2a_dd" href="https://www.addtoany.com/share"></a> -->
<a class="a2a_button_facebook"></a>
<a class="a2a_button_twitter"></a>
<a class="a2a_button_whatsapp"></a>
</div>
<script async src="https://static.addtoany.com/menu/page.js"></script>
   <div class="stuff">

    <h5>Rs. <?= $price_product; ?> per day</h5>
    <p><?= $description; ?></p>
    <div class="input-field col s12">
     From: <input  id="dt1"  type="date" name="dt1" min="2000-01-02" class="validate" required><br>

   </div>
   <div class="input-field col s12">
    To:<input  id="dt2"  type="date" name="dt2" min="2000-01-02" class="validate" required><br>

  </div>
  <?php

  if (isset($_POST['click'])) {

   if (!isset($_SESSION['logged_in'])) {
     echo "<meta http-equiv='refresh' content='0;url=http://localhost/Hirent/sign' />";
   }

   else {
    // $quantity = $_POST['quantity'];

              //inserting into command
              // include 'db.php';
    // $dt1 = mysqli_real_escape_string($con,$_POST['dt1']);
    // $dt2 = mysqli_real_escape_string($con,$_POST['dt2']);

    // $notify= "INSERT INTO notifications(pid, fromdt,todt, lessee,lessor,dttime)
    // VALUES ('".$id_product."','".$dt1."','".$dt2."', '".$idsess."', CURRENT_TIMESTAMP )";

    if ($con->query($notify) === TRUE) {


     echo "<meta http-equiv='refresh' content='0;url=product.php?id=$id_product' />";
   } else {
     echo "<h5 class='text-red'>Error: " . $notify . "</h5><br><br><br>" . $con->error;
   }
   $con->close();
 }
}

?>

<div class="center-align">
  <?php  
  $book = "SELECT id
  FROM product WHERE id = '".$id_product."' and available = 'yes' ";
  $res = $con->query($book);
  if ($res->num_rows == 0) {
    echo "<button type='submit' id='submit' name='submit' class='btn-large meh button-rounded waves-light'>Notify</button>";
  }else
  {
   echo "<button type='submit' id='book' name='book' class='btn-large meh button-rounded waves-light'>Book</button>";
 }


 ?>

 <!-- <button type="submit" id="submit" name="submit" class="btn-large meh button-rounded waves-effect waves-light ">Notify</button> -->
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<?php
require 'includes/secondfooter.php';
require 'includes/footer.php'; ?>
