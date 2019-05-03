<?php
require_once 'bootstrap.php';
if (!empty($_POST)) {
    //email en password opvragen
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (User::canLogin($email, $password)) {
        $_SESSION['email'] = $email;
        User::doLogin($email);
    } else {
        $error = true;
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inspiration Hunter</title>
</head>
<body>
    
<h1>Inspiration Hunter</h1>
     
<div class="form">
            <form action="" method="post">
                <h2 form__title>Sign In</h2>

                <?php if (isset($error)): ?>
				<div class="form__error">
					<p>
						Sorry, we can't log you in with that email address and password. Can you try again?
					</p>
				</div>
                <?php endif; ?>
                
                <div class="form__field">
                    <label for="email" >Email</label>
                    <input type="text" name="email" id="email">
                </div>
                <div class="form__field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>

                <div class="form__field">
                    <input type="submit" value="Sign in" class="btn"> 
                </div>      
            </form>

            <a href="register.php">Not an account yet? Sign up here!</a>
        </div>
   
</body>
</html>