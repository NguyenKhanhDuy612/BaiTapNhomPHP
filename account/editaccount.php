<?php
require_once('../config/config.php');
require_once(ROOT . 'config/connect.php');
session_start();
$diaChi = $_POST['diaChi'] ?? '';
$soDienThoai = $_POST['soDienThoai'] ?? '';
$cmnd = $_POST['cmnd'] ?? '';

// kiểm tra cmnd và số điện thoại
function validateNumber(string $number)
{
    $pattern = "/[0-9]{9,12}$/";
    return preg_match($pattern, $number);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $diaChi = trim($diaChi);
    $soDienThoai = trim($soDienThoai);
    $cmnd = trim($cmnd);

    if (!validateNumber($soDienThoai) || !validateNumber($cmnd) || strlen($diaChi) == 0) {
        exit('false');
    } else {
        if ($_SESSION['role'] == 'user') {
            $query =
                "UPDATE khach_hang 
                SET dia_chi = ?, so_dien_thoai = ?, cmnd = ?
                WHERE user_id = '$user_id'
            ";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss", $diaChi, $soDienThoai, $cmnd);
            $stmt->execute();
            if ($conn->affected_rows == 1) {
                exit('true');
            } else {
                exit('nochange');
            }
        } else {
            $query =
                "UPDATE nhan_vien
                SET dia_chi = ?, so_dien_thoai = ?, cmnd = ?
                WHERE user_id = '$user_id'
            ";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss", $diaChi, $soDienThoai, $cmnd);
            $stmt->execute();
            if ($conn->affected_rows == 1) {
                exit('true');
            } else {
                exit('nochange');
            }
        }
    }
}
exit('Page not found 404');