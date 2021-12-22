<?php

    session_start();
        
    if(!isset($_SESSION['adminId'])){
        header('Location: adminlogin.php');
    }

    require_once("dbmanager.php");
    $db = new dbmanager();
    $trs = $db->getTotalRegisteredStudent();
    $trf = $db->getTotalRegisteredStaff();
    $fvs = $db->getFullVaccinatedStudent();
    $hvs = $db->getHalfVaccinatedStudent();
    $nvs = $db->getNotVaccinatedStudent();
    $fvf = $db->getFullVaccinatedStaff(); 
    $hvf = $db->getHalfVaccinatedStaff();  
    $nvf = $db->getNotVaccinatedStaff();
    $tvs = $db->getTotalVaccinatedStudent();
    $tvf = $db->getTotalVaccinatedStaff();
    $sfdd = $db->getStudentFirstDoseTakenByDate();
    $ssdd = $db->getStudentSecondDoseTakenByDate();
    $ffdd = $db->getStaffFirstDoseTakenByDate();
    $fsdd = $db->getStaffSecondDoseTakenByDate();
    $dno = $db->getAllDepartment();
    $vno = $db->getAllVaccine();

?>

<!DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" href="./CSS/adminpanel.css">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {packages: ['corechart', 'bar']});
            google.charts.setOnLoadCallback(drawMultSeries);

            function drawMultSeries() {
                var data = google.visualization.arrayToDataTable([
                    ['Type', 'Male', 'Female', { role: 'annotation' } ],
                    ['Student', <?php echo $trs[0]['male'];?>, <?php echo $trs[0]['female'];?>, ''],
                    ['Faculty-Member', <?php echo $trf[0]['male'];?>, <?php echo $trf[0]['female'];?>,  '']
                ]);

                var options = {
                    title: 'Total Registered Student',
                    legend: {
                    position: 'top',
                    maxLines: 3
                    },
                    bar: { groupWidth: '50%' },
                    isStacked: true
                };

                var chart = new google.visualization.BarChart(document.getElementById('chart_div_1'));
                chart.draw(data, options);
            }

            
            google.charts.setOnLoadCallback(drawRightY1);

            function drawRightY1() {
                data = google.visualization.arrayToDataTable([
                    ['Department', 'Total Students', 'Students with 2nd dose', 'Students with 1st dose', 'Non-vaccinated students'],
                    <?php
                        for($i = 0; $i<count($fvs); $i++){
                            print("['{$fvs[$i]['dept']}', {$fvs[$i]['total']}, {$fvs[$i]['fullVaccinated']}, {$hvs[$i]['halfVaccinated']}, {$nvs[$i]['notVaccinated']}],");
                        }
                    ?>                    
                ]);

                options = {
                    legend: {
                        position: 'top',
                        maxLines: 3
                    },
                    title: 'Vaccination chart Student',
                    colors: ['rgb(51, 102, 204)','rgb(16, 150, 24)','rgb(255, 153, 0)','rgb(220, 57, 18)'],
                    bars: 'horizontal'
                };
                var materialChart = new google.visualization.BarChart(document.getElementById('chart_div_2'));
                materialChart.draw(data, options);
            }

            google.charts.setOnLoadCallback(drawRightY2);

            function drawRightY2() {
                data = google.visualization.arrayToDataTable([
                    ['Department', 'Total Faculty-members', 'Faculty-members with 2nd dose', 'Faculty-members with 1st dose', 'Non-vaccinated Faculty-members'],
                    <?php
                        for($i = 0; $i<count($fvf); $i++){
                            print("['{$fvf[$i]['dept']}', {$fvf[$i]['total']}, {$fvf[$i]['fullVaccinated']}, {$hvf[$i]['halfVaccinated']}, {$nvf[$i]['notVaccinated']}],");
                        }
                    ?>                    
                ]);

                options = {
                    legend: {
                        position: 'top',
                        maxLines: 3
                    },
                    title: 'Vaccination chart Faculty-members',
                    colors: ['rgb(51, 102, 204)','rgb(16, 150, 24)','rgb(255, 153, 0)','rgb(220, 57, 18)'],
                    bars: 'horizontal'
                };
                var materialChart = new google.visualization.BarChart(document.getElementById('chart_div_3'));
                materialChart.draw(data, options);
            }

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
                    pieHole: 0.4,
                };

                var data2 = google.visualization.arrayToDataTable([
                    ['Type', 'Faculty-members Count'],
                    ['Fully Vaccinated',     <?php echo "{$tvf['full']}";?>],
                    ['Non Vaccinated', <?php echo "{$tvf['non']}";?>],
                    ['Half Vaccinated', <?php echo "{$tvf['half']}";?>]                    
                ]);

                var options2 = {
                    title: 'Total Faculty-members Stats',
                    pieHole: 0.4,
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart1'));

                chart.draw(data1, options1);

                var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

                chart.draw(data2, options2);
            }

            google.charts.load('current', {packages: ['corechart', 'line']});
            google.charts.setOnLoadCallback(drawCurveTypes1);

            function drawCurveTypes1() {
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Date');
                data.addColumn('number', 'First Dose');
                data.addColumn('number', 'Second Dose');

                data.addRows([
                    <?php
                        foreach($sfdd as $element){
                            print("[new Date('{$element['firstDose']}'), {$element['total']}, null],");
                        }
                        foreach($ssdd as $element){
                            print("[new Date('{$element['secondDose']}'), null, {$element['total']}],");
                        }     
                    ?>
                ]);

                var options = {
                    title: 'Student Vaccination vs Date',
                    interpolateNulls: true,
                    colors: ['rgb(16, 150, 24)','rgb(255, 153, 0)'],
                    legend: {
                        position: 'top',
                        maxLines: 3
                    },
                    hAxis: {
                        title: 'Date',
                        gridlines: {
                            color: 'transparent'
                        }
                    },
                    vAxis: {
                        title: 'Total Vaccinated'
                    },
                    series: {
                        1: {curveType: 'function'}
                    },
                };

                var chart = new google.visualization.LineChart(document.getElementById('graphchart1'));
                chart.draw(data, options);
            }

            google.charts.setOnLoadCallback(drawCurveTypes2);

            function drawCurveTypes2() {
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Date');
                data.addColumn('number', 'First Dose');
                data.addColumn('number', 'Second Dose');

                data.addRows([
                    <?php
                        foreach($ffdd as $element){
                            print("[new Date('{$element['firstDose']}'), {$element['total']}, null],");
                        }
                        foreach($fsdd as $element){
                            print("[new Date('{$element['secondDose']}'), null, {$element['total']}],");
                        }     
                    ?>
                ]);

                var options = {
                    title: 'Faculty-Members Vaccination vs Date',
                    interpolateNulls: true,
                    colors: ['rgb(16, 150, 24)','rgb(255, 153, 0)'],
                    legend: {
                        position: 'top',
                        maxLines: 3
                    },
                    hAxis: {
                        title: 'Date',
                        gridlines: {
                            color: 'transparent'
                        }
                    },
                    vAxis: {
                        title: 'Total Vaccinated'
                    },
                    series: {
                        1: {curveType: 'function'}
                    },
                };

                var chart = new google.visualization.LineChart(document.getElementById('graphchart2'));
                chart.draw(data, options);
            }

        </script>
    </head>

    <body>

        <ul>
            <li class="right-li"><a id="logout">Logout</a></li>
            <form method = "get" action="searchprofile.php">
                <li class="left-li"><input name="searchId" type="number" class="search-input" placeholder="NSU ID"></li>
                <li class="left-li">
                    <select class="search-type" name="userType">
                        <option value="student">Student</option>
                        <option value="facilty-member">Faculty-Member</option>
                    </select>
                </li>
                <li class="left-li"><button type="submit" class="search-button">Search</button></li>
            <form>            
        </ul>

        <div id="chart_div_1"></div>
        <div id="piechart">
            <div id="piechart1"></div>
            <div id="piechart2"></div>
        </div>       
        <div id="graphchart1"></div>
        <div id="graphchart2"></div>
        <div id="chart_div_2"></div>
        <div id="chart_div_3"></div>

        <div id="my_div_1">
            <div>
                <label for="deleteVaxName">Delete Vaccine: </label>
                <select id="deleteVaxName">
                    <?php
                        foreach($vno as $v){
                            if($v['vaxName'] !== 'Not Vaccinated'){
                                print("<option value ='{$v['vaxName']}'>{$v['vaxName']}</option>");
                            }                                              
                        }
                    ?>
                </select>
                <button type = "button" id="deleteVaxButton"> Delete Vaccine</button>
            
                <label for="deleteDeptName">Delete Department: </label>
                <select id="deleteDeptName">
                    <?php
                        foreach($dno as $d){
                            print("<option value ='{$d['dname']}'>{$d['dname']}</option>");                                           
                        }
                    ?>
                </select>
                <button type="button" id="deleteDeptButton"> Delete Department </button>
            </div>
            <div>
                <label for="addVaxName">Add vaccine: </label>
                <input id="addVaxName" placeholder="Vaccine Name">
                <input id="addCompName" placeholder="Company Name">
                <button type="button" id="addVaxButton"> Add Vaccine </button>

                <label for="addVaccine">Add Department: </label>
                <input id="addDeptName" placeholder="Department Name">
                <button type="button" id="addDeptNameButton"> Add Department </button>
            </div>
            
        </div>
        <script src="./JS/adminpanel.js"></script>
        
    </body>
</html>