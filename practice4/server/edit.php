<?php
        $url = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parts = parse_url($url);
        parse_str($parts['query'], $query);
        $id = $query['id'];
        $name="";
        $price="";
        $sql = "SELECT name, price FROM item WHERE id = $id";
        $conn = new mysqli("db", "user", "password", "appDB");
        $items = mysqli_query($conn, $sql);
        mysqli_close($conn);
        $prev_name = $prev_price = "";
        while($item = mysqli_fetch_array($items)) {
            $prev_name = $item['name'];
            $prev_price = $item['price'];
        }
        if(isset($_POST["name"])){
  
            $name = $_POST["name"];
        }
        if(isset($_POST["price"])){
            $price = $_POST["price"];
        }
        $sql = "UPDATE item SET name = '$name', price = '$price' WHERE id = $id";
        if ($name != "" && $price != ""){
            $conn = new mysqli("db", "user", "password", "appDB");
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            header('Location: index.php');
        }
    ?>
<html lang="en">
	<head>
	<title>Update item</title>
	<style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      color: #333;
    }
    
    form {
      margin-top: 40px;
      text-align: center;
    }
    
    label {
      display: block;
      margin-bottom: 10px;
    }
    
    input[type="text"] {
      padding: 8px;
      border-radius: 4px;
      border: 1px solid #ccc;
      margin-bottom: 20px;
    }
    
    input[type="submit"] {
      display: inline-block;
      background-color: #4CAF50;
      color: #fff;
      padding: 8px 16px;
      text-decoration: none;
      border-radius: 4px;
    }
    
    input[type="submit"]:hover {
      background-color: #3e8e41;
    }
  </style>	
	</head>
    
	<body>
		<form method="POST">
            <label for = "name" >name</label>
            <input type="text" value = "<?php echo $prev_name;?>" name="name"></input>
            <label for = "price">price</label>
            <input type="text" value = "<?php echo $prev_price;?>" name="price"></input>
            <input type="submit" value = "update"></input>
        </form>
	
	</body>
</html>
