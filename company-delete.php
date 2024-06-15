<?php 
session_start();

if ($_SESSION['role'] != 1) {
	header('location:logout.php');
  }
include 'assets/db.php';
if (isset($_GET['id'])) 
{
	if ($con->query("DELETE FROM company WHERE id = '$_GET[id]'")) {
		header("location:CompanyMange.php");
	}
	else
		echo "error is:".$con->error;
}


 ?>