<?php

function printJson($code, $message, $data){
    $response = array("data"=>$data, "code"=>$code, "message"=>$message);
    die(json_encode($response));
}
