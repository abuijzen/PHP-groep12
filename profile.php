<?php

require_once 'bootstrap.php';

//zonder sessie niet naar index gaan.

if ($_GET['user'] == $_SESSION['user_id']) {
    $profile = User::loadProfile($_SESSION['user_id']);
    $edit = 1;
} else {
    $profile = User::loadProfile($_GET['user']);
}

if ($_GET['user'] == $_SESSION['user_id']) {
    $profile = User::loadProfile($_SESSION['user_id']);
    $edit = 1;
} else {
    $profile = User::loadProfile($_GET['user']);
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
                  <img src="<?php

                  if ($profile['avatar_url']) {
                      $avatar = $profile['avatar_url'];
                      echo "$avatar";
                  } else {
                        echo ' ./avatars/avatar.jpg ';
                    }  ?>" alt="Circle Image"
                    class="img-raised rounded-circle img-fluid">
                </div>
                <div class="name">
                  <h3 class="title">
                    <?php echo htmlspecialchars($profile['firstname']).'<br>'.htmlspecialchars($profile['email']); ?>
                  </h3>




                </div>
              </div>
            </div>
          </div>
          <div class="description text-center">
            <p>
              <?php if ($profile['profileText']) {
                        echo htmlspecialchars($profile['profileText']);
                    } else {
                        echo 'Nog geen beschrijving toegevoegd...';
                    }                ?>
            </p>
            <?php if (isset($edit)): ?>
                    
                        <a class="btn btn-warning" href="editProfile.php?user=<?php echo $_SESSION['user_id']; ?>">Edit Profile</a>
                        <a class="btn btn-danger" href="logout.php">Log out</a>
                    
                <?php else: ?>
                   
                <?php endif; ?>





         
          
          </div>

          









        </div>
      </div>
    </div>


  </body>

  </html>