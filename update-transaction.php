<?php
session_start();
include 'assets/db.php';

$id = $_GET['id'];
$method ="تم السداد";
if (isset($_POST['update']))  {
  
  $amnt = $_POST['paid_amount'];
	
  $current = $con->query("SELECT due,paid_amount FROM `sold` WHERE id = $id");
   
     while ($item=$current->fetch()) {
      $due = $item['due'] - $amnt;
	$paid = $item['paid_amount'] + $amnt;
      $con->query("UPDATE `sold` SET `due` = $due, `paid_amount`=$paid, `method`='$method' WHERE `sold`.`id` = $id");
      
    }

	header("location:reports.php");
  }


?>