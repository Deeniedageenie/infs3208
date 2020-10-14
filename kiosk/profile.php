<?php 
// Include config file
require_once "server.php";
//session_start();
 
// Define variables and initialize with empty values
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$f_name = $l_name = $gender = $city = $answer1 = $answer2 = $security_q1 = $security_q2 = "";
$f_name_err = $l_name_err = $age_err = $gender_err = $city_err = 
$security_q1_err = $security_q2_err =  $answer1_err = $answer2_err = $statusMsg ="";


$query = "SELECT username FROM users WHERE  email= '$email' ";
$rs = $conn->query($query);

// if(!$_SESSION['email'] || !isset($_COOKIE['email']) )
// {  
//   header("Location: login.php");//redirect to login page to secure the welcome page without login access.  
// }



 
// $targetDir = "uploads/";
// $fileName = basename($_FILES["file"]["name"]);
// $targetFilePath = $targetDir . $fileName;
// $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
// move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);




 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate names 
    if(empty($_POST["f_name"])){
        $f_name_err = "Please enter Your first name.";
    } else{
        $f_name = ucfirst(strtolower( $_POST["f_name"]));
    }
    
    if(empty($_POST["l_name"])){
        $l_name_err = "Please enter Your last name.";
    } else{
        $l_name = ucfirst(strtolower( $_POST["l_name"]));
    }

    // Validate gender
    if(empty($_POST["gender"])){
        $gender_err = "Please enter your gender";     
    }else{
        $gender = $_POST["gender"];
        
    }

    // Validate city
    if(empty($_POST["city"])){
        $city_err = "Please enter your city";     
    }else{
        $city = ucfirst(strtolower( $_POST["city"])); 
        
    }

    // Validate question1
    if(empty($_POST["question1"])){
        $security_q1_err = "Please select a Question";     
    }else{
        $security_q1 = $_POST["question1"]; 
    }
    // Validate answer1
    if(empty($_POST["answer1"])){
        $answer1_err = "Please enter an answer";     
    }else{
        $answer1 = strtolower( $_POST["answer1"]); 
    }
    // Validate question2
    if(empty($_POST["question2"])){
        $security_q2_err = "Please select a Question";     
    }else{
        $security_q2 = $_POST["question2"]; 
    }
    // Validate answer2
    if(empty($_POST["answer2"])){
        $answer2_err = "Please enter an answer";     
    }else{
        $answer2 = strtolower( $_POST["answer2"]); 
    }

   
    

    
    
    
    
    // Check input errors before inserting in database
    if(empty($f_name_err) && empty($l_name_err) && empty($gender_err)&& empty($city_err) 
    && empty($security_q1_err) && empty($security_q2_err) && empty($answer1_err) && empty($answer2_err) ){
        
        // Prepare an insert statement
       // $query = "SELECT id FROM users WHERE email = '$email'";
      //  $result = $conn->query($query);

       // $row = mysqli_fetch_array($result);
       
        
        $deets = "INSERT INTO user_details (username,f_name, l_name, gender, city, sq1, sq2, ans1, ans2,prof_pic) VALUES ('$username','$f_name','$l_name','$gender','$city','$security_q1','$security_q2','$answer1','$answer2','.$fileName')";
                $conn->query($deets);


        
       
        header("Location: profile_update.php");
        
    }
    
    // Close connection
    mysqli_close($conn);
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
    <?php include "nav.php"?>


    <div class="registration">

    <h2>Profile</h2>



        <p>Complete your account registration.</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="post">

        
             <!-- <div class="form-group <?php echo (!empty($photo_err)) ? 'has-error' : ''; ?>">
                <label>Profile photo</label>
                <div class="input-group">
                    
                        <!-- <div class="custom-file">
                            <input type="file" name="profile_pic" accept="image/*" onchange="preview_image(event)" class="custom-file-input" id="inputGroupFile01"
                            aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div> 
                        Select Image File to Upload:
                        <input onchange="preview_image(event)" type="file" name="file">
                </div>
                <img id="output_image"/>
                <span class="help-block"><?php echo $statusMsg; ?></span>
            </div>   -->

            <div class="form-group <?php echo (!empty($f_name_err)) ? 'has-error' : ''; ?>">
                <label>First Name</label>
                <input type="text" name="f_name" class="form-control" value="<?php echo $f_name; ?>">
                <span class="help-block"><?php echo $f_name_err; ?></span>
            </div>    

            <div class="form-group <?php echo (!empty($l_name_err)) ? 'has-error' : ''; ?>">
                <label>Last Name</label>
                <input type="text" name="l_name" class="form-control" value="<?php echo $l_name; ?>">
                <span class="help-block"><?php echo $l_name_err; ?></span>
            </div> 

            <div class="form-group <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
                <label>Gender: </label>

                <!-- <input type="radio" name="gender" <?php  echo "checked";?> value="female">Female
                <input type="radio" name="gender" <?php  echo "checked";?> value="male">Male      -->
                <select name="gender">
                <option value=" ">--select--</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
                </select>

                <span class="help-block"><?php echo $gender_err; ?></span>
            </div>

            
            <div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
                <label>Your city</label>
                <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
                <span class="help-block"><?php echo $city_err; ?></span>
            </div> 

<!-- Secutity Quensions -->

            <!-- Q1 -->
            <div class="form-group <?php echo (!empty($security_q1_err)) ? 'has-error' : ''; ?>">
                <label>Security Question 1: </label>

                
                <select name="question1">
                <option value=" ">Select Q1</option>
                <option value="What is your pets name?">What is your pets name?</option>
                <option value="Where was your dad born?">Where was your dad born?</option>
                <option value="Do you prefer to yeet or get yeeted?">Do you prefer to yeet or get yeeted?</option>
                </select>

                <span class="help-block"><?php echo $security_q1_err; ?></span>
            </div>
            <!-- A1 -->
            <div class="form-group <?php echo (!empty($answer1_err)) ? 'has-error' : ''; ?>">
                <label>Your Answer</label>
                <input type="text" name="answer1" class="form-control" value="<?php echo $answer1; ?>">
                <span class="help-block"><?php echo $answer1_err; ?></span>
            </div> 


            <!-- Q2 -->
            <div class="form-group <?php echo (!empty($security_q2_err)) ? 'has-error' : ''; ?>">
                <label>Security Question 2: </label>

                
                <select name="question2">
                <option value=" ">Select Q2</option>
                <option value="How many cars have you owned?">How many cars have you owned?</option>
                <option value="What year did you / will you graduate highschool? ">What year did you / will you graduate highschool? </option>
                <option value="How much do you bench?">How much do you bench?</option>
                </select>

                <span class="help-block"><?php echo $security_q2_err; ?></span>
            </div>
            <!-- A2 -->
            <div class="form-group <?php echo (!empty($answer2_err)) ? 'has-error' : ''; ?>">
                <label>Your Answer</label>
                <input type="text" placeholder="Enter number only." name="answer2" class="form-control" value="<?php echo $answer2; ?>">
                <span class="help-block"><?php echo $answer2_err; ?></span>
            </div> 

            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="next">
            </div>
            
        </form>

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