<?php

session_start();

if(!isset($_SESSION['userId']))
{
  header('location:login.php');
}
$f = new NumberFormatter("ar", NumberFormatter::SPELLOUT);
 ?>
<?php require "assets/function.php" ?>
<?php require 'assets/db.php';?>
<!DOCTYPE html>
<html dir="rtl">
<head>
  <title><?php echo siteTitle(); ?></title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.rtl.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <?php 
  
  $notice="";
   ?>
</head>
<body style="background: #ECF0F5;padding:0;margin:0;font-size: 14px;font-weight: bold;">

<div class="container-fluid">
 
<div class="row">
  
  <img src="photo/logo.png" width="150px" class="col-2" height="150px" alt="">

    <div class="col">
      <h3 class="text-center fw-bold"><?= siteTitle(); ?></h3>
      <h3 class="text-center fw-bold">مركز الأمانة</h3>
      <h4 class="text-center fw-bold">فاتورة مبدئية</h4>
    </div>
    <img src="photo/logo.png" width="150px" class="col-2" height="150px" alt="">
    
    
  </div>

  <div class="row">

    <div class="col-md-2 col-sm-6 col-lg-7">
      
        
        <ul class="list-group list-group-flush text-end">
          <li class="nav-link">  التاريخ : <?= date("Y-m-d h:i:s A"); ?> </li>
          <li class="nav-link"> المتحصل : <?= adminName(); ?></li>
        </ul>
        
      </div>
      
      <div class="col-md-6 col-sm-6 col-lg-3">
        
      <ul class="list-group list-group-flush text-start">
        <li class="nav-link">إسم العميل: <?=$_POST['name'];?> </li>
        <li class="nav-link">  الهاتف : <?=$_POST['contact'];?></li>
      </ul>
  
    </div>
    
  </div>
</div>


<div class="container-fluid mt-5">
    <table class="table table-bordered table-responsive" id="table">
      <thead class="table-dark">
        <th width="10px">الرقم</th>
        <th width="200px">الصنف</th>
        <th width="40px">سعر الوحدة</th>
        <th width="20px">الكمية</th>
        <th width="20px">الوحدة</th>
        <th width="20px">الإجمالي</th>
      </thead>
      <tbody>
      <?php
  // $q = $con->query("SELECT * FROM sales WHERE order_id=$order_id");
  
  
        $i=$total=0;
    foreach ($_SESSION['bill'] as $row) 
    {
      $i++;
      echo "<tr>";
      echo "<td>$i</td>";
      echo "<td>$row[name]</td>";
      echo '<td>'.number_format($row['price']).'</td>';
      echo "<td>$row[qty]</td>";
      echo "<td>$row[unit]</td>";
      echo '<td>'.number_format($row['price']*$row['qty']).'</td>';
      echo "</tr>";
      $total = $total + $row['price']*$row['qty'];
    }
    ?>

    
<td>
  <caption>

        إجمالي المبلغ : <?= number_format($total); ?> <br>
    

المبلغ المدفوع : <?= number_format($_POST['paid']); ?><br>
المبلغ كتاباً  :     <?= $f->format($total); ?><br>
المستحق : <?= number_format($_POST['paid']-$total); ?>
</caption>


</td>
        </tbody>
        
      </table>

    
  </div>
   <div class="container-fluid" >
   <div class="row mb-5">


<div class="col-12 d-flex" style="justify-content: space-between;">
<small>
  
  التوقيع : ...................................
 </small>
 <small>
   
   توقيع المستلم : ...................................
 </small>
</div>

</div>
    <div class="col-3">
      <button type="button" onclick="window.print()" class="btn btn-primary d-print-none">طباعة</button>
      <a href="index.php" class="btn btn-primary d-print-none">القائمة الرئيسية</a>
    </div>
      <footer class="sticky-bottom text-center">
        <!-- <small class="">
        
          العنوان : كسلا / خشم القربة /الموقف العام - جنوب صيدلية ديوان الزكاة سابقاً.
          الهاتف : 0121909698 -0916851597-0924966608
        </small> -->
      </footer>
    </div>
<?php 
$total = $total-$_POST['discount'];
$due = $total-$_POST['paid'];
    if (!$con->query("insert into sold (name,contact,discount,amount,paid_amount,due,userId,method) values 
    ('$_POST[name]','$_POST[contact]','$_POST[discount]','$total','$_POST[paid]','$due','$_SESSION[userId]','$_POST[method]')")) 
    {
      echo "Error is:".$con->error;
    }
 $order=$_SESSION['order_id']=$con->lastInsertId();

 foreach ($_SESSION['bill'] as $row) {
   $con->query("INSERT INTO `sales`(`order_id`,`quantity`, `price`, `unit`, `item`) VALUES ('$order','$row[qty]', '$row[price]', '$row[unit]', '$row[name]')");

 }
 if (isset($_POST['billInfo'])) 
  {
    // unset($_SESSION['bill']);
    $_SESSION['bill'] = array();
  }
 ?>
</body>
</html>

 