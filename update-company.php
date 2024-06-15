<?php
session_start();


if ($_SESSION['role'] != 1) {
  header('location:logout.php');
}
include 'assets/db.php';
    $id = $_GET['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $region = $_POST['region'];

    if (isset($_POST['update'])) 
    {
        $stmt = $con->prepare("UPDATE `company` SET `address`= :address, `name`= :name, `region`= :region WHERE `company`.`id` = :id");
        $stmt->execute(['address'=>$address, 'name'=>$name, 'region'=>$region, 'id'=>$id]);

      if ($stmt) {
          header("location:CompanyMange.php");
      }
    
  }


?>