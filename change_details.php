<?php
session_start();
$data_inserted = false;
require_once 'config.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	// Prepare an insert statement
        $sql = "UPDATE users SET name=:name, mobile =:mobile where email=:email"; 
		
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":name",$name);
			$stmt->bindParam(":mobile",$mobile);
			$stmt->bindParam(":email",$email);

            // Set parameters
			$name = $_POST["fullname"];
			$mobile = $_POST["mobile"];
			$email = $_SESSION["email"];
			// Attempt to execute the prepared statement
            if($stmt->execute()){
               $data_inserted = true;
            } else{
				$data_inserted = false;
            }
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CYBEROZE REGISTERATION</title>
  <!-- CORE CSS-->
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">

<style type="text/css">
html,
body {
    height: 100%;
}
html {
    display: table;
    margin: auto;
	background-color: #252426;
}
body {
    display: table-cell;
    vertical-align: middle;
}
.margin {
  margin: 0 !important;
}
</style>
</head>

<body class="blue">


  <div id="login-page" class="row">
  <?php if(!$data_inserted){?>
    <div class="col s12 z-depth-6 card-panel">
      <form id = "areg-form" class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="row">
          <div class="input-field col s12 center">
            <img src="images/cyberozelogo.png" alt="" class="responsive-img">
            <p class="center login-form-text">CYBEROZE REGISTERATION</p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-hardware-keyboard-alt prefix"></i>
            <input id="fullname" required name="fullname" type="text" >
            <label for="fullname" class="center-align">Full name</label>
          </div>
		  
		</div>
    	<div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-phone prefix"></i>
            <input id="mobile" pattern=".{10,12}"   title="Mobile no must be of 10-12 digits only."  name="mobile"  type="text" minlength="10" >
            <label for="phone">Mobile number</label>
		</div>
		</div>
		<div class="row">
          <div class="input-field col s12">
            <button type="submit" id="login_btn" class="btn waves-effect waves-light col s12">SUBMIT</button>
          </div>
        </div>
       
		 </form>
		  <div class="row">
          <div class="input-field col s6 m6 l6">
            <p class="margin medium-small"><a href="welcome.php">HOME PAGE</a></p>
          </div>
         
        </div>
    </div>
	<?php } 
	if($data_inserted){?>
	 <div class="col s12 z-depth-6 card-panel">
	<div class="row" id="changeSuccess">
          <div class="input-field col s12 center">
            <img src="images/cyberozelogo.png" alt="" class="responsive-img">
            <p class="center login-form-text">Your Details have been changed Sucessfully</p>
          </div>
    </div>
	<div class="row">
          <div class="input-field col s6 m6 l6">
            <p class="margin medium-small"><a href="welcome.php">HOME PAGE</a></p>
          </div>
         
        </div>
	</div>
	<?php }?>
	

  </div>


  <!-- ================================================
    Scripts
    ================================================ -->
  <!-- jQuery Library -->
 <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <!--materialize js-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>
 
</body>

</html>