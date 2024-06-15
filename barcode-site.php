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

</head>
<body style="background: #ECF0F5;padding:0;margin:0">
<?php include('include/navbar.php'); include('include/sidebar.php'); ?>
<?php 
  if (isset($_POST['updateBill'])) 
  {

    $id = $_POST['id'];
    $barcode = $_POST['bin'];
    $qty = $_POST['qty'];
    
	
    $current = $con->query("SELECT `quantity` FROM `inventeries` WHERE bin ='$barcode'");

    while ($item = $current->fetch()) {

      if ($item['quantity'] >= $qty) {
        $con->query("UPDATE `inventeries` SET `quantity` = (quantity-$qty) WHERE `inventeries`.`bin` = '$barcode'");
      }else {
        echo "<script>alert('No Enough Balance');</script>";
      }
    }

    foreach ($_SESSION['bill'] as $key => $value) 
    {
      if($_SESSION['bill'][$key]['id'] == $id) $_SESSION['bill'][$key]['qty'] = $qty;
    }
  }
  	$i=0;$total = 0;
    ?>

<body class="p-auto m-auto">
    <div class="container p-1">

        <h3 class="text-center fw-bold">مركز الأمانة التجاري</h3>
        <div class="row text-center ">

            <div class="col-md-12 d-flex justify-content-between">

            <h4 class="fw-bold">فاتورة شرائية</h4>
            <p class="fw-bold ">التاريخ : <?=date("Y-m-d h:i:s");?></p>
        </div>

    </div>
    
    
    </div>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class=" col-md-12 col-lg-12 col-sm-12">
                <div class="card shadow">
                    <div class="card-header d-print-none">
                        <form method="post" action="called_barcode.php" class="d-flex">
                          
                          
                          <div class="input-group input-group-lg">

                            <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-fade fa-barcode"></i></span>
                            
                              <input type="text" minlenght="1" maxlength="100" class="fw-bold form-control" name="barcode" required>

                            </div>

                            <button type="submit" class="btn me-4 btn-primary fw-bold" name="search">إضافة</button>
                        </form>
                    </div>
                    <div class="card-body overflow-auto fw-bolder fs-5">
                       
                        <table class="table text-start" dir="rtl">
                            <thead class="table-dark">
                            <tr>
                                    <th>الرقم</th>
                                    <th>إسم الصنف</th>
                                    <th>الوحدة</th>
                                    <th>سعر الوحدة</th>
                                    <th>سعر الجملة</th>
                                    <th>الكمية</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($_SESSION['bill'])) { foreach ($_SESSION['bill'] as $row){ $i++; ?>
                                <tr>   
                          <td><?=$i?></td>
                          <td><?=$row['name']; ?></td> 
                          <td><?=$row['unit']; ?></td> 
                          <td><?=  number_format($row['price']); ?></td> 
                          <td><?= number_format($row['qty'] * $row['price']); ?></td> 
                          <td class="d-flex p-3" style='width:88px;'><a href="called_barcode.php?remove_product=<?=$row['id']?>"><button class='btn d-print-none btn-danger btn-xs'>إزالة</button></a>
                          
            <form method='POST' class="d-flex">
            <input type='hidden' value="<?=$row['id']?>" name="id">
            <input type='hidden' value="<?=$row['bin']?>" name="bin">
            <input type='hidden' value="<?=$row['unit']?>" name="unit">
            <input type='hidden' value="<?=$row['price']?>" name="price">
            <input type='number' min='1' style='width:88px;' class="form-control text-center fw-bold" value="<?=$row['qty']?>"  name="qty">  <button type="submit" name="updateBill" class='btn d-print-none btn-success btn-sm'>حفظ</button>
            </form>
            </td>
            </tr>         <?php $total = $total + $row['price']*$row['qty']; } } ?>
                            </tbody>
                            <caption class="text-center">المبلغ الإجمالي <?= number_format($total); ?></caption>
                        </table>
                    </div>
                    <div class="card-footer d-print-none">
                        <button type="button" onclick="window.print();" class="btn btn-primary btn-lg">طباعة</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    </body>
    </html>