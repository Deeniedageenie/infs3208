<?php 
    require 'server.php';
    
    session_start();
    $username_err = $email_err = "";
    $email = $username = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

    $check="SELECT * FROM users WHERE email = '$_POST[email]' AND username = '$_POST[username]' ";
        $rs = $conn->query($check);
        $data = mysqli_fetch_array($rs, MYSQLI_NUM);

        if($data[0] > 1) {
            
            $_SESSION['reset_email'] = $_POST["email"];
            $_SESSION['reset_username'] = $_POST["username"];
            header("Location: security_questions.php");
            

            
        }else{
            $email_err = "User Does't exist<br/>";
        }
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

    <h2>Forgot password</h2>
    <p>Please fill in the following</p>

    <!-- Email -->
    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="">
        <span class="help-block"><?php echo $email_err; ?></span>
    </div>
    <!-- Username -->
    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="">
        <span class="help-block"><?php echo $username_err; ?></span>
    </div>  

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