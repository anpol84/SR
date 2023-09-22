<html lang="en">
	<head>
	<title>Categories</title>
		<style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      color: #333;
    }
    
    h1 {
      text-align: center;
      margin-top: 40px;
      margin-bottom: 40px;
    }
    
    h2 {
      font-size: 24px;
      margin-top: 40px;
      margin-bottom: 20px;
    }
    
    ul {
      list-style-type: none;
      margin-left: 0;
      padding-left: 0;
    }
    
    li {
      margin-bottom: 10px;
    }
    
 
    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 40px;
    }
    
    th, td {
      text-align: left;
      padding: 8px;
    }
    
    th {
      background-color: #333;
      color: #fff;
    }
    
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    a {
      display: inline-block;
      background-color: #333;
      color: #fff;
      padding: 8px 16px;
      text-decoration: none;
      border-radius: 4px;
      margin-right: 10px;
    }
    
    a:hover {
      background-color: #555;
    }
    

    .add-item-button {
      display: inline-block;
      background-color: #4CAF50;
      color: #fff;
      padding: 8px 16px;
      text-decoration: none;
      border-radius: 4px;
      margin-top: 20px;
    }
    
    .add-item-button:hover {
      background-color: #3e8e41;
    }
  </style>   	
	</head>
	<body>
	<table>
		<tr><th>Id</th><th>Name</th><th>Action</th></tr>
		<?php
		$mysqli = new mysqli("db", "user", "password", "appDB");
		$items = mysqli_query($mysqli, "SELECT * FROM category");
		while($item = mysqli_fetch_array($items)) {
			echo "<tr><td>{$item['id']}</td><td>{$item['name']}</td><td>
			<a href='readCategory.php?id=". $item['id'] ."' title='View Item'>read</a>
			<a href='editCategory.php?id=". $item['id'] ."' title='Edit Item'>edit</a>
			<a href='deleteCategory.php?id=". $item['id'] ."' title='Delete Item'>delete</a>
			</td></tr>";
			
		}
		mysqli_close($mysqli);
		
		?>
		</table>

		<a href="createCategory.php" class="add-item-button">Add Category</a>
        <a href="index.php" class="add-item-button">Items</a>
		<a href="contacts.html" class="add-item-button">Contacts</a>
		<a href="information.html" class="add-item-button">Information</a>
	</body>

	
</html>



