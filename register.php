<?php

	require_once("classes/User.class.php");

	if(!empty($_POST)){
		$user= new User();
		$user->setEmail($_POST['email']);
		$user->setPassword($_POST['password']);
		$user->setPasswordConfirmation($_POST['password_confirmation']);
		$result = $user->register();
		var_dump($result);

		//dit onder stond er eerst voor we getters en setters gebruikten

		// $email = $_POST['email'];
    // $password = $_POST['password'];
		// $passwordConfirmation = $_POST['password_confirmation'];
		
		// @todo: form validation
		// $options = [
		// 	'cost' => 12 //2^12
		// ];
		// $password = password_hash($password,PASSWORD_DEFAULT);
		
		// try{
		// 	//alles wat je wil proberen
		// 	//$conn = new PDO("mysql:host=localhost;dbname=netflix","root","root",null); indien hij een 4e vraagt
		// 	$conn = new PDO("mysql:host=localhost;dbname=netflix","root","root");
		// 	$statement = $conn->prepare("INSERT into users(email,password) VALUES (:email,:password)");
		// 	$statement->bindParam(":email",$email);
		// 	$statement->bindParam(":password",$password);
		// 	$result = $statement->execute();
		// 	echo $result;
		// }catch(Throwable $t){
		// 	/* wanneer het niet werkt
		// 		---
		// 		var_dump($t);
		// 		---
		// 		mogelijk dat je nog extenties nodig hebt
		// 	*/
		// 	//error printen
		// 	echo "er liep iets mis";
		// } 
	}

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>IMDFlix</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="netflixLogin netflixLogin--register">
		<div class="form form--login">
			<form action="" method="post">
				<h2 form__title>Sign up for an account</h2>

				<div class="form__error hidden">
					<p>
						Some error here
					</p>
				</div>

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
	</div>
</body>
</html>