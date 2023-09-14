<?php

$host = "db";
$username = "user";
$password = "password";
$dbname = "appDB";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

?>