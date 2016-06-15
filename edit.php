<?php  
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Location-Based advertising & Management service</title>

	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/nivo-lightbox.css">
	<link rel="stylesheet" href="css/nivo_themes/default/default.css">
	<link rel="stylesheet" href="css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
</head>
<body>


<section class="preloader">
	<div class="sk-spinner sk-spinner-pulse"></div>
</section>


<section class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
			</button>
			<a href="index.php" class="navbar-brand">Restaurant Control Panel</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="index.php" class="smoothScroll">HOME</a></li>
			</ul>
		</div>
	</div>
</section>


<section id="Drinks" class="parallax-section">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-2 col-md-8 col-sm-12 text-center">

				<?php 
					function contains($needle, $haystack)
					{
					    return strpos($haystack, $needle) !== false;
					}

					if ( isset($_POST['ID']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['details']) && isset($_POST['time']) && isset($_POST['sale']) && isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0 ){

						$id = $_POST['ID'];
						$name = $_POST['name'];
						$price = $_POST['price'];
						$details = $_POST['details'];
						$time = $_POST['time'];
						$sale = $_POST['sale'];

						$allowed = array('png', 'jpg', 'gif');
						$extension = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);


						$path = "uploads/" .$_FILES['fileToUpload']['name'];

						if(!in_array(strtolower($extension), $allowed)){
							echo 'ERROR';
						}


						if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], 'uploads/'.$_FILES['fileToUpload']['name'])){
							if (contains("d", $id)){
								$id = str_replace("d", "", $id);
								$item = $db->editDrinkTable($id, $name, $price, $details, $sale, $time, $path);
							}
							else {
								$id = str_replace("f", "", $id);
								$item = $db->editFoodTable($id, $name, $price, $details, $sale, $time, $path);
							}
							

							echo '<h1 class="heading">Item has been EDITED!</h1>
								<hr>';
							
						}

					}
					else{
						
					}

				?>

			</div>
				

				
		</div>
	</div>
</section>


<footer class="parallax-section">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
				<h2 class="heading">Contact The Team.</h2>
				<div class="ph">
					<p><i class="fa fa-phone"></i> Phone</p>
					<h4>011-177-10932</h4>
				</div>
				<div class="address">
					<p><i class="fa fa-map-marker"></i> Our Location</p>
					<h4>Any bit on the net.</h4>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
				<h2 class="heading">Open Hours</h2>
					<p>Sunday <span>10:30 AM - 10:30 PM</span></p>
					<p>Mon-Fri <span>8:00 AM - 8:00 PM</span></p>
					<p>Saturday <span>11:30 AM - 10:00 PM</span></p>
					<p>Actually we're available on request.</p>
			</div>
			<div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
				<h2 class="heading">Follow Us</h2>
				<ul class="social-icon">
					<li><a href="#" class="fa fa-facebook wow bounceIn" data-wow-delay="0.3s"></a></li>
					<li><a href="#" class="fa fa-twitter wow bounceIn" data-wow-delay="0.6s"></a></li>
					<li><a href="#" class="fa fa-behance wow bounceIn" data-wow-delay="0.9s"></a></li>
					<li><a href="#" class="fa fa-dribbble wow bounceIn" data-wow-delay="0.9s"></a></li>
					<li><a href="#" class="fa fa-github wow bounceIn" data-wow-delay="0.9s"></a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>



<section id="copyright">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h3>Location-based Restaurant Management Service</h3>
				<p> 
                	We're happy to ease it to you.
                </p>
			</div>
		</div>
	</div>
</section>


<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.parallax.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/nivo-lightbox.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>





