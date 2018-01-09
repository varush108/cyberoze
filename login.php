<?php

require_once 'config.php';
$password_err=false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$email = $_POST["email"];
	$password= $_POST["password"];
	$sql = "SELECT name,email, password_hash FROM users WHERE email = :email";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
               
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $hashed_password = $row['password_hash'];
                        if(password_verify($password, $hashed_password)){
                           
							session_start();
							$_SESSION['logged_in']=true;
                            $_SESSION['email'] = $email;     
							
                            header("location: welcome.php");
                        }
						else
						{
							$password_err=true;
						}
					}
				}
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
  <title>CYBEROZE LOGIN </title>
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
      <form class="login-form"id = "login-form" class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="row">
          <div class="input-field col s12 center">
            <img src="images/cyberozelogo.png" alt="" class="responsive-img valign profile-image-login">
            <p class="center login-form-text">LOGIN</p>
          </div>
        </div>
		<?php
		if($password_err)
		{
			?>
	<div class="col s12" id="login_err">
			<center style="color:red;">Incorrect username or password</center>
			</div>
       <?php
		}
		?>
	   <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-email prefix"></i>
            <input class="validate" id="email" name="email" type="text">
            <label for="email" class="center-align">Email</label>
			<div class="col s12" id="email_err">
			<center style="color:red;">Email doesn't exists</center>
			</div>

          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" name="password" type="password">
            <label for="password">Password</label>
          </div>
        </div>
       
        <div class="row">
          <div class="input-field col s12">
            <button type="submit" id="login_btn" class="btn waves-effect waves-light col s12">Login</button>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6 m6 l6">
            <p class="margin medium-small"><a href="register.php">Register Now!</a></p>
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
<script>
$(document).ready(function(){
$("#login_btn").attr("disabled",true);
$("#email_err").hide();
	 function checkEmail() {
	var search_val=$("#email").val(); 
	console.log(search_val);
  			$.post("get_email.php", {email : search_val}, function(data){
   				if (data==false){ 
     				$("#email_err").show();
					$("#login_btn").attr("disabled",true);
					
   				}
				else {
					$("#email_err").hide(); 
					$("#login_btn").attr("disabled",false);
					
				}
	
				
  			})
	 }

	$("#email").keyup(function(){ 
		checkEmail();
	});
	$("#email").change(function(){ 
		checkEmail();		
	});
})
</script>
</body>

</html>