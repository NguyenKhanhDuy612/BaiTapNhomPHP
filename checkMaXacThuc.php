<?php
session_start();
require_once('config/connect.php');

$username = $_POST['username'] ?? '';
$code = $_POST['code'] ?? '';

$query = "SELECT * FROM tai_khoan WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
// kiểm tra lần 2
if ($result->num_rows > 0) {
    if (isset($_SESSION['expire_time'], $_SESSION['code'])) {
        if ($_SESSION['so_lan_thu'] <= 5) {
            $_SESSION['so_lan_thu']++;
            if ($code == $_SESSION['code'] && $username == $_SESSION['forgot_tai_khoan']) {
                if ((time() - $_SESSION['expire_time'] < 120)) {
                    exit('true');
                } else {
                    exit('Mã xác thực đã hết hạn, hãy thử lại');
                }
            } else {
                exit('Mã xác thực không hợp lệ');
            }
        } else {
            
            exit('Bạn đã nhập quá nhiều lần, hãy thử lại sau');
        }
    } else {
        exit('Mã xác thực không hợp lệ');
    }
} else {
    session_destroy();
    exit('Tài khoản không tồn tại');
}
