<?php
            $url = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $parts = parse_url($url);
            parse_str($parts['query'], $query);
            $id = $query['id'];
        
            $sql = "DELETE FROM category WHERE id = $id";
            $conn = new mysqli("db", "user", "password", "appDB");
    
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            header('Location: indexCategory.php');
            
?>
<html></html>