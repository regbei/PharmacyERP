<?php
session_start();

if(!isset($_SESSION['userId']))
{
  header('location:login.php');
}


if ($_SESSION['role'] != 1) {
  header('location:logout.php');
}
 ?>
<?php require "assets/function.php" ?>
<?php require 'assets/db.php';?>
<!DOCTYPE html>
<html>
<head>
  <title><?= siteTitle(); ?></title>
  <?php require "assets/autoloader.php" ?>
  <style type="text/css">
  <?php include 'css/customStyle.css'; ?>

  </style>
  <?php 
  $notice="";

  $last = $con->query("SELECT SUM(total) as total FROM `lastacc`");

  if (isset($_POST['safeIn']))
  {

  }

   ?>
</head>
<body style="padding:0;margin:0">
<?php
include('include/navbar.php');
include('include/sidebar.php'); 

$today = date("Y-m-d");
$month = date("Y-m");
?>

<div class="container">
  <div class="row">
    <div class="col-md-6 col-lg-6">
      
      <?php while($item = $last->fetch()): ?>

    <div class="card border-left-primary shadow py-2 m-4">

          <div class="card-body">
              <div class="row no-gutters align-items-center">

                      <div class="text-start text-lg font-weight-bold text-primary mb-1">قيمة البضاعة داخل المخزن</div>
                      <div class="text-start h5 mb-0 font-weight-bold text-gray-800">$<?= number_format($item['total']); ?></div>
                  
              </div>
          </div>
      </div>

      

    </div>

    <?php endwhile;?>


    <div class="col-md-6 col-lg-6">

<?php $price=$con->Query("SELECT SUM(price) AS total FROM `quick_sales`"); while($item = $price->fetch()): ?>

    <div class="card border-left-success shadow py-2 m-4">

          <div class="card-body">
              
                  <div class="row no-gutters align-items-center">
                        
                    <div class="text-start text-lg font-weight-bold text-success mb-1">إجمالي المبيعات</div>
                    <div class="text-start h5 mb-0 font-weight-bold text-gray-800">$<?= number_format($item['total']); ?></div>
                        
                  </div>
          </div>
      </div>

<?php endwhile;?>

    </div>
    
    <div class="col-md-6 col-lg-6">

<?php $price=$con->Query("SELECT SUM(price) AS total FROM `quick_sales` WHERE date LIKE  '%$today%'"); while($item = $price->fetch()): ?>

    <div class="card border-left-warning shadow py-2 m-4">
          <div class="card-body">
              
                  <div class="row no-gutters align-items-center">
                        
                    <div class="text-start text-lg font-weight-bold text-warning mb-1">مبيعات اليوم</div>
                    <div class="text-start h5 mb-0 font-weight-bold text-gray-800">$<?= number_format($item['total']); ?></div>
                        
                  </div>
          </div>
      </div>

<?php endwhile;?>

    </div>
    <div class="col-md-6 col-lg-6">

<?php $price=$con->Query("SELECT SUM(price) AS total FROM `quick_sales` WHERE date LIKE  '%$month%'"); while($item = $price->fetch()): ?>

    <div class="card border-left-danger shadow py-2 m-4">

          <div class="card-body">
              
                  <div class="row no-gutters align-items-center">
                        
                    <div class="text-start text-lg font-weight-bold text-danger mb-1">مبيعات الشهر</div>
                    <div class="text-start h5 mb-0 font-weight-bold text-gray-800">$<?= number_format($item['total']); ?></div>
                        
                  </div>
          </div>
      </div>

<?php endwhile; $i=0;?>

</div>
    <div class="row mt-4">
  <div class="card">
<h3 class="card-header text-start"> أوشكت على النفاذ</h3>
  <div class="card-body">


  <table class="table table-striped fw-bold text-start" dir="rtl">
    <thead class="table-light">
          <tr>
            <th>#</th>
            <th>إسم المنتج</th>
            <th>الكمية</th>
          </tr>
        </thead>
        
        <tbody>
        <?php $resuilt=$con->Query("SELECT `inventeries`.`name`, `inventeries`.`quantity` FROM `inventeries` WHERE `quantity` < 10"); while($item = $resuilt->fetch()): $i++; ?>
        <tr>
          <td class="table-danger"><?=$i;?></td>
          <td class="table-danger"><?=$item['name'];?></td>
          <td class="table-danger"><?=$item['quantity'];?></td>
        </tr>
        <?php endwhile;?>
      </tbody>
    </table>
    
  </div>
</div>

  </div>

  </div>




</body>
</html>
