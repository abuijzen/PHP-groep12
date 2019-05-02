<?php
    class User
    {
        private $email;
        private $password;
        private $passwordConfirmation;

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
                        'cost' => 14, //2^14
                ];
            $password = password_hash($this->password, PASSWORD_DEFAULT, $options);

            try {
                //alles wat je wil proberen
                //$conn = new PDO("mysql:host=localhost;dbname=netflix","root","root",null); indien hij een 4e vraagt
                $conn = Db::getInstance();
                $statement = $conn->prepare('INSERT into users(email,password) VALUES (:email,:password)');
                $statement->bindParam(':email', $this->email);
                $statement->bindParam(':password', $password);
                $result = $statement->execute();

                return $result;
            } catch (Throwable $t) {
                return false;
            }
        }
    }
