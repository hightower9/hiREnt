<?php

session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: sign');
}

else {
  $sessid = $_SESSION['email'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="src/css/rating.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="src/js/rating.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css"> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>


      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      



<script type="text/javascript">
function validate(){
var rate=document.getElementById("rating_star").value;
if(rate==0)
{alert("Rate the product to submit form");

}
else
alert("Thank you ");
// window.location.replace('index.php');
}
</script>
<style type="text/css">
    .overall-rating{font-size: 14px;margin-top: 5px;color: #8e8d8d;}
</style>

</head>
<body>



  
  <form method="POST" onsubmit="this.form.submit()" style="width:50%; margin:auto;" class="center"><br>
    <h5 style="margin-right: 800px;">Rating:</h5>
    <div class="input-row" style="margin: auto;">
      
    <input name="rating" value="0" id="rating_star" type="hidden" postID="1"  />
    </div>
    <br>
    <h5 style="margin-right: 800px;">Comment:</h5>

    <div class="comment-form-container">

        <div class="input-row">
                          <textarea class="input-field" type="text" name="comment"
                    id="comment" placeholder="Add a Comment">  </textarea>
            </div>   
    </div>
    <button type="submit" name="rate" class='waves-effect waves-light btn blue' style="height: 40px; width:80px; font-size:12px; " onclick="validate()">submit</button>
   </form> 

 
</body>
<script language="javascript" type="text/javascript">

     
$(function() {


    $("#rating_star").spaceo_rating_widget({
        starLength: '5',
        initialValue: '',
        imageDirectory: 'img/',
        inputAttr: 'post_id'
        <?php
         include 'db.php';
 if(isset($_POST['rate']))
   {
$p_id = $_GET['id'];
           $comment = isset($_POST['comment']) ? $_POST['comment'] : "";
            $rating = $_POST['rating'];    
 if($rating > 0)
     {       
        
        $prevRatingQuery = "SELECT * FROM rating WHERE p_id = '".$p_id."' and r_email='".$sessid."'";
    $prevRatingResult = $con->query($prevRatingQuery);
    if($prevRatingResult->num_rows > 0){
        //$prevRatingRow = $prevRatingResult->fetch_assoc();
        //Update rating data into the database

        $query1 = "UPDATE rating SET rating = '".$rating."', modified = '".date("Y-m-d H:i:s")."' WHERE p_id = '".$p_id."' and r_email='".$sessid."'";
        $update1 = $con->query($query1);
 if(isset($_POST['comment'])){
        $query = "UPDATE rating SET  modified = '".date("Y-m-d H:i:s")."',comment = '".$comment."' WHERE p_id = '".$p_id."' and r_email='".$sessid."'";
        $update = $con->query($query);
      }
        header('Location: myprod');
      }
    else{
        //Insert rating data into the database
        $query = "INSERT INTO rating (p_id,rating,created,modified,comment,r_email) VALUES(".$p_id.",'".$rating."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','".$comment."','".$sessid."')";
        $insert = $con->query($query);
        header('Location: myprod');
    }
      }

       
    }  ?>
          });
});

</script>
</html>