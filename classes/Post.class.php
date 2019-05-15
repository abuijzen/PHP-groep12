<?php

require 'vendor/autoload.php';

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
        $allResults = $conn->prepare("SELECT*FROM posts WHERE message LIKE '%$innerhtml%' ORDER BY id DESC");
        $allResults->execute();
        $countAll = $allResults->rowCount();

        return $countAll;
    }

    public function selectSearchAndLimit()
    {
        $conn = Db::getInstance();
        $innerhtml = $this->checkIfSearchIsEmpty();
        $result = $conn->prepare("SELECT * FROM posts JOIN users on users.id = posts.usersId WHERE posts.message LIKE '%$innerhtml%' ORDER BY posts.id DESC LIMIT 20");

        //$result = $conn->prepare("SELECT*FROM posts WHERE message LIKE '%$innerhtml%' ORDER BY id DESC  limit 20");
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

    public static function getImagesWithSameColors()
    {
        $color = $_GET['color'];
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT posts.*, users.firstname 
            FROM posts 
            INNER JOIN users on posts.usersId = users.id 
            where posts.color1 like ' % ".$color." % ' 
            or posts.color2 like ' % ".$color." % ' 
            or posts.color3 like ' % ".$color." % ' 
            or posts.color4 like ' % ".$color." % ' 
            order by id 
            desc LIMIT 20");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
