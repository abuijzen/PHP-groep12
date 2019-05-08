<?php

class PostLike
{
    public static function getAll()
    {
        $conn = Db::getInstance();
        $result = $conn->query('select * from posts ');

        // fetch all records from the database and return them as objects of this __CLASS__ (Post)
        return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    public function getLikes()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('select count(*) as count from likes where postsId = :postid AND user_id=:usersId');
        $statement->bindValue(':postid', $this->id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['count'];
    }
}
