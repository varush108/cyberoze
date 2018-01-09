<?php
// Initialize the session
require 'config.php';
session_start();
 if(!$_SESSION['logged_in'] || empty($_SESSION['logged_in'])){
  header("location: login.php");
  exit;

}
else
{
	$email = $_SESSION["email"];
	$sql = "SELECT name,email, mobile FROM users WHERE email = :email and is_deleted=0";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
               
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                       $name=$row["name"];
					   $mobile=$row["mobile"];
                        
							   
							
                    }
					}
				}
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
					
					 <nav id="nav">
					 <ul>
					 
							<li><a href="welcome.php">Home</a></li>
							
							
							
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
											<li><a href="logout.php">Sign Out</a></li>
											<li><a href="change_details.php">Change Details</a></li>
											<li><a href="delete_profile.php">Delete Profile</a></li>
										</ul>
									</div>
								</li>
							
						</ul>
						</nav>
					</div>
						</div>
					</header>

				<!-- Banner -->
					<section id="banner">
						<div class="inner">
						<hr>
							<h1>Hi,<b><?php echo $name; ?></b>. Welcome to our site.</h1>
						<hr>
						
	                    </div>
						<p>
					Your Details are :<br>Name : <?php echo $name;?> <br>	
							Email : <?php echo $email;?> <br>	
							Mobile : <?php echo $mobile;?> <br>	
					</p>
					<div class="container">
						 
							<ul class="actions">
							
								<li><a href="logout.php" class="button special">Sign Out</a></li>
							
								<li><a href="change_details.php" class="button special">Change Details</a></li>
							
								<li><a href="delete_profile.php" class="button special">Delete Profile</a></li>
								
							</ul>
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