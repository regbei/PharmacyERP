<?php 
$host = "localhost";
$db = "pharmacy";
$username = "root";
$password = "";
$dsn = "mysql:host=".$host.";dbname=".$db;
$con = new PDO($dsn,$username,$password);
$con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);



//for user informationa making available for all pages

    $array = $con->query("select * from users where id ='$_SESSION[userId]'");
    $user = $array->fetch(PDO::FETCH_ASSOC);

	$base_path = "http://localhost/medical";
?>