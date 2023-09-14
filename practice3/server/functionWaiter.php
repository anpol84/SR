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


function getWaiterList(){
    global $conn;
    $sql = "SELECT * FROM waiter;";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run){
        if (mysqli_num_rows($query_run) > 0){
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' => "Waiters Fetched Successfully",
                'data' => $res,
            ];
            header("HTTP/1.0 200 OK");
            echo json_encode($data);
        }else{
            $data = [
                'status' => 404,
                'message' => "Waiters Not Founded",
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

function createWaiter($waiterInput){
    global $conn;

    $name = mysqli_real_escape_string($conn, $waiterInput['name']);
    $salary = mysqli_real_escape_string($conn, $waiterInput['salary']);

    if (empty(trim($name))){
        return error('Enter name');
    }else if (empty(trim($salary))){
        return error('Enter salary');
    }else{
        $sql = "INSERT INTO waiter (name, salary) VALUES ('$name', '$salary');";
        $res = mysqli_query($conn, $sql);

        if ($res){
            $data = [
                'status' => 201,
                'message' => "Waiter Created Successfully",
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

function getWaiter($waiterParams){
    global $conn;

    if ($waiterParams['id'] == null){
        return error('Enter waiter id');
    }

    $waiter_id = mysqli_real_escape_string($conn, $waiterParams['id']);
    

    $sql = "SELECT * FROM waiter WHERE id = '$waiter_id'";
    $result = mysqli_query($conn, $sql);

    if ($result){
        if (mysqli_num_rows($result) == 1){
            $res = mysqli_fetch_assoc($result);
            $data = [
                'status' => 200,
                'message' => "Waiter Fetched Successfully",
                'data' => $res,
            ];
            header("HTTP/1.0 200 OK");
            echo json_encode($data);
        }else{
            $data = [
                'status' => 404,
                'message' => "Waiter Not Founded",
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

function updateWaiter($waiterInput, $waiterParams){
    global $conn;
    if (!isset($waiterParams['id'])){
        return error('id not founded in URL');
    }else if ($waiterParams['id'] == null){
        return error('Enter id');
    }

    $id = mysqli_real_escape_string($conn, $waiterParams['id']);
    $name = mysqli_real_escape_string($conn, $waiterInput['name']);
    $salary = mysqli_real_escape_string($conn, $waiterInput['salary']);

    if (empty(trim($name))){
        return error('Enter name');
    }else if (empty(trim($salary))){
        return error('Enter salary');
    }else{
        $sql = "UPDATE waiter SET name = '$name', salary = '$salary' WHERE id = '$id';";
        $res = mysqli_query($conn, $sql);
        $affectedRows = mysqli_affected_rows($conn);
        if ($affectedRows == 0){
            $data = [
                'status' => 404,
                'message' => "Waiter Not Founded",
            ];
            header("HTTP/1.0 404 Not Founded");
            echo json_encode($data);
        }else if ($res){
            $data = [
                'status' => 200,
                'message' => "Waiter Updated Successfully",
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
function deleteWaiter($waiterParams){
    global $conn;
    if (!isset($waiterParams['id'])){
        return error('id not founded in URL');
    }else if ($waiterParams['id'] == null){
        return error('Enter id');
    }

    $id = mysqli_real_escape_string($conn, $waiterParams['id']);
    $sql = "DELETE FROM waiter WHERE id='$id'";
    $res = mysqli_query($conn, $sql);
    $affectedRows = mysqli_affected_rows($conn);
    if ($affectedRows == 0){
        $data = [
            'status' => 404,
            'message' => "Waiter Not Founded",
        ];
        header("HTTP/1.0 404 Not Founded");
        echo json_encode($data);
    }else if ($res){
        $data = [
            'status' => 204,
            'message' => "Waiter Deleted Successfully",
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