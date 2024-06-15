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
<body style="padding:0;margin:0">

<?php 
include('include/navbar.php');
include('include/sidebar.php');
  $last = $con->query("select SUM(total) AS amnt from lastAcc");
if (isset($_GET['catId']))
{
  $catId = $_GET['catId'];
  $array = $con->query("select * from categories where id='$catId'");
  $catArray =$array->fetch();
  $catName = $catArray['name'];
  $stockArray = $con->query("select * from inventeries where catId='$catArray[id]'");
 
}
else
{
  $catName = "All Inventeries";
  $stockArray = $con->query("select * from inventeries");
}
  include 'assets/bill.php';
 
  
 
  
   ?>
 <div class="row m-3">
<div class="col-md-3 me-auto">

  <caption><h3 style="font-size: 27px; margin-bottom: 30px; font-weight: bold;" dir="rtl">قيمة البضاعة الحالية  <?php
  while ($balance = $last->fetch()) {
    echo number_format($balance['amnt']);
  }
  ?></h3></caption>
  </div>
  </div>


  <div class="container-fluid">
    <div class="card">
      <h3 class="text-start fw-bold card-header">البضائع</h3>
      <div class="card-body overflow-auto">
      <table id="dataTable" class="table table-hover table-bordered table-striped" style="font-weight: bolder; font-size: 17px">
      <thead class="table-dark">
        <th>#</th>
        <th>إسم</th>
        <th>الوحدة</th>
        <th>سعر الوحدة</th>
        <th>الكمية</th>
        <th>المورد</th>
        <th>الشركة</th>
        <th>الإجمالي</th>
        <th></th>
      </thead>
     <tbody>
      <?php $i=$total=0;
        while ($row = $stockArray->fetch()) 
        {  
          $i=$i+1;
          $id = $row['id'];
        ?>
          <tr>
            <td><?= $i; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['unit']; ?></td>
            <td><?= number_format($row['price']); ?></td>
            <td><?= number_format($row['quantity']); ?></td>
            <td><?= getSupplier($row['supplier']); ?></td>
            <td><?= getCompany($row['company']); ?></td>
            <td><?= number_format($row['quantity'] * $row['price']); ?></td>
           
            <?php 
            if (!empty($_SESSION['bill'])) 
            {
             
            foreach ($_SESSION['bill'] as $key => $value) 
            {
              if (in_array($row['id'], $_SESSION['bill'][$key])) 
              {
                echo "<td>Selected</td>";break;
              }            
               else
               {
              ?>
            <td id='selection<?php echo $i; ?>'><button class="btn btn-primary  btn-sm" onclick="addInBill('<?php echo $id ?>','<?php echo $i; ?>')">تحديد</button></td>
              <?php break;} } } else {?>
              <td id='selection<?php echo $i; ?>'><button class="btn btn-primary btn-sm" onclick="addInBill('<?php echo $id ?>','<?php echo $i; ?>')">تحديد</button></td>
              <?php } ?>
          </tr>
      <?php
        }
       ?>
     </tbody>

    </table>
      </div>
    </div>
  </div>

</body>
</html>

<script type="text/javascript">
  function addInBill(id,place)
  { 
    var value = $("#counter").val();
    value ++;
    var selection = 'selection'+place;
    $("#bill").fadeIn();
    $("#counter").val(value);
    $("#"+selection).html("selected");
    $.post('called.php?q=addtobill',
               {
                   id:id
               }
        );

  }
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
<footer style="min-height: 100vh">
  <!-- جميع الحقوق محفوظة محمد و اسامة &copy; <?= date('Y-m-d');?> -->
</footer>
