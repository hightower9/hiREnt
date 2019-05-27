<?php
	require_once('config.php');
?>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width">
	<style type="text/css">
		.razorpay-payment-button{
            
        }
	</style>
</head>
<body>
	<form action="charge.php" method="POST">
<!-- Note that the amount is in paise = 50 INR -->
<script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $razor_api_key; ?>"
    data-amount="5000"
    data-buttontext="Pay"
    data-name="Hirent"
    data-description="Purchase Description"
    data-image="https://your-awesome-site.com/your_logo.jpg"
    data-prefill.name="Harshil Mathur"
    data-prefill.email="support@razorpay.com"
    data-theme.color="#F37254"
></script>
<input type="hidden" value="Hidden Element" name="hidden">
</form>

</body>
</html>