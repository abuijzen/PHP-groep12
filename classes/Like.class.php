<?php
    class Like
    {
        private $postsId;
        private $usersId;

        /**
         * Get the value of postId.
         */
        public function getPostsId()
        {
            return $this->postsId;
        }

        /**
         * Set the value of postId.
         *
         * @return self
         */
        public function setPostsId($postsId)
        {
            $this->postsId = $postsId;

            return $this;
        }

        /**
         * Get the value of userId.
         */
        public function getUsersId()
        {
            return $this->usersId;
        }

        /**
         * Set the value of userId.
         *
         * @return self
         */
        public function setUsersId($usersId)
        {
            $this->usersId = $usersId;

            return $this;
        }

        public function Addlike()
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('INSERT into likes (usersId, postsId, date) values (:userid, :postid, NOW())');
            $statement->bindParam(':postid', $this->postsId);
            $statement->bindParam(':userid', $this->usersId);
            $result = $statement->execute();

            return $result;
        }

        public function Deletelike()
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('DELETE FROM likes WHERE postsId = :postId AND usersId = :userId');
            $statement->bindValue(':postId', $this->postsId);
            $statement->bindValue(':userId', $this->usersId);
            $result = $statement->execute();

            return $result;
        }

        public function CheckLike()
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('SELECT count(*) as count from likes where usersId = :userId AND postsId = :postsId');
            $statement->bindParam(':postsId', $this->postsId);
            $statement->bindParam(':userId', $this->usersId);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] == 0) {
                return true;
            }

            return false;
        }

        public static function getLikes($postsId)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('SELECT count(*) as count from likes where postsId = :postsId');
            $statement->bindParam(':postsId', $postsId);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result['count'];
        }
    }
