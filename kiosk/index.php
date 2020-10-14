<?php 
require_once "server.php";
session_start(); 

    
 if(!$_SESSION['email']  )
   {  
     if(!isset($_COOKIE['email'])){
     header("Location: login.php");//redirect to login page to secure the welcome page without login access.  
      }
   }

$username = $_SESSION['username']= $_COOKIE['username'];

$result = $conn->query("SELECT * FROM events WHERE username = '$username'");
    if ($result->num_rows > 0) {
        $event_details = $result;
    } else {
        $event_details = null;
       header("Location: eventcreator.php");

    }
   $comment_details = null;
    // $comment_results = $conn->query( "SELECT * FROM comments WHERE event_id =  ");
    // if ($comment_results->num_rows > 0) {
    //   $comment_details = $comment_results;
    // }

    function getcomments($ev_id){
      global $conn;
    
      $comment_results = $conn->query( "SELECT * FROM comment WHERE event_id = '$ev_id' ");
      if ($comment_results->num_rows > 0) {
      $comment_details = $comment_results;
     }
     return $comment_details;
    }

    

    if($_SERVER["REQUEST_METHOD"] == "POST"){


      $comment = ucfirst(strtolower( $_POST["comment"]));
      $event_id = $_POST["event_id"];
      
      $conn->query("INSERT INTO `comment` (`event_id`,`comment`) VALUES ('$event_id','$comment')");

      //header("Location: index.php");
     
      
      
      }
  


 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
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

<div id="page_container">

        <?php include "nav.php"?>
    
        
        <?php include "map.php"?>
         
        

       

       
          <div class="cards-deck">
          <?php while ($row = $event_details->fetch_array()): ?>

            
                  
                         <div class="cards">
                          <img class="card-img-top" src="images/riverside.jpg" alt="Card image cap">
                          <div class="card-body">
                         

                            <h4 class="card-title"> <strong><?php echo $row["event_name"]?></strong></h4>
                            <h5><strong>Date: </strong> <?php echo $row["date"]?></h5>
                            <h5><strong>Time: </strong> <?php echo $row["location"]?></h5>
                            <br>
                            <p class="card-text"> <?php echo $row["description"]?> </p>
                          </div>

                    
                          <div class="card-footer">
                          <form action="index.php" method="POST">
                          <input type="text" name="event_id" value="<?php echo $row["event_id"]?>">
                            <tr>
                            
                            <td><input type="text" name="comment" class="form-control" placeholder="Comments..." value=""></td>
                            <td><button class="btn btn-danger btn-sm " type="submit" name="post_comment" >Post</button></td>
                          </tr>
                          </form>
                        <tr>
                            <td><h5><strong>Previous Comments...</strong> </h5> </td>
                            <ul class="list-group list-group-flush">

                            <?php 

                              $ev_id = $row["event_id"];
                              $comment_results = $conn->query( "SELECT comment FROM comment WHERE event_id = '$ev_id' ");
                              if ($comment_results->num_rows > 0) {
                                $comment_details = $comment_results;
                                
                                
                              }else {
                                $comment_details = null;
                                

                              } ?> 
                              
                              <?php if($comment_details!= null):  ?> 
                             <?php  while ($comment_row = $comment_details->fetch_array()): ?>
                            
                             <li class="list-group-item"> <?php echo $comment_row["comment"];?> </li>

                             
                            
                            <?php endwhile ?> 
                            <?php else: ?>
                            <p>No Comments </p> 
                            <?php endif ?>


                            </ul>
                            </tr>
                          </div>
                        </div>
             
                 
             
            <?php endwhile;
             
            ?> 
             

              
      
            </div>
      
</div>          

<?php include "footer.php"?> 
          








<script src="scripts/scripts.js"> </script>
<script src="scripts/maps.js"> </script>
<!-- MAPS -->
<script defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGdmH2Tea-m6ZftvjBaJjIlM6WOzO-CGk&callback=initMap">
</script>
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