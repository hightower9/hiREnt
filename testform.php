<?php
session_start();
 include 'db.php';
 $idsess = $_SESSION['email'];
   $pid = $_SESSION['pid'];

   $querycategory = "SELECT email,name,mob  FROM users where email= '".$idsess. "'";
                $total = $con->query($querycategory);
                if ($total->num_rows > 0) {
                  // output data of each row
                  while($rowcategory = $total->fetch_assoc()) {
                    $email = $rowcategory['email'];
                    $firstname = $rowcategory['name'];
                    $phone = $rowcategory['mob'];
                  }
                }


   
     
// Merchant key here as provided by Payu
$MERCHANT_KEY = "vRGlSfdy";
// Merchant Salt as provided by Payu
$amount="500";
$surl="http://localhost/Hirent/success.php ";
$furl="http://localhost/Hirent/failure.php ";
$productinfo="this is a good product";
//$phone="9765147452";
//$email="zarucaeiro219@gmail.com";
//$firstname="zarina";
$SALT = "mrXdz3wVev";
// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://sandboxsecure.payu.in";
$action = '';
$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}
$formError = 0;
if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }
    $hash_string .= $SALT;
    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<html>
  <head>
  <script>
    
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      var payuForm = document.forms.payuForm;
     document.getElementById('jsform').submit();
    }
  </script>
  </head>
  <body onload="submitPayuForm()">
    <?php if($formError) { ?>
	
      <span style="color:red">Please fill all mandatory fields.</span>
      <br/>
      <br/>
    <?php } ?>
    <form action="<?php echo $action; ?>" method="post" name="payuForm" id="jsform" >
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
	  <input type="hidden" name="hash_abc" value="<?php echo $hash_string ?>"/>
    <input type="hidden" name="amount"  value="<?php echo $amount ?>"/>
    <input  type="hidden" name="firstname" id="firstname" value="<?php echo $firstname ?>"/>
    <input type="hidden" name="email" id="email" value="<?php echo $email ?>"/>
    <input  type="hidden" name="phone" value="<?php echo $phone ?>"/>
    <textarea  style="display:none;" name="productinfo"><?php echo $productinfo ?></textarea>
  <input type="hidden" name="surl"  value="<?php echo $surl?>"/>
  <input  type="hidden" name="furl"  value="<?php echo $furl ?>"/>
  <input type="hidden" type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
         <!--  <?php if(!$hash) { ?>
           <input type="submit" value="Submit" />
          <?php } ?> -->
    </form>
  </body>
</html>