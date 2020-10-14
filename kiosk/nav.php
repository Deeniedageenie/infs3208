<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
                <a class="navbar-brand" href="#current">
                  <img src="images/logo.png" alt="logo" style="width:35px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                  <!-- <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                  </form> -->

                  <?php  if (isset($_SESSION['username'])) : ?>
                
                <a class="btn btn-basic" href="profile_update.php">Welcome <strong><?php echo $_SESSION['username']; ?></strong></a>
                <?php endif ?>

                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item active ">
                      <a class="nav-link btn btn-danger" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    
                    <li class="nav-item ">
                    <li class="nav-item">
                      <a class="nav-link btn" href="your_events.php">Your Events</a>
                    </li>
                
                    </li>
                    <li class="nav-item">
                      <a class="nav-link btn" href="eventcreator.php">Create event</a>
                    </li>
                  </ul>
                  <ul class="form-inline my-2 my-lg-0">
                    <?php 
                    if (isset($_SESSION["email"])) {
                            echo '<a class="btn btn-outline-primary" href="login.php?logout">Sign out</a>';
                            echo '<a class="btn btn-outline-primary" href="profile_update.php">profile</a>';
                        } else {
                            echo '<a class="btn btn-outline-primary" href="login.php">Sign in</a>';
                       }
                    ?>
                  </ul>
                  
                </div>
          </nav>