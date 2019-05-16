<?php
    class User
    {
        private $firstname;
        private $lastname;
        private $email;
        private $password;
        private $passwordConfirmation;

        /**
         * Get the value of firstname.
         */
        public function getFirstname()
        {
            return $this->firstname;
        }

        /**
         * Set the value of firstname.
         *
         * @return self
         */
        public function setFirstname($firstname)
        {
            $this->firstname = $firstname;

            return $this;
        }

        /**
         * Get the value of lastname.
         */
        public function getLastname()
        {
            return $this->lastname;
        }

        /**
         * Set the value of lastname.
         *
         * @return self
         */
        public function setLastname($lastname)
        {
            $this->lastname = $lastname;

            return $this;
        }

        /**
         * Get the value of email.
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * Set the value of email.
         *
         * @return self
         */
        public function setEmail($email)
        {
            $this->email = $email;

            return $this;
        }

        /**
         * Get the value of password.
         */
        public function getPassword()
        {
            return $this->password;
        }

        /**
         * Set the value of password.
         *
         * @return self
         */
        public function setPassword($password)
        {
            $this->password = $password;

            return $this;
        }

        /**
         * Get the value of passwordConfirmation.
         */
        public function getPasswordConfirmation()
        {
            return $this->passwordConfirmation;
        }

        /**
         * Set the value of passwordConfirmation.
         *
         * @return self
         */
        public function setPasswordConfirmation($passwordConfirmation)
        {
            $this->passwordConfirmation = $passwordConfirmation;

            return $this;
        }

        //@todo: form validation
        public function register()
        {
            $options = [
                        'cost' => 12, //2^14
                ];
            $password = password_hash($this->password, PASSWORD_DEFAULT, $options);

            try {
                //alles wat je wil proberen
                //$conn = new PDO("mysql:host=localhost;dbname=netflix","root","root",null); indien hij een 4e vraagt
                $conn = Db::getInstance();
                $statement = $conn->prepare('INSERT into users(firstname,lastname,email,password) VALUES (:firstName, :lastName ,:email,:password)');
                $statement->bindParam(':firstName', $this->firstname);
                $statement->bindParam(':lastName', $this->lastname);
                $statement->bindParam(':email', $this->email);
                $statement->bindParam(':password', $password);
                $result = $statement->execute();

                return $result;
            } catch (Throwable $t) {
                return false;
                echo 'het is niet gelukt';
            }
        }

        public static function canLogin($email, $password)
        {
            //db connectie
            $conn = Db::getInstance();

            //email zoeken in db
            $statement = $conn->prepare('select * from users where email = :email');
            $statement->bindParam(':email', $email);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            //passwoorden komen overeen?
            if (password_verify($password, $user['password'])) {
                //ja -> naar index
                //echo "joepie de poepie!!!!";
                return $user;
            } else {
                //nee -> error
                //echo "jammer joh";
                return false;
            }
        }

        public static function doLogin($user)
        {
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['id'];
            header('location: index.php');
        }

        public static function getUserId()
        {
            $email = $_SESSION['email'];
            $conn = Db::getInstance();
            $statement = $conn->prepare('select id from users where email = :email');
            $statement->bindParam(':email', $email);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);


            return $user['id'];
        }

        public static function loadProfile($userId) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT users.profilePic, users.firstname, users.profileText, users.email FROM users WHERE users.id = :id");
            $statement->bindValue(':id', $userId, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateProfileText($userId, $profileText) {
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE users SET profileText=:profileText WHERE id = :id");
        $statement->bindValue(':id', $userId, PDO::PARAM_INT);
        $statement->bindValue(':profileText', $profileText, PDO::PARAM_STR);
        $statement->execute();
} 


    public static function updateEmail($userId, $email) {
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE users SET email=:email WHERE id = :id");
        $statement->bindValue(':id', $userId, PDO::PARAM_INT);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->execute();
} 



public static function updatePassword($userId, $newpw) {
    $conn = Db::getInstance();
    $options = [
        'cost' => 12,
    ];
    $hash = password_hash($newpw, PASSWORD_DEFAULT, $options);
    $statement = $conn->prepare("UPDATE users SET password=:pw WHERE id = :id");
    $statement->bindValue(':id', $userId, PDO::PARAM_INT);
    $statement->bindValue(':pw', $hash, PDO::PARAM_STR);
    $statement->execute();
} 
    }
    
