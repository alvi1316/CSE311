<?php
    
    class dbmanager{

        //Student : Sign In varification function
        function student_signin($con,$id,$password){
            $qry = "SELECT password FROM student WHERE nsu_id = $id";
            $isvalid = FALSE;
            $result = $con->query($qry);
            $row = $result->fetch_assoc();

            if($row != NULL){
                if($row['password'] == $password){
                    $isvalid = TRUE;
                }
            }

            return $isvalid;
        }

        //Stuff : Sign In varification function
        function stuff_signin($con,$id,$password){
            $qry = "SELECT password FROM stuff WHERE stuff_id = $id";
            $isvalid = FALSE;
            $result = $con->query($qry);
            $row = $result->fetch_assoc();

            if($row != NULL){
                if($row['password'] == $password){
                    $isvalid = TRUE;
                }
            }

            return $isvalid;
        }

        //Student : Sign up or registration varification function 
        function student_signup($con,$id,$pasword,$email,$firstname,$lastname){
            $sql = "INSERT INTO student (nsu_id,password,nsu_mail,fname,lname) VALUES ($id,'$pasword','$email','$firstname','$lastname')";
        
            if($con->query($sql)){
                return TRUE;
            } 
            else{
                //echo "Error: " . $sql . "<br>" . $con->error;
                return FALSE;
            }
                
            $con->close();

        }

        //Stuff : Sign up or registration varification function 
        function stuff_signup($con,$id,$pasword,$email,$firstname,$lastname){
            $sql = "INSERT INTO stuff (stuff_id,password,nsu_mail,fname,lname) VALUES ($id,'$pasword','$email','$firstname','$lastname')";
            
            if($con->query($sql)){
                return TRUE;
            } 
            else{
                return FALSE;
            }
                
            $con->close();

        }

        //Student : reset password function 
        function student_resetPassword($con,$id) {
            //checking id the user found or not
            $qry = "SELECT password FROM student WHERE nsu_id = $id";
            $result = $con->query($qry);
            $row = $result->fetch_assoc();

            if($row == NULL){
                //echo "User not found. <br>";
                return FALSE; //Not found
            }else{
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
                //echo "<br>New password: ".$newpass."<br>";

                //updating new password for the user
                $success = FALSE;
                $sql = "UPDATE student SET password = '$newpass' WHERE student.nsu_id = $id";
                if($con->query($sql)){
                    $success = TRUE;
                } 
                
                //sending new password in users mail
                $qry = "SELECT password,nsu_mail FROM student WHERE nsu_id = $id"; //get the updated password fron db
                $result = $con->query($qry);
                $newrow = $result->fetch_assoc();
                echo "<br>New password: ".$newrow['password']."<br>";
                echo  "New password has been sent to: " .  $newrow['nsu_mail'] . "<br>"; //email
                return $success;
            }

            
        }

        //Stuff : reset password function 
        function stuff_resetPassword($con,$id) {
            //checking id the user found or not
            $qry = "SELECT password FROM stuff WHERE stuff_id = $id";
            $result = $con->query($qry);
            $row = $result->fetch_assoc();

            if($row == NULL){
                //echo "User not found. <br>";
                return FALSE; //Not found
            }else{
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
                //echo "<br>New password: ".$newpass."<br>";

                //updating new password for the user
                $success = FALSE;
                $sql = "UPDATE stuff SET password = '$newpass' WHERE stuff.stuff_id = $id";
                if($con->query($sql)){
                    $success = TRUE;
                } 
                
                //sending new password in users mail
                $qry = "SELECT password,nsu_mail FROM stuff WHERE stuff_id = $id"; //get the updated password fron db
                $result = $con->query($qry);
                $newrow = $result->fetch_assoc();
                echo "<br>New password: ".$newrow['password']."<br>";
                echo  "New password has been sent to: " .  $newrow['nsu_mail'] . "<br>"; //email
                return $success;
            }

            
        }



        //Student : change password function
        function student_changePassword($con,$id,$oldPassword,$newPassword){

            //checking for valid user
            $qry1 = "SELECT password FROM student WHERE nsu_id = $id";
            $isvalid = FALSE;
            $result = $con->query($qry1);
            $row = $result->fetch_assoc();

            if($row != NULL){
                if($row['password'] == $oldPassword){
                    $isvalid = TRUE;
                }
            }

            if($isvalid){
                $sql = "UPDATE student SET password = '$newPassword' WHERE student.nsu_id = $id";
                if($con->query($sql)){
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
        function stuff_changePassword($con,$id,$oldPassword,$newPassword){

            //checking for valid user
            $qry1 = "SELECT password FROM stuff WHERE stuff_id = $id";
            $isvalid = FALSE;
            $result = $con->query($qry1);
            $row = $result->fetch_assoc();

            if($row != NULL){
                if($row['password'] == $oldPassword){
                    $isvalid = TRUE;
                }
            }

            if($isvalid){
                $sql = "UPDATE stuff SET password = '$newPassword' WHERE stuff.stuff_id = $id";
                if($con->query($sql)){
                    return TRUE;
                } 
                else{
                    return FALSE;
                }
            }else{
                return FALSE;
            }
            
        }


        //Show All students informations
        function Print($con){
            $qry = "SELECT nsu_id,fname,lname,dname,doseTaken FROM student as s,department as d WHERE s.dno = d.dno";
            $result = $con->query($qry);

            if(mysqli_num_rows($result) > 0){
                echo "<table>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Department</th>";
                echo "<th>Dose Taken</th>";
                echo "</tr>";
                while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>" . $row['nsu_id'] . "</td>";
                echo "<td>" . $row['fname'] . "</td>";
                echo "<td>" . $row['lname'] . "</td>";
                echo "<td>" . $row['dname'] . "</td>";
                echo "<td>" . $row['doseTaken'] . "</td>";
                echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
        
        
            }
        }
    }
?>