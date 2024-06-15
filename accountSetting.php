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
 <?php 
 $notice="";
if (isset($_POST['saveSetting'])) {
if ($con->query("update users SET email='$_POST[email]',name='$_POST[name]',password='$_POST[password]' where id='$_SESSION[userId]'")) {

  $notice ="<div class='alert alert-success'>Successfully Saved</div>";
  header("location:accountSetting.php?notice=Successfully saved");
}
else{
  $notice ="<div class='alert alert-danger'>Error is:".$con->error."</div>";
}

}
if (isset($_GET['notice'])) {
  $notice = "<div class='alert alert-success'>Successfully Saved</div>";
}
 ?>
</head>
<body style="background: #ECF0F5;padding:0;margin:0">
<?php include('include/navbar.php'); include('include/sidebar.php'); ?>

  <div class="content2">
<ol class="breadcrumb ">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> اللوحة الرئيسية</a></li>
        <li class="active">إعدادات الحساب</li>
    </ol>
    <?php echo $notice ?>
    <div style="width: 55%;margin: auto;padding: 22px;" class="well well-sm center">

      <h4>إعدادات الحساب</h4><hr>
      <form method="POST">
         <div class="form-group">
            <label for="some" class="col-form-label">الإسم</label>
            <input type="name" name="name" class="form-control" value="<?php echo $user['name'] ?>" id="some" required>
          </div>
         <div class="form-group">
            <label for="some" class="col-form-label">عنوان البريد</label>
            <input type="email" name="email" class="form-control" value="<?php echo $user['email'] ?>" id="some" required>
          </div>
          <div class="form-group">
            <label for="some" class="col-form-label">كلمةالمرور</label>
            <input type="password" name="password" value="<?php echo $user['password'] ?>" class="form-control" id="some"  required>
          </div>
          <div class="center">
            <button class="btn btn-primary btn-sm btn-block" name="saveSetting">حفظ الإعدادات</button>
          </div>   
        </form>
    </div>
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){$(".rightAccount").click(function(){$(".account").fadeToggle();});});
</script>

