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
<html dir="rtl">
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
      $notice ="<div class='alert fw-bold fs-5 alert-success'>تم الحفظ</div>";
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
    <div>
      <button class="btn btn-primary btn-sm pull-right fw-bold m-1 fs-5" data-bs-toggle="modal" data-bs-target="#addIn"><i class="fa fa-plus fa-fw"> </i>إضافة فئة جديد</button> 
      <!-- <span class="fw-bold" style="font-size: 20pt;color: #333333">الأصناف</span> -->
      
     

    </div>

  <?php 
  	$i=0;
    $array = $con->query("select * from categories");
    ?>
    <br>
    <table class="table table-hover table-bordered  table-striped fs-4 fw-bold " style="width: 55%;margin: auto;">
<thead class="table-dark">
<tr>
    		<th width="100px">#</th>
    		<th width="500px">الصنف</th>
    		<th width="100px">الكمية</th>
    		<th width="50px"></th>
    	</tr>
</thead>
    <?php
    while ($row = $array->fetch()) 
    {
    	$i++;
      $array2 = $con->query("select count(*) as qty from inventeries where catId = '$row[id]'");
      $row2 = $array2->fetch();
  ?>
    <tr>
    	<td><?php echo $i ?></td>
    	<td><?php echo $row['name']; ?></td>
    	<td><?php echo $row2['qty']; ?></td>
    	<td><a href="delete.php?category=<?php echo $row['id'] ?>"><button class="btn btn-xs btn-danger">حذف</button></a></td>
    </tr>
    
  <?php
    }
    echo "</table>";
   ?>
  </div>
</div>

<div id="addIn" class="modal fade">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 text-start fw-bold">إضافة صنف جديد</h4>
      </div>
      <div class="modal-body"> <form method="POST" enctype="multipart/form-data">
     
         
          <div class="col-12 mb-2">
            <label for="some" class="form-label">الإسم</label>
            <input type="text" name="inName" class="form-control" id="some" required>
          </div>
          <div class="col-12 mb-2">
            <label for="2" class="form-label">الصورة</label>
            <input type="file" name="inPic" class="form-control" id="2" required>
          </div>
          
       
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إلغاء</button>
        <button type="submit" class="btn btn-primary" name="safeIn">حفظ</button>
      </div>
    </form>
    </div>

  </div>
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){$(".rightAccount").click(function(){$(".account").fadeToggle();});});
</script>

