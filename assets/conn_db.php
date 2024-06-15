<?php
$host = "localhost";
$db = "sms";
$username = "root";
$password = "";
$dsn = "mysql:host=".$host.";dbname=".$db;
$pdo = new PDO($dsn,$username,$password);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);




?>