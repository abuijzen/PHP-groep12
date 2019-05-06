<?php

class Comment
{
    private $text;

    public static function getAll()
    {
        $conn = Db::getInstance();
        $result = $conn->query('select * from comments order by id asc');

        return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    public function Save()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('insert into comments (postsId, usersId, text) values (:postsId, :usersId, :text)');
        $statement->bindValue(':postsId', $postsId);
        $statement->bindValue(':usersId', $usersId);
        $statement->bindValue(':text', $this->getText());

        return $statement->execute();
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
