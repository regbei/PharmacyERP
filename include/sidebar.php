
<style>
  .nav-item{
    border-bottom: 1px solid #ddd;
    padding: 10px;
    font-weight: bold;
    font-size: 17px;
  }
</style>


<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h3 class="offcanvas-title w-100 text-center fw-bold" id="offcanvasExampleLabel">القائمة</h3>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">

  <nav class="nav flex-column text-start">
    <?php if($_SESSION['role'] == 1){ ?>
    <li class="nav-item d-flex align-items-center">
      <a class="fs-5 nav-link me-auto" aria-current="page" href="index.php">الرئيسية</a>
      <i class="fs-5 fas fa-home"></i>
    </li>

    
    <li class="nav-item d-flex align-items-center">
      <a class="fs-5 nav-link me-auto" aria-current="page" href="dashboard.php">لوحة التحكم</a>
      <i class="fs-5 fas fa-dashboard"></i>
    </li>

    <li class="nav-item d-flex align-items-center">
      <a class="fs-5 nav-link me-auto" aria-current="page" href="inventeries.php">المخزن</a>
      <i class="fs-5 fas fa-warehouse"></i>
    </li>


    <li class="nav-item d-flex align-items-center">
      <a class="fs-5 nav-link me-auto" aria-current="page" href="reports.php">المبيعات</a>
      <i class="fs-5 fas fa-money-bills"></i>
    </li>

    <li class="nav-item d-flex align-items-center">
      <a class="fs-5 nav-link me-auto" aria-current="page" href="userMange.php">المستخدمين</a>
      <i class="fs-5 fas fa-users"></i>
    </li>
   
    
    <li class="nav-item d-flex align-items-center">
      <a class="fs-5 nav-link me-auto" aria-current="page"  href="sold-item.php">البضاعة المباعة</a>
      <i class="fs-5 fas fa-cart-shopping"></i>
    </li>
    

    <li class="nav-item d-flex align-items-center">
      <a class="fs-5 nav-link me-auto" aria-current="page"  href="quick-sales.php">البيع السريع</a>
      <i class="fs-5 fas fa-cart-flatbed"></i>
    </li>
   
    <li class="nav-item d-flex align-items-center">
      <a class="fs-5 nav-link me-auto" aria-current="page"  href="SupplierMange.php">الموردين</a>
      <i class="fs-5 fas fa-people-roof"></i>
    </li>
   
    <li class="nav-item d-flex align-items-center">
      <a class="fs-5 nav-link me-auto" aria-current="page"  href="CompanyMange.php">الشركات</a>
      <i class="fs-5 fas fa-building"></i>
    </li>

    <li class="nav-item d-flex align-items-center">
      <a class="fs-5 nav-link me-auto" aria-current="page"  href="addnew.php">إضافة منتج</a>
      <i class="fs-5 fas fa-cart-plus"></i>
    </li>
    
        <li class="nav-item d-flex align-items-center">
          <a class="fs-5 nav-link me-auto" aria-current="page"  href="POS.php">نقطة البيع</a>
          <i class="fs-5 fas fa-cash-register"></i>
        </li>

        <li class="nav-item d-flex align-items-center">
          <a class="fs-5 nav-link me-auto" aria-current="page"  href="barcode-site.php">نظام الباركود</a>
          <i class="fs-5 fas fa-barcode"></i>
        </li>
    
    <li class="nav-item d-flex align-items-center">
      <a class="fs-5 nav-link me-auto" aria-current="page"  href="sitesetting.php">إعدادات الموقع</a>
      <i class="fs-5 fas fa-gears"></i>
    </li>
    
    
    <li class="nav-item d-flex align-items-center">
            <a class="fs-5 nav-link me-auto" aria-current="page"  href="accountsetting.php">إعدادات الحساب</a>
            <i class="fs-5 fas fa-circle-user"></i>
    </li>
    
    <?php }else{ ?>
      
      
          <li class="nav-item d-flex align-items-center">
            <a class="fs-5 nav-link me-auto" aria-current="page"  href="POS.php">نقطة البيع</a>
            <i class="fs-5 fas fa-cash-register"></i>
          </li>
      
      
          <li class="nav-item d-flex align-items-center">
            <a class="fs-5 nav-link me-auto" aria-current="page"  href="accountsetting.php">إعدادات الحساب</a>
            <i class="fs-5 fas fa-circle-user"></i>
          </li>
          
      
      <?php }?>
    </nav>
    <div>
 
   
    </div>
  </div>
</div>