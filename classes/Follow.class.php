<?php

    class Follow
    {
        private $users_id;
        private $follow_id;

        /**
         * Get the value of users_id.
         */
        public function getUsers_id()
        {
            return $this->users_id;
        }

        /**
         * Set the value of users_id.
         *
         * @return self
         */
        public function setUsers_id($users_id)
        {
            $this->users_id = $users_id;

            return $this;
        }

        /**
         * Get the value of follow_id.
         */
        public function getFollow_id()
        {
            return $this->follow_id;
        }

        /**
         * Set the value of follow_id.
         *
         * @return self
         */
        public function setFollow_id($follow_id)
        {
            $this->follow_id = $follow_id;

            return $this;
        }

        public function checkFollowing()
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('SELECT count(*) as count FROM followers WHERE user_id = :users_id AND follow_id = :follow_id');
            $statement->bindParam(':follow_id', $this->follow_id);
            $statement->bindParam(':users_id', $this->users_id);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] == 0) {
                return true;
            }

            return false;
        }

        public function AddFollow()
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('INSERT into followers (user_id, follow_id) values (:users_id, :follow_id)');
            $statement->bindParam(':follow_id', $this->follow_id);
            $statement->bindParam(':users_id', $this->users_id);
            $result = $statement->execute();

            return $result;
        }

        public function DeleteFollow()
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('DELETE FROM followers WHERE user_id = :users_id AND follow_id = :follow_id');
            $statement->bindParam(':follow_id', $this->follow_id);
            $statement->bindParam(':users_id', $this->users_id);
            $result = $statement->execute();

            return $result;
        }

        public static function getFollowers($follow_id)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('SELECT count(*) as count FROM followers WHERE user_id = :users_id AND follow_id = :follow_id');
            $statement->bindParam(':follow_id', follow_id);
            $statement->bindParam(':users_id', users_id);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] == 0) {
                return 'Follow';
            }

            return 'Following';
        }
    }
