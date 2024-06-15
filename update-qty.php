<?php
session_start();


if ($_SESSION['role'] != 1) {
  header('location:logout.php');
}
include 'assets/db.php';
    $id = $_GET['id'];
    $qty = $_POST['quantity'];
    $price = $_POST['price'];
     if (isset($_POST['update'])) 
  {

    $id = $_GET['id'];
    $qty = $_POST['quantity'];
	
    $current = $con->query("SELECT `quantity` FROM `inventeries` WHERE id =$id;");
    
     while ($item = $current->fetch()) {
      $val = $item['quantity'] + $qty;
    
        $con->query("UPDATE `inventeries` SET `quantity` = $val, `price` = $price WHERE `inventeries`.`id` = $id;");
      
    }

	header("location:inventeries.php");
  }


?>