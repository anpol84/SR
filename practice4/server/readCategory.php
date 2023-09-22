<html lang="en">
	<head>
	<title>Category</title>
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
            $sql = "SELECT name FROM category WHERE id = $id";
            $sql2 = "SELECT i.name name FROM category c JOIN item i on c.id = i.category_id WHERE c.id = $id";
            $conn = new mysqli("db", "user", "password", "appDB");
            $items = mysqli_query($conn, $sql);
            $i = mysqli_query($conn, $sql2);
            mysqli_close($conn);
            while($item = mysqli_fetch_array($items)) {
                echo "<p>name:{$item['name']}</p>";
            }
            echo "<p>Items</p>";
            while($i2 = mysqli_fetch_array($i)) {
                echo "<p>{$i2['name']}</p>";
            }
        ?>
        <a href="indexCategory.php">Back</a>
	
	</body>
</html>
