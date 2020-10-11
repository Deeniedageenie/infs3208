
<?php 
// Include config file
require_once "server.php";
session_start();

// Define variables and initialize with empty values
$username = $_SESSION['username']= $_COOKIE['username'];

$time = $location = $description = $event_name =$date =  "";
$time_err = $location_err = $description_err = $event_name_err =$date_err = "";


if(!$_SESSION['email'] || !isset($_COOKIE['email']) )
{  
  header("Location: login.php");//redirect to login page to secure the welcome page without login access.  
}

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate names 
    if(empty($_POST["event_name"])){
      $event_name_err = "Please the name of the event";
    } else{
      $event_name = ucfirst(strtolower( $_POST["event_name"]));
    }

    if(empty($_POST["date"])){
      $date_err = "Please enter the date";
      } else{
        $date = $_POST["date"];
      }

    if(empty($_POST["time"])){
        $time_err = "Please enter the time";
    } else{
        $time = $_POST["time"];
    }
    
    if(empty($_POST["location"])){
        $location_err = "Please enter the location";
    } else{
        $location = ucfirst(strtolower( $_POST["location"]));
    }
    
    if(empty($_POST["description"])){
        $description_err = "Please enter a description";     
    }else{
        $description = $_POST["description"];
        
    }

    
    
    
    // Check input errors before inserting in database
    if(empty($date_err) && empty($event_name_err) && empty($time_err) && empty($location_err) && empty($description_err)){
        
        // Prepare an insert statement
       // $query = "SELECT id FROM users WHERE email = '$email'";
      //  $result = $conn->query($query);

       // $row = mysqli_fetch_array($result);
        
        $event = "INSERT INTO events (username, event_name,date,time, location, description) VALUES ('$username','$event_name','$date', '$time','$location','$description')";
        $conn->query($event);

        
       
        header("Location: your_events.php");
    
        
         
        
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
    <?php include "nav.php"?>

   
  <div class="registration">
        <h2>Create an Event</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


            <div class="form-group <?php echo (!empty($event_name_err)) ? 'has-error' : ''; ?>">
                <label>Event Name</label>
                <input placeholder="eg. Birthday" type="text" name="event_name" class="form-control" value="<?php echo $event_name; ?>">
                <span class="help-block"><?php echo $event_name_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
                <label>Date</label>
                <input placeholder="eg. 3pm" type="date" name="date" class="form-control" value="<?php echo $date; ?>">
                <span class="help-block"><?php echo $date_err; ?></span>
            </div>   

            <div class="form-group <?php echo (!empty($time_err)) ? 'has-error' : ''; ?>">
                <label>Time</label>
                <input placeholder="eg. 3pm" type="time" name="time" class="form-control" value="<?php echo $time; ?>">
                <span class="help-block"><?php echo $time_err; ?></span>
            </div>    

            <div class="form-group <?php echo (!empty($location_err)) ? 'has-error' : ''; ?>">
                <label>Location</label>
                <input placeholder="eg. Brisbane" type="text" name="location" class="form-control" value="<?php echo $location; ?>">
                <span class="help-block"><?php echo $location_err; ?></span>
            </div> 

            <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                <label>Description: </label>
                <textarea type="text" name="description" class="form-control" value="<?php echo $description; ?>"></textarea>
                <span class="help-block"><?php echo $description_err; ?></span>
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