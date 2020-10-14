<?php 
// Include config file
require_once "server.php";
//session_start();


// Define variables and initialize with empty values
$username = $_SESSION['username']= $_COOKIE['username'];

$time = $location = $description = $event_name =$date =  "";
$time_err = $location_err = $description_err = $event_name_err =$date_err = "";




if(!$_SESSION['email'] || !isset($_COOKIE['email']) )
{  
  header("Location:login.php");//redirect to login page to secure the welcome page without login access.  
}


if(isset($_POST["update_button"])) {
    //update action

    $date = $_POST["date"];
    $time = $_POST["time"];
    $location = $_POST["location"];
    $description = $_POST["description"];
    $event_id= $_POST["event_id"];

    $conn->query("UPDATE events SET date = '$date', time = '$time', location = '$location', description = '$description' WHERE event_id = '$event_id'  " );

}

if (isset($_POST["delete_button"])) {
    //delete action
    $event_id= $_POST["event_id"];
    $conn->query("DELETE FROM events WHERE event_id = '$event_id' " );
}

$result = $conn->query("SELECT * FROM events WHERE username = '$username'");
    if ($result->num_rows > 0) {
        $event_details = $result;
    } else {
        $event_details = null;
        header("Location: eventcreator.php");

    }

/*
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $date = $_POST["date"];
    $time = $_POST["time"];
    $location = $_POST["location"];
    $description = $_POST["description"];
    $event_id= $_POST["event_id"];

   $conn->query("UPDATE events SET date = '$date', time = '$time', location = '$location', description = '$description' WHERE event_id = '$event_id'  " );

   
    
    }

    $result = $conn->query("SELECT * FROM events WHERE username = '$username'");
    if ($result->num_rows > 0) {
        $event_details = $result;
    } else {
        $event_details = null;
    }
    */
    

    

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
                <td><strong>Event id</strong></td>
                <td><strong>Event Name</strong></td>
                <td><strong>Date</strong></td>
                <td><strong>Time</strong></td>
                <td><strong>Location</strong></td>
                <td><strong>Description</strong></td>
            </tr>
            <?php while ($row = $event_details->fetch_array()): ?>
                <form action="your_events.php" method="POST">
                    <tr>
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" value="<?php echo $row["id"]?>">
                        <td><input type="text" name="event_id" class="form-control disabled" value="<?php echo $row["event_id"]?>"></td>
                        <td><input type="text" name="event_name" class="form-control  " value="<?php echo $row["event_name"]?>"></td>
                        <td><input type="date" name="date" class="form-control  " value="<?php echo $row["date"]?>"></td>
                        <td><input type="time" name="time" class="form-control" value="<?php echo $row["time"]?>"></td>
                        <td><input type="text" name="location" class="form-control" value="<?php echo $row["location"]?>"></td>
                        <!-- <td><input type="text" name="description" class="form-control" value="<?php echo $row["description"]?>"></td> -->
                        <td> <textarea type="text" name="description" class="form-control" value=""><?php echo $row["description"] ?></textarea></td>
                        
                        <td> <button class="btn btn-info btn-sm " type="submit" name="update_button" >update</button></td>
                        <td> <button class="btn btn-danger btn-sm " type="submit" name="delete_button" >delete</button></td>


                    
                        <!-- <td><input type="submit" class="btn btn-danger btn-sm"  name="delete_button" value="delete" /></td> -->
                        

                    </tr>
                </form>
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