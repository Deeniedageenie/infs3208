<?php 
// Include config file
require_once "server.php";
session_start();


// Define variables and initialize with empty values
$username = $_COOKIE['username'];
$email = $_SESSION['email'];
$f_name = $l_name = $gender = $city = "";
$f_name_err = $l_name_err = $age_err = $gender_err = $city_err = "";




if(!$_SESSION['email'] || !isset($_COOKIE['email']) )
{  
  header("Location: login.php");//redirect to login page to secure the welcome page without login access.  
}




$result = $conn->query("SELECT * FROM user_details WHERE username = '$username'");
    if ($result->num_rows > 0) {
        $courses = $result;

        
    } else {
        $courses = null;
        header("Location: profile.php");
    }
    
if($_SERVER["REQUEST_METHOD"] == "POST"){


$city = ucfirst(strtolower( $_POST["city"]));

$conn->query("UPDATE user_details SET city = '$city' WHERE username = '$username'");
header("Location: profile_update.php");


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


 <div class="profile">
 
       <table class="mt-3 table table-striped text-center">
            <tr class="text-center">
                <td><strong>Username</strong></td>
                <td><strong>First Name</strong></td>
                <td><strong>Last Name</strong></td>
                <td><strong>Gender</strong></td>
                <td><strong>City</strong></td>
            </tr>
            <?php while ($row = $courses->fetch_array()): 
                
                $imageURL = 'uploads/'.$row["prof_pic"];?>
                <form action="profile_update.php" method="POST">
                    <tr id="profile_att">
                        <img src="<?php echo $imageURL; ?>" alt="" />
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" value="<?php echo $row["id"]?>">
                        <td><?php echo $row["username"]?></td>
                        <td><?php echo $row["f_name"]?></td>
                        <td><?php echo $row["l_name"]?></td>
                        <td><?php echo $row["gender"]?></td>
                        <td><input type="text" name="city" class="form-control" value="<?php echo $row["city"]?>"></td>
                        <td>
                        <button class="btn btn-info btn-sm " type="submit" >update</button>
                        
                        </td>
                    </tr>
                </form>'
            <?php endwhile ?>   
        </table>
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