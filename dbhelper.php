<?php
    class dbhelper{

        //generate random password
        public function getRandomPassword(){
            //genarating a new random password
            $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ";
            $digit = "0123456789";
            //7 alphabet 
            for ($i = 0; $i < 7; $i++) {
                $index = rand(0, strlen($alphabet)-1);
                $pass[$i] = $alphabet[$index];
            }
            //1 digit
            $index = rand(0, strlen($digit)-1);
            $pass[$i++] = $digit[$index];

            //Converting array to string
            $newpass = "";
            foreach($pass as $ch){
                $newpass .= $ch;
            }

            return $newpass;
        }
    }
?>