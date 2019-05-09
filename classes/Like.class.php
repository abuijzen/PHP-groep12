<?php
    class Like
    {
        private $postId;
        private $userId;

        /**
         * Get the value of postId.
         */
        public function getPostId()
        {
            return $this->postId;
        }

        /**
         * Set the value of postId.
         *
         * @return self
         */
        public function setPostId($postId)
        {
            $this->postId = $postId;

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

        // public static function getAll()
        // {
        //     $conn = Db::getInstance();
        //     $result = $conn->query('select * from posts ');

        //     // fetch all records from the database and return them as objects of this __CLASS__ (Post)
        //     return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
        // }

        // public function getLikes($postsId)
        // {
        //     $conn = Db::getInstance();
        //     $statement = $conn->prepare('select count(*) as count from likes where postsId = :postsId AND usersId=:usersId');
        //     $statement->bindValue(':postsId', $postsId);
        //     $statement->execute();
        //     $result = $statement->fetch(PDO::FETCH_ASSOC);

        //     return $result['count'];
        // }

        public function saveLike($postsId, $usersId)
        {
            // @todo: hook in a new function that checks if a user has already liked a post

            $conn = Db::getInstance();
            $statement = $conn->prepare('insert into likes (postsId, usersId) values (:postid, :userid');
            $statement->bindParam(':postid', $postsId);
            $statement->bindParam(':userid', $usersId);

            $statement->execute();
        }

        // private function Addlike()
        // {
        //     $conn = db::getInstance();
        //     $query = 'insert into likes (post_id, user_id) values
        //     (:post_id, :user_id)';
        //     $statement = $conn->prepare($query);
        //     $statement->bindValue(':post_id', $this->getPostId());
        //     $statement->bindValue(':user_id', $this->getUserId());
        //     $statement->execute();
        // }

        // private function Deletelike()
        // {
        //     $conn = db::getInstance();
        //     $query = 'DELETE FROM likes WHERE post_id = :post_id
        //     AND user_id =:user_id';
        //     $statement = $conn->prepare($query);
        //     $statement->bindValue(':post_id', $this->getPostId());
        //     $statement->bindValue(':user_id', $this->getUserId());
        //     $statement->execute();
        // }

        // public function CheckLike()
        // {
        //     $conn = db::getInstance();
        //     $query = 'SELECT COUNT(*) FROM likes WHERE
        //     post_id=:post_id AND user_id=:user_id';
        //     $statement = $conn->prepare($query);
        //     $statement->bindValue(':post_id', $this->getPostId());
        //     $statement->bindValue(':user_id', $this->getUserId());
        //     $statement->execute();
        //     $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //     if ($result['COUNT(*)'] == 0) {
        //         $this->Addlike();
        //     } else {
        //         $this->Deletelike();
        //     }

        //     return $result;
        // }
    }
