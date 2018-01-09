<?php
session_start();
$data_inserted=$_SESSION["data_inserted"];

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

<body >


  <div id="login-page" class="row">
    <div class="col s12 z-depth-6 card-panel">
        <div class="row">
          <div class="input-field col s12 center">
            <img src="images/cyberozelogo.png" alt="" class="responsive-img">
            <p class="center login-form-text">CYBEROZE REGISTERATION</p>
			<?php
			if($data_inserted)
			{
			?>
			<div id="msg">
			<p class="center login-form-text" id="view"><b>Your Registeration has been completed.<br>Please <a href="login.php">LOGIN</a> to continue</b></p>
			</div>
			<?php 
			}
			else 
			{
			?>
			<div id="msg">
			<p class="center login-form-text" id="view"><b>Sorry some Technical error occured.Please try again after some time.</b></p>
			 <img src="images/oops.png" alt="" class="responsive-img">
			</div>
			<?php
			}
			?>
			
          </div>
        </div>
     
    </div>
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