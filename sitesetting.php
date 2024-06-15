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
if ($con->query("update site SET title='$_POST[title]',name='$_POST[name]'")) {
  $notice ="<div class='alert alert-success'>Successfully Saved</div>";
}
else{
  $notice ="<div class='alert alert-danger'>Error is:".$con->error."</div>";
}
}

 ?>
</head>
<body style="background: #ECF0F5;padding:0;margin:0">
<?php include('include/navbar.php'); include('include/sidebar.php'); ?>


  <div class="content2">
<ol class="breadcrumb ">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Site Setting</li>
    </ol>
    <?php echo $notice ?>
    <div style="width: 55%;margin: auto;padding: 22px;" class="well well-sm center">

      <h4>Site Setting</h4><hr>
      <form method="POST">
         <div class="form-group">
            <label for="some" class="col-form-label">Site Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo siteTitle() ?>" id="some" required>
          </div>
          <div class="form-group">
            <label for="some" class="col-form-label">Site Name</label>
            <input type="text" name="name" value="<?php echo siteName() ?>" class="form-control" id="some"  required>
          </div> 
          <div class="center">
            <button class="btn btn-primary btn-sm btn-block" name="saveSetting">Save Setting</button>
          </div>   
        </form>
    </div>
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){$(".rightAccount").click(function(){$(".account").fadeToggle();});});
</script>

