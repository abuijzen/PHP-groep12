<?php

class LikePost
{
    public static function getAll($postsId)
    {
        $conn = Db::getInstance();
        $result = $conn->query('select * from posts ');

        // fetch all records from the database and return them as objects of this __CLASS__ (Post)
        return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    public static function getLikes($postsId)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('select count(*) as count from likes where postsId = :postsId');
        $statement->bindParam(':postsId', $postsId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['count'];
    }
}
