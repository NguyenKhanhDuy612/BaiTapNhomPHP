<?php
session_start();
require_once('config/config.php');
require_once(ROOT . 'config/connect.php');
require_once(ROOT . 'function/guimail.php');

$username = $_POST['username'] ?? '';

$query = "SELECT * FROM tai_khoan WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// nếu tìm thấy tài khoản thì tiến hành gửi code
if ($result->num_rows > 0) {
    /* 
    Nếu thời gian chờ chưa được đặt (lần đầu gửi mail) 
    hoặc thời gian chờ đã quá 120 giây
    thì thực hiện gửi mail
    */
    if (!isset($_SESSION['expire_time']) || (time() - $_SESSION['expire_time'] > 120)) {
        //
        $_SESSION['forgot_tai_khoan'] = $username;
        // Cho người dùng thử 5 lần
        $_SESSION['so_lan_thu'] = 1;
        $_SESSION['code'] = rand(100000, 999999);
        // 
        // Đặt expire time là thời gian hiện tại để tính thời gian hết hạn code
        // bằng cách lấy expire time trừ cho thời gian mà người dùng bấm nút xác nhận code
        //
        $_SESSION['expire_time'] = time();
        $code = $_SESSION['code'];
        $taiKhoan = $result->fetch_assoc();
        $ketQua = array('true', 'Chúng tôi đã gửi mã xác thực tới ' . maskEmail($taiKhoan['email']));
        if (guiMail($taiKhoan['email'], 'Mã xác thực', 'Mã xác thực của bạn là: ' . $code)) {
            exit(json_encode($ketQua));
        } else {
            exit(json_encode(array('Gửi mail không thành công')));
        }
    } else {
        exit(json_encode(array('Xin hãy chờ ' . 120 - (time() - $_SESSION['expire_time']) . ' giây')));
    }
} else {
    exit(json_encode(array('Tài khoản không tồn tại')));
}
