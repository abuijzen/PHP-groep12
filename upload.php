<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Image</title>
</head>
<body>
    <div id="content">
        <form method="post" action ="upload.php">
            <input type="hidden" name="size" value="100000">
            <div>
                <input type="file" name="image">
            </div>
            <div>
                <textarea name="description" cols="40" rows="4" placeholder="Wat wil je zeggen over deze foto?"><textarea>
            </div>
            <div>
                <input type="submit" name="upload" value = "uploaden">
            </div>
</form>
    

<style>
#content{
    width: 50%;
    margin 20px auto;
    border 1px solid #cbcbcb;
}

form{
    width:50%;
    margin:20px auto;

}

form div{
    margin-top:5px;
}

</style>




</body>
</html>