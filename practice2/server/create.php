<?php
        $name="";
        $price="";
        if(isset($_POST["name"])){
  
            $name = $_POST["name"];
        }
        if(isset($_POST["price"])){
            $price = $_POST["price"];
        }
        $sql = "INSERT INTO item (name, price) VALUES ('$name', '$price')";
        if ($name != "" && $price != ""){
            $conn = new mysqli("db", "user", "password", "appDB");
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            header('Location: index.php');
        }
    ?>
<html lang="en">
	<head>
	<title>Create item</title>
		<link rel="stylesheet" href="./style.css" type="text/css"/>
        <link rel="stylesheet" href="./button.css" type="text/css"/>
	</head>
    
	<body>
		<form method="POST">
            <label for = "name">name</label>
            <input type="text" name="name"></input>
            <label for = "price">price</label>
            <input type="text" name="price"></input>
            <input type="submit" value = "create"></input>
        </form>
	
	</body>
</html>
