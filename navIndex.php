<nav class="navbar navbar-inverse sticky-top navbar-expand-lg bg-primary" role="navigation-demo">
            <div class="container">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-translate">
              <a class="navbar-brand" href="index.php" > 

<img src="images/logo.png" class="img-fluid" alt="">

              </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="navbar-toggler-icon"></span>
                  <span class="navbar-toggler-icon"></span>
                  <span class="navbar-toggler-icon"></span>
                </button>
              </div>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                  <a href="upload.php" class="nav-link btn btn-secondary">Upload Image</a>
                
                  </li>

            
                <form class="form-inline ml-auto" name='form-search' method='get' action="index.php" id="form-search">
                <div class="form-group no-border">
                    <input type="text" class="form-control" id="search" name="search" value="" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-white btn-just-icon btn-round">
                    <i class="material-icons">search</i>
                </button>
                </form>
                
               
              

          









                  <li class="dropdown nav-item">
                    <a href="profile.php" class="profile-photo dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false">
                      <div class="profile-photo-small">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-pwYeeDYQynA0QJPSb7AUsAigb5bAw0zM1PF-x6SZI4xq4h9V" alt="Circle Image" class="rounded-circle img-fluid">
                      </div>
                    <div class="ripple-container"></div></a>
                    <div class="dropdown-menu dropdown-menu-right">
                

                      <h6 class="dropdown-header">Name</h6>
                     
                      <a href="profile.php?user=<?php echo $_SESSION['user_id']; ?>" class="dropdown-item">Profile</a>
                      <a href="editProfile.php?user=<?php echo $_SESSION['user_id']; ?>" class="dropdown-item">Edit Profile</a>
                      <a href="logout.php" class="dropdown-item">Log Out</a>
                    </div>
                  </li>
                </ul>
              </div>
              <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-->
          </nav>
          <!--   Core JS Files   -->
  <script src="js/core/jquery.min.js" type="text/javascript"></script>
  <script src="js/core/popper.min.js" type="text/javascript"></script>
  <script src="js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="js/plugins/moment.min.js"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="js/material-kit.js?v=2.0.5" type="text/javascript"></script>



          



          
