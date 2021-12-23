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
    $tvs = $db->getTotalVaccinatedStudent();
    $tvf = $db->getTotalVaccinatedStaff();
?>



<html>
    <head>
        <title>NSU Vaccine Management System</title>
        <link rel="stylesheet" href="./CSS/profile.css"> 
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data1 = google.visualization.arrayToDataTable([
                    ['Type', 'Student Count'],
                    ['Fully Vaccinated',     <?php echo "{$tvs['full']}";?>],
                    ['Non Vaccinated', <?php echo "{$tvs['non']}";?>],
                    ['Half Vaccinated', <?php echo "{$tvs['half']}";?>]                    
                ]);

                var options1 = {
                    title: 'Total Students Stats',
                };

                var data2 = google.visualization.arrayToDataTable([
                    ['Type', 'Faculty-members Count'],
                    ['Fully Vaccinated',     <?php echo "{$tvf['full']}";?>],
                    ['Non Vaccinated', <?php echo "{$tvf['non']}";?>],
                    ['Half Vaccinated', <?php echo "{$tvf['half']}";?>]                    
                ]);

                var options2 = {
                    title: 'Total Faculty-members Stats',
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart1'));

                chart.draw(data1, options1);

                var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

                chart.draw(data2, options2);
            }
        </script>
    </head>

    <body>
        <ul>
            <li class="right-li"><a id="logout">Logout</a></li>     
            <li class="right-li"><a href="updateprofile.php">Edit Profile</a></li>       
        </ul>

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
        
        <h3 align="center">University Stats</h3>
        <div id="piechart">
            <div id="piechart1"></div>
            <div id="piechart2"></div>
        </div> 

        <script src="./JS/profile.js"></script>
    </body>
</html>