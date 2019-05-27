<?php
// require_once('db.php');
session_start();
require "db.php";

	$prodname= $_POST['prodname'];
	$cat= $_POST['cat'];
	$mb= $_POST['mb'];
	$city= $_POST['city'];
	$descrip= $_POST['descrip'];
	$ppd= $_POST['ppd'];
	$ads= $_POST['ads'];
    $idsess = $_SESSION['email'];


	$target_dir = "products/";
$fname=$_FILES["file"]["name"];
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $randName = md5(rand() * time());
    $fname =  $randName . basename($fname);
   $target_file = $target_dir . $fname ;
}
// Check file size
if ($_FILES["file"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) 

    {
       echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
      

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
	
	$sql = "INSERT INTO product(id_category,name,description,numb,city,price,thumbnail,uploaddate,email,adtype) VALUES('".$cat."','".$prodname."','".$descrip."','".$mb."','".$city."','".$ppd."','".$fname."',CURRENT_TIMESTAMP,'".$idsess."','".$ads."')";			
	if(mysqli_query($con,$sql)){
if(strcmp($ads,'Free')==0)
{
    header("Location:index.php"); 
       exit; 
   }
   else
   {

     $last_id = $con->insert_id;
      $_SESSION['pid']=$last_id ;
    header("Location:testform.php"); 
    exit;
   }
	}
    else{
					
		echo $con->error;
	}
	mysqli_close($con);



