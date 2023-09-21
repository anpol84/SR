<html lang="en">
	<head>
	<title>Item</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        color: #333;
        text-align: center;
      }
      
      p {
        margin: 20px 0;
      }
      
      a {
        display: inline-block;
        background-color: #4CAF50;
        color: #fff;
        padding: 8px 16px;
        text-decoration: none;
        border-radius: 4px;
      }
      
      a:hover {
        background-color: #3e8e41;
      }
    </style>
         
	</head>
    
	<body>
		<?php
            $url = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $parts = parse_url($url);
            parse_str($parts['query'], $query);
            $id = $query['id'];
            $sql = "SELECT name, price FROM item WHERE id = $id";
            $conn = new mysqli("db", "user", "password", "appDB");
            $items = mysqli_query($conn, $sql);
            mysqli_close($conn);
            while($item = mysqli_fetch_array($items)) {
                echo "<p>name:{$item['name']}</p><p>price:{$item['price']}</p>";
            }
        ?>
        <a href="index.php">Back</a>
	
	</body>
</html>
