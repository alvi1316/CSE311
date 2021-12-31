<?php

    session_start();
            
    if(!isset($_SESSION['adminId'])){
        header('Location: adminlogin.php');
    }

    $id = $_GET['searchId'] ?? null;
    $userType = $_GET['userType'] ?? null;
    
    require_once("dbmanager.php");
    $db = new dbmanager();
    $sp = null;
    if($userType === 'student'){
        $sp = $db->getStudentProfile($id);
    }else if($userType === 'facilty-member'){
        $sp = $db->getStaffProfile($id);
    }

    $error = false;

    if($id !== null && $userType !== null && $sp === null){
        $error = true;
    }

?>

<html>
    <head>
        <title>NSUVMS | Search</title>
        <link rel="stylesheet" href="./CSS/profile.css"> 
    </head>

    <body>
        <ul>
            <li class="right-li"><a id="logout">Logout</a></li>     
            <li class="right-li"><a href="adminpanel.php">Home</a></li>       
        </ul>
        
        <?php
            if($error){
                print("<h1 style='text-align:center;'> No User Found </h1>");
                die();
            }

        ?>

        <div class="main">
            <h3>Profile Information</h3>
            <div class="card">
                <table>
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?php echo $sp['name'];?></td>
                        </tr>
                        <tr>
                            <td>ID</td>
                            <td>:</td>
                            <td>
                                <?php 
                                    if($userType === 'student'){
                                        echo $sp['nsuId'];
                                    }else{
                                        echo $sp['staffId'];
                                    }                                   
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $sp['nsuMail'];?></td>
                        </tr>
                        <tr>
                            <td>Department</td>
                            <td>:</td>
                            <td><?php echo $sp['dept'];?></td>
                        </tr>
                        <?php
                            if($userType === 'facilty-member'){
                                print("
                                    <tr>
                                        <td>Designation</td>
                                        <td>:</td>
                                        <td>{$sp['designation']}</td>
                                    </tr>
                                ");
                            }
                        ?>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><?php echo $sp['phone'];?></td>
                        </tr>                        
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td><?php echo $sp['city'];?></td>
                        </tr>
                        <tr>
                            <td>NID</td>
                            <td>:</td>
                            <td><?php echo $sp['NID'];?></td>
                        </tr>
                        <tr>
                            <td>Birth Registration</td>
                            <td>:</td>
                            <td><?php echo $sp['birthRegNo'];?></td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td>:</td>
                            <td><?php echo $sp['DOB'];?></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>:</td>
                            <td><?php echo $sp['gender'];?></td>
                        </tr>
                        <tr>
                            <td>Dose Taken</td>
                            <td>:</td>
                            <td><?php echo $sp['doseTaken'];?></td>
                        </tr>
                        <tr>
                            <td>Vaccine Name</td>
                            <td>:</td>
                            <td><?php echo $sp['vaxName'];?></td>
                        </tr>
                        <tr>
                            <td>1st Dose Date</td>
                            <td>:</td>
                            <td><?php echo $sp['firstDose'];?></td>
                        </tr>
                        <tr>
                            <td>2nd Dose Date</td>
                            <td>:</td>
                            <td><?php echo $sp['secondDose'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>    

        <script src="./JS/profile.js"></script>
    </body>
</html>