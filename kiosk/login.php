<?php 
    require 'server.php';
    
   session_start();
    $password_err = "";
    $email_err = "";
    $attempt_count = 0;

    if (isset($_POST["email"]) && isset($_POST["password"])) {


       
       
        if (isset($_POST["remember"])) {
            setcookie("email", $_POST["email"], time() + 60*60*24, "/");
            $_COOKIE["email"] = $_POST["email"];
        
        } else {
            setcookie("email", null, -1, "/");
        }
    
        $email = $_POST["email"];
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($query);


    
        
        
        /*while($row = mysqli_fetch_array($result)) {
            print "Name: {$row['username']} has ID: {$row['userId']}";
        }*/
        if ($row = mysqli_fetch_array($result)) {
            if (password_verify($_POST['password'], $row['password'])=== true) {
                setcookie("username", $row['username'], time() + 60*60*24, "/");
                $_SESSION["email"] = $_POST["email"];
                $_SESSION["username"] = $row['username'];
                $_SESSION['loggin_in'] = true;
                header("Location: index.php");
                echo($_POST["email"]);
            } else {
                $password_err = 'Incorrect Password!';
                $attempt_count =+1;
                
            } 
        } else {
            $email_err = 'Email not found';
        }
        mysqli_close($conn);

    }

    if (isset($_GET["logout"])) {
        session_destroy();
        unset($_COOKIE['username']);
        unset($_COOKIE['email']);
        
        header("Location: login.php");
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

    <div class="login">
    <form class="text-center border border-light p-5" action="login.php" method="POST" >

    <p class="h4 mb-4">Log in</p>

    <!-- Username -->
    <input type="email" name="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="Email">
    <span class="help-block"><?php echo $email_err; ?></span>
    <!-- Password -->
    <input type="password" name="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password">
    <span class="help-block"><?php echo $password_err; ?></span>
    



    <div class="d-flex justify-content-around">
        <div>
            <!-- Remember me -->
            
            <input type="checkbox" id="remember" name="remember" <?php if (isset($_COOKIE["email"])): echo "checked"; endif ?> class="mb-4">
            <label for="remember">Remember my email</label>
        </div>
    </div>

    <!-- Sign in button -->
    <button class="btn btn-info btn-block my-4" type="submit"  >Log in</button>
<hr>
    <!-- Register -->
    <p>Not a member?
        <a href="register.php">Register</a>
    </p>

    <p>Forgot Password? 
        <a href="forgot_password.php">Click Here</a>
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