<?php
    require_once('connectionsingleton.php');
    require_once('dbhelper.php');
    
    class dbmanager{
        private $con = null;

        public function __construct(){
            $this->con = connectionSingleton::getConnection();
        }

        /*-----------------------------------------------------------Admin---------------------------------------------------------*/
        //admin login function
        function adminSignin($id,$password){
            $qry = "SELECT password FROM admin WHERE id = $id";
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

        //fully vaccinated student out of total student group by department
        function getFullVaccinatedStudent(){
            $qry = "SELECT d.dname AS 'dept',
                            SUM(CASE WHEN(doseTaken = 2) THEN 1 ELSE 0 END) AS 'fullVaccinated',
                            COUNT(*) AS 'total'
                            FROM student as s JOIN department as d 
                            ON (s.dno = d.dno)
                            GROUP BY s.dno";
            
            $result = $this->con->query($qry);
            $rows = array();
            foreach ($result as $row) {
                $rows[] = $row;
            }
            return $rows;
        }

        //half vaccinated student out of total student group by department
        function getHalfVaccinatedStudent(){
            $qry = "SELECT d.dname AS 'dept',
                            SUM(CASE WHEN(doseTaken = 1) THEN 1 ELSE 0 END) AS 'halfVaccinated',
                            COUNT(*) AS 'total'
                            FROM student as s JOIN department as d 
                            ON (s.dno = d.dno)
                            GROUP BY s.dno";
            
            $result = $this->con->query($qry);
            $rows = array();
            foreach ($result as $row) {
                $rows[] = $row;
            }
            return $rows;
        }

        //not vaccinated student out of total student group by department
        function getNotVaccinatedStudent(){
            $qry = "SELECT d.dname AS 'dept',
                            SUM(CASE WHEN(doseTaken = 0) THEN 1 ELSE 0 END) AS 'notVaccinated',
                            COUNT(*) AS 'total'
                            FROM student as s JOIN department as d 
                            ON (s.dno = d.dno)
                            GROUP BY s.dno";
            
            $result = $this->con->query($qry);
            $rows = array();
            foreach ($result as $row) {
                $rows[] = $row;
            }
            return $rows;
        }

        //fully vaccinated staff out of total staff group by department
        function getFullVaccinatedStaff(){
            $qry = "SELECT d.dname AS 'dept',
                            SUM(CASE WHEN(doseTaken = 2) THEN 1 ELSE 0 END) AS 'fullVaccinated',
                            COUNT(*) AS 'total'
                            FROM staff as s JOIN department as d 
                            ON (s.dno = d.dno)
                            GROUP BY s.dno";
            
            $result = $this->con->query($qry);
            $rows = array();
            foreach ($result as $row) {
                $rows[] = $row;
            }
            return $rows;
        }

        //half vaccinated staff out of total staff group by department
        function getHalfVaccinatedStaff(){
            $qry = "SELECT d.dname AS 'dept',
                            SUM(CASE WHEN(doseTaken = 1) THEN 1 ELSE 0 END) AS 'halfVaccinated',
                            COUNT(*) AS 'total'
                            FROM staff as s JOIN department as d 
                            ON (s.dno = d.dno)
                            GROUP BY s.dno";
            
            $result = $this->con->query($qry);
            $rows = array();
            foreach ($result as $row) {
                $rows[] = $row;
            }
            return $rows;
        }

        //not vaccinated staff out of total Staff group by department
        function getNotVaccinatedStaff(){
            $qry = "SELECT d.dname AS 'dept',
                            SUM(CASE WHEN(doseTaken = 0) THEN 1 ELSE 0 END) AS 'notVaccinated',
                            COUNT(*) AS 'total'
                            FROM staff as s JOIN department as d 
                            ON (s.dno = d.dno)
                            GROUP BY s.dno";
            
            $result = $this->con->query($qry);
            $rows = array();
            foreach ($result as $row) {
                $rows[] = $row;
            }
            return $rows;
        }

        function getTotalVaccinatedStudent(){
            $qry = "SELECT
                    SUM(CASE WHEN(doseTaken = 2) THEN 1 ELSE 0 END) AS 'vaccinated',
                    COUNT(*) AS 'total'
                    FROM student";
            
            $result = $this->con->query($qry);
            $row = $result->fetch_assoc();
            return $row;
        }

        function getTotalVaccinatedStaff(){
            $qry = "SELECT
                    SUM(CASE WHEN(doseTaken = 2) THEN 1 ELSE 0 END) AS 'vaccinated',
                    COUNT(*) AS 'total'
                    FROM staff";
            
            $result = $this->con->query($qry);
            $row = $result->fetch_assoc();
            return $row;
        }

        //------------this function is used by Admin/student/staff
        function getStudentProfile($id){
            $qry = "SELECT name,d.dname AS 'dept',nsuId,nsuMail,doseTaken,v.vaxName,phone,city,NID,DOB,birthRegNo,gender 
                    FROM student s
                    JOIN department d
                    ON(s.dno=d.dno)
                    JOIN vax v
                    ON(s.vaxId=v.vaxId)
                    WHERE nsuId = $id";
            
            $result = $this->con->query($qry);
            $row = $result->fetch_assoc();
            return $row;
        }

        //------------this function is used by Admin/student/staff
        function getStaffProfile($id){
            $qry = "SELECT name,designation,d.dname AS 'dept',staffId,nsuMail,doseTaken,v.vaxName,phone,city,NID,DOB,birthRegNo,gender 
                    FROM staff s
                    JOIN department d
                    ON(s.dno=d.dno)
                    JOIN vax v
                    ON(s.vaxId=v.vaxId)
                    WHERE staffId = $id";
            
            $result = $this->con->query($qry);
            $row = $result->fetch_assoc();
            return $row;
        }

        function setDepartment($dname){
            $qry = "INSERT INTO department (dname) VALUES ('$dname')";
            if($this->con->query($qry)){
                return TRUE;
            } 
            else{
                return FALSE;
            }
        }

        function removeDepartment($dname){
            $qry = "DELETE FROM department WHERE dname = '$dname'";
            return $this->con->query($qry);
        }

        function setVaccine($vaxName,$company){
            if(!$this->vaxExist($vaxName)){
                //check if the company already added or not
                if(!$this->setVaxCompany($company)){
                    //getting the company Id 
                    $companyId = $this->getVaxCompanyId($company);
                    $qry = "INSERT INTO vax (vaxName,companyId) VALUES ('$vaxName','$companyId')";
                    $result = $this->con->query($qry);
                    return $result;
                }else{
                    //getting the company Id 
                    $companyId = $this->getVaxCompanyId($company);
                    $qry = "INSERT INTO vax (vaxName,companyId) VALUES ('$vaxName','$companyId')";
                    $result = $this->con->query($qry);
                    return $result;
                }
            }else{
                return FALSE;
            }
        }

        function removeVaccine($vaxName){
            $qry = "DELETE FROM vax WHERE vaxName = '$vaxName'";
            return $this->con->query($qry);
        }


        //-----Private functions for setVaccine() support
        private function setVaxCompany($company){
            //setting company
            $qry = "INSERT INTO vaxcompany (company) VALUES ('$company')";
            if($this->con->query($qry)) return TRUE;
            else FALSE;
        }

        private function vaxExist($vaxName){ //this function will check is the vax is already exist or not
            $qry = "SELECT vaxName FROM vax WHERE vaxName = '$vaxName'";
            $result = $this->con->query($qry);
            if($result->num_rows > 0) return TRUE;
            else FALSE;
        }

        private function getVaxCompanyId($company){ //this function will return the companyId of the given companyName
            $qry = "SELECT companyId FROM vaxcompany WHERE company = '$company'";
            $result = $this->con->query($qry);
            $row = $result->fetch_assoc();
            return (int)$row['companyId'];
        }
        
        


        /*-----------------------------------------------------------Student---------------------------------------------------------*/
        //Student : Sign In varification function
        function studentSignin($id,$password){
            $qry = "SELECT password FROM student WHERE nsuId = $id";
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
        function studentSignup($id,$pasword,$mail,$name,$dno,$gender){
            $sql = "INSERT INTO student (nsuId,password,nsuMail,name,dno,gender) VALUES ('$id','$pasword','$mail','$name','$dno','$gender')";
        
            if($this->con->query($sql)){
                return TRUE;
            } 
            else{
                //echo "Error: " . $sql . "<br>" . $con->error;
                return FALSE;
            }

        }

        //Student : reset password function 
        function studentResetPassword($id) {
            //checking id the user found or not
            $qry = "SELECT password FROM student WHERE nsuId = $id";
            $result = $this->con->query($qry);
            $row = $result->fetch_assoc();

            if($row == NULL){
                //echo "User not found. <br>";
                return FALSE; //Not found
            }else{
                $helper = new dbhelper();
                //genarating a new random password
                $newpass = $helper->getRandomPassword();
                //echo "<br>New password: ".$newpass."<br>";

                //updating new password for the user
                $success = FALSE;
                $sql = "UPDATE student SET password = '$newpass' WHERE student.nsuId = $id";
                if($this->con->query($sql)){
                    $success = TRUE;
                } 
                
                //sending new password in users mail
                $qry = "SELECT password,nsuMail FROM student WHERE nsuId = $id"; //get the updated password fron db
                $result = $this->con->query($qry);
                $newrow = $result->fetch_assoc();
                //echo "<br>New password: ".$newrow['password']."<br>";
                //echo  "New password has been sent to: " .  $newrow['nsumail'] . "<br>"; //email
                return $success;
            }

            
        }

        //Student : change password function
        function studentChangePassword($id,$oldPassword,$newPassword){

            //checking for valid user
            $qry1 = "SELECT password FROM student WHERE nsuId = $id";
            $isValid = FALSE;
            $result = $this->con->query($qry1);
            $row = $result->fetch_assoc();

            if($row != NULL){
                if($row['password'] == $oldPassword){
                    $isValid = TRUE;
                }
            }

            if($isValid){
                $sql = "UPDATE student SET password = '$newPassword' WHERE student.nsuId = $id";
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

        function updateStudentProfile($id,$dno,$vaxId,$doseTaken,$name,$nsuMail,$phone,$city,$NID,$DOB,$birthRegNo,$gender){
            $qry = "SELECT nsuId FROM student WHERE nsuId = $id";
            $result = $this->con->query($qry);
            if($result->num_rows > 0){
                $qry = "UPDATE `student` SET
                    `dno`   = '$dno',
                    `vaxId` = '$vaxId',
                    `doseTaken` = '$doseTaken',
                    `name` = '$name',
                    `nsuMail` = '$nsuMail',
                    `phone` = '$phone',
                    `city` = '$city',
                    `NID` = '$NID',
                    `DOB` = '$DOB',
                    `birthRegNo` = '$birthRegNo',
                    `gender` = '$gender'
                    wHERE `nsuId` = $id";
                return $this->con->query($qry);
            }else{
                return FALSE;
            }
        }

        function deleteStudentAccount($id){
            $qry = "DELETE FROM student WHERE nsuId = $id";
            return $this->con->query($qry);
        }

        /*-----------------------------------------------------------Staff---------------------------------------------------------*/
        //staff : Sign In varification function
        function staffSignin($id,$password){
            $qry = "SELECT password FROM staff WHERE staffId = $id";
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

        //staff : Sign up or registration varification function 
        function staffSignup($id,$pasword,$mail,$name,$dno,$gender){
            $sql = "INSERT INTO staff (staffId,password,nsuMail,name,dno,gender) VALUES ('$id','$pasword','$mail','$name','$dno','$gender')";
            
            if($this->con->query($sql)){
                return TRUE;
            } 
            else{
                return FALSE;
            }

        }

        //staff : reset password function 
        function staffResetPassword($id) {
            //checking id the user found or not
            $qry = "SELECT password FROM staff WHERE staffId = $id";
            $result = $this->con->query($qry);
            $row = $result->fetch_assoc();

            if($row == NULL){
                //echo "User not found. <br>";
                return FALSE; //Not found
            }else{
                $helper = new dbhelper();
                //genarating a new random password
                $newpass = $helper->getRandomPassword();

                //updating new password for the user
                $success = FALSE;
                $sql = "UPDATE staff SET password = '$newpass' WHERE staff.staffId = $id";
                if($this->con->query($sql)){
                    $success = TRUE;
                } 
                
                //sending new password in users mail
                $qry = "SELECT password,nsuMail FROM staff WHERE staffId = $id"; //get the updated password fron db
                $result = $this->con->query($qry);
                $newrow = $result->fetch_assoc();
                //echo "<br>New password: ".$newrow['password']."<br>";
                //echo  "New password has been sent to: " .  $newrow['nsuMail'] . "<br>"; //email
                return $success;
            }

            
        }

        //staff : change password function
        function staffChangePassword($id,$oldPassword,$newPassword){

            //checking for valid user
            $qry1 = "SELECT password FROM staff WHERE staffId = $id";
            $isValid = FALSE;
            $result = $this->con->query($qry1);
            $row = $result->fetch_assoc();

            if($row != NULL){
                if($row['password'] == $oldPassword){
                    $isValid = TRUE;
                }
            }

            if($isValid){
                $sql = "UPDATE staff SET password = '$newPassword' WHERE staff.staffId = $id";
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

        function updateStaffProfile($id,$dno,$vaxId,$doseTaken,$name,$designation,$nsuMail,$phone,$city,$NID,$DOB,$birthRegNo,$gender){
            $qry = "SELECT staffId FROM staff WHERE staffId = $id";
            $result = $this->con->query($qry);
            if($result->num_rows > 0){
                $qry = "UPDATE `staff` SET
                    `dno`   = '$dno',
                    `vaxId` = '$vaxId',
                    `doseTaken` = '$doseTaken',
                    `name` = '$name',
                    `designation` = '$designation',
                    `nsuMail` = '$nsuMail',
                    `phone` = '$phone',
                    `city` = '$city',
                    `NID` = '$NID',
                    `DOB` = '$DOB',
                    `birthRegNo` = '$birthRegNo',
                    `gender` = '$gender'
                    wHERE `staffId` = $id";
                return $this->con->query($qry);
            }else{
                return FALSE;
            }
        }

        function deleteStaffAccount($id){
            $qry = "DELETE FROM staff WHERE staffId = $id";
            return $this->con->query($qry);
        }
        
        
        /*-------------------------------------------------------Mapping for DropDown Menu-----------------------------------*/

        function getAllDepartment(){
            $sql = "SELECT * FROM `department` ORDER BY `dno` ASC";
            $result = $this->con->query($sql);
            $rows = array();
            foreach ($result as $row) {
                $rows[] = $row;
            }
            return $rows;
        }

        function getAllVaccine(){
            $sql = "SELECT * FROM `vax` ORDER BY `vaxId` ASC";
            $result = $this->con->query($sql);
            $rows = array();
            foreach ($result as $row) {
                $rows[] = $row;
            }
            return $rows;
        }

        function getAllVaxCompany(){
            $sql = "SELECT * FROM `vaxcompany` ORDER BY `companyId` ASC";
            $result = $this->con->query($sql);
            $rows = array();
            foreach ($result as $row) {
                $rows[] = $row;
            }
            return $rows;
        }

    }
?>