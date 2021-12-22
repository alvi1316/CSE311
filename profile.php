<?php

    session_start();
            
    if(!isset($_SESSION['id'])){
        header('Location: index.php');
    }
    
    require_once("dbmanager.php");
    $db = new dbmanager();
    $sp = null;
    if($_SESSION['userType'] === 'student'){
        $sp = $db->getStudentProfile($_SESSION['id']);
    }else{
        $sp = $db->getStaffProfile($_SESSION['id']);
    }

?>



<html>
    <head>
        <title>NSU Vaccine Management System</title>
        <link rel="stylesheet" href="./CSS/profile.css"> 
    </head>

    <body>
        <ul>
            <li class="right-li"><a id="logout">Logout</a></li>     
            <li class="right-li"><a href="updateprofile.php">Edit Profile</a></li>       
        </ul>

        <div class="main">
            <img src="./Pictures/logo2.jpg">
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
                                    if($_SESSION['userType'] === 'student'){
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
                            <td>Vaccine Name</td>
                            <td>:</td>
                            <td><?php echo $sp['firstDose'];?></td>
                        </tr>
                        <tr>
                            <td>Vaccine Name</td>
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