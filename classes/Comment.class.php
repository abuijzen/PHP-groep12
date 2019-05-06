<?php

class Comment
{
    private $text;

    public static function getAll($postsId)
    {
       
        $conn = Db::getInstance();
        $statement = $conn->prepare('select * from comments where postsId = :postsId order by id asc');
        $statement->bindParam(':postsId', $postsId);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Save()
    {
        $usersId = User::getUserId();

        $conn = Db::getInstance();
        $statement = $conn->prepare('INSERT INTO comments(postsId, usersId, text) VALUES (:postsId, :usersId, :text)');
        $statement->bindValue(':postsId', 7);
        $statement->bindValue(':usersId', $usersId);
        $statement->bindValue(':text', $this->getText());
        $statement->execute();
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
}
