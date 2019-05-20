<?php

require __DIR__.'/../'.'vendor/autoload.php';

use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;

class Post
{
    private $id;
    protected $image;
    protected $text;
    protected $userId;
    protected $filter;

    /**
     * Get the value of id.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id.
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of image.
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image.
     *
     * @return self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of text.
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text.
     *
     * @return self
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the value of userId.
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId.
     *
     * @return self
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of filter.
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * Set the value of filter.
     *
     * @return self
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;

        return $this;
    }

    public function getChosenFilter()
    {
        if (!empty($_GET['filter'])) {
            $filter = $_GET['filter'];
        } else {
            $filter = '';
        }

        return $filter;
    }

    public function uploadPosts()
    {
        $usersId = User::getUserId();
        $conn = Db::getInstance();
        $filter = $this->getChosenFilter();
        $insert = $conn->prepare('INSERT INTO posts(image,filter,message,usersId) VALUES (:image,:filter,:text,:usersId)');
        $insert->bindParam(':image', $this->getImage);
        $insert->bindParam(':text', $this->getText);
        $insert->bindParam(':filter', $this->getfilter);
        $insert->bindParam(':usersId', $usersId);
        try {
            if (!$insert->execute(array(':image' => $this->image, ':text' => $this->text, ':filter' => $this->filter, ':usersId' => $usersId))) {
                die('Unknown ERROR!');
            }
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function checkIfSearchIsEmpty()
    {
        if (!empty($_GET['search'])) {
            $innerhtml = $_GET['search'];
        } else {
            $innerhtml = '';
        }

        return $innerhtml;
    }

    //alle resultaten tellen
    public function countAll()
    {
        $conn = Db::getInstance();
        $innerhtml = $this->checkIfSearchIsEmpty();
        $allResults = $conn->prepare('SELECT*FROM posts WHERE visibility = 1 AND message LIKE :innerhtml ORDER BY id DESC');
        $allResults->bindValue(':innerhtml', '%'.$innerhtml.'%');
        $allResults->execute();
        $countAll = $allResults->rowCount();

        return $countAll;
    }

    public function selectSearchAndLimit()
    {
        $conn = Db::getInstance();
        $innerhtml = $this->checkIfSearchIsEmpty();
        // $result = $conn->prepare("SELECT*FROM posts JOIN users on users.id = posts.usersId WHERE posts.visibility = 1 AND posts.message LIKE '%$innerhtml%' ORDER BY posts.id DESC  limit 20");
        $result = $conn->prepare("SELECT posts.id as post_id, users.id as user_id, posts.visibility, posts.message, posts.image, posts.filter, posts.`color1`, posts.`color2`, posts.`color3`, posts.`color4`, users.`firstname`, users.`lastname`, users.`email`, posts.timePost FROM posts JOIN users on users.id = posts.usersId WHERE posts.visibility = 1 AND posts.message LIKE '%$innerhtml%' ORDER BY posts.id DESC  limit 20");
        $result->execute();

        return $result;
    }

    //zichtbare resultaten tellen (voorbereiding load-more feature)
    public function countViewable()
    {
        $result = $this->selectSearchAndLimit();
        $collection = $result->fetchAll();
        $count = $result->rowCount();

        return $count;
    }

    public function showResults()
    {
        $result = $this->selectSearchAndLimit();
        $collection = $result->fetchAll();

        return $collection;
    }

    public function noResult()
    {
        if ($this->countAll() == 0) {
            $nothing = 'No results';

            return $nothing;
        }
    }

    public function addReport()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('INSERT into reports (post_Id, user_Id) values (:postsId, :usersId)');
        $statement->bindParam(':postsId', $this->id);
        $statement->bindParam(':usersId', $this->userId);
        $result = $statement->execute();

        return $result;
    }

    public function setInactive()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('UPDATE posts SET visibility = 0 WHERE id = :postsId');
        $statement->bindParam(':postsId', $this->id);
        $result = $statement->execute();

        return $result;
    }

    // public function checkReports()
    // {
    //     $conn = db::getInstance();
    //     $statement = $conn->prepare('SELECT * from reports where postsId = :postsId');
    //     $statement->bindParam(':postsId', $this->id);
    //     $statement->execute();
    //     $result = $statement->fetch(PDO::FETCH_ASSOC);

    //     $count = $statement->rowCount();
    //     if ($this->alreadyReport()) {
    //         // echo 'test van functie';
    //         if ($count == 0) {
    //             return true;
    //             if ($count >= 2) {
    //                 return false;
    //             }
    //         }
    //     } else {
    //         return false;
    //     }
    // }

    public function checkReports()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('SELECT count(*) as count from reports where post_Id = :postsId');
        $statement->bindParam(':postsId', $this->id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] == 3) {
            $this->setInactive();
        }
    }

    public function alreadyReport()
    {
        try {
            $conn = Db::getInstance();
            $statement = $conn->prepare('SELECT count(*) as count from reports where user_Id = :usersId AND post_Id = :postsId');
            $statement->bindParam(':postsId', $this->id);
            $statement->bindParam(':usersId', $this->userId);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] == 0) {
                return true;
            }

            return false;
        } catch (Throwable $t) {
            echo $t;
        }
    }

    public static function detectColors($image)
    {
        $imageName = basename($image);
        $conn = Db::getInstance();
        $palette = Palette::fromFilename('images/'.$imageName);
        $extractor = new ColorExtractor($palette);
        $colors = $extractor->extract(4);
        $color1 = ltrim(Color::fromIntToHex($colors[0]), '#');
        $color2 = ltrim(Color::fromIntToHex($colors[1]), '#');
        $color3 = ltrim(Color::fromIntToHex($colors[2]), '#');
        $color4 = ltrim(Color::fromIntToHex($colors[3]), '#');
        $statement = $conn->prepare('UPDATE posts set color1 = :color1, color2 = :color2, color3 = :color3, color4 = :color4 where image = :image');
        $statement->bindParam(':color1', $color1);
        $statement->bindParam(':color2', $color2);
        $statement->bindParam(':color3', $color3);
        $statement->bindParam(':color4', $color4);
        $statement->bindParam(':image', $imageName);
        $statement->execute();
    }

    public static function getImagesWithSameColors($color)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('SELECT posts.*, users.firstname, users.lastname, posts.id as post_id FROM posts INNER JOIN users on posts.usersId = users.id where posts.color1 = :color or posts.color2 = :color or posts.color3 = :color or posts.color4 = :color order by posts.id desc LIMIT 20');
        $statement->bindParam(':color', $color);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getSelectedImage($id)
    {
        $conn = Db::getInstance();
        $selectId = $conn->prepare("SELECT * FROM posts JOIN users on users.id=posts.usersId WHERE posts.id='$id'");
        $selectId->execute();
        $selectId = $selectId->fetchAll();

        return $selectId;
    }

    public static function getRelatedPosts($id)
    {
        $selectId = self::getSelectedImage($id);
        $conn = Db::getInstance();
        $usersId = $selectId[0]['usersId'];
        $fromUser = $conn->prepare("SELECT * FROM users JOIN posts on posts.usersId=users.id WHERE posts.usersId='$usersId' AND posts.id != '$id' LIMIT 9");
        $fromUser->execute();
        $fromUser = $fromUser->fetchAll();

        return $fromUser;
    }

    public static function countRelatedPosts($id)
    {
        $fromUser = self::getRelatedPosts($id);
        $countResults = $fromUser->rowCount();

        return $countResults;
    }

    //geef de postid van de post met de meeste likes
    public static function countLikes()
    {
        $conn = Db::getInstance();
        $mostLikes = $conn->prepare('SELECT likes.postsId, COUNT(*)FROM likes GROUP BY likes.postsId ORDER BY COUNT(*) DESC LIMIT 1');
        $mostLikes->execute();
        $mostLikes = $mostLikes->fetchAll(PDO::FETCH_COLUMN);
        $mostLikes = $mostLikes[0];

        return $mostLikes;
    }

    //zoekt post op basis van de gegeven id
    public static function getNowTrending($mostLikes)
    {
        $conn = Db::getInstance();
        $mostLikesPost = $conn->prepare("SELECT * FROM posts 
        JOIN users on posts.usersId = users.id 
        WHERE posts.id='$mostLikes'");
        $mostLikesPost->execute();
        $mostLikesPost = $mostLikesPost->fetchAll();

        return $mostLikesPost;
    }
}
