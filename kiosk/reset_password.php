
<?php 
    require 'server.php';
    
    session_start();
    $username_err = $email_err = $password_err ="";
    $email = $username =  $password = "";

    $username = $_SESSION["reset_username"];
   

    if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 4){
        $password_err = "Password must have atleast 4 characters.";
    } else{
    // Save the password as a hash file to increase security
        $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
    }
    
    

    if(empty($password_err) ){
        
        $conn->query("UPDATE users SET password = '$password' WHERE username = '$username'");

        header("Location: login.php");

                 
        
    }
}

    if(!$_SESSION['reset_email'] && !$_SESSION['reset_username'])
    {  
      
      header("Location: forgot_password.php");//redirect to login page to secure the welcome page without login access.  
  }

    


?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kiosk</title>
    <link rel="shortcut icon" href="images/logo.png" />
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.4/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/styles.css">
    
</head>
<body>
<?php include "nav-login.php"?>

    <div class="registration">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <h2>Reset Password</h2>
    <p>Enter new password</p>

    <!-- Password -->
    <input type="password" name="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password">
    <span class="help-block"><?php echo $password_err; ?></span>

    <!-- Sign in button -->
    <button class="btn btn-info btn-block my-4" type="submit" >Next</button>
<hr>
    <!-- Register -->
    <p>Not a member?
        <a href="register.php">Register</a>
    </p>


</form>
<!-- Default form login -->
    </div>
        
    <?php include "footer.php"?> 








<script src="scripts/script.js"> </script>
<!-- MAPS -->

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.4/js/mdb.min.js"></script>

</body>
</html>