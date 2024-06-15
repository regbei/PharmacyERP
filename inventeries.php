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
      <h3 class="text-start fw-bold card-header">المخزن</h3>
     
      <div class="card-body overflow-auto">
      <table id="dataTable" class="table table-hover table-bordered table-striped" style="font-weight: bolder; font-size: 17px">
      <thead class="table-dark">
        <th>#</th>
        <th>رقم المنتج</th>
        <th>إسم</th>
        <th>الوحدة</th>
        <th>سعر الوحدة</th>
        <th>الكمية</th>
        <th>المورد</th>
        <th>الشركة</th>
        <th>الإجمالي</th>
        <th></th>
        <th></th>
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
            <td><?= $row['bin']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['unit']; ?></td>
            <td><?= number_format($row['price']); ?></td>
            <td><?= number_format($row['quantity']); ?></td>
            <td><?= getSupplier($row['supplier']); ?></td>
            <td><?= getCompany($row['company']); ?></td>
            <td><?= number_format($row['quantity'] * $row['price']); ?></td>
            <td>
            <button class="btn btn-sm d-print-none btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#editModal<?=$row['id']?>">تعديل</button>
            <div class="modal fade d-print-none" id="editModal<?=$row['id']?>" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">تعديل كمية</h5>
      </div>
      <div class="modal-body">
      <form method="POST" action="update-qty.php?id=<?=$row['id']?>">
        
      <div style="width: 77%;margin: auto;">
          <div class="form-group col-md-6">
            <label for="some" class="col-form-label">الكمية</label>
            <input type="number" name="quantity" value="<?=$row['quantity']?>" class="form-control" id="some" required>
          </div>
          <div class="form-group col-md-6">
            <label for="some" class="col-form-label">السعر</label>
            <input type="number" name="price" value="<?=$row['price']?>" class="form-control" id="some" required>
          </div>
        
      </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إلغاء</button>
        <button type="submit" class="btn btn-primary" name="update"> تعديل</button>
      </div>
    </form>
    
      </div>
    </div>
  </div>
</div>

            </td>
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
              <td colspan="center"><a href="delete.php?item=<?php echo $row['id'] ?>&url=<?php echo $_SERVER['QUERY_STRING'] ?>"><button class='btn btn-danger btn-sm'>حذف</button></a></td>
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
   

               
               $('.form-select').select2();
  });
</script>
<footer>
  <!-- جميع الحقوق محفوظة محمد و اسامة &copy; <?= date('Y-m-d h:i:s am');?> -->
</footer>
