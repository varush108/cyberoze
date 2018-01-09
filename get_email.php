<?php
 
 require_once 'config.php';
 $sql = "SELECT UID FROM users WHERE email = :email";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':email', $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
					echo true;
				} else{
					
					echo false;
                    
                }
            } else{
                echo "error";
            }
        }
?>