<?php
session_start();
// error_reporting(0);
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
  <?php 
  $notice="";
  $last = $con->query("SELECT SUM('quantity')* SUM('price') FROM inventeries GROUP BY id");

  if (isset($_POST['safeIn']))
  {
    $filename = $_FILES['inPic']['name'];
    move_uploaded_file($_FILES["inPic"]["tmp_name"], "photo/".$_FILES["inPic"]["name"]);
    if ($con->query("insert into categories (name,pic) value ('$_POST[name]','$filename')")) {
      $notice ="<div class='alert alert-success'>Successfully Saved</div>";
    }
    else
      $notice ="<div class='alert alert-danger'>Not saved Error:".$con->error."</div>";
  }

   ?>
</head>
<body style="padding:0;margin:0">
<?php
include('include/navbar.php');
include('include/sidebar.php'); 
?>

<div class="container-fluid">
  <div class="content2">
    <?php echo $notice; ?>
    <div class="row mt-0 mb-4">
      <div class="col-md-3 me-auto">
        <button class="btn btn-primary btn-sm pull-right fw-bold m-1 fs-5" data-bs-toggle="modal" data-bs-target="#addIn"><i class="fa fa-plus fa-fw"> </i>إضافة فئة جديد</button> 
        <a href="manageCat.php" class="btn btn-primary m-1 btn-sm fs-5 pull-right fw-bold"><i class="fa fa-gear  fa-fw"> </i> إدارة الفئات</a>
        
      </div>
      

    </div>


    <div class="row">
  <?php 
  
    $array = $con->query("select * from categories");
    while ($row = $array->fetch()) 
    {
      $array2 = $con->query("select count(*) from inventeries where catId = '$row[id]'");
      $row2 = $array2->fetch();
  ?>
      <div class="col-md-3 col-sm-12">
        <div class="card m-2">
        <!-- <div class="card-header"> -->

          <img src="photo/<?php echo $row['pic'] ?>" style="max-height: 250px" class='card-img-top'>
        <!-- </div> -->
          <div class="card-body">

            <a class="text-start text-dark text-decoration-none" href="inventeries.php?catId=<?php echo $row['id'] ?>">
            <h5 class="card-title fw-bold">
              الإسم  :
              <?php echo $row['name'] ?>
              
            </h5>
            <h5 class="card-title fw-bold">
            
              الكمية : <?php echo $row2['count(*)']; ?></h5>
        </a>

          </div>
        </div>
      </div>
      <?php }?>
    </div>
  </div>

<div id="addIn" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 text-start fw-bold"> إضافة</h4>
      </div>

      <div class="modal-body" dir="rtl"> 
        <form method="POST" enctype="multipart/form-data">
      
         
          <div class="col-12 mb-3">
            <label for="some" class="form-label fw-bold">الإسم</label>
            <input type="text" name="name" class="form-control" id="some" required>
          </div>

          <div class="col-12 mb-3">
            <label for="2" class="form-label fw-bold">الصورة</label>
            <input type="file" name="inPic" class="form-control" id="2" required>
          </div>
          
       
        
        
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-danger fw-bold" data-bs-dismiss="modal">إلغاء</button>
        <button type="submit" class="btn btn-primary fw-bold" name="safeIn">حفظ</button>
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

