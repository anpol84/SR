<html lang="en">
	<head>
	<title>Hello world page</title>
		<link rel="stylesheet" href="./style.css" type="text/css"/>
		<link rel="stylesheet" href="./button.css" type="text/css"/>
		<link rel="stylesheet" href="./button.css" type="text/css"/>
	</head>
	<body>
		<table>
			<tr><th>Id</th><th>Name</th><th>Price</th><th>Action</th></tr>
			<?php
				$mysqli = new mysqli("db", "user", "password", "appDB");
				$items = mysqli_query($mysqli, "SELECT * FROM item");
				while($item = mysqli_fetch_array($items)) {
					echo "<tr><td>{$item['id']}</td><td>{$item['name']}</td><td>{$item['price']}</td><td>
					<a href='read.php?id=". $item['id'] ."' title='View Item'>read</a>
					<a href='edit.php?id=". $item['id'] ."' title='Edit Item'>edit</a>
					<a href='delete.php?id=". $item['id'] ."' title='Delete Item'>delete</a>
				  </td></tr>";
					
				}
				mysqli_close($mysqli);
				
			?>
		</table>
		<a href = "create.php" >Add item</a>
	</body>
</html>



