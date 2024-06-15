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

  <title><?php echo siteTitle(); ?></title>
  <?php require "assets/autoloader.php"; $last = $con->query("select SUM(price) as total From quick_sales"); ?>
  <style type="text/css">
  <?php include 'css/customStyle.css'; ?>

  </style>

</head>
<body style="padding:0;margin:0">
<?php
include('include/navbar.php');
include('include/sidebar.php'); 
?>

  <caption><h3 style="font-size: 27px;margin: 20px;font-weight: bold;" dir="rtl">إجمالي المبلغ <?php
  while ($balance = $last->fetch()) {
    echo number_format($balance['total']);
  }
?></h3></caption>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-lg-12 col-sm-12 overflow-auto">
      <div class="card fw-bold">
        <div class="card-body">
        <table id="dataTable" class="table table-hover table-bordered table-striped w-100" style="z-index: -1">
      <thead class="table-dark">
        <th>#</th>
        <th>الإسم</th>
        <th>الكمية</th>
        <th>المبلغ الإجمالي</th>
        <th>التاريخ و الوقت</th>
        
      </thead>
     <tbody>
      <?php $i=0;
          $array = $con->query("SELECT * FROM quick_sales  ORDER BY date DESC");
        while ($row = $array->fetch()) 
        { 
          $i=$i+1;
          $id = $row['id'];
        ?>
          <tr>
            <td><?= $i; ?></td>
            <td><?= getProduct($row['product_id']); ?></td>
            <td><?= number_format($row['quantity']); ?></td>
            <td><?= number_format($row['price']); ?></td>
            <td><?= $row['date']; ?></td>

            
          </tr>
      <?php
        }
       ?>
     </tbody>
    </table>
        </div>
      </div>
      </div>
    </div>
  </div>                      


</body>
</html>

<script type="text/javascript">

  $(document).ready(function()
  {
    $(".rightAccount").click(function(){$(".account").fadeToggle();});
    $("#dataTable").DataTable({
                dom: 'Bfrtip',
                    buttons: [
                      'print'
                    ]
               });
   
  });
</script>

<script src="js/dataTables.buttons.min.js"></script>
  <script src="js/buttons.print.min.js"></script>