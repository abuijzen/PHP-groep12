<?php
    class Security {
        public $password;
        public $passwordConfirmation;

        /*
            check if passwords are secure 
            to use in my signup process
        */
        public function passwordsAreSecure(){
            if( $this->passwordIsStrongEnough() 
                && $this->passwordsAreEqual() ){
                return true;
            }
            else {
                return false;
            }
        }

        private function passwordIsStrongEnough(){
            if( strlen( $this->password ) <= 8 ){
                return false;
            }
            else {
                return true;
            }
        }

        private function passwordsAreEqual(){
            if( $this->password == $this->passwordConfirmation ){
                return true;
            }
            else {
                return false;
            }
        }
    }