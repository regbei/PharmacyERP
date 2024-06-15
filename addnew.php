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
.col-form-label{
font-size: 18px;
font-weight: bold;
}

.btn-primary{
  color: #fff;
  background-color: #337ab7;
  border-color: #2e6da4;
  font-size: 18px;
  font-weight: bolder;
}

.btn-success{
  color: #fff;
  background-color: #33b748;
  border-color: #33b748;
  font-size: 18px;
  font-weight: bolder;
}
.title{
font-weight: bold;
}

hr{
color: black;

}
  </style>
  <?php 
  $notice="";
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
<body style="background: #ECF0F5;padding:0;margin:0">

<?php 
include('include/navbar.php'); include('include/sidebar.php'); 

if (isset($_POST['saveProduct'])) {

  $sql = "INSERT INTO inventeries (catId,bin,supplier,name,unit,price,quantity,company) VALUES (:catId,:bin,:supplier,:name,:unit,:price,:quantity,:company)";
  $query = $con->prepare($sql);
  $done = $query->execute(['catId'=>$_POST['catId'],'bin'=>$_POST['bin'],'supplier'=>$_POST['supplier'],'name'=>$_POST['name'],'unit'=>$_POST['unit'],'price'=>$_POST['price'],'quantity'=>$_POST['quantity'],'company'=>$_POST['company']]);
if ($done) {
  $notice ="<div class='h4 fw-bold alert alert-success'>تم الحفظ</div>";
}
else{
  $notice ="<div class='alert alert-danger'>Error is:".$con->error."</div>";
}
}

 ?>
  <div class="content2" dir="rtl">

    <?php echo $notice ?>
    <div  class="container">

      <div class="card shadow">
        <h3 class="text-center card-header fw-bold"> منتج جديد</h3>
<div class="card-body p-5">

<form method="POST" class="text-start">
         
          <div class="col-12">
            <label for="some" class="form-label fw-bold fs-5 mb-3">إسم المنتج</label>
            <input type="text" name="name" minlength="3" maxlength="150" class="form-control mb-3" id="some" required>
          </div>

          <div class="col-12">
            <label for="some" class="form-label fw-bold fs-5 mb-3">رقم المنتج</label>
            <input type="text" name="bin" minlength="3" maxlength="150" class="form-control mb-3" id="some" required>
          </div>

          <div class="col-12">
            <label for="some" class="form-label fw-bold fs-5 mb-3">الوحدة</label>
            <input type="text" name="unit" placeholder="i.e 50mg" minlength="1" maxlength="10" class="form-control mb-3" id="some" required>
          </div>
          <div class="col-12">
            <label for="some" class="form-label fw-bold fs-5 mb-3">سعر الوحدة</label>
            <input type="number" name="price"  class="form-control mb-3" id="some" required>
          </div>
          
          <div class="col-12 mb-3">
            <label for="some" class="form-label fw-bold fs-5 mb-3">المورد</label>
            <select class="form-select"  name="supplier" required> 
              <option selected disabled value="">الرجاء تحديد </option>
            <?php supplier(); ?>
              
            </select>
          </div>


          <div class="col-12 mb-3">
              <label for="some" class="form-label fw-bold fs-5 mb-3">الكمية</label>
              <input type="number" name="quantity"  class="form-control mb-3" id="some" required>
          </div>



          <div class="col-12 mb-3">
            <label for="some" class="form-label fw-bold fs-5 mb-3">إسم الشركة</label>
            <select class="form-select " id="select2"  name="company" required> 
              <option selected disabled value="">الرجاء تحديد </option>
            <?php company(); ?>
              
            </select>
          </div>

          <div class="col-12 mb-3">
            <label for="some" class="form-label fw-bold fs-5 mb-3">النوع</label>
            <select class="form-select" name="catId" required> 
              <option selected disabled value="">الرجاء تحديد</option>
            <?php getAllCat(); ?>
              
            </select>
          </div>
      
          <div class="center mt-3">
            <button type="submit" name="saveProduct" class="btn btn-primary">حفظ</button>
            <button type="reset" class="btn btn-success">إلغاء</button>
          </div>
        </form>

</div>

      </div>
      
    </div>
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){$(".rightAccount").click(function(){$(".account").fadeToggle();});
  
               
  $('.form-select').select2();
  });
</script>

