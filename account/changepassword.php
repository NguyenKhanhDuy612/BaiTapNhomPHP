<?php
require_once('../config/config.php');
require_once(ROOT . 'config/connect.php');
session_start();
$password = $_POST['password'] ?? '';
$newPassword = $_POST['newPassword'] ?? '';

// kiểm tra mật khẩu
function checkPassword(string $password)
{
    $pattern = "/[a-zA-Z0-9]{8,}$/";
    return preg_match($pattern, $password);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM tai_khoan WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);
    $userInfo = $result->fetch_assoc();
    if (password_verify($password, $userInfo['password'])) {
        if (!checkPassword($newPassword)){
            exit('Sử dụng 8 ký tự trở lên gồm chữ cái, chữ số');
        }
        if ($password === $newPassword) {
            exit('Mật khẩu mới không được giống mật khẩu cũ');
        } else {
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $query = 
                "UPDATE tai_khoan 
                SET password = ?
                WHERE user_id = '$user_id'
                ";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $newPassword);
            $stmt->execute();
            if ($conn->affected_rows == 1) {
                session_regenerate_id();
                exit('true');
            } else {
                exit('Có lỗi xảy ra');
            }
        }
    } else {
        exit('Mật khẩu cũ không chính xác');
    }
}
exit('Page not found 404');