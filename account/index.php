<?php
require_once('../config/config.php');
require_once(ROOT . 'config/connect.php');
include(ROOT . 'include/header.php');

if (!isset($_SESSION['loggedin'])) {
   header('Location: ../');
} else {
   $user_id = $_SESSION['user_id'];
   if ($_SESSION['role'] == 'user') {
      $query =
         "SELECT * FROM tai_khoan tk
      JOIN khach_hang kh ON kh.user_id = tk.user_id
      WHERE kh.user_id = '$user_id'
      ";
   } else {
      $query =
         "SELECT * FROM tai_khoan tk
      JOIN nhan_vien nv ON nv.user_id = tk.user_id
      JOIN chuc_vu cv ON cv.ma_chuc_vu = nv.ma_chuc_vu
      WHERE nv.user_id = '$user_id'
      ";
   }
   $result = mysqli_query($conn, $query);
   $userInfo = $result->fetch_assoc();
}
?>
<div class="container fs-6 bg-light rounded">
   <h2 class="center">
      Hồ sơ cá nhân
   </h2>
   <div class="row">
      <div class="col-md-3">
         <?php
         if ($_SESSION['role'] != 'user') { ?>
            <img src="https://via.placeholder.com/200" class="img-fluid rounded-pill mx-auto d-block">
            <div class="mb-3 row">
               <label class="col-sm-6 col-md-12 col-lg-6">Tên nhân viên</label>
               <div class="col-sm-6 col-md-12 col-lg-6">
                  <?php echo $userInfo['ten_nv'] ?>
               </div>
            </div>
            <div class="mb-3 row">
               <label class="col-sm-6 col-md-12 col-lg-6">Chức vụ</label>
               <div class="col-sm-6 col-md-12 col-lg-6">
                  <?php echo $userInfo['ten_chuc_vu'] ?>
               </div>
            </div>
            <div class="mb-3 row">
               <label class="col-sm-6 col-md-12 col-lg-6">Lương</label>
               <div class="col-sm-6 col-md-12 col-lg-6">
                  <?php echo number_format($userInfo['luong']) . 'đ' ?>
               </div>
            </div>
         <?php
         } else {
         ?>
            <div class="mb-3 row">
               <label class="col-sm-6 col-md-12 col-lg-6">Tên khách hàng</label>
               <div class="col-sm-6 col-md-12 col-lg-6">
                  <?php echo $userInfo['ten_kh'] ?>
               </div>
            </div>
         <?php }
         ?>
         <div class="mb-3 row">
            <label class="col-sm-6 col-md-12 col-lg-6">Ngày sinh</label>
            <div class="col-sm-6 col-md-12 col-lg-6">
               <?php echo $userInfo['ngay_sinh'] ?>
            </div>
         </div>
         <div class="mb-3 row">
            <label class="col-sm-6 col-md-12 col-lg-6">Giới tính</label>
            <div class="col-sm-6 col-md-12 col-lg-6">
               <?php echo $userInfo['gioi_tinh'] ? 'Nam' : 'Nữ' ?>
            </div>
         </div>
         <div class="">
            <div class="nav row nav-pills me-3" role="tablist" aria-orientation="vertical">
               <button class="nav-link col-sm-4 col-md-12 active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Hồ sơ</button>
               <button class="nav-link col-sm-4 col-md-12" id="v-pills-password-tab" data-bs-toggle="pill" data-bs-target="#v-pills-password" type="button" role="tab" aria-controls="v-pills-password" aria-selected="false">Đổi mật khẩu</button>
               <button class="nav-link col-sm-4 col-md-12" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Cài đặt</button>
            </div>
         </div>
      </div>
      <div class="col-md-9">
         <div class="tab-content">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
               <div class="mx-auto">
                  <form class="" autocomplete="off">
                     <div class="mb-3">
                        <label>Tên tài khoản</label>
                        <input type="text" class="form-control rounded-pill border-0 bg-secondary bg-opacity-10" disabled value="<?php echo $userInfo['username'] ?>">
                     </div>
                     <div class="mb-3">
                        <label>Địa chỉ</label>
                        <input class="form-control rounded-pill border-0 bg-secondary bg-opacity-10" id="edit-diachi" value="<?php echo $userInfo['dia_chi'] ?>">
                     </div>
                     <div class="mb-3">
                        <label>CMND/CCCD</label>
                        <input class="form-control rounded-pill border-0 bg-secondary bg-opacity-10" id="edit-cmnd" value="<?php echo $userInfo['cmnd'] ?>">
                     </div>
                     <div class="mb-3">
                        <label>Số điện thoại</label>
                        <input class="form-control rounded-pill border-0 bg-secondary bg-opacity-10" id="edit-sdt" value="<?php echo $userInfo['so_dien_thoai'] ?>">
                     </div>
                     <span id="edit-account-error"></span>
                     <hr>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="m-1">
                              <button type="button" id="edit-account-back-button" class="btn btn-dark w-100">Về trang chủ</button>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="m-1">
                              <button type="button" id="edit-account-button" class="btn btn-primary w-100">
                                 <span id="edit-status">Lưu</span>
                              </button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
               <div class="mx-auto">
                  <form class="" autocomplete="on">
                     <div class="mb-3">
                        <label>Mật khẩu hiện tại</label>
                        <input type="password" autocomplete="on" class="form-control rounded-pill border-0 bg-secondary bg-opacity-10" id="old-password">
                     </div>
                     <div class="mb-3">
                        <label>Mật khẩu mới</label>
                        <input type="password" autocomplete="on" class="form-control rounded-pill border-0 bg-secondary bg-opacity-10" id="new-password">
                     </div>
                     <div class="mb-3">
                        <label>Nhập lại mật khẩu mới</label>
                        <input type="password" autocomplete="on" class="form-control rounded-pill border-0 bg-secondary bg-opacity-10" id="re-new-password">
                     </div>
                     <span id="change-password-error"></span>
                     <hr>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="m-1">
                              <button type="button" id="edit-account-back-button-2" class="btn btn-dark w-100">Về trang chủ</button>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="m-1">
                              <button type="button" id="change-password-button" class="btn btn-primary w-100" disabled>
                                 <span id="change-password-status">Xác nhận</span>
                              </button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
               Nothing
            </div>
         </div>
      </div>
   </div>
</div>

<script src="index.js"></script>

<?php
include(ROOT . 'include/footer.php');
?>