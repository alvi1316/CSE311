<?php

    session_start();
                
    if(!isset($_SESSION['id'])){
        header('Location: index.php');
    }

    require_once("dbmanager.php");
    $db = new dbmanager();
    $sp = $db->getStudentProfile($_SESSION['id']);
    $dno = $db->getAllDepartment();
    $vno = $db->getAllVaccine();
?>


<html>

    <head>
        <title>NSU Vaccine Management System</title>
        <link rel="stylesheet" href="./CSS/updateprofile.css"> 
    </head>

    <body>
        <ul>
            <li class="right-li"><a id="logout">Logout</a></li>     
            <li class="right-li"><a href="profile.php">Home</a></li>       
        </ul>

        <div class="main">
            <h2>Update Information</h2>
            <input type="hidden" id="userType" value="<?php print($_SESSION['userType']);?>">
            <div class="contain">
                <div class="wrapper">              
                    <form>
                        <p class="custom-p-margin">
                            <label for="nameInput">Name</label>
                            <input type="text" id="nameInput" value="<?php print($sp['name']);?>">
                            <label id="nameError" class="form-error">Please enter your full name</label>
                        </p>
                        <p>
                            <label for="emailInput">Email</label>
                            <input type="text" id="emailInput" value="<?php print($sp['nsuMail']);?>">
                            <label id="emailError" class="form-error">Please enter a valid NSU email</label>
                        </p>
                        <p class="custom-p-margin">
                            <label for="phoneInput">Phone</label>
                            <input type="number" id="phoneInput"  value="<?php print($sp['phone']);?>">
                        </p>
                        <p>
                            <label for="cityInput">City</label>
                            <input type="text" id="cityInput"  value="<?php print($sp['city']);?>">
                        </p>
                        <p class="custom-p-margin">
                            <label for="dobInput">Date of Birth</label>
                            <input type="date" id="dobInput"  value="<?php print($sp['DOB']);?>">
                        </p>

                        <p>
                            <label for="genderInput">Gender</label>
                            <select id="genderInput">
                                <?php
                                    $male = null;
                                    $female = null;
                                    $other = null;
                                    if($sp['gender'] === "M"){
                                        $male = 'selected';
                                    }else if($sp['gender'] === "F"){
                                        $female = 'selected';
                                    }else{
                                        $other = 'selected';
                                    }
                                ?>
                                <option value="Male" <?php echo $male;?>>Male</option>
                                <option value="Female" <?php echo $female;?>>Female</option>
                                <option value="Other" <?php echo $other;?>>Other</option>
                            </select>
                        </p>

                        <p class="custom-p-margin">
                            <label for="nidInput">NID</label>
                            <input type="number" id="nidInput"  value="<?php print($sp['NID']);?>">                            
                        </p>
                        <p>
                            <label for="bidInput">Birth Registration No</label>
                            <input type="number" id="bidInput"  value="<?php print($sp['birthRegNo']);?>">
                        </p>

                        <p style="width:100%;" id="nidBidError" class="form-error">
                            <label>You have to provide your NID or Your Birth Certificate No</label>
                        </p>
                        
                        
                        <p class="custom-p-margin">
                            <label for="deptInput">Department</label>
                            <select id="deptInput">
                                <?php
                                    foreach($dno as $dept){
                                        if($dept['dname'] === $sp['dept']){
                                            print("<option value='{$dept['dno']}' selected>{$dept['dname']}</option>");
                                        }else{
                                            print("<option value='{$dept['dno']}'>{$dept['dname']}</option>");
                                        }                                        
                                    }
                                ?>
                            </select>
                        </p>

                        <p>
                            <label for="vaxInput">Vaccine Name</label>
                            <select id="vaxInput">
                                <?php
                                    foreach($vno as $v){
                                        if($v['vaxName'] === $sp['vaxName']){
                                            print("<option value ='{$v['vaxId']}' selected>{$v['vaxName']}</option>");
                                        }else{
                                            print("<option value ='{$v['vaxId']}'>{$v['vaxName']}</option>");
                                        }                               
                                    }
                                ?>
                            </select>
                        </p>


                        <p class="custom-p-margin">
                            <label for="dofdInput">Date of 1st Dose</label>
                            <input <?php print("value = '{$sp['firstDose']}'");?> type="date" id="dofdInput">
                        </p>

                        <p>
                            <label for="dosdInput">Date of 2nd Dose</label>
                            <input <?php print("value = '{$sp['secondDose']}'");?> type="date" id="dosdInput">
                        </p>

                        <p style="width:100%;" id="doseError1" class="form-error">
                            <label>You cannot enter 2nd dose without 1st dose!</label>
                        </p>
                                    
                        <p style="width:100%;" id="doseError2" class="form-error">
                            <label>First dose date cannot be after Second dose date!</label>
                        </p>
                        
                        <p>
                            <button type="button" id = "updateButton">Update</button>
                            <button type="button" class = "delete-button">Delete Account</button>
                        </p>
                        
                    </form>

                </div>
            </div>
        </div> 
        
        <script src="./JS/updateprofile.js"></script>
        
    </body>
</html>