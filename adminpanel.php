<?php
    session_start();
    
    if(!isset($_SESSION['id'])){
        header('Location: index.php');
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
?>


<!DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" href="./CSS/adminpanel.css">
    </head>

    <body>

        <ul>
            <li><a id="logout">Logout</a></li>
        </ul>

        <div class="table-div">
            <table>

                <tr>
                    <th class="catagory" colspan="2">Total</th>
                </tr>

                <tr>
                    <th>Total Registered Student</th>
                    <th>Total Registered faculty member</th>
                </tr>

                <tr>
                    <td><?php echo $trs[0]['total']; ?></td>
                    <td><?php echo $trf[0]['total']; ?></td>
                </tr> 

                <tr>
                    <th class="catagory" colspan="2">Male</th>
                </tr>

                <tr>
                    <th>Total Registered Student</th>
                    <th>Total Registered faculty member</th>
                </tr>

                <tr>
                    <td><?php echo $trs[0]['male']; ?></td>
                    <td><?php echo $trf[0]['male']; ?></td>
                </tr>

                <tr>
                    <th class="catagory" colspan="2">Female</th>
                </tr>

                <tr>
                    <th>Total Registered Student</th>
                    <th>Total Registered faculty member</th>
                </tr>

                <tr>
                    <td><?php echo $trs[0]['female']; ?></td>
                    <td><?php echo $trf[0]['female']; ?></td>
                </tr>                  

            </table>
        </div>

        <div class='table-div'>

            <table>

                <tr>
                    <th class='catagory-1' colspan='4'>Student</th>
                </tr>

                <?php
                    for($i = 0; $i<count($fvs); $i++){
                        print("                            
                            <tr>
                                <th class='catagory' colspan='4'>{$fvs[$i]['dept']}</th>
                            </tr>
            
                            <tr>
                                <th>Number of fully vaccinated student</th>
                                <th>Number of student with only 1st dose</th>
                                <th>Number of non vaccinated student</th>
                                <th>Number of total student</th>
                            </tr>
            
                            <tr>
                                <td>{$fvs[$i]['fullVaccinated']}</td>
                                <td>{$hvs[$i]['halfVaccinated']}</td>
                                <td>{$nvs[$i]['notVaccinated']}</td>
                                <td>{$fvs[$i]['total']}</td>
                            </tr>
                        ");
                    }
                ?>
               
            </table>

        </div>

        <div class='table-div'>

            <table>

                <tr>
                    <th class='catagory-1' colspan='4'>Faculty member</th>
                </tr>

                <?php
                    for($i = 0; $i<count($fvf); $i++){
                        print("                            
                            <tr>
                                <th class='catagory' colspan='4'>{$fvs[$i]['dept']}</th>
                            </tr>
            
                            <tr>
                                <th>Number of fully vaccinated student</th>
                                <th>Number of student with only 1st dose</th>
                                <th>Number of non vaccinated student</th>
                                <th>Number of total student</th>
                            </tr>
            
                            <tr>
                                <td>{$fvf[$i]['fullVaccinated']}</td>
                                <td>{$hvf[$i]['halfVaccinated']}</td>
                                <td>{$nvf[$i]['notVaccinated']}</td>
                                <td>{$fvf[$i]['total']}</td>
                            </tr>
                        ");
                    }
                ?>
               
            </table>

        </div>

        <script src="./JS/adminpanel.js"></script>
        
    </body>
</html>