<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Method: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");

include("functionWaiter.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];
if ($requestMethod == "GET"){
    if(isset($_GET['id'])){
        
        $waiter = getWaiter($_GET);
        echo $waiter;
    }else{
        $waiterList = getWaiterList();
        echo $waiterList;
    }
    
}else if ($requestMethod == "POST"){
    $inputData = json_decode(file_get_contents("php://input"), true);
    if (empty($inputData)){
        $waiter = createWaiter($_POST);
    }else{
        $waiter = createWaiter($inputData);
    }
    echo $waiter;
}else if ($requestMethod == "PUT"){
    $inputData = json_decode(file_get_contents("php://input"), true);
    if (empty($inputData)){
        $waiter = updateWaiter($_PUT, $_GET);
    }else{
        $waiter = updateWaiter($inputData, $_GET);
    }
    echo $waiter;
}else if ($requestMethod == "DELETE"){
    $deleteWaiter = deleteWaiter($_GET);
    echo $deleteWaiter;
}else{
    $data = [
        'status' => 405,
        'message' => $requestMethod. " Method not alllowed",
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
?>