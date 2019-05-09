<?php
require_once 'bootstrap.php';

//zonder sessie niet naar detailpagina gaan.
if (isset($_SESSION['email'])) {
} else {
    header('location:login.php');
}

if (!empty($_GET['id'])) {
    $id = ($_GET['id']);
    $conn = Db::getInstance();
    $selectId = $conn->prepare("SELECT * FROM posts where id='$id'");
    $selectId->execute();
    $selectId = $selectId->fetchAll(PDO::FETCH_ASSOC);
}

if (!empty($_POST)) {
    try {
        $comment = new Comment();
        $comment->setText($_POST['comment']);
        $comment->Save($postsId, $usersId);
    } catch (\Throwable $th) {
        //throw $th;
    }
}

$postsId = $_GET['id'];

//altijd alle laatste activiteiten ophalen
$comments = Comment::getAll($postsId);

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>full view</title>
  <link rel="stylesheet" href="https://cssgram-cssgram.netdna-ssl.com/cssgram.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  
  <?php include_once 'nav.php'; ?>
  
  <img src="images/<?php echo $selectId[0]['image']; ?>" alt="" height="auto" width="50%" style="object-fit: cover" class="<?php echo $selectId[0]['filter']; ?>"></a>
  <p><?php echo $selectId[0]['message']; ?></p>

  <input type="text" placeholder="Add a comment..." id="comment" name="comment" />
  <input id="btnSubmit" type="submit" value="Add comment" data-id="<?php echo $id; ?>"/> 

  <ul id="listupdates">
    <?php foreach ($comments as $comment): ?>
    <li><?php echo $comment['text']; ?></li>
    <?php endforeach; ?>
  </ul>
  

<style>

p{
  font-family:sans-serif;
  font-weight:100;
  margin-left:40px;
}
img{
  margin:40px 0px 0px 40px;
  
}
</style>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="js/comment.js"></script>

</body>
</html>
