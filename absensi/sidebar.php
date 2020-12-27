<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <?php 
        $sql = "SELECT * FROM guru WHERE nuptk = '$_SESSION[username]'";
        $res = mysqli_query($link,$sql);
        $ketemu = mysqli_num_rows($res);
    
        if($ketemu){
          $acc = mysqli_fetch_assoc($res);
          $kd_guru = $acc["kd_guru"];
        }
      ?>

      <?php 
        if(isset($kd_guru)){
          echo "<div class='sidebar-brand-text mx-3'>Guru</div>"; 
        }else{
          echo "<div class='sidebar-brand-text mx-3'>Absensi</div>"; 
        }
      ?>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link" href="absensi.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Data Absensi</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    
  </ul>
  <!-- End of Sidebar -->