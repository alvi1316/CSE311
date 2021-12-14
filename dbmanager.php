<?php
    require_once('connectionsingleton.php');
    require_once('dbhelper.php');
    
    class dbmanager{
        private $con = null;

        public function __construct(){
            $this->con = connectionSingleton::getConnection();
        }

        //Student : Sign In varification function
        function studentSignin($id,$password){
            $qry = "SELECT password FROM student WHERE nsu_id = $id";
            $isValid = FALSE;
            $result = $this->con->query($qry);
            $row = $result->fetch_assoc();

            if($row != NULL){
                if($row['password'] == $password){
                    $isValid = TRUE;
                }
            }

            return $isValid;
        }

        //Stuff : Sign In varification function
        function stuffSignin($id,$password){
            $qry = "SELECT password FROM stuff WHERE stuff_id = $id";
            $isValid = FALSE;
            $result = $this->con->query($qry);
            $row = $result->fetch_assoc();

            if($row != NULL){
                if($row['password'] == $password){
                    $isValid = TRUE;
                }
            }

            return $isValid;
        }

        //Student : Sign up or registration varification function 
        function studentSignup($id,$pasword,$email,$firstname,$lastname){
            $sql = "INSERT INTO student (nsu_id,password,nsu_mail,fname,lname) VALUES ($id,'$pasword','$email','$firstname','$lastname')";
        
            if($this->con->query($sql)){
                return TRUE;
            } 
            else{
                //echo "Error: " . $sql . "<br>" . $con->error;
                return FALSE;
            }

        }

        //Stuff : Sign up or registration varification function 
        function stuffSignup($id,$pasword,$email,$firstname,$lastname){
            $sql = "INSERT INTO stuff (stuff_id,password,nsu_mail,fname,lname) VALUES ($id,'$pasword','$email','$firstname','$lastname')";
            
            if($this->con->query($sql)){
                return TRUE;
            } 
            else{
                return FALSE;
            }

        }

        //Student : reset password function 
        function studentResetPassword($id) {
            //checking id the user found or not
            $qry = "SELECT password FROM student WHERE nsu_id = $id";
            $result = $this->con->query($qry);
            $row = $result->fetch_assoc();

            if($row == NULL){
                //echo "User not found. <br>";
                return FALSE; //Not found
            }else{
                //genarating a new random password
                $newpass = dbhelper::getRandomPassword();
                //echo "<br>New password: ".$newpass."<br>";

                //updating new password for the user
                $success = FALSE;
                $sql = "UPDATE student SET password = '$newpass' WHERE student.nsu_id = $id";
                if($this->con->query($sql)){
                    $success = TRUE;
                } 
                
                //sending new password in users mail
                $qry = "SELECT password,nsu_mail FROM student WHERE nsu_id = $id"; //get the updated password fron db
                $result = $this->con->query($qry);
                $newrow = $result->fetch_assoc();
                echo "<br>New password: ".$newrow['password']."<br>";
                echo  "New password has been sent to: " .  $newrow['nsu_mail'] . "<br>"; //email
                return $success;
            }

            
        }

        //Stuff : reset password function 
        function stuffResetPassword($id) {
            //checking id the user found or not
            $qry = "SELECT password FROM stuff WHERE stuff_id = $id";
            $result = $this->con->query($qry);
            $row = $result->fetch_assoc();

            if($row == NULL){
                //echo "User not found. <br>";
                return FALSE; //Not found
            }else{
                //genarating a new random password
                $newpass = dbhelper::getRandomPassword();

                //updating new password for the user
                $success = FALSE;
                $sql = "UPDATE stuff SET password = '$newpass' WHERE stuff.stuff_id = $id";
                if($this->con->query($sql)){
                    $success = TRUE;
                } 
                
                //sending new password in users mail
                $qry = "SELECT password,nsu_mail FROM stuff WHERE stuff_id = $id"; //get the updated password fron db
                $result = $this->con->query($qry);
                $newrow = $result->fetch_assoc();
                echo "<br>New password: ".$newrow['password']."<br>";
                echo  "New password has been sent to: " .  $newrow['nsu_mail'] . "<br>"; //email
                return $success;
            }

            
        }



        //Student : change password function
        function studentChangePassword($id,$oldPassword,$newPassword){

            //checking for valid user
            $qry1 = "SELECT password FROM student WHERE nsu_id = $id";
            $isValid = FALSE;
            $result = $this->con->query($qry1);
            $row = $result->fetch_assoc();

            if($row != NULL){
                if($row['password'] == $oldPassword){
                    $isValid = TRUE;
                }
            }

            if($isValid){
                $sql = "UPDATE student SET password = '$newPassword' WHERE student.nsu_id = $id";
                if($this->con->query($sql)){
                    return TRUE;
                } 
                else{
                    return FALSE;
                }
            }else{
                return FALSE;
            }
            
        }

        //Stuff : change password function
        function stuffChangePassword($id,$oldPassword,$newPassword){

            //checking for valid user
            $qry1 = "SELECT password FROM stuff WHERE stuff_id = $id";
            $isValid = FALSE;
            $result = $this->con->query($qry1);
            $row = $result->fetch_assoc();

            if($row != NULL){
                if($row['password'] == $oldPassword){
                    $isValid = TRUE;
                }
            }

            if($isValid){
                $sql = "UPDATE stuff SET password = '$newPassword' WHERE stuff.stuff_id = $id";
                if($this->con->query($sql)){
                    return TRUE;
                } 
                else{
                    return FALSE;
                }
            }else{
                return FALSE;
            }
            
        }


        //get students informations
        function getAllStudentRow(){
            $sql = "SELECT nsu_id,fname,lname,dname,doseTaken FROM student as s,department as d WHERE s.dno = d.dno";
            //$result = $this->con->query($sql);
            //$row = mysqli_fetch_assoc($result);
            //return $result;
            $result = $this->con->query($sql);
            $rows = array();
            foreach ($result as $row) {
                $rows[] = $row;
            }
            return $rows;
        }
        
        //get stuff informations
        function getAllStuffRow(){
            $sql = "SELECT stuff_id,fname,lname,dname,doseTaken FROM stuff as s,department as d WHERE s.dno = d.dno";
            //$result = $this->con->query($sql);
            //$row = mysqli_fetch_assoc($result);
            //return $result;
            $result = $this->con->query($sql);
            $rows = array();
            foreach ($result as $row) {
                $rows[] = $row;
            }
            return $rows;
        }
    }
?>