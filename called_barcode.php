<?php 
session_start();
include 'assets/bill.php';
include 'assets/db.php';

	if (isset($_POST['search'])) 
	{
		if (!empty($_POST['barcode'])) {
			
			$barcode = $_POST['barcode'];
			$array = $con->query("SELECT * FROM `inventeries` WHERE `inventeries`.`bin` = '$barcode'");
			
		$row = $array->fetch();
		$id = $row['id'];
		$name = $row['name'];
		$price = $row['price'];
		$unit = $row['unit'];
		$qty = '1';
		$item = array(
			'bin' => $barcode,
			'id' => $id,
			'name' => $name,
			'unit' => $unit,
			'price' => $price,
			'qty' => $qty
		);
	}
		
		array_push($_SESSION['bill'],$item);
		header("location:barcode-site.php");
	}

if (isset($_GET['remove_product'])) 
{
	$id = $_GET['remove_product'];
    foreach ($_SESSION['bill'] as $key => $value) 
    {
      if($_SESSION['bill'][$key]['id'] == $id){
      	unset($_SESSION['bill'][$key]);
      	break;
      } 
    }
    header("location:barcode-site.php");
}
 ?>