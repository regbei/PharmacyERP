<?php require "assets/function.php" ?>
<!DOCTYPE html>
<html>
<head>
	<title>الدخول</title>
	<?php require "assets/autoloader.php" ?>

</head>
<body >

<div class="container">
  
<div class="row text-center justify-content-center">
  
  <div class="col-md-6  col-sm-12">

  <div class="card" style="border-radius: 30px; margin-top: 8cm">
    <h2 class="card-header">تسجيل الدخول</h2>
  <div class="card-body">
  <form action="" method="post">
      
  <div class="col-md-12 mb-4 has-feedback">
    <label for="" class="form-label">البريد الإلكتروني</label>
        <input type="email" name="email" class="form-control" placeholder="Email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      
  </div>

      <div class="col-md-12 mb-4 has-feedback">
    <label for="" class="form-label">كلمة المرور</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      
    </div>

    <div class="card-footer">

      <button type="submit" name="login" style="border-radius: 30px" class="btn fw-bold fs-5 w-50 btn-primary m-2">الدخول</button>

    </div>
    </form>
</div>

    </div>
  
  </div>

</div>
  <br>
  <div class="alert alert-danger" id="error"  style="width: 25%;margin: auto;display: none;"></div>
  <div style="position: fixed;;top:0;background: rgba(0,0,0,0.7); width: 100%;height: 100%;z-index: -1"></div>

</div>
</body>
</html>

<?php 

if (isset($_POST['login'])) 
{
	$user = $_POST['email'];
    $pass = $_POST['password'];
    $con = new mysqli('localhost','root','','shop');

    $result = $con->query("SELECT * FROM users WHERE email='$user' AND password='$pass'");
    if($result->num_rows>0)
    {	
    	session_start();
    	$data = $result->fetch_assoc();
    	$_SESSION['userId']=$data['id'];
    	$_SESSION['role']=$data['role'];
      $_SESSION['bill'] = array();
      
      if($_SESSION['role'] == 2){

        header('location:POS.php');
      
      }elseif($_SESSION['role']==1){
        
        header('location:POS.php');

      }
      }
    else
    {
     	echo 
     	"<script>
     		\$(document).ready(function(){\$('#error').slideDown().html('Login Error! Try again.').delay(3000).fadeOut();});
     	</script>
     	";
    }
}

 ?>