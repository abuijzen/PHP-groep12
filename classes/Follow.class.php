<?php

    class Follow
    {
        private $user_id;
        private $follow_id;

        /**
         * Get the value of user_id.
         */
        public function getUser_id()
        {
            return $this->user_id;
        }

        /**
         * Set the value of user_id.
         *
         * @return self
         */
        public function setUser_id($user_id)
        {
            $this->user_id = $user_id;

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
            $statement = $conn->prepare('SELECT count(*) as count FROM followers WHERE user_id = :user_id AND $follow_id = :follow_id');
            $statement->bindParam(':postsId', $this->user_id);
            $statement->bindParam(':userId', $this->follow_id);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] == 0) {
                return true;
            }

            return false;
        }
    }
