<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Method: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");

include("functionClient.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];
if ($requestMethod == "GET"){
    if(isset($_GET['id'])){
        
        $waiter = getClient($_GET);
        echo $waiter;
    }else{
        $clientList = getClientList();
        echo $clientList;
    }
    
}else if ($requestMethod == "POST"){
    $inputData = json_decode(file_get_contents("php://input"), true);
    if (empty($inputData)){
        $client = createClient($_POST);
    }else{
        $client = createClient($inputData);
    }
    echo $client;
}else if ($requestMethod == "PUT"){
    $inputData = json_decode(file_get_contents("php://input"), true);
    if (empty($inputData)){
        $client = updateClient($_PUT, $_GET);
    }else{
        $client = updateClient($inputData, $_GET);
    }
    echo $client;
}else if ($requestMethod == "DELETE"){
    $deleteClient = deleteClient($_GET);
    echo $deleteClient;
}else{
    $data = [
        'status' => 405,
        'message' => $requestMethod. " Method not alllowed",
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
?>