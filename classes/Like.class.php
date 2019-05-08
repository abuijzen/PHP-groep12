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

        public function save()
        {
            // @todo: hook in a new function that checks if a user has already liked a post

            $conn = Db::getInstance();
            $statement = $conn->prepare('insert into likes (post_id, user_id, date_created) values (:postid, :userid, NOW())');
            $statement->bindValue(':postid', $this->getPostId());
            $statement->bindValue(':userid', $this->getUserId());

            return $statement->execute();
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
