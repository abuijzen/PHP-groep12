<?php

    require_once("classes/User.class.php");
    require_once("classes/Security.class.php");
    
    if( !empty($_POST) ){
        try
        {
            $security = new Security();
            $security->password = $_POST['password'];
            $security->passwordConfirmation = $_POST['password_confirmation'];

            if( $security->passwordsAreSecure() ){
                $user = new User();        
                $user->setEmail( $_POST['email'] );
                $user->setPassword( $_POST['password'] );
                $user->setPasswordConfirmation($_POST['password_confirmation']);
				$result = $user->register();
		        var_dump($result);
			}
			else {
				$error = "Your passwords are not secure or do not match.";
			}
        }
        catch(Exception $e) {
			$error = $e->getMessage();
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Inspiration Hunter</title>
  <!-- <link rel="stylesheet" href="css/style.css"> -->
</head>
<body>
		<div class="form">
			<form action="" method="post">
				<h2 form__title>Sign up for an account</h2>

                <?php if(isset($error)): ?>
				<div class="form__error">
					<p>
						💩 <?php echo $error; ?>
					</p>
				</div>
                <?php endif; ?>

				<div class="form__field">
					<label for="email">Email</label>
					<input type="text" id="email" name="email">
				</div>
				<div class="form__field">
					<label for="password">Password</label>
					<input type="password" id="password" name="password">
				</div>

                <div class="form__field">
					<label for="password_confirmation">Confirm your password</label>
					<input type="password" id="password_confirmation" name="password_confirmation">
				</div>

				<div class="form__field">
					<input type="submit" value="Sign me up!" class="btn btn--primary">	
				</div>
			</form>
		</div>
</body>
</html>