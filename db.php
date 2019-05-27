
<?php
define('HOST','localhost');
define('USER','admin');
define('PASS','admin123');
define('DB','hirent');
$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');