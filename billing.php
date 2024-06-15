<?php
session_start();

if(!isset($_SESSION['userId']))
{
  header('location:login.php');
}
 ?>
<?php require "assets/function.php" ?>
<?php require 'assets/db.php';?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo siteTitle(); ?></title>
  <?php require "assets/autoloader.php" ?>
  <style type="text/css">
  <?php include 'css/customStyle.css'; ?>

  </style>
  <?php 
  $notice="";
  if (isset($_POST['safeIn'])) 
  {
    $filename = $_FILES['inPic']['name'];
    move_uploaded_file($_FILES["inPic"]["tmp_name"], "photo/".$_FILES["inPic"]["name"]);
    if ($con->query("insert into categories (name,pic) value ('$_POST[inName]','$filename')")) {
      $notice ="<div class='alert alert-success'>Successfully Saved</div>";
    }
    else
      $notice ="<div class='alert alert-danger'>Not saved Error:".$con->error."</div>";
  }

   ?>
</head>
<body style="background: #ECF0F5;padding:0;margin:0">
<?php include('include/navbar.php'); include('include/sidebar.php'); ?>


  <div class="container-fluid">

    <?php echo $notice; ?>
    <div class="row">
      <div class="col-12 text-center">
        
        <span style="font-size: 16pt;color: #333333"><?= siteTitle();?> </span><br>
        <span style="font-size: 16pt;color: #333333">إيصال بيع </span><br>
      </div>
      <div class="col-12">

        <span style="font-size: 16pt;color: #333333"><?= date("Y-m-d h:i:s m"); ?> </span>
      </div>
    </div>

  <?php 
  if (isset($_POST['updateBill'])) 
  {

    $id = $_POST['id'];
    $qty = $_POST['qty'];
    
	
    $current = $con->query("SELECT `quantity` FROM `inventeries` WHERE id =$id");

    while ($item = $current->fetch()) {
      $val = $item['quantity'] - $qty;

      if ($item['quantity'] >= $qty) {
        $con->query("UPDATE `inventeries` SET `quantity` = $val WHERE `inventeries`.`id` = $id");
      }else {
        echo  "<script>alert('No Enough Balance');</script>";
      }
    }

    foreach ($_SESSION['bill'] as $key => $value) 
    {
      if($_SESSION['bill'][$key]['id'] == $id) $_SESSION['bill'][$key]['qty'] = $qty;
    }
  }
  	$i=0;$total = 0;
    ?>
    <br>
    <table class="table table-hover fw-bold table-striped table-bordered" style="width: 55%;margin: auto;">
    	<tr>
    		<th>#</th>
    		<th>الإسم</th>
    		<th>سعر الوحدة</th>
    		<th>سعر الوحدة</th>
        <th class="d-print-none">حذف</th>
    		<th class="d-print-none">تحديد الكمية</th>
    	</tr>
    <?php
    foreach ($_SESSION['bill'] as $row) 
    {
      $i++;
      echo "<tr>";
      echo "<td>$i</td>";
      echo "<td>$row[name]</td>";
      echo "<td>$row[unit]</td>";
      echo "<td>SDG. $row[price]</td>";
      echo "<td><a href='called.php?remove=$row[id]'><button class='btn d-print-none btn-danger btn-xs'>إزالة</button></a></td>";
      echo "<td> 
            <form method='POST'>
            <input type='hidden' value='$row[id]' name='id'>
            <input type='hidden' value='$row[unit]' name='unit'>
            <input type='hidden' value='$row[price]' name='price'>
            <input type='number' min='1' class='form-control input-sm d-print-none  pull-left' value ='$row[qty]' style='width:88px;' name='qty'>  <button type='submit' name='updateBill' style='margin-left:5px; font-size: 17px' class='btn d-print-none btn-success btn-sm'>حفظ</button>
            </form>
            </td>";
      echo "</tr>";
      $total = $total + $row['price']*$row['qty'];
    }
  ?>
  <tr>
    <td colspan="2">المبلغ الإجمالي</td>
    <td colspan="2"><strong>SDG.<?= number_format($total) ?></strong></td>
    <td><button class="btn btn-primary d-print-none" data-bs-toggle="modal" data-bs-target="#billOut">حفظ</button></td>
    <td><button class="btn btn-primary d-print-none" onclick="window.print()" >طباعة</button></td>
  </tr>
</table>
<?php 
  if (isset($_POST['updateBill'])) 
  {

    $id = $_POST['id'];
    $qty = $_POST['qty'];
    $unit = $_POST['unit'];
    $price = $_POST['price'];

      $total = $qty*$price;

      if($_SESSION['bill'][$key]['id'] == $id) $_SESSION['bill'][$key]['qty'] = $qty;
      $sql = "INSERT INTO `quick_sales` (`quantity`, `price`, `unit`, `product_id`) VALUES (:qty, :price, :unit, :id)";
      $query = $con->prepare($sql);
      $done = $query->execute(['qty'=>$qty,'price'=>$total,'unit'=>$unit,'id'=>$id]);

    
      
  }

?>

</div>
</div>

<div id="billOut" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">بيانات العميل</h4>
      </div>
      <div class="modal-body">
         <form method="POST" action="billout.php">
    
         
          <div class="col-md-12 mb-3">
            <label for="some" class="form-label fw-bold text-start w-100">إسم العميل</label>
            <input type="text" name="name" class="form-control" id="some" required>
          </div>

          <div class="col-md-12 mb-3">
            <label for="some" class="form-label fw-bold text-start w-100">المبلغ الإجمالي</label>
            <input type="number" value="<?= $total ?>" class="form-control" id="some" readonly>
          </div>

          <div class="col-md-12 mb-3">
            <label for="some" class="form-label fw-bold text-start w-100">المبلغ المدفوع</label>
            <input type="number" name="paid"  class="form-control" id="some">
          </div>
          <div class="col-md-12 mb-3">
            <label for="some" class="form-label fw-bold text-start w-100">طريقة الدفع</label>
            <select name="method"  class="form-control" id="some">
              <option value="كاش">كاش</option>
              <option value="بنكك">بنكك</option>
              <option value="أجل">أجل</option>
              <option value="شيك">شيك</option>
            </select>
          </div>


          <div class="col-md-12 mb-3">
            <label for="some" class="form-label fw-bold text-start w-100">رقم التواصل</label>
            <input type="text" name="contact" class="form-control" id="some" required>
          </div>
           <div class="col-md-12 mb-3">
            <label for="some" class="form-label fw-bold" text-start w-100>التخفيض</label>
            <input type="text" name="discount" value="0" min="1" class="form-control" id="some" required>
          </div>
       
        </div>
        
      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إلغاء</button>
        <button type="submit" class="btn btn-primary" name="billInfo">عرض الفاتورة</button>
      </div>
    </form>
    </div>

  </div>
</div>

</body>
</html>

<script type="text/javascript">

</script>

