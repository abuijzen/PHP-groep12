<?php
    class Post
    {
        private $id;
        protected $image;
        protected $text;

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

        public function uploadPosts()
        {
            $conn = Db::getInstance();
            $insert = $conn->prepare('INSERT INTO posts(image,message) VALUES (:image, :text)');
            $insert->bindParam(':image', $this->getImage);
            $insert->bindParam(':text', $this->getText);
            //$insert->bindParam(":time",$this->getTime);
            try {
                if (!$insert->execute(array(':image' => $this->image, ':text' => $this->text))) {
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
            $allResults = $conn->prepare("SELECT*FROM posts WHERE message LIKE '%$innerhtml%' ORDER BY id DESC");
            $allResults->execute();
            $countAll = $allResults->rowCount();

            return $countAll;
        }

        public function selectSearchAndLimit()
        {
            $conn = Db::getInstance();
            $innerhtml = $this->checkIfSearchIsEmpty();
            $result = $conn->prepare("SELECT*FROM posts WHERE message LIKE '%$innerhtml%' ORDER BY id DESC  limit 20");
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
            $statement = $conn->prepare('select count(*) as count from likes where post_id = :postid AND user_id=:user_id');
            $statement->bindValue(':postid', $this->id);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result['count'];
        }
    }
