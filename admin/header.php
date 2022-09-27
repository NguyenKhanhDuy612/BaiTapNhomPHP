<?php
require_once("checkrole.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Trang quản lý</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="dist/css/adminlte.min.css"> -->
  <link rel="stylesheet" href="/admin/css/adminlte.css">
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->


<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/admin/" class="brand-link">
        <img src="/admin/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Bán Trái Cây</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="/admin/img/user3-128x128.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a class="d-block"><?php echo $_SESSION['name'] ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2" id="sidebar">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library 
          <li class="nav-item">
              <a href="index.php" class="nav-link active" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard</p>
              </a>
          </li>-->
            <li class="nav-item">
              <a href="/admin/pages/nhanvien/" class="nav-link" id="nhanvien">
                <i class="nav-icon fab fa-odnoklassniki"></i>
                <p>
                  Nhân Viên
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/pages/khachhang/" class="nav-link" id="khachhang">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Khách Hàng
                </p>
              </a>
            </li>
            <li class="nav-item" id="hanghoa">
              <a href="" class="nav-link">
                <i class="nav-icon fas fa-warehouse"></i>
                <p>
                  Hàng Hóa
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/admin/pages/mathang/mathang.php" class="nav-link" id="mathang">
                    <i class="fas fa-carrot nav-icon"></i>
                    <p>Mặt Hàng</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/admin/pages/mathang/loaimathang.php" class="nav-link" id="loaimathang">
                    <i class="fas fa-th nav-icon"></i>
                    <p>Loại Mặt Hàng</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="/admin/pages/nhacungcap/" class="nav-link" id="nhacungcap">
                <i class="nav-icon fas fa-store "></i>
                <p>
                  Nhà Cung Cấp
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/pages/phieudathang/" class="nav-link" id="phieudathang">
                <i class="nav-icon far fa-list-alt"></i>
                <p>
                  Phiếu Đặt Hàng
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/pages/hoadon/" class="nav-link" id="hoadon">
                <i class="nav-icon fas fa-file-invoice"></i>
                <p>
                  Hóa Đơn
                </p>
              </a>
            </li>
            <li class="nav-item" id="quanly">
              <a href="" class="nav-link">
                <i class="nav-icon fas fa-th-list"></i>
                <p>
                  Quản lý
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/admin/pages/quanly/taikhoan.php" class="nav-link" id="taikhoan">
                    <i class="fas fa-users nav-icon"></i>
                    <p>Tài Khoản</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/admin/pages/quanly/quyen.php" class="nav-link" id="quyen">
                    <i class="fas fa-user-cog nav-icon"></i>
                    <p>Quyền</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/admin/pages/quanly/chucvu.php" class="nav-link" id="chucvu">
                    <i class="fas fa-user-tag nav-icon"></i>
                    <p>Chức vụ</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item bg-danger rounded">
                <a href="" id="admin-logout" class=" nav-link">
                  <i class="fas fa-sign-out-alt nav-icon"></i>
                  <p>Đăng xuất</p>
                </a>              
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <!-- <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard v3</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v3</li>
              </ol>
            </div>
          </div>
        </div>
      </div> -->
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content" id="noidung">
        
        <!-- /.container-fluid -->
