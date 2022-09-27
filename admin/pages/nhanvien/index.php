<?php
require_once('../../../config/config.php');
require_once(ROOT . 'admin/checkrole.php');
require_once(ROOT . 'config/connect.php');
require_once(ROOT . 'function/global.php');

include(ROOT . 'admin/header.php');
/* Đừng động vào những cái require với include */
?>
<!-- Ghi nội dung vào đây -->
<div class="d-flex justify-content-center">
  <form action="" method="post">
    <table>
      <tr>
        <th colspan="2">
          <h3>Tìm Kiếm thông tin nhân viên</h3>
        </th>
      </tr>
      <tr>
        <td>Tìm kiếm theo:</td>
        <td>
          <select name="thuoctinh">
            <option value="manv">Mã nhân viên</option>
            <option value="tennv">Tên nhân viên</option>
            <option value="chucvu">Chức vụ</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Từ khóa</td>
        <td><input type="text" name="keyword"></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:center">
          <input type="submit" name="timkiem" value="Tìm Kiếm">
        </td>
      </tr>
    </table>
</div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Thêm nhân viên
</button>
<?php
$sql1 = "SELECT * from nhan_vien ORDER BY ma_nv DESC LIMIT 1 ";
$result = mysqli_query($conn, $sql1);
$nextid = getNextID($result, 'ma_nv', 'NV', 7);

?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">THÊM NHÂN VIÊN MỚI</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="them_nhan_vien" enctype="multipart/form-data"  class="my-modal-content animate rounded-3" autocomplete="off" method="post">
          <div class="container-fluid">
            <table class="table table-inverse table-responsive fixed">
              <thead class="thead-inverse">
                <tr>
                  <th colspan="2">Thêm Nhân viên mới</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td scope="row">Mã nhân viên</td>
                  <td><input type="text" value="<?php echo $nextid; ?>" disabled></td>
                </tr>
                <tr>
                  <td scope="row">Tên nhân viên</td>
                  <td><input type="text" placeholder="Họ Và Tên" name="ten_nv"></td>
                </tr>
                <tr>
                  <td scope="row">Ngày Sinh</td>
                  <td><input type="date" name="ngaySinh" id="ngay-sinh" required></td>
                </tr>
                <tr>
                  <td scope="row">Giới Tính</td>
                  <td>
                    <div class="flexbox-space-evenly">
                      <input type="radio" name="gioiTinh" value="1" checked>Nam
                      <input type="radio" name="gioiTinh" value="0">Nữ
                    </div>
                  </td>
                </tr>
                <tr>
                  <td scope="row">Địa Chỉ</td>
                  <td><input type="text" placeholder="Nhập địa chỉ" id="dia-chi" name="diaChi" required></td>
                </tr>
                <tr>
                  <td scope="row">Số điện thoại</td>
                  <td><input type="text" placeholder="Số điện thoại" id="sdt" name="soDienThoai" required></td>
                </tr>
                <tr>
                  <td scope="row">CMND/CCCD</td>
                  <td><input type="text" placeholder="CMND/CCCD" id="cmnd" name="cmnd" required></td>
                </tr>
                <tr>
                  <td scope="row">Ảnh</td>
                  <td> <input type="file" name="anh"> </td>
                </tr>
                <tr>
                  <td scope="row">Chức Vụ</td>
                  <!-- <td><input type="text" placeholder="CMND/CCCD" id="chucvu" name="chucvu" required></td> -->
                  <td>
                    <select name="chuc_vu" id="">
                      <?php
                        $sql = "SELECT * from chuc_vu";
                        $result = mysqli_query($conn,$sql);
                        buildDropDownList($result,'chuc_vu','ma_chuc_vu','ten_chuc_vu');
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td scope="row">Lương</td>
                  <td><input type="text" placeholder="CMND/CCCD" id="luong" name="luong" required></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" name="them" value="Thêm mới" />
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- xử lý thêm nhân viên mới -->
<?php
if (isset($_POST['them'])) {
  $errors = array(); //khởi tạo 1 mảng chứa lỗi
  //iem tra ma sua
  $ma_nv = $nextid;
  //kiểm tra tên sản phẩm
  if (empty($_POST['ten_nv'])) {
    $errors[] = "Bạn chưa nhập họ nhân viên";
  } else {
    $ten_nv = trim($_POST['ten_nv']);
  }
  if (empty($_POST['ngaySinh'])) {
    $errors[] = "Bạn chưa nhập ngày sinh";
  } else {
    $ns = trim($_POST['ngaySinh']);
  }
  if (($_POST['gioiTinh'] != 0) && ($_POST['gioiTinh'] != 1)) {
    $errors[] = "Bạn chưa nhập giới tính";
  } else {
    $gt = trim($_POST['gioiTinh']);
  }
  if (empty($_POST['diaChi'])) {
    $errors[] = "Bạn chưa nhập địa chỉ";
  } else {
    $diachi = trim($_POST['diaChi']);
  }
  if (empty($_POST['cmnd'])) {
    $errors[] = "Bạn chưa nhập địa chỉ";
  } else {
    $cmnd = trim($_POST['cmnd']);
  }
  if (empty($_POST['luong'])) {
    $errors[] = "Bạn chưa nhập địa chỉ";
  } else {
    $luong = trim($_POST['luong']);
  }
  if ($_FILES['anh']['name'] != "") {
    $hinh = $_FILES['anh'];
    $ten_hinh = $hinh['name'];
    $type = $hinh['type'];
    $size = $hinh['size'];
    $tmp = $hinh['tmp_name'];
    if (($type == 'image/jpg' || ($type == 'image/bmp') || ($type == 'image/gif') && $size < 8000)) {
        move_uploaded_file($tmp, "hinh/" . $ten_hinh);
    }
  }
  if (empty($_POST['soDienThoai'])) {
    $errors[] = "Bạn chưa nhập địa chỉ";
  } else {
    $sdt = trim($_POST['soDienThoai']);
  }
  $ma_cv= $_POST['chuc_vu'];
  if (empty($errors)) //neu khong co loi xay ra
  {
    $query = "INSERT INTO `nhan_vien`(`ma_nv`, `ten_nv`, `ngay_sinh`, `gioi_tinh`, `dia_chi`, `so_dien_thoai`, `anh_nv`, `cmnd`, `ma_chuc_vu`, `luong`) VALUES 
      ('$ma_nv','$ten_nv','$ns','$gt','$diachi','$sdt','$ten_hinh','$cmnd','$ma_cv','$luong')";
    $result = mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) == 1) { //neu them thanh cong
      echo "<div align='center'>Thêm mới thành công!</div>";
    } else //neu khong them duoc
    {
      echo "<p>Có lỗi, không thể thêm được</p>";
      echo "<p>" . mysqli_error($conn) . "<br/><br />Query: " . $query . "</p>";
    }
  } else { //neu co loi
    echo "<h2>Lá»—i</h2><p>Có lỗi xảy ra:<br/>";
    foreach ($errors as $msg) {
      echo "- $msg<br /><\n>";
    }
    echo "</p><p>Hãy thử lại.</p>";
  }
}
?>
<?php

$rowsPerPage = 5; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['page'])) {
  $_GET['page'] = 1;
}
$offset = ($_GET['page'] - 1) * $rowsPerPage;
$sql = "SELECT * from nhan_vien join chuc_vu on nhan_vien.ma_chuc_vu = chuc_vu.ma_chuc_vu ";
$result = mysqli_query($conn, $sql);
//$result = mysqli_query($conn, $sql . $offset . ', ' . $rowsPerPage);
$maxpage = ceil(mysqli_num_rows($result) / $rowsPerPage);
$sql = "SELECT * from nhan_vien join chuc_vu on nhan_vien.ma_chuc_vu = chuc_vu.ma_chuc_vu LIMIT $offset, $rowsPerPage ";
$result = mysqli_query($conn, $sql);
$header = ['Mã Nhân viên', 'Tên Nhân viên', 'Ngày sinh', 'Giới tính', 'Địa chỉ', 'Số điện thoại', 'Ảnh', 'CMND', 'Chức vụ', 'Lương'];
$data = array(
  'ma_nv' => '',
  'ten_nv' => '',
  'ngay_sinh' => '',
  'gioi_tinh' => 'bool-Nam-Nữ',
  'dia_chi' => '',
  'so_dien_thoai' => '',
  'anh_nv' => '',
  'cmnd' => '',
  'ten_chuc_vu' => '',
  'luong' => '',
);
buildTable(result: $result, tableHeaders: $header, tableData: $data, editPath: '#', deletePath: '#', id1: 'ma_nv', maxPage: $maxpage, maxPageShown: 5);

?>



<?php
include(ROOT . 'admin/footer.php');
?>
<script>
  document.getElementById('nhanvien').classList.add('active');
</script>