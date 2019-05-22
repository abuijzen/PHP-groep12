<?php
    class User
    {
        private $firstname;
        private $lastname;
        private $email;
        private $password;
        private $passwordConfirmation;
        private $avatar;

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
        } public static function getAvatar($userId) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT users.avatar_url FROM users WHERE users.id = :id");
            $statement->bindValue(':id', $userId, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
            
    }

        //@todo: form validation
        public function register()
        {
            $options = [
                        'cost' => 12, //2^14
                ];
            $password = password_hash($this->password, PASSWORD_DEFAULT, $options);

            try {
                //$conn = new PDO("mysql:host=localhost;dbname=netflix","root","root",null); indien hij een 4e vraagt
                $conn = Db::getInstance();
                $statement = $conn->prepare('INSERT into users(firstname,lastname,email,password) VALUES (:firstName, :lastName ,:email,:password)');
                $statement->bindParam(':firstName', $this->firstname);
                $statement->bindParam(':lastName', $this->lastname);
                $statement->bindParam(':email', $this->email);
                $statement->bindParam(':password', $password);
                $result = $statement->execute();

                header('Location:index.php');
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

        public static function loadProfile($userId)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('SELECT users.profilePic, users.firstname, users.profileText, users.email FROM users WHERE users.id = :id');
            $statement->bindValue(':id', $userId, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public static function updateProfileText($userId, $profileText)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('UPDATE users SET profileText=:profileText WHERE id = :id');
            $statement->bindValue(':id', $userId, PDO::PARAM_INT);
            $statement->bindValue(':profileText', $profileText, PDO::PARAM_STR);
            $statement->execute();
        }

        public static function updateEmail($userId, $email)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('UPDATE users SET email=:email WHERE id = :id');
            $statement->bindValue(':id', $userId, PDO::PARAM_INT);
            $statement->bindValue(':email', $email, PDO::PARAM_STR);
            $statement->execute();
        }

        public static function updatePassword($userId, $newpw)
        {
            $conn = Db::getInstance();
            $options = [
        'cost' => 12,
    ];
            $hash = password_hash($newpw, PASSWORD_DEFAULT, $options);
            $statement = $conn->prepare('UPDATE users SET password=:pw WHERE id = :id');
            $statement->bindValue(':id', $userId, PDO::PARAM_INT);
            $statement->bindValue(':pw', $hash, PDO::PARAM_STR);
            $statement->execute();
        }

        public function passwordCheck($oldpw, $userId)
        {
            $conn = Db::getInstance();
            $query = 'select password from users where id = :id';
            $statement = $conn->prepare($query);
            $statement->bindParam(':id', $userId);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if (password_verify($oldpw, $result['password'])) {
                return true;
            } else {
                throw new Exception('Wrong password');
            }
        }

        public function setAvatar($image)
        {
                if (empty($image)){
                        throw new Exception ("An error uploading image");
                    }
                    $this->image = $image;
            
                    return $this;
                    
        }

        public function saveAvatar($image) {
                $width = 200;
                $height = 200;

                if(isset($_POST)) {
                    $target_dir = "images/";
                    $fileName = md5(microtime());
                    $target_file = $target_dir . basename($this->image["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    // Check if image file is an image
                    if(isset($_POST["submit"])) {
                        if(!empty($this->image["tmp_name"])){
                                $check = getimagesize($this->image["tmp_name"]);
                        } else {
                                throw new Exception ("Error uploading image");
                            $uploadOk = 0;
                        }
                        
                        if($check !== false) {
                            $uploadOk = 1;
                        } else {
                            throw new Exception ("Error uploading image");
                            $uploadOk = 0;
                        }
                    }
                
                    // Check if file already exists
                    if (file_exists($target_file)) {
                        throw new Exception ("Error uploading image");
                        $uploadOk = 0;
                    }
                    // Check file size
                    if ($this->image["size"] > 6291456) {
                        throw new Exception ("Upload size limit is 6MB");
                        $uploadOk = 0;
                    }
                    // Allow only jpg, pbg and gif
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                        throw new Exception ("Image must be JPG, PNG or GIF");
                        $uploadOk = 0;
                    }
                    $target_file = $target_dir .$fileName.".".$imageFileType;
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        throw new Exception ("Error uploading image");
                    // if everything is ok, try to upload file
                    } else {
                        if ($uploadOk == 1) {
                        // upload full image to /uploads        
                                $name = $this->image["tmp_name"];
                                list($img_width, $img_height) = getimagesize($name); // get sizes of image
                                $img_ratio = $img_width/$img_height; // get aspect ratio of image
                        
                        
                            
                            // scale image to thmb size with corrrect aspect ratio
                            $crop_x = 0;
                            $crop_y = 0; 

                            if ($width/$height > $img_ratio) {
                                // portrait image
                                $height = $width/$img_ratio;
                                $crop_y = ceil(($img_height - $img_width) / 2);
                                $img_height = $img_width;
                            } else {
                                //landscape image
                                $width = $height*$img_ratio;
                                $crop_x = ceil(($img_width - $img_height) / 2);
                                $img_width = $img_height;
                            }
                            
                            // create resized image
                            $output_image = imagecreatetruecolor(200, 200);
                            switch ($imageFileType) {
                                case "gif"  : $image = imagecreatefromgif($name); $check = 1; break;
                                case "jpeg" : $image = imagecreatefromjpeg($name); $check = 1; break;
                                case "jpg" : $image = imagecreatefromjpeg($name); $check = 1; break;
                                case "png"  : $image = imagecreatefrompng($name); $check = 1; break;
                                default : $check = 0;
                            }
                            
                            // save resized image
                            if($check == 1){
                                imagecopyresampled($output_image, $image, 0, 0, $crop_x, $crop_y, 200, 200, $img_width, $img_height);
                                imagejpeg( $output_image,"./images/".$fileName."_thmb.jpg", 90 );
                                $this->fileName = $fileName;
                                $this->imageFileType = $imageFileType;
                            }
                        } else {
                            throw new Exception ("Error uploading image");
                        }
                    }
                }
            }
        
            public function postAvatar($userId){
                //connectie 
                $conn = Db::getInstance();
                $thmb_url = "./images/".$this->fileName."_thmb.jpg";
                $statement = $conn->prepare("UPDATE users set avatar_url = :thmb_url WHERE id = :users_id");
                $statement->bindParam(":thmb_url", $thmb_url);
                $statement->bindParam(":users_id", $userId);
                
                    // execute
                $result = $statement->execute();
                return $result;
            }
    }
