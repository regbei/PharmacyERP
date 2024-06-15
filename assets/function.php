<?php 


function siteTitle()
{	
	global $con;
	$array = $con->query("select * from site where id='1'");
	$row = $array->fetch();
	return $row['title'];
}

function siteName()
{	
	global $con;
	
	$array = $con->query("select * from site where id='1'");
	$row = $array->fetch();
	return $row['name'];
}
function adminName()
{	
	global $con;
	
	$array = $con->query("select * from users where id='$_SESSION[userId]'");
	$row = $array->fetch();
	return $row['name'];
}
function getAdminName($id)
{	
	global $con;
	
	$array = $con->query("select * from users where id='$id'");
	$row = $array->fetch();
	return $row['name'];
}

function getSupplier($id)
{	
	global $con;
	
	$array = $con->query("select `supplier`.`id`,`supplier`.`name` from supplier where id='$id'");
	$row = $array->fetch();
	return $row['name'];
}

function getCompany($id)
{	
	global $con;
	
	$array = $con->query("select * from company where id='$id'");
	$row = $array->fetch();
	return $row['name'];
}

function getProduct($id)
{	
	global $con;
	
	$array = $con->query("select * from inventeries where id='$id'");
	$row = $array->fetch();
	return $row['name'];
}

function getAllCat()
{	
	global $con;
	
	$array = $con->query("SELECT * FROM `categories`");
	while($row = $array->fetch())
	{
		echo "<option value='$row[id]'>$row[name]</option>";
	}
	
}
function supplier()
{	
	global $con;
	
	$array = $con->query("SELECT `supplier`.`name`,  `supplier`.`id` FROM `supplier`");
	while($row = $array->fetch())
	{
		echo "<option value='$row[id]'>$row[name]</option>";
	}
	
}
function company()
{	
	global $con;
	
	$array = $con->query("SELECT `company`.`name`,  `company`.`id` FROM `company`");
	while($row = $array->fetch())
	{
		echo "<option value='$row[id]'>$row[name]</option>";
	}
	
}

 ?>