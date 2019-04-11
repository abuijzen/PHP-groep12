<!DOCTYPE html>
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
     
<div class="form form--login">
            <form action="" method="post">
                <h2 form__title>Sign In</h2>
 
                <div class="form__field">
                    <label for="Email" >Email</label>
                    <input type="text" name="Email" id="Email">
                </div>
                <div class="form__field">
                    <label for="Password">Password</label>
                    <input type="password" id="Password" name="Password">
                </div>

                <div class="form__field">
                    <input type="submit" value="Sign in" class="btn btn--primary"> 
                </div>      
            </form>
        </div>
   
</body>
</html>
