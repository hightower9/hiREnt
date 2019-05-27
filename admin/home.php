<?php
session_start();
$email=$_SESSION['email'];
if(!isset($_SESSION["email"]))
	header("location:index.php");

$connect=mysqli_connect("localhost","admin","admin123","hirent");
$queryv="SELECT * FROM product WHERE id_category='1' ORDER BY uploaddate ASC";
$queryf="SELECT * FROM product WHERE id_category='2' ORDER BY uploaddate ASC";
// $queryr="SELECT * FROM realestate ORDER BY rid ASC";
$querye="SELECT * FROM product WHERE id_category='3' ORDER BY uploaddate ASC";
$queryru="SELECT * FROM users ORDER BY name ASC";
$queryl="SELECT * FROM notifications ORDER BY nid ASC";
// $querypay="SELECT * FROM payment ORDER BY orderid ASC";

$resultv=mysqli_query($connect,$queryv);
$resultf=mysqli_query($connect,$queryf);
// $resultr=mysqli_query($connect,$queryr);
$resulte=mysqli_query($connect,$querye);
$resultru=mysqli_query($connect,$queryru);
$resultl=mysqli_query($connect,$queryl);
// $resultpay=mysqli_query($connect,$querypay);


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin | Main Page</title>
	<link rel="icon" sizes="192x192" href="icon.jpg">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.yellow-indigo.min.css" />
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>


	<!-- jquery tables -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

	<!-- modal -->
	<link rel="stylesheet" href="material-modal-master/dist/css/material-modal.min.css">

	<style type="text/css">
	body{
		font-family: 'Roboto', sans-serif;
	}
	.demo-card-square.mdl-card {
		width: 320px;
		height: 320px;
	}
	.demo-card-square > .mdl-card__title {
		color: #fff;
		background:linear-gradient(to bottom right, #3a85ff,white);
	}
	.demo-list-icon {
		width: 300px;
	}
</style>
</head>
<body>
	<!-- Simple header with scrollable tabs. -->
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
		<header class="mdl-layout__header">
			<div class="mdl-layout__header-row">
				<!-- Title -->
				<span class="mdl-layout-title"><!-- <i class="fa fa-cog fa-spin fa-fw fa-2x" aria-hidden="true"></i> --><img src="title.png" alt="hirent" width="70" height="70"><strong style="font-size: 30px;">hiREnt | Admin Dashboard</strong></span>
				<div class="mdl-layout-spacer"></div>
				<!-- Navigation -->
				<nav class="mdl-navigation">
					<a class="mdl-navigation__link" href="logout.php" style="color: black;font-size: 20px;font-weight: bold;"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>&nbsp;Logout</a>
				</nav>
			</div>
			<!-- Tabs -->
			<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
				<a href="#scroll-tab-1" class="mdl-layout__tab is-active"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Home</a>
				<a href="#scroll-tab-2" class="mdl-layout__tab"><i class="fa fa-th fa-fw" aria-hidden="true"></i>&nbsp; Products </a>
				<a href="#scroll-tab-3" class="mdl-layout__tab"><i class="fa fa-users fa-fw" aria-hidden="true"></i>&nbsp; Registered Users</a>
				<a href="#scroll-tab-4" class="mdl-layout__tab"><i class="fa fa-product-hunt fa-fw" aria-hidden="true"></i>&nbsp; Notifications</a>
				<!-- <a href="#scroll-tab-5" class="mdl-layout__tab"><i class="fa fa-money fa-fw" aria-hidden="true"></i>&nbsp; Payment</a> -->
				<a href="#scroll-tab-6" class="mdl-layout__tab"><i class="fa fa-cog fa-fw" aria-hidden="true"></i>&nbsp; My Account</a>
			</div>
		</header>
		<main class="mdl-layout__content" style="background:white url(2.jpg) repeat fixed;background-size: cover;">
			<section class="mdl-layout__tab-panel is-active" id="scroll-tab-1" name="scroll-tab-1">
				<div class="mdl-layout__content" style="align-content: justify;">
					<div class="page-content">
						<div style="text-align: center;color: white;">
							<?php
							$con = mysqli_connect('localhost','admin','admin123','hirent') or die('Unable to Connect');
							$sql="SELECT fullname FROM uadmin WHERE email='".$email."'";
							$result=mysqli_query($con,$sql);
							if ($result->num_rows != 0) {
								while ($row=mysqli_fetch_assoc($result)) {

									echo '

									<h3>'.$row["fullname"].'</h3>

									'; 
								}
							}

							mysqli_close($con);
							?>
							<div class="mdl-grid" style="margin-left: 80px;">
								<div class="mdl-cell mdl-cell--3-col mdl-cell--12-col-tablet">
									<div class="demo-card-square mdl-card mdl-shadow--2dp">

										<div class="mdl-card__title mdl-card--expand" style="background:url(products.jpg); background-size: 320px 320px;">
											<h2 class="mdl-card__title-text" style="color: #b4c7ed;">Products</h2>
										</div>
										<div class="mdl-card__supporting-text">
											<a href="#cats" style="text-decoration: none;color: grey;">View all the products uploaded here.</a>
										</div>

									</div>
								</div>
								<div class="mdl-cell mdl-cell--3-col mdl-cell--12-col-tablet">
									<div class="demo-card-square mdl-card mdl-shadow--2dp">
										<div class="mdl-card__title mdl-card--expand" style="background:url(regu.png); background-size: 320px 280px;">
											<h2 class="mdl-card__title-text" style="color: #b4c7ed;">Registered Users</h2>
										</div>
										<div class="mdl-card__supporting-text">
											View the registered users of the Web and Details
										</div>

									</div>
								</div>
								<div class="mdl-cell mdl-cell--3-col mdl-cell--12-col-tablet">
									<div class="demo-card-square mdl-card mdl-shadow--2dp">
										<div class="mdl-card__title mdl-card--expand" style="background:url(leads.jpg); background-size: 320px 320px;">
											<h2 class="mdl-card__title-text" style="color: #b4c7ed;">Leads</h2>
										</div>
										<div class="mdl-card__supporting-text">
											View and monitor deals between different entities.
										</div>

									</div>
								</div>
								<div class="mdl-cell mdl-cell--3-col mdl-cell--12-col-tablet">
									<div class="demo-card-square mdl-card mdl-shadow--2dp">
										<div class="mdl-card__title mdl-card--expand" style="background:url(pay.png); background-size: 320px 320px;">
											<h2 class="mdl-card__title-text" style="color: #b4c7ed;">Payments</h2>
										</div>
										<div class="mdl-card__supporting-text">
											View the Payments Done by the Users
										</div>

									</div>
								</div>
							</div>
						</div>
					</section>
					<section class="mdl-layout__tab-panel" id="scroll-tab-2" name="scroll-tab-2">
						<div class="page-content" id="cats">
							<!-- Categories -->
							<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
								<div class="mdl-tabs__tab-bar">
									<a href="#vehicle-panel" class="mdl-tabs__tab is-active"><i class="fa fa-car fa-fw" aria-hidden="true"></i>&nbsp;Vehicles</a>
									<a href="#funiture-panel" class="mdl-tabs__tab"><i class="fa fa-bed fa-fw" aria-hidden="true"></i>&nbsp;Funitures</a>
									<!-- <a href="#realestate-panel" class="mdl-tabs__tab"><i class="fa fa-building-o fa-fw" aria-hidden="true"></i>&nbsp;Real Estates</a> -->
									<a href="#electronic-panel" class="mdl-tabs__tab"><i class="fa fa-plug fa-fw" aria-hidden="true"></i>&nbsp;Electronics</a>
								</div>

								<!-- Vehicles -->

								<div class="mdl-tabs__panel is-active" id="vehicle-panel" name="vehicle-panel">

									
									<div style="background: white;margin: 40px;margin-top: 30px;margin-bottom: 20px; padding: 20px;">


										<table class="mdl-data-table mdl-js-data-table  mdl-shadow--2dp display responsive nowrap" id="vehdata" style="margin-right: 20px; text-align:center;width:100%; ">
											<thead>
												<tr><th>Product ID</th>
													<th>Product Name</th>
													<th>Description</th>
													<th>Price per Day</th>
													<th>Image</th>	
													<th>City</th>
													<th>Available</th>
													<th>Number</th>
													<th>Upload Date</th>
													<th>Email</th>
													<th>Ad Type</th>
												</tr>
											</thead>

											<?php
											while($rowv = mysqli_fetch_array($resultv))
											{
												echo'
												<tr>
												<td>'.$rowv["id"].'</td>
												<td>'.$rowv["name"].'</td>
												<td>'.$rowv["description"].'</td>
												<td>'.$rowv["price"].'</td>
												<td> 
												';
												echo '<img src="../products/'.$rowv["thumbnail"].'" width=100px height=100px/>
												</td>
												<td>'.$rowv["city"].'</td>
												<td>'.$rowv["available"].'</td>
												<td>'.$rowv["numb"].'</td>
												<td>'.$rowv["uploaddate"].'</td>
												<td>'.$rowv["email"].'</td>
												<td>'.$rowv["adtype"].'</td>
												</tr>

												';
											}
											

											?>




										</table>


									</div>

								</div>

								<!-- Funiture -->

								<div class="mdl-tabs__panel" id="funiture-panel" name="funiture-panel">


									<div style="background: white;margin: auto 40px;margin-top: 30px;margin-bottom: 120px; padding: 20px;">


										<table class="mdl-data-table mdl-js-data-table  mdl-shadow--2dp display responsive nowrap" id="fundata" style="margin: auto; text-align:center;width:100%; ">
											<thead>
												<tr>
													<th>Product ID</th>
													<th>Product Name</th>
													<th>Description</th>
													<th>Price per Day</th>
													<th>Image</th>	
													<th>City</th>
													<th>Available</th>
													<th>Number</th>
													<th>Upload Date</th>
													<th>Email</th>
													<th>Ad Type</th>
												</tr>
											</thead>

											<?php

											while($rowf = mysqli_fetch_array($resultf))
											{
												echo'
												<tr>
												<td>'.$rowf["id"].'</td>
												<td>'.$rowf["name"].'</td>
												<td>'.$rowf["description"].'</td>
												<td>'.$rowf["price"].'</td>
												<td> 
												';
												echo '<img src="../products/'.$rowf["thumbnail"].'" width=100px height=100px/>
												</td>
												<td>'.$rowf["city"].'</td>
												<td>'.$rowf["available"].'</td>
												<td>'.$rowf["numb"].'</td>
												<td>'.$rowf["uploaddate"].'</td>
												<td>'.$rowf["email"].'</td>
												<td>'.$rowf["adtype"].'</td>
												</tr>

												';
											}


											?>

										</table>


									</div>

								</div>

								<!-- Real Estate -->

								

								<!-- Electronics -->

								<div class="mdl-tabs__panel" id="electronic-panel" name="electronic-panel">


									<div style="background: white;margin: auto 40px;margin-top: 30px;margin-bottom: 120px; padding: 20px;">

										<table class="mdl-data-table mdl-js-data-table  mdl-shadow--2dp display responsive nowrap" id="eledata" style="margin: auto;margin-top: 30px; text-align:center;width:100%; ">
											<thead>
												<tr>
													<th>Product ID</th>
													<th>Product Name</th>
													<th>Description</th>
													<th>Price per Day</th>
													<th>Image</th>	
													<th>City</th>
													<th>Available</th>
													<th>Number</th>
													<th>Upload Date</th>
													<th>Email</th>
													<th>Ad Type</th>
												</tr>
											</thead>
											<?php




											while($rowe = mysqli_fetch_array($resulte))
											{
												echo'
												<tr>
												<td>'.$rowe["id"].'</td>
												<td>'.$rowe["name"].'</td>
												<td>'.$rowe["description"].'</td>
												<td>'.$rowe["price"].'</td>
												<td> 
												';
												echo '<img src="../products/'.$rowe["thumbnail"].'" width=100px height=100px/>
												</td>
												<td>'.$rowe["city"].'</td>
												<td>'.$rowe["available"].'</td>
												<td>'.$rowe["numb"].'</td>
												<td>'.$rowe["uploaddate"].'</td>
												<td>'.$rowe["email"].'</td>
												<td>'.$rowe["adtype"].'</td>
												</tr>

												';
											}


											?>

										</table>


									</div>
								</div>
							</div>
						</div>
					</section>
					<section class="mdl-layout__tab-panel" id="scroll-tab-3" name="scroll-tab-3">
						<div class="page-content">

							<div style="background: white;margin: auto 40px;margin-top: 30px;margin-bottom: 120px; padding: 20px;">

								<table class="mdl-data-table mdl-js-data-table  mdl-shadow--2dp display responsive nowrap" id="rudata" style="margin-top: 30px;padding: 30px; text-align:auto;width:100%;">
									<thead>
										<tr>
											<th>User ID</th>
											<th>Email</th>
											<th>Full Name</th>
											<th>City</th>
											<th>Contact</th>
											<th>Active</th>
										</tr>
									</thead>
									<?php								
									while($rowru = mysqli_fetch_array($resultru))
									{
										echo'
										<tr>
										<td>'.$rowru["uid"].'</td>
										<td>'.$rowru["email"].'</td>
										<td>'.$rowru["name"].'</td>
										<td>'.$rowru["city"].'</td>
										<td>'.$rowru["mob"].'</td>
										<td>'.$rowru["active"].'</td>
										</tr>

										';
									}
									?>
								</table>
							</div>
						</div>
					</section>
					<section class="mdl-layout__tab-panel" id="scroll-tab-4" name="scroll-tab-4">
						<div class="page-content">


							<div style="background: white;margin: auto 40px;margin-top: 30px;margin-bottom: 120px; padding: 20px;">
								<!-- Leads -->


								<table class="mdl-data-table mdl-js-data-table  mdl-shadow--2dp display responsive nowrap" id="ldata" style="margin: auto;margin-top: 30px;padding: 30px;width:100%;">
									<thead>
										<tr>
											<th>Notification ID</th>
											<th>Lessee's Email</th>
											<th>Sent Date-Time</th>
											<th>From</th>
											<th>To</th>
											<th>Product ID</th>
										</tr>
									</thead>
									<?php								
									while($rowl = mysqli_fetch_array($resultl))
									{
										echo'
										<tr>
										<td>'.$rowl["nid"].'</td>
										<td>'.$rowl["lessee"].'</td>
										<td>'.$rowl["dttime"].'</td>
										<td>'.$rowl["fromdt"].'</td>
										<td>'.$rowl["todt"].'</td>
										<td>'.$rowl["pid"].'</td>
										</tr>

										';
									}
									?>
								</table>
							</div>
						</div>
					</section>
					

					<section class="mdl-layout__tab-panel" id="scroll-tab-6" name="scroll-tab-6">

						<!-- My Account -->

						<div class="page-content" align="center">

							<ul class="demo-list-icon mdl-list" style="color: white;">

								<?php
								$con = mysqli_connect('localhost','admin','admin123','hirent') or die('Unable to Connect');
								$sql="SELECT email,fullname,contact FROM uadmin WHERE email='".$email."'";
								$result=mysqli_query($con,$sql);
								if ($result->num_rows != 0) {
									while ($row=mysqli_fetch_assoc($result)) {
										echo '<li class="mdl-list__item" style="color:white;">
										<span class="mdl-list__item-primary-content">
										<i class="material-icons mdl-list__item-icon" style="color:white;">person</i>
										'.$row["fullname"].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

										</span>
										</li>
										<li class="mdl-list__item" style="color:white;">
										<span class="mdl-list__item-primary-content">
										<i class="material-icons mdl-list__item-icon" style="color:white;">email</i>
										'.$row["email"].'
										</span>
										</li>
										<li class="mdl-list__item" style="color:white;">
										<span class="mdl-list__item-primary-content">
										<i class="material-icons mdl-list__item-icon" style="color:white;">phone</i>
										'.$row["contact"].'

										</span>
										</li>
										'; 
									}
								}
								mysqli_close($con);
								?>
							</ul>

<!-- 
	<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect modal__trigger" data-modal="#modal">v -->
<!-- 
 <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect modal__trigger" data-modal="#modal1"> <i class="material-icons">sync</i>  Update
 </button>-->



													<!-- <div id="modal" class="modal modal__bg">
														<div class="modal__dialog">
															<div class="modal__content">
																<div class="modal__header">
																	<div class="modal__title">
																		<h2 class="modal__title-text" style="color: black;">Username</h2>
																	</div>

																	<span class="mdl-button mdl-button--icon mdl-js-button  material-icons "></span>
																</div>

																<div class="modal__text" >
																	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
																		<input class="mdl-textfield__input" type="text" id="un">
																		<label class="mdl-textfield__label" for="un" style="color: black;">Enter Username...</label>
																	</div>
																</div>

																<div class="modal__footer">
																	<a class="mdl-button mdl-button--colored mdl-js-button  modal__close" id="update1" style="color: black;">
																		Update
																	</a>
																</div>
															</div>
														</div>
													</div>

													

													<div id="modal1" class="modal modal__bg">
														<div class="modal__dialog">
															<div class="modal__content">
																<div class="modal__header">
																	<div class="modal__title">
																		<h2 class="modal__title-text" style="color: black;">Contact</h2>
																	</div>

																	<span class="mdl-button mdl-button--icon mdl-js-button  material-icons "></span>
																</div>

																<div class="modal__text" >
																	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
																		<input class="mdl-textfield__input" type="text" id="un">
																		<label class="mdl-textfield__label" for="un" style="color: black;">Enter Contact...</label>
																	</div>
																</div>

																<div class="modal__footer">
																	<a class="mdl-button mdl-button--colored mdl-js-button  modal__close" style="color: black;">
																		Update
																	</a>
																</div>
															</div>
														</div>
													</div>
												-->


											</div>
										</section>

										


									</main>
									<footer class="mdl-mega-footer">
										<div class="mdl-mega-footer__bottom-section">
											<div class="mdl-logo">hiREnt</div>
											<ul class="mdl-mega-footer__link-list">
												<li><a href="#">Help</a></li>
												<li><a href="priter.php">Privacy & Terms</a></li>
											</ul>
										</div>
									</footer>
									
								</div>

								<script src="https://storage.googleapis.com/code.getmdl.io/1.0.5/material.min.js"></script> <!-- MDL JavaScript -->
								<script src="material-modal-master/dist/js/material-modal.min.js"></script>

								<script type="text/javascript">
									$(function(){
										$("#change").click(function(event) {
											$.ajax({
												url: 'aupdate.php',
												type: 'POST',
												data: {
													fullname: $("#fullname").val(),password: $("#password").val()
												},
												success:function(response){
													if(response==1)
													{
														alert("Updated");
														window.location.href="home.php";

													}
													else
													{
														alert("Error in Updating");
													}
												}

											})

										});
									});

								</script>

								<script>
									$(document).ready(function(){
										$('#vehdata').DataTable({responsive: true});
										$('#fundata').DataTable({responsive: true});
										$('#readata').DataTable({responsive: true});
										$('#eledata').DataTable({responsive: true});
										$('#rudata').DataTable({responsive: true});
										$('#ldata').DataTable({responsive: true});
										$('#paydata').DataTable({responsive: true});
									});
								</script>


							</body>
							</html>
							