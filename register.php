<?php
session_start();
require_once 'config.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$data_inserted = false;
	$prefix = "cyberoze";
	$UID = uniqid($prefix);
		// Prepare an insert statement
        $sql = "INSERT INTO users (UID,name,email,password_hash,mobile,gender,is_deleted) 
		VALUES (:uid,:name,:email,:password,:mobile,:gender,:is_deleted)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":uid",$ID);
			$stmt->bindParam(":name",$name);
			$stmt->bindParam(":email",$email);
			$stmt->bindParam(":password",$password);
			$stmt->bindParam(":mobile",$mobile);
			$stmt->bindParam(":gender",$gender);
			$stmt->bindParam(":is_deleted",$is_deleted);
			
            // Set parameters
			$ID = $UID;
			$name = $_POST["fullname"];
			$email = $_POST["email"];
			$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
			$mobile = $_POST["mobile"];
			$gender = $_POST["gender"];
			$is_deleted = 0;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
               $_SESSION["data_inserted"] = true;
            } else{
				$_SESSION["data_inserted"] = false;
            }
        }
			header("location:verified.php");
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
            <i class="mdi-communication-email prefix"></i>
            <input id="email" required name="email" type="email" class="validate">
            <label for="email" class="center-align">Email</label>
			<div class="col s12" id="email_err">
			<center style="color:red;">Email already registered</center>
			</div>
          </div>
        </div>
	
	<div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-phone prefix"></i>
            <input id="mobile" pattern=".{10,12}"   title="Mobile no must be of 10-12 digits only."  name="mobile"  type="text" minlength="10" >
            <label for="phone">Mobile number</label>
		</div>
		</div>
		<div class="row margin">
    	<div class="input-field col s12">
		<i class="mdi-social-person-outline prefix"></i>
			<input name="gender" required class="with-gap" type="radio" value="male" id="test1" checked />
			<label for="test1">Male</label>
		
		
			<input class="with-gap" name="gender" type="radio" value="female" id="test2" />
			<label for="test2">Female</label>
		
			<input class="with-gap" name="gender" type="radio" value="other" id="test3"  />
			<label for="test3">Other</label>
		</div>
		</div>
		<br>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" required name="password" minlength="8" type="password" >
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password-again" name="password-again" minlength="8"  type="password" >
            <label for="password-again">Re-type password</label>
			
			<div class="col s12" id="password_err">
			<center style="color:red;">Passwords did not match</center>
			</div>
          </div>
       
		</div>
        <div class="row">
          <div class="input-field col s12">
            <button type="submit" id="register" name="register" class="btn waves-effect waves-light col s12 "  >Register Now</button>
			
          </div>
		  
          <div class="input-field col s12">
            <p class="margin center medium-small sign-up">Already have an account? <a href="login.php">Login</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>


  <!-- ================================================
    Scripts
    ================================================ -->
  <!-- jQuery Library -->
 <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <!--materialize js-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
var email = false;
var password = false;

	$('#password_err').hide();
	$('#email_err').hide();
	function checkEmail() {
	var search_val=$("#email").val(); 

  			$.post("get_email.php", {email : search_val}, function(data){
   				if (data==true){ 
     				$("#email_err").show();
						email=false;
					
   				}
				else
				{
					$("#email_err").hide(); 
					email=true;
				}
				
				
  			})
	 }
	
		$("#email").keyup(function(){ 
		checkEmail();  			
		});
		$("#email").change(function(){ 
		checkEmail();  			
		});

		
	$('#password-again').keyup(function(){
		if($('#password').val() == $('#password-again').val()){		
		password = true;
		$('#password_err').hide();
		}
		else{
			$('#password_err').show();
			password=false;
		}
	});
	$("#reg-form").submit(function(e){
	
		return (password && email);
			
	}); 
	 
})
</script>

 
</body>

</html>