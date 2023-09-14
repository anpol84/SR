<html lang="en">
	<head>
	<title>Item</title>
		<link rel="stylesheet" href="./style.css" type="text/css"/>
        <link rel="stylesheet" href="./button.css" type="text/css"/>
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
