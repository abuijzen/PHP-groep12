<?php

    require_once 'bootstrap.php';

    if (!empty($_POST)) {
        try {
            $security = new Security();
            $security->password = $_POST['password'];
            $security->passwordConfirmation = $_POST['password_confirmation'];

            if ($security->passwordsAreSecure()) {
                $user = new User();
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $user->setPasswordConfirmation($_POST['password_confirmation']);
                $result = $user->register();
                header('Location:index.php');
            } else {
                $error = 'Your passwords are not secure or do not match.';
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Inspiration Hunter</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
    />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="css/material-kit.css?v=2.0.5" rel="stylesheet" />
  </head>

  <body>
   





    <div class="page-header header-filter" style="background-image: url('https://images.unsplash.com/photo-1535375743084-67f559ec192f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1500&q=80'); background-size: cover; background-position: top center;">
      <div class="container">


        <div class="row">
          <div class="col-lg-4 col-md-6 ml-auto mr-auto">
            <div class="card card-login">
              <form class="form" action="" method="post">



                <div class="card-header card-header-primary text-center">
                  <h2 class="card-title">Eurben</h2>

                  <h4 class="card-title">Register</h4>

                </div>
                <p class="description text-center">Enter your info below</p>
                <div class="card-body">
                  <div class="input-group ">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">
                          person
                        </i>
                      </span>
                    </div>
                    <input type="text" class="form-control" placeholder="First name...">
                  </div>


                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">
                          people
                        </i>
                      </span>
                    </div>
                    <input type="text" class="form-control" placeholder="Last name...">
                  </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">mail</i>
                      </span>
                    </div>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email...">
                  </div>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">
                          https
                        </i>
                      </span>
                    </div>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password...">
                  </div>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">
                          https
                        </i>
                      </span>
                    </div>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password...">
                  </div>
                </div>
                <div class="footer text-center">

                  <input type="submit" value="Sign in" class="btn btn-primary">
                  <?php if (isset($error)): ?>
                  <div class="form__error">
                    <p>
                      Sorry, we can't log you in with that email address and password. Can you try again?
                    </p>
                  </div>
                  <?php endif; ?>


                </div>


              </form>

            </div>
            <a href="register.php">Not an account yet? Sign up here!</a>
          </div>

        </div>
      </div>





  </body>

  </html>