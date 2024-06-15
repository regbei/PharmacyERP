<?php
session_start();
// error_reporting(0);
if(!isset($_SESSION['userId']))
{
  header('location:login.php');
}
if(isset($_GET['order_id'])) {
$order_id = $_GET['order_id'];
}else{
  
  header('location:index.php');
}
$f = new NumberFormatter("ar", NumberFormatter::SPELLOUT);
 ?>
<?php require "function.php" ?>
<?php require 'db.php';?>
<!DOCTYPE html>
<html dir="rtl">
<head>
  <title><?= siteTitle(); ?></title>
  
<link rel="stylesheet" type="text/css" href="../css/bootstrap.rtl.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../font-awesome/css/font-awesome.min.css">

  <?php 
  $client = $con->query("SELECT * FROM sold WHERE id=$order_id");
  $notice="";
   ?>
</head>
<body style="padding:0;margin:0;font-size: 14px;font-weight: bolder !important; color: black;">

<div class="container-fluid">
 
<div class="row">
    <img src="../photo/logo.png" width="150px" class="col-2" height="150px" alt="">
    <div class="col">
      <h3 class="text-center fw-bold"><?= siteTitle(); ?></h3>
      <h3 class="text-center fw-bold">مركز الأمانة التجاري</h3>
      <h4 class="text-center fw-bold">فاتورة مبدئية</h4>
    </div>
    <img src="../photo/logo.png" width="150px" class="col-2" height="150px" alt="">
    
    
  </div>

  <div class="row">

    <div class="col-md-2 col-sm-6 col-lg-7">
      
      <?php while ($k = $client->fetch()){ ?>    
        <ul class="list-group list-group-flush text-end">
          <li class="nav-link">  رقم الفاتورة : <?=$order_id ?></li>
          <li class="nav-link">  التاريخ : <?= ( $k['date']); ?> </li>
          <li class="nav-link"> المتحصل : <?= getAdminName($k['userId']); ?></li>
        </ul>
        
      </div>
      
      <div class="col-md-6 col-sm-6 col-lg-3">
        
      <ul class="list-group list-group-flush text-start">
        <li class="nav-link">إسم العميل: <?=$k['name'];?> </li>
        <li class="nav-link">  الهاتف : <?=$k['contact'];?></li>
      </ul>
  <?php } ?>
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
    <!-- <img src="../photo/logo.jpg" width="150px" class="col-2" height="150px" style="position: absolute; position: absolute;filter: opacity(23%);left: 53em;width: 16cm;height: 16cm;"> -->
      
      <tbody>
      <?php
  $q = $con->query("SELECT * FROM sales WHERE order_id=$order_id");
  
  
        $i=$total=0;
    foreach ($q as $row) 
    {
      $i++;
      echo "<tr>";
      echo "<td>$i</td>";
      echo "<td>$row[item]</td>";
      echo '<td>'.number_format($row['price']).'</td>';
      echo "<td>$row[quantity]</td>";
      echo "<td>$row[unit]</td>";
      echo '<td>'.number_format($row['price']*$row['quantity']).'</td>';
      echo "</tr>";
      $total = $total + $row['price']*$row['quantity'];
    }
    ?>

    
<td>
  <caption>

        إجمالي المبلغ : <?= number_format($total); ?> <br>
        <?php $q = $con->query("SELECT * FROM sold WHERE id=$order_id");
  while($r =$q->fetch()){
    ?>
المبلغ المدفوع : <?= number_format($r['paid_amount']); ?><br>
المبلغ كتاباً  :     <?= $f->format($total); ?><br>
المستحق : <?= number_format($r['due']); ?>

</caption>
<?php } ?>

</td>
        </tbody>
        
      </table>

    
  </div>
   <div class="container-fluid" >
   <div class="row mb-5">


       <div class="col-12 d-flex" style="justify-content: space-between;">
       <h5>
         
         التوقيع : ...................................
        </h5>
        <h5>
          
          توقيع المستلم : ...................................
        </h5>
     </div>

    </div>

     <div class="col-3">
       <button type="button" onclick="window.print()" class="btn btn-primary d-print-none">طباعة</button>
       <a href="../index.php" class="btn btn-primary d-print-none">القائمة الرئيسية</a>
       
    </div>
      <footer class="sticky-bottom text-center">
        <!-- <small class="">
        
          العنوان : كسلا / خشم القربة /الموقف العام - جنوب صيدلية ديوان الزكاة سابقاً.
          الهاتف : 0121909698 -0916851597-0924966608
        </small> -->
      </footer>
    </div>
  <script src='js/jquery.js'></script>
  <script src='js/bootstrap.bundle.js'></script>
  <script src='js/bootstrap.min.js'></script>
</body>
</html>
