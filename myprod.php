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

<div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#test1">My Products</a></li>
        <li class="tab col s3"><a href="#test2">My Bookings</a></li>
      </ul>
    </div>
    <div id="test1" class="col s12">
      
 <?php
// connect to the database
require "db.php";

// get the records from the database
if ($result = $con->query("SELECT id,name,description,price,city,available,numb,email FROM product where email='".$sessid."' and deleted='no'"))
{
// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table border='1' cellpadding='10' class='highlight centered responsive-table z-depth-3' style='border-radius:20px;margin-top:20px;'>";

// set table headers
echo "<thead><tr><th>Name</th><th>Description</th><th>Price</th><th>City</th><th>Available</th><th>Number</th></tr></thead><tbody>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->name . "</td>";
echo "<td>" . $row->description . "</td>";
echo "<td>" . $row->price . "</td>";
echo "<td>" . $row->city . "</td>";
echo "<td>" . $row->available . "</td>";
echo "<td>" . $row->numb . "</td>";
echo "<td><a class='waves-effect waves-light btn yellow darken-1' title='Edit' href='records.php?id=" . $row->id . "'>Edit</a></td>";
echo "<td><a class='waves-effect waves-light btn red darken-1' title='Delete' href='delprod.php?id=" . $row->id . "'>Delete</a></td>";
echo "</tr>";
}
// <a href='records.php?id=" . $row->id . "'>Edit</a>
// <a href='delprod.php?id=" . $row->id . "'>Delete</a>
echo "</tbody></table>";
}
// if there are no records in the database, display an alert message
else
{
echo "No results to display!";
}
}
// show an error if there is an issue with the database query
else
{
echo "Error: " . $con->error;
}

// close database connection
// $con->close();

?>


    </div>
    <div id="test2" class="col s12">

 <?php
// connect to the database
// require "db.php";

// get the records from the database
if ($result1 = $con->query("SELECT product.id,product.name,product.description,product.price,product.city, notifications.fromdt, notifications.todt, notifications.nid
FROM product
INNER JOIN notifications
ON notifications.lessee='".$sessid."' and product.id=notifications.pid where notifications.action='book'"))
{
// display records if there are records to display
if ($result1->num_rows > 0)
{
// display records in a table
echo "<table border='1' cellpadding='10' class='highlight centered responsive-table z-depth-3' style='border-radius:20px;margin-top:20px;width:850px'>";

// set table headers
echo "<thead><tr><th>Name</th><th>Description</th><th>Price</th><th>City</th><th>From</th><th>To</th></tr></thead><tbody>";

while ($row1 = $result1->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row1->name . "</td>";
echo "<td>" . $row1->description . "</td>";
echo "<td>" . $row1->price . "</td>";
echo "<td>" . $row1->city . "</td>";
echo "<td>" . $row1->fromdt . "</td>";
echo "<td>" . $row1->todt . "</td>";
echo "<td><a class='waves-effect waves-light btn blue darken-1' title='Cancel' href='canprod.php?nid=".$row1->nid."&id=".$row1->id."'>Cancel Book</a></td>";
echo "<td><a class='waves-effect waves-light btn green darken-1' title='rate' href='rate.php?id=".$row1->id."'>Rate</a></td>";
echo "</tr>";
}
// <a href='records.php?id=" . $row->id . "'>Edit</a>
// <a href='delprod.php?id=" . $row->id . "'>Delete</a>
echo "</tbody></table>";
}
// if there are no records in the database, display an alert message
else
{
echo "No results to display!";
}
}
// show an error if there is an issue with the database query
else
{
echo "Error: " . $con->error;
}

// close database connection
$con->close();

?>


    </div>
  </div>

   
  </div>
</div>

    <?php require 'includes/footer.php'; ?>
