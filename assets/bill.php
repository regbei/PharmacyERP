<?php 
if (sizeOf($_SESSION['bill']) == '0') 
{
	$display = 'display:none';
}else
$display ='';
 ?>


<div class="well well-sm" id="bill" style="position: absolute;right: 22cm;top: 3cm;width: 294px;<?php echo $display ?>">
	
	<span class="badge"><input type="text" id="counter" value="<?php echo sizeOf($_SESSION['bill']); ?>" readonly style='width: 33px;color: black;padding:2px;border-radius: 5px;'></span> تم التحديد <a href="billing.php"><button class="btn btn-primary btn-xs">عرض</button></a>
<a href='clear.php?url=<?php echo $_SERVER['PHP_SELF']; ?>'><button class="btn btn-danger btn-xs">إلغاء</button></a>
</div>