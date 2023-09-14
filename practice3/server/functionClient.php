<?php
require "database.php";
error_reporting(0);

function error($message){
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("HTTP/1.0 500 Unprocessable Entity");
    echo json_encode($data);
    exit(); 
}


function getClientList(){
    global $conn;
    $sql = "SELECT * FROM client;";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run){
        if (mysqli_num_rows($query_run) > 0){
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' => "Clients Fetched Successfully",
                'data' => $res,
            ];
            header("HTTP/1.0 200 OK");
            echo json_encode($data);
        }else{
            $data = [
                'status' => 404,
                'message' => "Clients Not Founded",
            ];
            header("HTTP/1.0 404 Not Founded");
            echo json_encode($data);
        }

    }else{
        $data = [
            'status' => 500,
            'message' => "Internal Server Error",
        ];
        header("HTTP/1.0 500 Internal Server Error");
        echo json_encode($data);
    }
}

function createClient($clientInput){
    global $conn;

    $name = mysqli_real_escape_string($conn, $clientInput['name']);
    $table_number = mysqli_real_escape_string($conn, $clientInput['table_number']);
    $waiter_id = mysqli_real_escape_string($conn, $clientInput['waiter_id']);

    if (empty(trim($name))){
        return error('Enter name');
    }else if (empty(trim($table_number))){
        return error('Enter table number');
    }else if (empty(trim($waiter_id))){
        return error('Enter waiter id');
    }else{
        $sql = "INSERT INTO client (name, table_number, waiter_id) VALUES ('$name', '$table_number', '$waiter_id');";
        $res = mysqli_query($conn, $sql);

        if ($res){
            $data = [
                'status' => 201,
                'message' => "Client Created Successfully",
            ];
            header("HTTP/1.0 201 Created");
            echo json_encode($data);
        }else{
            $data = [
                'status' => 500,
                'message' => "Internal Server Error",
            ];
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode($data);
        }
        
    }

}

function getClient($clientParams){
    global $conn;

    if ($clientParams['id'] == null){
        return error('Enter client id');
    }

    $client_id = mysqli_real_escape_string($conn, $clientParams['id']);
    

    $sql = "SELECT * FROM client WHERE id = '$client_id'";
    $result = mysqli_query($conn, $sql);

    if ($result){
        if (mysqli_num_rows($result) == 1){
            $res = mysqli_fetch_assoc($result);
            $data = [
                'status' => 200,
                'message' => "Client Fetched Successfully",
                'data' => $res,
            ];
            header("HTTP/1.0 200 OK");
            echo json_encode($data);
        }else{
            $data = [
                'status' => 404,
                'message' => "Client Not Founded",
            ];
            header("HTTP/1.0 404 Not Founded");
            echo json_encode($data);
        }
        
    }else{
        $data = [
            'status' => 500,
            'message' => "Internal Server Error",
        ];
        header("HTTP/1.0 500 Internal Server Error");
        echo json_encode($data);
    }
}

function updateClient($clientInput, $clientParams){
    global $conn;
    if (!isset($clientParams['id'])){
        return error('id not founded in URL');
    }else if ($clientParams['id'] == null){
        return error('Enter id');
    }

    $id = mysqli_real_escape_string($conn, $clientParams['id']);
    $name = mysqli_real_escape_string($conn, $clientInput['name']);
    $table_number = mysqli_real_escape_string($conn, $clientInput['table_number']);
    $waiter_id = mysqli_real_escape_string($conn, $clientInput['waiter_id']);

    if (empty(trim($name))){
        return error('Enter name');
    }else if (empty(trim($table_number))){
        return error('Enter table number');
    }else if (empty(trim($waiter_id))){
        return error('Enter waiter id');
    }else{
        $sql = "UPDATE client SET name = '$name', table_number = '$table_number', waiter_id = '$waiter_id' WHERE id = '$id';";
        $res = mysqli_query($conn, $sql);
        $affectedRows = mysqli_affected_rows($conn);
        if ($affectedRows == 0){
            $data = [
                'status' => 404,
                'message' => "Client Not Founded",
            ];
            header("HTTP/1.0 404 Not Founded");
            echo json_encode($data);
        }else if ($res){
            $data = [
                'status' => 200,
                'message' => "Client Updated Successfully",
            ];
            header("HTTP/1.0 201 Success");
            echo json_encode($data);
        }else{
            $data = [
                'status' => 500,
                'message' => "Internal Server Error",
            ];
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode($data);
        }
        
    }
}
function deleteClient($clientParams){
    global $conn;
    if (!isset($clientParams['id'])){
        return error('id not founded in URL');
    }else if ($clientParams['id'] == null){
        return error('Enter id');
    }

    $id = mysqli_real_escape_string($conn, $clientParams['id']);
    $sql = "DELETE FROM client WHERE id='$id'";
    $res = mysqli_query($conn, $sql);
    $affectedRows = mysqli_affected_rows($conn);
    if ($affectedRows == 0){
        $data = [
            'status' => 404,
            'message' => "Client Not Founded",
        ];
        header("HTTP/1.0 404 Not Founded");
        echo json_encode($data);
    }else if ($res){
        $data = [
            'status' => 204,
            'message' => "Client Deleted Successfully",
        ];
        header("HTTP/1.0 201 Success");
        echo json_encode($data);
    }else{
        $data = [
            'status' => 500,
            'message' => "Internal Server Error",
        ];
        header("HTTP/1.0 500 Internal Server Error");
        echo json_encode($data);
    }
}
?>