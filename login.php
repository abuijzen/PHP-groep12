<?php
if(!empty($_POST)){
	//email en password opvragen
	$email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($_POST["password"],PASSWORD_DEFAULT);

    //db connectie
    $conn = new PDO('mysql:host=localhost;dbname=netflix;', "root", "root", null);

    //email zoeken in db
    $statement = $conn->prepare("select * from users where email = :email");
	$statement->bindParam(":email", $email);
    $result = $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    //passwoord en email komen overeen?
    if(password_verify($password,$hashed_password)){
        //ja -> naar index 
		echo "joepie de poepie!!!!";
		//session_start();
		//$_SESSION['userid'] = $user['id'];

		//header('location: index.php');
	} else{
		//nee -> error
        echo "jammer joh";
        //$error = true;
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
    <?php include_once("nav.php"); ?>
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
        </div>
   
</body>
</html>