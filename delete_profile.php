<?php
// Initialize the session
require 'config.php';
session_start();
$deleted = false;

	$email = $_SESSION["email"];
	 $sql = "UPDATE users SET is_deleted=1 where email=:email"; 
		
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":email",$email);

            // Set parameters
			$email = $_SESSION["email"];
			// Attempt to execute the prepared statement
            if($stmt->execute()){
               $deleted = true;
			   session_destroy();
            } else{
				$deleted = false;
            }
        }
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Welcome</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main1.css" />
		<link rel="stylesheet" href="assets/css/c.css" />
		
	</head>
	<body class="landing">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
				<header id="header" class="alt">
				<div class="container">
				<div class="row">
						
			
					 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">

                        
                            <img src="images/cyberozelogo.png"  style="max-width:50%;" alt="" class="logo-1 img-responsive">
                     

                    </div>
					
					 
					</div>
						</div>
					</header>

				<!-- Banner -->
					<section id="banner">
						<div class="inner">
						<hr>
						<?php if($deleted){?>
							<h1><b>Your profile has been deleted</b></h1>
							<a href="register.php" class="button special">HOME</a>
						<?php } 
						else{
							?>
							<h1><b>Your profile Could not be deleted.Please try again</b></h1>
							<a href="welcome.php" class="button special">HOME</a>
							
						<hr>
						<?php
						}?>
						
	                    </div>
						
					</section>
					


				

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>