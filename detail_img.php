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

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>full view</title>
    <link rel="stylesheet" href="https://cssgram-cssgram.netdna-ssl.com/cssgram.min.css">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
    />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="css/material-kit.css?v=2.0.5" rel="stylesheet" />
  </head>

  <body>

    <?php include_once 'nav.php'; ?>

    <div class="card mb-3">

      <img src="images/<?php echo $selectId[0]['image']; ?>" alt="" height="auto" class=" card-img-top <?php echo $selectId[0]['filter']; ?>">
      </a>
      <div class="card-body">
        <div class="blockquote">
      <p class="mb-0">
        <?php echo $selectId[0]['message']; ?>
      </p>
      </div>

      <div>
        <a href="index.php?color=<?php echo $selectId[0]['color1']; ?>" style="background-color:<?php echo '#'.$selectId[0]['color1']; ?>" class="color"></a>
        <a href="index.php?color=<?php echo $selectId[0]['color2']; ?>" style="background-color:<?php echo '#'.$selectId[0]['color2']; ?>" class="color"></a>
        <a href="index.php?color=<?php echo $selectId[0]['color3']; ?>" style="background-color:<?php echo '#'.$selectId[0]['color3']; ?>" class="color"></a>
        <a href="index.php?color=<?php echo $selectId[0]['color4']; ?>" style="background-color:<?php echo '#'.$selectId[0]['color4']; ?>" class="color"></a>
      </div>

      <input type="text" class="form-control" rows="2" placeholder="Add a comment..." id="comment" name="comment" />
      <input id="btnSubmit" class="btn-primary btn" type="submit" value="Add comment" data-id="<?php echo $id; ?>" />

      <ul id="listupdates">
        <?php foreach ($comments as $comment): ?>
        <li>
          <?php echo $comment['text']; ?>
        </li>
        <?php endforeach; ?>
      </ul>
      </div>

    </div>

    <style>
    .color{
      width: 40px;
      height: 40px;
      display: inline-block;
    }
    </style>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
    <script src="js/comment.js"></script>

  </body>

  </html>