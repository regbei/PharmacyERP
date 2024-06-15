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
<?php include "assets/function.php" ?>
<?php include "assets/db.php";?>
<!DOCTYPE html>
<html>
<head>

  <title><?php echo siteTitle(); ?></title>
  <?php include "assets/autoloader.php" ?>
  <style type="text/css">
  <?php include "css/customStyle.css"; ?>

  </style>

</head>
<body style="padding:0;margin:0">
<?php
$notice = "";
if (isset($_POST['save'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['password_confirm'];
    $role = $_POST['role'];
    if ($password == $confirm) {

        $stmt = $con->prepare("INSERT INTO `users`(`email`,`password`, `name`,`role`) VALUES (:email, :password, :name, :role)");
        $stmt->execute(['email'=>$email, 'password'=>$password, 'name'=>$username, 'role'=>$role]);

        $notice ="<div class='alert fw-bold text-start alert-success'>تمت الإضافة بنجاح</div>";
      }else{
        $notice ="<div class='alert alert-danger'>Not saved Error:".$con->error."</div>";
      }
}

?>
<?php 
include('include/navbar.php');
include('include/sidebar.php');
  $q = $con->query("SELECT users.id, users.name, users.email, users.role FROM users");
?>



  <div class="container-fluid">
  <?= $notice; ?>
  <button class="btn btn-sm d-print-none btn-primary" data-bs-toggle="modal" data-bs-target="#newUser">إضافة</button>

    <div class="card">
      <h3 class="text-start fw-bold card-header">المستخدمين</h3>
     
      <div class="card-body overflow-auto">
      <table id="dataTable" class="table table-hover table-bordered table-striped" style="font-weight: bolder; font-size: 17px">
      <thead class="table-dark">
        <th>#</th>
        <th>إسم المستخدم</th>
        <th>البريد</th>
        <th>الصلاحية</th>
        <th></th>
      </thead>
    </tbody>
    <?php while($row = $q->fetch()): ?>
    <tr>
        <td><?=$row['id']; ?></td>
        <td><?=$row['name']; ?></td>
        <td><?=$row['email']; ?></td>
        <td><?=$row['role']; ?></td>
        <td>
            <button class="btn btn-sm d-print-none btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?=$row['id']?>">تعديل</button>
<a href="userDelete.php?id=<?=$row['id']?>" class="btn btn-sm btn-danger">حذف</a>

<div class="modal fade d-print-none" id="editModal<?=$row['id']?>" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">تعديل </h5>
      </div>

      <div class="modal-body">
      <form method="POST" class="text-start" action="update-user.php?id=<?=$row['id']?>">
        
      
          <div class="form-group col-md-12">
            <label for="some" class="col-form-label">الإسم</label>
            <input type="text" name="name" value="<?=$row['name']?>" maxlength="20" class="form-control">
          </div>

          <div class="form-group col-md-12">
            <label for="some" class="col-form-label">البريد</label>
            <input type="text" name="email" value="<?=$row['email']?>" maxlength="20" class="form-control" >
          </div>

          <div class="form-group col-md-12">
            <label for="some" class="col-form-label">الصلاحية</label>
            <select name="role" id="" class="form-select">
                
            <option value="<?=$row['role'];?>"><?=$row['role'];?></option>
            <option value="1">admin</option>
                <option value="2">user</option>
            </select>
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
        <h5 class="modal-title" id="exampleModalLabel">إضافة مستخدم </h5>
      </div>

      <div class="modal-body">
      <form method="POST" class="text-start" action="UserMange.php">
        
      
          <div class="form-group col-md-12">
            <label for="some" class="col-form-label">الإسم</label>
            <input type="text" name="username"  maxlength="20" class="form-control" required>
          </div>

          <div class="form-group col-md-12">
            <label for="some" class="col-form-label">البريد</label>
            <input type="email" name="email"  maxlength="20" class="form-control" required>
          </div>

          <div class="form-group col-md-12">
            <label for="some" class="col-form-label">كلمة المرور</label>
            <input type="password" name="password"  maxlength="20" class="form-control" required>
          </div>

          <div class="form-group col-md-12">
            <label for="some" class="col-form-label">تأكيد كلمة المرور</label>
            <input type="password" name="password_confirm"  maxlength="20" class="form-control" required>
          </div>

          <div class="form-group col-md-12">
            <label for="some" class="col-form-label">الصلاحية</label>
            <select name="role" id="" class="form-select">
                
                <option value="1">Admin</option>
                <option value="2">User</option>
            </select>
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
