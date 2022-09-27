<?php
session_start();
require_once('config/connect.php');
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$code = $_POST['code'] ?? '';

// kiểm tra mật khẩu
function checkPassword(string $password)
{
    $pattern = "/[a-zA-Z0-9]{8,}$/";
    return preg_match($pattern, $password);
}

$query = "SELECT * FROM tai_khoan WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
// kiểm tra lần 3
if ($result->num_rows > 0) {
    if (isset($_SESSION['code'], $_SESSION['forgot_tai_khoan'])) {
        if ($code == $_SESSION['code'] && $username == $_SESSION['forgot_tai_khoan']) {
            if (!checkPassword($password)) {
                exit('Sử dụng 8 ký tự trở lên gồm chữ cái, chữ số');
            } else {
                $row = $result->fetch_assoc();
                if (!password_verify($password, $row['password'])) {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $query =
                        "UPDATE tai_khoan 
                        SET password = ?
                        WHERE username = '$username'
                        ";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('s', $password);
                    $stmt->execute();
                    if ($conn->affected_rows == 1) {
                        session_destroy();
                        exit('true');
                    } else {
                        exit('Có lỗi xảy ra');
                    }
                }
                exit('Mật khẩu mới không được giống mật khẩu cũ');
            }
            //exit('hmmm');
        }
        //exit('code và forgot tai khoan ko hợp lệ');
    }
    //exit ('code chưa set, forgot tai khoan chưa set');
}
exit();
