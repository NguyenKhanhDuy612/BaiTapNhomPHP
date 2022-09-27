<?php
require_once('../../../config/config.php');
require_once(ROOT.'admin/checkrole.php');
require_once(ROOT.'config/connect.php');
require_once(ROOT.'function/global.php');

$rowsPerPage = 2;
if (!isset($_GET['page'])) {
        $_GET['page'] = 1;
}
$offset = ($_GET['page'] - 1) * $rowsPerPage;


$query = 
    "SELECT * FROM tai_khoan tk 
    JOIN quyen q ON tk.ma_quyen = q.ma_quyen
    LIMIT $offset, $rowsPerPage
    ";

$stmt = $conn->prepare($query);
$stmt->execute();
$taiKhoans = $stmt->get_result();

$query = 
    "SELECT * FROM tai_khoan tk 
    JOIN quyen q ON tk.ma_quyen = q.ma_quyen
    ";
$stmt = $conn->prepare($query);
$stmt->execute();
$maxPage = ceil($stmt->get_result()->num_rows / $rowsPerPage);

$header = array('UID', 'Tên tài khoản', 'Quyền', 'Email');
$data = array(
    'user_id' => null,
    'username' => null, 
    'ten_quyen' => null, 
    'email' => 'email',
);
include(ROOT.'admin/header.php');
buildTable(
    result: $taiKhoans,
    tableHeaders: $header,
    tableData: $data,
    maxPage: $maxPage,
);
include(ROOT.'admin/footer.php');

?>
<script>
    document.getElementById('taikhoan').classList.add('active');
    document.getElementById('quanly').classList.add('menu-is-opening', 'menu-open');
</script>