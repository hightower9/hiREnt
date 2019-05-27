<?php
include 'db.php';
session_start();

 $idsess = $_SESSION['email'];
 $id_product =$_GET['pid'];
 $sid =$_GET['id']; 

 

if($sid == 3)
{
 $sql = "INSERT INTO bookmark(pid,email,saved) VALUES('".$id_product."','".$idsess."',1)";      
  if(mysqli_query($con,$sql)){
    header('Location: index');
  }
}

if($sid == 2)
{
 $sql = "UPDATE bookmark SET saved = 1  WHERE email='".$idsess."'  and   pid='".$id_product."'";
  if(mysqli_query($con,$sql)){
    header('Location: index');
  }
}

if($sid  == 1)
{
 $sql = "UPDATE bookmark SET saved = 0  WHERE email='".$idsess."'  and   pid='".$id_product."'";
  if(mysqli_query($con,$sql)){
    header('Location: index');
  }
}
  ?>