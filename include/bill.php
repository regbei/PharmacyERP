<?php 
if (sizeOf($_SESSION['bill']) == '0') 
{
	$display = 'display:none';
}else
$display ='';
 ?>


<div class="container-sm" id="bill" style="position: absolute;
right: 376px;
top: 122px;
width: 359px;<?php echo $display ?>">
	
	<span class="badge"><input type="text" id="counter" value="<?php echo sizeOf($_SESSION['bill']); ?>" readonly style='width: 33px;color: black;padding:2px;border-radius: 5px;'></span> selected <a href="billing.php"><button class="btn btn-primary btn-sm">عرض الفاتورة</button></a>
<a href='clear.php?url=<?php echo $_SERVER['PHP_SELF']; ?>'><button class="btn btn-danger btn-sm">محدد</button></a>
</div>