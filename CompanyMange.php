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

  </style>

</head>
<body style="padding:0;margin:0">
<?php
 $notice="";

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $region = $_POST['region'];
    $address = $_POST['address'];



        $stmt = $con->prepare("INSERT INTO `company`(`name`,`region`, `address`) VALUES (:name, :region, :address)");
        $stmt->execute(['name'=>$name, 'region'=>$region, 'address'=>$address]);     
if($stmt == true){
  $notice ="<div class='alert fw-bold text-start alert-success'>تمت الإضافة بنجاح</div>";
    }else{
      $notice ="<div class='alert alert-danger'>Not saved Error:".$con->error."</div>";
    }
}

?>
<?php 
include('include/navbar.php');
include('include/sidebar.php');
  $q = $con->query("SELECT * FROM company");
?>


<div class="container-fluid">
  <?= $notice; ?>
<div class="row">
<div class="col-12 my-2">
  <button class="btn btn-sm fw-bold d-print-none btn-primary" data-bs-toggle="modal" data-bs-target="#newUser">إضافة</button>

</div>
</div>

    <div class="card">
      <h3 class="text-start fw-bold card-header">العلامات التجارية</h3>
     
      <div class="card-body overflow-auto">
      <table id="dataTable" class="table table-hover table-bordered table-striped" style="font-weight: bolder; font-size: 17px">
      <thead class="table-dark">
        <th>#</th>
        <th>إسم الشركة</th>
        <th>العنوان</th>
        <th>الدولة</th>
        <th></th>
      </thead>
    </tbody>
    <?php while($row = $q->fetch()): ?>
    <tr>
        <td><?=$row['id']; ?></td>
        <td><?=$row['name']; ?></td>
        <td><?=$row['address']; ?></td>
        <td><?=$row['region']; ?></td>
        <td>
            <button class="btn btn-sm  btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?=$row['id']?>">تعديل</button>
<a href="company-delete.php?id=<?=$row['id']?>" class="btn btn-sm btn-danger">حذف</a>

<div class="modal fade d-print-none" id="editModal<?=$row['id']?>" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">تعديل </h5>
      </div>

      <div class="modal-body">
      <form method="POST" class="text-start" action="update-company.php?id=<?=$row['id']?>">
        
      
          <div class="form-group col-md-12">
            <label for="some" class="col-form-label">الإسم</label>
            <input type="text" name="name" value="<?=$row['name']?>" maxlength="20" class="form-control">
          </div>

          <div class="form-group col-md-12">
            <label for="some" class="col-form-label">العنوان</label>
            <input type="text" name="address" value="<?=$row['address']?>" maxlength="20" class="form-control" >
          </div>


          <div class="form-group col-md-12">
            <label for="some" class="col-form-label">الدولة</label>
            <input type="text" name="region" value="<?=$row['region']?>" maxlength="20" class="form-control" >
          </div>

       <!-- Modal Footer -->
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
            
    </tr>
    <?php endwhile; ?>
     </tbody>

    </table>
      </div>
    </div>
  </div>


<!-- Modal Adds New user -->
<div class="modal fade" id="newUser" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">إضافة مورد </h5>
      </div>

      <div class="modal-body">
      <form method="POST" class="text-start" action="<?= $_SERVER['PHP_SELF'] ?>">
        
      
          <div class="form-group col-md-12">
            <label for="some" class="col-form-label">الإسم</label>
            <input type="text" name="name"  maxlength="20" class="form-control" required>
          </div>

          <div class="form-group col-md-12">
            <label for="some" class="col-form-label">العنوان</label>
            <input type="text" name="address"  maxlength="20" class="form-control" required>
          </div>

          <div class="form-group col-md-12">
            <label for="some" class="col-form-label">الدولة</label>
            <input type="text" name="region"  maxlength="20" class="form-control" required>
          </div>

          
          
        
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إلغاء</button>
        <button type="submit" class="btn btn-primary" name="save"> حفظ</button>
      </div>
    </form>
    
      </div>
    </div>
  </div>
</div>

<!-- End Modal -->

</body>
</html>
<script>
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

<footer>
  جميع الحقوق محفوظة  اسامة &copy; <?= date('Y-m-d');?>
</footer>
