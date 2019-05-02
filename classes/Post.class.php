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

        //krijg data die gesubmitted is om een nieuwe post te maken

        public function getSubmittedPosts()
        {
            $conn = new PDO('mysql:host=localhost;dbname=eurben', 'root', 'root', null);
            $insert = $conn->prepare('INSERT INTO posts(image,message) VALUES (:image, :text)');
            $insert->bindParam(':image', $this->getImage);
            $insert->bindParam(':text', $this->getText);
            //$insert->bindParam(":time",$this->getTime);
            try {
                if (!$insert->execute(array(':image' => $this->image, ':text' => $this->text))) {
                    die('Unknown ERROR!');
                }
            } catch (PDOException $ex) {
                die($e->getMessage());
            }
        }
    }
