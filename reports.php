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
<link rel="stylesheet" href="js/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <title><?php echo siteTitle(); ?></title>
  <?php require "assets/autoloader.php" ?>
  <style type="text/css">
  <?php include 'css/customStyle.css'; ?>

  </style>

</head>
<body style="background:padding:0;margin:0">
<?php
include('include/navbar.php');
include('include/sidebar.php'); 
?>


  <caption><h3 style="font-size: 27px; padding: 20px;font-weight: bold;" dir="rtl">إجمالي المبلغ  <?php
  $last = $con->query("SELECT SUM(sold.paid_amount) as total FROM sold");
  while ($balance = $last->fetch()) {
    echo number_format($balance['total']);
  }
?></h3></caption>
  <div class="container-fluid" >
    <div class="row">
      <div class="col-md-12 col-lg-12 col-sm-12">


<div class="card shadow">
  <h2 class="card-header text-start fw-bold">تقرير المبيعات</h2>
  <div class="card-body overflow-auto">
  <table id="dataTable" class="table table-bordered table-striped" style="z-index: -1; font-weight: bolder; font-size: 15px">
      <thead class="table-dark">
        <th>#</th>
        <th>العميل</th>
        <th>الهاتف</th>
        <th>التخفيض</th>
        <th>إجمالي</th>
        <th>المدفوع</th>
        <th>المستحق</th>
        <th>الدفع</th>
        <th>بواسطة:</th>
        <th>التاريخ</th>
        <th></th>
        <th></th>
        
      </thead>
     <tbody>
      <?php $i=0;
          $array = $con->query("select * from sold ORDER BY date DESC");
        while ($row = $array->fetch()) 
        { 
          $i=$i+1;
          $id = $row['id'];
        ?>
          <tr>
            <td><?= $i; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['contact']; ?></td>
            <td><?=number_format($row['discount']); ?></td>
            <td><?=number_format($row['amount']); ?></td>
            <td><?= number_format($row['paid_amount']); ?></td>
            <td><?= number_format($row['due']); ?></td>
            <td><?= $row['method']; ?></td>
            <td><?= getAdminName($row['userId']); ?></td>
            <td><?= $row['date']; ?></td>
            <td>
            <button class="btn btn-sm btn-primary btn-block fw-bold w-100" data-bs-toggle="modal" data-bs-target="#editModal<?=$row['id']?>">سداد</button>
  
  <div class="modal fade" id="editModal<?=$row['id']?>" role="dialog">
  
  <div class="modal-dialog modal-dialog-centered">
  
  <div class="modal-content">
  
  <div class="modal-header">
        <h3 class="modal-title fw-bold w-100 text-start" id="exampleModalLabel">سداد معاملة</h3>
  </div>
  
      <div class="modal-body">
      <form method="POST" action="update-transaction.php?id=<?=$row['id']?>">
        
   

          <div class="form-group col-md-12">
            <label for="some" class="form-label">المستحق</label>
            <input type="number" value="<?=$row['due']?>" class="form-control" id="some" readonly>
          </div>

          <div class="form-group col-md-12">
            <label for="some" class="form-label">المبلغ المدفوع</label>
            <input type="number" name="paid_amount" value="<?=$row['amount']?>" class="form-control" id="some" required>
          </div>
        
        </div>
      <div class="modal-footer fw-bold">
        <button type="button" class="btn btn-danger rounded-3" data-bs-dismiss="modal">إلغاء</button>
        <button type="submit" class="btn btn-primary rounded-3" name="update"> تعديل</button>
      </div>
    </form>
    
      </div>
    </div>
  </div>
</div>

            </td>
            <td><a href="assets/invoice.php?order_id=<?=$id?>" class="btn btn-primary">عرض الفاتورة</a></td>

            
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

  <script src="js/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="js/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> 
<script src="js/dataTables.buttons.min.js"></script>
  <script src="js/buttons.print.min.js"></script>