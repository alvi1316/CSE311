<?php

    require_once('../../dbmanager.php');

    function printJson($code, $message, $data){
        $response = array("data"=>$data, "code"=>$code, "message"=>$message);
        die(json_encode($response));
    }

    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true);

    $requestType = $decoded["requestType"] ?? null;

    if($requestType === 'studentLogin'){

        $id = $decoded["id"] ?? null;
        $password = $decoded["password"] ?? null;
        $db = new dbmanager();

        if($db->studentSignin($id, $password)){
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['userType'] = 'student';
            printJson(200, "OK", true);
        }else{
            printJson(404, "Not Found", null);
        }

    }if($requestType === 'facultyLogin'){

        $id = $decoded["id"] ?? null;
        $password = $decoded["password"] ?? null;
        $db = new dbmanager();

        if($db->staffSignin($id, $password)){
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['userType'] = 'faculty-member';
            printJson(200, "OK", true);
        }else{
            printJson(404, "Not Found", null);
        }

    }if($requestType === 'adminLogin'){

        $id = $decoded["id"] ?? null;
        $password = $decoded["password"] ?? null;
        $db = new dbmanager();

        if($db->adminSignin($id, $password)){
            session_start();
            $_SESSION['adminId'] = $id;
            printJson(200, "OK", true);
        }else{
            printJson(404, "Not Found", null);
        }

    }if($requestType === 'logout'){
        session_start();
        session_destroy();
        printJson(200, "OK", true);

    }else if($requestType === 'studentSignup'){

        $id = $decoded["id"] ?? null;
        $password = $decoded["password"] ?? null;
        $email = $decoded["email"] ?? null;
        $name = $decoded["name"] ?? null;
        $dno = $decoded["dno"] ?? null;
        $gender = $decoded["gender"] ?? null;
        $nid = $decoded["nid"] ?? null;
        $bid = $decoded["bid"] ?? null;
        $db = new dbmanager();
        
        if($db->studentSignup($id,$password,$email,$name,$dno,$nid,$bid,$gender)){
            printJson(200, "OK", true);
        }else{
            printJson(404, "Not Found", null);
        }     

    }else if($requestType === 'facultySignup'){

        $id = $decoded["id"] ?? null;
        $password = $decoded["password"] ?? null;
        $email = $decoded["email"] ?? null;
        $name = $decoded["name"] ?? null;
        $dno = $decoded["dno"] ?? null;
        $gender = $decoded["gender"] ?? null;
        $nid = $decoded["nid"] ?? null;
        $bid = $decoded["bid"] ?? null;
        $db = new dbmanager();
        
        if($db->staffSignup($id,$password,$email,$name,$dno,$nid,$bid,$gender)){
            printJson(200, "OK", true);
        }else{
            printJson(404, "Not Found", null);
        }     

    }else if($requestType === 'studentUpdate'){
        session_start();
        $id = $_SESSION['id'] ?? null;
        $name = $decoded["name"] ?? null;
        $email = $decoded["email"] ?? null;
        $phone = $decoded["phone"] ?? null;
        $city = $decoded["city"] ?? null;
        $dob = $decoded["dob"] ?? null;
        $gender = $decoded["gender"] ?? null;
        $nid = $decoded["nid"] ?? null;
        $bid = $decoded["bid"] ?? null;
        $dno = $decoded["dno"] ?? null;
        $vax = $decoded["vax"] ?? null;
        $dofd = $decoded["dofd"] ?? null;
        $dosd = $decoded["dosd"] ?? null;
        $doseTaken = 0;

        if($dofd !== null){
            $doseTaken = $doseTaken + 1;
        }

        if($dosd !== null){
            $doseTaken = $doseTaken + 1;
        }
        
        $db = new dbmanager();

        if($db->updateStudentProfile($id,$dno,$vax,$doseTaken,$dofd,$dosd,$name,$email,$phone,$city,$nid,$dob,$bid,$gender)){
            printJson(200, "OK", true);
        }else{
            printJson(404, "Not Found", false);
        }    

    }else if($requestType === 'facultyUpdate'){

        session_start();
        $id = $_SESSION['id'] ?? null;
        $name = $decoded["name"] ?? null;
        $email = $decoded["email"] ?? null;
        $phone = $decoded["phone"] ?? null;
        $city = $decoded["city"] ?? null;
        $dob = $decoded["dob"] ?? null;
        $gender = $decoded["gender"] ?? null;
        $nid = $decoded["nid"] ?? null;
        $bid = $decoded["bid"] ?? null;
        $dno = $decoded["dno"] ?? null;
        $vax = $decoded["vax"] ?? null;
        $dofd = $decoded["dofd"] ?? null;
        $dosd = $decoded["dosd"] ?? null;
        $doseTaken = 0;

        if($dofd !== null){
            $doseTaken = $doseTaken + 1;
        }

        if($dosd !== null){
            $doseTaken = $doseTaken + 1;
        }
        
        $db = new dbmanager();
        if($db->updateStaffProfile($id,$dno,$vax,$doseTaken,$dofd,$dosd,$name,null,$email,$phone,$city,$nid,$dob,$bid,$gender)){
            printJson(200, "OK", true);
        }else{
            printJson(404, "Not Found", false);
        }         

    }else if($requestType === 'deleteStudentAccount'){
        
        session_start();
        $id = $_SESSION["id"] ?? null;
        $db = new dbmanager();
        if($db->deleteStudentAccount($id)){
            printJson(200, "OK", true);  
        }else{
            printJson(404, "Not Found", false);
        }

    }else if($requestType === 'deleteFacultyAccount'){

        session_start();
        $id = $_SESSION["id"] ?? null;
        $db = new dbmanager();
        if($db->deleteStaffAccount($id)){
            printJson(200, "OK", true);  
        }else{
            printJson(404, "Not Found", false);
        }      

    }else if($requestType === 'studentUpdatePassword'){

        session_start();
        $id = $_SESSION["id"] ?? null;
        $oldPassword = $decoded["oldPassword"] ?? null;
        $newPassword = $decoded["newPassword"] ?? null;

        $db = new dbmanager();
        if($db->studentChangePassword($id,$oldPassword,$newPassword)){
            printJson(200, "OK", true);  
        }else{
            printJson(404, "Not Found", false);
        }      

    }else if($requestType === 'facultyUpdatePassword'){

        session_start();
        $id = $_SESSION["id"] ?? null;
        $oldPassword = $decoded["oldPassword"] ?? null;
        $newPassword = $decoded["newPassword"] ?? null;

        $db = new dbmanager();
        if($db->staffChangePassword($id,$oldPassword,$newPassword)){
            printJson(200, "OK", true);  
        }else{
            printJson(404, "Not Found", false);
        }      

    }else if($requestType === 'getDno'){

        $db = new dbmanager();
        $data = $db->getAllDepartment();
        printJson(200, "OK", $data);        

    }else if($requestType === 'addVax'){

        $vaxName = $decoded["vaxName"] ?? null;
        $company = $decoded["company"] ?? null;

        $db = new dbmanager();
        $data = $db->setVaccine($vaxName,$company);
        printJson(200, "OK", $data);        

    }else if($requestType === 'addDept'){
        $dname = $decoded["dname"] ?? null;
        $db = new dbmanager();
        $data = $db->setDepartment($dname);
        printJson(200, "OK", $data);        

    }else if($requestType === 'deleteVax'){
        $vaxName = $decoded["vaxName"] ?? null;
        $db = new dbmanager();
        $data = $db->removeVaccine($vaxName);
        printJson(200, "OK", $data);        

    }else if($requestType === 'deleteDept'){
        $dname = $decoded["dname"] ?? null;
        $db = new dbmanager();
        $data = $db->removeDepartment($dname);
        printJson(200, "OK", $data);        

    }else{
        printJson(404, "Not Found", null);
    }
    