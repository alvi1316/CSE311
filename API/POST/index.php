<?php

    require_once('../../dbmanager.php');

    function printJson($code, $message, $data){
        $response = array("data"=>$data, "code"=>$code, "message"=>$message);
        die(json_encode($response));
    }

    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true);

    $requestType = $decoded["requestType"] ?? null;

    if($requestType === 'login'){

        $id = $decoded["id"] ?? null;
        $password = $decoded["password"] ?? null;
        $db = new dbmanager();

        if($db->studentSignin($id, $password)){
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
            $_SESSION['id'] = $id;
            printJson(200, "OK", true);
        }else{
            printJson(404, "Not Found", null);
        }

    }if($requestType === 'logout'){
        session_start();
        session_destroy();
        printJson(200, "OK", true);

    }else if($requestType === 'signup'){

        $id = $decoded["id"] ?? null;
        $password = $decoded["password"] ?? null;
        $email = $decoded["email"] ?? null;
        $name = $decoded["name"] ?? null;
        $dno = $decoded["dno"] ?? null;
        $gender = $decoded["gender"] ?? null;
        $db = new dbmanager();
        
        if($db->studentSignup($id,$password,$email,$name,$dno,$gender)){
            printJson(200, "OK", true);
        }else{
            printJson(404, "Not Found", null);
        }     

    }else if($requestType === 'getDno'){

        $db = new dbmanager();
        $data = $db->getAllDepartment();
        printJson(200, "OK", $data);        

    }else{
        printJson(404, "Not Found", null);
    }
    