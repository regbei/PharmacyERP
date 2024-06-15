<?php
session_start();


if ($_SESSION['role'] != 1) {
  header('location:logout.php');
}
include 'assets/db.php';
    $id = $_GET['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if (isset($_POST['update'])) 
    {
        $stmt = $con->prepare("UPDATE `supplier` SET `phone`= :phone, `name`= :name, `address`= :address WHERE `supplier`.`id` = :id");
        $stmt->execute(['phone'=>$phone, 'name'=>$name, 'address'=>$address, 'id'=>$id]);

      if ($stmt) {
          header("location:SupplierMange.php");
      }
    
  }


?>