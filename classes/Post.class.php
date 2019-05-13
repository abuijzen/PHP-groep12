<?php
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
            $allResults = $conn->prepare("SELECT*FROM posts WHERE visibility = 1 AND message LIKE '%$innerhtml%' ORDER BY id DESC");
            $allResults->execute();
            $countAll = $allResults->rowCount();

            return $countAll;
        }

        public function selectSearchAndLimit()
        {
            $conn = Db::getInstance();
            $innerhtml = $this->checkIfSearchIsEmpty();
            $result = $conn->prepare("SELECT*FROM posts WHERE visibility = 1 AND message LIKE '%$innerhtml%' ORDER BY id DESC  limit 20");
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

        public function addReport()
        {
            $users_Id = User::getUserId();
            $conn = db::getInstance();
            $statement = $conn->prepare('INSERT into reports (post_Id, user_Id) values (:postsId, :usersId)');
            $statement->bindParam(':postsId', $this->id);
            $statement->bindParam(':usersId', $users_Id);

            $statement->execute();
        }

        public function setInactive()
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('UPDATE posts SET visibility = 0 WHERE id = :postsId');
            $statement->bindParam(':postsId', $this->id);

            $statement->execute();
        }

        public function checkReports()
        {
            $conn = db::getInstance();
            $statement = $conn->prepare('SELECT * from reports where postsId = :postsId');
            $statement->bindParam(':postsId', $this->id);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $count = $statement->rowCount();
            if (Post::alreadyReport() == 'true') {
                if ($count == 0) {
                    return true;
                } elseif ($count >= 2) {
                    return 'delete';
                }
            } elseif (Post::alreadyReport() == 'false') {
                return 'er is iets fout';
            }
        }

        public static function alreadyReport()
        {
            $conn = db::getInstance();
            $statement = $conn->prepare('SELECT count(*) as count from reports where usersId = :usersId AND postsId = :postsId');
            $statement->bindParam(':postsId', $id);
            $statement->bindParam(':usersId', $userId);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] == 0) {
                return 'true';
            }

            return 'false';
        }
    }
