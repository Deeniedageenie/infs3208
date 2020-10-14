<?php 
    require 'server.php';
    
    session_start();
    $username_err = $email_err = "";
    $email = $username = "";

   $answer1 = $answer2 = $security_q1 = $security_q2 = "";
    $security_q1_err = $security_q2_err =  $answer1_err = $answer2_err = "";

    $username = $_SESSION['reset_username'];
    $email = $_SESSION['reset_email'];


    $query = "SELECT sq1,sq2,ans1,ans2 FROM user_details WHERE  username= '$username' ";
    $questions = $conn->query($query);

    $row = $questions->fetch_array();
    $ans1 = $row["ans1"];
    $ans2 = $row["ans2"];

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        
    
    // Validate answer1
    if(empty($_POST["answer1"])){
        $answer1_err = "Please enter an answer";     
    }else{
        $answer1 = strtolower( $_POST["answer1"]); 
    }
    
    // Validate answer2
    if(empty($_POST["answer2"])){
        $answer2_err = "Please enter an answer";     
    }else{
        $answer2 = strtolower( $_POST["answer2"]); 
    }

    if($ans1 === $answer1 || $ans2 === $answer2){
        header("Location: reset_password.php");
    }else{
        $answer1_err = $answer2_err = "wrong answer";
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

    <h2>Security Questions</h2>
    <p>Please answer the following questions so we can varify you.</p>
    


            <!-- A1 -->
            <br>
            <br>
            <div class="form-group <?php echo (!empty($answer1_err)) ? 'has-error' : ''; ?>">
            <h3 class="help-block"> <strong><?php echo $row["sq1"]; ?></strong> </h3>
            <br>
                <input placeholder="Please type your answer" type="text" name="answer1" class="form-control" value="<?php echo $answer1; ?>">
                <span class="help-block"><?php echo $answer1_err; ?></span>
            </div> 
            <br>
            <br>
            <!-- A2 -->
            <div class="form-group <?php echo (!empty($answer2_err)) ? 'has-error' : ''; ?>">
            <h3 class="help-block"> <strong><?php echo $row["sq2"]; ?></strong> </h3> 
            <br>
                <input type="text" placeholder="Please type your answer (Enter number only)" name="answer2" class="form-control" value="<?php echo $answer2; ?>">
                <span class="help-block"><?php echo $answer2_err; ?></span>
            </div> 
            <br>

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