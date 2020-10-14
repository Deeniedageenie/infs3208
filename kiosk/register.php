<?php 

// Include config file
require_once "server.php";
session_start(); 
 
// Define variables and initialize with empty values
$username = $password = $email = "";
$username_err = $password_err = $email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $username = $_POST["username"];
         
    }
    
    // Validate Email
  
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";     
    }else{
       
    // Check if the user already exists
        $check="SELECT * FROM users WHERE email = '$_POST[email]'";
        $rs = $conn->query($check);
        $data = mysqli_fetch_array($rs, MYSQLI_NUM);

        if($data[0] > 1) {
            $email_err = "User Already in Exists<br/>";
            
        }else{
            $email = $_POST["email"];
        }
        
        
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 4){
        $password_err = "Password must have atleast 4 characters.";
    } else{
    // Save the password as a hash file to increase security
        $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
    }
    
    
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($email_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username','$email', '$password')";
        $deets = "INSERT INTO user_details (username) VALUES ('$username')";

        //setcookie("username", $username, time() + 60*60*24, "/");
        $conn->query($deets);
        $conn->query($sql);

        $_SESSION["email"] = $_POST["email"];
        $_SESSION["username"] = $_POST["username"];
        
        $_SESSION['loggin_in'] = true;
        header("Location: profile.php");
        echo($_POST["email"]);
        
         
        
    }
    
    // Close connection
    //mysqli_close($conn);
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
   


<!-- <div class="registration">
    Default form register 
    <form class="text-center border border-light p-5">

    <p class="h4 mb-4">Sign up</p>

    <div class="form-row mb-4">
        <div class="col">
            First name 
            <input type="text" name="username" value="<?php echo $username; ?>" id="defaultRegisterFormFirstName" class="form-control" placeholder="Username">
        </div>
        
    </div>

   E-mail 
    <input type="email" name="email" value="<?php echo $email; ?>"  id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="E-mail">

   Password 
    <input type="password" name="password_1"id="defaultRegisterFormPassword" class="form-control" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">
    <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
        At least 8 characters and 1 digit
    </small>

   Sign up button 
    <button class="btn btn-info my-4 btn-block" name="reg_user" type="submit">Register</button>
    <hr>
       sign in 
        <p>Already a member?
            <a href="login.php">Log in</a>
        </p>
</div>  -->

<div class="registration">

        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>


</div>





</form>
<!-- Default form login -->
    </div>
        
    <?php include "footer.php"?> 








<script src="scripts/script.js"> </script>
<!-- MAPS -->
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsUQBZ1h17-h2bRZiM_bP_yp-tX4A5mgo&callback=initMap"
type="text/javascript"></script> -->
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