<?php

require_once 'bootstrap.php';

//zonder sessie niet naar index gaan.

if ($_GET["user"] == $_SESSION['user_id']) {
  $profile = User::loadProfile($_SESSION['user_id']);
  $edit = 1;
}
else {
  $profile = User::loadProfile($_GET["user"]);
}

if ($_GET["user"] == $_SESSION['user_id']) {
  $profile = User::loadProfile($_SESSION['user_id']);
  $edit = 1;
}
else {
  $profile = User::loadProfile($_GET["user"]);
}if(!empty($_POST['email'])) {
  User::updateEmail($_SESSION['user_id'], $_POST['email']);
}

if(!empty($_POST['profileText'])) {
  User::updateProfileText($_SESSION['user_id'], $_POST['profileText']);
}

if(!empty($_POST['oldpass']) && !empty($_POST['newpass']) && !empty($_POST['confpass'])) {
                try {
                    $security = new Security();
                    $security->password = $_POST['newpass'];
                    $security->passwordRepeat = $_POST['confpass'];
               
                    if ($security->passwordsAreSecure()) {

                      updatePassword($_SESSION['user_id'], $_POST['newpass']);

                      
                        
                    }
                }
                catch (Exception $e){
                              
                }
                
            }







?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Inspiration Hunter</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
    />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="css/material-kit.css?v=2.0.5" rel="stylesheet" />
  </head>

  <?php include_once 'nav.php'; ?>

  <body class="profile-page sidebar-collapse">

    <div class="page-header"></div>
    <div class="main main-raised">
      <div class="profile-content">
        <div class="container">
          <div class="row">
            <div class="col-md-6 ml-auto mr-auto">

              <div class="profile">
                <div class="avatar">



                </div>
                <input type="file" name="image" ">
                <input type="submit " value="Save avatar " name="submit " class="btn btn-primary "  style="margin-bottom:20px;>


              </div>
            </div>
          </div>
          <div class="description text-center">

            <?php if (isset($edit)): ?>
            <div class="profile__user--btns">

            </div>
            <?php else: ?>
            <div class="btn <?php echo $btnClass; ?>" data-post="<?php echo  htmlspecialchars($_GET[" user "]); ?>">
              <?php echo $btnText; ?>
            </div>
            <?php endif; ?>


            <form method="post">


              <div class="form-group">
                <label for="desc">Change description</label>
                <input type="text" class="form-control" id="profileText" name="profileText" placeholder="Enter description">

              </div>
              <div class="form-group">
                <label for="email">Change email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">

              </div>
              <div class="form-group">
                <label for="oldpass">Old password</label>
                <input type="password" class="form-control" id="oldpass" name="oldpass" placeholder="Old password">
              </div>
              <div class="form-group">
                <label for="newpass">New password</label>
                <input type="password" class="form-control" id="newpass" name="newpass" placeholder="New password">
              </div>
              <div class="form-group">
                <label for="confpass">Confirm password</label>
                <input type="password" class="form-control" id="confpass" name="confpass" placeholder="Confirm password">
              </div>

              <button type="submit" class="btn btn-primary">Submit</button>
            </form>







          </div>




        </div>






        










      </div>
    </div>
    </div>


  </body>

  </html>