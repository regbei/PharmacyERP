<?php
session_start();


if ($_SESSION['role'] != 1) {
  header('location:logout.php');
}
include 'assets/db.php';
    $id = $_GET['id'];
    $username = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    if (isset($_POST['update'])) 
    {
        $stmt = $con->prepare("UPDATE `users` SET `email`= :email, `name`= :name, `role`= :role WHERE `users`.`id` = :id");
        $stmt->execute(['email'=>$email, 'name'=>$username, 'role'=>$role, 'id'=>$id]);

      if ($stmt) {
          header("location:UserMange.php");
      }
    
  }


?>